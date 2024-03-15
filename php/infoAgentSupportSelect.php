<?php
  require __DIR__ .'../db/conexion.php';
  include_once './translations.php';
  $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
  $id = $_POST['consulta'];

  //Traducciones de la página
  $agente_soporte = $translations[$lang]['client:agenteSoporte'];
  $categoria = $translations[$lang]['client:categoria'];
  $descripcion = $translations[$lang]['client:descripcion'];
  $selectOption = $translations[$lang]['client:eligeOpcion'];
  $other = $translations[$lang]['other'];

  //Resto del codigo

  $sql = "SELECT * FROM wp_servicios WHERE SE_id = '$id'";
  $resultado = $conexion->query($sql);
  $row = mysqli_fetch_array($resultado);
  $email = $row['SE_correo'];
  $description = $row['SE_description'];
  $categorie = $row['SE_category'];

  $sql2 = "SELECT * FROM wp_account WHERE account_correo = '$email'";
  $resultado2 = $conexion->query($sql2);
  $row2 = mysqli_fetch_array($resultado2);
  $name = $row2['account_nombre'];
  $lastname = $row2['account_apellido'];

  $nameAgent = '<input type="hidden" id="emailAgent" value="'.$email.'"/><input type="hidden" id="idServices" value="'.$id.'"/><b>'.$agente_soporte.'</b> '.$name.' '.$lastname;
  $descriptionService = "<b>$descripcion:</b> $description";

  $categorieService = "<b>$categoria:</b> .$categorie";
  
  $html = "<option selected value='0'>$selectOption</option>";
  $sql3 = "SELECT * FROM wp_k_products WHERE product_category = '$categorie'";
  $resultado3 = $conexion->query($sql3);
  
  while ($model = $resultado3->fetch_assoc()){
    $html .= '<option value="'.$model['product_model'].'">'.$model['product_model'].' - '.$model['product_brand'].'</option>';
  }
  $html .= "<option value='Other'>$other</option>";

  $datos = array(
    'nameAgent' => $nameAgent,
    'descriptionService' => $descriptionService,
    'categorieService' => $categorieService,
    'categorie' => $html
  );

  echo json_encode($datos, JSON_FORCE_OBJECT);

  ?>
