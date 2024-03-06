<?php
    function validate($name, $model, $description, $category, $fileInput,
    $weight, $length, $width, $height,
    $weight_pa, $length_pa, $width_pa, $height_pa, $pa_type,
    $price, $currency){

        $err_msg = "";

        // void verifications
        if ($name == '') {
            $err_msg = 'Nombre vacío';
        }
        else if ($model == '') {
            $err_msg = 'Modelo vacío';
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
        else if ($price == '') {
            $err_msg = 'Precio unitario vacío';
        }
        else if ($currency == '') {
            $err_msg = 'Moneda vacía';
        }
        // negative verification
        else if (floatval($price) < 0) {
            $err_msg = 'El precio no puede ser inferior a 0';
        }
        else if (floatval($weight) <= 0) {
            $err_msg = 'El peso no puede ser inferior a 0';
        }
        else if (floatval($width) <= 0) {
            $err_msg = 'Longitud no puede ser inferior a 0';
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
        // length validations
        else {
            if ($fileInput != ''){
                    $maxSize = 10 * 1024 * 1024; // 10 MB
                $ft = pathinfo($fileInput['name'], PATHINFO_EXTENSION);

                if ($fileInput['size'] > $maxSize) {
                    $err_msg = 'The file size exceeds the limit of 10 MB.';
                }
                else if ($ft != 'JPEG' && $ft != 'JPG' && $ft != 'PNG' && $ft != 'jpeg' && $ft != 'jpg' && $ft != 'png') {
                    $err_msg = 'Only JPG, PNG, and JPEG files are allowed.';
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
        $path = __DIR__ .'/../../src/images/upload/';         // home4545/testing.kalstei ...
        $uploadFile   = $path.basename($newName);             // home4545/testing.kalstei ... images/upload/64asd55645.png

        $uploadName = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$newName; // https://testing.kalstei ... images/upload/64asd55645.png
    }
    else $file = '';

    $dontimage = isset($_POST['dontUpdateImg']);

    $datos = array();

    $pName        = $_POST['name'];
    $pModel       = $_POST['model'];
    $pDescription = $_POST['description'];
    $pParent      = $_POST['parent'];

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

    $val = validate($pName, $pModel, $pDescription, $pCategory, $file,
            $pWe, $pLe, $pWi, $pHe,
            $pWePa, $pLePa, $pWiPa, $pHePa, $pPType,
            $pPrice, $pCurrency
            );
?>