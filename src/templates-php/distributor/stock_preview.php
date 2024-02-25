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
            $banner_text = "Vista previa de su producto";
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
