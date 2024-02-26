<?php
	require __DIR__ . '/../conexion.php';

	require __DIR__ . '/../../PHPExcel/Classes/PHPExcel.php';

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
								if ($statusCRM == 'R1' && $statusQUO == 0){
									$update = "UPDATE wp_clients_crm SET status_clients_crm = 'R2' WHERE email_clients_crm = '$email'";
									$conexion->query($update);
								}else{
									if ($statusCRM == 'R2' && $statusQUO == 1 || $statusCRM == 'R2' && $statusQUO == 3){
										$update = "UPDATE wp_clients_crm SET status_clients_crm = 'R3' WHERE email_clients_crm = '$email'";
										$conexion->query($update);
									}
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
										$insert = "INSERT INTO wp_clients_crm(aid_clients_crm, name_clients_crm, lastname_clients_crm, email_clients_crm, phone_clients_crm, country_clients_crm, profile_clients_crm, status_clients_crm, date_clients_crm) VALUES ('','$name','$lastname','$email','$phone','$country','$rol','R2', '$date')";
										$conexion->query($insert);
									}else{
										if ($statusQUO == 1 || $statusQUO == 3){
											$insert = "INSERT INTO wp_clients_crm(aid_clients_crm, name_clients_crm, lastname_clients_crm, email_clients_crm, phone_clients_crm, country_clients_crm, profile_clients_crm, status_clients_crm, date_clients_crm) VALUES ('','$name','$lastname','$email','$phone','$country','$rol','R3', '$date')";
											$conexion->query($insert);
										}
									}
								}
							}
						}			
					}else{
						$insert = "INSERT INTO wp_clients_crm(aid_clients_crm, name_clients_crm, lastname_clients_crm, email_clients_crm, phone_clients_crm, country_clients_crm, profile_clients_crm, status_clients_crm, date_clients_crm) VALUES ('','$name','$lastname','$email','$phone','$country','$rol','R1', '$date')";
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
										$status
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
								$status
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
								$status
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
								$status
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
								$status
							);				
							array_push($datos, $data);
						}
						break;
				}
			}
		}
	}

	// function getGoogleSheetData($apiKey, $spreadsheetId, $range) {
	// 	$url = "https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$range}?key={$apiKey}";
	// 	$ch = curl_init();
	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	// 	$output = curl_exec($ch);
	// 	curl_close($ch);
	// 	return json_decode($output, true);
	// }

	// function sendGoogleSheetData($apiKey, $spreadsheetId, $range, $values) {
	// 	$url = "https://sheets.googleapis.com/v4/spreadsheets/{$spreadsheetId}/values/{$range}:append?valueInputOption=RAW&insertDataOption=INSERT_ROWS&key={$apiKey}";
	// 	$data = [
	// 		'values' => $values
	// 	];
	// 	$options = [
	// 		'http' => [
	// 			'method' => 'POST',
	// 			'header' => "Content-Type: application/json\r\n",
	// 			'content' => json_encode($data)
	// 		]
	// 	];
	// 	$context = stream_context_create($options);
	// 	$result = file_get_contents($url, false, $context);
	// 	return json_decode($result, true);
	// }

	// $apiKey = 'your_api_key';
	// $spreadsheetId = 'your_spreadsheet_id';
	// $range = 'Sheet1!A1:B10';

	// // Obtener datos de la hoja de cálculo
	// $data = getGoogleSheetData($apiKey, $spreadsheetId, $range);

	// // Enviar datos a la hoja de cálculo
	// $newData = [
	// 	['Hello', 'World'],
	// 	['Another', 'Row']
	// ];
	// $result = sendGoogleSheetData($apiKey, $spreadsheetId, $range, $newData);

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