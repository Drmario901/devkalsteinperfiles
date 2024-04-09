<?php

    require __DIR__ . '/conexion.php';

    $file = $_FILES["file"]["name"];
    $path = __DIR__ . '/../uploads/';
    $extension = pathinfo($file, PATHINFO_EXTENSION);
    $newName = uniqid().".".$extension;
    $uploadFile = $path . basename($newName);
    $failed = [];

    if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFile)) {
        require_once __DIR__ . '/../PHPExcel/Classes/PHPExcel.php';
        $archivo = __DIR__ . "/../uploads/".$newName;
        $inputFileType = PHPExcel_IOFactory::identify($archivo);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        $objPHPExcel = $objReader->load($archivo);
        $sheet = $objPHPExcel->getSheet(0); 
        $highestRow = $sheet->getHighestRow(); 
        $highestColumn = $sheet->getHighestColumn();
        for ($row = 6; $row <= $highestRow; $row++){ 
            // Update in table from database
            $productName = $sheet->getCell("D".$row)->getValue();
            $model = $sheet->getCell("F".$row)->getValue();

            // $line = $sheet->getCell("A".$row)->getValue();
            // $category = $sheet->getCell("B".$row)->getValue();
            // $subcategory = $sheet->getCell("C".$row)->getValue();
            // $productNameES = $sheet->getCell("D".$row)->getValue();
            // $productNameEN = $sheet->getCell("E".$row)->getValue();
            // $productNameFR = $sheet->getCell("F".$row)->getValue();
            // $maker = $sheet->getCell("G".$row)->getValue();
            // $model = $sheet->getCell("H".$row)->getValue();
            // $image = $sheet->getCell("I".$row)->getValue();
            // $netWeight = $sheet->getCell("J".$row)->getValue();
            // $grossWeight = $sheet->getCell("K".$row)->getValue();
            // $width = $sheet->getCell("L".$row)->getValue();
            // $long = $sheet->getCell("M".$row)->getValue();
            // $height = $sheet->getCell("N".$row)->getValue();
            // $widthP = $sheet->getCell("O".$row)->getValue();
            // $longP = $sheet->getCell("P".$row)->getValue();
            // $heightP = $sheet->getCell("Q".$row)->getValue();
            // $priceUSD = $sheet->getCell("R".$row)->getValue();
            // $priceEUR = $sheet->getCell("S".$row)->getValue();
            // $tags = $sheet->getCell("T".$row)->getValue();
            // $_tags = explode(",", $tags);

            // Update in table from database
            $query = "UPDATE wp_k_products SET product_name_se = '$productName' WHERE product_model = '$model'";
            $conexion->query($query);

            // $query = "SELECT * FROM wp_k_products WHERE product_maker = '$maker' AND product_model = '$model'";
            // $rs = $conexion->query($query);
            // $count = mysqli_num_rows($rs);
            // if ($count > 0){
            //     $array = array(
            //         'model' => $model
            //     );

            //     array_push($failed, $array);
            // }else{
            //     $sql = "INSERT INTO wp_k_products (product_aid, product_tags, product_line, product_category, product_subcategory, product_name_es, product_name_en, product_name_fr, product_maker, product_model, product_image, product_peso_neto, product_peso_bruto, product_alto, product_ancho, product_largo, product_alto_paquete, product_ancho_paquete, product_largo_paquete, product_priceUSD, product_priceEUR, product_create_at) VALUE('', '$tags', '$line', '$category', '$subcategory', '$productNameES', '$productNameEN', '$productNameFR', '$maker', '$model', '$image', '$netWeight', '$grossWeight', '$height', '$width', '$long', '$heightP', '$widthP', '$longP', '$priceUSD', '$priceEUR', CURRENT_TIMESTAMP)";
            //     $conexion->query($sql);

            //     $query2 = "SELECT * FROM wp_categories WHERE categorie_description = '$category' AND categorie_sub = '$subcategory'";
            //     $rs2 = $conexion->query($query2);
            //     $count2 = mysqli_num_rows($rs2);

            //     if ($count2 > 0){

            //     }else{
            //         $sql2 = "INSERT INTO wp_categories (categorie_id, categorie_line, categorie_description, categorie_sub, categorie_create_at) VALUE('', '$line', '$category', '$subcategory', CURRENT_TIMESTAMP)";
            //         $conexion->query($sql2);
            //     }

            //     if (count($_tags) > 0) {
            //         foreach ($_tags as $key => $value) {
            //             $query1 = "SELECT * FROM wp_tags WHERE tags_description = '$value'";
            //             $rs1 = $conexion->query($query1);
            //             $count1 = mysqli_num_rows($rs1);

            //             if ($count1 > 0){

            //             }else{
            //                 $sql1 = "INSERT INTO wp_tags (tags_id, tags_description) VALUE('', '$value')";
            //                 $conexion->query($sql1);
            //             }
            //         }
            //     }else{
                    
            //     }
            // }
        }
        unlink($uploadFile);
        $update = "correcto";
    } else {
        $update = "incorrecto";
    }

    $datos = array(
        'update' => $update,
        'failed' => $failed
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();

?>