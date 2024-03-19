<?php
    require_once __DIR__ . '/../../db/conexion.php';

    $id = /*$_SESSION['id']*/ 1;

    $country      = $_POST['country'];
    $aerial_we    = $_POST['aerial_we'];
    $aerial_pr    = $_POST['aerial_pr'];
    $maritimal_pr = $_POST['maritimal_pr'];

    $err_msg = '';

    if ($country == '') {
        $err_msg = 'Country empty';
    }
    else if ($aerial_we == '') {
        $err_msg = 'Aerial weigth empty';
    }
    else if ($aerial_pr == '') {
        $err_msg = 'Aerial price empty';
    }
    else if ($maritimal_pr == '') {
        $err_msg = 'Maritimal price empty';
    }
    // negative verification
    else if (floatval($aerial_we) <= 0) {
        $err_msg = 'Aerial weigth cannot be less than 0';
    }
    else if (floatval($aerial_pr) <= 0) {
        $err_msg = 'Aerial price cannot be less than 0';
    }
    else if (floatval($maritimal_pr) <= 0) {
        $err_msg = 'Maritimal cannot be less than 0';
    }

    if ($err_msg == '') {

        $datos = array();

        $query = "SELECT COUNT(*) FROM wp_shipping_costs WHERE account_id = '$id' AND country_id = $country";
        $result = $conexion->query($query);
    
        if($result->fetch_array()[0] > 0){
            $query = "UPDATE wp_shipping_costs SET account_id='$id', country_id='$country', aerial_weigth='$aerial_we', aerial_price='$aerial_pr', maritimal='$maritimal_pr'
            WHERE account_id = '$id' AND country_id = $country";
        }
        else {
            $query = "INSERT INTO wp_shipping_costs(account_id, country_id, aerial_weigth, aerial_price, maritimal) VALUES ('$id','$country','$aerial_we','$aerial_pr','$maritimal_pr')"; 
        }

        if ($conexion->query($query) === TRUE) {
            $datos['status'] = 'correcto';
        }
        else {
            $datos['status'] = 'incorrecto';
        }

        $datos['err_msg'] = false;
        
        echo json_encode($datos, JSON_FORCE_OBJECT);
        $conexion->close();
    }
    else{
        $datos['err_msg'] = $err_msg;

        echo json_encode($datos, JSON_FORCE_OBJECT);
        $conexion->close();
    }
?>
