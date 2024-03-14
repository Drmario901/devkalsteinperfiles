<div class="container">
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        
        include 'navdar.php';
    ?>
    <script>
  
        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>

    <article class="container article">

    <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_my_quotes';
            $banner_text = translateTextBanner($banner);
            include __DIR__.'/../manufacturer/banner.php';
            require __DIR__. '/../../../php/translations.php';

            $enEspera = $translations[$lang]['client:enEspera'];
            $cancelado = $translations[$lang]['client:cancelado'];
            $procesado = $translations[$lang]['processed'];
            $cambiarEstado = $translations[$lang]['client:cambiarEstatus'];
            $seleccionarOpcion = $translations[$lang]['client:eligeOpcion'];
            $next = $translations[$lang]['client:next'];
            $prev = $translations[$lang]['client:previo'];
            
           

            // translateText()
    ?>
        

        <nav class="nav nav-borders">
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/index.php/support/quotes/" data-i18n="support:allOrders">Toutes les commandes</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/processed-orders"  data-i18n="support:ordersProcesadas">Traitement des commandes</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/cancelled-orders"  data-i18n="support:cancelOrders">Commandes annulées</a>
        </nav>
        
        <br>
        
        <div id="listOrderTable" class="table-responsive">
            <?php
                ini_set('display_errors', 1);
                ini_set('display_startup_errors', 1);
                error_reporting(E_ALL);
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
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='support:client'>Client</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='support:total'>Total (USD)</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:date'>Date</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:status'>Statut</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:remitente'>Expéditeur</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:details'>Détails</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:Actions'>Actions</th>
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
                        var_dump($quoteStatus); 
                        echo $quoteStatus;
                        // switch ($quoteStatus) {
                        //     case '0':
                        //         $quoteStatus = 'En attente';
                        //         break;
                        //     case '2':
                        //         $quoteStatus = 'Annulé';
                        //         break;
                        //     case '3':
                        //         $quoteStatus = 'Traitée';
                        //         break;
                        // }
                        $status = '';

                        if($quoteStatus){
                            if($quoteStatus == '0') {
                                $status = 'En attente';
                            } 
                            elseif($quoteStatus == '2') {
                                $status = 'Annule';
                            }
                            elseif($quoteStatus == '3'){
                                $status = 'Traitee';
                            } 
                        }

                        echo $status;
        
                        $html .= "
                            <tr>
                                <td>$quoteId</td>
                                <td class='customer-name'>$quoteClient $quoteremitenteid</td>
                                <td>$quoteTotal</td>
                                <td>$quoteDate</td>
                                <td>$status</td>
                                <td>$quoteClientEmail</td>
                                <td>
                                    <center>
                                        <button type='button' class='btn btn-info btn-block' id='btn-details'
                                        value='$quoteId' data-i18n='support:vista'>Voir</button>
                                    </center>
                                </td>
                                <td>
                                    <form id='cotizacion_status_form'>
                                        <select name='cotizacion_status' id='cotizacion_status' class='status-select' style='color: #000 !important;'>
                                            <option value='0' data-i18n='support:selectOption'>Sélectionner</option>
                                            <option value='3' data-i18n='support:procesado'>Traitée</option>
                                            <option value='2' data-i18n='support:selectCancelado'>Annulé</option>
                                        </select>
                                        <br>
                                        <input type='hidden' id='$quoteId' name='cotizacion_status_nombre' class='$quoteId' value='$quoteId'>
                                        <button type='button' id='btn-update_quotes' class='btn btn-info btn-block' value='$quoteId' data-i18n='support:changeStatus'>Changement de statut</button>
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
                                    <center><p style='color: #000;' data-i18n='support:notfound'>Données non trouvées</p></center>
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
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='$prev'>
                        </form>
                        <form action='' method='get'>
                            <input type='hidden' name='i' value=".($nextPage).">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='$next'>
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
    jQuery(document).ready(function($){
        $(document).on("click", "#btn-update_quotes", function(){
            /* if($("#cotizacion_status").val() === '0'){
                    iziToast.show({
                        title: 'Atención!',
                        message: 'Por favor debe elegir el tipo de status',
                        position: 'center', // Puedes elegir entre "bottomRight", "bottomLeft", "topRight", "topLeft", "topCenter", "bottomCenter"
                        color: 'red', // Puedes elegir entre "red", "orange", "green", "blue", "purple"
                    });

            } */
            let form = $("#cotizacion_status_form").serialize();
            /* alert(form); */
            if (form) {
      iziToast.question({
        timeout: false,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        title: "Confirmation",
        message: '<?php echo $cambiarEstado ?>?',
        position: "center",
        buttons: [
          [
            `<button><b>✅</b></button>`,
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
              $.ajax({
                url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/updateCotizacion.php',
                method: 'POST',
                /* dataType: 'json', */
                data: form
            })
            .done(function(respuesta){
                /* let response = JSON.parse(respuesta); */
                console.log(respuesta);
                console.log(respuesta.status + " " + respuesta.mensaje);
                if(respuesta.status === "Correcto"){
                    /* alert(respuesta.status + " " + respuesta.mensaje); */
                    iziToast.show({
                        title: 'Réussite!',
                        message: 'La commande a été mise à jour avec succès',
                        position: 'center', // Puedes elegir entre "bottomRight", "bottomLeft", "topRight", "topLeft", "topCenter", "bottomCenter"
                        color: 'green', // Puedes elegir entre "red", "orange", "green", "blue", "purple"
                    });

                }
                /* alert(respuesta.cotizacion_status + " " + respuesta.cotizacion_status_nombre); */
                window.location.href = "https://dev.kalstein.plus/plataforma/index.php/support/quotes/";
            });
            },
            true,
          ],
          [
            `<button><b>❌</b></button>`,
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
        onClosing: function (instance, toast, closedBy) {
          console.log("Closing...");
        },
        onClosed: function (instance, toast, closedBy) {
          console.log("Closed...");
        },
      });
    } else {
      iziToast.warning({
        title: "Warning",
        message: '<?php echo $seleccionarOpcion ?>',
        position: "topRight",
      });
    }
                   


        });
    });
</script>