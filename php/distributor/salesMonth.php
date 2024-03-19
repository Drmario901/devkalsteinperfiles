<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once __DIR__ . '/../../db/conexion.php';

    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
    $resultado = $conexion->query($consulta);
    $quotes = array();

    if ($resultado->num_rows > 0){
        while ($value = $resultado->fetch_assoc()){
            $date = $value['cotizacion_create_at'];
            $date = new DateTime($date);
            $m = date_format($date, 'm');
            $array = array(
                'id_quote' => $value['cotizacion_id'],
                'date' => $m
            );

            array_push($quotes, $array);
        }
    }

    echo json_encode($quotes, JSON_FORCE_OBJECT);
    $conexion->close();
?>