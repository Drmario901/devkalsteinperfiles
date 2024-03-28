<?php
	session_start();

	if (isset($_SESSION['emailAccount'])){
		$email = $_SESSION['emailAccount'];
	}else{
		$email = '';
	}

	require_once __DIR__ . '/../db/conexion.php';

	$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
	$resultado = $conexion->query($consulta);
	$count = mysqli_num_rows($resultado);

	if ($count >= 10){
		$quoteMax = 'maximo';
	}else{
		$quoteMax = 'falta';
	}

	$datos = array(
		'quoteMax' => $quoteMax
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();