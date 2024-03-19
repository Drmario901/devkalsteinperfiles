<?php
    $hostdb = "localhost";
    $userdb = "kalsteinplus";
    $passdb = "OqA;}vKA94PO";
    $namedb = "kalsteinplus_he270716_wp_es";

    $conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);
    $acentos = $conexion->query("SET NAMES 'utf8'");

    if ($conexion -> connect_error) {
        die("La conexión falló: " .$conexion -> connect_error);
    }  

    // ELIMINAR ESTE ARCHIVO UNA VEZ QUE ESTE
    // VERIFICADA LA FUNCIONALIDAD DE LA NUEVA
    // CONEXION A LA BASE DE DATOS XD