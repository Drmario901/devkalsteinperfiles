<header class="header" data-header>
        <?php include 'navdar.php'; ?>
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
                <a href="http://127.0.0.1/wp-local/suport/compose" style="color: #fff !important" class="btn btn-danger btn-block">New Email</a>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1/wp-local/suport/inbox"><i class="fa fa-inbox"></i> Inbox</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="http://127.0.0.1/wp-local/suport/sent"><i class="fa fa-rocket"></i> Sent</a>
                    </li>
                </ul>
            </nav>
            <main class="message">
                <div class="details">
                    <?php
                    require __DIR__.'/../../../php/conexion.php';

                    function getMessageDetails($conexion, $message_id)
                    {
                        $consulta = "SELECT * FROM mensajes WHERE id = '$message_id' ";
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
                            echo '<img class="avatar" src="https://bootdey.com/img/Content/avatar/avatar1.png">';
                            echo '<div class="from">';
                            echo '<span style="color: #000">' . $message['remitente_id'] . '</span>';
                            echo '<p style="color: #000">' . (isset($message['remitente_correo']) ? $message['remitente_correo'] : '') . '</p>';
                            echo '</div>';
                            echo '<div class="date">' . $message['fecha_envio'] . '</div>';
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