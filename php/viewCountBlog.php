<?php
    require_once __DIR__ . '/../db/conexion.php';

    $aid_art = $_POST['id'];
    $update = "UPDATE wp_art_blog SET art_views = art_views + 1 WHERE art_id = $aid_art";
    $conexion->query($update);