<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
if(isset($_SESSION["emailAccount"])){
    $email = $_SESSION["emailAccount"];
}

require_once __DIR__ . '/../db/conexion.php';

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' ORDER BY cotizacion_id DESC LIMIT 10";
$resultado = $conexion->query($consulta);

require_once 'translateText.php';
require_once 'translations.php';


translateText();

$quoteId = $translations[$lang]['client:quote'];
$fecha = $translations[$lang]['client:fechaTable'];
$dataNotFound = $translations[$lang]['client:dataNotFound'];

$html = ""; // Inicializar $html como una cadenad vacía

// Inicia la tabla antes del bucle
$html .= "
<table>
    <thead style='background-color: #808186; color: white;'>
        <tr>
            <th>$quoteId ID</th>
            <th>$fecha</th>
        </tr>
    </thead>
    <tbody>
";

if ($resultado->num_rows > 0){
    while ($value = $resultado->fetch_assoc()) {
        $id = $value["cotizacion_id"];
        $date = $value['cotizacion_create_at'];
        $date = new DateTime($date);
        $newData = date_format($date, 'Y-m-d');

        // Añade cada fila con los datos correspondientes
        $html .= "                                    
            <tr style='height: 3.2rem; '>
                <td style='padding-top: 0.9rem;'> $id</td>
                <td style='padding-top: 0.9rem;'> $newData</td>
            </tr>
        ";
    }
} else {
    // Mensaje si no hay datos
    $html .= "
        <tr>
            <td colspan='2'>$dataNotFound</td>
        </tr>
    ";
}

// Cierra tbody y table
$html .= "
    </tbody>
</table>
";

echo $html;
$conexion->close();