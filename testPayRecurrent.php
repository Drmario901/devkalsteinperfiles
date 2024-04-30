<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

if(isset($_SESSION["emailAccount"])){
    $email = $_SESSION["emailAccount"];
}

$email = 'marioloquendero32@gmail.com'; 

$esText = '<h2>Redirigiendo a pasarela de pago</h2>';

$idMembership = $_GET["idMembership"];

$consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$row = $conexion->query($consulta)->fetch_assoc();

if (!$row) {
    die('Error: Usuario no encontrado.');
}

$tipo_membresia = $row['tipo_membresia'];
if ($tipo_membresia == 0) {
    $id_unico = uniqid(md5($email), true);
    $updateQuery = "UPDATE wp_account SET account_sub_id = '$id_unico' WHERE account_correo = '$email'";
    if (!$conexion->query($updateQuery)) {
        die('Error al actualizar el registro: ' . $conexion->error);
    }
}

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\PurchaseRequest;
use DansMaCulotte\Monetico\Resources\BillingAddressResource;
use DansMaCulotte\Monetico\Resources\ClientResource;

$monetico = new Monetico('7593339', '255D023E7A0BDE9EEAC7516959CD93A9854F3991', 'kalsteinfr');
$purchase = new PurchaseRequest([
    'reference' => 'Membresia' . $tipo_membresia . '-' . $email,
    'description' => .$tipo_membresia. . '-' . $email,
    'language' => 'ES',
    'email' => $email,
    'amount' => '788',  
    'currency' => 'USD',
    'dateTime' => new DateTime(),
    'successUrl' => 'https://google.com/', 
    'errorUrl' => 'https://x.com/',
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

function encryptURL() {
    return base64_encode('https://p.monetico-services.com/test/paiement.cgi');
}
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
            radial-gradient(farthest-side,#322380 94%,#0000) top/8px 8px no-repeat,
            conic-gradient(#0000 30%,#322380);
        -webkit-mask: radial-gradient(farthest-side,#0000 calc(100% - 8px),#000 0);
        animation:s3 1s infinite linear;
    }

    @keyframes s3{ 
        100%{transform: rotate(1turn)}
    }
</style>
    <form name="payment_form" action="<?php echo $url; ?>" method="post">
        <?php foreach ($fields as $key => $value) : ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php endforeach; ?>
        <!--input type="submit" value="Pagar con Monetico"-->
        <center><?php echo $esText ?></center>
        <center><div class="custom-loader"></div></center>
    </form>
</body>
</html>
