<?php
    require_once '../../db/conexion.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['remitente_id'])) {
        $senderId = $_POST['remitente_id'];
        $destinatarioId = $_POST['destinatario_id'];
        $subject = $_POST['asunto'];
        $content = $_POST['contenido'];

        $userTagToValidate = $destinatarioId; 
        $checkUserQuery = "SELECT account_correo FROM wp_account WHERE user_tag = '$userTagToValidate'";
        
        $userResult = $conexion->query($checkUserQuery);
        
        if ($userResult && $userResult->num_rows > 0) {
            $userRow = $userResult->fetch_assoc();
            $destinatarioCorreo = $userRow['account_correo'];

            $query = "INSERT INTO wp_mensajes (id, remitente_id, destinatario_id, asunto, contenido) 
                    VALUES (NULL, '$senderId', '$destinatarioId', '$subject', '$content')";

            $resultado = $conexion->query($query);
            echo json_encode($resultado, JSON_FORCE_OBJECT);

            try {
                require __DIR__.'/../PHPMailer/src/Exception.php';
                require __DIR__.'/../PHPMailer/src/PHPMailer.php';
                require __DIR__.'/../PHPMailer/src/SMTP.php';
                
                $mail = new PHPMailer(true);
                
                //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
                $mail->isSMTP();
                $mail->Host = 'mail.kalstein.us';  // Host de conexión SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'no-reply@kalstein.us';                 // Usuario SMTP
                $mail->Password = '-GAo^)d)F}j8';                           // Password SMTP
                $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
                $mail->Port = 587;                                    // Puerto SMTP
                
                $mail->setFrom('no-reply@kalstein.us');    // Mail del remitente
                $mail->addAddress($destinatarioCorreo);     // Mail del destinatario
                
                $position = strpos($destinatarioId, '@');
                $nameEmail = substr($destinatarioId, 0, $position);
                
                $mail->isHTML(true);
                $mail->Subject = "[Kalstein] $senderId | $subject";  // Asunto del mensaje
                $mail->Body    = '
                    <div style="width: 100%; border-radius: 12px; margin-bottom: 15px;">
                        <div style="width: 90%; margin-left: 5%;">
                            <div style="width: 100%; color: #000;">
                                <img src="https://kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px; margin-top: 4rem; margin-bottom: 2rem;">
                                <h3 style="text-align: center; color: #000;">'.$senderId.' says:</h3>
                                <p style="color: #000;">'.$content.'</p>
                                <hr>
                                <p style="color: #000;">2023 © All rights reserved</p>
                            </div>
                        </div>
                    </div>
                ';    // Contenido del mensaje (acepta HTML)
                $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
                // Activo condificacción utf-8
                $mail->CharSet = 'UTF-8';
                
                $mail->send();
            }
            catch (Exception $e) {
                echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
            }
        } else {
            echo "El usuario no existe.";
        }
    }
?>
