<?php

require_once("class/comp/Afip_ws.class.php");


$mysqli = new mysqli("$servidor", "$usuario", "$password", "afip_ws_" . $modo);
$mysqli->query("SET NAMES 'utf8'"); 


		
		
		$p = array();
		
		$p["FeCAEReq"] = array();
		$p["FeCAEReq"]["FeCabReq"] = array();
		$p["FeCAEReq"]["FeCabReq"]["CantReg"] = 1;
		$p["FeCAEReq"]["FeCabReq"]["PtoVta"] = 4000;	//Punto de Venta
		$p["FeCAEReq"]["FeCabReq"]["CbteTipo"] = 1;		//1=Factura A
		
		$p["FeCAEReq"]["FeDetReq"] = array();
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"] = array();
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Concepto"] = 1;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["DocTipo"] = 80;			//80=CUIL
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["DocNro"] = 20219021810;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["CbteDesde"] = 1284;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["CbteHasta"] = 1284;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["CbteFch"] = date('Ymd');	// fecha emision de factura
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["ImpNeto"] = 100;			// neto gravado
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["ImpTotConc"] = 0;		// no gravado
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["ImpIVA"] = 21;			// IVA liquidado
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["ImpTrib"] = 0;			// otros tributos
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["ImpOpEx"] = 0;			// operacion exentas
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["ImpTotal"] = 121;		// total de la factura. ImpNeto + ImpTotConc + ImpIVA + ImpTrib + ImpOpEx
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["FchServDesde"] = null;	// solo concepto 2 o 3
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["FchServHasta"] = null;	// solo concepto 2 o 3
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["FchVtoPago"] = null;		// solo concepto 2 o 3
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["MonId"] = 'PES';			// Id de moneda 'PES'
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["MonCotiz"] = 1;			// Cotizacion moneda. Solo exportacion
		
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Tributos"] = array();
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Tributos"]["Tributo"] = array();
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Tributos"]["Tributo"]["Id"] = 1;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Tributos"]["Tributo"]["Desc"] = 'impuesto';
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Tributos"]["Tributo"]["BaseImp"] = 0;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Tributos"]["Tributo"]["Alic"] = 0;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Tributos"]["Tributo"]["Importe"] = 0;
		
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Iva"] = array();
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Iva"]["AlicIva"] = array();
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Iva"]["AlicIva"]["Id"] = 5;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Iva"]["AlicIva"]["BaseImp"] = 100;
		$p["FeCAEReq"]["FeDetReq"]["FECAEDetRequest"]["Iva"]["AlicIva"]["Importe"] = 21;
		
		


	/*
	$p = array(
		'Auth' => 
		array( 'Token' => $this->TA->credentials->token,
				'Sign' => $this->TA->credentials->sign,
				'Cuit' => self::CUIT ), 
		'FeCAEReq' => 
		array( 'FeCabReq' => 
			array( 'CantReg' => 1,
					'PtoVta' => $ptovta,
					'CbteTipo' => $regfe['CbteTipo'] ),
		'FeDetReq' => 
		array( 'FECAEDetRequest' => 
			array( 'Concepto' => $regfe['Concepto'],
					'DocTipo' => $regfe['DocTipo'],
					'DocNro' => $regfe['DocNro'],
					'CbteDesde' => $cbte,
					'CbteHasta' => $cbte,
					'CbteFch' => $regfe['CbteFch'],
					'ImpNeto' => $regfe['ImpNeto'],
					'ImpTotConc' => $regfe['ImpTotConc'], 
					'ImpIVA' => $regfe['ImpIVA'],
					'ImpTrib' => $regfe['ImpTrib'],
					'ImpOpEx' => $regfe['ImpOpEx'],
					'ImpTotal' => $regfe['ImpTotal'], 
					'FchServDesde' => $regfe['FchServDesde'], //null
					'FchServHasta' => $regfe['FchServHasta'], //null
					'FchVtoPago' => $regfe['FchVtoPago'], //null
					'MonId' => $regfe['MonId'], //PES 
					'MonCotiz' => $regfe['MonCotiz'], //1 
					'Tributos' => 
						array( 'Tributo' => 
							array ( 'Id' =>  $regfetrib['Id'], 
									'Desc' => $regfetrib['Desc'],
									'BaseImp' => $regfetrib['BaseImp'], 
									'Alic' => $regfetrib['Alic'], 
									'Importe' => $regfetrib['Importe'] ),
							), 
					'Iva' => 
						array ( 'AlicIva' => 
							array ( 'Id' => $regfeiva['Id'], 
									'BaseImp' => $regfeiva['BaseImp'], 
									'Importe' => $regfeiva['Importe'] ),
							), 
					), 
			), 
		), 
	);
	*/
	
	

$Afip_ws = new Afip_ws;
$resultado = $Afip_ws->FECAESolicitar($p);
echo json_encode($resultado);

if (isset($resultado->id_ws_documento)) {
	$sql = "SELECT * FROM ws_wsfev1 WHERE id_ws_wsfev1='" . $resultado->id_ws_wsfev1 . "'";
	$rs = $mysqli->query($sql);
	$row = $rs->fetch_object();
	
	$json = json_decode($row->texto_respuesta);
	
	echo "<br><br>";
	echo "CAE: " . $json->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAE;
	echo "<br>";
	echo "CAEFchVto: " . $json->FECAESolicitarResult->FeDetResp->FECAEDetResponse->CAEFchVto;
	echo "<br><br>";
	
} else if (isset($resultado->id_ws_wsfev1)) {
	$sql = "SELECT * FROM ws_wsfev1 WHERE id_ws_wsfev1='" . $resultado->id_ws_wsfev1 . "'";
	$rs = $mysqli->query($sql);
	$row = $rs->fetch_object();
	
	$json = json_decode($row->texto_respuesta);
	
	echo "<br><br>";
	echo "Err Code: " . $json->FECAESolicitarResult->Errors->Err->Code;
	echo "<br>";
	echo "Err Msg: " . $json->FECAESolicitarResult->Errors->Err->Msg;
	echo "<br><br>";
	
} else if (isset($resultado->id_ws_wsaa)) {
	$sql = "SELECT * FROM ws_wsaa WHERE id_ws_wsaa='" . $resultado->id_ws_wsaa . "'";
	$rs = $mysqli->query($sql);
	$row = $rs->fetch_object();
	
	$json = json_decode($row->texto_respuesta);
	
	echo "<br><br>";
	echo "faultcode: " . $json->faultcode;
	echo "<br>";
	echo "faultstring: " . $json->faultstring;
	echo "<br><br>";
}
	

?>