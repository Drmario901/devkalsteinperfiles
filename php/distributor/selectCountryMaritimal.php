<?php
    require_once '../../db/conexion.php';

    $salida = "<option selected value='0'>Choose an option</option>";
    
    $consulta = "SELECT rc.rate_country, rm.`1m³`
                FROM wp_rates_country rc
                LEFT JOIN wp_rates_maritime rm ON rc.rate_country = rm.rate_country";

    $resultado = $conexion->query($consulta);

    if ($resultado && $resultado->num_rows > 0) {
        while ($value = $resultado->fetch_assoc()) {
            $rate_country = $value["rate_country"];
            $precio_m3 = $value["1m³"];

            $consulta_pais = "SELECT `en` FROM wp_paises WHERE iso = '$rate_country'";
            $resultado_pais = $conexion->query($consulta_pais);
            
            if ($resultado_pais && $resultado_pais->num_rows > 0) {
                $value_pais = $resultado_pais->fetch_assoc();
                $countrys = $value_pais["en"];

                
                $precio_m3 = ($precio_m3 !== null && $precio_m3 !== '') ? $precio_m3 : 'No price available';

                $salida .= "
                    <option style='color: #000 !important;' value='$countrys' price='$precio_m3'>$countrys - $precio_m3 1m³</option>
                ";
            } else {
                $salida .= "<option style='color: #000 !important;' disabled>No data available</option>";
            }
        }
    } else {
        $salida .= "<option style='color: #000 !important;' disabled>No data available</option>";
    }
    
    echo $salida;
?>
