<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once '/conexion.php';

    $consulta = "SELECT * FROM wp_config_quote WHERE id_account = '$email'";
    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $count = mysqli_num_rows($resultado);

    if ($count > 0){
        $warehouse = $row[2];
        $currency = $row[3];
        $paymentM = $row[4];
        $shippingM = $row[5];
        $destination = $row[6];
        $zipcode = $row[7];
    }else{
        $warehouse = 0;
        $currency = 0;
        $paymentM = 0;
        $shippingM = 0;
        $destination = 0;
        $zipcode = '';
    }

    $datos = array(
        'warehouse' => $warehouse,
        'currency' => $currency,
        'paymentM' => $paymentM,
        'shippingM' => $shippingM,
        'destination' => $destination,
        'zipcode' => $zipcode
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();