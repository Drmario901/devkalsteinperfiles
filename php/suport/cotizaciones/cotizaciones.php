<?php 

// https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/cotizaciones/cotizaciones.php
 session_start();


require_once __DIR__ . '/../../../db/conexion.php';

$acc_id = $_SESSION['emailAccount'];


$consulta = "SELECT cotizacion_total FROM wp_cotizaciones WHERE cotizacion_id_remitente = $acc_id'";

echo 'hola';
// $resultado = $conexion->query($consulta);

// echo $resultado;

// if ($resultado->num_rows > 0){
//     while ($value = $resultado->fetch_assoc()) {
//         $id = $value['M_id'];
//         $nombre = $value['M_nombre_product'];
//         $imagen = $value['product_image'];
//         $pdf = $value['M_pdf'];

//         $html .= "
//         <div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-3'>
//             <div class='card h-100 mx-2'>
//             <img src='$imagen' class='card-img-top' alt='...'>
//             <div class='card-body'>
//                 <center><h5 class='card-title' style='font-size: 16px;'>$nombre</h5></center>
//                 <center><button class='_df_button' id='book1' source='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/manuals/upload/$pdf' data-i17n='client:vista'>Vista</button></center>
//             </div>
//             </div>
//         </div>
//         ";
//     }
// }

?>