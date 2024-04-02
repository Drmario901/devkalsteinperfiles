<?php 

	//DETECCION DE ERRORES
	/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

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
	$rb2 = $_POST['rb2'];
	$sres = $_POST['sres'];
	$atc = $_POST['atc'];
	$withdrawalM = $_POST['withdrawalM'];
	$deliveryTime = $_POST['deliveryTime'];
	$arrayAccesories = $_POST['arrayAccesories'] ?? NULL;
	$m3 = round($m3, 3);
	$weightBoxF1 = 0;
	$n3Box1 = 0;
	$weightBoxF2 = 0;
	$n3Box2 = 0;

	if ($rb == 1){
		$consulta = "SELECT * FROM wp_k_products WHERE product_model = '$model'";		
		$otherBoxConsult = "SELECT * FROM wp_k_products_supplement WHERE products_supplement_model = '$model'";
		$consultCountryEU = "SELECT * FROM wp_eu_country WHERE eu_country_iso = '$destination'";
		$resultCountryEU = $conexion->query($consultCountryEU);
		$countCountryEU = mysqli_num_rows($resultCountryEU);

		$otherBoxResponse = $conexion->query($otherBoxConsult);
		$coin = 'EUR';

		if ($deliveryTime == 1){
			$mEnvio = 'Aerial';
		}else{
			$mEnvio = 'Maritime';
		}

		if ($otherBoxResponse->num_rows > 0){
			$i = 0;
			while($value = $otherBoxResponse->fetch_assoc()){
				$heightBox = $value['products_supplement_heightP'];
				$widthBox = $value['products_supplement_widthP'];
				$longBox = $value['products_supplement_longP'];
				$weightBox = $value['products_supplement_wieghtP'];

				$multiBox = $heightBox * $widthBox;
				$multiBox1 = $multiBox * $longBox;
				$divisionBox = $multiBox1 / 1000000;
				$roundBox = round($divisionBox, 3);
				$chWBox = $roundBox / 0.005;
				$chWeightBox = round($chWBox, 2);
				$weightEBox = $chWeightBox * $cant;
				$n3Box = $roundBox;
				$i = $i + 1;

				if ($weightEBox > $weightBox){
					$weightBoxF = $weightEBox;	
				}else{
					$weightBoxF = $weightBox;	
				}

				if ($i == 1){
					$weightBoxF1 = $weightBoxF;
					$n3Box1 = $n3Box;
				}else{
					if ($i == 2){
						$weightBoxF2 = $weightBoxF;
						$n3Box2 = $n3Box;
					}
				}
			}
		}else{
			$weightBoxF1 = 0;
			$n3Box1 = 0;
			$weightBoxF2 = 0;
			$n3Box2 = 0;
		}

		$result = $conexion->query($consulta);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);

		if ($count > 0){
			$exists = "si";
			$name = $row["product_name_es"];
			$description = $row["product_brand"];
			$image = $row["product_image"];
			$categorieProduct = $row['product_category'];
			$maker = $row['product_maker'];

			// Calculo de precio mediante tipo de moneda
			if ($coin === "EUR"){  // De ser EURO, realizar calculo de la manera siguiente				
				if ($maker === "KALSTEIN-INTERNAL"){ // Si los productos son pertenecientes a Kalstein, calcular de la siguiente forma
					$percentage1 = $row['product_percentage1']; // Porcentaje del 1.8
					$percentage2 = $row['product_percentage2']; // Porcentaje del 1.19
					$technicalServices = $row['product_technical_services']; // Tarifa por servicio de soporte tecnico
					$dolar = $row["product_priceUSD"]; // Precio del producto en el año cursante
					$usd = $dolar * $percentage1 * $percentage2 + $technicalServices; // Calculo del precio en USD
					$usd = round($usd, 2);
					$eur = $usd / 1.14;
					$price = round($eur, 2);
				}else{
					$usd = $row["product_priceUSD"];
					$eur = $usd / 1.14;
					$price = round($eur, 2);
				}
			}else{ // De ser DOLLAR, realizar de la siguiente manera
				if ($maker === "KALSTEIN-INTERNAL"){ // Si los productos son pertenecientes a Kalstein, calcular de la siguiente forma
					$percentage1 = $row['product_percentage1']; // Porcentaje del 1.8
					$percentage2 = $row['product_percentage2']; // Porcentaje del 1.19
					$technicalServices = $row['product_technical_services']; // Tarifa por servicio de soporte tecnico
					$dolar = $row["product_priceUSD"]; // Precio del producto en el año cursante
					$usd = $dolar * $percentage1 * $percentage2 + $technicalServices; // Calculo del precio en USD
					$price = round($usd, 2);
				}else{
					$price = $row["product_priceUSD"];
				}
			}

			$height = $row['product_alto_paquete'];
			$width = $row['product_ancho_paquete'];
			$long = $row['product_largo_paquete'];
			$weightBruto = $row['product_peso_bruto'];
			$weightBruto = $weightBruto * $cant;

			if ($arrayAccesories == null){
				$price = $price;
			}else{
				foreach ($arrayAccesories as $key => $value) {
					$modelAccesorie = $value['modelAccesorie'];
					$consultaAccesories = "SELECT * FROM wp_k_products WHERE product_model = '$modelAccesorie'";
					$resultAccesories = $conexion->query($consultaAccesories);
					$rowAccesories = mysqli_fetch_array($resultAccesories);
					$heightAccesories = $rowAccesories['product_alto_paquete'];
					$widthAccesories = $rowAccesories['product_ancho_paquete'];
					$longAccesories = $rowAccesories['product_largo_paquete'];
					$weightBrutoAccesories = $rowAccesories['product_peso_bruto'];

					if ($coin === "EUR"){
						$usd = $rowAccesories["product_priceUSD"];
						$eurAccesories = $usd / 1.14;
						$priceAccesories = round($eurAccesories, 2);
						$priceAccesories = $priceAccesories * $cant;
						$priceAccesories = round($priceAccesories, 2);
					}else{
						$priceAccesories = $rowAccesories["product_priceUSD"];
						$priceAccesories = $priceAccesories * $cant;
						$priceAccesories = round($priceAccesories, 2);
					}

					$price = $price + $priceAccesories;
					$price = round($price, 2);

					if ($weightBrutoAccesories != '' || $weightBrutoAccesories != 0){
						$height = $height + $heightAccesories;
						$width = $width + $widthAccesories;
						$long = $long + $longAccesories;
						$weightBruto = $weightBruto + $weightBrutoAccesories;
					}else{
						$height = $height;
						$width = $width;
						$long = $long;
						$weightBruto = $weightBruto;
					}
				}
			}

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
				$multi4 = $long * $width;
				$multi5 = $multi4 * $height;
				$division = $multi5 / 1000000;
				$round = round($division, 3);
				$chW = $round / 0.005;
				$chWeight = round($chW, 2);
				$weightE = $chWeight * $cant;
				$weightE = $weightE + $weightBoxFT;
				$weightE = round($weightE, 2);
				$n3 = $round * $cant;
				$n3 = round($n3, 3);
				$m3 = $m3 + $n3;
				$m3 = round($m3, 3);				
				
				if ($weightE > $weightBruto){
					$weight = $weightE;	
					$weightI = $weightE;
				}else{
					$weight = $weightBruto;
					$weightI = $weightBruto;
				}

				if($weight >= 60){
					$limitePeso = "maximo";
					$query4 = "SELECT * FROM wp_rates_air WHERE rate_country = 'FR'";
					$result6 = $conexion->query($query4);
					$row5 = mysqli_fetch_array($result6);
					$priceI60 = $row5['60kg'];
					$priceIWeightUnit = $priceI60 / 60;
					$priceIWeightUnit = round($priceIWeightUnit, 2);
					$priceIMoment = $priceIWeightUnit * $weight;
					$priceIncotermEXWParis = round($priceIMoment, 2);
					$priceIncoterm = '0.00';

					$hscodeConsultFR = "SELECT * FROM wp_hs_code WHERE hs_code_categorie = '$categorieProduct' AND hs_code_country = 'FR'";
					$hscodeResponseFR = $conexion->query($hscodeConsultFR);
					$hscodeRowFR = mysqli_fetch_array($hscodeResponseFR);
					$hscodeIVAFR = $hscodeRowFR['hs_code_iva'];
					$hscodeArancelFR = $hscodeRowFR['hs_code_arancel'];
					$hscodeAnidadoFR = $hscodeRowFR['hs_code_anidado'];
					$sumaPorcentaje1FR = $hscodeIVAFR + $hscodeArancelFR;
					$sumaPorcentaje2FR = $sumaPorcentaje1FR + $hscodeAnidadoFR;

					if ($sumaPorcentaje2FR < 35){
						$hsPorcentageFR = 0.35;
					}else{
						$hsPorcentageFR = '0.'.$sumaPorcentaje2FR;
					}

					$discount = $price * 0.18;
					$priceWithDiscount = $price - $discount;
					$priceHS = $priceWithDiscount * $hsPorcentageFR;
					$price = $priceWithDiscount + $priceHS;
					$price = $price + $priceIncotermEXWParis;
					$price = round($price, 2);
					$priceE = '0.00';
					$hsPorcentage = '0';							
				}else{
					$limitePeso = "permitido";
					$query4 = "SELECT * FROM wp_rates_air WHERE rate_country = 'FR'";
					$result6 = $conexion->query($query4);
					$row4 = mysqli_fetch_array($result6);
					$priceIncoterm = '0.00';

					if ($weight <= 5){
						$priceIncotermEXWParis = $row4['5kg'];
					}else{
						if ($weight <= 10){
							$priceIncotermEXWParis = $row4['10kg'];
						}else{
							if ($weight <= 15){
								$priceIncotermEXWParis = $row4['15kg'];
							}else{
								if ($weight <= 20){
									$priceIncotermEXWParis = $row4['20kg'];
								}else{
									if ($weight <= 30){
										$priceIncotermEXWParis = $row4['30kg'];
									}else{
										if ($weight <= 40){
											$priceIncotermEXWParis = $row4['40kg'];
										}else{
											if ($weight <= 50){
												$priceIncotermEXWParis = $row4['50kg'];
											}else{
												if ($weight <= 60){
													$priceIncotermEXWParis = $row4['60kg'];
												}
											}
										}
									}
								}
							}
						}
					}

					$hscodeConsultFR = "SELECT * FROM wp_hs_code WHERE hs_code_categorie = '$categorieProduct' AND hs_code_country = 'FR'";
					$hscodeResponseFR = $conexion->query($hscodeConsultFR);
					$hscodeRowFR = mysqli_fetch_array($hscodeResponseFR);
					$hscodeIVAFR = $hscodeRowFR['hs_code_iva'];
					$hscodeArancelFR = $hscodeRowFR['hs_code_arancel'];
					$hscodeAnidadoFR = $hscodeRowFR['hs_code_anidado'];
					$sumaPorcentaje1FR = $hscodeIVAFR + $hscodeArancelFR;
					$sumaPorcentaje2FR = $sumaPorcentaje1FR + $hscodeAnidadoFR;

					if ($sumaPorcentaje2FR < 35){
						$hsPorcentageFR = 0.35;
					}else{
						$hsPorcentageFR = '0.'.$sumaPorcentaje2FR;
					}

					$discount = $price * 0.18;
					$priceWithDiscount = $price - $discount;
					$priceHS = $priceWithDiscount * $hsPorcentageFR;
					$price = $priceWithDiscount + $priceHS;
					$price = $price + $priceIncotermEXWParis;
					$price = round($price, 2);

					$priceE = '0.00';
					$hsPorcentage = '0';
				}	
			}else{
				$query4 = "SELECT * FROM wp_rates_maritime WHERE rate_country = 'FR'";
				$result6 = $conexion->query($query4);
				$row5 = mysqli_fetch_array($result6);	
				$priceI = $row5['1m³'];
				$multi11 = $n3 * $priceI; 
				$priceIncoterm = "0.00";
				$multi4 = $long * $width;
				$multi5 = $multi4 * $height;
				$division = $multi5 / 1000000;
				$round = round($division, 3);
				$chW = $round / 0.005;
				$chWeight = round($chW, 2);
				$weightE = $chWeight * $cant;
				$weightE = $weightE + $weightBoxFT;
				$n3 = $round * $cant;
				$n3 = round($n3, 3);
				$m3 = $m3 + $n3;
				$m3 = round($m3, 3);

				if ($n3 < 1){
					$priceIncotermEXWParis = $priceI;
				}else{
					$priceIncotermEXWParis = round($multi11, 2);
				}

				$hscodeConsultFR = "SELECT * FROM wp_hs_code WHERE hs_code_categorie = '$categorieProduct' AND hs_code_country = 'FR'";
				$hscodeResponseFR = $conexion->query($hscodeConsultFR);
				$hscodeRowFR = mysqli_fetch_array($hscodeResponseFR);
				$hscodeIVAFR = $hscodeRowFR['hs_code_iva'];
				$hscodeArancelFR = $hscodeRowFR['hs_code_arancel'];
				$hscodeAnidadoFR = $hscodeRowFR['hs_code_anidado'];
				$sumaPorcentaje1FR = $hscodeIVAFR + $hscodeArancelFR;
				$sumaPorcentaje2FR = $sumaPorcentaje1FR + $hscodeAnidadoFR;

				if ($sumaPorcentaje2FR < 35){
					$hsPorcentageFR = 0.35;
				}else{
					$hsPorcentageFR = '0.'.$sumaPorcentaje2FR;
				}

				$discount = $price * 0.18;
				$priceWithDiscount = $price - $discount;
				$priceHS = $priceWithDiscount * $hsPorcentageFR;
				$price = $priceWithDiscount + $priceHS;
				$price = $price + $priceIncotermEXWParis;
				$price = round($price, 2);
				$priceE = '0.00';
				$hsPorcentage = '0';
			}		
		}
	}else{
		$consulta = "SELECT * FROM wp_k_products WHERE product_model = '$model'";	
		$otherBoxConsult = "SELECT * FROM wp_k_products_supplement WHERE products_supplement_model = '$model'";
		$consultCountryEU = "SELECT * FROM wp_eu_country WHERE eu_country_iso = '$destination'";
		$resultCountryEU = $conexion->query($consultCountryEU);
		$countCountryEU = mysqli_num_rows($resultCountryEU);

		$otherBoxResponse = $conexion->query($otherBoxConsult);

		if ($otherBoxResponse->num_rows > 0){
			$i = 0;
			while($value = $otherBoxResponse->fetch_assoc()){
				$heightBox = $value['products_supplement_heightP'];
				$widthBox = $value['products_supplement_widthP'];
				$longBox = $value['products_supplement_longP'];
				$weightBox = $value['products_supplement_wieghtP'];

				$multiBox = $heightBox * $widthBox;
				$multiBox1 = $multiBox * $longBox;
				$divisionBox = $multiBox1 / 1000000;
				$roundBox = round($divisionBox, 3);
				$chWBox = $roundBox / 0.005;
				$chWeightBox = round($chWBox, 2);
				$weightEBox = $chWeightBox * $cant;
				$n3Box = $roundBox;
				$i = $i + 1;

				if ($weightEBox > $weightBox){
					$weightBoxF = $weightEBox;	
				}else{
					$weightBoxF = $weightBox;	
				}

				if ($i == 1){
					$weightBoxF1 = $weightBoxF;
					$n3Box1 = $n3Box;
				}else{
					if ($i == 2){
						$weightBoxF2 = $weightBoxF;
						$n3Box2 = $n3Box;
					}
				}
			}
		}
			
		$weightBoxFT = $weightBoxF1 + $weightBoxF2;
		$n3BoxT = $n3Box1 + $n3Box2;

		$result = $conexion->query($consulta);
		$count = mysqli_num_rows($result);
		$row = mysqli_fetch_array($result);

		if ($count > 0){
			$exists = "si";
			$name = $row["product_name_es"];
			$description = $row["product_brand"];
			$image = $row["product_image"];
			$categorieProduct = $row['product_category'];
			$maker = $row['product_maker'];			

			// Calculo de precio mediante tipo de moneda
			if ($coin === "EUR"){  // De ser EURO, realizar calculo de la manera siguiente				
				if ($maker === "KALSTEIN-INTERNAL"){ // Si los productos son pertenecientes a Kalstein, calcular de la siguiente forma
					$percentage1 = $row['product_percentage1']; // Porcentaje del 1.8
					$percentage2 = $row['product_percentage2']; // Porcentaje del 1.19
					$technicalServices = $row['product_technical_services']; // Tarifa por servicio de soporte tecnico
					$dolar = $row["product_priceUSD"]; // Precio del producto en el año cursante
					$usd = $dolar * $percentage1 * $percentage2 + $technicalServices; // Calculo del precio en USD
					$usd = round($usd, 2);
					$eur = $usd / 1.14;
					$price = round($eur, 2);
				}else{
					$usd = $row["product_priceUSD"];
					$eur = $usd / 1.14;
					$price = round($eur, 2);
				}
			}else{ // De ser DOLLAR, realizar de la siguiente manera
				if ($maker === "KALSTEIN-INTERNAL"){ // Si los productos son pertenecientes a Kalstein, calcular de la siguiente forma
					$percentage1 = $row['product_percentage1']; // Porcentaje del 1.8
					$percentage2 = $row['product_percentage2']; // Porcentaje del 1.19
					$technicalServices = $row['product_technical_services']; // Tarifa por servicio de soporte tecnico
					$dolar = $row["product_priceUSD"]; // Precio del producto en el año cursante
					$usd = $dolar * $percentage1 * $percentage2 + $technicalServices; // Calculo del precio en USD
					$price = round($usd, 2);
				}else{
					$price = $row["product_priceUSD"];
				}
			}

			$height = $row['product_alto_paquete'];
			$width = $row['product_ancho_paquete'];
			$long = $row['product_largo_paquete'];
			$weightBruto = $row['product_peso_bruto'];
			$weightBruto = $weightBruto * $cant;

			if ($arrayAccesories == null){
				$price = $price;
			}else{
				foreach ($arrayAccesories as $key => $value) {
					$modelAccesorie = $value['modelAccesorie'];
					$consultaAccesories = "SELECT * FROM wp_k_products WHERE product_model = '$modelAccesorie'";
					$resultAccesories = $conexion->query($consultaAccesories);
					$rowAccesories = mysqli_fetch_array($resultAccesories);
					$heightAccesories = $rowAccesories['product_alto_paquete'];
					$widthAccesories = $rowAccesories['product_ancho_paquete'];
					$longAccesories = $rowAccesories['product_largo_paquete'];
					$weightBrutoAccesories = $rowAccesories['product_peso_bruto'];

					if ($coin === "EUR"){
						$usd = $rowAccesories["product_priceUSD"];
						$eurAccesories = $usd / 1.14;
						$priceAccesories = round($eurAccesories, 2);
						$priceAccesories = $priceAccesories * $cant;
						$priceAccesories = round($priceAccesories, 2);
					}else{
						$priceAccesories = $rowAccesories["product_priceUSD"];
						$priceAccesories = $priceAccesories * $cant;
						$priceAccesories = round($priceAccesories, 2);
					}

					$price = $price + $priceAccesories;
					$price = round($price, 2);

					if ($weightBrutoAccesories != '' || $weightBrutoAccesories != 0){
						$height = $height + $heightAccesories;
						$width = $width + $widthAccesories;
						$long = $long + $longAccesories;
						$weightBruto = $weightBruto + $weightBrutoAccesories;
					}else{
						$height = $height;
						$width = $width;
						$long = $long;
						$weightBruto = $weightBruto;
					}
				}
			}

			$numLetter = strlen($destination);

			if($numLetter > 2){			
				$en = $destination;
			}else{
				$pais = "SELECT * FROM wp_paises WHERE iso = '$destination'";
				$response = $conexion->query($pais);
				$target = mysqli_fetch_array($response);
				$en = $target['en'];
			}

			$hscodeConsult = "SELECT * FROM wp_hs_code WHERE hs_code_categorie = '$categorieProduct' AND hs_code_country = '$destination'";
			$hscodeResponse = $conexion->query($hscodeConsult);
			$hscodeRow = mysqli_fetch_array($hscodeResponse) ?? NULL;
			$hscodeIVA = $hscodeRow['hs_code_iva'] ?? 0;
			$hscodeArancel = $hscodeRow['hs_code_arancel'] ?? 0;
			$hscodeAnidado = $hscodeRow['hs_code_anidado'] ?? 0;
			$sumaPorcentaje1 = $hscodeIVA + $hscodeArancel;
			$sumaPorcentaje2 = $sumaPorcentaje1 + $hscodeAnidado;

			if ($sumaPorcentaje2 < 35){
				$hsPorcentage = 0.35;
			}else{
				$hsPorcentage = '0.'.$sumaPorcentaje2;
			}

			if ($withdrawalM == 1){
				if ($mEnvio === 'Aerial'){		
					$multi4 = $long * $width;
					$multi5 = $multi4 * $height;
					$division = $multi5 / 1000000;
					$round = round($division, 3);
					$chW = $round / 0.005;
					$chWeight = round($chW, 2);
					$weightE = $chWeight * $cant;
					$weightE = $weightE + $weightBoxFT;
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
	
					if($weight >= 60){
						$limitePeso = "maximo";
						$query3 = "SELECT * FROM wp_rates_air WHERE rate_country = '$destination'";
						$resultRate = $conexion->query($query3);
						$row4 = mysqli_fetch_array($resultRate);
						$price60 = $row4['60kg'];
						$priceWeightUnit = $price60 / 60;
						$priceWeightUnit = round($priceWeightUnit, 2);
						$priceMoment = $priceWeightUnit * $weight;
						$priceE = round($priceMoment, 2);
	
						if ($incoterm === 'EXW Kalstein Paris') {
							$query4 = "SELECT * FROM wp_rates_air WHERE rate_country = 'FR'";
							$result6 = $conexion->query($query4);
							$row5 = mysqli_fetch_array($result6);
							$priceI60 = $row5['60kg'];
							$priceIWeightUnit = $priceI60 / 60;
							$priceIWeightUnit = round($priceIWeightUnit, 2);
							$priceIMoment = $priceIWeightUnit * $weight;
							$priceIncotermEXWParis = round($priceIMoment, 2);
							$priceIncoterm = '0.00';
	
							$hscodeConsultFR = "SELECT * FROM wp_hs_code WHERE hs_code_categorie = '$categorieProduct' AND hs_code_country = 'FR'";
							$hscodeResponseFR = $conexion->query($hscodeConsultFR);
							$hscodeRowFR = mysqli_fetch_array($hscodeResponseFR);
							$hscodeIVAFR = $hscodeRowFR['hs_code_iva'];
							$hscodeArancelFR = $hscodeRowFR['hs_code_arancel'];
							$hscodeAnidadoFR = $hscodeRowFR['hs_code_anidado'];
							$sumaPorcentaje1FR = $hscodeIVAFR + $hscodeArancelFR;
							$sumaPorcentaje2FR = $sumaPorcentaje1FR + $hscodeAnidadoFR;
	
							if ($sumaPorcentaje2FR < 35){
								$hsPorcentageFR = 0.35;
							}else{
								$hsPorcentageFR = '0.'.$sumaPorcentaje2FR;
							}
	
							$discount = $price * 0.18;
							$priceWithDiscount = $price - $discount;
							$priceHS = $priceWithDiscount * $hsPorcentageFR;
							$price = $priceWithDiscount + $priceHS;
							$price = $price + $priceIncotermEXWParis;
							$price = round($price, 2);
							if ($countCountryEU > 0){
								$priceE = '0.00';
								$hsPorcentage = '0';
							}else{
								$priceE = $priceE;
								$hsPorcentage = $hsPorcentage;
							}
						}else{
							if ($incoterm === 'EXW Kalstein Shanghai'){
								$priceIncoterm = "0.00";
							}
						}
					}else{
						$limitePeso = "permitido";
						$query = "SELECT * FROM wp_rates_air WHERE rate_country = '$destination'";
						$result3 = $conexion->query($query);	
						$row4 = mysqli_fetch_array($result3);
	
						if ($weight < 5){
							$priceE = $row4['5kg'];
						}else{
							if ($weight < 10){
								$priceE = $row4['10kg'];
							}else{
								if ($weight < 15){
									$priceE = $row4['15kg'];
								}else{
									if ($weight < 20){
										$priceE = $row4['20kg'];
									}else{
										if ($weight < 30){
											$priceE = $row4['30kg'];
										}else{
											if ($weight < 40){
												$priceE = $row4['40kg'];
											}else{
												if ($weight < 50){
													$priceE = $row4['50kg'];
												}else{
													if ($weight < 60){
														$priceE = $row4['60kg'];
													}
												}
											}
										}
									}
								}
							}
						}
	
						if ($incoterm === 'EXW Kalstein Paris') {
							$query4 = "SELECT * FROM wp_rates_air WHERE rate_country = 'FR'";
							$result6 = $conexion->query($query4);
							$row5 = mysqli_fetch_array($result6);
							$priceIncoterm = '0.00';
	
							if ($weight < 5){
								$priceIncotermEXWParis = $row4['5kg'];
							}else{
								if ($weight < 10){
									$priceIncotermEXWParis = $row4['10kg'];
								}else{
									if ($weight < 15){
										$priceIncotermEXWParis = $row4['15kg'];
									}else{
										if ($weight < 20){
											$priceIncotermEXWParis = $row4['20kg'];
										}else{
											if ($weight < 30){
												$priceIncotermEXWParis = $row4['30kg'];
											}else{
												if ($weight < 40){
													$priceIncotermEXWParis = $row4['40kg'];
												}else{
													if ($weight < 50){
														$priceIncotermEXWParis = $row4['50kg'];
													}else{
														if ($weight < 60){
															$priceIncotermEXWParis = $row4['60kg'];
														}
													}
												}
											}
										}
									}
								}
							}
	
							$hscodeConsultFR = "SELECT * FROM wp_hs_code WHERE hs_code_categorie = '$categorieProduct' AND hs_code_country = 'FR'";
							$hscodeResponseFR = $conexion->query($hscodeConsultFR);
							$hscodeRowFR = mysqli_fetch_array($hscodeResponseFR);
							$hscodeIVAFR = $hscodeRowFR['hs_code_iva'];
							$hscodeArancelFR = $hscodeRowFR['hs_code_arancel'];
							$hscodeAnidadoFR = $hscodeRowFR['hs_code_anidado'];
							$sumaPorcentaje1FR = $hscodeIVAFR + $hscodeArancelFR;
							$sumaPorcentaje2FR = $sumaPorcentaje1FR + $hscodeAnidadoFR;
	
							if ($sumaPorcentaje2FR < 35){
								$hsPorcentageFR = 0.35;
							}else{
								$hsPorcentageFR = '0.'.$sumaPorcentaje2FR;
							}
	
							$discount = $price * 0.18;
							$priceWithDiscount = $price - $discount;
							$priceHS = $priceWithDiscount * $hsPorcentageFR;
							$price = $priceWithDiscount + $priceHS;
							$price = $price + $priceIncotermEXWParis;
							$price = round($price, 2);
	
							if ($countCountryEU > 0){
								$priceE = '0.00';
								$hsPorcentage = '0';
							}else{
								$priceE = $priceE;
								$hsPorcentage = $hsPorcentage;
							}
						}else{
							if ($incoterm === 'EXW Kalstein Shanghai'){
								$priceIncoterm = "0.00";
							}
						}
					}		
				}else{
					if ($mEnvio === 'Maritime'){
						$limitePeso = "permitido";
			
						$multi4 = $long * $width;
						$multi5 = $multi4 * $height;
						$division = $multi5 / 1000000;
						$round = round($division, 3);
						$chWeight = $round / 0.005;
						$chWeight = round($chWeight, 2);
						$weightE = $chWeight * $cant;
						$weightE = $weightE + $weightBoxFT;
						
						
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
						$n3 = $n3 + $n3BoxT;
						$n3 = round($n3, 3);
						$m3 = $m3 + $n3;
						$multi10 = $m3 * $priceM;
						
						if ($m3 < 1){
							$priceE = $priceM;
						}else{
							$priceE = round($multi10, 2);
						}
			
						if ($incoterm === 'EXW Kalstein Paris') {
							$query4 = "SELECT * FROM wp_rates_maritime WHERE rate_country = 'FR'";
							$result6 = $conexion->query($query4);
							$row5 = mysqli_fetch_array($result6);	
							$priceI = $row5['1m³'];
							$multi11 = $n3 * $priceI; 
							$priceIncoterm = "0.00";
	
							if ($n3 < 1){
								$priceIncotermEXWParis = $priceI;
							}else{
								$priceIncotermEXWParis = round($multi11, 2);
							}
	
							$hscodeConsultFR = "SELECT * FROM wp_hs_code WHERE hs_code_categorie = '$categorieProduct' AND hs_code_country = 'FR'";
							$hscodeResponseFR = $conexion->query($hscodeConsultFR);
							$hscodeRowFR = mysqli_fetch_array($hscodeResponseFR);
							$hscodeIVAFR = $hscodeRowFR['hs_code_iva'];
							$hscodeArancelFR = $hscodeRowFR['hs_code_arancel'];
							$hscodeAnidadoFR = $hscodeRowFR['hs_code_anidado'];
							$sumaPorcentaje1FR = $hscodeIVAFR + $hscodeArancelFR;
							$sumaPorcentaje2FR = $sumaPorcentaje1FR + $hscodeAnidadoFR;
	
							if ($sumaPorcentaje2FR < 35){
								$hsPorcentageFR = 0.35;
							}else{
								$hsPorcentageFR = '0.'.$sumaPorcentaje2FR;
							}
	
							$discount = $price * 0.18;
							$priceWithDiscount = $price - $discount;
							$priceHS = $priceWithDiscount * $hsPorcentageFR;
							$price = $priceWithDiscount + $priceHS;
							$price = $price + $priceIncotermEXWParis;
							$price = round($price, 2);
	
							if ($countCountryEU > 0){
								$priceE = '0.00';
								$hsPorcentage = '0';
							}else{
								$priceE = $priceE;
								$hsPorcentage = $hsPorcentage;
							}
						}else{
							if ($incoterm === 'EXW Kalstein Shanghai'){
								$priceIncoterm = "0.00";
								$hsPorcentage = '0';
							}
						}
					}
				}
			}else{				
				$priceE = '0.00';
				$hsPorcentage = '0';
				$priceIncoterm = '0.00';
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
		'atc' => $atc,
		'hsPorcentage' => $hsPorcentage,
		'withdrawalM' => $withdrawalM,
		'deliveryTime' => $deliveryTime,
		'rb2' => $rb2,
		'maker' => $maker,
		'arrayAccesories' => $arrayAccesories
	);

	array_push($aProduct, $datos);
	$_SESSION['productsToQuote'] = $aProduct;

	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();