<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

// FUNCION PARA CODIFICAR URL
function encryptURL()
{
    $gateway = base64_encode('https://p.monetico-services.com/test/paiement.cgi');
    return $gateway;
}

// LANGUAGE FOR THE TEXT OF LOADER.
$esText = '<h2>Redirigiendo a pasarela de pago</h2>';

// COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\CancelRequest;

$monetico = new Monetico(
    '7593339',
    '255D023E7A0BDE9EEAC7516959CD93A9854F3991',
    'kalsteinfr'
);

$cancel = new CancelRequest([
    'dateTime' => new DateTime(),
    'orderDate' => new DateTime(),
    'reference' => '11111',
    'language' => 'ES',
    'currency' => 'USD',
    'amount' => 20,
    'amountRecovered' => 20,
]);

$fields = $monetico->getFields($cancel);
$encodedUrl = base64_decode(encryptURL()); 

?>
<html>
<body onload="document.forms['cancel_form'].submit();">
    <form name="cancel_form" action="<?php echo $encodedUrl; ?>" method="post">
        <?php foreach ($fields as $key => $value): ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php endforeach; ?>
        <center><?php echo $esText ?></center>
        <center><div class="custom-loader"></div></center>
    </form>
</body>
</html>
