<?php
    require_once __DIR__ . '/../db/conexion.php';

    $aid_art = $_POST['id'];
    $sql = "SELECT * FROM wp_art_blog WHERE id_status = '1' AND art_id = '$aid_art'";
    $sql2 = "SELECT * FROM wp_art_details WHERE art_id = '$aid_art'";

    $resultado = $conexion->query($sql);
    $resultado2 = $conexion->query($sql2);

    $datos = [];
    $datos2 = [];
    if ($resultado->num_rows > 0) {
        while($fila = $resultado->fetch_assoc()) {
            $datos[] = $fila;
        }
    }

    if ($resultado2->num_rows > 0) {
        while($fila2 = $resultado2->fetch_assoc()) {
            $datos2[] = $fila2;
        }
    }
    // header('Content-Type: application/json');
    // echo json_encode($datos);

    echo json_encode([
        'datos' => $datos,
        'datosDetails' => $datos2
    ]);