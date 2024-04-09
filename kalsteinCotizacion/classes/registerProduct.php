<?php

    require dirname(__FILE__) . '/conexion.php';

    $model = $_POST['model'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $netWeight = $_POST['netWeight'];
    $grossWeight = $_POST['grossWeight'];
    $long = $_POST['long'];
    $width = $_POST['width'];
    $height = $_POST['height'];
    $long1 = $_POST['long1'];
    $width1 = $_POST['width1'];
    $height1 = $_POST['height1'];

    $sql = "SELECT * FROM wp_products WHERE product_model = '$model'";
	$resultConsulta = $conexion->query($sql);
	$count = mysqli_num_rows($resultConsulta);

    if ($count > 0){
        $register = 'exists';
    }else{
        $sql = "INSERT INTO wp_products(product_aid, product_name, product_model, product_peso_neto, product_peso_bruto, product_alto, product_ancho, product_largo, product_alto_paquete, product_ancho_paquete, product_largo_paquete, product_price, product_create_at) VALUES ('', '$name', '$model', '$netWeight', '$grossWeight', '$height', '$width', '$long', '$height1', '$width1', '$long1', '$price', CURRENT_TIMESTAMP)";
        if ($conexion->query($sql) === TRUE){
            $register = 'correcto';
        }else{
            $register = 'incorrecto';
        }
    }

    $datos = array(
        'register' => $register
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();

?>