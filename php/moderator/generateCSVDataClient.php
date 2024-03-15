<?php
	require __DIR__ . '/../conexion.php';

	require __DIR__ . '/../../PHPExcel/Classes/PHPExcel.php';

	if (isset($_GET['code'])){	
		$code = $_GET['code'];
	}else{
		$code = '';
	}
	$nCotizacion = 'QUO'.$code;

	$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id = '$code'";
	$resultado = $conexion->query($consulta);
	$row = mysqli_fetch_array($resultado);
	$email = $row['cotizacion_id_user'];

	$consulta2 = "SELECT * FROM wp_account WHERE account_correo = '$email'";
	$resultado2 = $conexion->query($consulta2);
	$row2 = mysqli_fetch_array($resultado2);
	$nombre = $row2['account_nombre'];
	$apellido = $row2['account_apellido'];
	$countryIso = $row2['account_pais'];
	$consulta3 = "SELECT * FROM wp_paises WHERE iso = '$countryIso'";
	$result = $conexion->query($consulta3);
	$row3 = mysqli_fetch_array($result);
	$pais = $row3['es'];
	$teléfono = $row2['account_telefono'];
	

	$datos[] = array(
		$email,
		$nombre,
		$apellido,
		$pais,
		$teléfono,
		$nCotizacion
	);

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
	$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Quote Number');

	$fila = 2;
	foreach ($datos as $dato) {
		$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$fila, $dato[0])
					->setCellValue('B'.$fila, $dato[1])
					->setCellValue('C'.$fila, $dato[2])
					->setCellValue('D'.$fila, $dato[3])
					->setCellValue('E'.$fila, $dato[4])
					->setCellValue('F'.$fila, $dato[5]);
		$fila++;
	}

	// Save the worksheet as a CSV file
	$objWriter = PHPExcel_IOFactory::createWriter
	($objPHPExcel, 'CSV');
	// Forzar la descarga del archivo CSV
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename="cliente-'.$email.'.csv"');
	header('Cache-Control: no-cache, no-store, must-revalidate');
	header('Pragma: no-cache');
	header('Expires: 0');
	$objWriter->save('php://output');