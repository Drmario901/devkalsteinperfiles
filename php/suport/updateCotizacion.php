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
        $array["status"] = "Correcto";
        $array["mensaje"] = "Mise à jour réussie !!!";
    }
    else{
        $array["status"] = "Incorrecto";
        $array["mensaje"] = "Rejet de la mise à niveau";
    }

    /* array_push($array, $array1); */

    /* $array = array(
        "cotizacion_status" => $cotizacion_status,
        "cotizacion_status_nombre" => $cotizacion_status_nombre
    ); */


    echo json_encode($array, JSON_FORCE_OBJECT);
?>