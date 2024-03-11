<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);

     
    session_start();
    $email = $_SESSION['emailAccount'];

    require 'conexion.php';
    
    
    /* $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    if ($conexion->connect_error) {
        die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
    } */

    $service = $_POST['service'];
    $company= $_POST['service_company'];
    $name = $_POST['service_agente'];
    $telefono = $_POST['service_telefono'];
    $usuario = $_POST['service_correo'];

    $pais = $_POST['service_pais'];
    $direccion = $_POST['service_direccion'];
    $estadolugar = $_POST['service_estadolugar'];
    $ciudad = $_POST['service_ciudad'];
    $provincia = $_POST['service_provincia'];

    $category = $_POST['service_category'];
    $estado = $_POST['service_estado'];
    $tiempo = $_POST['service_tiempo'];
    $Description = $_POST['service_description'];

    $query = "INSERT INTO wp_servicios (SE_id, SE_servicio, SE_category, SE_agente_soporte, SE_correo, SE_description, SE_estado, SE_company, SE_pais, SE_ciudad, SE_direccion, SE_telefono, SE_estadolugar, SE_provincia, SE_tiempo, service_maker) VALUES (
            '',
            '$service',
            '$category',
            '$name',
            '$usuario',
            '$Description',
            '$estado',
            '$company',
            '$pais',
            '$ciudad',
            '$direccion',
            '$telefono',
            '$estadolugar',
            '$provincia',
            '$tiempo',
            '$email'
            )
        ";

    if ($conexion->query($query) === TRUE) {
        $datos['status'] = 'correcto';
    } else {
        $datos['status'] = 'incorrecto';
    }

    header("Content-Type: application/json");

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();
?>