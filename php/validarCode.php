<?php
    session_start();
    require '../db/conexion.php';
    $inactividad = 600;
    if(isset($_SESSION["codeVerification"])){
        $codeSession = $_SESSION["codeVerification"];
    }
    if(isset($_SESSION["codeTimeOut"])){
        $codeTimeOut = $_SESSION["codeTimeOut"];
    }
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    $code = $_POST['consulta'];

    $sessionTTL = time() - $codeTimeOut;
    if($sessionTTL > $inactividad){
        $timer = "caducado";
        $sameCode = "nocoinciden";
        unset($_SESSION['codeVerification']);
        unset($_SESSION['codeTimeOut']);        
    }else{
        if ($code == $codeSession){
            $sameCode = "coinciden";
            $timer = "disponible";
            $update = "UPDATE wp_account SET account_status = 'validated' WHERE account_correo = '$email'";
            $conexion->query($update);
        }else{
            $timer = "disponible";
            $sameCode = "nocoinciden";
        }    
    }    

    $datos = array(
        'timer' => $timer,
        'sameCode' => $sameCode
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();