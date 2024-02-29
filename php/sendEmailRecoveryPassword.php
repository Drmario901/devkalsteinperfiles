<?php    
    session_start();

    $email = $_POST['consulta'];

    $_SESSION['emailPasswordChangeRequest'] =  $email;
    $_SESSION["linkTimeOut"] = time();

    $encryptEmail = md5($email);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require __DIR__.'/PHPMailer/src/Exception.php';
    require __DIR__.'/PHPMailer/src/PHPMailer.php';
    require __DIR__.'/PHPMailer/src/SMTP.php';
    
    $status = '';

    $mail = new PHPMailer(true);
    try {
        $mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
        $mail->isSMTP();
        $mail->Host = 'dev.kalstein.plus/plataforma';  // Host de conexión SMTP
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply2@dev.kalstein.plus/plataforma';                 // Usuario SMTP
        $mail->Password = 'XsI2C;6d{++-';                           // Password SMTP
        $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
        $mail->Port = 587;                                    // Puerto SMTP
    
        #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
        #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
        #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
     
        $mail->setFrom('no-reply2@dev.kalstein.plus/plataforma');		// Mail del remitente
        $mail->addAddress($email);     // Mail del destinatario

        $position = strpos($email, '@');
        $nameEmail = substr($email, 0, $position);
     
        $mail->isHTML(true);
        $mail->Subject = 'Solicitud de cambio de contraseña';  // Asunto del mensaje
        $mail->Body    = '
            <div style="width: 100%; background-color: #fff;">
                <div style="width: 50%; margin-left: 25%;">
                    <div style="width: 100%; color: #000;">
                        <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px;  margin-left: 25%; background-color: #fff; margin-top: 4rem; margin-bottom: 2rem;">
                        <h1 style="text-align: center; color: #000;">Hola, '.$nameEmail.'</h1>
                        <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Para continuar con el proceso de restablecimiento de su contraseña debe hacer clic en el siguiente enlace. Si no ha realizado esta solicitud, puede omitir este mensaje.</p>
                        <p style="text-align: center; color: #000; font-size: 1.2em; font-weight: bold;">Enlace de restablecimiento de contraseña</p>
                        <p style="text-align: center; color: #000; font-weight: bold; font-size: 2.5em;">https://dev.kalstein.plus/plataforma/reestablecer-contrasena?email='.$encryptEmail.'</p>
                        <p style="text-align: center; color: #000; ">(Este enlace es válido durante 10 minutos)</p>
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
        $status = 'correcto';
    } catch (Exception $e) {
        $status = 'incorrecto';
    }

    $datos = array(
        'status' => $status
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);