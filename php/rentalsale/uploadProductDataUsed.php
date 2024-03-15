<?php
session_start();
require __DIR__ . '/../conexion.php';
require __DIR__ . '/validateProductDataUsed.php';

if ($val === true) {
    // Mover el archivo de imagen a la ubicación deseada
    move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);

    // Obtener la cuenta actual del usuario
    $acc_id = $_SESSION['emailAccount'];

    // Consultar la base de datos para obtener el nombre de la marca
    $b = $conexion->query("SELECT company_nombre FROM wp_company WHERE company_account_correo = '$acc_id'");
    $brand = $b->fetch_assoc()['company_nombre'];

    // Realizar conversiones de precios si es necesario
    if ($pCurrency == 'EUR') {
        $pPriceEUR = $pPrice;
        $pPriceUSD = $pPrice * 1.18;
    } else if ($pCurrency == 'USD') {
        $pPriceEUR = $pPrice / 1.18;
        $pPriceUSD = $pPrice;
    }

    // Lógica para manejar descuentos
    if ($discount_1_amount == '' || $discount_1_amount == 0) {
        $discount_1_amount = '';
        $discount_1 = '';
    }
    if ($discount_2_amount == '' || $discount_2_amount == 0) {
        $discount_2_amount = '';
        $discount_2 = '';
    }

    // Definir el tipo de producto
    $type = 'Used';

    // Construir la consulta SQL para insertar el producto en la tabla wp_k_products
    $query = "INSERT INTO wp_k_products
        (product_maker, product_brand, product_name_en, product_model, product_condition, product_description, product_category, product_image,
        product_stock_units, product_stock_status,
        product_peso_neto, product_ancho, product_alto, product_largo,
        product_peso_bruto, product_ancho_paquete, product_alto_paquete, product_largo_paquete, wp_product_package_type,
        product_priceUSD, product_priceEUR, wp_product_currency,
        product_manual, product_catalog, product_catalog_name,
        product_technical_description, product_technical_description_csv, product_type)
        VALUES
        ('$acc_id', '$brand', '$pName', '$pCondition', '$pModel', '$pDescription', '$pCategory', '$uploadName',
        '$pStock', '$pStatus',
        '$pWe', '$pWi','$pHe', '$pLe',
        '$pWePa', '$pWiPa','$pHePa', '$pLePa', '$pPType',
        '$pPriceUSD', '$pPriceEUR', '$pCurrency',
        '$newManualName', '$newCatalogName' ,'$wp_catalog_name' ,'$plDescription' ,'$plDescriptionCSV' ,'$type')";

    // Ejecutar la consulta
    $result = $conexion->query($query);

    if ($result === TRUE) {
        $datos['status'] = 'correcto';
    } else {
        $datos['status'] = 'incorrecto';
    }

    $datos['err_msg'] = false;

    // Obtener el ID del producto recién insertado
    $k_product_id = $conexion->insert_id;

    // Consultar información adicional del usuario
    $queryUser = "SELECT account_nombre, account_apellido FROM wp_account WHERE account_correo = '$acc_id'";
    $resultUser = $conexion->query($queryUser)->fetch_assoc();

    $nombre = $resultUser['account_nombre'];
    $apellido = $resultUser['account_apellido'];

    // Construir información relacionada con el producto para insertar en wp_posts
    $post_author = $nombre . " " . $apellido;
    $post_status = $pStatus == 'in stock' ? 'publish' : '';
    $post_content = $pDescription;
    $post_name = uniqid() . "-" . $pName;
    $guid = $uploadName;

    // Construir la consulta SQL para insertar en wp_posts
    $queryPost = "INSERT INTO wp_posts (post_author, post_status, post_content, post_name, post_type, comment_status, ping_status, guid) VALUES
                    ('1', '$post_status', '$post_content', '$post_name', 'product', 'open', 'closed', '$guid')";
    $resultPost = $conexion->query($queryPost);

    // Verificar si se cargó un archivo de catálogo y manejarlo si es necesario
    if ($catalog != '') {
        $query2 = "INSERT INTO wp_catalogs
            (catalog_name, catalog_maker, catalog_category, catalog_model, catalog_pdf) VALUES
            ('$wp_catalog_name', '$acc_id', '$pCategory', '$pModel', '$newCatalogName');";
        $result2 = $conexion->query($query2);

        move_uploaded_file($_FILES['catalog']['tmp_name'], $uploadCatalogFile);
    }

    // Verificar si se cargó un archivo manual y manejarlo si es necesario
    if ($manual != '') {
        $query2 = "INSERT INTO wp_manuales
            (M_nombre_product, M_maker, M_category, M_model, M_pdf) VALUES
            ('$wp_manual_name', '$acc_id', '$pCategory', '$pModel', '$newManualName');";
        $result2 = $conexion->query($query2);

        move_uploaded_file($_FILES['manual']['tmp_name'], $uploadManualFile);
    }

}

// Devolver respuesta como JSON
echo json_encode($datos, JSON_FORCE_OBJECT);

// Cerrar la conexión a la base de datos
$conexion->close();
?>
