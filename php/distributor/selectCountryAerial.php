<?php
require __DIR__.'../../db/conexion.php';

$salida = "<option selected value='0'>Choose an option</option>";

$consulta = "SELECT ra.rate_country, p.en AS country_name
            FROM wp_rates_air ra
            LEFT JOIN wp_paises p ON ra.rate_country = p.iso
            WHERE ra.`5kg` IS NOT NULL OR ra.`10kg` IS NOT NULL OR ra.`15kg` IS NOT NULL OR ra.`20kg` IS NOT NULL OR ra.`30kg` IS NOT NULL OR ra.`40kg` IS NOT NULL OR ra.`50kg` IS NOT NULL OR ra.`60kg` IS NOT NULL
            ORDER BY p.en";

$resultado = $conexion->query($consulta);

if ($resultado && $resultado->num_rows > 0) {
    while ($value = $resultado->fetch_assoc()) {
        $rate_country = $value["rate_country"];
        $country_name = $value["country_name"];

        $salida .= "<option style='color: #000 !important;' value='$rate_country'>$country_name</option>";
    }
}

if ($salida === "<option selected value='0'>Choose an option</option>") {
    $salida .= "<option style='color: #000 !important;' disabled>No data available</option>";
}

echo $salida;
?>
