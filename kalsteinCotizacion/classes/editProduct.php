<?php

    require __DIR__ . '/conexion.php';

    $salida = "";
    $aid = $_POST['consulta'];

    $query = "SELECT * FROM wp_k_products WHERE product_aid = '$aid'";

    $result = $conexion->query($query);
	$row = mysqli_fetch_array($result);

    $model = $row["product_model"];
    $name = $row['product_name'];
    $netWeight = $row["product_peso_neto"];
    $grossWeight = $row["product_peso_bruto"];  
    $height = $row["product_alto"];
    $width = $row["product_ancho"];
    $long = $row["product_largo"];
    $height1 = $row["product_alto_paquete"];
    $width1 = $row["product_ancho_paquete"];
    $long1 = $row["product_largo_paquete"]; 
    $priceUSD = $row['product_priceUSD'];
    $priceEUR = $row['product_priceEUR'];

    $datos = array(
		'model' => $model,
        'name' => $name,
        'netWeight' => $netWeight,
        'grossWeight' => $grossWeight,
        'height' => $height,
        'width' => $width,
        'long' => $long,
        'height1' => $height1,
        'width1' => $width1,
        'long1' => $long1,
        'priceUSD' => $priceUSD,
        'priceEUR' => $priceEUR
	);



	echo json_encode($datos, JSON_FORCE_OBJECT);
	$conexion->close();
?>