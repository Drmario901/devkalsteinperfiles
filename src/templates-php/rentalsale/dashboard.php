<?php 
    session_start(); 
    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount'];

    }
?>
<header class="header" data-header>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
   <?php
        include 'navbar.php';
    
    ?>
    <script>
        let page = "home";
        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
        
        
 <main>
        <br>
        <br>
    <article class="container article">       
      <h2 class="h2 article-title" data-i18n="rentalsale:titleHi">Hi</h2>
      <span><?php echo $acc_name .' '.$acc_lname ?></span>
      <p class="article-subtitle" data-i18n="rentalsale:subtWelcome">Welcome to Rental and Used Dashboard!</p>
      <div id="c-panel01" class="col-sm-12" style="height: auto;">
      <!-- 
      - #HOME
    -->
    <section class="home">
  
    <div class="card revenue-card" style="min-height: 400px">
                    <div style="position: absolute; width: 90%; height: 90%; overflow: scroll; padding-right: 10px">
                    <h6 class="card-title" data-i18n="rentalsale:titleRecentQ">Recent quotes.</h6>
                        <?php
                            require __DIR__.'/../../../php/conexion.php';

                            function time_elapsed_string($datetime, $full = false) {
                                $now = new DateTime;
                                $ago = new DateTime($datetime);
                                $diff = $now->diff($ago);
                            
                                $diff->w = floor($diff->d / 7);
                                $diff->d -= $diff->w * 7;
                            
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
                                return $string ? implode(', ', $string) . ' ago' : 'just now';
                            }

                            $consulta = "SELECT cotizacion_atencion, cotizacion_create_at, cotizacion_total FROM wp_cotizacion WHERE cotizacion_status = 'Process' AND cotizacion_id_remitente = '$email' LIMIT 5";
                            $resultado = $conexion->query($consulta);

                            if ($resultado->num_rows > 0){
                                while ($row = $resultado->fetch_assoc()) {

                                    $client = $row['cotizacion_atencion'];
                                    $total = $row['cotizacion_total'];
                                    $date = time_elapsed_string($row['cotizacion_create_at']);

                                    echo "
                                    <div class='card mb-2'>
                                        <div class='d-flex flex-row justify-content-between'>
                                            <div><span data-i18n='rentalsale:spanFrom'> From </span><b>$client</b></div>
                                            <a href='https://testing.kalstein.digital/index.php/equipment/list-order'>
                                                <span class='fa-solid fa-eye btn-details ms-4' style='color: #444 !important; font-size: 16px;'></span>
                                            </a>
                                        </div>
                                        <div class='d-flex flex-row justify-content-between'>
                                            <span data-i18n='rentalsale:spanTotal'>total: $total $</span>
                                            <span>$date</span>
                                        </div>
                                    </div>
                                    ";
                                }
                            }
                            else {
                            echo '<br>';
                            echo '<br>';
                            echo '<br>'; 
                            echo '<center><b><p data-i18n="rentalsale:infoNoRQ">No recent quotes</p></b><center>';
                            }

                        ?>
                    </div>
                </div>

                <div class="card-wrapper">
                    
                    <div class="card task-card">
                        <div class="card-icon icon-box green">
                            <span class="material-symbols-rounded  icon" data-i18n="rentalsale:spanInventory">inventory</span>
                        </div>
                        <div>
                            <center><data id="processed-orders" class="card-data"> -- </data></center>
                            <center style="display: flex; flex-direction: columns">
                                <p class="card-text" data-i18n="rentalsale:infoOrdComp">Orders completed</p>
                                <a href="https://testing.kalstein.digital/index.php/equipment/list-order/processed"> &nbsp; <span class='fa-solid fa-eye btn-details' style='color: #444 !important; font-size: 16px;'></span></a>
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
                            <center><data id="pending-orders" class="card-data" data-i18n="rentalsale:dataNone"> No data </data>
                            <center style="display: flex; flex-direction: columns">
                                <p class="card-text" data-i18n="rentalsale:infoPerdOrd">Pending orders</p>
                                <a href="https://testing.kalstein.digital/index.php/equipment/list-order/"> &nbsp;
                                    <span class='fa-solid fa-eye btn-details' style='color: #444 !important; font-size: 16px;'>
                                    </span>
                                </a>
                                <div id="pending-orders-indicator" style='border-radius:50%; background-color: #f02d2d; border: 2px solid #333; width: 12px; height: 12px; position: absolute; margin-left: 118px; margin-top: -1px' hidden></div>
                            </center>
                        </div>
                    </div>

                </div>

      <div class="card revenue-card">
                    <h6 class="card-title" data-i18n="rentalsale:infoCustOV">Customers overview</h6>
                    <canvas id="activity"></canvas>
                    <div class="divider card-divider"></div>

                    <ul class="list">
                    <center><li id="graph-2-prevMonth" class="revenue-item icon-box">
                    </li></center>
                </ul>
            </div>

            <p id="will-restart" class="article-subtitle"></p>
      </div>

    </section>
  </main>
      
      
      
      
      
        <!-- 
          - #FOOTER
        -->
      
        <footer class="footer">
          <div class="container">
      
            <center><p class="copyright">
              &copy; 2023
            </p>
            <a href="https://kalstein.us/" class="copyright-link">Kalstein</a>
            <p data-i18n="rentalsale:footerRights">. All Rights Reserved</p></center>
          </div>
        </footer>

        