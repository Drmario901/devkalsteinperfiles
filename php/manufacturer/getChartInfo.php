<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
    require __DIR__ . '/../conexion.php';

    $acc_id = $_SESSION['emailAccount'] ?? NULL;

    $response = array();

    // PENDIENTE: CLASE CON LISTA DE MESES HORA DE SERVIDOR

    function days_until_monthend(){

        $total_mes = cal_days_in_month(CAL_GREGORIAN, date("m"), date("Y"));    
        $transcurrido = date("d");
    
        return $total_mes - $transcurrido;
    }    

    function prevMonth($month, $delay){
        $res = 0;
        ($month - $delay) < 0 ? $res = $month - $delay + 12 : $res = $month - $delay;

        if ($res < 10) return "0".$res;
        else return $res;
    }

    // GRAFICO 1 (ingresos en ventas en 6 meses)

    $m = date('m');
    $m2 = prevMonth($m, 1);
    $m3 = prevMonth($m, 2);
    $m4 = prevMonth($m, 3);
    $m5 = prevMonth($m, 4);
    $m6 = prevMonth($m, 5);

    $before_6_month = date("Y-$m6-00 00:00:00");
    $before_5_month = date("Y-$m5-00 00:00:00");
    $before_4_month = date("Y-$m4-00 00:00:00");
    $before_3_month = date("Y-$m3-00 00:00:00");
    $before_2_month = date("Y-$m2-00 00:00:00");
    $before_1_month = date("Y-$m-00 00:00:00");

    $query6 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE (cotizacion_status = '3' OR cotizacion_status = 'Processed') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_6_month'";
    $query5 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE (cotizacion_status = '3' OR cotizacion_status = 'Processed') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_5_month'";
    $query4 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE (cotizacion_status = '3' OR cotizacion_status = 'Processed') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_4_month'";
    $query3 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE (cotizacion_status = '3' OR cotizacion_status = 'Processed') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_3_month'";
    $query2 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE (cotizacion_status = '3' OR cotizacion_status = 'Processed') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_2_month'";
    $query1 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE (cotizacion_status = '3' OR cotizacion_status = 'Processed') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_1_month'";

    $result_6 = $conexion->query($query6)->fetch_array()[0];
    if ($result_6 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_5 = $conexion->query($query5)->fetch_array()[0];
    if ($result_5 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_4 = $conexion->query($query4)->fetch_array()[0];
    if ($result_4 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_3 = $conexion->query($query3)->fetch_array()[0];
    if ($result_3 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_2 = $conexion->query($query2)->fetch_array()[0];
    if ($result_2 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_1 = $conexion->query($query1)->fetch_array()[0];
    if ($result_1 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $response['graph_1'] = [
        $result_6 - $result_5,
        $result_5 - $result_4,
        $result_4 - $result_3,
        $result_3 - $result_2,
        $result_2 - $result_1,
        $result_1
    ];

    // ORDENES COMPLETADAS

    $query = "SELECT COUNT(*) FROM wp_cotizacion WHERE (cotizacion_status = '3' OR cotizacion_status = 'Processed') AND cotizacion_id_remitente = '$acc_id'";

    $result = $conexion->query($query)->fetch_array()[0];
    if ($result === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    
    $response['processed_orders'] = $result;

    // ORDENES PENDIENTES

    $query = "SELECT COUNT(*) FROM wp_cotizacion WHERE (cotizacion_status = '1' OR cotizacion_status = 'Process') AND cotizacion_id_remitente = '$acc_id'";

    $result = $conexion->query($query)->fetch_array()[0];
    if ($result === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    
    $response['pending_orders'] = $result;

    // GRAFICO 2 (Cantidad de ordenes a clientes en 6 meses)

    $current = date('Y-m-d h:i:s');

    $query6 = "SELECT COUNT(*)
    FROM wp_cotizacion
    WHERE (cotizacion_status = 'Processed' OR cotizacion_status = 'Process' OR cotizacion_status = 'Cancelled'
    OR cotizacion_status = '3' OR cotizacion_status = '1' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_6_month'";
    $query5 = "SELECT COUNT(*)
    FROM wp_cotizacion
    WHERE (cotizacion_status = 'Processed' OR cotizacion_status = 'Process' OR cotizacion_status = 'Cancelled'
    OR cotizacion_status = '3' OR cotizacion_status = '1' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_5_month'";
    $query4 = "SELECT COUNT(*)
    FROM wp_cotizacion
    WHERE (cotizacion_status = 'Processed' OR cotizacion_status = 'Process' OR cotizacion_status = 'Cancelled'
    OR cotizacion_status = '3' OR cotizacion_status = '1' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_4_month'";
    $query3 = "SELECT COUNT(*)
    FROM wp_cotizacion
    WHERE (cotizacion_status = 'Processed' OR cotizacion_status = 'Process' OR cotizacion_status = 'Cancelled'
    OR cotizacion_status = '3' OR cotizacion_status = '1' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_3_month'";
    $query2 = "SELECT COUNT(*)
    FROM wp_cotizacion
    WHERE (cotizacion_status = 'Processed' OR cotizacion_status = 'Process' OR cotizacion_status = 'Cancelled'
    OR cotizacion_status = '3' OR cotizacion_status = '1' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_2_month'";
    $query1 = "SELECT COUNT(*)
    FROM wp_cotizacion
    WHERE (cotizacion_status = 'Processed' OR cotizacion_status = 'Process' OR cotizacion_status = 'Cancelled'
    OR cotizacion_status = '3' OR cotizacion_status = '1' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id' AND cotizacion_create_at >= '$before_1_month'";

    // IMPORTANTE AÑADIR UNA COLUMNA QUE REEMPLACE CREATE AT POR SOLD AT

    $result_6 = $conexion->query($query6)->fetch_array()[0];
    if ($result_6 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_5 = $conexion->query($query5)->fetch_array()[0];
    if ($result_5 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_4 = $conexion->query($query4)->fetch_array()[0];
    if ($result_4 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_3 = $conexion->query($query3)->fetch_array()[0];
    if ($result_3 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_2 = $conexion->query($query2)->fetch_array()[0];
    if ($result_2 === false) {
        die("Error en la consulta: " . $conexion->error);
    }
    $result_1 = $conexion->query($query1)->fetch_array()[0];
    if ($result_1 === false) {
        die("Error en la consulta: " . $conexion->error);
    }

    $response['graph_2'] = [
        $result_6 - $result_5,
        $result_5 - $result_4,
        $result_4 - $result_3,
        $result_3 - $result_2,
        $result_2 - $result_1,
        $result_1
    ];

    $response['will_restart'] = days_until_monthend();

    echo json_encode($response);
?>
