<?php
  session_start();
  if(isset($_SESSION["emailAccount"])){
      $email = $_SESSION["emailAccount"];
  }
  require_once '/conexion.php';

  $imageProfile = $_FILES['imageTaxDocument']['name'];
  $extension = pathinfo($imageProfile, PATHINFO_EXTENSION);
  $newName = uniqid().".".$extension;
  $path = __DIR__ . '/../src/images/images-verify/';
  $uploadFile = $path . basename($newName);
  $idCard = $_POST['numberTaxCompany'];
  move_uploaded_file($_FILES['imageTaxDocument']['tmp_name'], $uploadFile);

  $query = "UPDATE wp_company SET company_rif = '$idCard', company_image_rif = '$newName' WHERE company_account_correo = '$email'";
  if ($conexion->query($query) === TRUE){
    $update = 'correcto';
  }else{
    $update = 'incorrecto';
  }

  $datos = array(
    'update' => $update
);

echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();