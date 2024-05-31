<?php
    require_once __DIR__ . '/../db/conexion.php';

    $sql = "SELECT * FROM wp_guides WHERE guide_status_id = '1'";

    $resultado = $conexion->query($sql);

    $datos = [];
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    }
    // header('Content-Type: application/json');
    // echo json_encode($datos);

    echo json_encode([
        'datos' => $datos
    ]);