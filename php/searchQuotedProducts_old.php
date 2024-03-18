<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once '../db/conexion.php';

    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' ORDER BY cotizacion_id DESC";
    $resultado = $conexion->query($consulta);
    $count = 0;

    $html = "
        <table>
            <tbody>
    ";

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $id = $value["cotizacion_id"];
            $consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$id'";
            $resultado2 = $conexion->query($consulta2);
            if ($resultado2->num_rows > 0){
                while ($valor = $resultado2->fetch_assoc()){
                    $nameProducto = $valor['cotizacion_detalle_name'];
                    $priceProducto = $valor['cotizacion_detalle_valor_unit'];
                    $imgProducto = $valor['cotizacion_detalle_image'];

                    if ($i >= 3){
                        break;
                    }else{
                        $i = $i + 1;
                        $html.= "
                            
                            <tr class='content-td'>
                                <td class='imgProduct'><img src='$imgProducto' style='height: 5rem; margin: 0 auto;'></td>
                                <td class='descriptionProduct'>
                                    <p class='fw-bold'>$nameProducto</p>
                                    <p style='color: #69707a; font-size: 0.7em;'>USD$$priceProducto</p>
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
                <p>No data found</p>
            </div>
        ";
    }

    $html.= "
            </tbody>
        </table>
        $msjNoData
    ";

    echo $html;
    $conexion->close();