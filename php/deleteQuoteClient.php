<?php   
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require __DIR__ . '../db/conexion.php';

    $id = $_POST['consulta'];

    $consulta = "DELETE FROM wp_cotizacion WHERE cotizacion_id = '$id'";

    if ($conexion->query($consulta) === TRUE){
        $consulta2 = "DELETE FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$id'";
        $conexion->query($consulta2);
        $registerUpdate = "INSERT INTO wp_register_deletes(aid_deletes, account_id, deletes_date, deletes_description) VALUES ('', '$email', CURRENT_TIMESTAMP, 'QUO$id has been deleted')";
        $conexion->query($registerUpdate);
        $delete = 'correcto';
    }else{
        $delete = 'incorrecto';
    }

    $datos = array(
        'delete' => $delete
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();