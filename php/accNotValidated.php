<?php
    session_start();
    require_once '/conexion.php';
    if(isset($_SESSION["emailAccountPending"])){
        $email = $_SESSION["emailAccountPending"];
    }else{
        $email = '';
    }

    $datos = array(
        'email' => $email
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();