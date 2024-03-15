<?php
    require __DIR__.'../../db/conexion.php';

    $foreignId = $_POST['email'];

    $consulta = "SELECT * FROM wp_account WHERE account_correo = '$foreignId'";

    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $dateCreated = $row['account_created_at'];
    $html = "<p>$dateCreated: has joined the platform</p>";

    echo $html;
?>