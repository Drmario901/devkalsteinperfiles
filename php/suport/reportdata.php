<?php
    require __DIR__ . '../../db/conexion.php';

    $t = $_POST["consulta"];
    $consulta = "SELECT * FROM wp_reportes WHERE R_id = '$t'";
    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $count = mysqli_num_rows($resultado);

    if ($count > 0){
$id = $row['R_id'];
        $nombre = $row["R_nombre"];
        $usuario = $row["R_usuario"];
        $Tipo_US= $row["R_Tipo_US"];
        $producto= $row["R_product"];
        $category= $row["R_category"];
        $description = $row["R_Description"];
        $estado = $row["R_estado"];
        $nivel = $row["R_Nivel"];
        $agente= $row["R_agente_soporte"];
        $id_servicio= $row["R_id_servicio"];
        $company= $row["R_company"];
        $company_soporte=$row["R_company_soporte"];
        $correo=$row["R_usuario_agente"];
    }else{
        $nombre = "No se encontraron resultados.";
        $usuario = "No se encontraron resultados.";
        $Tipo_US="No se encuentraron resultados";
        $category= "No se encontraron resultados.";
        $producto="no se encontraron resultados";
        $description = "No se encontraron resultados.";
        $estado = "No se encontraron resultados.";
        $nivel = "No se encontraron resultados.";
$agente = "no se encontraron resultado.";
$id_servicio ="no se encontro ningun resultado";
$company = "no se encontraron resultado.";
$company_soporte ="no se encontro ningun resultado";
$correo ="no se encontro ningun resultado";;
    }
    $datos = array(
        'id' => $id,
        'name' => $nombre,
        'usuario' => $usuario,
        'Tipo_US' => $Tipo_US,
        'producto'=>$producto,
        'category'=> $category,
        'description' => $description,
        'estado' => $estado,
        'nivel' => $nivel,
        'agente'=> $agente,
        'id_servicio' => $id_servicio,
        'company' => $company,
        'company_support' => $company_soporte,
        'correo'=> $correo
    ); 

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();