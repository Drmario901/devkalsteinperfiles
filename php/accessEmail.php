<?php
    session_start();
    require_once '../db/conexion.php';

    $email = $_POST['consulta'];
    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";    
	$consulta2 = "SELECT * FROM wp_private_account WHERE account_email = '$email'";
	$resultConsulta = $conexion->query($consulta);
    $resultConsulta2 = $conexion->query($consulta2);
	$count = mysqli_num_rows($resultConsulta);
    $row = mysqli_fetch_array($resultConsulta);
    $statusAcc = $row['account_status'];
    $count2 = mysqli_num_rows($resultConsulta2);
    // Este comentario es nuevo para un commit xD
    if ($count > 0){
        $status = 'registrado';
    }else{
        if ($count2 > 0){
            $status = 'registrado';
        }else{
            $status = 'noregistrado';
        }
    }

    if ($statusAcc == 'pending'){
        $_SESSION["emailAccountPending"] = $email;
    }

    $datos = array(
        'status' => $status,
        'statusAcc' => $statusAcc
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();