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

//PAYMENT GATEWAY URL (MONETICO).

function encryptURL()
{
    $gateway = base64_encode('https://p.monetico-services.com/test/paiement.cgi');
    return $gateway;
}

//GET VARIABLE.
if (!isset($_GET["idMembership"])) {
    die('Error');
}
$idMembership = $_GET["idMembership"];

$membershipPrices = [
    'SUB1' => 10,
    'SUB2' => 20
];

if (!isset($membershipPrices[$idMembership])) {
    die('Error: No price.');
}

$membershipPrice = $membershipPrices[$idMembership];

//MAIN QUERYS
$consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$row = $conexion->query($consulta)->fetch_assoc();

$consulta2 = "SELECT tipo_membresia FROM wp_account WHERE account_correo = '$email'";
$resultado = $conexion->query($consulta2);

if ($resultado) {
    if ($resultado->num_rows > 0) {
        $row2 = $resultado->fetch_assoc();
        $tipo_membresia = $row['tipo_membresia'];

        if ($tipo_membresia == 0) {
            $id_unico = uniqid(md5($email), true);

            $updateQuery = "UPDATE wp_account SET account_sub_id = '$id_unico' WHERE account_correo = '$email'";
            if ($conexion->query($updateQuery) === TRUE) {
                //echo "ID Generated.";
            } else {
                //echo "Error updating: " . $conexion->error;
            }
        } else {
            //echo "The user doesn't require a Uniqid.";
        }
    } else {
        //echo "User not found.";
    }
} else {
    echo "Error executing the query: " . $conexion->error;
}

$reference = $idMembership . '-' . $row['user_tag'] . '-' . time();

//COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\PurchaseRequest;
use DansMaCulotte\Monetico\Resources\BillingAddressResource;
use DansMaCulotte\Monetico\Resources\ShippingAddressResource;
use DansMaCulotte\Monetico\Resources\ClientResource;

$monetico = new Monetico(
    '7593339',
    '255D023E7A0BDE9EEAC7516959CD93A9854F3991',
    'kalsteinfr'
);

$purchase = new PurchaseRequest([
    'reference' => '1234567',
    'description' => 'uniqid: ' . $row['account_sub_id'],
    'language' => 'ES',
    'email' => $row['account_correo'],
    'amount' => $membershipPrice,
    'currency' => 'USD',
    'dateTime' => new DateTime(),
    'successUrl' => 'https://dev.kalstein.plus/plataforma/subscripcion-aprobada/',
    'errorUrl' => 'https://dev.kalstein.plus/plataforma/failed-subscripcion-k/',
]);

$billingAddress = new BillingAddressResource([
    'name' => $row['account_nombre'],
    'addressLine1' => $row['account_direccion'],
    'city' => $row['account_ciudad'],
    'postalCode' => $row['account_zipcode'],
    'country' => $row['account_pais']
]);

$purchase->setBillingAddress($billingAddress);

$client = new ClientResource([
    'firstName' => $row['account_nombre'],
    'lastName' => $row['account_apellido'],
]);
$purchase->setClient($client);

$url = base64_decode(encryptURL());
$fields = $monetico->getFields($purchase);


?>
<html>

<body onload="document.forms['payment_form'].submit();">
    <style>
        .custom-loader {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background:
                radial-gradient(farthest-side, #322380 94%, #0000) top/8px 8px no-repeat,
                conic-gradient(#0000 30%, #322380);
            -webkit-mask: radial-gradient(farthest-side, #0000 calc(100% - 8px), #000 0);
            animation: s3 1s infinite linear;
        }

        @keyframes s3 {
            100% {
                transform: rotate(1turn)
            }
        }
    </style>
    <form name="payment_form" action="<?php echo $url; ?>" method="post">
        <?php foreach ($fields as $key => $value) : ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php endforeach; ?>
        <!--input type="submit" value="Pagar con Monetico"-->
        <center><?php echo $esText ?></center>
        <center>
            <div class="custom-loader"></div>
        </center>
    </form>
</body>

</html>