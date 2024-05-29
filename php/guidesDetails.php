<?php
    require_once __DIR__ . '/../db/conexion.php';

    $id = $_POST['idAccount'];

    $sql = "SELECT * FROM wp_guides_details WHERE guide_id = '$id'";

    $resultado = $conexion->query($sql);
    $row = mysqli_fetch_array($resultado);
    $image = $row['guide_img_url'];
    $description = $row['guide_description'];
    $aidProduct = $row['guide_product_id'];

    $sql2 = "SELECT * FROM wp_k_products WHERE product_aid = '$aidProduct'";
    $resultado2 = $conexion->query($sql2);
    $row2 = mysqli_fetch_array($resultado2);
    $categorie = $row2['product_category_es'];


    // header('Content-Type: application/json');
    // echo json_encode($datos);

    echo json_encode([
        'image' => $image,
        'description' => $description,
        'categorie' => $categorie
    ]);