<div class="container">
    <header class="header" data-header>
        <?php
            include 'navbar.php';
        ?>
        <script>
            let page = "blogs";

            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

    <article class="container article">
        <?php
            $banner_img = 'Header-distribuidor-IMG.jpg';

            require __DIR__. '/../../../php/translateTextBanner.php';
            // $banner = 'banner_text_ConnectWithOtherUsers';
            // $banner_text = translateTextBanner($banner);
            $banner_text = 'Blogs';
            include __DIR__.'/../manufacturer/banner.php';
        ?>
        
        <main>
            <?php
        
                $noajax = true;
                require __DIR__.'/../client/mainBlog.php';
                require __DIR__.'/../client/blog.php';
        
            ?>
        </main>
    </article>

    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>