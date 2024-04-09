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

    $consulta = "INSERT INTO wp_register_searches(aid_searches, account_id, searches_date, searches_description, searches_categorie) VALUES ('', '$email', CURRENT_TIMESTAMP, '$searchTags', '$searchCategorie')";
    $conexion->query($consulta);

    $datos = array(
		'url' => $url
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);