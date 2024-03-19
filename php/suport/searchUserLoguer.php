<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once __DIR__ . '/../../db/conexion.php';

    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $resultConsulta = $conexion->query($consulta);
	$row = mysqli_fetch_array($resultConsulta);
    $idAcc = $row[1];
    $name = $row[3];
    $lastname = $row[4];


    $datos = array(
        'emailAcc' => $email,
        'name' => $name,
        'lastname' => $lastname
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();