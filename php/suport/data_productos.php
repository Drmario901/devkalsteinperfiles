<?php
require __DIR__ . '/../conexion.php';

$salida="<option selected value='0'>Choose an option</option>";
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
    $salida.= "<option value='0'>No hay datos</option>";
}

echo $salida;
$conexion->close();
