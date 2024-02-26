<?php

    $accessoryData = json_decode($accessoryData, true);

    foreach ($accessoryData as $key => $acc) {
        $accessoryData[$key]['attachedFile'] = $_FILES['accessoryFiles-'.$acc['card_id']];
    }


    $datos['uploadedAcc'] = [];

    foreach ($accessoryData as $key => $acc) {

        if ($acc['attachedFile'] != NULL){
            $fileAcc = $acc['attachedFile'];
    
            $fileNameAcc = $fileAcc['name'];                                 // my_image.png
            $extensionAcc = pathinfo($fileNameAcc, PATHINFO_EXTENSION);      // .png
            $newNameAcc = uniqid().".".$extensionAcc;                        // 64asd55645.png
            $pathAcc = __DIR__ .'/../../../../../uploads/kalsteinQuote/'; // home4545/testing.kalstei ...
            $uploadFileAcc = $pathAcc.basename($newNameAcc);                  // home4545/testing.kalstei ... images/upload/64asd55645.png
    
            $uploadNameAcc = 'https://plataforma.kalstein.net/wp-content/uploads/kalsteinQuote/'.$newNameAcc; // https://testing.kalstei ... images/upload/64asd55645.png

            move_uploaded_file($fileAcc['tmp_name'], $uploadFileAcc);

        }
        else {
            $fileAcc = '';
            $uploadNameAcc = '';
        }

        $pNameAcc = $acc['name'];
        $pModelAcc = $acc['model'];
        $pDescriptionAcc = $acc['description'];

        $pWeAcc = $acc['weight'];
        $pWiAcc = $acc['width'];
        $pHeAcc = $acc['height'];
        $pLeAcc = $acc['lengths'];

        $pWePaAcc = $acc['weight_pa'];
        $pWiPaAcc = $acc['width_pa'];
        $pHePaAcc = $acc['height_pa'];
        $pLePaAcc = $acc['length_pa'];
        $pPTypeAcc = $acc['pa_type'];

        $pPriceAcc = $acc['price'];
        $pCurrencyAcc = $acc['currency'];

        if ($pCurrencyAcc == 'EUR') {
            $pPriceEURAcc = $pPriceAcc;
            $pPriceUSDAcc = $pPriceAcc * 1.18;
        }
        else if ($pCurrencyAcc == 'USD') {
            $pPriceEURAcc = $pPriceAcc / 1.18;
            $pPriceUSDAcc = $pPriceAcc;
        }

        $k_product_id = isset($t) ? $t : $k_product_id;

        if ($acc['exist_status'] == 'draft'){
            $queryAcc = "INSERT INTO wp_k_products
                (product_maker, product_brand, product_name_es, product_model, product_description_es, product_category, product_image,
                product_stock_units, product_stock_status,
                product_peso_neto, product_ancho, product_alto, product_largo,
                product_peso_bruto, product_ancho_paquete, product_alto_paquete, product_largo_paquete, wp_product_package_type,
                product_priceUSD, product_priceEUR, wp_product_currency,
                wp_product_discount_1, wp_product_discount_1_amount, wp_product_discount_2, wp_product_discount_2_amount,
                product_manual, product_catalog, product_catalog_name,
                product_technical_description, product_technical_description_csv, product_group, product_parent, product_type)
                VALUES
                ('$acc_id', '', '$pNameAcc', '$pModelAcc', '$pDescriptionAcc', '', '$uploadNameAcc',
                '', 'in stock',
                '$pWeAcc', '$pWiAcc','$pHeAcc', '$pLeAcc',
                '$pWePaAcc', '$pWiPaAcc','$pHePaAcc', '$pLePaAcc', '$pPTypeAcc',
                '$pPriceUSDAcc', '$pPriceEURAcc', '$pCurrencyAcc',
                '', '','', '',
                '', '', '',
                '', '', '1', '$k_product_id', 'sell');";
    
            $response = $conexion->query($queryAcc);
    
            if($response){
                array_push($datos['uploadedAcc'], $conexion->insert_id);
            }
            else {
                $datos['mysqli_error'] = $response->$error;
                $datos['status'] = 'incorrecto';
            }
        }
        else if ($acc['exist_status'] == 'uploaded'){

            $objetoid = $acc['card_id'];

            $queryAcc = "UPDATE wp_k_products SET
                product_name_en = '$pNameAcc',
                product_model = '$pModelAcc',
                product_description = '$pDescriptionAcc',
                product_image = '$uploadNameAcc',
                product_peso_neto = '$pWeAcc',
                product_ancho = '$pWiAcc',
                product_alto = '$pHeAcc',
                product_largo = '$pLeAcc',
                product_peso_bruto = '$pWePaAcc',
                product_ancho_paquete = '$pWiPaAcc',
                product_alto_paquete = '$pHePaAcc',
                product_largo_paquete = '$pLePaAcc',
                wp_product_package_type = '$pPTypeAcc',
                product_priceUSD = '$pPriceUSDAcc',
                product_priceEUR = '$pPriceEURAcc',
                wp_product_currency = '$pCurrencyAcc'
                WHERE product_aid = '$objetoid'
                ";
    
            $response = $conexion->query($queryAcc);
    
            if($response){
                array_push($datos['uploadedAcc'], $objetoid);
            }
            else {
                $datos['mysqli_error'] = $response->$error;
                $datos['status'] = 'incorrecto';
            }
        }
        else if ($acc['exist_status'] == 'delete'){

            $objetoid = $acc['card_id'];

            $queryAcc = "DELETE FROM wp_k_products
                WHERE product_aid = '$objetoid'
            ";
        }

        
    };
?>

