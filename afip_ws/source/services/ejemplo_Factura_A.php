<?php

require_once("class/comp/Afip_ws.class.php");


$mysqli = new mysqli("$servidor", "$usuario", "$password", "afip_ws_" . $modo);
$mysqli->query("SET NAMES 'utf8'");


$Afip_ws = new Afip_ws;

 
//================================================================================================================================================

		
/*
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
*/



//================================================================================================================================================



/*
$p = new stdClass;

$p->FeCAEReq = new stdClass;
$p->FeCAEReq->FeCabReq = new stdClass;
$p->FeCAEReq->FeCabReq->CantReg = 1;
$p->FeCAEReq->FeCabReq->PtoVta = 4000;	//Punto de Venta
$p->FeCAEReq->FeCabReq->CbteTipo = 1;		//1=Factura A

$p->FeCAEReq->FeDetReq = new stdClass;
$p->FeCAEReq->FeDetReq->FECAEDetRequest = new stdClass;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Concepto = 1;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->DocTipo = 80;			//80=CUIL
$p->FeCAEReq->FeDetReq->FECAEDetRequest->DocNro = 20219021810;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->CbteDesde = 1293;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->CbteHasta = 1293;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->CbteFch = date('Ymd');	// fecha emision de factura
$p->FeCAEReq->FeDetReq->FECAEDetRequest->ImpNeto = 100;			// neto gravado
$p->FeCAEReq->FeDetReq->FECAEDetRequest->ImpTotConc = 0;		// no gravado
$p->FeCAEReq->FeDetReq->FECAEDetRequest->ImpIVA = 21;			// IVA liquidado
$p->FeCAEReq->FeDetReq->FECAEDetRequest->ImpTrib = 0;			// otros tributos
$p->FeCAEReq->FeDetReq->FECAEDetRequest->ImpOpEx = 0;			// operacion exentas
$p->FeCAEReq->FeDetReq->FECAEDetRequest->ImpTotal = 121;		// total de la factura. ImpNeto + ImpTotConc + ImpIVA + ImpTrib + ImpOpEx
$p->FeCAEReq->FeDetReq->FECAEDetRequest->FchServDesde = null;	// solo concepto 2 o 3
$p->FeCAEReq->FeDetReq->FECAEDetRequest->FchServHasta = null;	// solo concepto 2 o 3
$p->FeCAEReq->FeDetReq->FECAEDetRequest->FchVtoPago = null;		// solo concepto 2 o 3
$p->FeCAEReq->FeDetReq->FECAEDetRequest->MonId = 'PES';			// Id de moneda 'PES'
$p->FeCAEReq->FeDetReq->FECAEDetRequest->MonCotiz = 1;			// Cotizacion moneda. Solo exportacion

$p->FeCAEReq->FeDetReq->FECAEDetRequest->Tributos = new stdClass;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Tributos->Tributo = new stdClass;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Tributos->Tributo->Id = 1;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Tributos->Tributo->Desc = 'impuesto';
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Tributos->Tributo->BaseImp = 0;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Tributos->Tributo->Alic = 0;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Tributos->Tributo->Importe = 0;

$p->FeCAEReq->FeDetReq->FECAEDetRequest->Iva = new stdClass;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Iva->AlicIva = new stdClass;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Iva->AlicIva->Id = 5;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Iva->AlicIva->BaseImp = 100;
$p->FeCAEReq->FeDetReq->FECAEDetRequest->Iva->AlicIva->Importe = 21;
*/







//================================================================================================================================================




$p = array(
	"FeCAEReq" => array(
		"FeCabReq" => array(
			"CantReg"	=> 1,
			"PtoVta"	=> 4000,					// Punto de Venta
			"CbteTipo"	=> 1						// 1=Factura A
		),
		"FeDetReq" => array(
			"FECAEDetRequest" => array(
				"Concepto"		=> 1,				// 1=Productos, 2=Servicios, 3=Productos y Servicios
				"DocTipo"		=> 80,				// 80=CUIL
				"DocNro"		=> 20219021810,
				"CbteDesde"		=> 1299,
				"CbteHasta"		=> 1299,
				"CbteFch"		=> date('Ymd'),		// fecha emision de factura
				"ImpNeto"		=> 100,				// neto gravado
				"ImpTotConc"	=> 0,				// no gravado
				"ImpIVA"		=> 21,				// IVA liquidado
				"ImpTrib"		=> 0,				// otros tributos
				"ImpOpEx"		=> 0,				// operacion exentas
				"ImpTotal"		=> 121,				// total de la factura. ImpNeto + ImpTotConc + ImpIVA + ImpTrib + ImpOpEx
				"FchServDesde"	=> null,			// solo Concepto = 2 o 3
				"FchServHasta"	=> null,			// solo Concepto = 2 o 3
				"FchVtoPago"	=> null,			// solo Concepto = 2 o 3
				"MonId"			=> "PES",			// Id de moneda "PES"
				"MonCotiz"		=> 1,				// Cotizacion moneda. Solo exportacion
				"Tributos" => array(
					"Tributo" => array(
						array(
							"Id"		=>  1,
							"Desc"		=> "impuesto",
							"BaseImp"	=> 0,
							"Alic"		=> 0,
							"Importe"	=> 0
						)
					),
				),
				"Iva" => array(
					"AlicIva" => array(
						array(
							"Id"		=> 5,
							"BaseImp"	=> 100,
							"Importe"	=> 21
						),
						array(
							"Id"		=> 1,
							"BaseImp"	=> 100,
							"Importe"	=> 21
						)
					),
				),
			), 
		), 
	), 
);




