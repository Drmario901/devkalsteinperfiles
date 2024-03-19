<?php
    require_once __DIR__ . '/../../db/conexion.php';

    $t = $_POST["consulta"];
    $consulta = "SELECT * FROM wp_k_products_add WHERE p_aid = '$t'";
    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $count = mysqli_num_rows($resultado);

    if ($count > 0){
        $name = $row["product_name"];
        $description = $row["product_description"];
        $category = $row["category"];
        $weight = $row["product_weight"];
        $stock = $row["stock"];
        $lenght = $row["product_length"];
        $width = $row["product_width"];
        $height = $row["product_height"];
        $status = $row["product_status"];
        $price = $row["product_price"];
        $image = $row["product_image"];
    }else{
        $name = ''; 
        $description = '';
        $category = '';
        $weight = '';
        $stock = ''; 
        $lenght = '';
        $width = '';
        $height = '';
        $status = '';
        $image = '';
    }
    

    $datos = array(
        'name' => $name,
        'description' => $description,
        'category' => $category,
        'weight' => $weight,
        'stock' => $stock,
        'lenght' => $lenght,
        'width' => $width,
        'height' => $height,
        'status' => $status,
        'price' => $price,
        'image' => $image
    ); 

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();