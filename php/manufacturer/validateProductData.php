<?php
    function validate($name, $model, $description, $category, $fileInput, $stock, $status,
    $weight, $length, $width, $height,
    $weight_pa, $length_pa, $width_pa, $height_pa, $pa_type,
    $price, $currency,
    $discount_1, $discount_1_amount, $discount_2, $discount_2_amount, $dontimage){

        $err_msg = "";

        // void verifications
        if ($fileInput == '') {
            $err_msg = 'Añade una imagen para guardar el producto';
        }
        else if ($name == '') {
            $err_msg = 'Nombre vacío';
        }
        else if ($model == '') {
            $err_msg = 'Modelo vacío';
        }
        else if ($description == '') {
            $err_msg = 'Descripción vacía';
        }
        else if ($category == '') {
            $err_msg = 'Categoría vacía';
        }
        else if ($stock == '') {
            $err_msg = 'Stock vacío';
        }
        else if ($weight == '') {
            $err_msg = 'Peso vacío';
        }
        else if ($width == '') {
            $err_msg = 'Ancho vacío';
        }
        else if ($height == '') {
            $err_msg = 'Altura vacía';
        }
        else if ($length == '') {
            $err_msg = 'Longitud vacío';
        }
        else if ($weight_pa == '') {
            $err_msg = 'Peso de embalaje vacío';
        }
        else if ($width_pa == '') {
            $err_msg = 'Anchura de embalaje vacía';
        }
        else if ($height_pa == '') {
            $err_msg = 'Altura de embalaje vacía';
        } 
        else if ($length_pa == '') {
            $err_msg = 'Longitud de embalaje vacía';
        }
        else if ($pa_type == '') {
            $err_msg = 'Tipo de embalaje vacío';
        } 
        else if ($status == '') {
            $err_msg = 'Estado vacío';
        }
        else if ($price == '') {
            $err_msg = 'Precio unitario vacío';
        }
        else if ($currency == '') {
            $err_msg = 'Moneda vacía';
        }
        else if ($discount_1 == '') {
            $err_msg = 'Descuento 1 vacío';
        }
        else if ($discount_1_amount == '') {
            $err_msg = 'Descuento 1 unidades vacío';
        }
        else if ($discount_2 == '') {
            $err_msg = 'Descuento 2 vacío';
        }
        else if ($discount_2_amount == '') {
            $err_msg = 'Descuento 2 unidades está vacío';
        }
        // negative verification
        else if (floatval($stock) < 0) {
            $err_msg = 'El stock no puede ser inferior a 0';
        }
        else if (floatval($price) < 0) {
            $err_msg = 'El precio no puede ser inferior a 0';
        }
        else if (floatval($weight) <= 0) {
            $err_msg = 'El peso no puede ser inferior a 0';
        }
        else if (floatval($width) <= 0) {
            $err_msg = 'La longitud no puede ser inferior a 0';
        }
        else if (floatval($height) <= 0) {
            $err_msg = 'La anchura no puede ser inferior a 0';
        }
        else if (floatval($length) <= 0) {
            $err_msg = 'La altura no puede ser inferior a 0';
        } 
        else if (floatval($weight_pa) <= 0) {
            $err_msg = 'El peso del embalaje no puede ser inferior a 0';
        }
        else if (floatval($width_pa) <= 0) {
            $err_msg = 'La longitud del embalaje no puede ser inferior a 0';
        }
        else if (floatval($height_pa) <= 0) {
            $err_msg = 'La anchura del embalaje no puede ser inferior a 0';
        }
        else if (floatval($length_pa) <= 0) {
            $err_msg = 'La altura del embalaje no puede ser inferior a 0';
        }
        else if (floatval($discount_1) <= 0) {
            $err_msg = 'El descuento 1 no puede ser inferior a 0';
        }
        else if (floatval($discount_1) > 100) {
            $err_msg = 'El descuento 1 no puede ser mayor que 100';
        } 
        else if (floatval($discount_1_amount) <= 0) {
            $err_msg = 'Las unidades de descuento 1 no pueden ser inferiores a 0';
        } 
        else if (floatval($discount_2) <= 0) {
            $err_msg = 'El descuento 2 no puede ser inferior a 0';
        }
        else if (floatval($discount_2) > 100) {
            $err_msg = 'El descuento 2 no puede ser mayor que 100';
        } 
        else if (floatval($discount_2_amount) <= 0) {
            $err_msg = 'Las unidades de descuento 2 no pueden ser inferiores a 0';
        }
        // length validations
        else if (strlen($name) >= 50) {
            $err_msg = 'El nombre no puede ser mayor que 50';
        }
        else {
            if (!$dontimage){
                    $maxSize = 10 * 1024 * 1024; // 10 MB
                $ft = pathinfo($fileInput['name'], PATHINFO_EXTENSION);

                if ($fileInput['size'] > $maxSize) {
                    $err_msg = 'El tamaño del archivo excede el límite de 10 MB.';
                }
                else if ($ft != 'JPEG' && $ft != 'JPG' && $ft != 'PNG' && $ft != 'jpeg' && $ft != 'jpg' && $ft != 'png') {
                    $err_msg = 'Solo archivos JPG, PNG, and JPEG files están permitidos.';
                }
            }
        }

        if ($err_msg != ""){
            return $err_msg;
        }
        else return true;
    }

    if (isset($_FILES['fileName'])){
        $file = $_FILES['fileName'];

        $fileName = $_FILES['fileName']['name'];              // my_image.png
        $extension = pathinfo($fileName, PATHINFO_EXTENSION); // .png
        $newName = uniqid().".".$extension;                   // 64asd55645.png
        $path = '/home/he270716/public_html/es/wp-content/uploads/kalsteinQuote/';         // home4545/testing.kalstei ...
        $uploadFile   = $path.basename($newName);             // home4545/testing.kalstei ... images/upload/64asd55645.png

        $uploadName = 'https://dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/'.$newName; // https://testing.kalstei ... images/upload/64asd55645.png
    }
    else $file = '';

    $dontimage = isset($_POST['dontUpdateImg']);

    $datos = array();

    $pName        = $_POST['name'];
    $pModel        = $_POST['model'];
    $pDescription = $_POST['description'];
    $pCategory    = $_POST['category'];
    $pStock       = $_POST['stock'];
    $pStatus      = $_POST['status'];
    
    $plDescription = $_POST['longDescription'];
    $plDescriptionCSV = $_POST['longDescriptionCSV'];

    $pDescription = nl2br($pDescription);

    $pWe = $_POST['we'];
    $pWi = $_POST['wi'];
    $pHe = $_POST['he'];
    $pLe = $_POST['le'];

    $pWePa  = $_POST['we_pa'];
    $pWiPa  = $_POST['wi_pa'];
    $pHePa  = $_POST['he_pa'];
    $pLePa  = $_POST['le_pa'];
    $pPType = $_POST['pa_type'];

    $pPrice    = $_POST['price'];
    $pCurrency = $_POST['currency'];

    $discount_1        = $_POST['discount_1'];
    $discount_1_amount = $_POST['discount_1_amount'];
    $discount_2        = $_POST['discount_2'];
    $discount_2_amount = $_POST['discount_2_amount'];



    $accessoryData  = $_POST['accessoryData'];

    if ($_FILES['manual'] != ''){
        $manual = $_FILES['manual'];

        $manualName = $_FILES['manual']['name'];
        $manualExtension = pathinfo($manualName, PATHINFO_EXTENSION);
        $newManualName = uniqid() . "." . $manualExtension;
        $manualPath = __DIR__ . '/../../src/manuals/upload/';
        $uploadManualFile   = $manualPath . basename($newManualName);

        $wp_manual_name = pathinfo($manualName, PATHINFO_FILENAME);
    }
    else {
        $manual = '';
        $newManualName = '';
    }

    if ($_FILES['catalog'] != ''){
        $catalog = $_FILES['catalog'];

        $catalogName = $_FILES['catalog']['name'];
        $catalogExtension = pathinfo($catalogName, PATHINFO_EXTENSION);
        $newCatalogName = uniqid() . "." . $catalogExtension;
        $catalogPath = __DIR__ . '/../../src/catalogs/upload/';
        $uploadCatalogFile   = $catalogPath . basename($newCatalogName);

        $wp_catalog_name = pathinfo($catalogName, PATHINFO_FILENAME);
    }
    else {
        $catalog = '';
        $newCatalogName = '';
        $wp_catalog_name = '';
    }

    $val = validate($pName, $pModel, $pDescription, $pCategory, $file, $pStock, $pStatus,
            $pWe, $pLe, $pWi, $pHe,
            $pWePa, $pLePa, $pWiPa, $pHePa, $pPType,
            $pPrice, $pCurrency,
            $discount_1, $discount_1_amount, $discount_2, $discount_2_amount, $dontimage);
?>