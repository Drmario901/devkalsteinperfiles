<div class="container">
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include 'navdar.php';
    
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
                        require __DIR__.'/../../../php/conexion.php';
    
                        function time_elapsed_string($datetime, $full = false) {
                            $now = new DateTime;
                            $ago = new DateTime($datetime);
                            $diff = $now->diff($ago);
                        
                            $diff_w = floor($diff->d / 7);
                            $diff->d -= $diff_w * 7;
                        
                            $string = array(
                                'y' => 'year',
                                'm' => 'month',
                                'w' => 'week',
                                'd' => 'day',
                                'h' => 'hour',
                                'i' => 'minute',
                                's' => 'second',
                            );
                            foreach ($string as $k => &$v) {
                                if ($diff->$k) {
                                    $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                } else {
                                    unset($string[$k]);
                                }
                            }
                        
                            if (!$full) $string = array_slice($string, 0, 1);
                            return $string ? implode(', ', $string) . ' Hace' : 'Justo Ahora';
                        }
    
                        $consulta = "SELECT R_nombre, R_product, R_Description, R_fecha FROM wp_reportes WHERE R_usuario_agente='$acc_id' AND R_estado = 'pending' LIMIT 5";
                        $resultado = $conexion->query($consulta);
    
                        if ($resultado->num_rows > 0){
                            while ($row = $resultado->fetch_assoc()) {
    
                                $client = $row['R_nombre'];
                                $producto = $row['R_product'];
                                $description= $row['R_Description'];
                                $date = time_elapsed_string($row['R_fecha']);
                                
                                echo "
                                    <div class='card mb-2'>
                                        <div class='d-flex flex-row justify-content-between'>
                                            <div data-i18n='support:from'> From </div> <b>$client</b>
                                            <a href='localhost/wp-local/list-order'>
                                                <span class='fa-solid fa-eye btn-details ms-4' style='color: #444 !important; font-size: 16px;'></span>
                                            </a>
                                        </div>
                                        <div class='d-flex flex-row justify-content-between'>
                                            <div data-i18n='support:description' >descripcion: </div> <p>$description</p>
                                            <div>$date</div>
                                        </div>
                                    </div>
                                ";
                            }
                        }
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
                        <center><p class="card-text" data-i18n="support:reportsComplete">Reportes completados</p></center>
                    </div>
    
                </div>
                <div class="card task-card">
                    
                    <div class="card-icon icon-box blue">
                        <span class="material-symbols-rounded  icon">pending_actions</span>
                    </div>
                    <div>
                        <div id="reportes-pendientes"></div>
                        <center><p class="card-text" data-i18n="support:reportsPending">Reportes Pendientes <!-- Pending reports --></p></center>
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