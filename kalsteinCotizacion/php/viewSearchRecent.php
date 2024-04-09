<?php
    session_start();

    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }else{
        $email = '';
    }

    require __DIR__ . '/../classes/conexion.php';

    $searchTags = $_POST['consulta'];
    $searchCategorie = $_POST['consulta1'];

    $_SESSION['searchTags'] = $searchTags;
    $_SESSION['searchCategorie'] = $searchCategorie;