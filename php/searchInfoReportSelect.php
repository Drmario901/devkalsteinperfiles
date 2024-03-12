<?php

  require __DIR__ . '/conexion.php';
  include_once './translations.php';
  $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
  $id = $_POST['consulta'];

  $agente_soporte = $translations[$lang]['client:agenteSoporte'];
  $categoria = $translations[$lang]['client:categoria'];
  $servicios = $translations[$lang]['client:servicios'];
  $modelo = $translations[$lang]['client:modelo'];
  $nivel = $translations[$lang]['client:nivel'];
  $descripcion = $translations[$lang]['client:descripcion'];

  $sql = "SELECT * FROM wp_reportes WHERE R_id = '$id'";
  $resultado = $conexion->query($sql);
  $row = mysqli_fetch_array($resultado);
  $idServices = $row['R_id_servicio'];
  $email = $row['R_usuario_agente'];
  $description = $row['R_Description'];
  $categorie = $row['R_category'];
  $model = $row['R_product'];
  $level = $row['R_Nivel'];
  $status = $row['R_estado'];
  $observation = $row['R_observacion'];
  $quote = $row['R_id_cotizacion'];
  $sql2 = "SELECT * FROM wp_account WHERE account_correo = '$email'";
  $resultado2 = $conexion->query($sql2);
  $row2 = mysqli_fetch_array($resultado2);
  $name = $row2['account_nombre'];
  $lastname = $row2['account_apellido'];
  $nameAgent = $name.' '.$lastname;

  $sql3 = "SELECT * FROM wp_servicios WHERE SE_id = '$idServices'";
  $resultado3 = $conexion->query($sql3);
  $row3 = mysqli_fetch_array($resultado3);
  $nameService = $row3['SE_servicio'];

  $html = "
    <span><b>$agente_soporte:</b> $nameAgent</span>
    <span><b>$servicios:</b> $nameService</span>
    <span><b>$categoria:</b> $categorie</span>
    <span><b>$modelo:</b> $model</span>
    <span><b>$descripcion:</b> $description</span> 
    <span><b>$nivel:</b> $level</span>
    <hr>
  ";

  if ($status == 'Pendiente'){
    $html.="
      <span style='text-align: center; width: 100%; height: 4rem; padding-top: 1rem; background-color: #e38512; color: #fff;'>$status</span>
    ";
  }else{
    $html.="
      <span style='text-align: center; width: 100%; height: 4rem; padding-top: 1rem; background-color: #0eab13; color: #fff;'>$status</span><br>
      <span><b>Observation applied:</b> $observation</span><br>
      <button class='btn' id='btnViewQuoteReportClient' value='$quote' style='width: 100%; height: 4rem; padding-top: 1rem; background-color: #213280; color: #fff;'><center>Ver cotización$quote</center></button>
    ";
  }

  echo $html;