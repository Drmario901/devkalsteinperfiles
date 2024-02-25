<?php 
     
	require __DIR__ . '/../conexion.php';

	session_start();

	$acc_id = $_SESSION['emailAccount'];

	$salida = "<option value='0' style='color: #000 !important'>Select the report you want to edit.</option>";

	$consulta = "SELECT * FROM wp_reportes where R_usuario_agente='$acc_id'";		
	$resultado = $conexion->query($consulta);

    while ($rows = $resultado->fetch_assoc()){
      	$datos = $rows['R_id'];
        $salida.= "<option value='$datos' style='color: #000 !important'>$datos</option>";
    } 

	echo $salida;
	$conexion->close();

?>