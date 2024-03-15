<?php
    

    require  __DIR__ . '../../db/conexion.php';

    $consulta = "SELECT * FROM wp_report WHERE";
    $resultado = $conexion->query($consulta);
    $quotes = array();

    if ($resultado->num_rows > 0){
        while ($value = $resultado->fetch_assoc()){
            $date = $value['R_fecha'];
            $date = new DateTime($date);
            $m = date_format($date, 'm');
            $array = array(
                'id_quote' => $value['R_id'],
                'date' => $m
            );

            array_push($quotes, $array);
        }
    }

    echo json_encode($quotes, JSON_FORCE_OBJECT);
    $conexion->close();