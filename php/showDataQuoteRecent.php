<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once '/conexion.php';

    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' ORDER BY cotizacion_id DESC LIMIT 10";
    $resultado = $conexion->query($consulta);

    $i = 0;
    
    include 'translateText.php';

    translateText();

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 01;
            $id = $value["cotizacion_id"];
            $date = $value['cotizacion_create_at'];
            $date = new DateTime($date);
            $newData = date_format($date, 'Y-m-d');

            $html.= "                                    
                <tr style='height: 3.2rem;'>
                    <td style='padding-top: 0.9rem;'>QUO$id</td>
                    <td style='padding-top: 0.9rem;'>$newData</td>
                </tr>
            ";
		}

        $msjNoData = "";
    }else{
        $msjNoData = "
            <div class='contentNoDataQuoteRecent'>
                <i class='fa-solid fa-file-lines' style='font-size: 4rem; color: #212380; margin-top: 12rem;'></i>
                <p style='font-size: 1.4em; font-weight: bold; margin-top: 2rem;' data-i17n='client:seeQuotesHere'>Aquí puedes ver todas tus cotizaciones.</p>
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