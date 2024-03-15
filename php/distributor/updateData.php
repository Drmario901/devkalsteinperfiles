<?php
require __DIR__ . '/../conexion.php';

$t = $_POST['id'];
$pName = $_POST['name'];
$pDescription = $_POST['description'];
$pCategory = $_POST['category'];
$pWe = $_POST['we'];
$pStock = $_POST['stock'];
$pLe = $_POST['le'];
$pWi = $_POST['wi'];
$pHe = $_POST['he'];
$pPrice = $_POST['price'];
$pStatus = $_POST['status'];

if (!empty($_FILES['fileName']['name'])) {
    $fileName = $_FILES['fileName']['name'];
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newName = uniqid() . "." . $extension;

    $path = __DIR__ . '/../src/images/upload/';
    $uploadFile = $path . basename($newName);

    move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);
    $updateImage = ", product_image = '$newName'";
} else {
    $updateImage = "";
}

$query = "UPDATE wp_k_products_add SET
    product_name = '$pName',
    product_description = '$pDescription',
    category = '$pCategory',
    product_weight = '$pWe',
    stock = '$pStock',
    product_length = '$pLe',
    product_width = '$pWi',
    product_height = '$pHe',
    product_status = '$pStatus',
    product_price = '$pPrice'
    $updateImage
    WHERE p_aid = '$t'";

if ($conexion->query($query) === TRUE) {
    $datos['status'] = 'correcto';
} else {
    $datos['status'] = 'incorrecto';
}

echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();
