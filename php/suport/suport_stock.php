<?php

require_once __DIR__ . '/../../db/conexion.php';


$cate=$_POST['category'];
$q = $conexion->real_escape_string($_POST['inputSearch']);



    if ($cate == '') {
        if ($q == ''){
                $consulta = "SELECT wp_servicios.SE_id, wp_servicios.SE_Servicio, wp_servicios.SE_category,wp_servicios.SE_description, wp_servicios.SE_agente_soporte,wp_servicios.SE_correo, wp_servicios.SE_estado, wp_account.account_url_image_perfil FROM wp_servicios inner join wp_account ON wp_servicios.SE_correo= wp_account.account_correo where SE_estado ='activado'";
        }else{
            
                $consulta = "SELECT wp_servicios.SE_id, wp_servicios.SE_Servicio, wp_servicios.SE_category,wp_servicios.SE_description, wp_servicios.SE_agente_soporte,wp_servicios.SE_correo, wp_servicios.SE_estado, wp_account.account_url_image_perfil FROM wp_servicios inner join wp_account ON wp_servicios.SE_correo= wp_account.account_correo where SE_estado ='activado' and SE_agente_soporte LIKE '$q'";
        }
    }else{
        if ($q == ''){
                $consulta = "SELECT wp_servicios.SE_id, wp_servicios.SE_Servicio, wp_servicios.SE_category,wp_servicios.SE_description, wp_servicios.SE_agente_soporte,wp_servicios.SE_correo, wp_servicios.SE_estado, wp_account.account_url_image_perfil FROM wp_servicios inner join wp_account ON wp_servicios.SE_correo= wp_account.account_correo where SE_estado ='activado' and SE_category like '$cate' ";
        }else{
                $consulta = "SELECT wp_servicios.SE_id, wp_servicios.SE_Servicio, wp_servicios.SE_category,wp_servicios.SE_description, wp_servicios.SE_agente_soporte,wp_servicios.SE_correo, wp_servicios.SE_estado, wp_account.account_url_image_perfil FROM wp_servicios inner join wp_account ON wp_servicios.SE_correo= wp_account.account_correo where SE_estado ='activado' and SE_category like '$cate`' AND SE_agente_soporte LIKE '$q'";
           
        }
    }       

$resultado = $conexion->query($consulta);

$i = 0;

$html = '
<div class="row row-cols-1 row-cols-md-3 g-4">';

if ($resultado->num_rows > 0){
    $i = 0;
    while ($value = $resultado->fetch_assoc()) {
        $i = $i + 1;
        $id = $value['SE_id'];
        $service = $value['SE_Servicio'];
       $usuario = $value['SE_agente_soporte'];
       $correo=$value['SE_correo'];
        $precio = $value['SE_precio'];
        $category = $value['SE_category'];
        $desccription=$value['SE_description'];
        $image=$value['account_url_image_perfil'];

        $firstLyricsName = strtoupper($usuario[0]);
        if ($image == ''){
            $urlImagePerfil = 'http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/'.$firstLyricsName.'/'.$firstLyricsName.'.png';
        }else{
            $urlImagePerfil = 'http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$image;
        }
        $html.= "                                    
           <div class='col'>
  <div class='card' style='width: 18rem;'>
  <img src='$urlImagePerfil' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>$service</h5>
    <p class='card-text'>$desccription</p>
  </div>
  <ul class='list-group list-group-flush'>
    <li class='list-group-item'>$usuario</li>
    <li class='list-group-item'>$correo</li>
    <li class='list-group-item'>$category</li>
  </ul>
  <div class='card-body'>
    <button type='button' class='btn btn-info btn-block' id='add_report'
                                 value='$id'>solicitar servicio</button>
  </div>
</div>
  </div>
 
";
    }

    $msjNoData = "";
}else{
    $msjNoData = "
        <div class='contentNoDataQuote'>
        <center><span class='material-symbols-rounded  icon'>sentiment_dissatisfied</span></center>
            <center><p style='color: #000;'>No data found</p></center>
        </div>
    ";
}

$html.= "
       </div>
    $msjNoData
";

 

echo $html;
$conexion->close();