<?php

    require __DIR__ . '/conexion.php';

    $rate = $_POST['rate'];
    $categorie = $_POST['categorie'];
    $filterP = $_POST['filterP'];

    if ($categorie == 1){
        if ($filterP == 1){
            $query = "SELECT * FROM wp_k_products";
        }elseif($filterP == 2){
            $query = "SELECT * FROM wp_k_products WHERE product_priceUSD < 500";
        }else{
            if ($filterP == 3){
                $query = "SELECT * FROM wp_k_products WHERE product_priceUSD >= 500";
            }                
        }
    }else{
        if ($filterP == 1){
            $query = "SELECT * FROM wp_k_products WHERE product_category = '$categorie'";
        }elseif($filterP == 2){
            $query = "SELECT * FROM wp_k_products WHERE product_category = '$categorie' AND product_priceUSD < 500";
        }else{
            if ($filterP == 3){
                $query = "SELECT * FROM wp_k_products WHERE product_category = '$categorie' AND product_priceUSD >= 500";
            }                
        }
    }

    $result = $conexion->query($query);

    if ($result->num_rows > 0){
        while($datos = $result->fetch_assoc()){
            $aid = $datos['product_aid'];
            $priceUSD = $datos['product_priceUSD'];
            
            $priceU = $priceUSD + $rate;
            $priceR = round($priceU, 2);
            
            $update = "UPDATE wp_k_products SET product_priceUSD = '$priceR' WHERE product_aid = '$aid'";
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