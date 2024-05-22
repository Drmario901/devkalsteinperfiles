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
    // Concatenate fields in alphabetical order
    ksort($fields);
    $dataString = '';
    foreach ($fields as $key => $value) {
        $dataString .= $value . '*';
    }
    $dataString = rtrim($dataString, '*'); // Remove the last '*'
    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

// Fecha explícita en el formato correcto
$date = '22/05/2024:16:56:33';
$date_commande = '22/05/2024';

// Resto de los parámetros
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = '10.00USD';
$reference = 'QUO23424';
$texteLibre = 'uniqid: c15a3f97b46c7ce010e5a49ec3b6b3a2664e237282ee17.49368007';
$version = '3.0';
$lgue = 'ES';
$societe = 'kalsteinfr';
$contexteCommande = 'eyJiaWxsaW5nIjp7Im5hbWUiOiJWaWN0b3IiLCJhZGRyZXNzTGluZTEiOiJkZmhmZGhnaGQiLCJjaXR5IjoiaGRoZmRoZCIsInBvc3RhbENvZGUiOiIxMjMzIiwiY291bnRyeSI6IkFaIn0sImNsaWVudCI6eyJmaXJzdE5hbWUiOiJWaWN0b3IiLCJsYXN0TmFtZSI6IkRpc3RyaWJ1aWRvciJ9fQ==';
$mail = 'valfonsob12@yopmail.com';
$urlRetourOk = 'https://dev.kalstein.plus/plataforma/subscripcion-aprobada/';
$urlRetourErr = 'https://dev.kalstein.plus/plataforma/failed-subscripcion-k/';
$stoprecurrence = 'OUI';

// Crear arreglo de campos
$fields = [
    'TPE' => $tpe,
    'date' => $date,
    'date_commande' => $date_commande,
    'montant' => $montant,
    'montant_a_capturer' => '0.00USD',
    'montant_deja_capture' => '0.00USD',
    'montant_restant' => '0.00USD',
    'reference' => $reference,
    'texte-libre' => $texteLibre,
    'version' => $version,
    'lgue' => $lgue,
    'societe' => $societe,
    'contexte_commande' => $contexteCommande,
    'mail' => $mail,
    'url_retour_ok' => $urlRetourOk,
    'url_retour_err' => $urlRetourErr,
    'stoprecurrence' => $stoprecurrence
];

ksort($fields); // Asegura que los datos estén en orden alfabético por clave

$mac = calculateMAC($securityKey, $fields);

$fields['MAC'] = $mac;

$url = "https://p.monetico-services.com/test/capture_paiement.cgi";

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