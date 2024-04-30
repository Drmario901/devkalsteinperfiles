<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../../../php/conexion.php';
require __DIR__ . '/../../../php/cotizaciones/cotizaciones.php';

$acc_id = $_SESSION['emailAccount'];

$row = $conexion->query("SELECT account_nombre, account_apellido, account_url_image_perfil FROM wp_account WHERE account_correo = '$acc_id'")->fetch_assoc();

$acc_name = $row['account_nombre'];
$acc_lname = $row['account_apellido'];
$acc_img = $row['account_url_image_perfil'];

$firstLyricsName = strtoupper($acc_name[0]);
$firstLyricsLastname = strtoupper($acc_lname[0]);


if ($acc_img == '') {
    $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/' . $firstLyricsName . '/' . $firstLyricsName . '' . $firstLyricsLastname . '.png';
} else {
    $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/upload/' . $acc_img;
}

?>
<div class="container">

    <h1 class='mt-auto pb-3'>
        <a id='btn-logo' href='https://dev.kalstein.plus/plataforma/distribuidor/dashboard/'><img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/LOGO-KALSTEIIN-PLUS-2.png' alt='Kalstein' width='200' height='40'></a>
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
                    <li title="Redireccionar a subscripcion">
                        <a href="https://dev.kalstein.plus/plataforma/distribuidor/subscripcion/" class='navbar-link icon-box btn-nav-subs'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="#213280" class="bi bi-credit-card" viewBox="0 0 16 16">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1z" />
                                <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                        </a>
                    </li>

                    <li title="Abrir editor de la Tienda Virtual">
                        <a href="https://dev.kalstein.plus/plataforma/template-editor/dashboard.php" class='navbar-link icon-box'>
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 640 512" class="icon_editor_tienda">
                                <path d="M36.8 192H603.2c20.3 0 36.8-16.5 36.8-36.8c0-7.3-2.2-14.4-6.2-20.4L558.2 21.4C549.3 8 534.4 0 518.3 0H121.7c-16 0-31 8-39.9 21.4L6.2 134.7c-4 6.1-6.2 13.2-6.2 20.4C0 175.5 16.5 192 36.8 192zM64 224V384v80c0 26.5 21.5 48 48 48H336c26.5 0 48-21.5 48-48V384 224H320V384H128V224H64zm448 0V480c0 17.7 14.3 32 32 32s32-14.3 32-32V224H512z" />
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/index.php/distribuidor/inbox/' class='navbar-link icon-box'>
                            <span class='material-symbols-rounded icon position-relative'>
                                mail
                                <span id='messagesBaloon' class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style='font-family: sans-serif; font-size: 10px' hidden>
                                    <div id='messagesCant' class="unread-messages"></div>
                                </span>
                            </span>
                        </a>
                    </li>

                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/index.php/distribuidor/configuracion/' id='btnEditProfilePr01' class='navbar-link icon-box'>
                            <span class='material-symbols-rounded  icon'>settings</span>
                        </a>
                    </li>

                    <li>
                        <a href="#" id="btn-logout" class="navbar-link icon-box">
                            <span class="material-symbols-rounded  icon">logout</span>
                        </a>
                    </li>
                </div>

                <!-- tarjeta de usuario -->
                <li>
                    <a href="#" class="header-profile">

                        <figure class="profile-avatar" style="margin-top: 0.5rem;">
                            <img src="<?php echo $urlImagePerfil ?>" alt="Profile 1" style="width: 50px; height: 50px">
                        </figure>

                        <div>
                            <p class="profile-title"><?php echo $acc_name ?></p>
                            <p class="profile-subtitle" data-i18n="distribuidor:parrafoDistribuidor">Distribuidor</p>
                        </div>

                    </a>
                </li>

                <li>
                    <div style="display: flex; flex-direction: column; text-align: start; padding-right:2rem">
                        <p style="font-size: 1rem; text-align: center; width: 100%; margin-top: 2px; font-weight: 500;">
                            Pendiente: <strong style="color: #e38512;">$<?php echo $sumaTotalPendientes; ?></strong>
                        </p>
                        <p style="font-size: 1rem; text-align: start; width: 100%; font-weight: 500;">
                            Cobrado: <strong style="color: #0eab13;">$<?php echo $sumaTotalPagadas; ?></strong>
                        </p>
                    </div>
                </li>

            </ul>

            <!-- enlaces de las secciones -->
            <ul class="navbar-list">

                <li>
                    <a id="link-home" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/dashboard" class="navbar-link icon-box">
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a id="link-stock" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/productos" class="navbar-link icon-box">
                        <span data-i18n="distribuidor:linkProducts">Productos</span>
                    </a>
                </li>

                <li>
                    <a id="link-list-order" href="dev.kalstein.plus/plataforma/index.php/distribuidor/ordenes" class="navbar-link icon-box">
                        <span data-i18n="distribuidor:linkOrders">Órdenes</span>
                    </a>
                </li>

                <li>
                    <a id="link-catalogs" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/catalogos" class="navbar-link icon-box">
                        <span data-i18n="distribuidor:linkCatalogs">Catálogos</span>
                    </a>
                </li>

                <li>
                    <!-- <a id="link-shop" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/tienda" class="navbar-link icon-box">
                        <span data-i18n="distribuidor:linkShop">Tienda</span>
                    </a> -->
                    <button id="btnSearch" class="navbar-link icon-box">
                        <span data-i18n='manofacturer:tienda'>Tienda</span>
                    </button>
                </li>

                <li>
                    <a id="link-sales" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/ventas" class="navbar-link icon-box">
                        <span data-i18n="distribuidor:linkRepVentas">Reporte de ventas</span>
                    </a>
                </li>

                <li>
                    <a id="link-sales" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/subscripcion" class="navbar-link icon-box">
                        <span>Subscripciones</span>
                    </a>
                </li>

                <li class='generate-quote'> <!-- only style class-->
                    <a id='btnGenQuote' href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/productos/agregar" class='navbar-link icon-box text-white' style='color: white !important;'>
                        <span data-i18n="distribuidor:btnAgregarProducto">AGREGAR UN PRODUCTO</span>
                    </a>
                </li>
            </ul>
        </div>
        <script src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/manufacturer/js/inbox-notification.js"></script>
        <script src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/js/script.cot2.lite.js"></script>
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
<script>
    jQuery(document).ready(function($) {
        function keepSessionAlive() {
            $.ajax({
                url: plugin_dir + '/php/nameQuerySession.php',
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log("name: " + data.nameQuery);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log("Error getting name of session: " + textStatus + ", " + errorThrown);
                }
            });
        }

        var intervalMinutes = 5;
        setInterval(keepSessionAlive, intervalMinutes * 60 * 1000);
    });
</script>