<?php 

	require __DIR__ . '/conexion.php';



    $model = $_POST['consulta'];



	$query = "DELETE FROM wp_k_products WHERE product_model = '$model'";	

	if($conexion->query($query) === TRUE){
        $delete = "correcto";    
    }else{
        $delete = "incorrecto";
    }

	$datos = array(
		'delete' => $delete
	);



	echo json_encode($datos, JSON_FORCE_OBJECT); 

 ?>

