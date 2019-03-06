<?php

require_once("Config.php");
require_once("Wsaa.class.php");
require_once("Wsfev1.class.php");


class Afip_ws
{
 	protected $mysqli;
 	
 	protected $Wsaa;
 	protected $Wsfev1;

	function __construct() {
		global $servidor, $usuario, $password, $modo;
		
		
		$aux = new mysqli_driver;
		$aux->report_mode = MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT;
				
		$this->mysqli = new mysqli("$servidor", "$usuario", "$password", "afip_ws_" . $modo);
		$this->mysqli->query("SET NAMES 'utf8'");
		
		
		$this->Wsaa = new Wsaa($this->mysqli);
		$this->Wsfev1 = new Wsfev1($this->mysqli);
	}


	public function FECAESolicitar($p) {
		global $path, $CUIT;
		
		$resultado = new stdClass;
		
		$TA = false;
		
		if (is_file($path . "xml/TA.xml")) {
			$TA = simplexml_load_file($path . "xml/TA.xml");
		
			if ($TA) {
				$expirationTime = $TA->header->expirationTime;
				$expirationTime = substr($expirationTime, 0, 10) . " " . substr($expirationTime, 11, 8);
				
				if ($expirationTime < date("Y-m-d h:i:s")) {
					$TA = false;
				} else {
					$sql = "SELECT id_ws_wsaa FROM ws_wsaa WHERE resultado='A' ORDER BY id_ws_wsaa DESC LIMIT 1";
					$rs = $this->mysqli->query($sql);
					$row = $rs->fetch_object();
					
					$resultado->id_ws_wsaa = $row->id_ws_wsaa;
				}
			}
		}
		
		if (! $TA) {
			$this->Wsaa->CreateTRA("wsfe");
			$CMS = $this->Wsaa->SignTRA();
			$CallWSAA = $this->Wsaa->CallWSAA($CMS);
			
			//echo "<br><br>" . json_encode($TA) . "<br><br>";
			
			$resultado->id_ws_wsaa = $CallWSAA->id_ws_wsaa;
			
			if ($CallWSAA->resultado == "A") $TA = new SimpleXMLElement($CallWSAA->texto_respuesta);
		}
		
		if ($TA) {
			$p["Auth"] = array();
			$p["Auth"]["Token"] = $TA->credentials->token;
			$p["Auth"]["Sign"] = $TA->credentials->sign;
			$p["Auth"]["Cuit"] = $CUIT;
		
			$FECAESolicitar = $this->Wsfev1->FECAESolicitar($p);
			
			$resultado->id_ws_wsfev1 = $FECAESolicitar->id_ws_wsfev1;

			$sql = "INSERT ws_solicitud SET id_ws_wsaa='" . $resultado->id_ws_wsaa . "', id_ws_wsfev1='" . $resultado->id_ws_wsfev1 . "'";
			$this->mysqli->query($sql);
			$insert_id = $this->mysqli->insert_id;
		
			$resultado->id_ws_solicitud = $insert_id;
			
			if ($FECAESolicitar->resultado != "R") {
				$sql = "INSERT ws_documento SET id_ws_solicitud='" . $resultado->id_ws_solicitud . "', id_ws_wsaa='" . $resultado->id_ws_wsaa . "', id_ws_wsfev1='" . $resultado->id_ws_wsfev1 . "'";
				$this->mysqli->query($sql);
				$insert_id = $this->mysqli->insert_id;
				
				$resultado->id_ws_documento = $insert_id;
			}
		} else {
			$sql = "INSERT ws_solicitud SET id_ws_wsaa='" . $resultado->id_ws_wsaa . "'";
			$this->mysqli->query($sql);
			$insert_id = $this->mysqli->insert_id;
		
			$resultado->id_ws_solicitud = $insert_id;			
		}
		
		
		return $resultado;
	}
}

?>