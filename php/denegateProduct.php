<?php

    require_once '/conexion.php';

    session_start();

    $denegate_aid = $_POST['p_id'];
    $msg = $_POST['msg'];
    $strike = $_POST['strike'];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $strike = $strike ? 1 : 0;
        
    if (isset($_SESSION['privateEmailAccount'])){
        $acc_id = $_SESSION['privateEmailAccount'];
    }
    else{
        $acc_id = 'josealeve@gmail.com';
    }

    $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'product' AND action_mod = '$acc_id' AND action_id = '$denegate_aid'";
    $resultAction = $conexion->query($queryAction);

    if ($resultAction->num_rows > 0){

        $query = "UPDATE wp_k_products SET product_validate_status = 'denied' WHERE product_aid = '$denegate_aid'";
        $result = $conexion->query($query);
    
        $response = array();
    
        if($result){
            $response = array('status' => 'correcto');

            $mod = $_SESSION['privateEmailAccount'];
            $receptor = $conexion->query("SELECT product_maker FROM wp_k_products WHERE product_aid = '$denegate_aid'")->fetch_array()[0];

            if ( ($buis = $conexion->query("SELECT company_nombre FROM wp_company WHERE company_account_correo = '$receptor'"))->num_rows > 0 ){
                $texto_buis = '<br>'.$buis->fetch_array()[0];
            }
            else {
                $texto_buis = '';
            }

            $conexion->query("INSERT INTO wp_mod_log (moder, receptor, type, meta, extra) VALUES ('$mod', '$receptor$texto_buis', 'p_denied', '$denegate_aid', '$msg')");
        }
        else {
            $response = array('status' => 'incorrecto');
        }
    
        
        $queryMaker = "SELECT product_maker, product_name_es FROM wp_k_products WHERE product_aid = '$denegate_aid'";
        $resultMaker = $conexion->query($queryMaker)->fetch_array()[0];
        $email = $resultMaker;
    
        $queryRol = "SELECT account_rol_aid, user_tag FROM wp_account WHERE account_correo = '$resultMaker'";
        $resRol = $conexion->query($queryRol)->fetch_array();
        $resultRol = $resRol[0];
        $makerTag = $resRol[1];
    
        $link = $resultRol == '3'? '<a style="color: #2271b3 !important" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/productos/editar?edit='.$denegate_aid.'">Edit publication</a>' : '<a href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/productos/editar?edit='.$denegate_aid.'">Edit publication</a>';
    
        $senderId = $acc_id;
        $destinatarioId = $resultMaker;
        if($strike == '1'){
            $subject = "Moderador ha encontrado irregularidades en la publicación de su producto.";
        }
        else{
            $subject = "Aviso de denegación de producto";
        }
        $content = "Un moderador ha encontrado irregularidades en la publicación del producto $denegate_aid.<br> Observaciones del moderador: <br><i>$msg</i><br><br>$link";
    
        $query = "INSERT INTO wp_mensajes (remitente_id, destinatario_id, asunto, contenido, important) 
                  VALUES ('Equipo de moderación Kalstein', '$makerTag', '$subject', '$content', 1)";
        $result = $conexion->query($query);
    
        $queryacall = "INSERT INTO wp_atention_calls (type, description, moderator_id, to_user, strike)
                       VALUES ('product', '$msg', '$acc_id', '$resultMaker', '$strike')";
        $resultacall = $conexion->query($queryacall);

        $queryDeleteMove = "DELETE FROM wp_mod_moves WHERE action_id = '$denegate_aid'";
        $queryDeleteResult = $conexion->query($queryDeleteMove);
    
        if(!$result) {
            $response = array('status' => 'incorrecto');
        }
        else {
            $response = array('status' => 'correcto', 'emailto' => $email);
        }

        try {
            require __DIR__.'/../PHPMailer/src/Exception.php';
            require __DIR__.'/../PHPMailer/src/PHPMailer.php';
            require __DIR__.'/../PHPMailer/src/SMTP.php';
            
            $mail = new PHPMailer(true);
            
            //$mail->SMTPDebug = 2;  // Sacar esta línea para no mostrar salida debug
            $mail->isSMTP();
            $mail->Host = 'dev.kalstein.plus/plataforma';  // Host de conexión SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@dev.kalstein.plus/plataforma';                 // Usuario SMTP
            $mail->Password = 'XsI2C;6d{++-';                           // Password SMTP
            $mail->SMTPSecure = 'tls';                            // Activar seguridad TLS
            $mail->Port = 587;                                    // Puerto SMTP
            

            #$mail->SMTPOptions = ['ssl'=> ['allow_self_signed' => true]];  // Descomentar si el servidor SMTP tiene un certificado autofirmado
            #$mail->SMTPSecure = false;				// Descomentar si se requiere desactivar cifrado (se suele usar en conjunto con la siguiente línea)
            #$mail->SMTPAutoTLS = false;			// Descomentar si se requiere desactivar completamente TLS (sin cifrado)
            
            $mail->setFrom('no-reply@dev.kalstein.plus/plataforma');		// Mail del remitente
            $mail->addAddress($email);     // Mail del destinatario
    
            $position = strpos($email, '@');
            $nameEmail = substr($email, 0, $position);
            
            $mail->isHTML(true);
            $mail->Subject = '!';  // Asunto del mensaje
            $mail->Body    = '
                <div style="width: 100%; background-color: #fff;">
                    <div style="width: 50%; margin-left: 25%;">
                        <div style="width: 100%; color: #000;">
                            <img src="https://kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png" style="width: 200px;  margin-left: 25%; background-color: #fff; margin-top: 4rem; margin-bottom: 2rem;">
                            <h1 style="text-align: center; color: #000;">Hi, '.$nameEmail.'</h1>
                            <p style="text-align: justify; color: #000;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Parece que nuestro equipo de moderadores encontró irregularidades con tu producto registrado, accede a tu cuenta y verifica el motivo.</p>
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
            echo 'El mensaje no se ha podido enviar, error: ', $mail->ErrorInfo, $email;
        }
    
        echo json_encode($response);
    }
    else {
        echo json_encode(array('status' => 'busy', 'emailto' => "$email"));
    }

?>