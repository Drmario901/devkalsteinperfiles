<?php

session_start();

$acc_id = $_SESSION['emailAccount'];


require __DIR__ . '/../conexion.php';



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

    $query6 = "SELECT SUM(wp_reportes.R_ID)
    FROM wp_reportes
    WHERE R_usuario_agente='$acc_id' and R_fecha >= '$before_6_month'";
    $query5 = "SELECT SUM(wp_reportes.R_ID)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_5_month'";
    $query4 = "SELECT SUM(wp_reportes.R_ID)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_4_month'";
    $query3 = "SELECT SUM(wp_reportes.R_ID)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_3_month'";
    $query2 = "SELECT SUM(wp_reportes.R_ID)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_2_month'";
    $query1 = "SELECT SUM(wp_reportes.R_ID)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_1_month'";

    $resutl_6 = $conexion->query($query6)->fetch_array()[0];
    $resutl_5 = $conexion->query($query5)->fetch_array()[0];
    $resutl_4 = $conexion->query($query4)->fetch_array()[0];
    $resutl_3 = $conexion->query($query3)->fetch_array()[0];
    $resutl_2 = $conexion->query($query2)->fetch_array()[0];
    $resutl_1 = $conexion->query($query1)->fetch_array()[0];

    $response['graph_1'] = [
        $resutl_6 - $resutl_5,
        $resutl_5 - $resutl_4,
        $resutl_4 - $resutl_3,
        $resutl_3 - $resutl_2,
        $resutl_2 - $resutl_1,
        $resutl_1
    ];

    // GRAFICO 2 (Cantidad de ordenes a clientes en 6 meses)

    $current = date('Y-m-d h:i:s');

    $query6 = "SELECT COUNT(*)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_6_month'";
    $query5 = "SELECT COUNT(*)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_5_month'";
    $query4 = "SELECT COUNT(*)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_4_month'";
    $query3 = "SELECT COUNT(*)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_3_month'";
    $query2 = "SELECT COUNT(*)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_2_month'";
    $query1 = "SELECT COUNT(*)
    FROM wp_reportes
    WHERE  R_usuario_agente='$acc_id' and R_fecha >= '$before_1_month'";

    // IMPORTANTE AÑADIR UNA COLUMNA QUE REEMPLACE CREATE AT POR SOLD AT

    $resutl_6 = $conexion->query($query6)->fetch_array()[0];
    $resutl_5 = $conexion->query($query5)->fetch_array()[0];
    $resutl_4 = $conexion->query($query4)->fetch_array()[0];
    $resutl_3 = $conexion->query($query3)->fetch_array()[0];
    $resutl_2 = $conexion->query($query2)->fetch_array()[0];
    $resutl_1 = $conexion->query($query1)->fetch_array()[0];

    $response['graph_2'] = [
        $resutl_6 - $resutl_5,
        $resutl_5 - $resutl_4,
        $resutl_4 - $resutl_3,
        $resutl_3 - $resutl_2,
        $resutl_2 - $resutl_1,
        $resutl_1
    ];

    $response['will_restart'] = days_until_monthend();

    echo json_encode($response);
?>
