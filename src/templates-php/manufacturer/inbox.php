<div class="container">
    <header class="header" data-header>
        <?php
            include 'navbar.php';
        ?>
        <script>
            let page = "mail";

            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

    <article class="container article">
        <?php
            $banner_img = 'Header-fabricante-IMG.png';
            $banner_text = "Conectar con otros usuarios";
            include 'banner.php';
        ?>
        
        <main>
            <?php
        
                $noajax = true;
                require __DIR__.'/../client/inbox.php';
        
            ?>
        </main>
    </article>

    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>
