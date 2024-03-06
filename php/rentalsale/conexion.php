<?php
    $hostdb = "localhost";
    $userdb = "root";
    $passdb = "";
    $namedb = "kalsteindb";

    $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    if ($conexion -> connect_error) {
        die("La conexión falló: " .$conexion -> connect_error);
    }  