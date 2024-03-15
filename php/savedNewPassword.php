<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }
    require __DIR__ . '/conexion.php';

    $currentPassword = $_POST['currentPassword'];
    $currentPasswordEncrypt = md5($currentPassword);
    $confirmPassword = $_POST['confirmPassword'];
    $confirmPasswordEncrypt = md5($confirmPassword);

    $queryAcc = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $result= $conexion->query($queryAcc);
    $row = mysqli_fetch_array($result);
    $password = $row[2];

    if ($currentPasswordEncrypt != $password){
        $update = 'nocoinciden';
    }else{
        $update = "UPDATE wp_account SET account_contraseña = '$confirmPasswordEncrypt' WHERE account_correo = '$email'";
        if ($conexion->query($update) === TRUE){
            $registerUpdate = "INSERT INTO wp_register_updates(aid_updates, account_id, updates_date, update_description) VALUES ('', '$email', CURRENT_TIMESTAMP, 'Password has been updated')";
            $conexion->query($registerUpdate);
            $update = 'correcto';
        }else{
            $update = 'incorrecto';
        }
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();
