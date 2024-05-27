<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
// session_start();

// if (isset($_SESSION["emailAccount"])) {
//   $email = $_SESSION["emailAccount"];
// }

$getEmail = $_GET['email'];

$email = $getEmail;


echo 'aaaa', $email;


$sql = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$result = $conexion->query($sql);
$row = $result->fetch_assoc();
$id = $row['account_aid'];



$sqlSubscripcion = "SELECT * FROM wp_subscripcion WHERE user_id = '$id'";

$result2 = $conexion->query($sqlSubscripcion);
$row = $result2->fetch_assoc();

var_dump('aqui van', $row);
