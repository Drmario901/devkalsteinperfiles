<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require __DIR__ . '/conexion.php';

    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' ORDER BY cotizacion_id DESC";
    $resultado = $conexion->query($consulta);
    $count = 0;

    echo "
        <style>
            table {
                width: 100%;
            }

            .product-image {
                max-height: 5rem;
                max-width: 100%;
                display: block;
                margin: 0 auto;
            }

            .product-name {
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
                max-width: 200px;
            }
        </style>
    ";

    echo "
        <table>
            <tbody>
    ";

    include 'translateText.php';

    translateText();

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $id = $value["cotizacion_id"];
            $consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$id' AND cotizacion_detalle_parent = ''";
            $resultado2 = $conexion->query($consulta2);
            if ($resultado2->num_rows > 0){
                while ($valor = $resultado2->fetch_assoc()){
                    $id = $valor['cotizacion_detalle_id'];
                    $model = $valor['cotizacion_detalle_model'];
                    $nameProducto = $valor['cotizacion_detalle_name'];
                    $priceProducto = $valor['cotizacion_detalle_valor_unit'];

                    $consulta3 = "SELECT * FROM wp_k_products WHERE product_model = '$model'";
                    $resultado3 = $conexion->query($consulta3);
                    $row = mysqli_fetch_array($resultado3);
                    $imgProducto = $row['product_image'];

                    $maxDescripcionLength = 100; 
                    $descripcionRecortada = (strlen($nameProducto) > $maxDescripcionLength) ? substr($nameProducto, 0, $maxDescripcionLength - 3) . "..." : $nameProducto;

                    if ($i >= 3){
                        break;
                    }else{
                        $i = $i + 1;
                        echo "
                            <tr class='content-td'>
                                <td class='imgProduct'><img src='$imgProducto' class='product-image'></td>
                                <td class='descriptionProduct'>
                                    <p class='fw-bold product-name'>$descripcionRecortada</p>
                                    <Button value='$id' id='btnViewQuote' style='margin: 0 auto; color: green;'><i class='fa-solid fa-up-right-from-square'></i></Button>
                                </td>
                            </tr>
                        ";
                    }
                }
            }
		}
        $msjNoData = "";
    }else{
        $msjNoData = "
            <div class='contentNoDataQuote'>
                <i class='fa-regular fa-face-frown' style='font-size: 3em;'></i>
                <p data-i17n='client:dataNotFound'>No data found</p>
            </div>
        ";
    }

    echo "
            </tbody>
        </table>
        $msjNoData
    ";

    $conexion->close();
?>
