<?php
session_start();
if (isset($_POST['idCotizacion'])) {
    $idCotizacion = $_POST['idCotizacion'];
}
if (isset($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../PHPMailer/src/Exception.php';
require __DIR__ . '/../PHPMailer/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer/src/SMTP.php';
require __DIR__.'/../conexion.php';

function enviarCorreo($destinatarioEmail, $email, $idCotizacion)
{
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 2;
        $mail->isSMTP();
        $mail->Host = 'dev.kalstein.plus/plataforma';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@dev.kalstein.plus/plataforma';
        $mail->Password = 'XsI2C;6d{++-';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('no-reply@dev.kalstein.plus/plataforma');
        $mail->addAddress($destinatarioEmail);

        $mail->isHTML(true);
        $mail->Subject = 'New Quotation Submission';
        $mail->Body = '
            <div style="width: 100%; background-color: #fff;">
                <div style="width: 50%; margin-left: 25%;">
                    <div style="width: 100%; color: #000;">
                        <h1 style="text-align: center; color: #000;">New Quotation Submission</h1>
                        <p style="text-align: left; color: #000;">Email: ' . $email . '</p>
                        <p style="text-align: left; color: #000;">Please check Moderator Dashboard to see this quote.</p>
                        <p style="text-align: left; color: #000;">Quotation ID:</p>
                        <p style="text-align: left; color: #000;">' . $idCotizacion . '</p>             
                        <hr>
                        <p style="text-align: justify; color: #000;">Kalstein + will never email or request that you disclose or verify your password, credit card or bank account number.</p>
                        <p style="color: #000;">2023 © All rights reserved</p>
                    </div>
                </div>
            </div>
        ';
        $mail->CharSet = 'UTF-8';

        $mail->send();
        echo 'Correo enviado a: ' . $destinatarioEmail;

    } catch (Exception $e) {
        echo 'No se pudo enviar el mensaje. Error: ' . $mail->ErrorInfo;
    }
}

$query = "SELECT account_email FROM wp_private_account";
$resultado = $conexion->query($query);

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $destinatarioEmail = $row["account_email"];
        enviarCorreo($destinatarioEmail, $email, $idCotizacion);
    }
} else {
    echo "No moderators in DB.";
}

$conexion->close();
?>

