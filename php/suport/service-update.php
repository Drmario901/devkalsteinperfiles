<?php
    session_start();
    $email = $_SESSION['emailAccount'];

    require_once __DIR__ . '/../../db/conexion.php';

    $id = $_POST['actualizar_id'];
    $service = $_POST['SE_servicio'];
    $company= $_POST['SE_company'];
    $agente = $_POST['SE_agente'];
    $telefono = $_POST['SE_telefono'];
    $correo = $_POST['SE_correo'];
    $pais = $_POST['SE_pais'];
    $direccion = $_POST['SE_direccion'];
    $estadolugar = $_POST['SE_estadolugar'];
    $ciudad = $_POST['SE_ciudad'];
    $provincia = $_POST['SE_provincia'];
    $category = $_POST['SE_category'];
    $description = $_POST['SE_descripcion'];
    $tiempo = $_POST['SE_tiempo'];
    $estado = $_POST['SE_estado'];
    $datos = array(); 

    $query = "UPDATE wp_servicios SET SE_servicio='$service', SE_category='$category', SE_company='$company', SE_pais='$pais', SE_ciudad='$ciudad', SE_direccion='$direccion', SE_agente_soporte='$agente', SE_correo='$correo', SE_description='$description', SE_estado='$estado', SE_telefono='$telefono', SE_estadolugar='$estadolugar', SE_provincia='$provincia', SE_tiempo='$tiempo' WHERE SE_id = '$id'";
    /* $res = $conexion->query($query); */

    if($conexion->query($query) === TRUE){
        $datos['status'] = 'Correcto';
    }
    else{
        $datos['status'] = 'incorrecto';
    }

    echo json_encode($datos);
    $conexion->close();

?>