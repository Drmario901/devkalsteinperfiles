<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require __DIR__ . '../../db/conexion.php';

    $nameB = $_POST['nameB'];
    $countryB = $_POST['countryB'];
    $stateB = $_POST['stateB'];
    $addressB = $_POST['addressB'];
    $zipcodeB = $_POST['zipcodeB'];
    $phoneB = $_POST['phoneB'];
    $websiteB = $_POST['websiteB'];
    $nameUser = $_POST['nameUser'];
    $lastnameUser = $_POST['lastnameUser'];
    $countryUser = $_POST['countryUser'];
    $stateUser = $_POST['stateUser'];
    $addressUser = $_POST['addressUser'];
    $zipcodeUser = $_POST['zipcodeUser'];
    $phoneUser = $_POST['phoneUser'];
    $jobRole = $_POST['jobRole'];

    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $resultConsulta = $conexion->query($consulta);
	$row = mysqli_fetch_array($resultConsulta);
    $idAcc = $row[0];

    if ($jobRole == 0){
        $update = "UPDATE wp_account SET account_nombre = '$nameUser', account_apellido = '$lastnameUser', account_rol_aid = '1', account_direccion = '$countryUser', account_pais = '$stateUser', account_ciudad = '$addressUser', account_zipcode = '$zipcodeUser', account_telefono = '$phoneUser' WHERE account_correo = '$email'";
        if ($conexion->query($update) === TRUE){
            $update = "correcto";
        }else{
            $update = "incorrecto";
        }
    }else{
        $update = "UPDATE wp_account SET account_nombre = '$nameUser', account_apellido = '$lastnameUser', account_rol_aid = '1', account_direccion = '$countryUser', account_pais = '$stateUser', account_ciudad = '$addressUser', account_zipcode = '$zipcodeUser', account_telefono = '$phoneUser' WHERE account_correo = '$email'";
        if ($conexion->query($update) === TRUE){
            $register = "INSERT INTO wp_company(company_aid, company_account_correo, company_role, company_nombre, company_direccion, company_pais, company_ciudad, company_telefono, company_zipcode, company_website) VALUES ('', '$email', '$jobRole', '$nameB', '$addressB', '$stateB', '$addressB', '$phoneB', '$zipcodeB', '$websiteB')";
            if ($conexion->query($register) === TRUE){
                $update = "correcto";
            }else{
                $update = "incorrecto";
            }
        }else{
            $update = "incorrecto";
        }
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();