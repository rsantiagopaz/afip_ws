<?php

require_once("Config.php");

class Wsfev1
{
 	protected $mysqli;

	function __construct($mysqli) {
		
		ini_set("soap.wsdl_cache_enabled", "0");
				
		$this->mysqli = $mysqli;
	}


	public function FECAESolicitar($p) {
		global $path, $wsfev1_url;
		
		if ($p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["CbteDesde"] == 0) $p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["CbteDesde"] = 1;
		if ($p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["CbteHasta"] == 0) $p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["CbteHasta"] = 1;
		
    
		$soapClient = new SoapClient(
			$path . "wsdl/wsfev1.wsdl"
			, array(
				'soap_version'   => SOAP_1_2
				, 'location'       => $wsfev1_url
				, 'trace'          => 1
				, 'exceptions'     => 0
				
				//, 'proxy_host'     => PROXY_HOST
				//, 'proxy_port'     => PROXY_PORT
			)
		);
	
		$results = $soapClient->FECAESolicitar($p);

		//$e = $this->_checkErrors($results, 'FECAESolicitar');
		
		file_put_contents($path . "xml/CAE.txt", json_encode($results));
		
		return $results;
	}
}

?>