<header class="header" data-header>
    <?php
     session_start(); 
        if (isset($_SESSION['emailAccount'])){
         $email = $_SESSION['emailAccount'];
        }
     include 'navbar.php'; 
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
<?php
require __DIR__ . '/../../../php/conexion.php';

function getSentMessages($conexion, $email)
{
    $consulta = "SELECT * FROM wp_mensajes WHERE remitente_id = '$email' ORDER BY fecha_envio DESC";
    $resultado = $conexion->query($consulta);

    $messages = array();

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $messages[] = $row;
        }
    }

    return $messages;
}


$sentMessages = getSentMessages($conexion, $email);
$conexion->close();

$messagesPerPage = 5;
$currentPage = isset($_GET['i']) ? max(1, (int)$_GET['i']) : 1;
$start = ($currentPage - 1) * $messagesPerPage;
$end = $start + $messagesPerPage;
$end = min($end, count($sentMessages));

function limitDescription($description, $limit)
{
    if (strlen($description) > $limit) {
        $description = substr($description, 0, $limit) . '...';
    }
    return $description;
}
?>

<div class="container bootdey">
    <div class="email-app mb-4">
        <nav>
            <a href="https://testing.kalstein.digital/index.php/distributor/inbox/compose" style="color: #fff" class="btn btn-danger btn-block">New Message</a>
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="https://testing.kalstein.digital/index.php/distributor/inbox/"><i class="fa fa-inbox"></i>Inbox</a>
                </li>
            </ul>
        </nav>
        <main class="inbox">
            <?php if (count($sentMessages) > 0) { ?>
                <ul class="messages">
                    <?php foreach (array_slice($sentMessages, $start, $end) as $message) { ?>
                        <li class="message">
                            <a href="https://testing.kalstein.digital/index.php/distributor/sent/view/?message_id=<?php echo $message['id']; ?>">
                                <div class="actions">
                                    <span class="action"><i class="fa fa-square-o"></i></span>
                                    <span class="action"><i class="fa fa-star-o"></i></span>
                                </div>
                                <div class="header-mail">
                                    <span class="from"><?php echo $message['remitente_id']; ?></span>
                                    <span class="date"><?php echo $message['fecha_envio']; ?></span>
                                </div>
                                <div class="title">
                                    <?php echo $message['asunto']; ?>
                                </div>
                                <div class="description">
                                    <?php echo limitDescription($message['contenido'], 100); ?>
                                </div>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= ceil(count($sentMessages) / $messagesPerPage); $i++) { ?>
                            <li class="page-item <?php echo ($i === $currentPage) ? 'active' : ''; ?>">
                                <a class="page-link" href="?i=<?php echo $i; ?>"><?php echo $i; ?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            <?php } else { ?>
                <div class="no-messages">
                    <i style="color: #000 !important" class="fa fa-frown"></i>
                    <p style="color: #000 !important">No messages</p>
                </div>
            <?php } ?>
        </main>
    </div>
</div>

<style>
    .message:hover {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
    }

    .no-messages {
        text-align: center;
        font-size: 20px;
        margin-top: 20px;
        color: #999;
    }
</style>
