<div class="container">
    <header class="header" data-header>
        <?php
            include 'navbar.php';
        ?>
    </header>
    
    <article class="container article">

        <?php
            $banner_img = 'Header-distribuidor-IMG.jpg';
            $banner_text = "Conecta con otros usuarios";
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