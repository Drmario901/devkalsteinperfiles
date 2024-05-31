<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../conexion.php';

header('Content-Type: application/json'); // Asegúrate de que la respuesta sea JSON

$response = array("status" => "incorrecto");

/* use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception; */

try {
  $artId = $_POST['artId'];
  $msg = $_POST['msg'];
  $strike = $_POST['strike'];

  $query = "SELECT * FROM wp_art_blog INNER JOIN wp_account ON wp_art_blog.art_id_user = wp_account.account_aid WHERE art_id = '$artId'";
  $result = $conexion->query($query);

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $artTitle = $row['art_title'];
    $accountEmail = $row['account_correo'];
    $nombre = $row['account_nombre'];
    $apellido = $row['account_apellido'];
    $nombreCompleto = $nombre . " " . $apellido;
    $artTitle = $row['art_title'];
  } else {
    throw new Exception("No se encontró el artículo con ID: $artId");
  }

  //update status to 3
  $query = "UPDATE wp_art_blog SET id_status = 3 WHERE art_id = '$artId'";
  $result = $conexion->query($query);

  if (!$result) {
    throw new Exception("Error al actualizar el estado del artículo.");
  }

  require __DIR__ . '/../../PHPMailer/src/Exception.php';
  require __DIR__ . '/../../PHPMailer/src/PHPMailer.php';
  require __DIR__ . '/../../PHPMailer/src/SMTP.php';

  $mail = new PHPMailer(true);

  $mail->isSMTP();
  $mail->Host = 'dev.kalstein.plus';
  $mail->SMTPAuth = true;
  $mail->Username = 'no-reply@dev.kalstein.plus';
  $mail->Password = 'XsI2C;6d{++-';
  $mail->SMTPSecure = 'tls';
  $mail->Port = 587;

  $mail->setFrom('no-reply@dev.kalstein.plus', 'Kalstein Plataforma');
  $mail->addAddress($accountEmail);

  $mail->Subject = 'Notificación de denegación de blog';
  $mail->Body = '
        <div style="width: 100%; background-color: #fff;">
            <div style="width: 50%; margin-left: 25%;">
                <div style="width: 100%; color: #000;">
                    <img src="https://kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px; margin-left: 25%; background-color: #fff; margin-top: 4rem; margin-bottom: 2rem;">
                    <h1 style="text-align: center; color: #000;">Hi, ' . $nombreCompleto . '</h1>
                    <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parece que nuestro equipo de moderadores encontró irregularidades con tu blog registrado.</p>
                    <hr>
                    <p style="text-align: justify; color: #000;">El error encontrado fue el siguiente:</p>
                    <p style="text-align: justify; color: #000;">' . $msg . '</p>
                    <hr>
                    <p style="text-align: justify; color: #000;">Para cualquier duda relacionada con este error, por favor contacta con nuestro equipo de moderadores.</p>
                    <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kalstein France nunca enviará un correo electrónico o solicitará que revele o verifique su contraseña, tarjeta de crédito o número de cuenta bancaria.</p>
                    <p style="color: #000;">2023 © Todos los derechos reservados</p>
                </div>
            </div>
        </div>
    ';
  $mail->AltBody = 'Este es el contenido del mensaje en texto plano';
  $mail->CharSet = 'UTF-8';

  $mail->send();
  $response["status"] = "correcto";
} catch (Exception $e) {
  error_log($e->getMessage()); // Log the error message for debugging
  $response["message"] = $e->getMessage();
}

echo json_encode($response);
?>