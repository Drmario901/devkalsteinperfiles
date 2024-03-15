<?php
    session_start();

    require __DIR__ .'/../conexion.php';

    $idQuote = $_POST['cotizacion_id'];
    $status = $_POST['cotizacion_status'];

    $updateData = "UPDATE wp_cotizacion SET cotizacion_status = '$status' WHERE cotizacion_id = '$idQuote'";

    if ($conexion->query($updateData) === TRUE){
        $update = 'correcto';
    }else{
        $update = 'incorrecto';
    }

    if ($update == 'correcto'){
        $mod = $_SESSION['privateEmailAccount'];
        $type = $status == '3' ? 'q_aproved' : $type;
        $type = $status == '4' ? 'q_denied' : $type;
        $receptor = $conexion->query("SELECT cotizacion_id_user FROM wp_cotizacion WHERE cotizacion_id = '$idQuote'")->fetch_array()[0];

        if ( ($buis = $conexion->query("SELECT company_nombre FROM wp_company WHERE company_account_correo = '$receptor'"))->num_rows > 0 ){
            $texto_buis = '<br>'.$buis->fetch_array[0];
        }
        else if ( ($buis = $conexion->query("SELECT account_nombre, account_apellido FROM wp_company WHERE company_account_correo = '$receptor'"))->num_rows > 0 ){
            $texto_buis = '<br>'.$buis->fetch_array()[0].' '.$buis->fetch_array()[1];
        }
        else {
            $texto_buis = '';
        }

        $conexion->query("INSERT INTO wp_mod_log (moder, receptor, type, meta) VALUES ('$mod', '$receptor$texto_buis', '$type', '$idQuote')");
    }

    $data = array(
        'update' => $update,
        'status' => $status == '3'
    );

    echo json_encode($data);
?>
