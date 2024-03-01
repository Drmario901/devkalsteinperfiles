<div class="container">
    <header class="header" data-header>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <?php
            session_start(); 
            if (isset($_SESSION['emailAccount'])){
                $email = $_SESSION['emailAccount'];
        
            }
            include 'navbar.php';
        ?>
        <script>
            let page = "shop";
            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
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

        <style>
            .btnQuo, .quantity, .i-cant, .card-text, .asideCotizacion, .showQUO{
                display: none !important;
                content: '' !important;
            }
        </style>

        <?php
            $banner_img = 'Header-fabricante-IMG.png';

            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_products';
            $banner_text = translateTextBanner($banner);
            include 'banner.php';
        ?>

        <button id="btnGenQuote" hidden></button>

        <?php 
            //GENERATE A QUOTE BUTTON
            include __DIR__.'/../client/generateQuote.php';
        ?>
    </article>

    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?> 
</div>