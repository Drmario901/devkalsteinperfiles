<?php

    session_start();

    require __DIR__ . '/../../../../php/conexion.php';

    $perPage = 12;
    $page = isset($_POST['nextPage']) ? intval($_POST['nextPage']) : 1;

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    $minCount = $offset + 1;

    if (isset($_SESSION['searchTags'])) {
        $searchTags = $_SESSION['searchTags'];
    }else{
        $searchTags = "";
    }

    if (isset($_SESSION['searchCategorie'])) {
        $searchCategorie = $_SESSION['searchCategorie'];
    }else{
        $searchCategorie = "All";
    }

    if ($searchTags == 'NULL' && $searchCategorie == 'NULL'){
        $sql = "SELECT * FROM wp_k_products WHERE product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type = 'rental' ORDER BY product_priceUSD ASC";
        $rs = $conexion->query($sql);
        $count = mysqli_num_rows($rs);
    }else{
        if ($searchCategorie == 'All' || $searchCategorie == 'All categories') {
            $sql = "SELECT * FROM wp_k_products WHERE (product_tags LIKE '%".$searchTags."%' OR product_category LIKE '%".$searchTags."%' OR product_subcategory LIKE '%".$searchTags."%' OR product_model LIKE '%".$searchTags."%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type = 'rental' ORDER BY product_priceUSD ASC LIMIT $offset, $limit";
            $rs = $conexion->query($sql);
            $count = mysqli_num_rows($rs);

            $sqlAll = "SELECT * FROM wp_k_products WHERE (product_tags LIKE '%".$searchTags."%' OR product_category LIKE '%".$searchTags."%' OR product_subcategory LIKE '%".$searchTags."%' OR product_model LIKE '%".$searchTags."%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type = 'rental'";
            $rsAll = $conexion->query($sqlAll);
            $countAll = mysqli_num_rows($rsAll);
            
            if ($countAll > 12){
                $maxCount = 12;
            }else{
                $maxCount = $countAll;
            }
    
            $sql1 = "SELECT * FROM wp_k_products WHERE (product_tags LIKE '%".$searchTags."%' OR product_category LIKE '%".$searchTags."%' OR product_subcategory LIKE '%".$searchTags."%' OR product_model LIKE '%".$searchTags."%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type = 'rental'";
            $rs1 = $conexion->query($sql1);
            $row = mysqli_fetch_array($rs1);
            $category = $row['product_category'];
        }
        else {
            $sql = "SELECT * FROM wp_k_products WHERE (product_tags LIKE '%".$searchTags."%' OR product_category LIKE '%".$searchTags."%' OR product_subcategory LIKE '%".$searchTags."%' OR product_model LIKE '%".$searchTags."%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_category = '".$searchCategorie."' AND product_category = '".$searchCategorie."' AND product_type = 'rental' ORDER BY product_priceUSD ASC LIMIT $offset, $limit";
            $rs = $conexion->query($sql);
            $count = mysqli_num_rows($rs);

            $sqlAll = "SELECT * FROM wp_k_products WHERE (product_tags LIKE '%".$searchTags."%' OR product_category LIKE '%".$searchTags."%' OR product_subcategory LIKE '%".$searchTags."%' OR product_model LIKE '%".$searchTags."%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_category = '".$searchCategorie."' AND product_category = '".$searchCategorie."' AND product_type = 'rental' ORDER BY product_priceUSD ASC";
            $rsAll = $conexion->query($sqlAll);
            $countAll = mysqli_num_rows($rsAll);
            
            if ($countAll > 12){
                $maxCount = 12;
            }
            else {
                $maxCount = $countAll;
            }
    
            $sql1 = "SELECT * FROM wp_k_products WHERE (product_tags LIKE '%".$searchTags."%' OR product_category LIKE '%".$searchTags."%' OR product_subcategory LIKE '%".$searchTags."%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_category = '".$searchCategorie."' OR product_model LIKE '%".$searchTags."%' AND product_category = '".$searchCategorie."' AND product_type = 'rental'";
            $rs1 = $conexion->query($sql1);
            $row = mysqli_fetch_array($rs1);
            $category = $row['product_category'];

            $sqlTotal = "SELECT * FROM wp_k_products WHERE product_type = 'used'";
            $rsTotal = $conexion->query($sqlTotal);
            $countTotal = mysqli_num_rows($rsTotal);
        }
    }

    if ($searchTags == ""){
        $html = "
                <div class='mainResultSearch-rental'>
                    <div class='RS mb-3'>
                        <span style='float: left;' data-i18n='client:mostrarResultados' >Showing results</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='minCount'>".min(1, $maxCount)."</button><span style='float: left;'>to</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='maxCount'>$maxCount</button><span style='float: left;'>of</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='totalCount'>$countAll</button><span style='float: left;'>results</span>
                    </div>";

        // depliegue de productos

        if ($rs->num_rows > 0) {

            $html.="
                    <div id='mainResultSearchDiv' class='d-flex flex-row'>
                        <div id='productContainer' class='row' style='width: 100%'>
            ";

            while ($value = $rs->fetch_assoc()) {
                $p_aid = $value['product_aid'];
                $name = $value['product_name_en'];
                $maker = $value['product_maker'];
                $model = $value['product_model'];
                $image = $value['product_image'];
                $priceUSD = $value['product_priceUSD'];
                $multi = $priceUSD * 0.18;
                $disc = number_format($priceUSD - $multi, 2);
                $rental_type = $value['product_rental_time'];

                $resultAddress = $conexion->query("SELECT wp.en pais, wc.company_ciudad ciudad, wc.company_direccion direccion FROM wp_company AS wc INNER JOIN wp_paises AS wp ON wc.company_pais = wp.iso WHERE wc.company_account_correo = '$maker';");

                $rowAddr = $resultAddress->fetch_assoc();

                $textAddr = $rowAddr['ciudad'].' - '.$rowAddr['direccion'].', '.$rowAddr['pais'];

                switch ($rental_type) {
                    case 'Per Day':
                        $rental_type = '/day';
                        break;
                    case 'Per Week':
                        $rental_type = '/week';
                        break;
                    case 'Per Month':
                        $rental_type = '/month';
                        break;
                }

                $priceUSD = number_format($priceUSD, 2);

                $used = $type == 'used'? "<p class='card-title product-title-card'><b>$condition</b></p>" : '';
                
                $html.="
                            <div class='col-sm-6 col-md-4 col-lg-3'>
                                <div class='d-flex flex-column' style='height: 100%; padding-bottom: 20px'>
                                    <div class='img-preview-quote mb-2' style=\"background-image: url('$image'); cursor: pointer\" value='$p_aid'>
                                        <i class='fa-solid fa-up-right-from-square' style='float: right; color: green !important; padding: 5px'></i>
                                    </div>
                                    <p class='card-title product-title-card'>$name</p>
                                    $used
                                    <div>
                                        <span style='display: inline'>USD$</span>
                                        <span class='prices' style='display: inline'>$priceUSD$rental_type</span>
                                    </div>
                                    <div>
                                        <i class='fa-solid fa-location-dot'></i> $textAddr
                                    </div>
                                    <div class='btnActions'>
                                        <button value='$model' class='btnQuo' data-i18n='client:cita' >Quote</button>
                                        <button class='activeModal' data-bs-toggle='modal' data-bs-target='#cotModal' style='display: none;'></button>
                                    </div>
                                </div>
                            </div>
            ";             
            }

            $html.="
                        </div>
                    </div>";
        
            
        }
        else {
            $html.="
                    <div class='row'>
                        <div class='showResults col-12 col-md-9 order-last order-md-first'>
                            <div class='nodatos'><h5 data-i18n='client:noDataBusqueda'>No data found in your search</h5></div>
                        </div>
                    </div>";
        }
    }
    else{
        $html = "
                <div class='mainResultSearch'>
                    <div class='RS mb-3'>
                        <span style='float: left;' data-i18n='client:resultadosBusqueda' >Showing results</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='minCount'>".min(1, $maxCount)."</button><span style='float: left;'>to</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='maxCount'>$maxCount</button><span style='float: left;'>of</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='totalCount'>$countAll</button><span style='float: left;' data-i18n='client:resultados'>results</span>
                    </div>";

        // depliegue de productos

        if ($rs->num_rows > 0) {

            $html.="
                                <div id='mainResultSearchDiv' class='d-flex flex-row'>
                                    <div id='productContainer' class='row' style='width: 100%'>
            ";

            while ($value = $rs->fetch_assoc()) {
                $p_aid = $value['product_aid'];
                $name = $value['product_name_en'];
                $model = $value['product_model'];
                $image = $value['product_image'];
                $priceUSD = $value['product_priceUSD'];
                $multi = $priceUSD * 0.18;
                $disc = number_format($priceUSD - $multi, 2);
                $status = $value['product_status'];

                $priceUSD = number_format($priceUSD, 2);

                $html.="
                                        <div class='col-sm-6 col-md-4 col-lg-3'>
                                            <div class='d-flex flex-column' style='height: 100%; padding-bottom: 20px'>
                                                <div class='img-preview-quote mb-2' style=\"background-image: url('$image'); cursor: pointer\" value='$p_aid'>
                                                    <i class='fa-solid fa-up-right-from-square' style='float: right; color: green !important; padding: 5px'></i>
                                                </div>
                                                <p class='card-title product-title-card'>$name</p>
                                                <div>
                                                    <span style='display: inline'>USD$</span>
                                                    <span class='prices' style='display: inline'>$priceUSD</span>
                                                </div>
                                                <div>
                                                    <p class='card-text'><small class='text-muted'>$disc -18% discount with preorder</small></p>
                                                    <span class='quantity' style='float: left;'>Quantity:</span> <input type='number' class='i-cant' id='i-cant-$model' value='1'/ style='width: 20mm; margin-left: 2mm; margin-top: -2mm; float: left;'><br>
                                                </div>
                                                <div class='btnActions'>
                                                    <button value='$model' class='btnQuo'>Quote</button>
                                                    <button class='activeModal' data-bs-toggle='modal' data-bs-target='#cotModal' style='display: none;'></button>
                                                </div>
                                            </div>
                                        </div>
                ";
            }

            $html.="
                                    </div>
                                </div>
                            </div>
                        </div>";
        
            
        }
        else {
            $html.="
                    <div class='row'>
                        <div class='showResults col-12 col-md-9 order-last order-md-first'>
                            <div class='nodatos'><h5>No data found in your search</h5></div>
                        </div>";
        }
    }

    $btn_next_visible = $countAll <= 12 ? 'hidden' : '';
    
    $prevPage = max(1, $page - 1);
    $nextPage = $page + 1;
    
    $html .= "
    <div class='pagination' style='text-align: right; margin-top: 10px;'>
        <div id='currentPageIndicatorResult' style='display: inline-block; margin-right: 10px;'>Page: $page</div>
        <form id='quote-previous-result' action='' method='get' style='display: inline-block;' hidden>
            <input id='previous' type='hidden' name='b' value='$prevPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important; padding: 3px 10px;' value='&laquo; Previous'>
        </form>
        <form id='quote-next-result' action='' method='get' style='display: inline-block;' $btn_next_visible>
            <input id='next' class='next' type='hidden' name='b' value='$nextPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important; padding: 3px 10px;' value='Next &raquo;'>
        </form>
    </div>
    <input id='hiddenPage' type='hidden' value='$page'>";
    $html.= "   </div>";
    

    echo $html;
?>

