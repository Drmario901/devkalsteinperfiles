<?php
    require __DIR__ . '/conexion.php';

    $email = $_POST['consulta'];
    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
	$resultConsulta = $conexion->query($consulta);
	$count = mysqli_num_rows($resultConsulta);

    if ($count > 0){
        $status = 'no disponible';
    }else{
        $status = 'disponible';
    }

    $datos = array(
        'status' => $status
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();