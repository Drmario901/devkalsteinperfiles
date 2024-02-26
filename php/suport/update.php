<?php 
require __DIR__ . '/../conexion.php';
$id = $_POST['Actualizar_id'];
$observacion=$_POST['observacion'];
$precio=$_POST['price'];
$moneda=$_POST['moneda'];
echo "SELECT * FROM wp_reportes where R_id = '$id'";
$row = $conexion->query("SELECT * FROM wp_reportes where R_id = '$id'" )->fetch_assoc();

$id_cotizacion=$row['R_id_cotizacion'];
$query = "UPDATE wp_reportes SET R_estado='process'  ,R_observacion='$observacion' WHERE R_id='$id';";
$query2="UPDATE wp_cotizacion SET cotizacion_divisa='$moneda',cotizacion_submit='$precio', cotizacion_total='$precio' WHERE cotizacion_id='$id_cotizacion';";
echo $query;
echo $query2;
if ($conexion->query($query) === TRUE) {

    if ($conexion->query($query2) === TRUE) {
    $datos['status'] = 'correcto';
} else {
    $datos['status'] = 'incorrecto';
}}else{
    $datos['status'] = 'incorrecto';

}
echo $query;
echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();

