<?php
session_start(); 
if (isset($_SESSION['emailAccount'])){
    $acc_id = $_SESSION['account_id'];
}
require __DIR__ . '../../db/conexion.php';
require __DIR__.'/validateProductData.php';

if ($val){
    move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);
    $type = 'Rental'; 

    echo $query = "INSERT INTO wp_products
    (product_maker, brand, name, model, description, category, image,
    stock_units, stock_status,
    weigth, width, height, length,
    weigth_packed, width_packed, height_packed, length_packed, package_type,
    price, currency, product_rental_time, product_type)
    VALUES
    ('$acc_id', '$pBrand', '$pName', '$pModel', '$pDescription', '$pCategory', '$newName',
    '$pStock', '$pStatus',
    '$pWe', '$pWi','$pHe', '$pLe',
    '$pWePa', '$pWiPa','$pHePa', '$pLePa', '$pPType',
    '$pPrice', '$pCurrency', '$pRentalTime', '$type');"; 

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
    $datos['err_msg'] = $val;

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();
}
?>
