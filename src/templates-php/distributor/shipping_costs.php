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
            $banner_img = 'Header-distribuidor-IMG.jpg';

            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_calculator_sends';
            $banner_text = translateTextBanner($banner);
            include __DIR__.'/../manufacturer/banner.php';
        ?>
    
        <nav class="nav nav-borders">
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/distribuidor/productos" data-i18n="distribuidor:productsExist" >Existencias de productos</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/distribuidor/productos/agregar" data-i18n="distribuidor:addProduct">Agregar un producto</a>
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/distribuidor/productos/calculadora" data-i18n="distribuidor:linkSendsCalculator">Calculadora de envíos</a>
        </nav>

        <?php
            include __DIR__.'/calculator.php';
        ?>
    </article>

    <?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?>
</div>
