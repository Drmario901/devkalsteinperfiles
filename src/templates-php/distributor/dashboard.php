<div class="container">
    <header class="header" data-header>
        <?php
            session_start(); 
            if (isset($_SESSION['emailAccount'])){
                $email = $_SESSION['emailAccount'];
        
            }
            include 'navbar.php';
        ?>
        <script>
            let page = "home";
            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>
            
    <article class="container article">
        
        <?php
            $banner_img = 'Header-distribuidor-IMG.jpg';
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcome';
            $banner_text = translateTextBanner($banner)  .', '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <div id="c-panel01" class="col-sm-12" style="height: auto;">
            <!-- 
              - #HOME
            -->
            <section class="home">
    
                <div class="card revenue-card" style="min-height: 400px">
                    <div style="position: absolute; width: 90%; height: 90%; overflow-y: auto; padding-right: 10px">
                        <h6 class="card-title" data-i18n="distribuidor:h6Cotizaciones">Cotizaciones recientes</h6>
                        <?php
                            require __DIR__.'/../../../php/conexion.php';

                            function time_elapsed_string($datetime, $full = false) {
                                $now = new DateTime;
                                $ago = new DateTime($datetime);
                                $diff = $now->diff($ago);

                                $diff_w = floor($diff->d / 7);
                                $diff->d -= $diff_w * 7;

                                $string = array(
                                    'y' => 'año',
                                    'm' => 'mes',
                                    'w' => 'semana',
                                    'd' => 'día',
                                    'h' => 'hora',
                                    'i' => 'minuto',
                                    's' => 'segundo',
                                );
                                foreach ($string as $k => &$v) {
                                    if ($diff->$k) {
                                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                                    } else {
                                        unset($string[$k]);
                                    }
                                }

                                if (!$full) $string = array_slice($string, 0, 1);
                                return $string ? 'Hace ' . implode(', ', $string) : 'Justo ahora';
                            }

                            $consulta = "SELECT cotizacion_atencion, cotizacion_create_at, cotizacion_total FROM wp_cotizacion WHERE (cotizacion_status = 'Process' OR cotizacion_status = '1') AND cotizacion_id_remitente = '$acc_id' ORDER BY cotizacion_create_at DESC LIMIT 5";
                            $resultado = $conexion->query($consulta);

                            if ($resultado->num_rows > 0){
                                while ($row = $resultado->fetch_assoc()) {

                                    $client = $row['cotizacion_atencion'];
                                    $total = $row['cotizacion_total'];
                                    $date = time_elapsed_string($row['cotizacion_create_at']);

                                    echo "
                                    <div class='card mb-2'>
                                        <div class='d-flex flex-row justify-content-between'>
                                            <div> De <b>$client</b></div>
                                            <a href='https://dev.kalstein.plus/plataforma/index.php/fabricante/ordenes'>
                                                <span class='fa-solid fa-eye btn-details ms-4' style='color: #444 !important; font-size: 16px;'></span>
                                            </a>
                                        </div>
                                        <div class='d-flex flex-row justify-content-between'>
                                            <span data-i18n='distribuidor:spanTotal'>Total: $total $</span>
                                            <span>$date</span>
                                        </div>
                                    </div>
                                    ";
                                }
                            }
                            else {
                                echo "
                                    <br>
                                    <br>
                                    <center><h6 data-i18n='distribuidor:h6NaCotizacion'>Ninguna cotización</h6></center>
                                ";
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
                            <center><data id="processed-orders" class="card-data"> -- </data></center>
                            <center style="display: flex; flex-direction: columns">
                                <p class="card-text" data-i18n="distribuidor:parrafoOrdenesProcess">Órdenes procesadas</p>
                                <a href="https://dev.kalstein.plus/plataforma/index.php/fabricante/ordenes/procesadas">
                                    &nbsp; <span class='fa-solid fa-eye btn-details'
                                        style='color: #444 !important; font-size: 16px;'></span></a>
                            </center>
                        </div>
                    </div>
    
                    <div class="card task-card">
                        <div class="card-icon icon-box blue">
                            <span class="material-symbols-rounded icon">
                                pending_actions
                            </span>
                        </div>
                        <div>
                            <center><data id="pending-orders" class="card-data" data-i18n="distribuidor:DontHaveData">No hay datos</data>
                                <center style="display: flex; flex-direction: columns">
                                    <p class="card-text" data-i18n="distribuidor:parrafoOrdenesPend">Órdenes pendientes</p>
                                    <a href="https://dev.kalstein.plus/plataforma/index.php/fabricante/ordenes/"> &nbsp;
                                        <span class='fa-solid fa-eye btn-details'
                                            style='color: #444 !important; font-size: 16px;'>
                                        </span>
                                    </a>
                                    <div id="pending-orders-indicator"
                                        style='border-radius:50%; background-color: #f02d2d; border: 2px solid #333; width: 12px; height: 12px; position: absolute; margin-left: 150px; margin-top: -1px'
                                        hidden></div>
                                </center>
                            </center>
                        </div>
                    </div>
    
                </div>
    
                <div class="card revenue-card">
                    <h6 class="card-title" data-i18n="distribuidor:h6ResumenClient">Resúmen de clientes</h6>
                    <canvas id="activity"></canvas>
                    <div class="divider card-divider"></div>
    
                    <ul class="list">
                        <center>
                            <li id="graph-2-prevMonth" class="revenue-item icon-box">
                            </li>
                        </center>
                    </ul>
                </div>
    
                <p id="will-restart" class="article-subtitle"></p>
            </section>
        </div>
    </article>
    
    <!-- FOOTER -->
    <?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?> 
</div>