<div id='c-panel06' style='<?php echo isset($_GET['search']) ? '' : 'display: none' ?>'>
    <?php
        $banner_img = 'Header-usuario-IMG.png';
        $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

                // Incluir el archivo de traducciones
                require __DIR__. '/../../../php/translations.php';

                // Determinar el texto del banner según el idioma
                $banner_text_translation = isset($translations[$language]['banner_text_products']) ? $translations[$language]['banner_text_products'] : $translations['en']['banner_text_products'];

                // Incluir el banner.php pasando el texto traducido
                $banner_text = $banner_text_translation;
        include 'banner.php';
    ?>

    <?php
        echo shortcode();
    ?>

    <!--nav class='nav nav-borders'>
        <a class='nav-link active ms-0' href='#' id='btnRentGenQuote'>Buy Products</a>
        <a class='nav-link' href='#' id='btnRentGenQuote'>Rent Products</a>
    </nav-->

    <div class="c-buy-products row">
        <?php
            if (isset($_GET['search'])){
                
                require __DIR__ . '/../../../php/conexion.php';
                
                $product = $_GET['search'];
                
                $query = "SELECT product_aid FROM wp_k_products WHERE product_model LIKE '%".$product."%' OR product_aid='$product' AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell') AND product_group = '0'";
                $result = $conexion->query($query);
                
                $view_woo = $result->num_rows > 0 ? true : false;
                
            }
            else {
                $view_woo = false;
            }
        ?>
        <div id='results' class='col-12 col-md-8' <?php echo $view_woo ? 'hidden' : '' ?>>
    
        </div>
        <div id='preview-item' class='col-12 col-md-8' <?php echo $view_woo ? '' : 'hidden' ?>>
            <?php
                if ($view_woo){
                    $p_get_id = $result->fetch_assoc()['product_aid'];

                    include 'wooPreview.php';
                }
            ?>
        </div>
        <div class="col-12 col-md-4 d-flex flex-column category-widget-container">
            <?php
                include 'quotes/widget-categories.php';
            ?>
            <div id='resultCot' class='mb-4 <?php echo $view_woo ? 'order-first' : '' ?>'></div>
        </div>
    </div>
    <div class="c-rent-products row">
        <?php
            // require __DIR__.'/quotes/rental.php';
        ?>
    </div>
</div>
