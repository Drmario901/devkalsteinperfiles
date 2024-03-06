<header class="header" data-header>
    <?php 
    include 'navbar.php';
    session_start(); 
    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount'];
    }
    ?>
    <script>
        let page = "inbox";
        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<br>
<br>
<br>
<br>
<br>
<div class="container">
    <div class="email-app mb-4">
        <nav>
            <a href="https://dev.kalstein.plus/plataforma/index.php/distributor/inbox/compose" style="color: #fff !important" class="btn btn-danger btn-block">New Message</a>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/distributor/inbox/"><i class="fa fa-inbox"></i> Inbox</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/distributor/inbox/sent"><i class="fa fa-rocket"></i> Sent</a>
                </li>
            </ul>
        </nav>
        <main class="message">
            <div class="details">
                <?php
                require __DIR__.'/../../../php/conexion.php';

                function getSenderProfileImage($conexion, $email)
                {
                    $consulta = "SELECT account_url_image_perfil
                                 FROM wp_account
                                 WHERE account_correo = '$email'";
                    $resultado = $conexion->query($consulta);
                    $row = $resultado->fetch_assoc();
                    return $row['account_url_image_perfil'];
                }

                function getMessageDetails($conexion, $message_id)
                {
                    $consulta = "SELECT m.*, a.account_url_image_perfil
                                 FROM wp_mensajes m
                                 JOIN wp_account a ON m.remitente_id = a.account_correo
                                 WHERE m.id = '$message_id'";
                    $resultado = $conexion->query($consulta);
                    $message = $resultado->fetch_assoc();
                    return $message;
                }

                if (isset($_GET['message_id'])) {
                    $message_id = $_GET['message_id'];
                    $message = getMessageDetails($conexion, $message_id);

                    if ($message) {
                        echo '<div class="title">' . $message['asunto'] . '</div>';
                        echo '<div class="header-mail">';

                        $sender_avatar_url = getSenderProfileImage($conexion, $message['remitente_id']);

                        $default_avatar_url = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
                        $avatar_url = $sender_avatar_url ? 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$sender_avatar_url : $default_avatar_url;

                        echo '<img class="avatar" src="' . $avatar_url . '">';
                        echo '<div class="from">';
                        echo '<span style="color: #000">' . $message['remitente_id'] . '</span>';
                        echo '<p style="color: #000">' . $message['remitente_correo'] . '</p>';
                        echo '</div>';
                        echo '<div class="date">' . date('F j, Y, g:i a', strtotime($message['fecha_envio'])) . '</div>';
                        echo '</div>';
                        echo '<div class="content">';
                        echo '<p>' . $message['contenido'] . '</p>';
                        echo '</div>';
                    } else {
                        echo '<div class="title">Message not found</div>';
                    }

                    $conexion->close();
                } else {
                    echo '<div class="title">Invalid message ID</div>';
                }
                ?>
            </div>
        </main>
    </div>
</div>
