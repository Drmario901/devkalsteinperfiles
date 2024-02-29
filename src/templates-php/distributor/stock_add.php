<div class="container">
    <header class="header" data-header>
        <?php
            
            include 'navbar.php';
    
        ?>
        <script>
            let page = "stock";
    
            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

    <article class="container article">

        <?php
            $banner_img = 'Header-distribuidor-IMG.jpg';
            $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

            // Incluir el archivo de traducciones
            require __DIR__. '/../../../php/translations.php';

            // Determinar el texto del banner según el idioma
            $banner_text_translation = isset($translations[$language]['banner_text_add_product']) ? $translations[$language]['banner_text_add_product'] : $translations['en']['banner_text_add_product'];
            
            // Incluir el banner.php pasando el texto traducido y el nombre del usuario
            $banner_text = $banner_text_translation;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
             <a class="nav-link" href="https://dev.kalstein.plus/plataforma/distribuidor/productos"><i class="fa-solid fa-share"></i> <span data-i18n="distribuidor:addProduct">Volver</span></a>
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/distribuidor/productos/agregar" data-i18n="distribuidor:addProduct">Agregar un producto</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/distribuidor/productos/calculadora" data-i18n="distribuidor:linkSendsCalculator">Calculadora de envíos</a>
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
                                <center><button type="button" id="btnSendData" name="send" class="btn btn-primary btn-block text-uppercase"  style='color: white; background-color: #de3a46 !important; border: none' data-i18n="distribuidor:addProduct" >Agregar producto ahora</button></center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>
    
    <?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?> 
</div>
