<?php
    session_start();
    require __DIR__ .'/conexion.php';

    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount'];
    }

    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $row = $conexion->query($consulta)->fetch_assoc();
    $direccion = $row['account_direccion'] ?? '';
    $ciudad = $row['account_ciudad'] ?? '';
    $pais = $row['account_pais'] ?? '';
    $zipcode = $row['account_zipcode'] ?? '';

    $data = array(
        'direccion' => $direccion,
        'ciudad' => $ciudad, 
        'pais' => $pais, 
        'zipcode' => $zipcode
    );

    echo json_encode($data);
