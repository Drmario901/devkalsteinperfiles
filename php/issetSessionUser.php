<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }else{
        $email = '';
    }

    $datos = array(
        'emailAcc' => $email
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    //$conexion->close(); 