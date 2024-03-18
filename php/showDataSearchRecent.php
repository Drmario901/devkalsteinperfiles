<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require_once '../db/conexion.php';

    $consulta = "SELECT * FROM wp_register_searches WHERE account_id = '$email' ORDER BY aid_searches DESC LIMIT 10";
    $resultado = $conexion->query($consulta);

    $i = 0;

    include 'translateText.php';
    translateText();

    $html = "
        <table class='table'>
            <thead class='headTableForQuoteRecent'>
                <tr>
                    <td scope='col' data-i17n='client:terminoDeBusqueda'>Término de búsqueda</td>
                    <td scope='col' data-i17n='client:fechaTable'>Fecha</td>
                </tr>
            </thead>
            <tbody class='bodyTableForQuote'>
    ";

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 01;
            $tags = $value["searches_description"];
            $date = $value['searches_date'];
            $date = new DateTime($date);
            $newData = date_format($date, 'Y-m-d');

            if ($tags == ''){
                $tags = 'Todas';
            }else{
                $tags = $tags;
            }

            $html.= "                                    
                <tr style='height: 3.2rem;'>
                    <td style='padding-top: 0.9rem;'>$tags</td>
                    <td style='padding-top: 0.9rem;'>$newData</td>
                </tr>
            ";
		}

        $msjNoData = "";
    }else{
        $msjNoData = "
            <div class='contentNoDataQuoteRecent'>
                <i class='fa-solid fa-magnifying-glass' style='font-size: 4rem; color: #212380;  margin-top: 12rem;'></i>
                <p style='font-size: 1.4em; font-weight: bold; margin-top: 2rem;width: 90%; margin-left: 5%;' data-i17n='client:verBusquedas' >¡Aquí puedes ver todas tus búsquedas en Kalstein!</p>
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