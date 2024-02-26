<?php    
    session_start();
    if(isset($_SESSION["codeVerification"])){
        $code = $_SESSION["codeVerification"];
    }
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__.'/../PHPMailer/src/Exception.php';
    require __DIR__.'/../PHPMailer/src/PHPMailer.php';
    require __DIR__.'/../PHPMailer/src/SMTP.php';
     
    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
        $mail->isSMTP();
        $mail->Host = 'mail.kalstein.co.ve';  // Host de conexión SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@kalstein.co.ve';                 // Usuario SMTP
        $mail->Password = 'M86gJ#z86?i[';                           // Password SMTP
        $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
        $mail->Port = 587;                                    // Puerto SMTP
    
        #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
        #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
        #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
     
        $mail->setFrom('no-reply@kalstein.co.ve');		// Mail del remitente
        $mail->addAddress($email);     // Mail del destinatario

        $position = strpos($email, '@');
        $nameEmail = substr($email, 0, $position);
     
        $mail->isHTML(true);
        $mail->Subject = 'Verificación de correo electrónico';  // Asunto del mensaje
        $mail->Body    = '
            <div style="width: 100%; background-color: #fff;">
                <div style="width: 50%; margin-left: 25%;">
                    <div style="width: 100%; color: #000;">
                        <img src="https://kalstein.co.ve/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px;  margin-left: 25%; background-color: #fff; margin-top: 4rem; margin-bottom: 2rem;">
                        <h1 style="text-align: center; color: #000;">Hola, '.$nameEmail.'</h1>
                        <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Gracias por iniciar el proceso de creación de la nueva cuenta de Kalstein France. Queremos asegurarnos de que es realmente usted. Ingrese el siguiente código de verificación cuando se lo solicite. Si no desea crear una cuenta, puede omitir este mensaje.</p>
                        <p style="text-align: center; color: #000; font-size: 1.2em; font-weight: bold;">Código de verificación</p>
                        <p style="text-align: center; color: #000; font-weight: bold; font-size: 2.5em;">'.$code.'</p>
                        <p style="text-align: center; color: #000; ">(Este código es válido durante 10 minutos)</p>
                        <hr>
                        <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kalstein France nunca enviará un correo electrónico o solicitará que revele o verifique su contraseña, tarjeta de crédito o número de cuenta bancaria.</p>
                        <p style="color: #000;">2023 © Todos los derechos reservados</p>
                    </div>
                </div>
            </div>
        ';    // Contenido del mensaje (acepta HTML)
        $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
        // Activo condificacción utf-8
        $mail->CharSet = 'UTF-8';
     
        $mail->send();
        echo 'El mensaje ha sido enviado';
    } catch (Exception $e) {
        echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
    }