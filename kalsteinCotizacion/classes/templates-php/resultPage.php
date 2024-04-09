<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../conexion.php';
require __DIR__ . '/translateText.php';
require __DIR__ . '/translations.php';
translateText();

// get cookie language if its set if not set default to english
$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

//formatear valores de la consulta para que sea dinamico con la cookie
//si el valor de la cookie es 'en' se elimina el sufijo '_en' de las columnas

$productName = 'product_name_' . $lang;
$productCategory = $lang == 'en' ? 'product_category' : 'product_category_' . $lang;
$productSubcategory = $lang == 'en' ? 'product_subcategory' : 'product_subcategory_' . $lang;
$productTag = $lang == 'en' ? 'product_tags' : 'product_tags_' . $lang;
$all = $translations[$lang]['all'];
$allCategories = $translations[$lang]['allCategories'];

$perPage = 12;
$page = isset($_POST['nextPage']) ? intval($_POST['nextPage']) : 1;

$offset = ($page - 1) * $perPage;
$limit = $perPage;

$minCount = $offset + 1;

if (isset($_SESSION['searchTags'])) {
    $searchTags = $_SESSION['searchTags'];
} else {
    $searchTags = "";
}

if (isset($_SESSION['searchCategorie'])) {
    $searchCategorie = $_SESSION['searchCategorie'];
} else {
    $searchCategorie = 'Todas';
}

if ($searchTags == 'NULL' && $searchCategorie == 'NULL') {
    $sql = "SELECT * FROM wp_k_products WHERE product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell') AND product_group = '0' ORDER BY product_priceUSD ASC";
    $rs = $conexion->query($sql);
    $count = mysqli_num_rows($rs);
} else {
    if ($searchCategorie == $all || $searchCategorie == $allCategories) {
        $sql = "SELECT * FROM wp_k_products WHERE ($productTag LIKE '%" . $searchTags . "%' OR $productCategory LIKE '%" . $searchTags . "%' OR $productSubcategory LIKE '%" . $searchTags . "%' OR product_model LIKE '%" . $searchTags . "%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell') AND product_group = '0' ORDER BY product_priceUSD ASC LIMIT $offset, $limit";
        $rs = $conexion->query($sql);
        $count = mysqli_num_rows($rs);

        $sqlAll = "SELECT * FROM wp_k_products WHERE ($productTag LIKE '%" . $searchTags . "%' OR $productCategory LIKE '%" . $searchTags . "%' OR $productSubcategory LIKE '%" . $searchTags . "%' OR product_model LIKE '%" . $searchTags . "%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell') AND product_group = '0'";
        $rsAll = $conexion->query($sqlAll);
        $countAll = mysqli_num_rows($rsAll);

        if ($countAll > 12) {
            $maxCount = 12;
        } else {
            $maxCount = $countAll;
        }

        $sql1 = "SELECT * FROM wp_k_products WHERE ($productTag LIKE '%" . $searchTags . "%' OR $productCategory LIKE '%" . $searchTags . "%' OR $productSubcategory LIKE '%" . $searchTags . "%' OR product_model LIKE '%" . $searchTags . "%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell') AND product_group = '0'";

        $rs1 = $conexion->query($sql1);
        $row = mysqli_fetch_array($rs1);
        $category = $row[$productCategory];
    } else {
        $sql = "SELECT * FROM wp_k_products WHERE ($productTag LIKE '%" . $searchTags . "%' OR $productCategory LIKE '%" . $searchTags . "%' OR $productSubcategory LIKE '%" . $searchTags . "%' OR product_model LIKE '%" . $searchTags . "%' OR $productCategory = '" . $searchCategorie . "') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell') AND product_group = '0' ORDER BY product_priceUSD ASC LIMIT $offset, $limit";
        $rs = $conexion->query($sql);
        $count = mysqli_num_rows($rs);

        $sqlAll = "SELECT * FROM wp_k_products WHERE ($productTag LIKE '%" . $searchTags . "%' OR $productCategory LIKE '%" . $searchTags . "%' OR $productSubcategory LIKE '%" . $searchTags . "%' OR product_model LIKE '%" . $searchTags . "%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND $productCategory = '" . $searchCategorie . "' AND $productCategory = '" . $searchTags . "' AND product_type IN ('sell') AND product_group = '0' ORDER BY product_priceUSD ASC";
        $rsAll = $conexion->query($sqlAll);
        $countAll = mysqli_num_rows($rsAll);

        if ($countAll > 12) {
            $maxCount = 12;
        } else {
            $maxCount = $countAll;
        }

        $sql1 = "SELECT * FROM wp_k_products WHERE ($productTag LIKE '%" . $searchTags . "%' OR $productCategory LIKE '%" . $searchTags . "%' OR $productSubcategory LIKE '%" . $searchTags . "%') AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND $productCategory = ' . $searchCategorie . ' OR product_model LIKE '%" . $searchTags . "%' AND $productCategory = '" . $searchCategorie . "' AND product_type IN ('sell')";
        $rs1 = $conexion->query($sql1);
        $row = mysqli_fetch_array($rs1);
        $category = $row[$productCategory];

        $sqlTotal = "SELECT * FROM wp_k_products WHERE product_type = 'used'";
        $rsTotal = $conexion->query($sqlTotal);
        $countTotal = mysqli_num_rows($rsTotal);
    }
}

