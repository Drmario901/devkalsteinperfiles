<?php
    require __DIR__ . '/conexion.php';

    session_start();
    $email = $_SESSION['emailAccount'];
    $existingTagQuery = $conexion->query("SELECT user_tag FROM wp_account WHERE account_correo = '$email'");
    $tag = $existingTagQuery->fetch_assoc()['user_tag'];
    
    $count = $conexion->query("SELECT COUNT(*) total FROM wp_mensajes WHERE destinatario_id = '$tag'")->fetch_assoc();
    $count2 = $conexion->query("SELECT COUNT(*) unseen FROM wp_mensajes WHERE destinatario_id = '$tag' AND message_seen = '0'")->fetch_assoc();

    echo json_encode(array(
        'total' => $count['total'],
        'unseen' => $count2['unseen']
    ));
    $conexion->close();
?>