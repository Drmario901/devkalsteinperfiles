<?php
require __DIR__ . '/../conexion.php';

include 'translateText.php';
translateText();

$salida="<option selected value='0' data-i17n='client:eligeOpcion' >Choose an option</option>";
$t = $_POST["categoryProduct"];
$consulta = "SELECT * FROM wp_k_products WHERE product_category = '$t'";
$resultado = $conexion->query($consulta);
$count = mysqli_num_rows($resultado);
echo $consulta;
if ($count > 0){
    while ($rows = $resultado->fetch_assoc()){
    	$name = $rows['product_name_en'];
        $salida.= "<option style='color: #000 !important;' value='$name' >$name</option>";
    }
} else {
    $salida.= "<option value='0' data-i17n='client:dataNotFound' >No hay datos</option>";
}

echo $salida;
$conexion->close();
