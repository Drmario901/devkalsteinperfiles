|<div class="container">
    <?php
        include 'navdar.php';
        $sql = "SELECT DISTINCT M_nombre_product FROM wp_manuales";
        $res = $conexion->query($sql);
    ?>
    <script>
        let page = "catalog";

        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>

    <article class="container article">

        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';

            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcomeThree';
            $banner_text = translateTextBanner($banner) .' '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <div id="catalogs-manuals-widget" class="nav-link active" href="#" style='cursor: pointer'>Manuales</div>
            <div id="catalogs-catalogs-widget" class="nav-link" href="#" style='cursor: pointer'>Catalogos</div>
        </nav>

        <br>

        <script>
           jQuery(document).ready(function($){
                $('#catalogs-manuals-widget').on('click', function(){
                    $('#catalogs-catalogs-widget').removeClass('active');
                    $('#catalogs-manuals-widget').addClass('active');

                    $('#container-manuals').removeAttr('hidden');
                    $('#container-catalogs').attr('hidden', '');
                });

                $('#catalogs-catalogs-widget').on('click', function(){
                    $('#catalogs-manuals-widget').removeClass('active');
                    $('#catalogs-catalogs-widget').addClass('active');

                    $('#container-catalogs').removeAttr('hidden');
                    $('#container-manuals').attr('hidden', '');
                });
            });
        </script>

        <div id='container-manuals'>
    
            <link href="https://cdn.jsdelivr.net/npm/3d-flip-book@1.9.9/css/black-book-view.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/3d-flip-book@1.9.9/dist/flip-book.min.js"></script>

            <div class="row mx-4 mb-4">
                <div class="category-select col-12 col-md-6 d-flex align-items-center px-0">
                    <i class="fa-solid fa-filter mx-3"></i>
                    <select id="category-ma" style="padding-left: 10px;">
                        <option value="" selected disabled hidden data-i18n="support:selectDefault" >Seleccione una categoria</option>
                        <?php while($fetch = $res->fetch_assoc()) : ?>
                            <option value="<?= $fetch['M_id']; ?>"><?= $fetch["M_nombre_product"] ?> </option>
                        <?php endwhile ?>
                    </select>
                </div>

                <div class="search col-12 col-md-6 d-flex align-items-center px-0">
                    <i class="fas fa-search mx-3"></i>
                    <input class="mb-0" data-placeholder="support:searchManual" data-i18n="support:searchManual" type="text" id="searchreport-ma" style="padding-left: 10px; height: 100%" placeholder="Busqueda para un manual">
                </div>
            </div>

            <div id="manuales"></div>

        </div>

        <div id='container-catalogs' hidden>
            <?php
                $banner_img = 'Header-fabricante-IMG.png';

                require __DIR__. '/../../../php/translateTextBanner.php';
                $banner = 'banner_text_catalog';
                $banner_text = translateTextBanner($banner);
                include 'banner.php';
            ?>
        
            <style>
                #category, #category-ma {
                    padding: 12px 20px;
                    display: inline-block;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box;
                }

                #searchreport, #searchreport-ma {
                    padding: 12px 20px;
                    display: inline-block;
                    border: 1px solid #ccc;
                    border-radius: 4px;
                    box-sizing: border-box; 
                }

                #catalogo, #manuales {
                    display: grid;
                    grid-gap: 20px;
                    place-items: center;
                }
        
                .g-4, .gy-4 {
                    --bs-gutter-y: 2rem;
                    --bs-gutter-x: -4.5rem;
                }
            </style>
        
            <div class="row mx-4 mb-4">
                <div class="category-select col-12 col-md-6 d-flex align-items-center px-0">
                    <i class="fa-solid fa-filter mx-3"></i>
                    <select id="category" style="padding-left: 10px;"></select>
                </div>

                <div class="search col-12 col-md-6 d-flex align-items-center px-0">
                    <i class="fas fa-search mx-3"></i>
                    <input type="text" data-placeholder="support:searchCatalogo" data-i18n="support:searchCatalogo" placeholder="Busqueda para un catalogo" id="searchreport" style="padding-left: 10px; height: 100%" class='mb-0'>
                </div>
            </div>
        
            <div id="catalogo"></div>

        </div>


    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>