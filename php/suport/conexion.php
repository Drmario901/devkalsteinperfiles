<?php
    $hostdb = "localhost";
    $userdb = "kalsteinplus";
    $passdb = ".Kx7*WTp@{,g";
    $namedb = "he270716_wp_es";
    /* $namedb2 = "he270716_wp4"; */

    $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    /* $conexion2 = new mysqli($hostdb, $userdb, $passdb, $namedb2);
    $acentos = $conexion->query("SET NAMES 'utf8'"); */

    if ($conexion->connect_error) {
        die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
    }
?>
