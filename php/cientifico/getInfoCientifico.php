<?php
session_start();
require __DIR__.'../../db/conexion.php';

/* if (isset($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];
} else {
    $email = '';
    echo "no esta virificado";
} */

 var_dump ($user = $_POST["newName"]);
echo $nombre = $_POST["nombre"];
echo $apellido = $_POST["apellido"];
echo $profileRole = $_POST["profileRole"];
echo $contrasena = $_POST["contrasena"];
echo $addressUser = $_POST["addressUser"];
echo $countryUser = $_POST["countryUser"];
echo $stateUser = $_POST["stateUser"];
echo $zipcodeUser = $_POST["zipcodeUser"];
echo $phoneUser = $_POST["phoneUser"];
echo $idDocument = $_POST["idDocument"];
echo $accStatus = $_POST["accStatus"];
echo $user_tag = $_POST["user_tag"];

$query = "INSERT INTO `account_session`(`ac_user`, `ac_nombre`, `ac_apellido`, `ac_contrasena`, `ac_session`, `profileRole`, `addressUser`, `countryUser`, `stateUser`, `zipcodeUser`, `phoneUser`, `idDocument`, `accStatus`, `user_tag`) VALUES ('$user','$nombre', '$apellido', '$contrasena', '$profileRole', '$addressUser', '$countryUser', '$stateUser', '$zipcodeUser', '$phoneUser', '$idDocument', '$accStatus', '$user_tag') ";
if ($connection->query($query)) {
    echo "Se ha creado correctamente";
}



?>