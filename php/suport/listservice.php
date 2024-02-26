<?php

require __DIR__ . '/../conexion.php';

session_start();

$acc_id = $_SESSION['emailAccount'];
$cate = $_POST['category'];
//$q = $conexion->real_escape_string($_POST['inputSearch']);
$a = $_POST['status'];

$perPage = 5;
$page = isset($_GET['e']) ? intval($_GET['e']) : 1;

$offset = ($page - 1) * $perPage;
$limit = $perPage;

if ($cate == '') {
    if ($a == '') {
        $consulta = "SELECT * FROM wp_servicios where SE_correo= '$acc_id' LIMIT $offset, $limit";
    } else {
        $consulta = "SELECT * FROM wp_servicios WHERE SE_correo= '$acc_id' and SE_estado LIKE '%$a%' DESC LIMIT $offset, $limit";
    }
} else {
    if ($a == '') {
        $consulta = "SELECT * FROM wp_servicios WHERE SE_correo= '$acc_id' and SE_category like '%$cate%' DESC LIMIT $offset, $limit";
    } else {
        $consulta = "SELECT * FROM wp_servicios WHERE SE_correo= '$acc_id' and SE_estado LIKE '%$a%' and SE_category like '%$cate%' DESC LIMIT $offset, $limit";
    }
}

$consulta = "SELECT * FROM wp_servicios WHERE SE_correo = '$acc_id' AND SE_category LIKE '%$cate%' AND SE_estado LIKE '%$a%'";

$resultado = $conexion->query($consulta);

$html = "
<table class='table custom-table' width='auto'>
<thead class='headTableForQuote'>
    <tr>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Numero</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Servicio</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Categoria</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Compañia</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Agente de Soporte</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Correo</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Descripción</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Fecha</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Status</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'>Editar</td>
    </tr>
</thead>
<tbody id='tblListService' class='bodyTableForQuote'>
";

if ($resultado->num_rows != 0) {
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
        $company = $value['SE_company'];
        $html .= "
            <tr>
                <td>$id</td>
                <td>$service</td>
                <td>$category</td>
                <td>$company</td>
                <td>$usuario</td>
                <td>$correo</td>
                <td> <button class='material-symbols-rounded' type='button' name='view' id='btn-service-details' value='$id'>visibility</button></td>
                <td>$fecha</td>
                <td>$estado</td>
                <td>
                    <button class='material-symbols-rounded' id='btnEditService' value='$id'> edit</button>
                    <button class='material-symbols-rounded' id='btnDeleteService' value='$id'>delete</button>
                </td>
            </tr>
        ";
        $i++; 
    }

    $msjNoData = "";
} else {
    $msjNoData = "
        <div class='contentNoDataQuote'>
            <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
            <center><p style='color: #000;'>No data found</p></center>
        </div>
    ";
}

$html .= "
    </tbody>
</table>
$msjNoData
";

$prevPage = max(1, $page - 1);
$nextPage = $page + 1;

$html .= "
    <div class='pagination'>
        <div id='currentPageIndicatorService'>Pagina: $page</div>
        <form id='form-previous-service' action='' method='get' style='margin-right: 8px'>
            <input id='previous' type='hidden' name='e' value='$prevPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Previo'>
        </form>
        <form id='form-next-service' action='' method='get'>
            <input id='next' class='next' type='hidden' name='e' value='$nextPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Siguiente &raquo;'>
        </form>
    </div>
    <input id='hiddenPage' type='hidden' value='$page'>
";

echo $html;
$conexion->close();
?>
