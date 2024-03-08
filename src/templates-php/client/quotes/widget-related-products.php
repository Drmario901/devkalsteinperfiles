<div id='productContainer' class='row mt-3' style='width: 100%'>
    <h3 data-i18n="client:relatedProducts" ><?php $productosRelacionados ?></h3>
    <?php
        if ($subcategory == NULL || $subcategory == "") {
            $queryRelated = "SELECT product_model, product_aid FROM wp_k_products WHERE product_category = '$category' AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_group = '0' AND product_type IN ('sell')";
        }
        else {
            $queryRelated = "SELECT product_model, product_aid FROM wp_k_products WHERE product_subcategory = '$subcategory' AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_group = '0' AND product_type IN ('sell')";
        }
        
        $resultRelated = $conexion->query($queryRelated);

        include __DIR__.'/../../../../php/translations.php';
        
        $relatedModels = array();
        $relatedModelIDs = array();
        $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

        //si $lang = 'en' se quita el sufijo '_es' de la variable $productName
        $productName = $lang == 'en' ? 'product_name' : 'product_name_'.$lang;

        $ver = $translations[$lang]['client:seeTable'];
        $productosRelacionados = $translations[$lang]['productsRelated'];
        
        if ($resultRelated->num_rows > 0){
            while ($row = $resultRelated->fetch_assoc()) {
                $mod = $row['product_model'];
                $ID = $row['product_aid'];

                $cant = $conexion->query("SELECT SUM(cotizacion_detalle_cant) FROM wp_cotizacion_detalle WHERE cotizacion_detalle_model = '$mod'")->fetch_array()[0];
                $cant = $cant != NULL ? $cant : '0';

                if ($mod != $model){
                    $relatedModels[$mod] = $cant;
                    $relatedModelIDs[$mod] = $ID;
                }
            }
        }

        arsort($relatedModels);
        
        $keys = array_keys($relatedModels);

        for($i = 0; $i < 4; $i++){
            $p_id = $relatedModelIDs[$keys[$i]];

            $consulta = "SELECT * FROM wp_k_products WHERE product_aid = '$p_id'";
            $resultado = $conexion->query($consulta);
        
            $row = mysqli_fetch_array($resultado);
            $count = mysqli_num_rows($resultado);
        
            if ($count > 0){
                $name = $row[$productName];
                $model = $row["product_model"];
                $brand = $row["product_brand"];
                $description = $row["product_description"];
                $category = $row["product_category"];
                $subcategory = $row["product_subcategory"];
                $image = $row["product_image"];
                $price = $row["product_priceUSD"];

                echo "<div class='col-sm-6 col-lg-3 mb-2'>
                        <div class='m-1 mb-4 h-100'>
                            <div class='d-flex flex-column justify-content-between h-100'>
                                <div class='img-preview-quote mb-2' style=\"background-image: url('$image'); cursor: pointer\" value='$p_id'>
                                    <i class='fa-solid fa-up-right-from-square' style='float: right; color: green !important; padding: 5px'></i>
                                </div>
                                <h6 class='card-title' style='font-size: 1em; margin-bottom: 0; word-break: break-all'>$name</h6>
                                <div class='btnActions'>
                                    <button class='img-preview-quote btnQuoClone' value='$p_id'>$ver</button>
                                </div>
                            </div>
                        </div>
                    </div>";
            }
        }
    ?>
</div>