<?php
require 'conexion.php';

include 'translateText.php';
translateText();

$salida = "<option selected value='' style='color: #000 !important;'  data-i17n='client:eligeOpcion'  >Elige una opción</option>";
$consulta = "SELECT DISTINCT catalog_category_es FROM `wp_catalogs_es` ORDER BY `catalog_category_es` ASC";

$resultado = $conexion->query($consulta);
$categorys = array();

if ($resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $category_description = $row['catalog_category_es'];
        array_push($categorys, $category_description);
    }
}

foreach ($categorys as $value) {
    $salida .= "<option value='$value' style='color: #000 !important;'>$value</option>";
}

echo $salida;
$conexion->close();
?>
