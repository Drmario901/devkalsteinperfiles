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
            $banner_text = "Bienvenido, $acc_name $acc_lname";
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="localhost/wp-local/suport/list_report" target="__blank" data-i18n="support:listOrders" >Lista de Reportes</a>
            <a class="nav-link" href="localhost/wp-local/suport/modreport" target="__blank" data-i18n="support:gestionReportes" >Gestion de reportes</a>
            <hr class="mt-0 mb-4">
        </nav>
        
        <br>
        <br>
        
        <input class="form-control mb-5" type="date" id="dateFrom">
        <input class="form-control mb-5" type="date" id="dateTo">
            
        <select class="form-control mb-5" id="estatus">
            <option value='' data-i18n="support:selectOption" >Selecciona una opción</option>
            <option value="solventado" data-i18n="support:selectSolventado" >solventado</option>
            <option value="pendiente" data-i18n="support:selectPending">Pendiente</option>
            <option value="cancelado" data-i18n="support:selectCancelado">Cancelado</option>
            <option value="insolvente" data-i18n="support:selectInsolvente">insolvente</option>
        </select>
                
        <input  class="form-control mb-5" type="number" id="searchreport">
        
        <div id="listOrderTable" class="table-responsive">
            <?php
                require __DIR__.'/../../../php/php_soporte/data_productos.php';
        
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
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='support:shippingMethod'>Sending method</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='support:total'>Total (USD)</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:date'>Date</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:status'>Status</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='support:details'>Details</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' >Actions</th>
                        </tr>
                    </thead>
                    <tbody class='bodyTableForQuote'>
                ";
        
                $consulta = "SELECT * FROM wp_cotizacion LIMIT $offset, $limit";
        
                $resultado = $conexion->query($consulta);
        
                if ($resultado->num_rows > 0) {
        
                    while ($row = $resultado->fetch_assoc()) {
                        $quoteId = $row['cotizacion_id'];
                        $quoteClient = $row['cotizacion_atencion'];
                        $quoteEnvio = $row['cotizacion_metodo_envio'];
                        $quoteTotal = $row['cotizacion_total'];
                        $quoteDate = $row['cotizacion_create_at'];
                        $quoteStatus = $row['cotizacion_status'];
                        $quoteClientEmail = $row['cotizacion_id_user'];
        
                        $html .= "
                            <tr>
                                <td>$quoteId</td>
                                <td class='customer-name'>$quoteClient <br> $quoteClientEmail</td>
                                <td>$quoteEnvio</td>
                                <td>$quoteTotal</td>
                                <td>$quoteDate</td>
                                <td>$quoteStatus</td>
                                <td>
                                    <center>
                                        <button type='button' class='fa-solid fa-eye btn-details' style='color: #444 !important; font-size: 16px;' value='$quoteId'></button>
                                    </center>
                                </td>
                                <td>
                                    <select name='cotizacion_status' style='color: #000 !important; border: 1px solid #aaa !important; border-radius: 4px' class='estatus-seleccionado''>
                                        <option value=''></option>
                                        <option value='3' data-i18n='support:process'>Process</option>
                                        <option value='2' data-i18n='support:cancel'>Cancel</option>
                                    </select>
                                    <button type='button' id='btnUpdate' style='color: #000 !important;' value='$quoteId' data-i18n='support:changeStatus'>Cambiar estatus</button>
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
                    <span> Page $page </span>
                    <div class='pagination'>
                        <form action='' method='get' style='margin-right: 8px'>
                            <input type='hidden' name='i' value=".($prevPage).">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Previous'>
                        </form>
                        <form action='' method='get'>
                            <input type='hidden' name='i' value=".($nextPage).">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Next &raquo;'>
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
