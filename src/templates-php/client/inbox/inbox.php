<?php
    session_start();
    require __DIR__ . '/../../../../php/conexion.php';
    $email = $_SESSION['emailAccount'];
    
    $existingTagQuery = "SELECT user_tag FROM wp_account WHERE account_correo = '$email'";
    $resultado = mysqli_query($conexion, $existingTagQuery);
    
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $userTag = $row['user_tag'];
            //echo "tag: " . $userTag;
        }
    
        function getSenderProfileImage($conexion, $userTag)
        {
            $consulta = "SELECT account_url_image_perfil
                        FROM wp_account
                        WHERE user_tag = '$userTag'";
            $resultado = $conexion->query($consulta);
            $row = $resultado->fetch_assoc();
            return $row['account_url_image_perfil'];
        }
    
        function getMessageDetails($conexion, $message_id)
        {
            $consulta = "SELECT m.*, a.account_url_image_perfil
                        FROM wp_mensajes m
                        JOIN wp_account a ON m.remitente_id = a.user_tag
                        WHERE m.id = '$message_id'";
            $resultado = $conexion->query($consulta);
            $message = $resultado->fetch_assoc();
            return $message;
        }
    
        function getSentMessages($conexion, $userTag)
        {
            $consulta = "SELECT * FROM wp_mensajes WHERE destinatario_id = '$userTag' ORDER BY fecha_envio DESC";
            $resultado = $conexion->query($consulta);
    
            $messages = array();
    
            if ($resultado->num_rows > 0) {
                while ($row = $resultado->fetch_assoc()) {
                    $messages[] = $row;
                }
            }
    
            return $messages;
        }
    
        function limitDescription($description, $limit)
        {
            if (strlen($description) > $limit) {
                $description = substr($description, 0, $limit) . '...';
            }
            return $description;
        }
    
        $destinatario_id = $userTag;
    
        $sentMessages = getSentMessages($conexion, $destinatario_id);
    } else {
        echo "Error" . mysqli_error($conexion);
    }
    
    $conexion->close();
    $messagesPerPage = 10;
    $currentPage = isset($_GET['i']) ? $_GET['i'] : 1;
    $start = ($currentPage - 1) * $messagesPerPage;

    echo '
        <div class="container bootdey">
            <div class="email-app mb-4">
                <nav>
                    <a href="#" id="inbox-compose" style="color: #fff" class="btn btn-danger btn-block" data-i18n="client:nuevoMenssaje">Nuevo mensaje</a>
                    <ul class="nav">
                        <li class="nav-item">
                            <b><a class="nav-link" href="#" id="inbox-inbox" data-i18n="client:inbox"><i class="fa fa-inbox"></i>Inbox</a></b>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" id="inbox-sent" data-i18n="client:enviados"><i class="fa fa-rocket"></i>Enviados</a>
                        </li>
                    </ul>
                </nav>
                <main class="inbox">';
    if (count($sentMessages) > 0) {

        echo '
                    <ul class="messages">';

        foreach (array_slice($sentMessages, $start, $messagesPerPage) as $message) {
            $a_regex = "/<a\s*.*>\s*.*<\/a>/";
            $whitout_a_text = preg_replace($a_regex, '', $message['contenido']);
            $seen = !$message['message_seen'] ? ' not_message_seen' : '';

            echo '
                        <li class="message" data-message-id="' . $message['id'] . '">
                            <a id="inbox-view" value="'.$message['id'].'">
                                <div class="header-mail'.$seen.'">
                                    <div class="from">' . $message['remitente_id'] . '</div>
                                    <div class="description">'.$message['asunto'].' - '.$message['contenido'].'</div>
                                    <div class="timePassed" data-timestamp="' . strtotime($message['fecha_envio']) . '"></div>
                                </div>
                            </a>
                        </li>';
        }
        echo '
                    </ul>
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">';
        for ($i = 1; $i <= ceil(count($sentMessages) / $messagesPerPage); $i++) {
            echo '
                            <li class="page-item ' . (($i === $currentPage) ? 'active' : '') . '">
                                <a class="page-link" href="#" id="inbox-inbox" ivalue=' . $i . '">' . $i . '</a>
                            </li>';
        }
        echo '          </ul>
                    </nav>';
    }
    else {
        echo '
                    <div class="no-messages">
                        <p style="color: #000 !important" data-i18n="client:noMsj">No hay mensajes</p>
                    </div>';
    }
    echo '
                </main>
            </div>
        </div>
    ';
?>
<style>
    /*.message:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .no-messages {
        text-align: center;
        font-size: 20px;
        margin-top: 20px;
        color: #999;
    }

    .messages {
        list-style-type: none;
        padding: 0;
    }

    .message {
        display: flex;
        flex-direction: column;
        padding: 4px;
        border: 1px solid #ccc;
    }

    .message .header {
        display: flex;
        justify-content: space-between;
    }

    .message .from {
        font-weight: bold; 
    }

    .message .title {
        font-weight: bold;
    }

    .message .description {
        margin-bottom: 10px;
    }

    .message .date, 
    .message .timePassed {
        color: #666;
        font-size: 14px;
    }

    .message .actions {
        display: flex;
        justify-content: flex-end;
    }

    .message .action {
        color: #08c;
        font-size: 14px;
    }

    .email-app .inbox .message .header-mail {
        display: flex;
        flex-direction: row;
        margin-bottom: 0.5rem;
        flex-wrap: nowrap;
        align-content: stretch;
        justify-content: space-between;
    }

    .inbox {
        padding: 0 !important;
    }*/
</style>
