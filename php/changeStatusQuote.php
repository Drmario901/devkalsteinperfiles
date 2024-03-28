<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once __DIR__ . '/../db/conexion.php';

// Debes asegurarte de que estás recibiendo los datos 'consulta' y 'consulta2' y validarlos.
if (!isset($_POST['consulta'], $_POST['consulta2'])) {
    exit('Los datos necesarios no están presentes.');
}

    $consulta = $_POST['consulta'];
    $id = $_POST['consulta2'];

    $consulta = $consulta == 'Pending' ? '0' : $consulta;
    $consulta = $consulta == 'Process' ? '1' : $consulta;
    $consulta = $consulta == 'Cancel' ? '2' : $consulta;

    $query = "UPDATE wp_cotizacion SET cotizacion_status = '$consulta' WHERE cotizacion_id = '$id'";
    if ($conexion->query($query) === TRUE){
        $registerUpdate = "INSERT INTO wp_register_updates(aid_updates, account_id, updates_date, update_description) VALUES ('', '$email', CURRENT_TIMESTAMP, 'The status of QUO$id was changed')";
        $conexion->query($registerUpdate);
        $update = 'correcto';
    }else{
        $update = 'correcto';
    }
    
    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();