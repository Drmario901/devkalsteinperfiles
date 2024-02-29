<div class="container">
    <header class="header" data-header>
        <?php
            
            include __DIR__.'/../navbar.php';

        ?>
        <script>
            let page = "stock";

            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

    <article class="container article">

        <?php
            $banner_img = 'Header-fabricante-IMG.png';

            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_AddaNewAccesory';
            $banner_text = translateTextBanner($banner);
            include __DIR__.'/../banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://platform.kalstein.us/index.php/manufacturer/stock"  data-i18n="manofacturer:productoStock">Products stock</a>
            <a class="nav-link" href="https://platform.kalstein.us/index.php/manufacturer/stock/add"  data-i18n="manofacturer:agregarProducto"> Add product</a>
            <a class="nav-link active" href="https://platform.kalstein.us/index.php/manufacturer/stock/add/accessories"  data-i18n="manofacturer:agregarAccesorio2"> Add accessory</a>
            <a class="nav-link" href="https://platform.kalstein.us/index.php/manufacturer/stock/shipping"  data-i18n="manofacturer:costoEnvio">Shipping Costs</a>
        </nav>
    
        <hr class="mt-0 mb-4">
    
        <div class="container tm-mt-big tm-mb-big">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <div class="row tm-edit-product-row">
                            <?php
                                $add = true;
                                include __DIR__.'/productForm.php';
                            ?>
                            <div class="col-12">
                                <center><button type="button" id="btnSendData" name="send" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none'  data-i18n="manofacturer:agregarAccesorio">Add New Accessory</button></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include __DIR__.'/../footer.php';
    ?>
</div>
