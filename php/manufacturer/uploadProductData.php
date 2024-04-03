<?php
    session_start();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require_once __DIR__ . '/../../db/conexion.php';
    require __DIR__.'/validateProductData.php';

    $datos = array();

    if ($val){

        

        move_uploaded_file($file['tmp_name'], $uploadFile);

        $acc_id = $_SESSION['emailAccount'];

        $b = $conexion->query("SELECT company_nombre FROM wp_company WHERE company_account_correo = '$acc_id'");
        $brand = $b->fetch_assoc()['company_nombre'];

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


        
             
        $query = "INSERT INTO wp_k_products (product_maker, product_brand, product_name_es, product_model, product_description_es, product_category_es, product_image,
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
        

        $result = $conexion->query($query);

        if ($result === TRUE) {
            $datos['status'] = 'correcto';
        }
        else {
            $datos['status'] = 'incorrecto';
        }

        $datos['err_msg'] = false;

        $k_product_id = $conexion->insert_id;


        //ImageMagick 
        
       if($catalog != ''){
        /*$pdfPath = $_FILES['catalog']['tmp_name'];
        $catalogName = $_FILES['catalog']['name'];
        
        $thumbnailName = uniqid('', true) . '.jpg';

        $thumbnailPath = "/home/he270716/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/catalogs/thumbnails/$thumbnailName";

        $imagick = new Imagick();
        $imagick->setResolution(300, 300); 
        $imagick->readImage($pdfPath . '[0]'); 

        $imagick->setImageBackgroundColor('white');
        $imagick = $imagick->flattenImages();

        $imagick->setImageCompressionQuality(95); 
    
        $imagick->writeImage($thumbnailPath);*/

        $query2 = "INSERT INTO wp_catalogs_es
            (catalog_name_es, catalog_maker, catalog_category_es, catalog_model, catalog_image,  catalog_pdf) VALUES
            ('$wp_catalog_name', '$acc_id', '$pCategory', '$pModel', 'Icon_pdf.png', '$newCatalogName');";
        $result2 = $conexion->query($query2);

        move_uploaded_file($_FILES['catalog']['tmp_name'], $uploadCatalogFile);
        }

        //ORIENTADO A SOPORTE 

        if($manual != ''){
            $query2 = "INSERT INTO wp_manuales
            (M_nombre_product,   M_maker,   M_category,   M_model, M_pdf) VALUES
            ('$wp_manual_name'  , '$acc_id', '$pCategory', '$pModel', '$newManualName');";
            $result2 = $conexion->query($query2);

            move_uploaded_file($_FILES['manual']['tmp_name'], $uploadManualFile);
        }

        if ($datos['status'] == 'correcto'){
            include __DIR__.'/accessories/uploadProductData.php';
        }

        $dictCategory = array(
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


        // --- WOOCOMERCE ---
        $post_name = urlencode(uniqid()."-".$pName);
        $post_name = str_replace('+', '-', strtolower($post_name));
        $post_name = urlencode($post_name);
        $post_name = str_replace('--', '-', strtolower($post_name));
        $post_name = str_replace('---', '-', strtolower($post_name));

        $excerpt = "<strong>Manufacturer</strong>: <em>$brand</em><img class=\"alignnone size-full wp-image-29784\" src=\"https://dev.kalstein.plus/plataforma/wp-content/uploads/2022/04/CE.jpg\" alt=\"\" width=\"54\" height=\"53\" />";
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

        //TAXONOMIA DE WOOCOMMERCE (PENDIENTE NO TOCAR)

        // OBTENER SLUG DEL PRODUCTO
        $product_slug = $post_name;

        // VERIFICAR SI YA EXISTE EL TÉRMINO
        $sql = "SELECT term_id FROM wp_terms WHERE slug = '$product_slug'";

        $result = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($result) > 0) {

        // OBTENER ID DEL TÉRMINO EXISTENTE
        $row = mysqli_fetch_assoc($result);
        $term_id = $row['term_id'];

        } else {

        // SI NO EXISTE, INSERTARLO
        $sql = "INSERT INTO wp_terms (slug, name) VALUES ('$product_slug', '$product_slug')";
        
        mysqli_query($conexion, $sql);

        $term_id = mysqli_insert_id($conexion);

        }

        // REGISTRAR EL TÉRMINO EN LA TAXONOMÍA PRODUCT
        $sql = "INSERT INTO wp_term_taxonomy (term_id, taxonomy)
                VALUES ($term_id, 'product')";
                
        mysqli_query($conexion, $sql);

        $categorySlug = isset($dictCategory[$pCategory]) ? $dictCategory[$pCategory] : '';

        // Insertar categoría

        $sql3 = "INSERT INTO wp_term_relationships (object_id, term_taxonomy_id)
                        SELECT $product_idwoo, term_taxonomy_id 
                        FROM wp_term_taxonomy
                        WHERE taxonomy = 'product_cat' AND term_id = (
                            SELECT term_id FROM wp_terms WHERE slug = '$categorySlug' LIMIT 1
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

        $query = "INSERT INTO wp_product_id_woo (product_id, woo_id) VALUES ('$k_product_id', '$product_idwoo')";
        $conexion->query($query);

    }

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();

