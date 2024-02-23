<?php
    $hostdb = "localhost";
    $userdb = "he270716";
    $passdb = "RP\$c_myoUeMK";
    $namedb = "he270716_wp_es";
    $namedb2 = "he270716_wp4";
    $namedb3 = "he270716_wp3";

    $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    $conexion2 = new mysqli($hostdb, $userdb, $passdb, $namedb2);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    $conexion3 = new mysqli($hostdb, $userdb, $passdb, $namedb3);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    if ($conexion->connect_error) {
        die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
    }
?>
