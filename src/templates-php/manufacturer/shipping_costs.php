<div class="container">
    <header class="header" data-header>
        <?php
            include 'navbar.php';
        ?>
        <script>
            let page = "stock";
            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

    <article class="container article">
        <?php
            $banner_img = 'Header-fabricante-IMG.png';
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_ShippingCalculation';
            $banner_text = translateTextBanner($banner);
            include 'banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/manufacturer/stock" data-i18n='manofacturer:existenciaProductos'>Existencias de productos</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/manufacturer/stock/add" data-i18n='manofacturer:agregarProducto'>Añadir producto</a>
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/index.php/manufacturer/stock/shipping" data-i18n='manofacturer:costosEnvios'>Costos de envíos</a>
        </nav>

        <?php
            include __DIR__.'/../distributor/calculator.php';
        ?>

    </article>
    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>
