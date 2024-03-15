<?php
    session_start();
    require __DIR__ . '/../conexion.php';

    $email = $_POST['consulta'];
    $password = $_POST['consulta1'];
    $passwordEncrypted = md5($password);

    $register = "INSERT INTO wp_account(account_aid, account_correo, account_contraseña, account_status, account_created_at) VALUES ('', '$email', '$passwordEncrypted', 'pending', CURRENT_TIMESTAMP)";
    if ($conexion -> query($register) === TRUE) {
        $registro = "correcto";
    }else{
        $registro = "incorrecto";
    }

    $numRandom = mt_rand(000000, 999999);
    $_SESSION["codeVerification"] = $numRandom;
    $_SESSION["emailAccount"] = $email;
    $_SESSION["codeTimeOut"] = time();

    $datos = array(
        'registro' => $registro
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();