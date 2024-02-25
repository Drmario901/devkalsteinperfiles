<?php
    session_start();
    require __DIR__ . '/../conexion.php';

    require __DIR__.'/validateProductData.php';

    $acc_id = $_SESSION['emailAccount'];

    if ($val){
        $t = $_POST['id'];

        if (!empty($_FILES['fileName']['name'])) {
            $fileName = $_FILES['fileName']['name'];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newName = uniqid() . "." . $extension;

            $path = __DIR__ . '/../../src/images/upload/';
            $pathCotiza = __DIR__ . 'https://testing.kalstein.digital/wp-content/uploads/kalsteinQuote/';
            $uploadFile = $path . basename($newName);
            $uploadFileCotiza = $pathCotiza . basename($newName);

            move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);
            move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFileCotiza);
            $updateImage = "product_image = '$newName',";
        } else {
            $updateImage = "";
        }

        if ($pCurrency == 'EUR') {
            $pPriceEUR = $pPrice;
            $pPriceUSD = $pPrice*1.18;
        }
        else if ($pCurrency == 'USD') {
            $pPriceEUR = $pPrice/1.18;
            $pPriceUSD = $pPrice;
        }

        if ($discount_1_amount == '' || $discount_1_amount == 0){
            $discount_1_amount = '';
            $discount_1 = '';
        }
        if ($discount_2_amount == '' || $discount_2_amount == 0){
            $discount_2_amount = '';
            $discount_2 = '';
        }

        // subida de pdf

        if($manual != ''){
            // recupero nombre del pdf desde la tabla k_products
            $queryManual = "SELECT product_manual FROM wp_k_products WHERE product_aid = '$t'";
            $resultManual = $conexion->query($queryManual);

            $manualPath = $resultManual->fetch_array()[0];

            // recupero si hay pdf ya existente
            $querypdf = "SELECT M_pdf FROM wp_manuales WHERE M_pdf = '$manualPath'";
            $resultpdf = $conexion->query($querypdf);

            // si no hay, lo inserta
            if($resultpdf->num_rows == 0){
                $queryUpload = "INSERT INTO wp_manuales
                (M_nombre_product,   M_maker,   M_category,   M_model, M_pdf) VALUES
                ('$wp_manual_name'  , '$acc_id', '$pCategory', '$pModel', '$newManualName');";

                echo $queryUpload;

                $resultUpload = $conexion->query($queryUpload);
            }
            // si hay, lo actualiza y elimina el antiguo
            else {
                unlink('https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/manuals/upload/'.$manualPath);

                $queryUpdate = "UPDATE wp_manuales SET
                M_nombre_product = '$wp_manual_name',
                M_maker          = '$acc_id',
                M_category       = '$pCategory',
                M_model          = '$pModel',
                M_pdf            = '$newManualName'
                WHERE M_pdf      = '$manualPath'";

                echo $queryUpdate;

                $resultUpdate = $conexion->query($queryUpdate);

            }
            move_uploaded_file($_FILES['manual']['tmp_name'], $uploadManualFile);
            
            $updatePDF = "product_manual = '$newManualName',";
        }
        else{
            $updatePDF = '';
        }

        if($catalog != ''){
            $queryManual = "SELECT product_catalog FROM wp_k_products WHERE product_aid = '$t'";
            $resultManual = $conexion->query($queryManual);

            $currentCatalog = $resultManual->fetch_array()[0];

            if($currentCatalog != ''){
                unlink('https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/manuals/upload/'.$currentCatalog);
            }
            
            move_uploaded_file($_FILES['catalog']['tmp_name'], $uploadCatalogFile);

            $query = "UPDATE wp_k_products SET
                product_catalog      = '$newCatalogName',
                product_catalog_name = '$wp_catalog_name'
                WHERE product_aid = '$t'";

            $result = $conexion->query($query);
            
        }

        // subida de archivo
            
        $query = "UPDATE wp_k_products SET
            product_name_en              = '$pName',
            product_model                = '$pModel',
            product_brand                = '$pBrand',
            product_description          = '$pDescription',
            product_category             = '$pCategory',
            $updateImage
            product_stock_units          = '$pStock',
            product_stock_status         = '$pStatus',
            product_peso_neto            = '$pWe',
            product_ancho                = '$pWi',
            product_alto                 = '$pHe',
            product_largo                = '$pLe',
            product_peso_bruto           = '$pWePa',
            product_ancho_paquete        = '$pWiPa',
            product_alto_paquete         = '$pHePa',
            product_largo_paquete        = '$pLePa',
            wp_product_package_type      = '$pPType',
            product_priceUSD             = '$pPriceUSD',
            product_priceEUR             = '$pPriceEUR',
            wp_product_currency          = '$pCurrency',
            wp_product_discount_1        = '$discount_1',
            wp_product_discount_1_amount = '$discount_1_amount',
            wp_product_discount_2        = '$discount_2',
            $updatePDF
            wp_product_discount_2_amount = '$discount_2_amount',

            WHERE product_aid       = '$t'";

        if ($conexion->query($query) != FALSE) {
            $datos['status'] = 'correcto';
        } else {
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