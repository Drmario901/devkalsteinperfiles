<?php

    require __DIR__ . '/conexion.php';

    $percentage = $_POST['percentage'];
    $percentage = "0.".$percentage;
    $categorie = $_POST['categorie'];

    if ($categorie === 1){
        $query = "SELECT * FROM wp_k_products";
    }else{
        $query = "SELECT * FROM wp_k_products WHERE product_category = '$categorie'";
    }

    $result = $conexion->query($query);

    if ($result->num_rows > 0){
        while($datos = $result->fetch_assoc()){
            $aid = $datos['product_aid'];
            $priceUSD = $datos['product_priceUSD'];
            
            $priceU = $priceUSD * $percentage;
            $priceR = round($priceU, 2);
            $priceF = $priceUSD + $priceR;
            $priceFR = round($priceF, 2);
            
            $update = "UPDATE wp_k_products SET product_priceUSD = '$priceFR' WHERE product_aid = '$aid'";
            $conexion->query($update);
        }

        $update = 'correcto';
    }else{
        $update = 'incorrecto';
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();