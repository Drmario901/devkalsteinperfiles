<?php
    $hostdb = "localhost";
    $userdb = "kalsteinplus";
    $passdb = "OqA;}vKA94PO";
    $namedb = "kalsteinplus_he270716_wp_es";

    $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    if ($conexion->connect_error) {
        die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
    }
?>
