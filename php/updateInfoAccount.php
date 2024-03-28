<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }
    require_once __DIR__ . '/../db/conexion.php';

    $imageProfile = $_FILES['imageProfile']['name'];
    if (is_null($imageProfile)){
        $queryAcc = "SELECT * FROM wp_account WHERE account_correo = '$email'";
        $result= $conexion->query($queryAcc);
        $row = mysqli_fetch_array($result);
        $newName = $row['account_url_image_perfil'];
    }else{
        $extension = pathinfo($imageProfile, PATHINFO_EXTENSION);
        $newName = uniqid().".".$extension;
    }
    $path = __DIR__ . '/../src/images/upload/';
    $uploadFile = $path . basename($newName);
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $countryAcc = $_POST['countryAcc'];
    $locationAcc = $_POST['locationAcc'];
    $addressAcc = $_POST['addressAcc'];
    $zipcodeAcc = $_POST['zipcodeAcc'];
    $phoneAcc = $_POST['phoneAcc'];
    $birthdayAcc = $_POST['birthdayAcc'];
    $nameCompany = $_POST['nameCompany'];
    $roleCompany = $_POST['roleCompany'];
    $addressCompany = $_POST['addressCompany'];
    $stateCompany = $_POST['stateCompany'];
    $countryCompany = $_POST['countryCompany'];
    $phoneCompany = $_POST['phoneCompany'];
    $zipcodeCompany = $_POST['zipcodeCompany'];
    $websiteCompany = $_POST['websiteCompany'];

    move_uploaded_file($_FILES['imageProfile']['tmp_name'], $uploadFile);
    $query = "UPDATE wp_account SET account_nombre = '$name', account_apellido = '$lastname', account_direccion = '$addressAcc', account_ciudad = '$locationAcc', account_pais = '$countryAcc', account_zipcode = '$zipcodeAcc', account_telefono = '$phoneAcc', account_birthday = '$birthdayAcc' ,account_url_image_perfil = '$newName' WHERE account_correo = '$email'";
    if ($conexion->query($query) === TRUE){
        $queryCompany = "SELECT * FROM wp_company WHERE company_account_correo = '$email'";
        $rsQuery = $conexion->query($queryCompany);
        $count = mysqli_num_rows($rsQuery);
        $registerUpdate = "INSERT INTO wp_register_updates(aid_updates, account_id, updates_date, update_description) VALUES ('', '$email', CURRENT_TIMESTAMP, 'Account data has been updated')";
        $conexion->query($registerUpdate);

        if ($count > 0){
            $update = "UPDATE wp_company SET company_nombre = '$nameCompany', company_direccion = '$addressCompany', company_ciudad = '$stateCompany', company_pais = '$countryCompany', company_telefono = '$phoneCompany', company_zipcode = '$zipcodeCompany', company_website = '$websiteCompany', company_role = '$roleCompany' WHERE company_account_correo = '$email'";
            if ($conexion->query($update) === TRUE){
                $update = 'correcto';
            }else{
                $update = 'incorrecto';
            }
        }else{
            $register = "INSERT INTO wp_company(company_aid, company_account_correo, company_role, company_nombre, company_direccion, company_ciudad, company_pais, company_telefono, company_zipcode, company_website) VALUES ('', '$email', '$roleCompany', '$nameCompany', '$addressCompany', '$stateCompany', '$stateCountry', '$phoneCompany', '$zipcodeCompany', '$websiteCompany')";
            if ($conexion->query($register) === TRUE){
                $update = 'correcto';
            }else{
                $update = 'incorrecto';
            }
        }
    }else{
        $update = 'incorrecto';
    }

    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();