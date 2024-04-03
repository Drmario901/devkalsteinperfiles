<?php

    require __DIR__ . '/conexion.php';

    if (!empty($_POST['porcentaje'])){
        $porcentaje = $_POST['porcentaje'];
    }else{
        $porcentaje = 0;
    }

    if (!empty($_POST['porcentajeM'])){
        $porcentajeM = $_POST['porcentajeM'];
    }else{
        $porcentajeM = 0;
    }
    
    $aerial = [];
    $maritime = [];
    $allRateActual = [];

    $index = $porcentaje / 100;
    $indexM = $porcentajeM / 100;
    $count = 1;
    $countM = 1;

    $query = "SELECT * FROM wp_rates_air";

    $query2 = "SELECT * FROM wp_rates_maritime";
   
    $result = $conexion->query($query);

    $result2 = $conexion->query($query2);

    if (!empty($porcentaje) && !empty($porcentajeM)){
        if ($result->num_rows > 0){
            while ($air = $result->fetch_assoc()){            
                $kg5 = $air['5kg'];
                $kg10 = $air['10kg'];
                $kg15 = $air['15kg'];
                $kg20 = $air['20kg'];
                $kg30 = $air['30kg'];
                $kg40 = $air['40kg'];
                $kg50 = $air['50kg'];
                $kg60 = $air['60kg'];
            
                $multi1 = $kg5 * $index;
                $round1 = round($multi1, 2);
                $suma1 = $kg5 + $multi1;
                $r1 = round($suma1, 2);
            
                $multi2 = $kg10 * $index;
                $round2 = round($multi2, 2);
                $suma2 = $kg10 + $multi2;
                $r2 = round($suma2, 2);
            
                $multi3 = $kg15 * $index;
                $round3 = round($multi3, 2);
                $suma3 = $kg15 + $multi3;
                $r3 = round($suma3, 2);
            
                $multi4 = $kg20 * $index;
                $round4 = round($multi4, 2);
                $suma4 = $kg20 + $multi4;
                $r4 = round($suma4, 2);
            
                $multi5 = $kg30 * $index;
                $round5 = round($multi5, 2);
                $suma5 = $kg30 + $multi5;
                $r5 = round($suma5, 2);
            
                $multi6 = $kg40 * $index;
                $round6 = round($multi6, 2);
                $suma6 = $kg40 + $multi6;
                $r6 = round($suma6, 2);
            
                $multi7 = $kg50 * $index;
                $round7 = round($multi7, 2);
                $suma7 = $kg50 + $multi7;
                $r7 = round($suma7, 2);
            
                $multi8 = $kg60 * $index;
                $round8 = round($multi8, 2);
                $suma8 = $kg60 + $multi8;
                $r8 = round($suma8, 2);
    
                $sumaPorcentaje = array(
                    'r1' => $r1,
                    'r2' => $r2,
                    'r3' => $r3,
                    'r4' => $r4,
                    'r5' => $r5,
                    'r6' => $r6,
                    'r7' => $r7,
                    'r8' => $r8
                );
    
                array_push($aerial, $sumaPorcentaje);
            }
            if($result2->num_rows > 0){
                while ($marit = $result2->fetch_assoc()){
                    $m3 = $marit['1m³'];
            
                    $multi = $m3 * $indexM;
                    $round = round($multi, 2);
                    $suma = $m3 + $multi;
                    $r = round($suma, 2);
            
                    $sumaPorcentaje = array(
                        'r' => $r
                    );

                    array_push($maritime, $sumaPorcentaje);
                }
            }
        } 

        foreach ($aerial as $key => $value) {
            $r1 = $value['r1'];
            $r2 = $value['r2'];
            $r3 = $value['r3'];
            $r4 = $value['r4'];
            $r5 = $value['r5'];
            $r6 = $value['r6'];
            $r7 = $value['r7'];
            $r8 = $value['r8'];

            $updateAir = "UPDATE wp_rates_air SET 5kg = '$r1' WHERE aid = '$count'";
            $updateAir1 = "UPDATE wp_rates_air SET 10kg = '$r2' WHERE aid = '$count'";
            $updateAir2 = "UPDATE wp_rates_air SET 15kg = '$r3' WHERE aid = '$count'";
            $updateAir3 = "UPDATE wp_rates_air SET 20kg = '$r4' WHERE aid = '$count'";
            $updateAir4 = "UPDATE wp_rates_air SET 30kg = '$r5' WHERE aid = '$count'";
            $updateAir5 = "UPDATE wp_rates_air SET 40kg = '$r6' WHERE aid = '$count'";
            $updateAir6 = "UPDATE wp_rates_air SET 50kg = '$r7' WHERE aid = '$count'";
            $updateAir7 = "UPDATE wp_rates_air SET 60kg = '$r8' WHERE aid = '$count'";

            $count++;

            $conexion->query($updateAir);
            $conexion->query($updateAir1);
            $conexion->query($updateAir2);
            $conexion->query($updateAir3);
            $conexion->query($updateAir4);
            $conexion->query($updateAir5);
            $conexion->query($updateAir6);
            $conexion->query($updateAir7);
        }

        foreach ($maritime as $key => $value) {
            $r = $value['r'];

            $updateMaritime = "UPDATE wp_rates_maritime SET 1m³ = '$r' WHERE aid = '$countM'";

            $countM++;

            $conexion->query($updateMaritime);
        }

        $update = 'correcto';
    
    }else{
        if (empty($porcentaje) && !empty($porcentajeM)){
            while ($maritime = $result2->fetch_assoc()){
                $m3 = $maritime['1m³'];
        
                $multi = $m3 * $indexM;
                $round = round($multi, 2);
                $suma = $m3 + $multi;
                $r = round($suma, 2);
        
                $update = "UPDATE wp_rates_maritime SET 1m³ = '$r' WHERE aid = '$count'";
        
                $count++;
                if ($conexion->query($update) === TRUE) {
                    $update = 'correcto';
                }else{
                    $update = 'incorrecto';
                }
            }
        }else{
            if (!empty($porcentaje) && empty($porcentajeM)){
                while ($air = $result->fetch_assoc()){
                    $kg5 = $air['5kg'];
                    $kg10 = $air['10kg'];
                    $kg15 = $air['15kg'];
                    $kg20 = $air['20kg'];
                    $kg30 = $air['30kg'];
                    $kg40 = $air['40kg'];
                    $kg50 = $air['50kg'];
                    $kg60 = $air['60kg'];
            
                    $multi1 = $kg5 * $index;
                    $round1 = round($multi1, 2);
                    $suma1 = $kg5 + $multi1;
                    $r1 = round($suma1, 2);
            
                    $multi2 = $kg10 * $index;
                    $round2 = round($multi2, 2);
                    $suma2 = $kg10 + $multi2;
                    $r2 = round($suma2, 2);
            
                    $multi3 = $kg15 * $index;
                    $round3 = round($multi3, 2);
                    $suma3 = $kg15 + $multi3;
                    $r3 = round($suma3, 2);
            
                    $multi4 = $kg20 * $index;
                    $round4 = round($multi4, 2);
                    $suma4 = $kg20 + $multi4;
                    $r4 = round($suma4, 2);
            
                    $multi5 = $kg30 * $index;
                    $round5 = round($multi5, 2);
                    $suma5 = $kg30 + $multi5;
                    $r5 = round($suma5, 2);
            
                    $multi6 = $kg40 * $index;
                    $round6 = round($multi6, 2);
                    $suma6 = $kg40 + $multi6;
                    $r6 = round($suma6, 2);
            
                    $multi7 = $kg50 * $index;
                    $round7 = round($multi7, 2);
                    $suma7 = $kg50 + $multi7;
                    $r7 = round($suma7, 2);
            
                    $multi8 = $kg60 * $index;
                    $round8 = round($multi8, 2);
                    $suma8 = $kg60 + $multi8;
                    $r8 = round($suma8, 2);
            
                    $update = "UPDATE wp_rates_air SET 5kg = '$r1' WHERE aid = '$count'";
                    $update1 = "UPDATE wp_rates_air SET 10kg = '$r2' WHERE aid = '$count'";
                    $update2 = "UPDATE wp_rates_air SET 15kg = '$r3' WHERE aid = '$count'";
                    $update3 = "UPDATE wp_rates_air SET 20kg = '$r4' WHERE aid = '$count'";
                    $update4 = "UPDATE wp_rates_air SET 30kg = '$r5' WHERE aid = '$count'";
                    $update5 = "UPDATE wp_rates_air SET 40kg = '$r6' WHERE aid = '$count'";
                    $update6 = "UPDATE wp_rates_air SET 50kg = '$r7' WHERE aid = '$count'";
                    $update7 = "UPDATE wp_rates_air SET 60kg = '$r8' WHERE aid = '$count'";
            
                    $count++;
                    if ($conexion->query($update) === TRUE) {
                        if ($conexion->query($update1) === TRUE) {
                            if ($conexion->query($update2) === TRUE) {
                                if ($conexion->query($update3) === TRUE) {
                                    if ($conexion->query($update4) === TRUE) {
                                        if ($conexion->query($update5) === TRUE) {
                                            if ($conexion->query($update6) === TRUE) {
                                                if ($conexion->query($update7) === TRUE) {
                                                    $update = 'correcto';
                                                }else{
                                                    $update = 'incorrecto';
                                                }
                                            }else{
                                                $update = 'incorrecto';
                                            }
                                        }else{
                                            $update = 'incorrecto';
                                        }
                                    }else{
                                        $update = 'incorrecto';
                                    }
                                }else{
                                    $update = 'incorrecto';
                                }
                            }else{
                                $update = 'incorrecto';
                            }
                        }else{
                            $update = 'incorrecto';
                        }
                    }else{
                        $update = 'incorrecto';
                    }
                }
            }
        }
    }


    $datos = array(
        'update' => $update
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();