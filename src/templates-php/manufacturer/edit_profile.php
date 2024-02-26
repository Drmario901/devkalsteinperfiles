<div class="container">
    <header class="header" data-header>
        <?php
            include 'navbar.php';
        ?>
        <script>
            let page = "config";
    
            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>
    
    <article class="container article">
        <?php
            $outerClient = true;
            include __DIR__.'/../client/settings.php';
        ?>
    </article>
    
    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>