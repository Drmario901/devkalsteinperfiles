<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require __DIR__ . '/conexion.php';

    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
    $resultConsulta = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultConsulta);
    $idAcc = $row[1];
    $name = $row[3];
    $lastname = $row[4];
    $rolAccount = $row[5];
    $addressAcc = $row[6];
    $locationAcc = $row[7];
    $countryAcc = $row[8];
    $zipcodeAcc = $row[9];
    $phoneAcc = $row[10];
    $imgPerfil = $row[12];
    $birthdayAcc = $row[13];
    $idDocument = $row[14];
    $imgDocument = $row[15];
    if ($birthdayAcc == '0000-00-00'){
        $newBirthdayAcc = '0000-00-00';
    }else{
        $newBirthdayAcc = date('Y-m-d', strtotime($birthdayAcc));
    }    

    $queryCompany = "SELECT * FROM wp_company WHERE company_account_correo = '$email'";
    $rsQuery = $conexion->query($queryCompany);
    $row2 = mysqli_fetch_array($rsQuery);
    $roleCompany = $row2[2];
    $nameCompany = $row2[3];
    $addressCompany = $row2[4];
    $stateCompany = $row2[5];
    $countryCompany = $row2[6];
    $phoneCompany = $row2[7];
    $zipcodeCompany = $row2[8];
    $websiteCompany = $row2[9];
    $rifCompany = $row2[10];
    $imgRifCompany = $row2[11];

    $datos = array(
        'name' => $name,
        'lastname' => $lastname,
        'addressAcc' => $addressAcc,
        'locationAcc' => $locationAcc,
        'countryAcc' => $countryAcc,
        'zipcodeAcc' => $zipcodeAcc,
        'phoneAcc' => $phoneAcc,
        'imgPerfil' => $imgPerfil,
        'newBirthdayAcc' => $newBirthdayAcc,
        'idDocument' => $idDocument,
        'imgDocument' => $imgDocument,
        'roleCompany' => $roleCompany,
        'nameCompany' => $nameCompany,
        'addressCompany' => $addressCompany,
        'stateCompany' => $stateCompany,
        'countryCompany' => $countryCompany,
        'phoneCompany' => $phoneCompany,
        'zipcodeCompany' => $zipcodeCompany,
        'websiteCompany' => $websiteCompany,
        'rifCompany' => $rifCompany,
        'imgRifCompany' => $imgRifCompany
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();