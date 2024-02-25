<?php
session_start();
header("Content-Type: application/json");
require "conexion.php";

$user = $_SESSION["emailAccount"];



$cotizacion_status = $_POST["cotizacion_status"];
$cotizacion_status_nombre = $_POST["cotizacion_status_nombre"];

$sql = "UPDATE wp_cotizacion SET cotizacion_status = '$cotizacion_status' WHERE cotizacion_id = '$cotizacion_status_nombre'";
$resultado = $conexion->query($sql);

if($resultado === TRUE){
    echo "Actualización realizada con exito!!!";
}
else{
    echo "Rechazada la actualización";
}

$array = array(
    "cotizacion_status" => $cotizacion_status,
    "cotizacion_status_nombre" => $cotizacion_status_nombre
);


echo json_encode($array, JSON_FORCE_OBJECT);



?>