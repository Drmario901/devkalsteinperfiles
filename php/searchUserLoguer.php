<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once '/conexion.php';

    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $resultConsulta = $conexion->query($consulta);
	$row = mysqli_fetch_array($resultConsulta);
    $idAcc = $row[1];
    $name = $row[3];
    $lastname = $row[4];

    $consulta2 = "SELECT * FROM wp_company WHERE company_account_correo = '$email'";
    $resultado = $conexion->query($consulta2);
    $row2 = mysqli_fetch_array($resultado);
    $count = mysqli_num_rows($resultado);

    if ($count > 0){
        $nameCompany = $row2[3];
    }else{
        $nameCompany = '';
    }

    $consulta3 = "SELECT * FROM wp_config_quote WHERE id_account = '$email'";
    $resultado2 = $conexion->query($consulta3);
    $row3 = mysqli_fetch_array($resultado2);
    $count2 = mysqli_num_rows($resultado2);

    if ($count2 > 0){
        $warehouse = $row3[2];
        $currency = $row3[3];
        $paymentM = $row3[4];
        $shippingM = $row3[5];
        $destination = $row3[6];
        $zipcode = $row3[7];
    }else{
        $warehouse = 0;
        $currency = 0;
        $paymentM = 0;
        $shippingM = 0;
        $destination = 0;
        $zipcode = '';
    }


    $datos = array(
        'emailAcc' => $email,
        'name' => $name,
        'lastname' => $lastname,
        'nameCompany' => $nameCompany,
        'warehouse' => $warehouse,
        'currency' => $currency,
        'paymentM' => $paymentM,
        'shippingM' => $shippingM,
        'destination' => $destination,
        'zipcode' => $zipcode
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();