<?php
    require_once '../../db/conexion.php';

    $country = $_POST['country'];
    $peso = $_POST['peso'];

    $consulta = "SELECT * FROM wp_rates_air WHERE rate_country = '$country'";
    $resultado = $conexion->query($consulta);

    if ($peso > 60){
        $peso60 = mysqli_fetch_array($resultado);
        $tarifa60 = $peso60['60kg'];    
        $priceWeightUnit = $tarifa60 / 60;
        $priceWeightUnit = round($priceWeightUnit, 2);
        $priceMoment = $priceWeightUnit * $peso;
        $priceE = round($priceMoment, 2);
    }else{
        $weightPrice = mysqli_fetch_array($resultado);
        if ($peso <= 5){
            $priceE = $weightPrice['5kg'];
        }else{
            if ($peso <= 10){
                $priceE = $weightPrice['10kg'];
            }else{
                if ($peso <= 15){
                    $priceE = $weightPrice['15kg'];
                }else{
                    if ($peso <= 20){
                        $priceE = $weightPrice['20kg'];
                    }else{
                        if ($peso <= 30){
                            $priceE = $weightPrice['30kg'];
                        }else{
                            if ($peso <= 40){
                                $priceE = $weightPrice['40kg'];
                            }else{
                                if ($peso <= 50){
                                    $priceE = $weightPrice['50kg'];
                                }else{
                                    if ($peso <= 60){
                                        $priceE = $weightPrice['60kg'];
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }
    $data = array(
        'priceE' => $priceE
    );

    echo json_encode($data, JSON_FORCE_OBJECT);
?>
