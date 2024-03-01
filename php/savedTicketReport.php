<?php
    session_start();
    date_default_timezone_set('UTC');

    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount'];
    }

    require __DIR__ .'/conexion.php';

    $idServices = $_POST['idServices'];
    $emailAgent = $_POST['emailAgent'];
    $model = $_POST['model'];
    $description = $_POST['description'];
    $level = $_POST['level'];
    $fecha_hora_actual = date('Y-m-d H:i:s');

    $sql = "SELECT * FROM wp_servicios WHERE SE_id = '$idServices'";
    $sql2 = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $sql3 = "SELECT * FROM wp_account WHERE account_correo = '$emailAgent'";

    $resultado = $conexion->query($sql);
    $resultado2 = $conexion->query($sql2);
    $resultado3 = $conexion->query($sql3);

    $row = mysqli_fetch_array($resultado);
    $row2 = mysqli_fetch_array($resultado2);
    $row3 = mysqli_fetch_array($resultado3);

    $nameClient = $row2['account_nombre'];
    $categorie = $row['SE_category'];
    $state = 'Pendiente';
    $nameAgent = $row3['account_nombre'];


    $insert = "INSERT INTO wp_reportes(R_id, R_id_servicio, R_nombre, R_usuario, R_category, R_product, R_Description, R_Nivel, R_estado, R_agente_soporte, R_usuario_agente, R_fecha) VALUES ('', '$idServices', '$nameClient', '$email', '$categorie', '$model', '$description', '$level', '$state', '$nameAgent', '$emailAgent', '$fecha_hora_actual')";

    if ($conexion->query($insert) === TRUE){
        $update = 'correcto';
    }else{
        $update = 'incorrecto';
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);

