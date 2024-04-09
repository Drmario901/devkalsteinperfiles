<?php
session_start();
header('Content-Type: application/json');
require __DIR__. '/../classes/conexion.php';

if (isset($_SESSION['emailAccount'])){
    $user = $_SESSION['emailAccount'];
}else{
    $user = '';
}

$modelo = $_POST['modelo'];

/* include 'conexion.php'; */
$sql = "SELECT * FROM wp_k_products WHERE product_model = '$modelo'";
$result = $conexion->query($sql);
$row = mysqli_fetch_array($result);
$maker = $row['product_maker'];

if ($maker == $user){
    $coinciden = "correcto";
}
else{
    $coinciden = "incorrecto";
}

$data = array(
    /* 'id' => $res['account_correo'], */
    'respuesta' => $coinciden,
);

echo json_encode($data);

?>