<?php
require __DIR__ . '/../classes/conexion.php';
require __DIR__ . '/../classes/templates-php/translateText.php';
translateText();

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

// Adjust these fields based on the language
$descriptionField = "categorie_description_" . $lang;


// if cookie = en then remove _en from the fields
if ($lang == 'en') {
    $descriptionField = "categorie_description";
}

$consulta = "SELECT * FROM wp_categories ORDER BY $descriptionField ASC";
$salida = "<li><a class='dropdown-item' id='li-department' href='#'>Todas las categorías</a></li>";

$resultado = $conexion->query($consulta);
$categorys = array();

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        if (in_array($fila[$descriptionField], $categorys)) {
        } else {
            array_push($categorys, $fila[$descriptionField]);
        }
    }

} else {
    $salida .= "<div class='nodatos'><h5>No data found in your search</h5></div>";
}


foreach ($categorys as $valor) {
    $salida .= "                    
                    <li><a class='dropdown-item' id='li-department' href='#'>" . $valor . "</a></li>
			";
}

echo $salida;
$conexion->close();
?>