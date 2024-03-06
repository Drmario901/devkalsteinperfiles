<div class="container">
    <header class="header" data-header>
        <?php
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
            $banner_text_translation = isset($translations[$language]['banner_text_connect_with_others']) ? $translations[$language]['banner_text_connect_with_others'] : $translations['en']['banner_text_connect_with_others'];
            
            // Incluir el banner.php pasando el texto traducido y el nombre del usuario
            $banner_text = $banner_text_translation;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <main>
            <?php
                $noajax = true;
                require __DIR__.'/../client/inbox.php';
            ?>
        </main>
    </article>

    <?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?>
</div>