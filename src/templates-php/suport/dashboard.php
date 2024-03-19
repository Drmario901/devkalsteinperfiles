<div class="container">
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        include 'navdar.php';
        
        require __DIR__.'/../../../php/conexion.php';
                    
        $acc_id = $_SESSION['emailAccount'];
        $row = $conexion->query("SELECT account_nombre, account_apellido, account_url_image_perfil FROM wp_account WHERE account_correo = '$acc_id'")->fetch_assoc();
        
        $acc_name = $row['account_nombre'];
        $acc_lname = $row['account_apellido'];
        $acc_img = $row['account_url_image_perfil'];
    
        $firstLyricsName = strtoupper($acc_name[0]);
        $firstLyricsLastname = strtoupper($acc_lname[0]);
    
        if ($acc_img == ''){
            $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
        }
        else{
            $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$acc_img;
        }
    
    ?>
    <script>
        let page = "home";
    
        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>
    
    <article class="container article">

        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';

            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcomeTwo';
            $banner_text = translateTextBanner($banner) .' '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <h2 data-i18n="support:hola" class="h2 article-title">Hola <?php echo $acc_name?> </h2>
        <p data-i18n="support:welcome" class="article-subtitle">Bienvenido(a) a Soporte Dashboard!</p>
        <div id="c-panel01" class="col-sm-12" style="height: auto;">
        
        <section class="home">
            <div class="card revenue-card" style="min-height: 400px">
                <div style="position: absolute; width: 90%; height: 90%; overflow-y: auto; padding-right: 10px">
                    <h6 data-i18n="support:recentReports" class="card-title"> Reportes Recientes</h6>
                    <?php
                        require __DIR__.'/../../../db/conexion.php';
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);
    
                        echo 'Aqui va la vaina';
                    ?>
                </div>
            </div>
    
            <div class="card-wrapper">
                <div class="card task-card">
    
                    <div class="card-icon icon-box green">
                        <span class="material-symbols-rounded  icon">inventory</span>
                    </div>
                    <div>
                        <div id="reportes-completados"></div>
                        <center>
                            <p class="card-text" data-i18n="support:reportsComplete">Reportes completados</p>
                        </center>
                    </div>
    
                </div>
                <div class="card task-card">
                    
                    <div class="card-icon icon-box blue">
                        <span class="material-symbols-rounded  icon">pending_actions</span>
                    </div>
                    <div>
                        <div id="reportes-pendientes"></div>
                        <center>
                            <p class="card-text" data-i18n="support:reportsPending">Reportes Pendientes <!-- Pending reports --></p>
                    </center>
                    </div>
    
                </div>
            </div>
            
                <div class="card revenue-card">
                    <h6 class="card-title" data-i18n="support:reportsMonth">Reportes del Mes</h6>
                    <canvas id="activity"></canvas>
                    <div class="divider card-divider"></div>
                    <ul class="list">
                        <center>
                            <li id="graph-2-prevMonth" class="revenue-item icon-box"></li>
                        </center>
                    </ul>
                </div>
                <p id="will-restart" class="article-subtitle"></p>
            </div>
        </section>
    </article>
    
    <!-- FOOTER -->
    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>