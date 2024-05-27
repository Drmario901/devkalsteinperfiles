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

            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_ConnectWithOtherUsers';
            $banner_text = translateTextBanner($banner);
            include 'banner.php';
        ?>
        
        <main>
            <?php
        
                $noajax = true;
                require __DIR__.'/../client/guide.php';
        
            ?>
        </main>
    </article>

    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>