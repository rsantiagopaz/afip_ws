<?php

require_once("Config.php");

class Wsaa
{
 	protected $mysqli;

	function __construct($mysqli) {
		
		ini_set("soap.wsdl_cache_enabled", "0");
				
		$this->mysqli = $mysqli;
	}

	
	public function CreateTRA($service = "wsfe") {
		global $path;
		
		$TRA = new SimpleXMLElement(
			'<?xml version="1.0" encoding="UTF-8"?>
			<loginTicketRequest version="1.0" />'
		);
		$TRA->addChild('header');
		$TRA->header->addChild('uniqueId', date('U'));
		$TRA->header->addChild('generationTime', date('c', date('U') - 60));
		$TRA->header->addChild('expirationTime', date('c', date('U') + 60));
		$TRA->addChild('service', $service);
		$TRA->asXML($path . "xml/TRA.xml");
	}
	
	
	public function SignTRA() {
		global $path, $crt, $key, $passphrase;
		
		$fp = fopen($path . "xml/TRA.tmp", "w");
		fclose($fp);
		
		$STATUS = openssl_pkcs7_sign(
			realpath($path . "xml/TRA.xml")
			, realpath($path . "xml/TRA.tmp")
			, "file://" . realpath($path . "key/" . $crt)
			, array("file://" . realpath($path . "key/" . $key), $passphrase)
			, array()
			, ! PKCS7_DETACHED
		);
		
  		if (! $STATUS) {
  			//exit("ERROR generating PKCS#7 signature\n");
  			throw new Exception("ERROR generating PKCS#7 signature\n");
  		}
  		
		$inf = fopen($path . "xml/TRA.tmp", "r");
		$i = 0;
		$CMS = "";
		while (! feof($inf)) { 
			$buffer = fgets($inf);
			if ( $i++ >= 4 ) {
				$CMS.= $buffer;
			}
		}
		
		fclose($inf);
		
		#  unlink("TRA.xml");
		unlink($path . "xml/TRA.tmp");
		
		return $CMS;
	}
	
	
	function CallWSAA($CMS) {
		global $path, $wsaa_url;
		
		$resultado = new stdClass;
		
		$soapClient = new SoapClient(
			$path . "wsdl/wsaa.wsdl"
			, array(
				'soap_version'   => SOAP_1_2
				, 'location'       => $wsaa_url
				, 'trace'          => 1
				, 'exceptions'     => 0
				
				//, 'proxy_host'     => PROXY_HOST
				//, 'proxy_port'     => PROXY_PORT
			)
		);
           
		$loginCms = $soapClient->loginCms(array('in0' => $CMS));
		file_put_contents($path . "xml/loginCms_LastRequest.xml", $soapClient->__getLastRequest());
		file_put_contents($path . "xml/loginCms_LastResponse.xml", $soapClient->__getLastResponse());
		
  		if (is_soap_fault($loginCms)) {
  			
  			// Error de SOAP
	
			$resultado->resultado = "S";
			$resultado->texto_respuesta = json_encode($loginCms);

  		} else {
  			$loginCmsReturn = $loginCms->loginCmsReturn;
  			
  			file_put_contents($path . "xml/TA.xml", $loginCmsReturn);
  			
  			$resultado->resultado = "A";
  			$resultado->texto_respuesta = $loginCmsReturn;
  		}
  		
  		$sql = "INSERT ws_wsaa SET resultado='" . $resultado->resultado . "', texto_respuesta='" . $resultado->texto_respuesta . "'";
		$this->mysqli->query($sql);
		$insert_id = $this->mysqli->insert_id;
		
		$resultado->id_ws_wsaa = $insert_id;
  		
  		return $resultado;
	}
}

?>