<?php 
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");

	require __DIR__ . '/conexion.php';

	$envioM = $_POST['consulta'];

	if ($envioM == 'Aerial'){
		$consulta2 = "SELECT * FROM wp_rates_air ORDER BY rate_country ASC";
	}else{
		if ($envioM == 'Maritime'){
			$consulta2 = "SELECT * FROM wp_rates_maritime ORDER BY rate_country ASC";
		}
	}

	$salida = "<option selected style='text-align: center;' value='0'>-- Seleccionar --</option>";	
	
	$resultado = $conexion->query($consulta2);
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            $iso = $value["rate_country"];
			$consultaEU = "SELECT * FROM wp_eu_country WHERE eu_country_iso = '$iso'";
			$resultEU = $conexion->query($consultaEU);
			$countEU = mysqli_num_rows($resultEU);

			if ($countEU > 0){
				$salida.="";
			}else{
				$consulta = "SELECT * FROM wp_paises WHERE iso = '$iso'";		
				$rs = $conexion->query($consulta);
				$row = mysqli_fetch_array($rs);
				$nombre = $row['es'];

				$salida.="
					<option value='$iso'>$iso - $nombre</option>
				";
			}
		}
	
		$salida.="</tbody></table>";
	} else {
		$salida.="<div class='nodatos'><h5>No data found in your search</h5></div>";
	}
	
	echo $salida;
	$conexion->close();
 ?>
