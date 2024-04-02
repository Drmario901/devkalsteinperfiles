<?php
header('Access-Control-Allow-Origin: *');
require __DIR__ . '/../classes/conexion.php';

$salida = "";
$department = $_POST['consulta1'];

if ($department == 'Todos' || $department == 'Todas las categorías') {
	if (isset($_POST['consulta'])) {
		$q = $conexion->real_escape_string($_POST['consulta']);
		$consulta = "SELECT tags_description_es FROM wp_tags WHERE tags_description_es LIKE '%" . $q . "%' LIMIT 0, 11";
		$consulta2 = "SELECT product_model FROM wp_k_products WHERE product_model LIKE '%" . $q . "%' LIMIT 0, 11";
		$consulta3 = "SELECT * FROM wp_tags WHERE tags_description_es LIKE '%" . $q . "%' LIMIT 0, 11";
	}

	$resultado = $conexion->query($consulta);

	if ($resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			$salida .= "
						<li><a class='dropdown-item li-sug' style='overflow: hidden;' id='li-sug' href='#'>" . $fila['tags_description_es'] . "</a></li>
				";
		}
	} else {
		$resultado = $conexion->query($consulta2);

		if ($resultado->num_rows > 0) {
			while ($fila = $resultado->fetch_assoc()) {
				$salida .= "
							<li><a class='dropdown-item li-sug' style='overflow: hidden;' id='li-sug' href='#'>" . $fila['product_model'] . "</a></li>
					";
			}
		} else {
			$resultado = $conexion->query($consulta3);

			if ($resultado->num_rows > 0) {
				while ($fila = $resultado->fetch_assoc()) {
					$salida .= "
								<li><a class='dropdown-item li-sug' style='overflow: hidden;' id='li-sug' href='#'>" . $fila['product_model'] . "</a></li>
						";
				}
			} else {
				$salida .= "<div class='nodatos'><h5>No se encontraron datos en su búsqueda</h5></div>";
			}
		}
	}
} else {
	if (isset($_POST['consulta'])) {
		$q = $conexion->real_escape_string($_POST['consulta']);
		$consulta = "SELECT tags_description_es FROM wp_tags WHERE tags_categorie_es = '$department' AND tags_description_es LIKE '%" . $q . "%'  LIMIT 0, 11";
		$consulta2 = "SELECT product_model FROM wp_k_products WHERE product_category_es = '$department' AND product_model LIKE '%" . $q . "%' LIMIT 0, 11";
		$consulta3 = "SELECT * FROM wp_tags WHERE tags_categorie_es = '$department' AND tags_description_es LIKE '%" . $q . "%' LIMIT 0, 11";
	}


	$resultado = $conexion->query($consulta);

	if ($resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			$salida .= "
						<li><a class='dropdown-item li-sug' style='overflow: hidden;' id='li-sug' href='#'>" . $fila['tags_description_es'] . "</a></li>
				";
		}
	} else {
		$resultado = $conexion->query($consulta2);

		if ($resultado->num_rows > 0) {
			while ($fila = $resultado->fetch_assoc()) {
				$salida .= "
							<li><a class='dropdown-item li-sug' style='overflow: hidden;' id='li-sug' href='#'>" . $fila['product_model'] . "</a></li>
					";
			}
		} else {
			$resultado = $conexion->query($consulta3);

			if ($resultado->num_rows > 0) {
				while ($fila = $resultado->fetch_assoc()) {
					$salida .= "
								<li><a class='dropdown-item li-sug' style='overflow: hidden;' id='li-sug' href='#'>" . $fila['product_model'] . "</a></li>
						";
				}
			} else {
				$salida .= "<div class='nodatos'><h5>No se encontraron datos en su búsqueda</h5></div>";
			}
		}
	}
}
echo $salida;
$conexion->close();
?>