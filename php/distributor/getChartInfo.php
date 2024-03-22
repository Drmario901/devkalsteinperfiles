<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start(); 

    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount'];
    }

    require_once __DIR__ . '/../../db/conexion.php';

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

    $query_processed_orders = "SELECT COUNT(*) FROM wp_cotizacion WHERE cotizacion_status = '3' AND cotizacion_id_remitente = '$email'";
    $result_processed_orders = $conexion->query($query_processed_orders)->fetch_array()[0];
    $response['processed_orders'] = $result_processed_orders;

    $query_pending_orders = "SELECT COUNT(*) FROM wp_cotizacion WHERE cotizacion_status = '1' AND cotizacion_id_remitente = '$email'";
    $result_pending_orders = $conexion->query($query_pending_orders)->fetch_array()[0];
    $response['pending_orders'] = $result_pending_orders;

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

    $query6_1 = "SELECT SUM(wp_cotizacion.cotizacion_total) AS total_sum
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_6_month' AND cotizacion_id_remitente = '$email'";
    $query5_1 = "SELECT SUM(wp_cotizacion.cotizacion_total) AS total_sum
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_5_month' AND cotizacion_id_remitente = '$email'";
    $query4_1 = "SELECT SUM(wp_cotizacion.cotizacion_total) AS total_sum
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_4_month' AND cotizacion_id_remitente = '$email'";
    $query3_1 = "SELECT SUM(wp_cotizacion.cotizacion_total) AS total_sum
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_3_month' AND cotizacion_id_remitente = '$email'";
    $query2_1 = "SELECT SUM(wp_cotizacion.cotizacion_total) AS total_sum
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_2_month' AND cotizacion_id_remitente = '$email'";
    $query1_1 = "SELECT SUM(wp_cotizacion.cotizacion_total) AS total_sum
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_1_month' AND cotizacion_id_remitente = '$email'";

    $result_6_1 = $conexion->query($query6_1)->fetch_array()[0];
    $result_5_1 = $conexion->query($query5_1)->fetch_array()[0];
    $result_4_1 = $conexion->query($query4_1)->fetch_array()[0];
    $result_3_1 = $conexion->query($query3_1)->fetch_array()[0];
    $result_2_1 = $conexion->query($query2_1)->fetch_array()[0];
    $result_1_1 = $conexion->query($query1_1)->fetch_array()[0];

    $response['graph_1'] = [
        $result_6_1 - $result_5_1,
        $result_5_1 - $result_4_1,
        $result_4_1 - $result_3_1,
        $result_3_1 - $result_2_1,
        $result_2_1 - $result_1_1,
        $result_1_1
    ];

    // TOTAL INCOME

    $m = date('m');
    $m2 = prevMonth($m, 1);

    $before_1_month = date("Y-$m-00 00:00:00");
    $before_2_month = date("Y-$m2-00 00:00:00");

    $query1 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_1_month' AND cotizacion_id_remitente = '$email'";
    $query2 = "SELECT SUM(wp_cotizacion.cotizacion_total)
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_2_month' AND cotizacion_id_remitente = '$email'";

    $result_1 = $conexion->query($query1)->fetch_array()[0];
    $result_2 = $conexion->query($query2)->fetch_array()[0];

    $response['total_income'] = $result_2 - $result_1;

    // GRAFICO 2 (Cantidad de ordenes a clientes en 6 meses)

    $current = date('Y-m-d h:i:s');

    $query6_2 = "SELECT COUNT(*) AS total_count
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_6_month' AND cotizacion_id_remitente = '$email'";
    $query5_2 = "SELECT COUNT(*) AS total_count
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_5_month' AND cotizacion_id_remitente = '$email'";
    $query4_2 = "SELECT COUNT(*) AS total_count
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_4_month' AND cotizacion_id_remitente = '$email'";
    $query3_2 = "SELECT COUNT(*) AS total_count
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_3_month' AND cotizacion_id_remitente = '$email'";
    $query2_2 = "SELECT COUNT(*) AS total_count
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_2_month' AND cotizacion_id_remitente = '$email'";
    $query1_2 = "SELECT COUNT(*) AS total_count
    FROM wp_cotizacion
    WHERE cotizacion_status = '3' AND cotizacion_create_at >= '$before_1_month' AND cotizacion_id_remitente = '$email'";

    $result_6_2 = $conexion->query($query6_2)->fetch_array()[0];
    $result_5_2 = $conexion->query($query5_2)->fetch_array()[0];
    $result_4_2 = $conexion->query($query4_2)->fetch_array()[0];
    $result_3_2 = $conexion->query($query3_2)->fetch_array()[0];
    $result_2_2 = $conexion->query($query2_2)->fetch_array()[0];
    $result_1_2 = $conexion->query($query1_2)->fetch_array()[0];

    $response['graph_2'] = [
        $result_6_2 - $result_5_2,
        $result_5_2 - $result_4_2,
        $result_4_2 - $result_3_2,
        $result_3_2 - $result_2_2,
        $result_2_2 - $result_1_2,
        $result_1_2
    ];

    // GRAFICO 3 
    $query_sold_6 = "SELECT cotizacion_detalle_name, COUNT(*) AS total_sold
    FROM wp_cotizacion_detalle
    INNER JOIN wp_cotizacion ON wp_cotizacion_detalle.cotizacion_detalle_id = wp_cotizacion.cotizacion_id
    WHERE wp_cotizacion.cotizacion_status = '3' AND wp_cotizacion.cotizacion_create_at >= '$before_6_month' AND wp_cotizacion.cotizacion_id_remitente = '$email'
    GROUP BY cotizacion_detalle_name";

    $result_sold_6 = $conexion->query($query_sold_6);

    $data_sold_6_names = array();
    $data_sold_6_quantity = array();

    while ($row = $result_sold_6->fetch_assoc()) {
        array_push($data_sold_6_names, $row['cotizacion_detalle_name']);
        array_push($data_sold_6_quantity, $row['total_sold']);
    }

    $response['graph_3_names'] = $data_sold_6_names;
    $response['graph_3_quan'] = $data_sold_6_quantity;

    $response['will_restart'] = days_until_monthend();

    header('Content-Type: application/json');

    echo json_encode($response);
?>