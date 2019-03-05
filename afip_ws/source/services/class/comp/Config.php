<?php

require_once("Conexion.php");


$modo = "homologacion";			// homologacion, produccion
$CUIT = 20267565393;			// CUIT del emisor de las facturas. Solo numeros sin comillas.


$homologacion_crt = "reingart.crt";
$homologacion_key = "reingart.key";
$homologacion_passphrase = "";

$produccion_crt = "";
$produccion_key = "";
$produccion_passphrase = "";






$path = "afip_ws/" . $modo . "/";


if ($modo == "produccion") {
	$wsaa_url = "";
	$wsfev1_url = "";
	
	$crt = $produccion_crt;
	$key = $produccion_key;
	$passphrase = $produccion_passphrase;
} else {
	$wsaa_url = "https://wsaahomo.afip.gov.ar/ws/services/LoginCms";
	$wsfev1_url = "https://wswhomo.afip.gov.ar/wsfev1/service.asmx";
	
	$crt = $homologacion_crt;
	$key = $homologacion_key;
	$passphrase = $homologacion_passphrase;
}




?>