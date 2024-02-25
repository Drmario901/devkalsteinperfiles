<div class="container">
    <header class="header" data-header>
        <?php
            include 'navbar.php';
        ?>
    </header>
    
    <article class="container article">
        <div class="container-fluid">
            <?php
                $outerClient = true;
                include __DIR__.'/../client/settings.php';
            ?>
        </div>
    </article>

    <?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?>
</div>