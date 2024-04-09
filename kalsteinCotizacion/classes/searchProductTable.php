<?php 
	require __DIR__ . '/conexion.php';

	$salida = "";

	$consulta = "SELECT * FROM wp_k_products LIMIT 0, 19";

    if (isset($_POST['consulta'])) {
		$q = $conexion->real_escape_string($_POST['consulta']);
		$consulta = "SELECT * FROM wp_k_products WHERE product_model LIKE '%".$q."%' OR product_name LIKE '%".$q."%' LIMIT 0, 19";
	}
		
		
	$resultado = $conexion->query($consulta);
		
	if ($resultado->num_rows > 0) {
		while ($value = $resultado->fetch_assoc()) {
            $aid = $value['product_aid'];
            $model = $value["product_model"];
            $name = $value['product_name_en'];
            $netWeight = $value["product_peso_neto"];
            $grossWeight = $value["product_peso_bruto"];  
            $height = $value["product_alto"];
            $width = $value["product_ancho"];
            $long = $value["product_largo"];
            $height1 = $value["product_alto_paquete"];
            $width1 = $value["product_ancho_paquete"];
            $long1 = $value["product_largo_paquete"]; 
            $priceUSD = $value['product_priceUSD'];
            $priceEUR = $value['product_priceEUR'];
            $image = $value['product_image'];

                $salida.="
                    <tr>
                        <td class='fw-bold' style='text-align: center; padding-top: 17mm;'>
                            <div>
                                <div>$name</div>
                            </div>
                        </td>
                        <td style='text-align: center;'>
                            <div>
                                <div style=''>
                                    <div style='font-weight: bold; background-color: #424242; color: #fff; height: 8mm;'>Net</div>
                                    <div style='background-color: #c1c1c1; height: 10mm; padding-top: 1mm; font-weight: bold;'>$netWeight kg</div>
                                </div>
                                <div style=''>
                                    <div style='font-weight: bold; background-color: #424242; color: #fff; height: 8mm;'>Gross</div>
                                    <div style='background-color: #c1c1c1; height: 10mm; padding-top: 1mm; font-weight: bold;'>$grossWeight kg</div>
                                </div>
                            </div>
                        </td>
                        <td style='text-align: center;'>
                            <div>
                                <div style=''>
                                    <div style='font-weight: bold; background-color: #424242; color: #fff; height: 8mm;'>Machine</div>
                                    <div style='background-color: #c1c1c1; height: 10mm; padding-top: 1mm; font-weight: bold;'>$long x $width x $height cm³</div>
                                </div>
                                <div style=''>
                                    <div style='font-weight: bold; background-color: #424242; color: #fff; height: 8mm;'>Packing</div>
                                    <div style='background-color: #c1c1c1; height: 10mm; padding-top: 1mm; font-weight: bold;'>$long1 x $width1 x $height1 cm³</div>
                                </div>
                            </div>
                        </td>
                        <td style='text-align: center;'>
                            <div>
                                <div style=''>
                                    <div style='font-weight: bold; background-color: #424242; color: #fff; height: 8mm;'>USD</div>
                                    <div style='background-color: #c1c1c1; height: 10mm; padding-top: 1mm; font-weight: bold;'>$priceUSD $</div>
                                </div>
                                <div style=''>
                                    <div style='font-weight: bold; background-color: #424242; color: #fff; height: 8mm;'>EUR</div>
                                    <div style='background-color: #c1c1c1; height: 10mm; padding-top: 1mm; font-weight: bold;'>$priceEUR €</div>
                                </div>
                            </div>
                        </td>
                        <td style='padding-top: 10mm;'>
                        <button value='$aid' id='editProduct' style='width: 100%;' class='btn btn-warning' data-bs-toggle='modal' data-bs-target='#editP'>Edit</button>
                        <button value='$model' id='deleteP' style='width: 100%; margin-top: 2mm;' class='btn btn-danger' data-bs-toggle='modal' data-bs-target='#deleteProduct'>Delete</button>
                        </td>
                    </tr>
                ";
		}
	
		$salida.="</tbody></table>";
	} else {
		$salida.="<div class='nodatos'><h5>No data found in your search</h5></div>";
	}
	
	echo $salida;
	$conexion->close();
 ?>
