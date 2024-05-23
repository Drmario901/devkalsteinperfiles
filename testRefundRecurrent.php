<?php
//ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

//EMAIL ACCOUNT SESSION.
if (isset($_SESSION["emailAccount"])) {
  $email = $_SESSION["emailAccount"];
}
//$email = 'valfonsob12@yopmail.com';

//LANGUAGE FOR THE TEXT OF LOsADER.
$esText = '<h2>Redirigiendo a pasarela de pago</h2>';
//$enText = '<h2>Redirecting to Payment Gateway</h2>';

$emailUser = $_GET["emailUser"];

echo 'aaaaa ' .  $emailUser;

//PAYMENT GATEWAY URL (MONETICO).

function encryptURL()
{
  $gateway = base64_encode('https://p.monetico-services.com/test/paiement.cgi');
  return $gateway;
}

//GET VARIABLE.
if (!isset($_GET["emailUser"])) {
  die('Error');
}

// MAIN QUERIES
$consulta = "SELECT * FROM wp_account WHERE account_correo = '$emailUser'";

$response = $conexion->query($consulta);
if ($response) {
  if ($response->num_rows > 0) {
    $row = $response->fetch_assoc();
    $account_aid = $row['account_aid'];
  } else {
    die('No account found for this email.');
  }
} else {
  die('Query error: ' . $conexion->error);
}

echo 'el idddd ' . $account_aid;

$consulta2 = "SELECT referencia_pago FROM wp_account WHERE user_id = '$account_aid'";

$response2 = $conexion->query($consulta2);
if ($response2) {
  if ($response2->num_rows > 0) {
    $row2 = $response2->fetch_assoc();
    $referencia_pago = $row2['referencia_pago'];
  } else {
    die('No payment reference found for this account.');
  }
} else {
  die('Query error: ' . $conexion->error);
}

echo 'el idddd pero de ' . $referencia_pago;


// if ($row) {
//   if ($row->num_rows > 0) {
//   }
// }
// $resultado = $conexion->query($consulta2);

// if ($resultado) {
//   if ($resultado->num_rows > 0) {
//     $row2 = $resultado->fetch_assoc();
//     $tipo_membresia = $row['tipo_membresia'];

//     if ($tipo_membresia == 0) {
//       $id_unico = uniqid(md5($email), true);

//       $updateQuery = "UPDATE wp_account SET account_sub_id = '$id_unico' WHERE account_correo = '$email'";
//       if ($conexion->query($updateQuery) === TRUE) {
//         //echo "ID Generated.";
//       } else {
//         //echo "Error updating: " . $conexion->error;
//       }
//     } else {
//       //echo "The user doesn't require a Uniqid.";
//     }
//   } else {
//     //echo "User not found.";
//   }
// } else {
//   echo "Error executing the query: " . $conexion->error;
// }
//Reference with max 12chars

// $reference = $idMembership . '-' . time();

// //COMPOSER DEPENDENCIES.
// require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

// use DansMaCulotte\Monetico\Monetico;
// use DansMaCulotte\Monetico\Requests\RefundRequest;
// use DansMaCulotte\Monetico\Responses\RefundResponse;

// $monetico = new Monetico(
//   '7593339',
//   '255D023E7A0BDE9EEAC7516959CD93A9854F3991',
//   'kalsteinfr'
// );


// $refund = new RefundRequest([
//   'dateTime' => new DateTime(),
//   'orderDatetime' => new DateTime(),
//   'recoveryDatetime' => new DateTime(),
//   'authorizationNumber' => '1222',
//   'reference' => 'ABC123',
//   'language' => 'FR',
//   'currency' => 'EUR',
//   'amount' => 100,
//   'refundAmount' => 50,
//   'maxRefundAmount' => 80,
// ]);

// $fields = $monetico->getFields($refund);

// $client = new GuzzleHttp\Client();
// $data = $client->request('POST', $url, $fields);
// $response = new RefundResponse($data);
