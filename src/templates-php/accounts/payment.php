<?php
//ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
//session_start();

//EMAIL ACCOUNT SESSION.
if(isset($_SESSION["emailAccount"])){
    $email = $_SESSION["emailAccount"];
}

//LANGUAGE FOR THE TEXT OF LOADER.
$esText = '<h2>Redirigiendo a pasarela de pago</h2>';
$enText = '<h2>Redirecting to Payment Gateway</h2>';

//PAYMENT GATEWAY URL (MONETICO).

function encryptURL() {
    $gateway = base64_encode('https://p.monetico-services.com/test/paiement.cgi');
    return $gateway; 
}

//ENCRYPT GET
$getSuccess = base64_encode('success');
$getDeclined = base64_encode('declined');

//GET VARIABLE.
$idCotizacion = $_GET["idCotizacion"];
$idCotizacionEncrypted = base64_encode($idCotizacion);

//MAIN QUERYS
$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_id LIKE '%$idCotizacion%'";
$row = $conexion->query($consulta)->fetch_assoc();
$precioTotal = $row['cotizacion_total'] - $row['cotizacion_total_with_discount'];

$consulta2 = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$row2 = $conexion->query($consulta2)->fetch_assoc();

$consulta3 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$idCotizacion'";
$productList = array();
$resultado = $conexion->query($consulta3);

if ($resultado) {
    while($row3 = $resultado->fetch_assoc()) {
        $productList[] = array(
            'producto' => $row3['cotizacion_detalle_name'], 
        );
    }
} else {
    echo "Error:" . $conexion->error;
}

//COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\PurchaseRequest;
use DansMaCulotte\Monetico\Resources\BillingAddressResource;
use DansMaCulotte\Monetico\Resources\ShippingAddressResource;
use DansMaCulotte\Monetico\Resources\ClientResource;

$monetico = new Monetico(
    '7590531', 
    '530C185A56C2A9F904681A527780EBDB8C0E6C99', 
    'kalsteinfr' 
);

function formatProductListDescription($productList) {
    $descriptionParts = [];
    foreach ($productList as $product) {
        $sanitizedProduct = sanitizeAndLimit($product['producto'], 50); 
        $descriptionParts[] = $sanitizedProduct;
    }

    $fullDescription = implode(", ", $descriptionParts);
    return sanitizeAndLimit($fullDescription, 200); 
} 
 

function sanitizeAndLimit($input, $maxLength)
{
    $sanitized = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
    $limited = substr($sanitized, 0, $maxLength);
    return $limited;
}

$addressLine1 = sanitizeAndLimit($row2['account_direccion'], 50); 

$purchase = new PurchaseRequest([
    'reference' => 'QUO' .$idCotizacion,
    'description' => formatProductListDescription($productList),
    'language' => 'ES',
    'email' => $email,
    'amount' => $precioTotal, 
    'currency' => $row['cotizacion_divisa'],
    'dateTime' => new DateTime(),
    'successUrl' => 'https://dev.kalstein.plus/plataforma/pago-aprobado?pay='.$getSuccess.'&idCotizacion='.$idCotizacionEncrypted.'', 
    'errorUrl' => 'https://dev.kalstein.plus/plataforma/pago-rechazado?pay='.$getDeclined.'&idCotizacion='.$idCotizacionEncrypted.'',
]);

$billingAddress = new BillingAddressResource([
    'name' => $row2['account_nombre'],
    'addressLine1' => $addressLine1,
    'city' => $row2['account_ciudad'],
    'postalCode' => $row2['account_zipcode'],
    'country' => $row2['account_pais'],
]);

$purchase->setBillingAddress($billingAddress);
$shippingAddress = new ShippingAddressResource([
    'name' => $row['cotizacion_atencion'],
    'addressLine1' => $addressLine1,
    'city' => $row2['account_ciudad'],
    'postalCode' => $row['cotizacion_zipcode'],
    'country' => empty($row['cotizacion_destino']) ? 'FR' : $row['cotizacion_destino'],
]);

$purchase->setShippingAddress($shippingAddress);


$client = new ClientResource([
    'firstName' => $row2['account_nombre'],
    'lastName' => $row2['account_apellido'],
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
