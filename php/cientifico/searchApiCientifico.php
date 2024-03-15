<?php
session_start();
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

require __DIR__ . '../../db/conexion.php';

$sql = "SELECT * FROM account_session";
    $datos = [];
   
   $res = $conexion->query($sql);

   foreach($res as $fetch){
     $data = array(
        $fetch["ac_user"],
        $fetch["ac_session"] 
     );
    
     array_push($datos, $data);
   }
   /* while($fetch = mysqli_fetch_array($res)){
    echo $fetch["ac_user"];
    $datos = array(
        "user" => $fetch["ac_user"],
        "ac_session" => $fetch["ac_session"],
    );
   } */

   /* $data = array(
       "user" => $fetch["ac_user"],
   ); */

   echo json_encode($datos, JSON_FORCE_OBJECT);