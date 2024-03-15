<?php
    require __DIR__ . '../../db/conexion.php';

    $t = $_POST["consulta"];
    
    $consulta = "SELECT * FROM wp_servicios WHERE SE_id = '$t'";
    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $count = mysqli_num_rows($resultado);

    if ($count > 0){
        $id = $row["SE_id"];
        $nombre = $row["SE_servicio"];
        $category = $row["SE_category"];
        $usuario = $row["SE_agente_soporte"];
        $correo = $row["SE_correo"];
        $description = $row["SE_description"];
        $estado = $row["SE_estado"];
        $company = $row["SE_company"];
        $pais = $row["SE_pais"];
        $ciudad = $row["SE_ciudad"];
        $direccion = $row["SE_direccion"];
        $telefono = $row['SE_telefono'];
        $estadolugar = $row['SE_estadolugar'];
        $provincia = $row['SE_provincia'];
        $tiempo = $row['SE_tiempo'];
    }
    else{
        $id = "";
        $nombre = "";
        $usuario = "";
        $category = "";
        $correo = "";
        $description = "";
        $estado = "";
        $company = "";
        $pais = "";
        $ciudad = "";
        $direccion = "";
        $telefono = "";
        $estadolugar = "";
        $provincia = "";
        $tiempo = "";
    }
    $datos = array(
        'id' => $id,
        'name' => $nombre,
        'category' => $category,
        'usuario' => $usuario,
        'correo' => $correo,
        'description'=> $description,
        'estado' => $estado,
        'company' => $company,
        'ciudad' => $ciudad,
        'pais' => $pais,
        'direccion' => $direccion,
        'telefono' => $telefono,
        'estadolugar' => $estadolugar,
        'provincia' => $provincia,
        'tiempo' => $tiempo
    ); 

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();