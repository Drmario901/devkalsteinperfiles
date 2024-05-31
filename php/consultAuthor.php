<?php
    require_once __DIR__ . '/../db/conexion.php';

    $id = $_POST['idAccount'];

    $sql = "SELECT * FROM wp_account WHERE account_aid = '$id'";

    $resultado = $conexion->query($sql);
    $row = mysqli_fetch_array($resultado);
    $correo = $row['account_correo'];

    $sql2 = "SELECT * FROM tienda_virtual WHERE ID_user = '$correo'";
    $resultado2 = $conexion->query($sql2);
    $row2 = mysqli_fetch_array($resultado2);
    $store = $row2[2] ?? 'No tiene tienda';
    $slug = $row2[19] ?? '';


    // header('Content-Type: application/json');
    // echo json_encode($datos);

    echo json_encode([
        'store' => $store,
        'slug' => $slug
    ]);