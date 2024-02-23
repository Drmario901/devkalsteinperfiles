<?php

session_start();
require __DIR__ . '/conexion.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$json = file_get_contents('php://input');
/* $json = $_POST['datos']; */
$data = json_decode($json, true);

$name        = $data["nombre"];
$apellido    = $data["apellido"];
$profileRole = $data['profileRole'];
$addressUser = $data['addressUser'];
$countryUser = $data['countryUser'];
$stateUser   = $data['stateUser'];
$zipcodeUser = $data['zipcodeUser'];
$phoneUser   = $data['phoneUser'];
$idDocument  = $data['idDocument'];
$newName     = $data["newName"];
$accStatus   = $data['accStatus'];
$email       = $data["email"];
$contrasena  = md5($data["contrasena"]);
$user_tag    = $data['user_tag'];
$account_session = $data["account_session"];

/* $profile = $_POST["profileRole"];
$user_tag = $_POST["user_tag"];
$account_session = $_POST["account_session"]; */

$insert = "INSERT INTO account_session (ac_user, ac_nombre, ac_apellido, ac_contrasena, ac_session, profileRole, addressUser, countryUser, stateUser, zipcodeUser, phoneUser, idDocument, accStatus, user_tag) VALUES ('$email', '$name', '$apellido', '$contrasena', '$account_session', '$profileRole', '$addressUser', '$countryUser', '$stateUser', '$zipcodeUser', '$phoneUser', '$idDocument', '$accStatus', '$user_tag' )";
    $conexion->query($insert);

   /* $sql = "SELECT * FROM account_session WHERE ac_user = '$name'";
   
   $res = $conexion->query($sql);

   while($fetch = mysqli_fetch_array($res)){
    echo $fetch["ac_user"];
   }

   $data = array(
       "user" => $fetch["ac_user"],
   );
 */
/* $data = array(
    "session" => $account_session
);
    echo json_encode($data, JSON_FORCE_OBJECT); */



/* $sql = "SELECT * FROM `wp_account` ORDER BY `account_rol_aid` LIKE '%6%' DESC LIMIT 1";
$res = $conexion->query($sql);
 */
/* if($fetch = mysqli_fetch_array($res)){
    $insert = "INSERT INTO account_session (ac_user) VALUES ('$user_tag')";
    $conexion->query($insert);
} */
?>