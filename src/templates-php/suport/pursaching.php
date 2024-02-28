<div class="container">
    <header class="header" data-header>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <?php
            session_start(); 
            if (isset($_SESSION['emailAccount'])){
                $email = $_SESSION['emailAccount'];
        
            }
            include 'navdar.php';
        ?>
        <script>
            let page = "shop";
            document.querySelector('#' + page).classList.add("active");
            document.querySelector('#' + page).removeAttribute("style");
        </script>
    </header>

    <article class="container article">

        <?php
            if($_GET){
                $value    = $_GET['search'];
                $category = $_GET['category'];

                echo "
                    <input id='search-bar-get-text' type='hidden' value='$value'>
                    <input id='search-bar-get-category' type='hidden' value='$category'>
                ";
            }
            else {
                echo "
                    <input id='search-bar-get-text' type='hidden' value=''>
                    <input id='search-bar-get-category' type='hidden' value=''>
                ";
            }
        ?>

        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            $banner_text = "Productos";
            include __DIR__.'/../manufacturer/banner.php';
        ?>
        
        <nav class="nav nav-borders">
        <div id="my-quotes-link-widget" class="nav-link" href="#" style='cursor: pointer' data-i18n="support:myQuote" >Mis Cotizaciones</div>
            <div id="shipping-settings-link-widget" class="nav-link" href="#" style='cursor: pointer' data-i18n="support:config" >Configuración de Cotizaciones</div>
            <div id="generate-quote-link-widget" class="nav-link active" href="#" style='cursor: pointer' data-i18n="support:products" >Productos</div>
        </nav>

        <button id="btnGenQuote" hidden></button>
        <button id="btnQuotePr01" hidden></button>
        <button id="btnHistoryQuotePR01" hidden></button>
        <button id="btnSettingQuotePR01" hidden></button>
        
        <?php 
            //MY QUOTES 
            include __DIR__.'/../client/quotes.php';
        ?>

        <?php 
            //GENERATE A QUOTE BUTTON
            include __DIR__.'/../client/generateQuote.php';
        ?>
    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?> 
</div>