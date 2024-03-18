<?php
    session_start();
    require '../db/conexion.php';
    require __DIR__.'/PHPMailer/src/Exception.php';
    require __DIR__.'/PHPMailer/src/PHPMailer.php';
    require __DIR__.'/PHPMailer/src/SMTP.php';
    

    $validate_aid = $_POST['p_id'];

    $consultQuery = "SELECT * FROM wp_k_products WHERE product_aid = '$validate_aid'";
    $resultQuery = $conexion->query($consultQuery);
    $row = mysqli_fetch_array($resultQuery);    
    $email = $row["product_maker"];

    if (isset($_SESSION['privateEmailAccount'])){
        $acc_id = $_SESSION['privateEmailAccount'];
    }
    else{
        $acc_id = 'josealeve@gmail.com';
    }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'product' AND action_mod = '$acc_id' AND action_id = '$validate_aid'";
    $resultAction = $conexion->query($queryAction);

    if ($resultAction->num_rows > 0){
        
        $query = "UPDATE wp_k_products SET product_validate_status = 'validated' WHERE product_aid = '$validate_aid'";
        $result = $conexion->query($query);

        $queryWooId = "SELECT woo_id FROM wp_product_id_woo WHERE product_id = '$validate_aid'";
        $wooId = $conexion->query($queryWooId)->fetch_array()[0];

        $queryWoo = "UPDATE wp_posts SET post_status = 'publish' WHERE ID = '$wooId'";
        $resultWoo = $conexion->query($queryWoo);
        
        $response = array();
    
        
        if($result){
            $response = array('status' => 'correcto');

            $mod = $_SESSION['privateEmailAccount'];
            $receptor = $conexion->query("SELECT product_maker FROM wp_k_products WHERE product_aid = '$validate_aid'")->fetch_array()[0];

            if ( ($buis = $conexion->query("SELECT company_nombre FROM wp_company WHERE company_account_correo = '$receptor'"))->num_rows > 0 ){
                $texto_buis = '<br>'.$buis->fetch_array()[0];
            }
            else {
                $texto_buis = '';
            }

            $conexion->query("INSERT INTO wp_mod_log (moder, receptor, type, meta) VALUES ('$mod', '$receptor$texto_buis', 'p_aproved', '$validate_aid')");

            $queryDeleteMove = "DELETE FROM wp_mod_moves WHERE action_id = '$validate_aid'";
            $queryDeleteResult = $conexion->query($queryDeleteMove);
            try {                
                $mail = new PHPMailer(true);
    
               
                //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
                $mail->isSMTP();
                $mail->Host = 'mail.kalstein.net';  // Host de conexión SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'no-reply2@kalstein.net';                 // Usuario SMTP
                $mail->Password = 'Kalstein1234';                           // Password SMTP
                $mail->SMTPSecure = 'ssl';                            // Activar seguridad TLS
                $mail->Port = 465;                             // Puerto SMTP
            
                #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
                #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
                #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
            
                $mail->setFrom('no-reply2@kalstein.net');		// Mail del remitente
                $mail->addAddress($email);     // Mail del destinatario
        
                $position = strpos($email, '@');
                $nameEmail = substr($email, 0, $position);
             
                $mail->isHTML(true);
                $mail->Subject = 'Enhorabuena, su producto ha sido validado.';  // Asunto del mensaje
                $mail->Body    = '
                    <div style="width: 100%; background-color: #fff;">
                        <div style="width: 50%; margin-left: 25%;">
                            <div style="width: 100%; color: #000;">
                                <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px;  margin-left: 25%; background-color: #fff; margin-top: 4rem; margin-bottom: 2rem;">
                                <h1 style="text-align: center; color: #000;">Hola, '.$nameEmail.'</h1>
                                <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nuestro equipo de moderadores ha validado tu producto. Ya puede iniciar sus actividades en nuestra plataforma</p>
                                <p style="text-align: center; color: #000; font-size: 1.2em; font-weight: bold;">Comenzar ahora</p>
                                <p style="text-align: center; color: #000; font-weight: bold; font-size: 2em;">https://dev.kalstein.plus/plataforma/acceder</p>
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
            }
            catch (Exception $e) {
                echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo;
            }
        }
        else {
            $response = array('status' => 'incorrecto');
        }
    }
    else {
        echo json_encode(array('status' => 'busy'));
    }
    

    echo json_encode($response);
?>