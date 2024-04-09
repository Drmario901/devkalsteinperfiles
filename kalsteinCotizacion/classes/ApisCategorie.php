<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE"); 

    require __DIR__ . '/conexion.php';

    $sql = "SELECT * FROM wp_categories";
    $rs = $conexion->query($sql);
    $data = [];
    while ($value = $rs->fetch_assoc()){
        array_push($data, $value);
    }

    header('Content-Type: application/json');
    echo json_encode($data);
?>