<?php
session_start();
$email = $_SESSION['emailAccount'];

require __DIR__ . '/../../../../php/conexion.php';
$existingTagQuery = "SELECT user_tag FROM wp_account WHERE account_correo = '$email'";

$resultado = mysqli_query($conexion, $existingTagQuery);

if ($resultado) {
    $row = mysqli_fetch_assoc($resultado);

    if ($row) {
        $userTag = $row['user_tag'];
    }
    mysqli_free_result($resultado);
}
?>

<div class="container">
    <div class="email-app mb-4">
        <nav>
            <a href="#" id="inbox-compose" style="color: #fff !important" class="btn btn-danger btn-block">Nuevo mensaje</a>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#" id="inbox-inbox"><i class="fa fa-inbox"></i>Inbox</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" id="inbox-sent"><i class="fa fa-rocket"></i>Enviados</a>
                </li>
            </ul>
        </nav>
        <main class="message p-4">
            <div class="details">
                <?php
                require __DIR__.'/../../../../php/conexion.php';

                // ESPAÑOL
                
                setlocale(LC_TIME, 'es_ES');

                function getProfileImage($conexion, $userTag)
                {
                    $consulta= "SELECT account_url_image_perfil, account_nombre, account_apellido
                                FROM wp_account
                                WHERE user_tag = '$userTag'";
                    $resultado = $conexion->query($consulta);
                    $row = $resultado->fetch_assoc();

                    $imgPerfil = $row['account_url_image_perfil'];

                    $name = $row['account_nombre'];
                    $lastname = $row['account_apellido'];
                    $firstLyricsName = strtoupper($name[0]);
                    $firstLyricsLastname = strtoupper($lastname[0]);

                    if ($imgPerfil == ''){
                        $urlImagePerfil = 'Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
                    }else{
                        $urlImagePerfil = 'upload/'.$imgPerfil;
                    }

                    return $urlImagePerfil;
                }

                function getMessageDetails($conexion, $message_id)
                {
                    $consulta = "SELECT * FROM wp_mensajes WHERE id = '$message_id'";
                    $resultado = $conexion->query($consulta);
                    $message = $resultado->fetch_assoc();
                    return $message;
                }

                if (isset($_GET['message_id'])) {
                    $message_id = $_GET['message_id'];
                    $message = getMessageDetails($conexion, $message_id);

                    $set_send = $conexion->query("UPDATE wp_mensajes SET message_seen = '1' WHERE id = '$message_id' AND message_seen = '0'");

                    if ($message) {
                        echo '
                            <div class="title">' . $message['asunto'] . '</div>';

                        // INFORMACION DEL REMITENTE 
                        echo '
                                <div class="header-mail">';
                        $sender_avatar_url = getProfileImage($conexion, $message['remitente_id']);
                        $sender_avatar_url = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/'.$sender_avatar_url;
                        echo '
                                    <img class="avatar" src="' . $sender_avatar_url . '">
                                    <div class="from">
                                        <span style="color: #000">De: ' . $message['remitente_id'] . '</span>
                                    </div>
                                </div>';

                        // INFORMACION DEL DESTINATARIO
                        echo '
                                <div class="header-mail" style="display: flex; align-items: center; justify-content: space-between;">';
                        $recipient_avatar_url = getProfileImage($conexion, $message['destinatario_id']);
                        $recipient_avatar_url = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/'.$recipient_avatar_url;
                        echo '
                                    <img class="avatar" src="' . $recipient_avatar_url . '">
                                    <div class="to">
                                        <b><span style="color: #000">Para: ' . $message['destinatario_id'] . '</span></b>
                                    </div>
                                    <div class="date" style="text-align: right;">';
                        // Formatear la fecha en español
                        $formatted_date = strftime('%e de %B de %Y, %H:%M %p', strtotime($message['fecha_envio']));
                        echo $formatted_date;
                        echo '
                                    </div>
                                </div>';

                        echo '  <br>';

                        echo '
                                <div class="content">
                                    <p>' . $message['contenido'] . '</p>';
                        if($message['remitente_id'] != $userTag){
                            echo '
                                    <a href="#" id="inbox-compose" style="color: #0d6efd" To="'.$message['remitente_id'].'" subject="'.$message['asunto'].'">Reply</a>
                                </div>';
                        }
                        else {
                            echo '
                                </div>';
                        }
                    } else {
                        echo '
                                <div class="title">Mensaje no encontrado</div>';
                    }

                    $conexion->close();
                } else {
                    echo '
                                <div class="title">ID de mensaje inválido</div>';
                }
                ?>
            </div>
        </main>
    </div>
</div>

