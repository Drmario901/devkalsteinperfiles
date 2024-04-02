<?php 
	header('Access-Control-Allow-Origin: *');
	require __DIR__ . '/../classes/conexion.php';

    $consulta = "SELECT * FROM wp_categories ORDER BY categorie_description_fr ASC";
	$salida = "<li><a class='dropdown-item' id='li-department' href='#'>Toutes les catégories</a></li>";

	$resultado = $conexion->query($consulta);
	$categorys = array();

	if ($resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			if (in_array($fila['categorie_description_fr'], $categorys)){
			}else{
				array_push($categorys, $fila['categorie_description_fr']);
			}
		}

	} else {
		$salida.="<div class='nodatos'><h5>No data found in your search</h5></div>";
	}


	foreach ($categorys as $valor) {
		$salida.="                    
                    <li><a class='dropdown-item' id='li-department' href='#'>".$valor."</a></li>
			";
	}

	echo $salida;
	$conexion->close();
 ?>