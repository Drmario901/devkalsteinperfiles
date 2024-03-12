<?php
    ini_set( 'display_errors', 1 );
    ini_set('error_reporting', E_ALL);
    error_reporting( E_ALL | E_STRICT );
    session_start();
    require __DIR__ . '/../conexion.php';
    require_once __DIR__.'/../../php/translations.php';

    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

    $edit = $translations[$lang]['client:editar'];
    $delete = $translations[$lang]["client:deleteTable"];
    $visibility = $translations[$lang]['client:visibilidad'];
    $datosNoEncontrados = $translations[$lang]['client:dataNotFound'];
 
    $resp = array();
    $acc_id = $_SESSION['emailAccount'];
    $cate = $_POST['category'];
    $a = $_POST['status'];
    $resp['html'] = '';

    $perPage = 5;
    $page = $_POST['page'];

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    $queryAll = "SELECT COUNT(*) count FROM wp_servicios WHERE SE_correo = '$acc_id'";

    if ($cate != '0'){
        $queryAll .= "AND SE_category LIKE '%$cate%'";
    }

    if ($a != '0'){
        $queryAll .= "AND SE_estado = '$a'";
    }

    $resultAll = $conexion->query($queryAll);

    // si estoy pidiendo una página que sobrepasa el total, regreso hasta la última página válida
    $All = $resultAll->fetch_assoc()['count'];
    if($All != null){
        if ($All <= ($page - 1) * $perPage){
            $page = intdiv($All, $perPage) + ($All % $perPage > 0 ? 1 : 0);
        }
        $page = max(intval($page), 1);
    }

    // establezco los límites de la paginación
    $resp['total'] = $All;
    $resp['pagina'] = $page;
    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    $consulta = "SELECT * FROM wp_servicios WHERE SE_correo = '$acc_id'";

    if ($cate != '0'){
        $consulta .= "AND SE_category LIKE '%$cate%'";
    }

    if ($a != '0'){
        $consulta .= "AND SE_estado = '$a'";
    }

    $consulta .="LIMIT $offset, $limit";

    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $i = $offset + 1; 
        while ($value = $resultado->fetch_assoc()) {
            $id = $value['SE_id'];
            $service = $value['SE_servicio'];
            $usuario = $value['SE_agente_soporte'];
            $correo = $value['SE_correo'];
            $date = $value['SE_fecha'];
            $date = new DateTime($date);
            $fecha = date_format($date, 'Y-m-d');
            $estado = $value['SE_estado'];
            $category = $value['SE_category'];
            $desccription = $value['SE_description'];
            $company = $value['SE_company'];
            $resp['html'] .= <<<HTML
                <tr>
                    <td>$id</td>
                    <td>$service</td>
                    <td>$category</td>
                    <td>$company</td>
                    <td>$usuario</td>
                    <td>$correo</td>
                    <td> <button class='material-symbols-rounded' type='button' name='view' id='btn-service-details' value='$id'>$visibility</button></td>
                    <td>$fecha</td>
                    <td>$estado</td>
                    <td>
                        <button class='material-symbols-rounded' id='btnEditService' value='$id'>$edit</button>
                        <button class='material-symbols-rounded' id='btnDeleteService' value='$id'>$delete</button>
                    </td>
                </tr>
            HTML;
            $i++; 
        }
    } else {
        $resp['html'] = <<<HTML
            <div class='row contentNoDataQuote' style='position: relative; top: 0; left: 0; right: 0; bottom: 0; width: 100%;'>
                <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
                <center><p style='color: #000;'>$datosNoEncontrados</p></center>
            </div>
        HTML;
    }

    echo json_encode($resp);
    $conexion->close();
?>