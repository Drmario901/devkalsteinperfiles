<div class="container">
    <?php

        include 'navdar.php';

    ?>
    <script>
        let page = "services";

        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>

    <article class="container article">
        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            $banner_text = "Welcome, $acc_name $acc_lname";
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <select class="form-control mb-5" type="date" id="category"></select>      
        <input  class="form-control mb-5" type="text" id="searchreport" >
        <div id="services_stock"></div>
    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>