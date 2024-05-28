<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once __DIR__ . '/../db/conexion.php';

    $id = $_POST['idAccount'];

    $sql = "SELECT * FROM wp_account WHERE account_aid = '$id'";

    $resultado = $conexion->query($sql);
    $row = mysqli_fetch_array($resultado);
    $correo = $row['account_correo'];

    $sql2 = "SELECT * FROM tienda_virtual WHERE ID_user = '$correo'";
    $resultado2 = $conexion->query($sql2);
    $row2 = mysqli_fetch_array($resultado2);
    $store = $row2['titulo_t'];

    // header('Content-Type: application/json');
    // echo json_encode($datos);

    echo json_encode([
        'store' => $store
    ]);