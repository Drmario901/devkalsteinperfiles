<?php
     ini_set('display_errors', 1);
     ini_set('display_startup_errors', 1);
     error_reporting(E_ALL);
    session_start();
    $email = $_SESSION['emailAccount'];

    require __DIR__.'/../conexion.php';
    
    
    /* $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    if ($conexion->connect_error) {
        die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
    } */
    $service = $_POST['SE_servicio'] ?? NULL;
    $company= $_POST['SE_company'] ?? NULL;
    $name = $_POST['SE_agente'] ?? NULL;
    $telefono = $_POST['SE_telefono'] ?? NULL;
    $usuario = $_POST['SE_correo'] ?? NULL;
    $pais = $_POST['SE_pais'] ?? NULL;
    $direccion = $_POST['SE_direccion'] ?? NULL;
    $estadolugar = $_POST['SE_estadolugar'] ?? NULL;
    $ciudad = $_POST['SE_ciudad'] ?? NULL;
    $provincia = $_POST['SE_provincia'] ?? NULL;
    $category = $_POST['SE_category'] ?? NULL;
    $estado = $_POST['SE_estado'] ?? NULL;
    $tiempo = $_POST['SE_tiempo'] ?? NULL;
    $Description = $_POST['SE_descripcion'] ?? NULL;

    $query = "INSERT INTO wp_servicios (SE_id, SE_servicio, SE_category, SE_agente_soporte, SE_correo, SE_description, SE_estado, SE_company, SE_pais, SE_ciudad, SE_direccion, SE_telefono, SE_estadolugar, SE_provincia, SE_tiempo, service_maker) VALUES ('', '$service', '$category', '$name', '$usuario', '$Description', '$estado', '$company', '$pais', '$ciudad', '$direccion', '$telefono', '$estadolugar', '$provincia', '$tiempo', '$email')";

    if ($conexion->query($query) === TRUE) {
        $status = 'correcto';
        $pais = $pais;
    } else {
        $status = 'incorrecto';
        $pais = $pais;
    }

    $datos = array(
        'status' => $status,
        'pais' => $pais
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();
?>