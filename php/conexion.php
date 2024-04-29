<?php
$hostdb = "localhost";
$userdb = "kalsteinplus";
$passdb = "OqA;}vKA94PO";
$namedb = "kalsteinplus_he270716_wp_es";
$namedb2 = "kalsteinplus_plataforma_desarrollo";
//$namedb3 = "he270716_wp3";

$conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
$acentos = $conexion->query("SET NAMES 'utf8'");

$conexion2 = new mysqli($hostdb, $userdb, $passdb, $namedb2);
$acentos = $conexion->query("SET NAMES 'utf8'");

/*$conexion3 = new mysqli($hostdb, $userdb, $passdb, $namedb3);
$acentos = $conexion->query("SET NAMES 'utf8'");*/

if ($conexion->connect_error) {
    die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
}
?>