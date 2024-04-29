<?php
session_start();

require_once __DIR__ . '/../../db/conexion.php';
require __DIR__ . '/validateProductData.php';

$acc_id = $_SESSION['emailAccount'];

// obtener el tipo de membresia de wp_account

$sql = "SELECT tipo_membresia FROM wp_account WHERE account_email = '$acc_id'";

$result = $conexion->query($sql);

// si el tipo de membresia es 0 entonces puede subir maximo 5 productos, verificar cuantos productos hay subidos antes de continuar

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $membresia = $row['tipo_membresia'];
}

if ($membresia == 0) {
    $sqlCount = "SELECT COUNT(*) AS total FROM wp_k_products WHERE product_maker = '$acc_id'";
    $result = $conexion->query($sqlCount);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $total = $row['total'];
    }

    if ($total >= 5) {
        $datos['status'] = 'incorrecto';
        $datos['err_msg'] = 'No puedes subir más de 5 productos con tu membresía actual';
        echo json_encode($datos, JSON_FORCE_OBJECT);
        $conexion->close();
        //exit();
    } else {
        if ($val) {
            move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);




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

            //revisar si gibson = true
            if ($gibson == 'true') {
                //Si gibson es true entonces el precio es 25% menos
                $gibsonPrice = $pPriceUSD * 0.75;

                $query = "INSERT INTO wp_k_products
        
                (product_maker, product_brand, product_name_es, product_model, product_description_es, product_category_es, product_image,
                product_stock_units, product_stock_status,
                product_peso_neto, product_ancho, product_alto, product_largo,
                product_peso_bruto, product_ancho_paquete, product_alto_paquete, product_largo_paquete, wp_product_package_type,
                product_priceUSD, product_price_gibson, product_priceEUR, wp_product_currency,
                wp_product_discount_1, wp_product_discount_1_amount, wp_product_discount_2, wp_product_discount_2_amount,
                product_manual, product_catalog, product_catalog_name,
                product_technical_description_es, product_technical_description_csv, product_type)
                VALUES
                ('$acc_id', '$pBrand', '$pName', '$pModel', '$pDescription', '$pCategory', '$uploadName',
                '$pStock', '$pStatus',
                '$pWe', '$pWi','$pHe', '$pLe',
                '$pWePa', '$pWiPa','$pHePa', '$pLePa', '$pPType',
                '$pPriceUSD', $gibsonPrice, '$pPriceEUR', '$pCurrency',
                '$discount_1', '$discount_1_amount','$discount_2', '$discount_2_amount',
                '$newManualName', '$newCatalogName', '$wp_catalog_name',
                '$plDescription', '$plDescriptionCSV', 'sell');";
            } else {
                $query = "INSERT INTO wp_k_products
        
                (product_maker, product_brand, product_name_es, product_model, product_description_es, product_category_es, product_image,
                product_stock_units, product_stock_status,
                product_peso_neto, product_ancho, product_alto, product_largo,
                product_peso_bruto, product_ancho_paquete, product_alto_paquete, product_largo_paquete, wp_product_package_type,
                product_priceUSD, product_priceEUR, wp_product_currency,
                wp_product_discount_1, wp_product_discount_1_amount, wp_product_discount_2, wp_product_discount_2_amount,
                product_manual, product_catalog, product_catalog_name,
                product_technical_description_es, product_technical_description_csv, product_type)
                VALUES
                ('$acc_id', '$pBrand', '$pName', '$pModel', '$pDescription', '$pCategory', '$uploadName',
                '$pStock', '$pStatus',
                '$pWe', '$pWi','$pHe', '$pLe',
                '$pWePa', '$pWiPa','$pHePa', '$pLePa', '$pPType',
                '$pPriceUSD', '$pPriceEUR', '$pCurrency',
                '$discount_1', '$discount_1_amount','$discount_2', '$discount_2_amount',
                '$newManualName', '$newCatalogName', '$wp_catalog_name',
                '$plDescription', '$plDescriptionCSV', 'sell');";
            }


            $result = $conexion->query($query);

            if ($result === TRUE) {
                $datos['status'] = 'correcto';
            } else {
                $datos['status'] = 'incorrecto';
            }

            $datos['err_msg'] = false;

            $k_product_id = $conexion->insert_id;

            if ($catalog != '') {
                /* $randomFileName = uniqid() . '.jpg';
             
                 $thumbnailPath = '/home/he270716/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/catalogs/thumbnails/' . $randomFileName;*/

                $query2 = "INSERT INTO wp_catalogs_es
                    (catalog_name_es, catalog_maker, catalog_category_es, catalog_model, catalog_image,  catalog_pdf) VALUES
                    ('$wp_catalog_name', '$acc_id', '$pCategory', '$pModel', 'Icon_pdf.png', '$newCatalogName');";
                $result2 = $conexion->query($query2);

                /* move_uploaded_file($pdfPath, $newCatalogName);
             
                 $imagick = new Imagick($newCatalogName . '[0]'); 
             
                 $imagick->thumbnailImage(300, 300);
             
                 $imagick->writeImage($thumbnailPath);
             
                 
                 $imagick->clear();
                 $imagick->destroy();*/
            }




            if ($manual != '') {
                $query2 = "INSERT INTO wp_manuales
                    (M_nombre_product,   M_maker,   M_category,   M_model, M_pdf) VALUES
                    ('$wp_manual_name'  , '$acc_id', '$pCategory', '$pModel', '$newManualName');";
                $result2 = $conexion->query($query2);

                move_uploaded_file($_FILES['manual']['tmp_name'], $uploadManualFile);
            }

            if ($datos['status'] == 'correcto') {
                include __DIR__ . '/accesories/uploadProductData.php';
            }

            // --- WOOCOMERCE ---
            $post_name = urlencode(uniqid() . "-" . $pName);
            $post_name = str_replace('+', '-', strtolower($post_name));
            $post_name = urlencode($post_name);
            $post_name = str_replace('--', '-', strtolower($post_name));
            $post_name = str_replace('---', '-', strtolower($post_name));

            $excerpt = "<strong>Manufacturer</strong>: <em>$pBrand</em><img class=\"alignnone size-full wp-image-29784\" src=\"https://dev.kalstein.plus/plataforma/wp-content/uploads/2022/04/CE.jpg\" alt=\"\" width=\"54\" height=\"53\" />";
            $hidden_input = "<input id=\"woocomerce-kalsteinplus-identifier\" type=\"hidden\" data-model=\"$pModel\">";

            $sql = "INSERT INTO wp_posts 
                        (post_author, post_date, post_date_gmt, post_content, post_title, post_excerpt, post_status, post_type, post_name)
                        VALUES
                        (1,NOW(),NOW(), '$hidden_input $pDescription <table>$plDescription</table>','$pName','$excerpt','draft','product', '$post_name')";

            $sqlr = $conexion->query($sql);
            $product_idwoo = $conexion->insert_id;

            $datos['extra'] = $sqlr != false;

            // Insertar precio        
            $sql2 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value) 
                            VALUES ($product_idwoo, '_regular_price', $pPriceUSD)";

            $conexion->query($sql2);

            // Insertar categoría
            $sql3 = "INSERT INTO wp_term_relationships (object_id, term_taxonomy_id)
                        SELECT $product_idwoo, term_taxonomy_id 
                        FROM wp_term_taxonomy
                        WHERE taxonomy = 'product_cat' AND term_id = (
                        SELECT term_id FROM wp_terms WHERE slug = 'autoclaves'
                        )";

            $conexion->query($sql3);

            // Insertar imágenes...

            // Ruta de la imagen destacada
            $image_file = $uploadName;

            // Insertar imagen destacada
            $sql4 = "INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_title, post_mime_type, post_status, post_type, guid)  
                                        VALUES (1,NOW(),NOW(),'$newName','image/jpeg','inherit','attachment', '$uploadName')";

            $conexion->query($sql4);
            $image_id = $conexion->insert_id;

            // Asociar imagen destacada al producto
            $sql5 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
                                        VALUES ($product_idwoo, '_thumbnail_id', $image_id)";

            $conexion->query($sql5);

            // Ruta de la galería de imágenes 
            $gallery_image = 'https://dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/';

            /*// Insertar imagen de galería
            $sql6 = "INSERT INTO wp_posts (post_author, post_date, post_date_gmt, post_title, post_mime_type, post_status, post_type)  
                                    VALUES (1,NOW(),NOW(),'$newName','image/jpeg','inherit','attachment')";
    
            $conexion->query($sql6);
            $gallery_id = $conexion->insert_id;
    
            // Asociar galería de imágenes
            $sql7 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
                                    VALUES ($product_id, '_product_image_gallery', $gallery_id)";
    
            $conexion->query($sql7);*/

            $image_path = $newName;
            $sql7 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
                        VALUES ($image_id, '_wp_attached_file', '$uploadName')";


            $conexion->query($sql7);

            // Guardar la ruta de la imagen destacada en el campo _wp_attached_file
            $image_path = $newName;
            $sql8 = "INSERT INTO wp_postmeta (post_id, meta_key, meta_value)
                        VALUES ($image_id, '_wc_attachment_source', '$uploadName')";

            $conexion->query($sql8);

            // Regenerar miniaturas
            $sql9 = "UPDATE wp_posts SET post_modified = NOW() WHERE ID = $product_idwoo";

            $conexion->query($sql9);

            //insertar ID tabla wp_products_id_woo

            $query = "INSERT INTO wp_product_id_woo(product_id, woo_id) VALUES ('$k_product_id', '$product_idwoo')";
            $conexion->query($query);


            /*echo $sql.'
            ';
            echo $sql2.'
            ';
            echo $sql3.'
    ';
            echo $sql4.'
    ';
            echo $sql5.'
    ';
            echo $sql9.'
    ';*/

        }

        echo json_encode($datos, JSON_FORCE_OBJECT);
        $conexion->close();
    }
}

?>