if ($searchTags == "") {
    $html = "
                    <div class='mainResultSearch'>
                        <div class='RS mb-3'>
                            <span style='float: left;' data-i17n='resultados'>Mostrando resultados</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='minCount'>" . min(1, $maxCount) . "</button><span style='float: left;' data-i17n='hasta'>hasta</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='maxCount'>$maxCount</button><span style='float: left;'> - </span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='totalCount'>$countAll</button><span style='float: left;' data-i17n='results'>resultados</span>
                        </div>";

    // depliegue de productos

    if ($rs->num_rows > 0) {

        $html .= "
                                    <div id='mainResultSearchDiv' class='d-flex flex-row'>
                                        <div id='productContainer' class='row' style='width: 100%'>
                ";

        while ($value = $rs->fetch_assoc()) {
            $p_aid = $value['product_aid'];
            $name = $value[$productName];
            $model = $value['product_model'];
            $image = $value['product_image'];
            $priceUSD = $value['product_priceUSD'];
            $multi = $priceUSD * 0.18;
            $disc = number_format($priceUSD - $multi, 2);
            $type = $value['product_type'];
            $condition = $value['product_condition'];

            $priceUSD = number_format($priceUSD, 2);

            $used = $type == 'used' ? "<p class='card-title product-title-card'><b>$condition</b></p>" : '';

            $html .= "
                                        <div class='col-sm-6 col-md-4 col-lg-3'>
                                            <div class='d-flex flex-column' style='height: 100%; padding-bottom: 20px'>
                                                <div data-preview='$p_aid' id='productPreview' class='img-preview-quote mb-2' style=\"background-image: url('$image'); cursor: pointer\" value='$p_aid'>
                                                    <i class='fa-solid fa-up-right-from-square' style='float: right; color: green !important; padding: 5px'></i>
                                                </div>
                                                <p class='card-title product-title-card'>$name</p>
                                                $used
                                                <div>
                                                    <span style='display: inline'>USD$</span>
                                                    <span class='prices' style='display: inline'>$priceUSD</span>
                                                </div>
                                                <div>
                                                    <p class='card-text'><small class='text-muted'>$disc - </small><small data-i17n='discountWithPreorder'></small></p>
                                                    <span class='quantity' style='float: left;' data-i17n='cantidad' >Cantidad:</span> <input type='number' class='i-cant' id='i-cant-$model' value='1' min='0'/ style='width: 20mm; margin-left: 2mm; margin-top: -2mm; float: left;'><br>
                                                </div>
                                                <div class='btnActions'>
                                                    <button value='$model' class='btnQuo' data-i17n='quote'>Cotizar</button>
                                                    <button class='activeModal' data-bs-toggle='modal' data-bs-target='#cotModal' style='display: none;'></button>
                                                </div>
                                            </div>
                                        </div>
                ";
        }

        $html .= "
                                        </div>
                                    </div>
                                </div>
                            </div>";


    } else {
        $html .= "
                        <div class='row'>
                            <div class='showResults col-12 col-md-9 order-last order-md-first'>
                                <div class='nodatos' data-i17n='noDataFound'><h5>Datos no encontrados en tu búsqueda</h5></div>
                            </div>";
    }
} else {
    $html = "
                    <div class='mainResultSearch'>
                        <div class='RS mb-3'>
                        <span style='float: left;' data-i17n='resultados'>Mostrando resultados</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='minCount'>" . min(1, $maxCount) . "</button><span style='float: left;' data-i17n='hasta'>hasta</span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='maxCount'>$maxCount</button><span style='float: left;'> - </span><button style='float: left; min-width: 1rem; width: auto; outline: none; border: none; background: none; padding: 0; margin: 0; margin-left: 0.20rem; margin-right: 0.20rem; font-weight: bold; text-align: center;' id='totalCount'>$countAll</button><span style='float: left;' data-i17n='results'>resultados</span>
                    </div>";

    // depliegue de productos

    if ($rs->num_rows > 0) {

        $html .= "
                                    <div id='mainResultSearchDiv' class='d-flex flex-row'>
                                        <div id='productContainer' class='row' style='width: 100%'>
                ";

        while ($value = $rs->fetch_assoc()) {
            $p_aid = $value['product_aid'];
            $name = $value[$productName];
            $model = $value['product_model'];
            $image = $value['product_image'];
            $priceUSD = $value['product_priceUSD'];
            $multi = $priceUSD * 0.18;
            $disc = number_format($priceUSD - $multi, 2);
            $status = $value['product_status'];

            $priceUSD = number_format($priceUSD, 2);

            //prueba

            $html .= "
                                            <div class='col-sm-6 col-md-4 col-lg-3'>
                                                <div class='d-flex flex-column' style='height: 100%; padding-bottom: 20px'>
                                                    <div data-preview='$p_aid' id='productPreview' class='img-preview-quote mb-2 mb' style=\"background-image: url('$image'); cursor: pointer\" value='$p_aid'>
                                                        <i class='fa-solid fa-up-right-from-square' style='float: right; color: green !important; padding: 5px'></i>
                                                    </div>
                                                    <p class='card-title product-title-card'>$name</p>
                                                    $used
                                                    <div>
                                                        <span style='display: inline'>USD$</span>
                                                        <span class='prices' style='display: inline'>$priceUSD</span>
                                                    </div>
                                                    <div>
                                                        <p class='card-text'><small class='text-muted'>$disc - </small><small data-i17n='discountWithPreorder'></small></p>
                                                        <span class='quantity' style='float: left;' data-i17n='cantidad' >Cantidad:</span> <input type='number' class='i-cant' id='i-cant-$model' value='1' min='0'/ style='width: 20mm; margin-left: 2mm; margin-top: -2mm; float: left;'><br>
                                                    </div>
                                                    <div class='btnActions'>
                                                        <button value='$model' class='btnQuo' data-i17n='quote'>Cotizar</button>
                                                        <button class='activeModal' data-bs-toggle='modal' data-bs-target='#cotModal' style='display: none;'></button>
                                                    </div>
                                                </div>
                                            </div>
                    ";
        }

        $html .= "
                                        </div>
                                    </div>
                                </div>
                            </div>";


    } else {
        $html .= "
                        <div class='row'>
                            <div class='showResults col-12 col-md-9 order-last order-md-first'>
                                <div class='nodatos' data-i17n='noDataFound'><h5>Datos no encontrados en tu búsqueda</h5></div>
                            </div>";
    }
}

$btn_next_visible = $countAll <= 12 ? 'hidden' : '';

$prevPage = max(1, $page - 1);
$nextPage = $page + 1;

$html .= "
        <div class='pagination' style='text-align: right; margin-top: 10px;'>
            <div id='currentPageIndicatorResult' style='display: inline-block; margin-right: 10px;'>Pagina: $page</div>
            <form id='quote-previous-result' action='' method='get' style='display: inline-block;' hidden>
                <input id='previous' type='hidden' name='b' value='$prevPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important; padding: 3px 10px;' value='&laquo'>
            </form>
            <form id='quote-next-result' action='' method='get' style='display: inline-block;' $btn_next_visible>
                <input id='next' class='next' type='hidden' name='b' value='$nextPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important; padding: 3px 10px;' value='&raquo'>
            </form>
        </div>
        <input id='hiddenPage' type='hidden' value='$page'>";
$html .= "   </div>";


echo $html;
?>