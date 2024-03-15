<?php
    session_start();
    require __DIR__ . '../../db/conexion.php';

    require __DIR__.'/validateProductData.php';

    $acc_id = $_SESSION['emailAccount'];

    if ($val){
        $t = $_POST['id'];

        if (!empty($_FILES['fileName']['name'])) {
            $fileName = $_FILES['fileName']['name'];
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);
            $newName = uniqid().".".$extension;

            $path = '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/'; 
            $uploadFile = $path . basename($newName);

            move_uploaded_file($_FILES['fileName']['tmp_name'], $uploadFile);

            $uploadName = 'https://dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/'.$newName;

            $updateImage = "product_image = 'https://dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/$newName',";
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

                $resultUpload = $conexion->query($queryUpload);
            }
            // si hay, lo actualiza y elimina el antiguo
            else {
                unlink('https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/manuals/upload/'.$manualPath);

                $queryUpdate = "UPDATE wp_manuales SET
                M_nombre_product = '$wp_manual_name',
                M_maker          = '$acc_id',
                M_category       = '$pCategory',
                M_model          = '$pModel',
                M_pdf            = '$newManualName'
                WHERE M_pdf      = '$manualPath'";

                $resultUpdate = $conexion->query($queryUpdate);

            }
            move_uploaded_file($_FILES['manual']['tmp_name'], $uploadManualFile);
            
            $updatePDF = "product_manual = '$newManualName',";
        }
        else{
            $updatePDF = '';
        }

        if($catalog != ''){
            // recupero nombre del pdf desde la tabla k_products
            $queryCatalog = "SELECT product_manual FROM wp_k_products WHERE product_aid = '$t'";
            $resultCatalog = $conexion->query($queryCatalog);

            $catalogPath = $resultCatalog->fetch_array()[0];

            // recupero si hay pdf ya existente
            $querypdf = "SELECT M_pdf FROM wp_manuales WHERE M_pdf = '$catalogPath'";
            $resultpdf = $conexion->query($querypdf);

            // si no hay, lo inserta
            if($resultpdf->num_rows == 0){
                $queryUpload = "INSERT INTO wp_catalogs
                (catalog_name      , catalog_maker,   catalog_category, catalog_model, catalog_pdf      ) VALUES
                ('$wp_catalog_name', '$acc_id'    , '$pCategory'      , '$pModel'    , '$newCatalogName');";

                $resultUpload = $conexion->query($queryUpload);
            }
            // si hay, lo actualiza y elimina el antiguo
            else {
                unlink('https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload/'.$catalogPath);

                $queryUpdate = "UPDATE wp_catalogs SET
                catalog_name           = '$wp_catalog_name',
                catalog_maker          = '$acc_id',
                catalog_category       = '$pCategory',
                catalog_model          = '$pModel',
                catalog_pdf            = '$newCatalogName'
                WHERE catalog_pdf      = '$catalogPath'";

                $resultUpdate = $conexion->query($queryUpdate);

            }
            move_uploaded_file($_FILES['catalog']['tmp_name'], $uploadCatalogFile);
            
            $updatePDFcatalog = "product_catalog = '$newCatalogName',";
        }
        else{
            $updatePDFcatalog = '';
        }
            
        $query = "UPDATE wp_k_products SET
            product_name_es              = '$pName',
            product_model                = '$pModel',
            product_description_es       = '$pDescription',
            product_category_es          = '$pCategory',
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
            $updatePDFcatalog
            wp_product_discount_2_amount = '$discount_2_amount',
            product_validate_status           = 'pending',
            product_technical_description_es = '$plDescription',
            product_technical_description_csv = '$plDescriptionCSV'

            WHERE product_aid       = '$t'";

        if ($conexion->query($query) != FALSE) {
            $datos['status'] = 'correcto';
        } else {
            $datos['status'] = 'incorrecto';
        }

        if ($datos['status'] == 'correcto'){
            include __DIR__.'/accesories/uploadProductData.php';

            $deleteQuery3 = "SELECT ww.woo_id FROM wp_product_id_woo as ww INNER JOIN wp_k_products as wp ON wp.product_aid = ww.product_id WHERE ww.product_id = '$t'";
            $deleteWooId = $conexion->query($deleteQuery3)->fetch_array()[0];
            
            $deleteQuery5 = "SELECT post_name FROM wp_posts WHERE ID = '$deleteWooId'";
            $post_name_result = $conexion->query($deleteQuery5);

            if ($post_name_result->num_rows > 0){
                $row = $post_name_result->fetch_array()[0];
                $post_name = $row;
            }
            else {
                $post_name = urlencode(uniqid()."-".$pName);
                $post_name = str_replace('+', '-', strtolower($post_name));
                $post_name = urlencode($post_name);
                $post_name = str_replace('--', '-', strtolower($post_name));
                $post_name = str_replace('---', '-', strtolower($post_name));
            }
            
            $deleteQuery4 = "DELETE FROM wp_posts WHERE ID = '$deleteWooId'";
            $deleteResult4 = $conexion->query($deleteQuery4);

            $deleteQuery6 = "DELETE FROM wp_product_id_woo WHERE woo_id = '$deleteWooId'";
            $deleteResult6 = $conexion->query($deleteQuery6);

            // --- WOOCOMERCE ---

            array(
                'Accesorios Dentales' => 'accesorios-dentales',
                'Agitadores' => 'agitadores-de-laboratorio',
                'Analizador de humedad' => 'analizador-de-humedad',
                'Analizadore' => 'analizadores',
                'Anatomía patológica' => 'anatomia-patologica',
                'Armarios de seguridad' => 'armario-de-almacenamiento-de-seguridad',
                'Autoclave' => 'autoclaves',
                'Balanzas' => 'balanzas',
                'Banco De Trabajo De Acero' => 'banco-de-trabajo-de-acero',
                'Banco De Trabajo De Acero Inoxidable 304' => 'banco-de-trabajo-de-acero-inoxidable-304',
                'Baños de agua' => 'banos-de-agua',
                'Bomba de infusión' => 'bomba-de-infusion',
                'Caja de luz en color' => 'caja-de-evaluacion-de-color',
                'Calefactor radiante infantil' => 'calentador-radiante-infantil',
                'Cámaras climáticas' => 'camaras-climaticas',
                'Colorímetro' => 'colorimetro',
                'Conductivímetro' => 'medidores-de-conductividad',
                'Consumibles' => 'consumibles',
                'Destilador de agua' => 'destilador-de-agua',
                'Digestor de microondas' => 'digestor-de-microondas',
                'Documentación de gel' => 'documentacion-de-gel',
                'ECG-Electrocardiógrafo digital' => 'electrocardiografo-ecg-digital',
                'Electroforesis' => 'electroforesis',
                'Enfriador de recirculación' => 'enfriador-de-recirculacion',
                'Escáner de ultrasonidos' => 'escaner-de-ultrasonido',
                'Espectrofotómetros' => 'espectrofotometros',
                'Esterilizador Bacti-Cinerator' => 'bacti-cinerador',
                'Estufas' => 'estufas',
                'Evaporador rotativo' => 'rotavapores',
                'Fabricadora de hielo' => 'fabricador-de-hielo',
                'Flujo laminar y cabinas' => 'campanas-y-cabinas-de-bioseguridad',
                'Fluorómetro' => 'fluorometro',
                'Fuente de alimentación' => 'fuente-de-alimentacion',
                'Homogeneizador' => 'homogeneizadores',
                'Incubadora' => 'incubadoras',
                'Incubadora de fototerapia infantil' => 'incubadora-de-fototerapia-infantil',
                'Lámpara De Operación' => 'lampara-de-operacion',
                'Lavadora de microplacas' => 'lavadora-de-microplacas',
                'Lavadoras Industriales' => 'lavadoras-industriales',
                'Lector de microplacas' => 'lector-de-microplacas',
                'Limpiador ultrasónico' => 'limpiador-ultrasonico',
                'Liofilizadores' => 'liofilizadores',
                'Mantas calefactoras' => 'mantos-calefactores-agitadores',
                'Máquina de anestesia' => 'maquina-de-anestesia',
                'Medidor de iones' => 'medidor-de-iones',
                'Medidor de oxígeno disuelto' => 'medidores-de-oxigeno-disuelto',
                'Medidor de turbidez' => 'medidor-de-turbidez',
                'Medidores de pH' => 'medidores-de-ph',
                'Microscopio' => 'microscopios',
                'Monitor de paciente' => 'monitor-de-paciente-y-monitor-infantil',
                'Mufla' => 'mufflas',
                'Navegación quirúrgica óptica' => 'navegacion-quirurgica-optica',
                'Pipetas' => 'pipetas',
                'Placas de calentamiento' => 'placa-de-calentamiento',
                'Reactivo' => 'reactivos',
                'Refrigerador y Congelador' => 'refrigeradores-y-congeladores',
                'Silla de ruedas' => 'silla-de-ruedas',
                'Sistema de agua' => 'sistemas-de-purificacion-de-agua',
                'Tabla de operaciones' => 'mesa-de-operaciones',
                'Tanques de nitrógeno' => 'tanques-de-nitrogeno',
                'Termocicladores PCR' => 'termocicladores-pcr',
                'Transiluminador' => 'transiluminador',
                'Unidad de electrocirugía' => 'unidad-electroquirurgica',
                'Unidad de Fototerapia de Bilirrubina Infantil' => 'unidad-de-fototerapia-de-bilirrubina-infantil',
                'Unidad Dental' => 'unidades-dentales',
                'Viscosímetro' => 'viscosimetro'
            );

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

            $categorySlug = isset($dictCategory[$pCategory]) ? $dictCategory[$pCategory] : '';

            // Insertar categoría
            $sql3 = "INSERT INTO wp_term_relationships (object_id, term_taxonomy_id)
                    SELECT $product_idwoo, term_taxonomy_id 
                    FROM wp_term_taxonomy
                    WHERE taxonomy = 'product_cat' AND term_id = (
                    SELECT term_id FROM wp_terms WHERE slug = '$categorySlug'
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

            $query = "INSERT INTO wp_product_id_woo(product_id, woo_id) VALUES ('$t', '$product_idwoo')";
            $conexion->query($query);

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