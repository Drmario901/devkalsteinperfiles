<?php
    session_start();
    date_default_timezone_set('UTC');

    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount']; 
        $emailEncrypt = md5($email);
    }

    require_once '../db/conexion.php';

    $userEncryt = $_POST['userEncryt'];
    $address = $_POST['address'];
    $subject = $_POST['subject'];
    $zipcode = $_POST['zipcode'];
    $infoadd = $_POST['infoadd'];

    if ($userEncryt != $emailEncrypt){
        $emailStatus = 'noavaliable';
    }else{
        $emailStatus = 'avaliable';
        $insert = "INSERT INTO wp_consult_shipping_cost(shipping_cost_aid, shipping_cost_user, shipping_cost_subject, shipping_cost_address, shipping_cost_zipcode, shipping_cost_infoadd, shipping_cost_status, shipping_cost_date) VALUES ('', '$email', '$subject', '$address', '$zipcode', '$infoadd', 'Pending', CURRENT_TIMESTAMP)";
        if ($conexion->query($insert) === TRUE){
            $register = 'correcto';
        }else{
            $register = 'incorrecto';
        }
    }

    $datos = array(
        'emailStatus' => $emailStatus,
        'register' => $register,
        'emailEncrypt' => $emailEncrypt
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);