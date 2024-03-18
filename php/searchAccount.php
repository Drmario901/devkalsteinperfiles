<?php
    require_once '../db/conexion.php';

    $email = $_POST['consulta'];
    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
	$resultConsulta = $conexion->query($consulta);
	$count = mysqli_num_rows($resultConsulta);

    $characterBeforeAroba = substr($email, 0, strpos($email, '@'));
    $consultUserTag = "SELECT * FROM wp_account WHERE user_tag = '$characterBeforeAroba'";
    $resultUserTag = $conexion->query($consultUserTag);
    $countUserTag = mysqli_num_rows($resultUserTag);

    if ($countUserTag > 0) {
        $idUniquid = rand(1,99);
        $userTag = '@'.$characterBeforeAroba.''.$idUniquid;
    }else{
        $userTag = '@'.$characterBeforeAroba;
    }

    $verifyUserTag = "SELECT * FROM wp_account WHERE user_tag = '$userTag'";
    $resultVerifyUserTag = $conexion->query($verifyUserTag);
    $countVerifyUserTag = mysqli_num_rows($resultVerifyUserTag);
    if ($countVerifyUserTag > 0){
        $idUniquid = rand(1,99);
        $userTag = '@'.$characterBeforeAroba.''.$idUniquid;
    }else{
        $userTag = $userTag;
    }

    if ($count > 0){
        $status = 'nodisponible';
    }else{
        $status = 'disponible';
    }

    $datos = array(
        'status' => $status,
        'userTag' => $userTag
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();