<?php
    require_once __DIR__ . '/../db/conexion.php';

    $sql = "SELECT * FROM wp_art_blog WHERE id_status = '1'";

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