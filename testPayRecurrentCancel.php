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

function calculateMAC($securityKey, $tpe, $date, $montant, $reference, $texteLibre, $version, $lgue, $societe, $contexteCommande, $mail, $urlRetourOk, $urlRetourErr) {
    $dataArray = [
        $tpe,
        $date,
        $montant,
        $reference,
        $texteLibre,
        $version,
        $lgue,
        $societe,
        $contexteCommande,
        $mail,
        $urlRetourOk,
        $urlRetourErr
    ];

    $dataString = implode('*', $dataArray);
    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$date = '22/05/2024:16:56:33';
$montant = '10USD';
$reference = 'QUO23424';
$texteLibre = 'uniqid: c15a3f97b46c7ce010e5a49ec3b6b3a2664e237282ee17.49368007';
$version = '3.0';
$lgue = 'ES';
$societe = 'kalsteinfr';
$contexteCommande = 'eyJiaWxsaW5nIjp7Im5hbWUiOiJWaWN0b3IiLCJhZGRyZXNzTGluZTEiOiJkZmhmZGhnaGQiLCJjaXR5IjoiaGRoZmRoZCIsInBvc3RhbENvZGUiOiIxMjMzIiwiY291bnRyeSI6IkFaIn0sImNsaWVudCI6eyJmaXJzdE5hbWUiOiJWaWN0b3IiLCJsYXN0TmFtZSI6IkRpc3RyaWJ1aWRvciJ9fQ==';
$mail = 'valfonsob12@yopmail.com';
$urlRetourOk = 'https://dev.kalstein.plus/plataforma/subscripcion-aprobada/';
$urlRetourErr = 'https://dev.kalstein.plus/plataforma/failed-subscripcion-k/';

$mac = calculateMAC($securityKey, $tpe, $date, $montant, $reference, $texteLibre, $version, $lgue, $societe, $contexteCommande, $mail, $urlRetourOk, $urlRetourErr);

$monetico = new Monetico(
    $tpe,
    $securityKey,
    $societe
);

$cancel = new CancelRequest([
    'dateTime' => new DateTime(),
    'orderDate' => new DateTime(),
    'reference' => $reference,
    'language' => $lgue,
    'currency' => 'USD',
    'amount' => 10.00,
    'amountRecovered' => 0.00,
    'MAC' => $mac,
]);

try {
    $fields = $monetico->getFields($cancel);
} catch (Exception $e) {
    echo "Error al obtener los campos: " . $e->getMessage();
    exit;
}

$url = "https://p.monetico-services.com/test/paiement.cgi";

?>
<html>
<body onload="document.forms['cancel_form'].submit();">
    <form name="cancel_form" action="<?php echo $url; ?>" method="post">
        <?php foreach ($fields as $key => $value): ?>
            <input type="hidden" name="<?php echo $key; ?>" value="<?php echo htmlspecialchars($value); ?>">
        <?php endforeach; ?>
        <center><div class="custom-loader"></div></center>
    </form>
</body>
</html>