//================================================================================================================================================











$resultado = $Afip_ws->FECAESolicitar($p);
echo json_encode($resultado);

if (isset($resultado->id_ws_documento)) {
	
	// CAE aprobado

	$sql = "SELECT * FROM ws_wsfev1 WHERE id_ws_wsfev1='" . $resultado->id_ws_wsfev1 . "'";
	$rs = $mysqli->query($sql);
	$row = $rs->fetch_object();
	
	$xml = new SimpleXMLElement($row->texto_respuesta);
	$FECAESolicitarResponse = $xml->children("soap", true)->Body->children()->FECAESolicitarResponse;
	
	$FECAEDetResponse = $FECAESolicitarResponse->FECAESolicitarResult->FeDetResp->FECAEDetResponse;
	if (count($FECAEDetResponse) > 0) {
		foreach ($FECAEDetResponse as $item) {
			echo "<br><br>";
			echo "CAE: " . $item->CAE;
			echo "<br>";
			echo "CAEFchVto: " . $item->CAEFchVto;
			echo "<br><br>";
		}
	}
	

	
} else if (isset($resultado->id_ws_wsfev1)) {
	
	// Error en SOAP wsfev1 o error en logica de negocios
	
	$sql = "SELECT * FROM ws_wsfev1 WHERE id_ws_wsfev1='" . $resultado->id_ws_wsfev1 . "'";
	$rs = $mysqli->query($sql);
	$row = $rs->fetch_object();
	
	if ($row->resultado == "S") {
		
		// Error de SOAP
		
		$json = json_decode($row->texto_respuesta);
		
		echo "<br><br>";
		echo "faultcode: " . $json->faultcode;
		echo "<br>";
		echo "faultstring: " . $json->faultstring;
		echo "<br>";
		echo "detail: " . json_encode($json->detail);
		echo "<br><br>";
		
	} else if ($row->resultado == "R") {
		
		// Error de lógica de negocios
	
		$xml = new SimpleXMLElement($row->texto_respuesta);
		$FECAESolicitarResponse = $xml->children("soap", true)->Body->children()->FECAESolicitarResponse;
		
		//echo "<br><br>" . htmlentities($FECAESolicitarResponse->asXML()) . "<br><br>";
		
		$Errors = $FECAESolicitarResponse->FECAESolicitarResult->Errors;
		if (count($Errors) > 0) {
			foreach ($Errors->Err as $item) {
				echo "<br><br>";
				echo "Err Code: " . $item->Code;
				echo "<br>";
				echo "Err Msg: " . $item->Msg;
				echo "<br><br>";
			}
		}

		$FECAEDetResponse = $FECAESolicitarResponse->FECAESolicitarResult->FeDetResp->FECAEDetResponse;
		if (count($FECAEDetResponse) > 0) {
			foreach ($FECAEDetResponse as $item) {
				$Observaciones = $item->Observaciones;
				if (count($Observaciones) > 0) {
					foreach ($Observaciones->Obs as $item) {
						echo "<br><br>";
						echo "Obs Code: " . $item->Code;
						echo "<br>";
						echo "Obs Msg: " . $item->Msg;
						echo "<br><br>";
					}
				}
			}
		}
	}
	
} else if (isset($resultado->id_ws_wsaa)) {
	
	$sql = "SELECT * FROM ws_wsaa WHERE id_ws_wsaa='" . $resultado->id_ws_wsaa . "'";
	$rs = $mysqli->query($sql);
	$row = $rs->fetch_object();
	
	if ($row->resultado == "S") {
		
		// Error de SOAP wsaa
		
		$json = json_decode($row->texto_respuesta);
		
		echo "<br><br>";
		echo "faultcode: " . $json->faultcode;
		echo "<br>";
		echo "faultstring: " . $json->faultstring;
		echo "<br>";
		echo "detail: " . json_encode($json->detail);
		echo "<br><br>";
		
	}
}
	

?>