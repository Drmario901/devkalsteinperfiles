<?php 
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");

	require __DIR__ . '/conexion.php';

	$salida = "<option selected style='text-align: center;' value='0'>-- Seleccionar --</option>";
	
	$consulta2 = "SELECT * FROM wp_eu_country ORDER BY eu_country_iso ASC";
	
	
	$resultado = $conexion->query($consulta2);
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            $iso = $value["eu_country_iso"];

			$consulta = "SELECT * FROM wp_paises WHERE iso = '$iso'";		
			$rs = $conexion->query($consulta);
			$row = mysqli_fetch_array($rs);
			$nombre = $row['es'];

			$salida.="
          <option value='$iso'>$iso - $nombre</option>
      ";
		}
	
		$salida.="</tbody></table>";
	} else {
		$salida.="<div class='nodatos'><h5>No data found in your search</h5></div>";
	}
	
	echo $salida;
	$conexion->close();
 ?>
