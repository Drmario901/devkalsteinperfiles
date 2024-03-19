<?php 
    require_once __DIR__ . '/../../db/conexion.php';

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
    $company=$_POST['Registrar_company'];
    $company_soporte=$_POST['Registrar_company_soporte'];
    $row = $conexion->query("SELECT wp_account.account_nombre, wp_account.account_apellido,wp_account.account_pais, wp_account.account_url_image_perfil,wp_account.account_correo, wp_company.company_nombre,wp_company.company_pais,wp_company.company_ciudad, wp_company.company_direccion FROM wp_account INNER JOIN wp_company on wp_account.account_correo = wp_company.company_account_correo WHERE account_correo = '$usuario'" )->fetch_assoc();
        
        $acc_name = $row['account_nombre'];
        $acc_lname = $row['account_apellido'];
        $acc_correo = $row['account_correo'];
        $acc_company= $row['company_nombre'];
        $acc_pais=$row['account_pais'];

    $query = "INSERT INTO wp_cotizacion(cotizacion_id, cotizacion_id_user, cotizacion_sres, cotizacion_atencion, cotizacion_create_at, cotizacion_status, cotizacion_id_remitente, cotizacion_sres_remitente,cotizacion_destino) value('','$usuario','$acc_company','$Name',CURRENT_TIMESTAMP,'$estado','$correo','$soporte','$acc_pais')";

    echo $query;
    if ($conexion->query($query) === TRUE) {
        $consulta = "SELECT * FROM wp_cotizacion ORDER BY cotizacion_id DESC";
        $result = $conexion->query($consulta);
        $col = mysqli_fetch_array($result);
        $id = $col['cotizacion_id'];
        $query2 = "INSERT INTO wp_reportes (R_id_servicio,R_id_cotizacion, R_nombre, R_usuario,R_Tipo_US, R_category, R_product, R_Description, R_estado, R_Nivel, R_agente_soporte, R_usuario_agente,R_observacion,R_company,R_company_soporte) VALUES ('$id_servicio','$id', '$Name', '$usuario','$TIPO_US', '$categoria','$producto','$Description','$estado', '$nivel','$soporte','$correo','','$company','$company_soporte')";
        
        echo $query2;
        if ($conexion->query($query2) === TRUE) {  
        $datos['status'] = 'correcto';
    } else {
        $datos['status'] = 'incorrecto';}
    }else{
        $datos['status'] = 'incorrecto';
    }

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();
?>