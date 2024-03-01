<?php

    //TABLE
    session_start();

    require __DIR__.'/../conexion.php';

    $perPage = 10;
    $page = isset($_POST['u']) ? $_POST['u'] : 1;

    $page = intval($page);

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $q = $conexion->real_escape_string($_POST['consulta']);
    $a = $_POST['status'];

    if (isset($_POST['dateTo'])) {
        if ($dateTo == '' && $dateFrom == '') {
            if ($q == '') {
                if ($a == 'a') {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_remitente = 'KALSTEIN-INTERNAL' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                } else {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status LIKE '%$a%' AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                }
            } else {
                if ($a == 'a') {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE (cotizacion_id LIKE '%$q%' OR cotizacion_id_user LIKE '%$q%' OR cotizacion_sres LIKE '%$q%' OR cotizacion_atencion LIKE '%$q%') AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                } else {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status LIKE '%$a%' AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' AND (cotizacion_id LIKE '%$q%' OR cotizacion_id_user LIKE '%$q%' OR cotizacion_sres LIKE '%$q%' OR cotizacion_atencion LIKE '%$q%') ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                }
            }
        } else {
            if ($q == '') {
                if ($a == 'a') {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo 23:59:59' AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                } else {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status LIKE '%$a%' AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo 23:59:59' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                }
            } else {
                if ($a == 'a') {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo 23:59:59' AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' AND (cotizacion_id LIKE '%$q%' OR cotizacion_id_user LIKE '%$q%' OR cotizacion_sres LIKE '%$q%' OR cotizacion_atencion LIKE '%$q%') ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                } else {
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status LIKE '%$a%' AND (cotizacion_id LIKE '%$q%' OR cotizacion_id_user LIKE '%$q%' OR cotizacion_sres LIKE '%$q%' OR cotizacion_atencion LIKE '%$q%') AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo 23:59:59' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                }
            }
        }
    } else {
        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status = '1' AND cotizacion_id_remitente = 'KALSTEIN-INTERNAL' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
    }
    
    $resultado = $conexion->query($consulta);

    include 'translateText.php';
    translateText();

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td data-i17n='client:itemTabla'>Item</td>
                    <td data-i17n='client:nQuotes'>N° Quote</td>
                    <td data-i17n='client:aplication'>Applicant</td>
                    <td data-i17n='client:fechaTable'>Date</td>
                    <td data-i17n='client:pais'>Country</td>
                    <td data-i17n='client:estatus'>Status</td>
                    <td data-i17n='client:actions'>Actions</td>
                    <!--td scope='col' data-i17n='client:estatus' >Status</td-->
                </tr>
            </thead>
            <tbody id='tblQuoteClientBody' class='bodyTableForQuote'>
    ";

    if ($resultado->num_rows > 0){
        $i = ($page - 1) * $perPage;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 1;
            $id = $value["cotizacion_id"];
            $aplicante = $value["cotizacion_atencion"];
            $date = $value['cotizacion_create_at'];
            $shippingM = $value['cotizacion_envio'];
            $pais = $value['cotizacion_destino'];
            $pais = $conexion->query("SELECT en FROM wp_paises WHERE iso = '$pais'")->fetch_assoc()['en'];
            $status = $value['cotizacion_status'];
            $consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$id'";
            $resultado2 = $conexion->query($consulta2);
            $count = mysqli_num_rows($resultado2);

            $date = new DateTime($date);
            $d = date_format($date, 'M/d/Y');
            $h = date_format($date, 'H:i a');
            $newData = "$d<br>$h";

            if ($shippingM == 0.00){
                $m = "Withdrawal at factory";
            } else {
                $m = "Shipment to destination";
            }

            $statusArray = array(
                '0' => 'Pending',
                '1' => 'Process',
                '2' => 'Cancel',
                '3' => 'Processed',
                '4' => 'Deny'
            );

            $statusButtons = $status == '1'? "
            <div class='d-flex flex-row'>
                <button type='button' id='btnProcess' class='btn btn-info btn-block p-2 mt-2 mx-auto' value='$id' data-i17n='client:procesar'>Process</button>
                <button type='button' id='btnDeny' class='btn btn-danger btn-block p-2 mt-2 mx-auto' value='$id' data-i17n='client:denegar'>Deny</button>
            </div>" : '';

            $html.= "                                    
                <tr>
                    <td>$i</td>
                    <td>$id</td>
                    <td>$aplicante</td>
                    <td>$newData</td>
                    <td>$pais<br>$m</td>
                    <td>
                        $statusArray[$status]
                        $statusButtons
                    </td>
                    
                    <td>
                        <div class='d-flex flex-row align-items-center justify-content-around'>                        
                            <button type='button' id='btnInfoClientQuote' style='color: #444 !important; font-size: 16px;' data-bs-toggle='modal' data-bs-target='#exampleModal' value='$id'><i class='fa-solid fa-address-book'></i></button>
                            <button type='button' class='fa-solid fa-eye btn-details' style='color: #444 !important; font-size: 16px;' value='$id'></button>
                            <a href='https://plataforma.kalstein.net/wp-content/plugins/kalsteinCotizacion/classes/createPDF.php?idCotizacion=$id' target='__blank' style='color: green'>
                                <i class='fa-solid fa-up-right-from-square'></i>
                            </a>
                            <button type='button' id='btnDonwloadInfoClientQuote' style='color: #444 !important; font-size: 16px;' value='$id'><i class='fa-solid fa-download'></i></button>
                        </div>
                    </td>
                    <!--td style='background-color: $bgStatus;'><button style='width: 100%; height: 100%; background-color: $bgStatus; color: #fff; text-align: center; font-weight: bold;' id='btnChangeStatus' value='$id'>$status</button></td-->
                </tr>
            ";
        }

        $msjNoData = "";
    } else {
        $msjNoData = "
            <div class='contentNoDataQuote'>
                <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
                <p data-i17n='client:dataNotFound'>No data found</p>
            </div>
        ";
    }

    $html.= "
            </tbody>
        </table>
        $msjNoData
    ";

    $prevPage = $page > 1 ? $page - 1 : 1;
    $nextPage = $page + 1;

    $html .= "
        <div class='pagination'>
        <div id='currentPageIndicator'>Page: 1</div>
            <form id='form-previous' action='' method='get' style='margin-right: 8px'>
                <input id='previous' type='hidden' name='u' value='$prevPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:previo'>
            </form>
            <form id='form-next' action='' method='get'>
                <input class='next' type='hidden' name='u' value='$nextPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:next'>
            </form>
        </div>
        <input id='hiddenPage' type='hidden' value='$page'>

        <!-- Modal -->
        <div class='modal modal-xl fade' id='exampleModal' tabindex='-1' aria-labelledby='modelInfoClientQuote' aria-hidden='true'>
            <div class='modal-dialog'>
                <div class='modal-content'>
                <div class='modal-header'>
                    <h1 class='modal-title fs-5' id='modelInfoClientQuote' data-i17n='client:infoCliente'>Información de Cliente</h1>
                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close' data-i17n='client:cerrar'></button>
                </div>
                <div class='modal-body'>
                    <div class='tblInfoClient'>

                    </div>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' data-i17n='client:cerrar'>Close</button>
                </div>
                </div>
            </div>
        </div>
    ";

    echo $html;
    $conexion->close();
?>