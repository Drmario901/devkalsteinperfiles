<div class="container">
    <?php
            
        include 'navdar.php';
    ?>
    <script>
        let page = "quotes";

        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>

    <article class="container article">

        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            $banner_text = "Bienvenido(a), $acc_name $acc_lname";
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link active" href="https://plataforma.kalstein.net/index.php/support/quotes/">Todas las ordenes</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/index.php/support/services/processed-orders">Ordenes Procesadas</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/index.php/support/services/cancelled-orders">Ordenes Canceladas</a>
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
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;'>Cliente</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;'>Total (USD)</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Fecha</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Status</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Remitente</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Detalles</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Acciones</th>
                        </tr>
                    </thead>
                    <tbody class='bodyTableForQuote'>
                ";
        
                $consulta = "SELECT * FROM wp_cotizacion where cotizacion_id_user= '$acc_id' and cotizacion_status= '0' LIMIT $offset, $limit";
        
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
                                        value='$quoteId'>view</button>
                                    </center>
                                </td>
                                <td>
                                    <form id='cotizacion_status_form'>
                                        <select name='cotizacion_status' id='cotizacion_status' class='status-select' style='color: #000 !important;'>
                                            <option value=''></option>
                                            <option value='3'>Procesado</option>
                                            <option value='2'>Cancelado</option>
                                        </select>
                                        <br>
                                        <input type='hidden' id='$quoteId' name='cotizacion_status_nombre' class='$quoteId' value='$quoteId'>
                                        <button type='button' id='btn-update' class='btn btn-info btn-block' value='$quoteId'>Cambiar status</button>
                                    </form>
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
                                    <center><p style='color: #000;'>Datos no encontrados</p></center>
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
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Previo'>
                        </form>
                        <form action='' method='get'>
                            <input type='hidden' name='i' value=".($nextPage).">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Siguiente &raquo;'>
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

<script>
    /* jQuery(document).ready(function($){
        $(document).on("click", "#btn-update", function(){
            let form = $("#cotizacion_status_form").serialize(); */
            /* alert(form); */

            /* $.ajax({
                url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/suport/updateCotizacion.php',
                method: 'POST', */
                /* dataType: 'json', */
               /*  data: form
            })
            .done(function(respuesta){ */
                /* let response = JSON.parse(respuesta); */
                /* console.log(respuesta);
                console.log(respuesta.cotizacion_status + " " + respuesta.cotizacion_status_nombre); */
               /*  alert(respuesta.cotizacion_status + " " + respuesta.cotizacion_status_nombre); */
                /* window.location = "https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/templates-php/suport/Suport_Quotes.php"; */
            /* });

        });
    }); */
</script>
