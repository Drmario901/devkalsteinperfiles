<div class="contanier">
    <header class="header" data-header>
       <?php
            include 'navdar.php';
        ?>
        <script>
            let page = "quotes";
            document.querySelector('#' + page).classList.add("active");
            document.querySelector('#' + page).removeAttribute("style");
        </script>
    </header>
    
    <article class="container article">

        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcomeTwo';
            $banner_text = translateTextBanner($banner) .' '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/quotes/" data-i18n="support:allOrders" >Todas las Ordenes</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/processed-orders" data-i18n="support:ordersProcesadas">Ordenes Procesadas</a>
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/index.php/support/services/cancelled-orders" data-i18n="support:cancelOrders">Ordenes Canceladas</a>
        </nav>
        
        <br>
        
        <div id="listOrderTable" class="table-responsive">
            <?php
            session_start();
            $acc_id = $_SESSION['emailAccount'];
        
                require __DIR__.'/../../../php/conexion.php';
        
                $perPage = 5;
                $page = isset($_GET['i']) ? $_GET['i'] : 1;
        
                $page = intval($page);
        
                $offset = ($page - 1) * $perPage;
                $limit = $perPage;
        
                $html = "
                <table class='table custom-table'>
                    <thead class='headTableForQuote'>
                        <tr>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 50px;'>ID</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='support:client'>Cliente</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='support:total'>Total (USD)</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:date'>Fecha</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:status'>Status</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:remitente'>Remitente</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:details'>Detalles</th>
                        </tr>
                    </thead>
                    <tbody class='bodyTableForQuote'>
                ";
        
                $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status = '2' and cotizacion_id_user='$acc_id' LIMIT $offset, $limit";
        
                $resultado = $conexion->query($consulta);
        
                if ($resultado->num_rows > 0) {
        
                    while ($row = $resultado->fetch_assoc()) {
                        $quoteId = $row['cotizacion_id'];
                        $quoteClient = $row['cotizacion_atencion'];
                        $quoteClientEmail = $row['cotizacion_id_user'];
                        $quoteTotal = $row['cotizacion_total'];
                        $quoteDate = $row['cotizacion_create_at'];
                        $quoteStatus = $row['cotizacion_status'];
                        $quoteremitenteid = $row['cotizacion_id_remitente'];
                        $quoteremitentesres = $row['cotizacion_sres_remitente'];
                        
        
                        $html .= "
                        <tr>
                        <td>$quoteId</td>
                        <td class='customer-name'>$quoteClient $quoteClientEmail</td>
                        <td>$quoteTotal</td>
                        <td>$quoteDate</td>
                        <td>$quoteStatus</td>
                        <td>$quoteremitentesres $quoteremitenteid </td>
                        <td>
                            <center>
                                <button type='button' class='btn btn-info btn-block' id='btn-details'
                                 value='$quoteId'>vista</button>
                            </center>
                        </td>
                        </tr>
                        ";
                    }
        
                    $msjNoData = "";
                } else {
                    $msjNoData = "
                        <tr>
                            <td colspan='9'>
                                <div class='contentNoDataQuote'>
                                    <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
                                    <center><p style='color: #000;' data-i18n='support:notfound'>Datos no encontrados</p></center>
                                </div>
                            </td>
                        </tr>
                    ";
                }
        
                $html .= "
                    </tbody>
                </table>
                $msjNoData
                ";
        
                $prevPage = $page > 1? $page - 1 : 1;
                $nextPage = $page + 1;
        
                $html .= "
                    <div class='pagination'>
                        <form action='' method='get' style='margin-right: 8px'>
                            <input type='hidden' name='i' value=".($prevPage).">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' data-i18n='support:prev' value='&laquo; Previo'>
                        </form>
                        <form action='' method='get'>
                            <input type='hidden' name='i' value=".($nextPage).">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' data-i18n='support:next' value='Siguiente &raquo;'>
                        </form>
                    </div>
                    <input id='hiddenPage' type='hidden' value='$page'>
                ";
                    
                echo $html;
            ?>
        </div>
    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>
