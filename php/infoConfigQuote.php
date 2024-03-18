<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require '../db/conexion.php';

    $warehouse = $_POST['warehouse'];
    $currency = $_POST['currency'];
    $paymentM = $_POST['paymentM'];
    $shippingM = $_POST['shippingM'];
    $destination = $_POST['destination'];
    $zipcode = $_POST['zipcode'];

    $consulta = "SELECT * FROM wp_config_quote WHERE id_account = '$email'";
    $resultado = $conexion->query($consulta);
    $count = mysqli_num_rows($resultado);

    if ($count > 0){
        $update = "UPDATE wp_config_quote SET config_quote_warehouse = '$warehouse', config_quote_coin = '$currency', config_quote_payment_method = '$paymentM', config_quote_shipping_method = '$shippingM', config_quote_destination = '$destination', config_quote_zipcode = '$zipcode' WHERE id_account = '$email'";
        if ($conexion->query($update) === TRUE){
            $update = 'correcto';
        }else{
            $update = 'incorrecto';
        }
    }else{
        $register = "INSERT INTO wp_config_quote(aid_config_quote, id_account, config_quote_warehouse, config_quote_coin, config_quote_payment_method, config_quote_shipping_method, config_quote_destination, config_quote_zipcode) VALUES ('', '$email', '$warehouse', '$currency', '$paymentM', '$shippingM', '$destination', '$zipcode')";
        if ($conexion->query($register) === TRUE){
            $update = 'correcto';
        }else{
            $update = 'incorrecto';
        }
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();
?>