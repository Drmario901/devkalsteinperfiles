<?php
  session_start();
  if(isset($_SESSION["emailAccount"])){
      $email = $_SESSION["emailAccount"];
  }
  require __DIR__ . '../db/conexion.php';

  $imageProfile = $_FILES['imageIDCard']['name'];
  $extension = pathinfo($imageProfile, PATHINFO_EXTENSION);
  $newName = uniqid().".".$extension;
  $path = __DIR__ . '/../src/images/images-verify/';
  $uploadFile = $path . basename($newName);
  $idCard = $_POST['numberIDCard'];
  move_uploaded_file($_FILES['imageIDCard']['tmp_name'], $uploadFile);

  $query = "UPDATE wp_account SET account_document = '$idCard', account_image_document = '$newName' WHERE account_correo = '$email'";
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