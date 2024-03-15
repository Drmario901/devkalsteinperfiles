<?php
    session_start();
    if (isset($_SESSION['emailPasswordChangeRequest'])){
        $email = $_SESSION['emailPasswordChangeRequest'];
    }

    require __DIR__.'/conexion.php';

    $password = $_POST['password'];
    $passwordEncryptedScientist = password_hash($password, PASSWORD_DEFAULT); 
    $encryptPassword = md5($password);

    $sql = "UPDATE wp_account SET account_contraseña = '$encryptPassword' WHERE account_correo = '$email'";

    //CIENTÍFICO 
    $sql2 = "UPDATE wp_account_scientist SET account_contraseña = '$passwordEncryptedScientist', account_password_plain = '$password' WHERE account_correo = '$email'";
    //TABLA WP_USERS CIENTÍFICO
    $sql3 = "UPDATE wp_users SET user_pass = '$passwordEncryptedScientist', account_password_plain = '$password' WHERE user_email = '$email'";
    

    if ($conexion->query($sql) === TRUE){
        $update = 'correcto';
        unset($_SESSION['codeVerification']);
        unset($_SESSION['codeTimeOut']); 
    }else{
        $update = 'incorrecto';
    }

    if ($conexion2->query($sql2) === TRUE){
        $update = 'correcto';
        unset($_SESSION['codeVerification']);
        unset($_SESSION['codeTimeOut']); 
    }else{
        $update = 'incorrecto';
    }

    if ($conexion2->query($sql3) === TRUE){
        $update = 'correcto';
        unset($_SESSION['codeVerification']);
        unset($_SESSION['codeTimeOut']); 
    }else{
        $update = 'incorrecto';
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();