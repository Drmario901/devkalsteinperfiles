<?php 

	require __DIR__ . '/conexion.php';

	$salida = "";
	$mEnvio = $_POST['mEnvio'];
	$destination = $_POST['destination'];
	$incoterm = $_POST['incoterm'];
    $cant = $_POST['quantity'];
	$ch = $_POST['chWeight'];
	$model = $_POST['model'];
	$coin = $_POST['coin'];
	$m3 = $_POST['m3'];

	$consulta = "SELECT * FROM wp_k_products WHERE product_model = '$model'";	

	$result = $conexion->query($consulta);
	$count = mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);

	if ($count > 0){
		$exists = "si";
		$name = $row["product_name"];
		$description = $row["product_maker"];
		$image = $row["product_image"];
		if ($coin === "EUR"){
			$price = $row["product_priceEUR"];
		}else{
			$price = $row["product_priceUSD"];
		}
		$height = $row['product_alto_paquete'];
		$width = $row['product_ancho_paquete'];
		$long = $row['product_largo_paquete'];
		$weightBruto = $row['product_peso_bruto'];
		$weightBruto = $weightBruto * $cant;

		if ($mEnvio === 'Aerial'){
			$query = "SELECT * FROM wp_weights_air";
			$result3 = $conexion->query($query);	
			$query2 = "SELECT * FROM wp_weights_air";
			$rs = $conexion->query($query2);	
	
			$multi4 = $long * $width;
			$multi5 = $multi4 * $height;
			$division = $multi5 / 1000000;
			$round = round($division, 3);
			$chWeight = $round / 0.005;
			$chWeight = round($chWeight, 2);
			$weightE = $chWeight * $cant;
			
			
			if ($weightE > $weightBruto){
				$weight = $weightE;	
				$weight = $weight + $ch;
				$weightI = $weightE;
			}else{
				$weight = $weightBruto;
				$weight = $weight + $ch;
				$weightI = $weightBruto;
			}
	
	
			if($weight > 60){
				$limitePeso = "maximo";
				$priceIncoterm = "";
				$priceE = "";
			}else{
				$limitePeso = "permitido";
				$query3 = "SELECT * FROM wp_rates_air WHERE rate_country = '$destination'";
				$result5 = $conexion->query($query3);
				$row4 = mysqli_fetch_array($result5);
	
				while ($valor = $result3->fetch_assoc()){
					$detalle = $valor['weight_detalle'];
					$newDetalle = str_replace('kg', '', $detalle);
					if ($weight <= $newDetalle) {
						$newWeight = $newDetalle."kg";
						break 1;
					}
				}
	
				if ($incoterm === 'EXW Kalstein France') {
					$query4 = "SELECT * FROM wp_rates_air WHERE rate_country = 'FR'";
					$result6 = $conexion->query($query4);
					$row5 = mysqli_fetch_array($result6);

					while ($valor2 = $rs->fetch_assoc()){
						$detalle2 = $valor2['weight_detalle'];
						$newDetalle2 = str_replace('kg', '', $detalle2);
						if ($weightI <= $newDetalle2) {
							$newWeightI = $newDetalle2."kg";
							break 1;
						}
					}
	
					$priceIncoterm = $row5[$newWeightI];
				}else{
					if ($incoterm === 'EXW Kalstein Shanghai'){
						$priceIncoterm = "0.00";
					}
				}
	
				$priceE = $row4[$newWeight];
			}
	
	
		}else{
			if ($mEnvio === 'Maritime'){
	
				$multi4 = $long * $width;
				$multi5 = $multi4 * $height;
				$division = $multi5 / 1000000;
				$round = round($division, 3);
				$chWeight = $round / 0.005;
				$chWeight = round($chWeight, 2);
				$weightE = $chWeight * $cant;
				
				if ($weightE > $weightBruto){
					$weight = $weightE;	
					$weight = $weight + $ch;
					$weightI = $weightE;
				}else{
					$weight = $weightBruto;
					$weight = $weight + $ch;
					$weightI = $weightBruto;
				}
	
				$query3 = "SELECT * FROM wp_rates_maritime WHERE rate_country = '$destination'";
				$result5 = $conexion->query($query3);
				$row4 = mysqli_fetch_array($result5);
				$priceM = $row4['1m³'];
				$m3 = $round + $m3;

				if ($m3 > 1){
					if ($m3 > 2){
						if($m3 > 3){
							if ($m3 > 4){
								if ($m3 > 5){
									if ($m3 > 6){
										if ($m3 > 7){
											if ($m3 > 8){
												if ($m3 > 9){
													$priceE = $priceM * 10;
												}else{
													$priceE = $priceM * 9;
												}
											}else{
												$priceE = $priceM * 8;
											}
										}else{
											$priceE = $priceM * 7;
										}
									}else{
										$priceE = $priceM * 6;
									}
								}else{
									$priceE = $priceM * 5;
								}
							}else{
								$priceE = $priceM * 4;
							}
						}else{
							$priceE = $priceM * 3;
						}
					}else{
						$priceE = $priceM * 2;
					}
				}else{
					$priceE = $priceM * 1;
				}
	
				if ($incoterm === 'EXW Kalstein France') {
					$query4 = "SELECT * FROM wp_rates_maritime WHERE rate_country = 'FR'";
					$result6 = $conexion->query($query4);
					$row5 = mysqli_fetch_array($result6);	
					$priceI = $row5['1m³'];

					if ($m3 > 1){
						if ($m3 > 2){
							if($m3 > 3){
								if ($m3 > 4){
									if ($m3 > 5){
										if ($m3 > 6){
											if ($m3 > 7){
												if ($m3 > 8){
													if ($m3 > 9){
														$priceIncoterm = $priceI * 10;
													}else{
														$priceIncoterm = $priceI * 9;
													}
												}else{
													$priceIncoterm = $priceI * 8;
												}
											}else{
												$priceIncoterm = $priceI * 7;
											}
										}else{
											$priceIncoterm = $priceI * 6;
										}
									}else{
										$priceIncoterm = $priceI * 5;
									}
								}else{
									$priceIncoterm = $priceI * 4;
								}
							}else{
								$priceIncoterm = $priceI * 3;
							}
						}else{
							$priceIncoterm = $priceI * 2;
						}
					}else{
						$priceIncoterm = $priceI * 1;
					}
				}else{
					if ($incoterm === 'EXW Kalstein Shanghai'){
						$priceIncoterm = "0.00";
					}
				}
			}
		}
	}else{
		$exists = "no";
		$price = "";
		$priceE = "";
		$name = "";
		$description = "";
		$priceIncoterm = "";
		$weight = "";
		$limitePeso = "";
	}

	$datos = array(
		'name' => $name,
		'cant' => $cant,
		'price' => $price,
		'model' => $model,
		'image' => $image,
		'description' => $description,
		'priceE' => $priceE,
		'priceIncoterm' => $priceIncoterm,
		'chWeight' => $weight,
		'weight' => $weightI,
		'm3' => $m3,
		'limitePeso' => $limitePeso
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();
?>

