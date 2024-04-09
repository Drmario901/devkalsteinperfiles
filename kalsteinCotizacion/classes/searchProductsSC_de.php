<?php 
	session_start();
	if (isset($_SESSION['productsToQuote'])){
		$aProduct = $_SESSION['productsToQuote'];
	}else{
		$aProduct = [];
	}

	require __DIR__ . '/conexion.php';

	$salida = "";
	$mEnvio = $_POST['mEnvio'];
	$destination = $_POST['destination'];
	$incoterm = $_POST['incoterm'];
	$zipcode = $_POST['zipcode'];
	$payment = $_POST['payment'];
    $cant = $_POST['quantity'];
	$ch = $_POST['chWeight'];
	$model = $_POST['model'];
	$coin = $_POST['coin'];
	$m3 = $_POST['m3'];
	$rb = $_POST['rb'];
	$sres = $_POST['sres'];
	$atc = $_POST['atc'];
	$m3 = round($m3, 3);

	if ($rb == 1){
		$consulta = "SELECT * FROM wp_k_products WHERE product_model = '$model'";	

		$result = $conexion->query($consulta);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);

		if ($count > 0){
			$exists = "si";
			$name = $row["product_name_de"];
			$description = $row["product_maker"];
			$image = $row["product_image"];
			if ($coin === "EUR"){
				$usd = $row["product_priceUSD"];
				$eur = $usd / 1.14;
				$price = round($eur, 2);
			}else{
				$price = $row["product_priceUSD"];
			}
			$height = $row['product_alto_paquete'];
			$width = $row['product_ancho_paquete'];
			$long = $row['product_largo_paquete'];
			$weightBruto = $row['product_peso_bruto'];
			$weightBruto = $weightBruto * $cant;
			$mEnvio = "";
			$priceE = "0.00";
			$priceIncoterm = "0.00";
			$n3 = "0.00";
			$limitePeso = "";
			$weight = "0.00";
			$weightI = "0.00";
			$en = "";
		}else{
			$exists = "no";
			$price = "";
			$priceE = "";
			$name = "";
			$description = "";
			$priceIncoterm = "";
			$weight = "";
			$limitePeso = "";
			$n3 = "0.00";
			$en = "";
		}	
	}else{
		$consulta = "SELECT * FROM wp_k_products WHERE product_model = '$model'";	

		$result = $conexion->query($consulta);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);

		if ($count > 0){
			$exists = "si";
			$name = $row["product_name_de"];
			$description = $row["product_maker"];
			$image = $row["product_image"];
			if ($coin === "EUR"){
				$usd = $row["product_priceUSD"];
				$eur = $usd / 1.14;
				$price = round($eur, 2);
			}else{
				$price = $row["product_priceUSD"];
			}
			$height = $row['product_alto_paquete'];
			$width = $row['product_ancho_paquete'];
			$long = $row['product_largo_paquete'];
			$weightBruto = $row['product_peso_bruto'];
			$weightBruto = $weightBruto * $cant;

			$numLetter = strlen($destination);

			if($numLetter > 2){			
				$en = $destination;
			}else{
				$pais = "SELECT * FROM wp_paises WHERE iso = '$destination'";
				$response = $conexion->query($pais);
				$target = mysqli_fetch_array($response);
				$en = $target['en'];
			}

			if ($mEnvio === 'Aerial'){
				$query = "SELECT * FROM wp_weights_air";
				$result3 = $conexion->query($query);	
				$query2 = "SELECT * FROM wp_weights_air";
				$rs = $conexion->query($query2);	
		
				$multi4 = $long * $width;
				$multi5 = $multi4 * $height;
				$division = $multi5 / 1000000;
				$round = round($division, 3);
				$chW = $round / 0.005;
				$chWeight = round($chW, 2);
				$weightE = $chWeight * $cant;
				$n3 = $round * $cant;
				$n3 = round($n3, 3);
				$m3 = $m3 + $n3;
				$m3 = round($m3, 3);
				
				
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
					
					if ($newWeight != ""){
						$query3 = "SELECT * FROM wp_rates_air WHERE rate_country = '$destination'";
						$resultRate = $conexion->query($query3);
						$row4 = mysqli_fetch_array($resultRate);
						$priceE = $row4[$newWeight];
					}else{
						$priceE = "";
					}
					
				}
		
		
			}else{
				if ($mEnvio === 'Maritime'){
					$limitePeso = "permitido";
					$query = "SELECT * FROM wp_weights_maritime";
					$result3 = $conexion->query($query);
					$query2 = "SELECT * FROM wp_weights_maritime";
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
		
					$query3 = "SELECT * FROM wp_rates_maritime WHERE rate_country = '$destination'";
					$result5 = $conexion->query($query3);
					$row4 = mysqli_fetch_array($result5);
					$priceM = $row4['1m³'];
					$n3 = $round * $cant;
					$n3 = round($n3, 3);
					$m3 = $m3 + $n3;
					$multi10 = $m3 * $priceM;
					
					if ($m3 < 1){
						$priceE = $priceM;
					}else{
						$priceE = round($multi10, 2);
					}
		
					if ($incoterm === 'EXW Kalstein France') {
						$query4 = "SELECT * FROM wp_rates_maritime WHERE rate_country = 'FR'";
						$result6 = $conexion->query($query4);
						$row5 = mysqli_fetch_array($result6);	
						$priceI = $row5['1m³'];
						$multi11 = $m3 * $priceI; 
						$priceIncoterm = round($multi11, 2);
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
		'n3' => $n3,
		'limitePeso' => $limitePeso,
		'zipcode' => $zipcode,
		'payment' => $payment,
        'destination' => $en,
		'iso' => $destination,
        'mEnvio' => $mEnvio,
        'incoterm' => $incoterm,
        'coin' => $coin, 
		'rb' => $rb, 
		'sres' => $sres,
		'atc' => $atc
	);

	array_push($aProduct, $datos);
	$_SESSION['productsToQuote'] = $aProduct;

	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();
?>

