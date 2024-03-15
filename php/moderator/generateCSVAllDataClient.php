<?php
	require __DIR__ . '../../db/conexion.php';

	require __DIR__ . '/../../PHPExcel/Classes/PHPExcel.php';
	require __DIR__ . '/../../vendor/autoload.php';

	if (isset($_GET['typeClient'])){
		$typeClient = $_GET['typeClient'];
	}else{
		$typeClient = '';
	}

	if (isset($_GET['dayShifts'])){
		$dayShifts = $_GET['dayShifts'];
	}else{
		$dayShifts = '';
	}

	if (isset($_GET['currentDate'])){
		$currentDate = $_GET['currentDate'];
	}else{
		$currentDate = '';
	}

	if (isset($_GET['dateFrom'])){
		$dateFrom = $_GET['dateFrom'];
	}else{
		$dateFrom = '';
	}

	if (isset($_GET['dateTo'])){
		$dateTo = $_GET['dateTo'];
	}else{
		$dateTo = '';
	}

	if (isset($_GET['typeClient2'])){
		$typeClient2 = $_GET['typeClient2'];
	}else{
		$typeClient2 = '';
	}

	$consulta = "SELECT * FROM wp_account";
	$resultado = $conexion->query($consulta);
	
	if ($resultado->num_rows > 0) {
		while ($row = $resultado->fetch_assoc()) {			
			$email = $row['account_correo'];
			$rol = $row['account_rol_aid'];
			$name = $row['account_nombre'];
			$lastname = $row['account_apellido'];
			$phone = $row['account_telefono'];
			$country = $row['account_pais'];
			$date = $row['account_created_at'];

			if ($rol == 1 || $rol == 2){
				$consulta2 = "SELECT * FROM wp_clients_crm WHERE email_clients_crm = '$email'"; 
				$resultado2 = $conexion->query($consulta2);
				$count2 = mysqli_num_rows($resultado2);
				$row2 = mysqli_fetch_array($resultado2);
				$statusCRM = $row2['status_clients_crm'];
				if ($count2 > 0){					
					$consulta3 = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
					$resultado3 = $conexion->query($consulta3);
					$count3 = mysqli_num_rows($resultado3);
					if ($count3 > 0){							
						while ($col = $resultado3->fetch_assoc()){						
							$statusQUO = $col['cotizacion_status'];
							$numberQUO = $col['cotizacion_id'];
							$consulta4 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$numberQUO' AND cotizacion_detalle_maker = 'Kalstein'";
							$resultado4 = $conexion->query($consulta4);
							$count4 = mysqli_num_rows($resultado4);
							if ($count4 > 0){
								if ($statusCRM == 'R2'){
									$update = "UPDATE wp_clients_crm SET status_clients_crm = 'R3A' WHERE email_clients_crm = '$email'";
									$conexion->query($update);
								}
							}
						}			
					}
				}else{
					$consulta3 = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
					$resultado3 = $conexion->query($consulta3);
					$count3 = mysqli_num_rows($resultado3);				
					$statusQUO = $col['cotizacion_status'];
					if ($count3 > 0){							
						while ($col = $resultado3->fetch_assoc()){						
							$statusQUO = $col['cotizacion_status'];
							$numberQUO = $col['cotizacion_id'];
							$consulta4 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$numberQUO' AND cotizacion_detalle_maker = 'Kalstein'";
							$resultado4 = $conexion->query($consulta4);
							$count4 = mysqli_num_rows($resultado4);
							if ($count4 > 0){
								$consulta5 = "SELECT * FROM wp_clients_crm WHERE email_clients_crm = '$email'"; 
								$resultado5 = $conexion->query($consulta5);
								$count5 = mysqli_num_rows($resultado5);
								if ($count5 > 0){

								}else{
									if ($statusQUO == 0){
										$insert = "INSERT INTO wp_clients_crm(aid_clients_crm, name_clients_crm, lastname_clients_crm, email_clients_crm, phone_clients_crm, country_clients_crm, profile_clients_crm, status_clients_crm, date_clients_crm) VALUES ('','$name','$lastname','$email','$phone','$country','$rol','R3A', '$date')";
										$conexion->query($insert);
									}
								}
							}
						}			
					}else{
						$insert = "INSERT INTO wp_clients_crm(aid_clients_crm, name_clients_crm, lastname_clients_crm, email_clients_crm, phone_clients_crm, country_clients_crm, profile_clients_crm, status_clients_crm, date_clients_crm) VALUES ('','$name','$lastname','$email','$phone','$country','$rol','R2', '$date')";
						$conexion->query($insert);
					}					
				}
			}
		}
	}

	$query = "SELECT * FROM wp_clients_crm";
	$result = $conexion->query($query);
	$datos = [];

	if ($result->num_rows > 0){
		while($value = $result->fetch_assoc()){
			$name = $value['name_clients_crm'];
			$lastname = $value['lastname_clients_crm'];
			$email = $value['email_clients_crm'];
			$phone = $value['phone_clients_crm'];
			$country = $value['country_clients_crm'];
			$profile = $value['profile_clients_crm'];
			$status = $value['status_clients_crm'];
			$date = $value['date_clients_crm'];

			if ($profile == 1){
				$profile = 'Client';
			}else{
				$profile = 'Distribuitor';
			}

			if ($dayShifts != '' && $typeClient != ''){
				switch($typeClient){
					case 1:
						switch($dayShifts){
							case  1:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 2:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 11:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 3:
								$openingEveryDate = $currentDate.' 12:00:00';
								$endingEveryDate = $currentDate.' 17:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 4:
								$openingEveryDate = $currentDate.' 18:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
						}
						break;
					case 2:
						switch($dayShifts){
							case 1:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R1'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 2:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 11:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R1'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 3:
								$openingEveryDate = $currentDate.' 12:00:00';
								$endingEveryDate = $currentDate.' 17:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R1'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 4:
								$openingEveryDate = $currentDate.' 18:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R1'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
						}
						break;
					case 3:
						switch($dayShifts){
							case 1:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R2'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 2:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 11:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R2'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 3:
								$openingEveryDate = $currentDate.' 12:00:00';
								$endingEveryDate = $currentDate.' 17:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R2'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 4:
								$openingEveryDate = $currentDate.' 18:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R2'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
						}
						break;
					case 4:
						switch($dayShifts){
							case 1:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R3'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 2:
								$openingEveryDate = $currentDate.' 00:00:00';
								$endingEveryDate = $currentDate.' 11:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R3'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 3:
								$openingEveryDate = $currentDate.' 12:00:00';
								$endingEveryDate = $currentDate.' 17:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R3'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
							case 4:
								$openingEveryDate = $currentDate.' 18:00:00';
								$endingEveryDate = $currentDate.' 23:59:59';
								if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R3'){
									$data = array(
										$email,
										$name,
										$lastname,
										$country,
										$phone,
										$profile,
										$status,
										$date, 
										'es', 
										'kalstein.cl'
									);
						
									array_push($datos, $data);
								}
								break;
						}
						break;
				}
			}

			if ($typeClient2 != '' && $dateFrom != '' && $dateTo != ''){
				switch($typeClient2){
					case 1:
						$openingEveryDate = $dateFrom.' 00:00:00';
						$endingEveryDate = $dateTo.' 23:59:59';
						if ($date >= $openingEveryDate && $date <= $endingEveryDate){
							$data = array(
								$email,
								$name,
								$lastname,
								$country,
								$phone,
								$profile,
								$status,
								$date, 
								'es', 
								'kalstein.cl'
							);
				
							array_push($datos, $data);
						}
						break;
					case 2:
						$openingEveryDate = $dateFrom.' 00:00:00';
						$endingEveryDate = $dateTo.' 23:59:59';
						if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R1'){
							$data = array(
								$email,
								$name,
								$lastname,
								$country,
								$phone,
								$profile,
								$status,
								$date, 
								'es', 
								'kalstein.cl'
							);
				
							array_push($datos, $data);
						}
						break;
					case 3:
						$openingEveryDate = $dateFrom.' 00:00:00';
						$endingEveryDate = $dateTo.' 23:59:59';
						if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R2'){
							$data = array(
								$email,
								$name,
								$lastname,
								$country,
								$phone,
								$profile,
								$status,
								$date, 
								'es', 
								'kalstein.cl'
							);
				
							array_push($datos, $data);
						}
						break;
					case 4:
						$openingEveryDate = $dateFrom.' 00:00:00';
						$endingEveryDate = $dateTo.' 23:59:59';
						if ($date >= $openingEveryDate && $date <= $endingEveryDate && $status == 'R3'){
							$data = array(
								$email,
								$name,
								$lastname,
								$country,
								$phone,
								$profile,
								$status,
								$date, 
								'es', 
								'kalstein.cl'
							);				
							array_push($datos, $data);
						}
						break;
				}
			}
		}
	}

	// function insertDataIntoCsv($sheetId, $sheetName, $data) {
	// 	// Crear un nuevo cliente de Google Sheets API
	// 	$client = new Google_Client();
	// 	$client->setApplicationName('Google Sheets API PHP Quickstart');
	// 	$client->setScopes(Google_Service_Sheets::SPREADSHEETS);
	// 	$client->setAuthConfig(__DIR__.'/../../credentials.json');
	// 	$client->setAccessType('offline');
	// 	$client->setPrompt('select_account consent');
	
	// 	// Obtenemos el servicio de Google Sheets API
	// 	$service = new Google_Service_Sheets($client);
	
	// 	// Enviar la solicitud para agregar los datos al archivo CSV
	// 	$body = new Google_Service_Sheets_ValueRange([
	// 		'values' => $data
	// 	]);
	// 	$result = $service->spreadsheets_values->append($sheetId, $sheetName, $body, [
	// 		'valueInputOption' => 'RAW'
	// 	]);
	
	// 	// Devolver el resultado
	// 	return $result;
	// }

	// $sheetId = '1jRMFwWkqJ5X908HBNO-n-KHqjQRaNWM_vd8Kj6Dy0Ks';
	// $sheetName = 'Contactos CRM';
	// $fila = 2;
	// foreach ($datos as $dato) {
	// 	$newData = [
	// 		[$dato[0], $dato[1], $dato[2], $dato[3], $dato[4], $dato[5], $dato[6]]
	// 	];
	// 	insertDataIntoCsv($sheetId, $sheetName, $newData);
	// 	$fila++;
	// }

	function insertDataIntoCsv($sheetId, $sheetName, $dataRows) {
		// Configurar la autenticación con la cuenta de servicio
		$client = new Google_Client();
		$client->setApplicationName('Google Sheets API PHP Integration');
		$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
		
		// Asumiendo que la clave privada está en el mismo directorio que este script, ajusta la ruta si es necesario
		$client->setAuthConfig(__DIR__ . '/../../credentials.json');
	
		// Crear una nueva instancia del servicio de Google Sheets
		$service = new Google_Service_Sheets($client);
	
		// Definir el rango en el cual se añadirán los datos
		$range = $sheetName;
		$body = new Google_Service_Sheets_ValueRange([
			'values' => $dataRows // Asegúrate de que esto sea una lista de listas
		]);
		$params = [
			'valueInputOption' => 'RAW'
		];
	
		// Llamar al método `append` del servicio para añadir los datos en el rango definido
		$result = $service->spreadsheets_values->append($sheetId, $range, $body, $params);
	
		// Devolver el resultado
		return $result;
	}
	
	// Ejemplo de uso:
	$sheetId = '1jRMFwWkqJ5X908HBNO-n-KHqjQRaNWM_vd8Kj6Dy0Ks'; // Reemplaza con el ID real de tu hoja de cálculo
	$sheetName = 'contactos-crm'; // Reemplaza con el nombre real de tu hoja
	$dataRows = []; // Inicializa el arreglo de filas
	
	foreach ($datos as $dato) {
		// Asegúrate de que cada fila de datos sea una sublista
		$dataRows[] = [$dato[0], $dato[1], $dato[2], $dato[3], $dato[4], $dato[5], $dato[6], $dato[7]];
	}
	
	try {
		$result = insertDataIntoCsv($sheetId, $sheetName, $dataRows);
		echo "Datos insertados correctamente";
	} catch (Exception $e) {
		echo 'Error al insertar datos: ',  $e->getMessage(), "\n";
	}
	
	// Create a new PHPExcel object
	$objPHPExcel = new PHPExcel();

	// Set the active worksheet
	$objPHPExcel->setActiveSheetIndex(0);

	// Set the column titles
	$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Email');
	$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Name');
	$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Lastname');
	$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Country');
	$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Phone');
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Profile');
	$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Status');

	$fila = 2;
	foreach ($datos as $dato) {
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$fila, $dato[0])
					->setCellValue('B'.$fila, $dato[1])
					->setCellValue('C'.$fila, $dato[2])
					->setCellValue('D'.$fila, $dato[3])
					->setCellValue('E'.$fila, $dato[4])
					->setCellValue('F'.$fila, $dato[5])
					->setCellValue('G'.$fila, $dato[6]);
		$fila++;
	}

	// Save the worksheet as a CSV file
	$objWriter = PHPExcel_IOFactory::createWriter
	($objPHPExcel, 'CSV');
	// Forzar la descarga del archivo CSV
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename="clientes-CRM.csv"');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');
	$objWriter->save('php://output');