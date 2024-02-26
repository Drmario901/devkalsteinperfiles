<div class="container">
    <header class="header" data-header>
        <?php
            $outerClient = true;
            
            include 'navbar.php';
        ?>
    </header>

    <article class="container article">

        <?php
            $banner_img = 'Header-fabricante-IMG.png';
            $banner_text = "Vista previa de su producto";
            include 'banner.php';
        ?>

        <div class="card mx-5">
            <?php
                $in_manu_or_distri = true;
                include __DIR__.'/wooPreviewManu.php';
            ?>
        </div>
    </article>
    
    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>
