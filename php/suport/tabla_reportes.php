<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$acc_id = $_SESSION['emailAccount'];

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

require __DIR__ . '/../conexion.php';

require_once __DIR__ .'/../translateText.php';
require_once __DIR__ . '/../translations.php';
translateText();

$dateFrom = $_POST['dateFrom'];
$dateTo = $_POST['dateTo'];
$a = $_POST['status'];


    if ($dateTo == '' && $dateFrom == '') {
        if ($a == '0'){
            $consulta = "SELECT * FROM wp_reportes WHERE R_usuario_agente = '$acc_id' ORDER BY R_id DESC";
        }else{
            $consulta = "SELECT * FROM wp_reportes WHERE R_usuario_agente='$acc_id' AND R_estado LIKE '%$a%' ORDER BY R_id DESC";
        }
    }else{
        if ($a == '0'){
            $dateTo = $dateTo. ' 23:59:59';
            $consulta = "SELECT * FROM wp_reportes WHERE R_usuario_agente='$acc_id' AND R_fecha BETWEEN '$dateFrom' AND '$dateTo' ORDER BY R_id DESC";
        }else{
            $dateTo = $dateTo.' 23:59:59';
            $consulta = "SELECT * FROM wp_reportes WHERE R_usuario_agente='$acc_id' AND R_fecha BETWEEN '$dateFrom' AND '$dateTo' ORDER BY R_id DESC";
        }
    }
    


$resultado = $conexion->query($consulta);

/* while($fetch = $resultado->fetch_assoc()){
    echo $fetch["R_usuario_agente"];
} */

$i = 0;

$html = "
<table class='table custom-table' with='auto'>
<thead class='headTableForQuote'>
    <tr>
    <td class='fw-bold' style='background-color: #213280; color: white;'>ID</td>
    <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:fechaTable'>Fecha</td>
    <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:cliente'>Cliente</td>
    <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:servicio'>Servicio</td>
    <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:descripcion'>Descripción</td>
    <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:estatus'>Status</td>
    <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:acciones'>Acciones</td>
    
    </tr>
</thead>
<tbody class='bodyTableForQuote'>
";

if ($resultado->num_rows > 0){
    $i = 0;
    while ($value = $resultado->fetch_assoc()) {
        $i = $i + 1;
        $id = $value['R_id'];
        $idServicio = $value['R_id_servicio'];
        $usuario = $value['R_usuario'];
        $consulta2 = "SELECT * FROM wp_account WHERE account_correo = '$usuario'";
        $resultado2 = $conexion->query($consulta2);
        $row2 = mysqli_fetch_array($resultado2);
        $nameAgent = $row2['account_nombre'];
        $lastnameAgent = $row2['account_apellido'];
        $completeNameAgent = $nameAgent.' '.$lastnameAgent;
        $tipo_us= $value['R_Tipo_US'];
        $nivel = $value['R_Nivel'];
        $estado = $value['R_estado'];
        $description = $value['R_Description'];
        $agente_soporte= $value['R_agente_soporte'];
        $date = $value['R_fecha'];        
        $date = new DateTime($date);
        $fecha = date_format($date, 'Y-m-d');
        $correo= $value['R_usuario_agente'];
        $company= $value['R_company'];

        $consulta3 = "SELECT * FROM wp_servicios WHERE SE_id = '$idServicio'";
        $resultado3 = $conexion->query($consulta3);
        $row3 = mysqli_fetch_array($resultado3);
        $nameService = $row3['SE_servicio'];


        if($estado == 'Pendiente'){
            $estado = $translations[$lang]['pendiente'];
        } else {
            $estado = $translations[$lang]['processed'];
        };

        $html.= "                                    
            <tr>
                <td>$i</td>
                <td style='width: 6rem;'>$fecha</td>
                <td>$completeNameAgent</td>
                <td>$nameService</td>
                <td>$description</td>
                <td>$estado</td>
                <td><button class='btn btn-info' type='button' id='btn-report-details' value='$id' data-bs-toggle='modal' data-bs-target='#modalReportSupport' data-i17n='client:responder'>Responder</button>
                </td>
            </tr>
        ";
    }

    $msjNoData = "";
}else{
    $msjNoData = "
        <div class='contentNoDataQuote'>
        <center><span class='material-symbols-rounded  icon'>sentiment_dissatisfied</span></center>
            <center><p style='color: #000;' data-i17n='client:dataNotFound'>No data found</p></center>
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