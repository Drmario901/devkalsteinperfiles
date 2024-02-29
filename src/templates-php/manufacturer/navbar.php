<?php

    session_start();
    require __DIR__.'/../../../php/conexion.php';
                
    $acc_id = $_SESSION['emailAccount'];

    $row = $conexion->query("SELECT account_nombre, account_apellido, account_url_image_perfil FROM wp_account WHERE account_correo = '$acc_id'")->fetch_assoc();
    
    $acc_name = $row['account_nombre'];
    $acc_lname = $row['account_apellido'];
    $acc_img = $row['account_url_image_perfil'];

    $firstLyricsName = strtoupper($acc_name[0]);
    $firstLyricsLastname = strtoupper($acc_lname[0]);

    if ($acc_img == ''){
        $urlImagePerfil = 'https://https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
    }
    else{
        $urlImagePerfil = 'https://https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$acc_img;
    }

?>
<div class="container">

    <h1 class='mt-auto pb-3'>
        <a id='btn-logo' href='https://dev.kalstein.plus/plataforma/index.php/fabricante/dashboard'><img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/LOGO-KALSTEIIN-PLUS-2.png' alt='Kalstein' width='200' height='40'></a>
    </h1>

    <button class='menu-toggle-btn icon-box' data-menu-toggle-btn aria-label='Toggle Menu'>
        <span class='material-symbols-rounded  icon' style='color: #213280'>menu</span>
    </button> 

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container">

            <!-- enlaces de opciones de cuenta -->
            <ul class="navbar-list">
                <div class="d-flex flex-row">
                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/index.php/fabricante/inbox/' id='link-mail' class='navbar-link icon-box'>
                            <span class='material-symbols-rounded icon position-relative'>
                                mail
                                <span id='messagesBaloon' class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style='font-family: sans-serif; font-size: 10px' hidden>
                                    <div id='messagesCant' class="unread-messages"></div>
                                </span>
                            </span>
                        </a>
                    </li>
        
                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/index.php/fabricante/configuracion/' id='link-config' class='navbar-link icon-box'>
                            <span class='material-symbols-rounded icon'>settings</span>
                        </a>
                    </li>
        
        
                    <li>
                        <a href="#" id="btn-logout" class="navbar-link icon-box">
                            <span class="material-symbols-rounded icon">logout</span>
                        </a>
                    </li>
                </div>

                <!-- tarjeta de usuario -->
                <li>
                    <a href="#" class="header-profile">

                        <figure class="profile-avatar" style="margin-top: 0.5rem;">
                            <img src="<?php echo $urlImagePerfil?>" alt="Profile 1" style="width: 50px; height: 50px">
                        </figure>
                        
        
                        <div>
                            <p class="profile-title"><?php echo $acc_name ?></p>
                            <p class="profile-subtitle" data-i18n='manofacturer:fabricante'>Fabricante</p>
                        </div>
        
                    </a>
                </li>
            </ul>

            <!-- enlaces de las secciones -->
            <ul class="navbar-list">
                
                <li>
                    <a id="link-home" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/dashboard" class="navbar-link icon-box">
                        <span>Dashboard</span>
                    </a>
                </li>
    
                <li>
                    <a id="link-stock" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/productos" class="navbar-link icon-box">
                        <span data-i18n='manofacturer:productos'>Productos</span>
                    </a>
                </li>
    
                <li>
                    <a id="link-list-order" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/ordenes" class="navbar-link icon-box">
                        <span data-i18n='manofacturer:ordenes'>Órdenes</span>
                    </a>
                </li>

                <li>
                    <a id="link-catalogs" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/catalogos" class="navbar-link icon-box">
                        <span data-i18n='manofacturer:catalogos'>Catálogos</span>
                    </a>
                </li>
                
                <li>
                    <a id="link-shop" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/tienda" class="navbar-link icon-box">
                        <span data-i18n='manofacturer:tienda'>Tienda</span>
                    </a>
                </li>
    
                <li>
                    <a id="link-sales-report" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/ventas" class="navbar-link icon-box">
                        <span data-i18n='manofacturer:reportesVentas'>Reportes de ventas</span>
                    </a>
                </li>


                <li class='generate-quote'> <!-- only style class-->
                    <a id='btnGenQuote' href="https://dev.kalstein.plus/plataforma/index.php/fabricante/productos/agregar" class='navbar-link icon-box text-white' style='color: white !important;'>
                        <span data-i18n='manofacturer:agregarProductoMayus'>AGREGAR PRODUCTO</span>
                    </a>
                </li>
            </ul>

        </div>
        <script src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/manufacturer/js/inbox-notification.js"></script>
        <script src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/js/script.cot2.lite.manu.js"></script>
    </nav>
</div>
<div class="container flex-column">
    <div class="hr mb-2"></div>
    <style>
        .btn-blue {
            background-color: #213280;
            color: #fff;
            transition: background-color .3s;
        }
        .hover {
            background-color: #fff;
            color: #444;
        }
    </style>
    <?php
        echo navbar();
    ?>
</div>