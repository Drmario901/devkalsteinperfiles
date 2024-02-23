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
            $banner_text = "Calculadora de envíos";
            include __DIR__.'/../manufacturer/banner.php';
        ?>
    
        <nav class="nav nav-borders">
            <a class="nav-link" href="https://plataforma.kalstein.net/distribuidor/productos">Existencias de productos</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/distribuidor/productos/agregar">Agregar un producto</a>
            <a class="nav-link active" href="https://plataforma.kalstein.net/distribuidor/productos/calculadora">Calculadora de envíos</a>
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
