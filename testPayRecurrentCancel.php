<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

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
    'MAC' => ''
    'amountRecovered' => 10, 
]);

try {
    $fields = $monetico->getFields($cancel);
} catch (Exception $e) {
    echo "Error al obtener los campos: " . $e->getMessage();
    exit;
}

url = "https://p.monetico-services.com/capture_paiement.cgi";

?>
<html>
<body onload="document.forms['cancel_form'].submit();">
    <form name="cancel_form" action="<?php echo $url; ?>" method="post">
        <?php foreach ($fields as $key => $value): ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo $value; ?>">
        <?php endforeach; ?>
        <center><?php echo $esText ?></center>
        <center><div class="custom-loader"></div></center>
    </form>
</body>
</html>
