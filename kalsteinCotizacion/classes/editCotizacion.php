<?php 

	require __DIR__ . '/conexion.php';


	$salida = "";
    $id = $_POST['consulta'];

	$query = "SELECT * FROM wp_cotizacion WHERE cotizacion_id = '$id'";
    $query2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$id'";

	$result = $conexion->query($query);
    $result2 = $conexion->query($query2);
	$row = mysqli_fetch_array($result);

	

	$sres = $row["cotizacion_sres"];
    $atc = $row["cotizacion_atencion"];
	$subtotal = $row["cotizacion_submit"];
	$desc = $row['cotizacion_descuento'];
    $subtotal2 = $row["cotizacion_subtotal"];
    $envio = $row["cotizacion_envio"];
    $total = $row["cotizacion_total"];
    $mEnvio = $row['cotizacion_metodo_envio'];
    $destino = $row['cotizacion_destino'];
    $zipcode = $row['cotizacion_zipcode'];
    $incoterm = $row['cotizacion_incoterm'];
    $divisa = $row['cotizacion_divisa'];
    $pago = $row['cotizacion_metodo_pago'];
    $data = [];



    while ($fila = $result2->fetch_assoc()){
        $aid = $fila['cotizacion_detalle_aid'];
        $model = $fila['cotizacion_detalle_model'];
        $name = $fila['cotizacion_detalle_name'];
        $cant = $fila['cotizacion_detalle_cant'];
        $valorU = $fila['cotizacion_detalle_valor_unit'];
        $valorT = $fila['cotizacion_detalle_valor_total']; 
        $valorA = $fila['cotizacion_detalle_valor_anidado'];

        $c = "SELECT * FROM wp_k_products WHERE product_model = '$model'";	

        $rs = $conexion->query($c);
        $r = mysqli_fetch_array($rs);

        if ($divisa === "EUR"){
			$price = $r["product_priceEUR"];
		}else{
			$price = $r["product_priceUSD"];
		}
		$height = $r['product_alto_paquete'];
		$width = $r['product_ancho_paquete'];
		$long = $r['product_largo_paquete'];
		$weightBruto = $r['product_peso_bruto'];
		$weightBruto = $weightBruto * $cant;

        $multi4 = $long * $width;
		$multi5 = $multi4 * $height;
		$division = $multi5 / 1000000;
		$round = round($division, 3);
		$chWeight = $round / 0.005;
		$chWeight = round($chWeight, 2);
		$weightE = $chWeight * $cant;
        $n3 = $round * $cant;
		$n3 = round($n3, 3);
			
			
			
		if ($weightE > $weightBruto){
			$weight = $weightE;	
		}else{
			$weight = $weightBruto;
		}

        $array = array( 
            'aid' => $aid,
            'model' => $model,
            'chWeight' => $weight,
            'name' => $name,
            'cant' => $cant,
            'valorU' => $valorU,
            'valorT' => $valorT,
            'valorA' => $valorA,
            'n3' => $n3,
        );

        array_push($data, $array);
    }

		

	

	$datos = array(
		'sres' => $sres,
		'atc' => $atc,
		'subtotal' => $subtotal,
		'desc' => $desc,
		'subtotal2' => $subtotal2,
		'envio' => $envio,
        'total' => $total,
        'mEnvio' => $mEnvio,
        'destino' => $destino,
        'zipcode' => $zipcode,
        'incoterm' => $incoterm,
        'divisa' => $divisa,
        'pago' => $pago,
        'data' => $data
	);



	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();
 ?>

