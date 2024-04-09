<?php 
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
	require __DIR__ . '/conexion.php';

	$salida = "";

    $emailUser = $_POST['email'];

	$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$emailUser'";
		
	$resultado = $conexion->query($consulta);
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            $numero = $value["cotizacion_id"];
            $domain = $value["cotizacion_domain"];
            $client = $value["cotizacion_sres"];  
            $created = $value["cotizacion_create_at"]; 
            $envio = $value["cotizacion_envio"];
            $total = $value["cotizacion_total"];
            $status = $value["cotizacion_status"];
            $fecha = new DateTime($created);
            $onlyDate = date_format($fecha, 'd/m/y');  
            $onlyHours = date_format($fecha, 'h:i s A'); 

            if ($envio == 0) {
                $metodo = 'Withdrawal at factory';
            }else{
                $metodo = 'Shipment to destination';
            }

            if ($status == 'Pending'){
                $bgStatus = '#e38512';
                $colorStatus = '#fff';
            }else{
                $bgStatus = '#0eab13';
                $colorStatus = '#000';
            }
            
                $salida.="
                    <tr style='height: 2rem !important;'>
                        <td class='fw-bold' style='margin: 0 auto; height: 2rem;'>
                            <div class='form-check'>
                                <input class='form-check-input' type='checkbox' value='$numero' id='flexCheckDefault'>
                            </div>
                        </td>
                        <td style='text-align: center; font-weight: bold;'>QUO$numero</td>
                        <td style='text-align: center;'>$onlyDate $onlyHours</td>
                        <td style='text-align: center;'>$domain</td>
                        <td style='text-align: center;'>$metodo</td>
                        <td style='text-align: center;'>$total</td>
                        <td style='text-align: center; background-color: $bgStatus; color: $colorStatus'>$status</td>
                    </tr>
                ";
		}
	
		$salida.="</tbody></table>";
	} else {
		$salida.="<div class='nodatos'><h5>No data found in your search</h5></div>";
	}
	
	echo $salida;
	$conexion->close();
 ?>
