<?php

    require __DIR__ . '/conexion.php';

    $model = $_POST['model'];
    $name = $_POST['name'];
    $netWeight = $_POST['netWeight'];
    $grossWeight = $_POST['grossWeight'];  
    $height = $_POST['height'];
    $width = $_POST['width'];
    $long = $_POST['long'];
    $height1 = $_POST['height1'];
    $width1 = $_POST['width1'];
    $long1 = $_POST['long1']; 
    $priceUSD = $_POST['priceUSD'];
    $priceEUR = $_POST['priceEUR'];

    $update = "UPDATE wp_k_products SET product_name = '$name', product_peso_neto = '$netWeight', product_peso_bruto = '$grossWeight', product_alto = '$height', product_ancho = '$width', product_largo = '$long', product_alto_paquete = '$height1', product_ancho_paquete = '$width1', product_largo_paquete = '$long1', product_priceUSD = '$priceUSD', product_priceEUR = '$priceEUR' WHERE product_model = '$model'";   

    if ($conexion->query($update) === TRUE) {
        $update = 'correcto';
    }else{
        $update = 'incorrecto';
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();
?>