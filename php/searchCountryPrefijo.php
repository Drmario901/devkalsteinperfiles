<?php
    require __DIR__ . '/conexion.php';

    $country = $_POST['country'];

    $consulta = "SELECT * FROM wp_paises_prefijos WHERE codigo_iso = '$country'";
    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $prefijo = $row['prefijo_internacional'];

    $datos = array(
        'prefijo' => $prefijo
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();