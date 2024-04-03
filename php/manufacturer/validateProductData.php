<?php
//require '../../vendor/autoload.php';
    function validate($name, $model, $brand, $description, $category, $fileInput, $stock, $status,
    $weight, $length, $width, $height,
    $weight_pa, $length_pa, $width_pa, $height_pa, $pa_type,
    $price, $currency,
    $discount_1, $discount_1_amount, $discount_2, $discount_2_amount, $dontimage, $gibson){

        //require '../../vendor/autoload.php';

        $err_msg = "";

        // void verifications
        if ($fileInput == '') {
            $err_msg = 'Agrega una imágen para guardar el producto';
        }
        else if ($name == '') {
            $err_msg = 'Nombre vacío';
        }
        else if ($model == '') {
            $err_msg = 'Modelo vacío';
        }
        else if ($brand == '') {
            $err_msg = 'Marca vacía';
        }
        else if ($description == '') {
            $err_msg = 'Descripción vacía';
        }
        else if ($category == '') {
            $err_msg = 'Categoría vacía';
        }
        else if ($stock == '') {
            $err_msg = 'Existencias vacía';
        }
        else if ($weight == '') {
            $err_msg = 'Peso vacío';
        }
        else if ($width == '') {
            $err_msg = 'Ancho vacío';
        }
        else if ($height == '') {
            $err_msg = 'Alto vacío';
        }
        else if ($length == '') {
            $err_msg = 'Largo vacío';
        }
        else if ($weight_pa == '') {
            $err_msg = 'Peso de empaque vacío';
        }
        else if ($width_pa == '') {
            $err_msg = 'Ancho de empaque vacío';
        }
        else if ($height_pa == '') {
            $err_msg = 'Alto de empaque vacío';
        } 
        else if ($length_pa == '') {
            $err_msg = 'Largo de empaque vacío';
        }
        else if ($pa_type == '') {
            $err_msg = 'Tipo de empaque vacío';
        } 
        else if ($status == '') {
            $err_msg = 'Estatus vacío';
        }
        else if ($price == '') {
            $err_msg = 'Precio unitario vacío';
        }
        else if ($currency == '') {
            $err_msg = 'Tipo de moneda vacío';
        }
        else if ($discount_1 == '') {
            $err_msg = 'Descuento 1 vacío';
        }
        else if ($discount_1_amount == '') {
            $err_msg = 'Unidades de descuento 1 vacío';
        }
        else if ($discount_2 == '') {
            $err_msg = 'Descuento 2 vacío';
        }
        else if ($discount_2_amount == '') {
            $err_msg = 'Unidades de descuento 2 vacío';
        }
        // negative verification
        else if (floatval($stock) < 0) {
            $err_msg = 'Existencias no pueden ser menos de 0';
        }
        else if (floatval($price) < 0) {
            $err_msg = 'Precio no puede ser menos de 0';
        }
        else if (floatval($weight) <= 0) {
            $err_msg = 'Peso no puede ser menos de 0';
        }
        else if (floatval($width) <= 0) {
            $err_msg = 'Largo no puede ser menos de 0';
        }
        else if (floatval($height) <= 0) {
            $err_msg = 'Ancho no puede ser menos de 0';
        }
        else if (floatval($length) <= 0) {
            $err_msg = 'Alto no puede ser menos de 0';
        } 
        else if (floatval($weight_pa) <= 0) {
            $err_msg = 'Peso de empaque no puede ser menos de 0';
        }
        else if (floatval($width_pa) <= 0) {
            $err_msg = 'Largo de empaque no puede ser menos de 0';
        }
        else if (floatval($height_pa) <= 0) {
            $err_msg = 'Ancho de empaque no puede ser menos de 0';
        }
        else if (floatval($length_pa) <= 0) {
            $err_msg = 'Alto de empaque no puede ser menos de 0';
        }
        else if (floatval($discount_1) <= 0) {
            $err_msg = 'Descuento 1 no puede ser menos de 0';
        }
        else if (floatval($discount_1) > 100) {
            $err_msg = 'Descuento 1 no puede mayor de 100';
        } 
        else if (floatval($discount_1_amount) <= 0) {
            $err_msg = 'Unidades de descuento 1 no pueden ser menores de 0';
        } 
        else if (floatval($discount_2) <= 0) {
            $err_msg = 'Descuento 2 no puede ser menor de 0';
        }
        else if (floatval($discount_2) > 100) {
            $err_msg = 'Descuento 2 no puede ser mayor de 100';
        } 
        else if (floatval($discount_2_amount) <= 0) {
            $err_msg = 'Unidades de descuento 2 no pueden ser menores de 0';
        }
        // length validations
        else if (strlen($name) >= 50) {
            $err_msg = 'Nombre no puede ser mayor de 50 carácteres';
        }
        else {
            if (!$dontimage){
                    $maxSize = 10 * 1024 * 1024; // 10 MB
                $ft = pathinfo($fileInput['name'], PATHINFO_EXTENSION);

                if ($fileInput['size'] > $maxSize) {
                    $err_msg = 'El archivo excede el límite de 10 MB.';
                }
                else if ($ft != 'JPEG' && $ft != 'JPG' && $ft != 'PNG' && $ft != 'jpeg' && $ft != 'jpg' && $ft != 'png') {
                    $err_msg = 'Solo archivos JPG, PNG, y JPEG files están permitidos.';
                }
            }
        }

        if ($err_msg != ""){
            return $err_msg;
        }
        else return true;
    }
 
    

    if (isset($_FILES['fileName'])){

        // No changes needed for this code block.

        $file = $_FILES['fileName'];

        // Crear un objeto Imagick con el archivo temporal cargado
        $image = new Imagick($file['tmp_name']);

        // Reescalar la imagen a 900x900 píxeles, manteniendo la relación de aspecto y sin distorsión
        $image->resizeImage(900, 900, Imagick::FILTER_LANCZOS, 1, true);

        // Obtener el nombre del archivo y la extensión para generar el nuevo nombre
        $fileName = $file['name'];
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $newName = uniqid() . "." . $extension;

        // Definir la ruta de guardado del archivo
        $path = '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/';
        $uploadFile = $path . basename($newName);

        // Guardar la imagen reescalada en la ubicación final
        $image->writeImage($uploadFile);

        // Generar la URL pública de la imagen para acceso posterior
        $uploadName = 'https://dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/' . $newName;

        // Limpiar recursos
        $image->clear();
        $image->destroy();
    }
    else $file = '';

    $dontimage = isset($_POST['dontUpdateImg']);

    $datos = array();

    $pName        = $_POST['name'];
    $pModel        = $_POST['model'];
    $pBrand        = $_POST['brand'];
    $pDescription = $_POST['description'];
    $pCategory    = $_POST['category'];
    $pStock       = $_POST['stock'];
    $pStatus      = $_POST['status'];

    $pDescription = nl2br($pDescription);

    $plDescription = $_POST['longDescription'];
    $plDescriptionCSV = $_POST['longDescriptionCSV'];

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
    $gibson       = $_POST['gibson'];

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

    if (isset($_FILES['catalog'])) {
        $catalog = $_FILES['catalog'];
    
        if ($catalog['error'] === UPLOAD_ERR_OK) {
            $catalogName = $_FILES['catalog']['name'];
            $catalogExtension = pathinfo($catalogName, PATHINFO_EXTENSION);
            $newCatalogName = uniqid() . "." . $catalogExtension;
            $catalogPath = '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload';
            $uploadCatalogFile = $catalogPath . $newCatalogName;
    
            $wp_catalog_name = pathinfo($catalogName, PATHINFO_FILENAME);
    
            if (is_writable($catalogPath) && move_uploaded_file($catalog['tmp_name'], $uploadCatalogFile)) {
                // El archivo se movió con éxito
                $err_msg = 'UPLOADED';
            } else {
                // Error al mover el archivo
                $err_msg = 'ERROR UPLOADING';
            }
        } else {
            // Error en la carga del archivo
            $err_msg = 'Error al subir el archivo: ' . $catalog['error'];
        }
    } else {
        $catalog = '';
        $newCatalogName = '';
        $wp_catalog_name = '';
    }
    

    $val = validate($pName, $pModel, $pBrand, $pDescription, $pCategory, $file, $pStock, $pStatus,
            $pWe, $pLe, $pWi, $pHe,
            $pWePa, $pLePa, $pWiPa, $pHePa, $pPType,
            $pPrice, $pCurrency,
            $discount_1, $discount_1_amount, $discount_2, $discount_2_amount, $dontimage, $gibson);
        

?>

