<?php
    require_once __DIR__ . '/../../db/conexion.php';

    $idQuote = $_POST['cotizacion_id'];
    $status = $_POST['cotizacion_status'];

    $updateData = "UPDATE wp_cotizacion SET cotizacion_status = '$status' WHERE cotizacion_id='$idQuote'";
    if ($conexion->query($updateData) === TRUE){
        $update = 'correcto';
    }else{
        $update = 'incorrecto';
    }

    $data = array(
        'update' => $update
    );

    echo json_encode($data);
?>
