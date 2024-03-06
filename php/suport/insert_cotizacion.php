<?php 


require __DIR__ . '/../conexion.php';



$id_servicio=$_POST['Registrar_id_servicio'];
$Name = $_POST['Registrar_name'];
$Description = $_POST['Registrar_description'];
$usuario = $_POST['Registrar_usuario'];
$TIPO_US = $_POST['Registrar_Tipo_US'];
$nivel = $_POST['Registrar_nivel'];
$categoria = $_POST['Registrar_category'];
$producto = $_POST['Registrar_producto'];
$estado="pending";
$soporte=$_POST['Registrar_agente'];
$correo=$_POST['Registrar_correo'];
$price=$_POST['Registrar_price'];
$moneda=$_POST['Registrar_moneda'];
$metodo=$_POST['Registrar_metodo'];
$row = $conexion->query("SELECT * FROM wp_servicios WHERE SE_id = '$id_servicio'")->fetch_assoc();

$servicio=$row['SE_nombre'];
$company=$row['SE_company'];
$description=$row['SE_description'];



$query = "INSERT INTO `wp_cotizacion`(`cotizacion_id`, `cotizacion_id_user`, `cotizacion_sres`, `cotizacion_atencion`, `cotizacion_create_at`, `cotizacion_zipcode`, `cotizacion_divisa`, `cotizacion_metodo_pago`, `cotizacion_submit`, `cotizacion_iva`, `cotizacion_subtotal`, `cotizacion_total`, `cotizacion_status`, `cotizacion_id_remitente`, `cotizacion_sres_remitente`) value('')";

if ($conexion->query($query) === TRUE) {
    $datos['status'] = 'correcto';
} else {
    $datos['status'] = 'incorrecto';
}

echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();