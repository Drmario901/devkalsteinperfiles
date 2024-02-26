<?php

    session_start();
    require __DIR__.'/../../../php/conexion.php';
                
    $acc_id = $_SESSION['emailAccount'];

    $row = $conexion->query("SELECT account_nombre, account_apellido, account_url_image_perfil FROM wp_account WHERE account_correo = '$acc_id'")->fetch_assoc();
    
    $acc_name = $row['account_nombre'];
    $acc_lname = $row['account_apellido'];
    $acc_img = $row['account_url_image_perfil'];
    $user_tag = $row['user_tag'];

    $firstLyricsName = strtoupper($acc_name[0]);
    $firstLyricsLastname = strtoupper($acc_lname[0]);


    if ($acc_img == ''){
        $urlImagePerfil = 'https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
    }else{
        $urlImagePerfil = 'https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$acc_img;
    }

?>
<div class="container">

    <h1 class='mt-auto pb-3'>
        <a id='btn-logo' href='https://kalstein.us/'><img src='https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/LOGO-KALSTEIIN-PLUS-2.png' alt='Kalstein' width='200' height='40'></a>
    </h1>

    <button class='menu-toggle-btn icon-box' data-menu-toggle-btn aria-label='Toggle Menu'>
        <span class='material-symbols-rounded  icon' style='color: #213280'>menu</span>
    </button> 

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="container">

            <!-- enlaces de opciones de cuenta -->
            <ul class="navbar-list">

                <li>
                    <a href='https://testing.kalstein.digital/index.php/rentalsale/inbox/' class='navbar-link icon-box'>
                        <span class='material-symbols-rounded  icon'>mail</span>
                    </a>
                </li>
    
                <li>
                    <a href='https://testing.kalstein.digital/index.php/rentalsale/edit-profile/' id='btnEditProfilePr01' class='navbar-link icon-box'>
                        <span class='material-symbols-rounded  icon'>settings</span>
                    </a>
                </li>
    
    
                <li>
                    <a href="#" id="btn-logout" class="navbar-link icon-box">
                        <span class="material-symbols-rounded  icon">logout</span>
                    </a>
                </li>

                <!-- tarjeta de usuario -->
                <li>
                    <a href="#" class="header-profile">

                        <figure class="profile-avatar">
                            <img src="<?php echo $urlImagePerfil?>" alt="Profile 1" width="32" height="32">
                        </figure>
                        
        
                        <div>
                            <p class="profile-title"><?php echo $acc_name .' '.$acc_lname ?></p>
                            <p class="profile-subtitle">Rental and Used</p>

                        </div>
        
                    </a>
                </li>
            </ul>

            <!-- enlaces de las secciones -->
            <ul class="navbar-list">
                
                <li>
                    <a id="link-home" href="https://testing.kalstein.digital/index.php/rentalsale/dashboard" class="navbar-link icon-box">
                        <span>Home</span>
                    </a>
                </li>
    
                <li>
                    <a id="link-stock" href="https://testing.kalstein.digital/index.php/rentalsale/stock" class="navbar-link icon-box">
                        <span>Stock</span>
                    </a>
                </li>
    
                <li>
                    <a id="link-list-order" href="https://testing.kalstein.digital/index.php/rentalsale/list-order" class="navbar-link icon-box">
                        <span>Orders</span>
                    </a>
                </li>

                <a id="link-customers" href="https://testing.kalstein.digital/index.php/rentalsale/customers" class="navbar-link icon-box">
                        <span>Rental costumers</span>
                    </a>
                </li>
    
                <li>
                    <a id="link-sales" href="https://testing.kalstein.digital/index.php/rentalsale/sales" class="navbar-link icon-box">
                        <span>Sales Report</span>
                    </a>
                </li>
            </ul>

        </div>
    </nav>
</div>
