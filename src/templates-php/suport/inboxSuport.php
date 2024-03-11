<div class="container">
    <header class="header" data-header>
        <?php

        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
            include 'navdar.php';
        ?>
    </header>

    <article class="container article">

        <?php

            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcomeTwo';
            $banner_text = translateTextBanner($banner) .' '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <main>
            <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
        
                $noajax = true;
                require __DIR__.'/../client/inbox.php';
        
            ?>
        </main>
    </article>

    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>
