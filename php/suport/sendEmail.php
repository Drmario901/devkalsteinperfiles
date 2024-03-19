<?php
    require_once __DIR__ . '/../../db/conexion.php';

    if (isset($_POST['remitente_id'])) {
        $senderId = $_POST['remitente_id'];
        $destinatarioId = $_POST['destinatario_id'];
        $subject = $_POST['asunto'];
        $content = $_POST['contenido'];

        $query = "INSERT INTO mensajes (id, remitente_id, destinatario_id, asunto, contenido) 
                VALUES (NULL, '$senderId', '$destinatarioId', '$subject', '$content')";

        $resultado = $conexion->query($query);
        echo json_encode($resultado, JSON_FORCE_OBJECT);
    }
?>