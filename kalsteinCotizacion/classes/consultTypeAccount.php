<?php
    session_start();
    require __DIR__ . '/conexion.php';

    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount'];
    }
    
    $consultar = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $row = $conexion->query($consultar)->fetch_assoc();
    $status = $row['account_rol_aid'];

    if ($status == 1){
        $txtDiscount = '';
        $percentage = 0.02;
    }else{
        $txtDiscount = 'Descuento 4% (Compra en línea): ';
        $percentage = 0.04;
    }

    $datos = array(
        'percentage' => $percentage
    );
    echo json_encode($datos);