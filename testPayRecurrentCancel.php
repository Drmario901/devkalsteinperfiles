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

function calculateMAC($securityKey, $fields) {
    ksort($fields); 
    $dataString = '';
    foreach ($fields as $value) {
        $dataString .= $value . '*';
    }
    $dataString = rtrim($dataString, '*'); 
    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

$date = date('d/m/Y_a_H:i:s'); 
$date_commande = date('d/m/Y'); 

$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = '20.00USD';
$reference = 'Membresia-SUB2-@valfonsob12-1716406357';
$texteLibre = 'uniqid: c15a3f97b46c7ce010e5a49ec3b6b3a2664e4678ae4ba5.59995320';
$version = '3.0';
$lgue = 'ES';
$societe = 'kalsteinfr';
$stoprecurrence = 'OUI';

$fields = [
    'version' => $version,
    'TPE' => $tpe,
    'date' => $date,
    'montant' => $montant,
    'reference' => $reference,
    'texte-libre' => $texteLibre,
    'lgue' => $lgue,
    'societe' => $societe,
    'stoprecurrence' => $stoprecurrence
];

$mac = calculateMAC($securityKey, $fields);

$fields['MAC'] = $mac;

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
