<?php 

session_start();

if(isset($_SESSION["emailAccount"])){
    $email = $_SESSION["emailAccount"];   
}
require '../db/conexion.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__.'/PHPMailer/src/Exception.php';
require __DIR__.'/PHPMailer/src/PHPMailer.php';
require __DIR__.'/PHPMailer/src/SMTP.php';

function generarSerial($conexion) {
    $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $longitud = 8;

    do {
        $serial = '';
        for ($i = 0; $i < $longitud; $i++) {
            $serial .= $caracteres[rand(0, strlen($caracteres) - 1)];
        }

        // Verificar si el código generado existe en la tabla
        $sql = "SELECT dc_serial FROM wp_discount_codes WHERE dc_serial = '$serial'";
        $result = $conexion->query($sql);

        // Si no hay coincidencias, salir del bucle
        if ($result->num_rows == 0) {
            break;
        }
        // Si existe, genera un nuevo código y vuelve a verificar
    } while (true);

    return $serial;
}

$nuevoSerial = generarSerial($conexion);

// Verificar si el código generado y el email no existen en la tabla
$sql = "SELECT * FROM wp_discount_codes WHERE dc_mail = '$email'";
$result = $conexion->query($sql);

if ($result->num_rows == 0) {
    // Si no existen, insertar el nuevo serial y el email en la tabla
    $sqlInsert = "INSERT INTO wp_discount_codes (dc_id, dc_serial, dc_mail, dc_use) VALUES (NULL, '$nuevoSerial', '$email', 0)";
    if ($conexion->query($sqlInsert) === TRUE) {
        /* echo "Codigo de descuento creado satisfactoriamente"; */

        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
            $mail->isSMTP();
            $mail->Host = 'mail.kalstein.net';  // Host de conexión SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@kalstein.net';                 // Usuario SMTP
            $mail->Password = 'Kalstein1234';                           // Password SMTP
            $mail->SMTPSecure = 'ssl';                            // Activar seguridad TLS
            $mail->Port = 465;                               // Puerto SMTP
        
            #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
            #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
            #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
        
            $mail->setFrom('no-reply2@kalstein.net');		// Mail del remitente
            $mail->addAddress($email);     // Mail del destinatario

            $position = strpos($email, '@');
            $nameEmail = substr($email, 0, $position);
            
            $mail->isHTML(true);
            $mail->Subject = 'Kalstein - Descuento';  // Asunto del mensaje
            $mail->Body    = '
                <div style="width: 100%; background-color: #fff;">
                    <div style="width: 50%; margin-left: 25%;">
                        <div style="width: 100%; color: #000;">
                            <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px;  margin-left: 25%; background-color: #fff; margin-top: 4rem; margin-bottom: 2rem;">
                            <h1 style="text-align: center; color: #000;">Hola, '.$nameEmail.'</h1>
                            <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Felicitaciones, se registró exitosamente, aquí tiene un código de promoción para que obtenga un descuento en su próxima compra.</p>
                            <p style="text-align: center; color: #000; font-size: 1.2em; font-weight: bold;">Código promocional:</p>
                            <p style="text-align: center; color: #000; font-weight: bold; font-size: 2.5em;">'.$nuevoSerial.'</p>
                            <p style="text-align: center; color: #000; ">¡Disfruta un 4% de tu próxima compra!</p>
                            <hr>
                            <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kalstein + nunca le enviará un correo electrónico ni le pedirá que revele o verifique su contraseña, tarjeta de crédito o número de cuenta bancaria.</p>
                            <p style="color: #000;">2023 © Todos los derechos reservados</p>
                        </div>
                    </div>
                </div>
            ';    // Contenido del mensaje (acepta HTML)
            $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
            // Activo condificacción utf-8
            $mail->CharSet = 'UTF-8';
            
            $mail->send();

        } catch (Exception $e) {

        }

    } else {
        echo "Error: " . $sqlInsert . "<br>" . $conexion->error;
    }
} else {
    echo "el correo ya fue registrado.";
}

?>