<?php
    /*session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require __DIR__ . '/conexion.php';

    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $q = $conexion->real_escape_string($_POST['consulta']);
    $a = $_POST['status'];

    if (isset($_POST['dateTo'])){        
        if ($dateTo == '' && $dateFrom == '') {
            if ($q == ''){
                if ($a == '0'){
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
                }else{
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%'";
                }
            }else{
                if ($a == '0'){
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_id LIKE '%".$q."%'";
                }else{
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%' AND cotizacion_id LIKE '%".$q."%'";
                }
            }
        }else{
            if ($q == ''){
                if ($a == '0'){
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo'";
                }else{
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo'";
                }
            }else{
                if ($a == '0'){
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo' AND cotizacion_id LIKE '%".$q."%'";
                }else{
                    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%' AND cotizacion_id LIKE '%".$q."%' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo'";
                }
            }
        }       
    }else{
        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
    }

    $resultado = $conexion->query($consulta);

    $i = 0;

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td scope='col'>Item</td>
                    <td scope='col'>N° Quote</td>
                    <td scope='col'>Date</td>
                    <td scope='col'>Output quantity</td>
                    <td scope='col'>Shipment method</td>
                    <td scope='col'>View</td>
                    <td scope='col'>Delete</td>
                    <td scope='col'>Status</td>
                </tr>
            </thead>
            <tbody class='bodyTableForQuote'>
    ";

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 01;
            $id = $value["cotizacion_id"];
            $date = $value['cotizacion_create_at'];
            $shippingM = $value['cotizacion_envio'];
            $status = $value['cotizacion_status'];
            $consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$id'";
            $resultado2 = $conexion->query($consulta2);
            $count = mysqli_num_rows($resultado2);

            $date = new DateTime($date);
            $newData = date_format($date, 'Y-m-d H:iA');

            if ($shippingM == 0.00){
                $m = "Withdrawal at factory";
            }else{
                $m = "Shipment to destination";
            }

            if ($status == 'Pending'){
                $bgStatus = '#e38512';
            }else{
                if ($status == 'Process' || $status == 'Processed'){
                    $bgStatus = '#0eab13';
                }else{
                    $bgStatus = '#e61212';
                }                
            }

            $html.= "                                    
                <tr>
                    <td>$i</td>
                    <td class='fw-bold''>$id</td>
                    <td>$newData</td>
                    <td>$count</td>
                    <td>$m</td>
                    <td><Button value='$id' id='btnViewQuote' style='margin: 0 auto; color: green;'><i class='fa-solid fa-up-right-from-square'></i></Button></td>
                    <td><Button value='$id' id='btnDeleteQuote' style='margin: 0 auto; color: red;'><i class='fa-solid fa-trash'></i></Button></td>
                    <td style='background-color: $bgStatus;'><button style='width: 100%; height: 100%; background-color: $bgStatus; color: #fff; text-align: center; font-weight: bold;' id='btnChangeStatus' value='$id'>$status</button></td>
                </tr>
            ";
		}

        $msjNoData = "";
    }else{
        $msjNoData = "
            <div class='contentNoDataQuote'>
                <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
                <p>No data found</p>
            </div>
        ";
    }

    $html.= "
            </tbody>
        </table>
        $msjNoData
    ";

    echo $html;
    $conexion->close();
    ?>*/

        //TABLE
        session_start();
        if(isset($_SESSION["emailAccount"])){
            $email = $_SESSION["emailAccount"];
        }

        require __DIR__.'/conexion.php';

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
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    } else {
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    }
                } else {
                    if ($a == 'a') {
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_id LIKE '%".$q."%' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    } else {
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%' AND cotizacion_id LIKE '%".$q."%' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    }
                }
            } else {
                if ($q == '') {
                    if ($a == 'a') {
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    } else {
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    }
                } else {
                    if ($a == 'a') {
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo' AND cotizacion_id LIKE '%".$q."%' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    } else {
                        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status LIKE '%".$a."%' AND cotizacion_id LIKE '%$q%' AND cotizacion_create_at BETWEEN '$dateFrom' AND '$dateTo' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
                    }
                }
            }
        } else {
            $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
        }
        
        $resultado = $conexion->query($consulta);

        $html = "
            <table class='table custom-table'>
                <thead class='headTableForQuote'>
                    <tr>
                        <td scope='col'>Item</td>
                        <td scope='col'>N° Cotización</td>
                        <td scope='col'>Fecha</td>
                        <td scope='col'>Cantidad</td>
                        <td scope='col'>Método de envío</td>
                        <td scope='col'>Ver</td>
                        <td scope='col'>Borrar</td>
                        <td scope='col'>Estatus</td>
                    </tr>
                </thead>
                <tbody id='tblQuoteClientCuca' class='bodyTableForQuote'>
        ";

        if ($resultado->num_rows > 0){
            $i = ($page - 1) * $perPage;
            while ($value = $resultado->fetch_assoc()) {
                $i = $i + 1;
                $id = $value["cotizacion_id"];
                $date = $value['cotizacion_create_at'];
                $shippingM = $value['cotizacion_envio'];
                $status = $value['cotizacion_status'];
                $consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$id'";
                $resultado2 = $conexion->query($consulta2);
                $count = mysqli_num_rows($resultado2);

                $date = new DateTime($date);
                $newData = date_format($date, 'Y-m-d H:iA');

                if ($shippingM == 0.00){
                    $m = "Retiro en fábrica";
                } else {
                    $m = "Envío a destino";
                }

                if ($status == '0' || $status == '' || $status == 'Pending'){
                    $bgStatus = '#e38512';
                } else {
                    if ($status == '1'){
                        $bgStatus = 'blue'; 
                    } elseif ($status == '3' || $status == 'Process' || $status == 'Processed'){
                        $bgStatus = '#0eab13';
                    } else {
                        $bgStatus = '#e61212';
                    }                
                }
                

                $status_dir = array(
                    '' => 'Pendiente',
                    '0' => 'Pendiente',
                    '1' => 'Procesar',
                    '2' => 'Cancelar',
                    '3' => 'Procesado',
                    '4' => 'Cancelado'
                );

                $status_text = isset($status_dir[$status]) ? $status_dir[$status] : 'Pendiente';

                $html.= "                                    
                    <tr>
                        <td>$i</td>
                        <td class='fw-bold'>$id</td>
                        <td>$newData</td>
                        <td>$count</td>
                        <td>$m</td>
                        <td><Button value='$id' id='btnViewQuote' style='margin: 0 auto; color: green;'><i class='fa-solid fa-up-right-from-square'></i></Button></td>
                        <td><Button value='$id' id='btnDeleteQuote' style='margin: 0 auto; color: red;'><i class='fa-solid fa-trash'></i></Button></td>
                        <td style='background-color: $bgStatus;'><button style='width: 100%; height: 100%; background-color: $bgStatus; color: #fff; text-align: center; font-weight: bold;' id='btnChangeStatus' value='$id'>$status_text</button></td>
                    </tr>
                ";
            }

            $msjNoData = "";
        } else {
            $msjNoData = "
                <div class='contentNoDataQuote'>
                    <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
                    <p>No se han encontrado datos</p>
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
                    <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Anterior'>
                </form>
                <form id='form-next' action='' method='get'>
                    <input class='next' type='hidden' name='u' value='$nextPage'>
                    <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Siguiente &raquo;'>
                </form>
            </div>
            <input id='hiddenPage' type='hidden' value='$page'>
        ";

        echo $html;
        $conexion->close();
        ?>