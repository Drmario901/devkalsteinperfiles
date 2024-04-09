<?php 

	require __DIR__ . '/conexion.php';

	$ch = $_POST['chWeight'];
    $m3 = $_POST['m3'];
	$mEnvio = $_POST['mEnvio'];
	$destination = $_POST['destination'];
    $datos = $_POST['datas'];
    $incoterm = $_POST['incoterm'];
    $coin = $_POST['coin'];
    $data = [];
    
    foreach ($datos as $key => $value) {
        $model = $value['model'];
        $cant = $value['cant'];
        $w = $value['weight'];
        $wm3 = $value['wm3'];

        $consulta = "SELECT * FROM wp_k_products WHERE product_model = '$model'";	

        $result = $conexion->query($consulta);
        $count = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);

        if ($coin === "EUR"){
			$price = $row["product_priceEUR"];
		}else{
			$price = $row["product_priceUSD"];
		}

		$pais = "SELECT * FROM wp_paises WHERE iso = '$destination'";
		$response = $conexion->query($pais);
		$target = mysqli_fetch_array($response);
		$en = $target['en'];

        if ($mEnvio === 'Aerial'){
            $query = "SELECT * FROM wp_weights_air";
            $result3 = $conexion->query($query);	
            $query2 = "SELECT * FROM wp_weights_air";
            $rs = $conexion->query($query2);	             
                
            $weight = $ch;
            $weightI = $w;
        
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

                $array = array( 
		            'priceIncoterm' => $priceIncoterm, 
                    'price' => $price
                );
                array_push($data, $array);
            }
        
        
        }else{
            if ($mEnvio === 'Maritime'){
                $limitePeso = "permitido";
                $query = "SELECT * FROM wp_weights_maritime";
                $result3 = $conexion->query($query);
                $query2 = "SELECT * FROM wp_weights_maritime";
                $rs = $conexion->query($query2);
        
                $weight = $ch;
                $weightI = $w;

                $query3 = "SELECT * FROM wp_rates_maritime WHERE rate_country = '$destination'";
				$result5 = $conexion->query($query3);
				$row4 = mysqli_fetch_array($result5);
				$priceM = $row4['1m³'];
				$n3 = ((float)$wm3 * (float)$cant);
				$n3 = round($n3, 3);
				$m3 = $m3 + $n3;
				$multi10 = $m3 * $priceM;
				$priceE = round($multi10, 2);
	
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

                $array = array( 
		            'priceIncoterm' => $priceIncoterm, 
                    'price' => $price
                );
                array_push($data, $array);
            }
        }
    }

	$datos = array(
		'data' => $data,
        'limitePeso' => $limitePeso,
        'priceE' => $priceE,
		'iso' => $en
	);

	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();
?>

