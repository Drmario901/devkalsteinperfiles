<?php

    require_once __DIR__ . '/../../db/conexion.php';

    $dateFrom = $_POST['dateFrom'];
    $dateTo = $_POST['dateTo'];
    $q = $conexion->real_escape_string($_POST['inputSearch']);
    $a = $_POST['status'];

    include 'translateText.php';
    translateText();


    if ($dateTo == '' && $dateFrom == '') {
        if ($q == ''){
            if ($a == ''){
                "SELECT * FROM wp_cotizacion WHERE cotizacion_status = 'Process'";
            }else{
                $consulta = "SELECT R_id, R_nombre,R_usuario, R_Nivel, R_estado, R_agente_soporte, date_format(R_fecha, '%d/%m/%Y') as fecha_formateada  FROM wp_reportes WHERE R_estado LIKE '$a'  LIMIT $offset, $limit";
            }
        }else{
            if ($a == ''){
                $consulta = "SELECT R_id, R_nombre,R_usuario, R_Nivel, R_estado, R_agente_soporte, date_format(R_fecha, '%d/%m/%Y') as fecha_formateada  FROM wp_reportes WHERE R_id LIKE '$q' LIMIT $offset, $limit";
            }else{
                $consulta = "SELECT R_id, R_nombre,R_usuario, R_Nivel, R_estado, R_agente_soporte, date_format(R_fecha, '%d/%m/%Y') as fecha_formateada  FROM wp_reportes WHERE R_estado LIKE '$a' AND R_id LIKE '$q'  LIMIT $offset, $limit";
            }
        }
    }else{
        if ($q == ''){
            if ($a == ''){
                $consulta = "SELECT R_id, R_nombre,R_usuario, R_Nivel, R_estado, R_agente_soporte, date_format(R_fecha, '%d/%m/%Y') as fecha_formateada  FROM wp_reportes WHERE R_fecha BETWEEN '$dateFrom'  AND '$dateTo'  LIMIT $offset, $limit ";
            }else{
                $consulta = "SELECT R_id, R_nombre,R_usuario, R_Nivel, R_estado, R_agente_soporte, date_format(R_fecha, '%d/%m/%Y') as fecha_formateada  FROM wp_reportes WHERE R_estado LIKE '$a' AND R_fecha BETWEEN '$dateFrom'  AND '$dateTo' LIMIT $offset, $limit ";
            }
        }else{
            if ($a == ''){
                $consulta = "SELECT R_id, R_nombre,R_usuario, R_Nivel, R_estado, R_agente_soporte, date_format(R_fecha, '%d/%m/%Y') as fecha_formateada  FROM wp_reportes  WHERE R_fecha BETWEEN '$dateFrom'  AND '$dateTo' AND R_id LIKE '$q'  LIMIT $offset, $limit";
            }else{
                $consulta = "SELECT R_id, R_nombre,R_usuario, R_Nivel, R_estado, R_agente_soporte, date_format(R_fecha, '%d/%m/%Y') as fecha_formateada  FROM wp_reportes WHERE R_estado LIKE '$a' and R_id  LIKE '$q' AND R_fecha BETWEEN '$dateFrom'  AND '$dateTo'  LIMIT $offset, $limit";
            }
        }
    }       


    $resultado = $conexion->query($consulta);

    $i = 0;

    $html = "
    <table class='table custom-table' with='auto'>
    <thead class='headTableForQuote'>
        <tr>
        <td class='fw-bold' style='background-color: #213280; color: white;'>ID</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'  data-i17n='client:nombre'>Name</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'  data-i17n='client:usuario'>usuario</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'  data-i17n='client:nivel'>nivel</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'  data-i17n='client:estatus'>estado</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'  data-i17n='client:agenteSoporte'>agente soporte</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'  data-i17n='client:fechaTable'>fecha</td>
        <td class='fw-bold' style='background-color: #213280; color: white;'  data-i17n='client:vista'>vista</td>
        </tr>
    </thead>
    <tbody class='bodyTableForQuote'>
    ";

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 1;
            $id = $value['R_id'];
            $name = $value['R_nombre'];
        $usuario = $value['R_usuario'];
            $nivel = $value['R_Nivel'];
            $estado = $value['R_estado'];
            $agente_soporte= $value['R_agente_soporte'];
            $fecha = $value['fecha_formateada'];
            
            $html.= "                                    
                <tr>
                    <td>$id</td>
                    <td>$name</td>
                    <td>$usuario</td>
                <td>$nivel</td>
                    <td>$estado</td>
                    <td>$agente_soporte</td>
                    <td>$fecha</td>
                    <td> <button class='btn btn-info btn-block' type='button' name='view' id='btn-report-details' value='$id'  data-i17n='client:vista'>view</button></td>
                </tr>
            ";
        }

        $msjNoData = "";
    }else{
        $msjNoData = "
            <div class='contentNoDataQuote'>
            <center><span class='material-symbols-rounded  icon'>sentiment_dissatisfied</span></center>
                <center><p style='color: #000;'  data-i17n='client:dataNotFound'>Datos no encontrados</p></center>
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
?>