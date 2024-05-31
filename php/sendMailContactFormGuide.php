<?php
    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    function sendEmail(){
        require_once __DIR__ . '/../db/conexion.php';

        $emailKalstein = 'marketing2.kalstein@gmail.com';
        $datos = $_POST['datos'];
    
        $id_account = $datos[0];
        $name = $datos[1];
        $emailClient = $datos[2];
        $phone = $datos[3];
        $typeUser = $datos[4];
        $country = $datos[5];
        $sector = $datos[6];
        $model = $datos[7];
        $message = $datos[8]; 
    
        $query = "SELECT * FROM wp_account WHERE account_aid = $id_account";
        $resultQuery = $conexion->query($query);
        $rowemail = mysqli_fetch_array($resultQuery);
        $email = $rowemail['account_correo'];
        $res = '';
    
        require __DIR__ . '/PHPMailer/src/Exception.php';
        require __DIR__ . '/PHPMailer/src/PHPMailer.php';
        require __DIR__ . '/PHPMailer/src/SMTP.php';
    
        $mail = new PHPMailer(true);
        try {
            //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
            $mail->isSMTP();
            $mail->Host = 'mail.kalstein.net';  // Host de conexión SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@kalstein.net';                 // Usuario SMTP
            $mail->Password = 'Kalstein1234';                           // Password SMTP
            $mail->SMTPSecure = 'ssl';                            // Activar seguridad TLS
            $mail->Port = 465;                                    // Puerto SMTP
    
            #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
            #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
            #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
        
            $mail->setFrom('no-reply@kalstein.net');			// Mail del remitente
            $mail->addAddress($emailKalstein);     // Mail del destinatario    
            $mail->addAddress($email);     // Mail del destinatario
    
            $position = strpos($email, '@');
            $nameEmail = substr($email, 0, $position);
    
            $mail->isHTML(true);
            $mail->Subject = 'KALSTEIN + - Formulario Contacto';  // Asunto del mensaje
            $mail->Body = '
                <div style="width: 100%; background-color: #fff;">
                    <div style="width: 50%; margin-left: 25%;">
                        <div style="width: 100%; color: #000;">
                            <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px;  margin-left: 25%; background-color: #fff; margin-top: 4rem; margin-bottom: 2rem;">
                            <h1 style="text-align: center; color: #000;">Hola, ' . $nameEmail . '</h1>
                            <p style="text-align: justify; color: #000;">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La plataforma Kalstein + ha detectado que un usuario ha realizado el envío de una petición de un producto de tu tienda. Aquí estan sus datos de contactos y su petición.<br>
                                
                                Nombre: '.$name.' <br>
                                Correo: '.$emailClient.' <br>
                                Teléfono: '.$phone.' <br>
                                Tipo de usuario: '.$typeUser.' <br>
                                País: '.$country.' <br> 
                                Sector: '.$sector.' <br>
                                Producto: '.$model.' <br>
                                Mensaje: '.$message.' <br> 
                            </p>
                            <hr>
                            <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Kalstein + nunca le enviará un correo electrónico ni le pedirá que revele o verifique su contraseña, tarjeta de crédito o número de cuenta bancaria.</p>
                            <p style="color: #000;">2024 © Todos los derechos reservados</p>
                        </div>
                    </div>
                </div>
            ';    // Contenido del mensaje (acepta HTML)
            $mail->AltBody = 'Este es el contenido del mensaje en texto plano';    // Contenido del mensaje alternativo (texto plano)
            // Activo condificacción utf-8
            $mail->CharSet = 'UTF-8';
    
            $mail->send();
            return $res = 0;
        } catch (Exception $e) {
            return $res = 1;
        }
    }

    $res = sendEmail();

    echo json_encode($res);
?>