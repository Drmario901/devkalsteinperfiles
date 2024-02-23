<?php

    session_start();
    $email = $_SESSION['emailAccount'];

    require 'conexion.php';

    $id = $_POST['actualizar_id'];

    $service = $_POST['service'];
    $company= $_POST['service_company'];
    $agente = $_POST['service_agente'];
    $telefono = $_POST['service_telefono'];
    $correo = $_POST['service_correo'];

    $pais = $_POST['service_pais'];
    $direccion = $_POST['service_direccion'];
    $estadolugar = $_POST['service_estadolugar'];
    $ciudad = $_POST['service_ciudad'];
    $provincia = $_POST['service_provincia'];

    $category = $_POST['service_category'];
    $estado = $_POST['service_estado'];
    $tiempo = $_POST['service_tiempo'];
    $description = $_POST['service_description'];

    /* $query = "UPDATE wp_servicios SET 
        SE_servicio =       '$service',
        SE_agente_soporte = '$agente',
        SE_correo =         '$correo',
        SE_description =    '$description',
        SE_estado =         '$estado',
        SE_category =       '$category',
        SE_direccion =      '$direccion',
        SE_company =        '$company',
        SE_pais =           '$pais',
        SE_ciudad =         '$ciudad',
        SE_telefono =       '$telefono',
        SE_estadolugar =    '$estadolugar',
        SE_provincia =      '$provincia',
        SE_tiempo =         '$tiempo'
        WHERE SE_id =       '$id'";

    if ($conexion->query($query) === TRUE) {
        $datos['status'] = 'correcto';
    } else {
        $datos['status'] = 'incorrecto';
    }

    echo $query; */
 

 $query = "UPDATE wp_servicios SET SE_servicio='$service', SE_category='$category', SE_company='$company', SE_pais='$pais', SE_ciudad='$ciudad', SE_direccion='$direccion', SE_agente_soporte='$agente', SE_correo='$correo', SE_description='$description', SE_estado='$estado', SE_telefono='$telefono', SE_estadolugar='$estadolugar', SE_provincia='$provincia', SE_tiempo='$tiempo' WHERE SE_id = '$id'";
 /* $res = $conexion->query($query); */

 if($conexion->query($query) === TRUE){
    $datos['status'] = 'Correcto';
 }
 else{
    $datos['status'] = 'incorrecto';
 }


 /* $datos = array(
    "id" => $id,
    "service" => $service,
    "company" => $company
 ); */

    header("Content-Type: application/json");
    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();

?>
