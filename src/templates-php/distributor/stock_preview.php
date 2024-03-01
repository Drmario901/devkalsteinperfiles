<div class="container">
    <header class="header" data-header>
        <?php
            $outerClient = true;
            
            include 'navbar.php';
        ?>
    </header>

    <article class="container article">

        <?php
            $banner_img = 'Header-distribuidor-IMG.jpg';
            $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

            // Incluir el archivo de traducciones
            require __DIR__. '/../../../php/translations.php';

            // Determinar el texto del banner según el idioma
            $banner_text_translation = isset($translations[$language]['banner_text_preview_product']) ? $translations[$language]['banner_text_preview_product'] : $translations['en']['banner_text_preview_product'];
            
            // Incluir el banner.php pasando el texto traducido y el nombre del usuario
            $banner_text = $banner_text_translation;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <div class="card mx-5">
            <?php
                $in_manu_or_distri = true;
                include __DIR__.'/../manufacturer/wooPreviewManu.php';
            ?>
        </div>
    </article>
    
    <?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?>
</div>
