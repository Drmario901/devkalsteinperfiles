<?php
    require_once __DIR__ . '/../db/conexion.php';

    $sql = "SELECT * FROM wp_art_blog";
    $sql2 = "SELECT * FROM wp_account";

    $resultado = $conexion->query($sql);
    $resultado2 = $conexion->query($sql2);

    $datos = [];
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    }

    $datos2 = [];
    if ($resultado2->num_rows > 0) {
        while($fila2 = $resultado2->fetch_assoc()) {
            $datos2[] = $fila2;
        }
    }
    // header('Content-Type: application/json');
    // echo json_encode($datos);

    echo json_encode([
        'datos' => $datos
    ]);