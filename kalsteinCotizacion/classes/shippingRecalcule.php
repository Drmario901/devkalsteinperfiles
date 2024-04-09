<?php 

	require __DIR__ . '/conexion.php';

	$m3 = $_POST['m3'];
    $ch = $_POST['chWeight'];
	$mEnvio = $_POST['mEnvio'];
	$destination = $_POST['destination'];
	$warehouse = $_POST['warehouse'];
    
    $weight = $ch;

	if ($weight != 0){		
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

				if ($warehouse === 'EXW Kalstein Paris') {
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
					if ($warehouse === 'EXW Kalstein Shanghai'){
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

				if ($warehouse === 'EXW Kalstein Paris') {
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
					if ($warehouse === 'EXW Kalstein Shanghai'){
						$priceIncoterm = "0.00";
					}
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
	
				if ($warehouse === 'EXW Kalstein Paris') {
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
					if ($warehouse === 'EXW Kalstein Shanghai'){
						$priceIncoterm = "0.00";
						$hsPorcentage = '0';
					}
				}
			}
		}  
	}else{
		$priceE = "0.00";
	}	

	$datos = array(
		'priceE' => $priceE,
		'warehouse' => $warehouse
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();
?>

