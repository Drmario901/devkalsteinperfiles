<?php
session_start(); 
if (isset($_SESSION['emailAccount'])){
    $acc_id = $_SESSION['account_id'];
}
    require __DIR__ . '/conexion.php';

    require __DIR__.'/validateProductData.php';

    if ($val){

        move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);

        $brand = $_POST['brand'];
        
        $query = "INSERT INTO wp_products
        (product_maker, brand, name, model, description, category, image,
        stock_units, stock_status,
        weigth, width, height, length,
        weigth_packed, width_packed, height_packed, length_packed, package_type,
        price, currency,
        discount_1, discount_1_amount, discount_2, discount_2_amount)
        VALUES
        ('$acc_id', '$brand', '$pName', '$pModel', '$pDescription', '$pCategory', '$newName',
        '$pStock', '$pStatus',
        '$pWe', '$pWi','$pHe', '$pLe',
        '$pWePa', '$pWiPa','$pHePa', '$pLePa', '$pPType',
        '$pPrice', '$pCurrency',
        '$discount_1', '$discount_1_amount','$discount_2', '$discount_2_amount');";

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
