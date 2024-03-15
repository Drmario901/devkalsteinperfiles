<?php
    
    session_start();

    require __DIR__.'../../conexion.php';

    $p_id = $_POST['product_aid'];

    $query = "SELECT
                product_aid,
                product_name_en as name,
                product_model as model,
                product_description as description,
                product_image as fileInput,
                product_peso_neto as weight,
                product_ancho as lengths,
                product_alto as width,
                product_largo as height,
                product_peso_bruto as weight_pa,
                product_ancho_paquete as length_pa,
                product_alto_paquete as width_pa,
                product_largo_paquete as height_pa,
                wp_product_package_type as pa_type,
                product_priceUSD ,
                product_priceEUR ,
                wp_product_currency as currency
                FROM wp_k_products WHERE product_parent = '$p_id'";
    $result = $conexion->query($query);

    $arrayAccessories = [];

    if($result->num_rows > 0){
        while ($row = $result->fetch_assoc()){
            if ($row['currency'] == 'USD'){
                $row['price'] = $row['product_priceUSD'];
            }
            else if ($row['currency'] == 'EUR'){
                $row['price'] = $row['product_priceEUR'];
            }

            $row['exist_status'] = 'uploaded';

            array_push($arrayAccessories, $row);
        }
    }

    echo json_encode($arrayAccessories);

?>