<?php
//DEPURADOR DE ERRORES//
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
//////////////////////////
session_start();
require_once __DIR__ . '/../db/conexion.php';

$email = $_POST['consulta'];
$userTag = $_POST['consulta1'];
$password = $_POST['consulta2'];
$telefono = $_POST['consulta3'];

$email = $conexion->real_escape_string($email);
$userTag = $conexion->real_escape_string($userTag);

$passwordEncrypted = md5($password);
$_SESSION["emailAccount"] = $email;

$result = $conexion->query("SELECT * FROM wp_account WHERE account_correo = '$email'");
if ($result !== FALSE) {
    $emailExists = $result->num_rows > 0;

    if (!$emailExists) {
        $register = "INSERT INTO wp_account (account_aid, account_rol_aid, account_correo, account_contraseña, account_status, account_created_at, user_tag, account_telefono)
        VALUES (NULL,  0,'$email', '$passwordEncrypted', 'pending', CURRENT_TIMESTAMP, '$userTag', $telefono);";

        if ($conexion->query($register) === TRUE) {
            $registro = "correcto";
            $_SESSION["emailAccount"] = $email;
        } else {
            $registro = "incorrecto";
            echo "Error in INSERT query: " . $conexion->error;
        }
    } else {
        $registro = "correcto";
    }
} else {
    echo "Error in SELECT query: " . $conexion->error;
    exit;
}

$numRandom = mt_rand(000000, 999999);
$_SESSION["codeVerification"] = $numRandom;
$_SESSION["emailAccount"] = $email;
$_SESSION["codeTimeOut"] = time();
$_SESSION["telefono"] = $telefono;

$datos = array(
    'registro' => $registro
);

echo json_encode($datos, JSON_FORCE_OBJECT);
?>