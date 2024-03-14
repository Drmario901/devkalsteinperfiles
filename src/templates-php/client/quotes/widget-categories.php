<div class='asideCategory w-100'>
    <span class='tltAsideCategory'>
        <h6 data-i18n="client:productCategories">Categorías de productos</h6>
    </span>
    <ul class='cCategory'>
        <?php
            $html = '';

            $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

            // Adjust these fields based on the language
            $lineField = "product_line_" . $lang;
            $descriptionField = "product_category_" . $lang;
            $subField = "product_subcategory_" . $lang;

            // if cookie = en then remove _en from the fields
            if ($lang == 'en') {
                $lineField = "product_line";
                $descriptionField = "product_category";
                $subField = "product_subcategory";
            }

            // get linesss

            $queryLines = "SELECT $lineField FROM wp_k_products ORDER BY $lineField ASC";	
            $resultLines = $conexion->query($queryLines);

            $already_printed = [];
                
            if ($resultLines->num_rows > 0) {
                while ($value = $resultLines->fetch_assoc()) {
                
                    // Trim y convertir a minúsculas para la comparación
                    $lineValueLower = mb_strtolower(trim($value[$lineField]), 'UTF-8');
            
                    // Verificar que el valor no sea vacío y no esté ya en el array (sin distinguir mayúsculas de minúsculas)
                    if (!empty($lineValueLower) && !in_array($lineValueLower, array_map('mb_strtolower', $already_printed))) {
                        array_push($already_printed, $value[$lineField]);
                    }
                }
            }

            // print lines

            foreach ($already_printed as $i => $line) {
                
                // line start
                $raw_line = str_replace(' ', '-', $line);
                $raw_line = str_replace('&', 'and', $raw_line);

                $html .= "
                <li class='border-top border-end border-start ps-2'>
                    <div class='d-flex flex-row justify-content-between'>
                        <span class='acordeon-line-button' value='$raw_line' style='cursor: pointer'>$line</span>
                        <buttton class='acordeon-line-button rounded-circle text-center' style='background-color: #ccc; width: 25px; height: 25px; margin: 4px; cursor: pointer' value='$raw_line'>
                            <i class='acordeon-chevron-$raw_line fa-solid fa-chevron-down' style='float: none'></i>
                        </buttton>
                    </div>
                    <ul class='acordeon-category-ul-$raw_line' hidden>
                ";

                $consulta = "SELECT $descriptionField FROM wp_k_products WHERE $lineField = '$line' ORDER BY $descriptionField ASC";	
                $resultado = $conexion->query($consulta);

                $already_printed = [];
                    
                if ($resultado->num_rows > 0) {
                    while ($value = $resultado->fetch_assoc()) {
                        if (!in_array($value[$descriptionField], $already_printed)){
                            array_push($already_printed, $value[$descriptionField]);
                        }
                    }
                }

                foreach ($already_printed as $i => $category) {
                    $raw_category = str_replace(' ', '-', $category);
                    
                    $sql2 = "SELECT * FROM wp_k_products WHERE $descriptionField = '$category'";
                    $rs2 = $conexion->query($sql2);

                    if ($rs2 === false) {
                        // Error en la consulta, maneja el error aquí
                        error_log("Error en la consulta SQL: " . $conexion->error);
                        continue; // Salta al siguiente ciclo en el bucle
                    }
                    
                    // elemento de categoria
                    $html .= "
                        <li class='border-bottom ps-3 mb-0'>
                            <div class='d-flex flex-row justify-content-between'>
                                <span class='typeCategoryWidget p-1'>$category</span>
                                
                    ";
        
                    if ($rs2->num_rows > 1) {
                        // boton de desplegar
                        $html .= "
                                <button class='acordeon-subcategory-button rounded-circle text-center' style='background-color: #ccc; width: 25px; height: 25px; margin: 4px; cursor: pointer' value='$raw_category'>
                                    <i class='acordeon-chevron-$raw_category fa-solid fa-chevron-down' style='float: none'></i>
                                </button>
                            </div>
                            <ul class='acordeon-subcategory-ul-$raw_category ms-3' hidden>
                        ";
        
                        while ($value = $rs2->fetch_assoc()) {
                            $subcategory = $value[$subField];
                            $html .= "<li class='list-subcategory-widget border-bottom'>$subcategory</li>";
                        }
        
                        $html.="</ul>";
                    }
                    else {
                        $html .= "
                            </div>
                        ";
                    }
        
                    $html .= "
                        </li>
                    ";
                }

                $html .= "
                    </ul>
                </li>
                ";
            }

            echo $html;
        ?>
    </ul>
    <hr class='mt-0'>
</div>