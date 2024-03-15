<?php
session_start();
require __DIR__ . '../../db/conexion.php';
require __DIR__ . '/validateProductData.php';

if ($val === true) {
    move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);

    $acc_id = $_SESSION['emailAccount'];

    $b = $conexion->query("SELECT company_nombre FROM wp_company WHERE company_account_correo = '$acc_id'");
    $brand = $b->fetch_assoc()['company_nombre'];

    if ($pCurrency == 'EUR') {
        $pPriceEUR = $pPrice;
        $pPriceUSD = $pPrice * 1.18;
    } else if ($pCurrency == 'USD') {
        $pPriceEUR = $pPrice / 1.18;
        $pPriceUSD = $pPrice;
    }

    if ($discount_1_amount == '' || $discount_1_amount == 0) {
        $discount_1_amount = '';
        $discount_1 = '';
    }
    if ($discount_2_amount == '' || $discount_2_amount == 0) {
        $discount_2_amount = '';
        $discount_2 = '';
    }

    $type = 'Rental';
    $query = "INSERT INTO wp_k_products
        (product_maker, product_brand, product_name_en, product_model, product_description, product_category, product_image,
        product_stock_units, product_stock_status,
        product_peso_neto, product_ancho, product_alto, product_largo,
        product_peso_bruto, product_ancho_paquete, product_alto_paquete, product_largo_paquete, wp_product_package_type,
        product_priceUSD, product_priceEUR, wp_product_currency,
        product_manual, product_catalog, product_catalog_name,
        product_technical_description, product_technical_description_csv, product_rental_time, product_type)
        VALUES
        ('$acc_id', '$brand', '$pName', '$pModel', '$pDescription', '$pCategory', '$uploadName',
        '$pStock', '$pStatus',
        '$pWe', '$pWi','$pHe', '$pLe',
        '$pWePa', '$pWiPa','$pHePa', '$pLePa', '$pPType',
        '$pPriceUSD', '$pPriceEUR', '$pCurrency',
        '$newManualName', '$newCatalogName' ,'$wp_catalog_name' ,'$plDescription' ,'$plDescriptionCSV' ,'$pRentalTime', '$type');";

    $result = $conexion->query($query);

    if ($result === TRUE) {
        $datos['status'] = 'correcto';
    } else {
        $datos['status'] = 'incorrecto';
    }

    $datos['err_msg'] = false;

    $k_product_id = $conexion->insert_id;

    $queryUser = "SELECT account_nombre, account_apellido FROM wp_account WHERE account_correo = '$acc_id'";
    $resultUser = $conexion->query($queryUser)->fetch_assoc();

    $nombre = $resultUser['account_nombre'];
    $apellido = $resultUser['account_apellido'];

    $post_author = $nombre . " " . $apellido;
    $post_status = $pStatus == 'in stock' ? 'publish' : '';
    $post_content = $pDescription;
    $post_name = uniqid() . "-" . $pName;
    $guid = $uploadName;

    $queryPost = "INSERT INTO wp_posts (post_author, post_status, post_content, post_name, post_type, comment_status, ping_status, guid) VALUES
                    ('1', 'publish', '$post_content', '$post_name', 'product', 'open', 'closed', '$guid')";
    $resultPost = $conexion->query($queryPost);

    if ($catalog != '') {
        $query2 = "INSERT INTO wp_catalogs
            (catalog_name, catalog_maker, catalog_category, catalog_model, catalog_pdf) VALUES
            ('$wp_catalog_name', '$acc_id', '$pCategory', '$pModel', '$newCatalogName');";
        $result2 = $conexion->query($query2);

        move_uploaded_file($_FILES['catalog']['tmp_name'], $uploadCatalogFile);
    }

    if ($manual != '') {
        $query2 = "INSERT INTO wp_manuales
            (M_nombre_product, M_maker, M_category, M_model, M_pdf) VALUES
            ('$wp_manual_name', '$acc_id', '$pCategory', '$pModel', '$newManualName');";
        $result2 = $conexion->query($query2);

        move_uploaded_file($_FILES['manual']['tmp_name'], $uploadManualFile);
    }

    // WooCommerce
    $post_name = urlencode(uniqid() . "-" . $pName);
    $post_name = str_replace('+', '-', strtolower($post_name));

    $sql = "INSERT INTO wp_posts 
                (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, post_type, post_name)  
                VALUES
                (1, NOW(), NOW(), '$pDescription', '$pName', '$brand', 'draft', 'product', '$post_name')";

    $conexion->query($sql);
    $product_id = $conexion->insert_id;

    // Insertar precio
    $sql2 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value) 
                    VALUES ($product_id,'_regular_price',$pPriceUSD)";

    $conexion->query($sql2);

    // Insertar categoría
    $sql3 = "INSERT INTO wp_term_relationships (object_id, term_taxonomy_id)
                SELECT $product_id, term_taxonomy_id 
                FROM wp_term_taxonomy
                WHERE taxonomy = 'product_cat' AND term_id = (
                SELECT term_id FROM wp_terms WHERE slug = '$pCategory'
                )";

    $conexion->query($sql3);

    // Insertar imágenes...

    // Ruta de la imagen destacada
    $image_file = $uploadName;

    // Insertar imagen destacada
    $sql4 = "INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_title, post_mime_type, post_status, post_type)  
                                VALUES (1, NOW(), NOW(), '$newName', 'image/jpeg', 'inherit', 'attachment')";

    $conexion->query($sql4);
    $image_id = $conexion->insert_id;

    // Asociar imagen destacada al producto
    $sql5 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
                                VALUES ($product_id, '_thumbnail_id', $image_id)";

    $conexion->query($sql5);

    // Ruta de la galería de imágenes
    $gallery_image = 'https://testing.kalstein.digital/wp-content/uploads/kalsteinQuote/';

    // Insertar imagen de galería
    $sql6 = "INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_title, post_mime_type, post_status, post_type)  
                                VALUES (1, NOW(), NOW(), '$newName', 'image/jpeg', 'inherit', 'attachment')";

    $conexion->query($sql6);
    $gallery_id = $conexion->insert_id;

    // Asociar galería de imágenes
    $sql7 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
                                VALUES ($product_id, '_product_image_gallery', $gallery_id)";

    $conexion->query($sql7);

    // Guardar la ruta de la imagen destacada en el campo _wp_attached_file
    $image_path = $uploadName;
    $sql8 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
                VALUES ($image_id, '_wp_attached_file', '$image_path')";

    $conexion->query($sql8);

    // Regenerar miniaturas
    $sql9 = "UPDATE wp_posts SET post_modified = NOW() WHERE ID = $product_id";

    $conexion->query($sql9);

    // Insertar ID en la tabla wp_products_id_woo
    $query = "INSERT INTO wp_product_id_woo(product_id, woo_id) VALUES ('$k_product_id', '$product_id')";
    $conexion->query($query);
}

echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();
