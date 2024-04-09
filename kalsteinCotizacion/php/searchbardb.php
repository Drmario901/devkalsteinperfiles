<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../classes/conexion.php';
require __DIR__ . '/../classes/templates-php/translations.php';

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
$salida = "";
$department = $_POST['consulta1'];

$todas = $translations[$lang]['all'];
$todasCat = $translations[$lang]['allCategories'];

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
$tagDescriptionField = $lang == 'en' ? 'tags_description' : 'tags_description_' . $lang;
$categoriesField = $lang == 'en' ? 'tags_categorie' : 'tags_categorie_' . $lang;
$productCategoryField = $lang == 'en' ? 'product_category' : 'product_category_' . $lang;

if ($department == $todas || $department == $todasCat) {
	if (isset($_POST['consulta'])) {
		$q = $conexion->real_escape_string($_POST['consulta']);
		$consulta = "SELECT $tagDescriptionField FROM wp_tags WHERE $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
		$consulta2 = "SELECT product_model FROM wp_k_products WHERE product_model LIKE '%" . $q . "%' AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell', 'used') LIMIT 0, 11";
		$consulta3 = "SELECT * FROM wp_tags WHERE $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
	}

	$resultado = $conexion->query($consulta);

	if ($resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			$salida .= "
						<li><a class='dropdown-item li-sug' href='#'>" . $fila[$tagDescriptionField] . "</a></li>
				";
		}
	} else {
		$resultado = $conexion->query($consulta2);

		if ($resultado->num_rows > 0) {
			while ($fila = $resultado->fetch_assoc()) {
				$salida .= "
							<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
					";
			}
		} else {
			$resultado = $conexion->query($consulta3);

			if ($resultado->num_rows > 0) {
				while ($fila = $resultado->fetch_assoc()) {
					$salida .= "
								<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
						";
				}
			} else {
				$salida .= "<div class='nodatos'><p style='font-weight: bold; font-size: 1.1rem; margin-top: 0.5rem; margin-left: 0.3rem;'>No se encontraron datos para tu búsqueda</p></div>";
			}
		}
	}
} else {
	if (isset($_POST['consulta'])) {
		$q = $conexion->real_escape_string($_POST['consulta']);
		$consulta = "SELECT $tagDescriptionField FROM wp_tags WHERE $categoriesField = '$department' AND $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
		$consulta2 = "SELECT product_model FROM wp_k_products WHERE $productCategoryField = '$department' AND product_model LIKE '%" . $q . "%' AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell', 'used') LIMIT 0, 11";
		$consulta3 = "SELECT * FROM wp_tags WHERE $categoriesField = '$department' AND $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
	}


	$resultado = $conexion->query($consulta);

	if ($resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			$salida .= "
						<li><a class='dropdown-item' href='#'>" . $fila[$tagDescriptionField] . "</a></li>
				";
		}
	} else {
		$resultado = $conexion->query($consulta2);

		if ($resultado->num_rows > 0) {
			while ($fila = $resultado->fetch_assoc()) {
				$salida .= "
							<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
					";
			}
		} else {
			$resultado = $conexion->query($consulta3);
			var_dump($resultado->num_rows);

			if ($resultado->num_rows > 0) {
				while ($fila = $resultado->fetch_assoc()) {
					$salida .= "
								<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
						";
				}
			} else {
				$salida .= "<div class='nodatos'><p style='font-weight: bold; font-size: 1.1rem; margin-top: 0.5rem; margin-left: 1rem;'>No se encontraron datos para tu búsqueda</p></div>";
			}
		}
	}
}
echo $salida;
$conexion->close();
?>