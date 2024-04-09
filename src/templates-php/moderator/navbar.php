<?php

    // session_start();
    require __DIR__.'/../../../php/conexion.php';
    
    if (isset($_SESSION['privateEmailAccount'])){
        $acc_id = $_SESSION['privateEmailAccount'];
    }
    else{
        echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder');</script>";
    }

    $row = $conexion->query("SELECT account_name, account_lastname FROM wp_private_account WHERE account_email = '$acc_id'")->fetch_assoc();
    
    $acc_name = $row['account_name'];
    $acc_lname = $row['account_lastname'];
    $acc_img = '';

    $firstLyricsName = strtoupper($acc_name[0]);
    $firstLyricsLastname = strtoupper($acc_lname[0]);


    if ($acc_img == ''){
        $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
    }

?>
<!--div class="container">

    <h1>
        <img src="https://i.ibb.co/RjxjW6N/logo-kalstein-blanco.png" alt="Kalstein" width="200" height="40">
    </h1>

    <button class="menu-toggle-btn icon-box" data-menu-toggle-btn aria-label="Toggle Menu">
        <span class="material-symbols-rounded  icon">menu</span>
    </button-->

    <!-- NAVBAR -->
    <!--nav class="navbar">
        <div class="container"-->

            <!-- enlaces de las secciones -->
            <!--ul class="navbar-list"-->
                
                <!--li>
                    <a id="link-home" href="https://dev.kalstein.plus/plataforma/private-kalstein-moderator/accounts" class="navbar-link icon-box" style="color: white;">
                        <span class="material-symbols-rounded  icon">grid_view</span>
                        <span>Accounts</span>
                    </a>
                </li-->
    
                <!--li>
                    <a id="link-product" href="https://dev.kalstein.plus/plataforma/private-kalstein-moderator/products" class="navbar-link icon-box" style="color: white;">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                    </a>
                </li-->

                <!--li>
                    <a id="link-quotes" href="https://dev.kalstein.plus/plataforma/private-kalstein-moderator/quotes" class="navbar-link icon-box" style="color: white;">
                        <i class="fa-solid fa-table-list"></i>
                        <span>Quotes</span>
                    </a>
                </li-->

                <!--li>
                    <a id="link-shipping" href="https://dev.kalstein.plus/plataforma/private-kalstein-moderator/shipping" class="navbar-link icon-box" style="color: white;">
                        <i class="fa-solid fa-plane"></i>
                        <span>Shipping</span>
                    </a>
                </li-->
                <!--li>
                    <a id="link-bitacoras" href="https://dev.kalstein.plus/plataforma/private-kalstein-moderator/bitacoras" class="navbar-link icon-box" style="color: white;">
                         <i class="fa-solid fa-clipboard-list"></i>
                        <span>Bitacora</span>
                    </a>
                </li-->
            <!--/ul-->

            <!--ul class="navbar-list" style='width: 300px'>

            </ul-->


            <!-- enlaces de opciones de cuenta -->
            <!--ul class="user-action-list">

                <li>
                    <a href="#" id="btn-logout" class="navbar-link icon-box" style="color: white;">
                        <span class="material-symbols-rounded  icon">logout</span>
                    </a>
                </li-->

                <!-- tarjeta de usuario -->
                <!--li>
                    <a href="#" class="header-profile">

                        <figure class="profile-avatar">
                            <img src="<?php //echo $urlImagePerfil?>" alt="Profile 1" width="32" height="32">
                        </figure>
                        
        
                        <div>
                            <p class="profile-title" style="color: white;"><?php //echo $acc_name ?></p>
                            <p class="profile-subtitle" style="color: white;">Moderator</p>
                        </div>
        
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</div-->

<header class='header' data-header>
    <div class='container'>
        <h1 class='mt-auto pb-3'>
            <a id='btn-logo' href='https://dev.kalstein.plus/plataforma/'><img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/LOGO-KALSTEIIN-PLUS-2.png' alt='Kalstein' width='200' height='40'></a>
        </h1>                
        <button class='menu-toggle-btn icon-box' data-menu-toggle-btn aria-label='Toggle Menu'>
            <span class='material-symbols-rounded  icon' style='color: #213280'>menu</span>
        </button>                
        <nav class='navbar'>
            <div class='container'>
                <ul class='navbar-list'>
                    <div class="d-flex flex-row">
                        <li>
                            <a href='#' id='btn-logout' class='navbar-link icon-box'>
                                <span class='material-symbols-rounded  icon'>logout</span>
                            </a>
                            <p>Salir</p>
                        </li>                        
                    </div>                        
                    <li>
                        <a href='#' class='header-profile'>
                            <figure class='profile-avatar' style='margin-top: 0.5rem;'>
                                <img src='<?php echo $urlImagePerfil?>' alt='Profile 1' style='width: 50px; height: 50px'>
                            </figure>                            
                            <div>
                                <p class='profile-title' style='color: #000;'><?php echo $acc_name ?></p>
                                <p class='profile-subtitle' data-i18n="moderator:moderador">Moderador</p> 
                            </div>                            
                        </a>                         
                    </li>                        
                </ul>             
                <ul class='navbar-list'>
                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/private-kalstein-moderator/accounts' id="link-accounts" class='navbar-link icon-box'>          
                            <span data-i18n="moderator:accounts">Cuentas</span>
                        </a>
                    </li>
                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/private-kalstein-moderator/products' id='link-product' class='navbar-link icon-box'>           
                            <span data-i18n="moderator:products">Productos</span>
                        </a>
                    </li>
                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/private-kalstein-moderator/bitacoras' id='link-bitacora' class='navbar-link icon-box'>           
                            <span data-i18n="moderator:bitacora">Bitacora</span>
                        </a>
                    </li>
                    <li>
                        <a href='https://dev.kalstein.plus/plataforma/moderator/quote-verify/' id='link-render'
                            class='navbar-link icon-box'>
                            <span>Cotizaciones</span>
                        </a>
                    </li>
                    <!--li>
                        <a href='https://dev.kalstein.plus/plataforma/private-kalstein-moderator/shipping' id='link-shipping' class='navbar-link icon-box'>
                            <span>Envíos</span>
                        </a>
                    </li-->                        
                    <!--li>
                        <a href='#' id='btnReportPr01' class='navbar-link icon-box'>
                            <span>Support Services</span>
                        </a>
                    </li-->
                    <li class='generate-quote'>
                        <a href='https://dev.kalstein.plus/plataforma/moderator/quotes' class='navbar-link icon-box' style='color: white !important;'>
                            <span data-i18n="moderator:quotesMayus">COTIZACIONES</span>
                        </a>
                    </li>                       
                </ul>                        
            </div>
        </nav>                
    </div>
</header>
