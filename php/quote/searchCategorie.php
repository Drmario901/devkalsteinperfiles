<?php
require __DIR__ . '/conexion.php';

$consulta = "SELECT * FROM wp_categories ORDER BY categorie_description ASC";
$salida = "<option selected style='text-align: center;' value='0'>-- Select --</option>
                <option value='1'>All</option>
    ";

$resultado = $conexion->query($consulta);
$categorys = array();

if ($resultado->num_rows > 0) {
	while ($fila = $resultado->fetch_assoc()) {
		if (in_array($fila['categorie_description'], $categorys)) {
		} else {
			array_push($categorys, $fila['categorie_description']);
		}
	}

} else {
	$salida .= "<div class='nodatos'><h5>No se encontraron datos en su búsqueda</h5></div>";
}


foreach ($categorys as $valor) {
	$salida .= "                    
                    <option value='" . $valor . "'>" . $valor . "</option>
			";
}

echo $salida;
$conexion->close();
?>