<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }
    require_once '/conexion.php';

    $delete = "DELETE FROM wp_account WHERE account_correo = '$email'";
    if ($conexion->query($delete) === TRUE){
        $delete2 = "DELETE FROM wp_company WHERE company_account_correo = '$email'";
        if ($conexion->query($delete2) === TRUE){
            $delete = 'correcto';
            unset($_SESSION['emailAccount']);
	        session_destroy();
        }else{
            $delete = 'incorrecto';
        }
    }else{
        $delete = 'incorrecto';
    }

    $datos = array(
        'delete' => $delete
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();