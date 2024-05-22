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

function calculateMAC($securityKey, $tpe, $date, $montant, $reference, $texteLibre, $version, $lgue, $societe, $contexteCommande, $mail, $urlRetourOk, $urlRetourErr, $stoprecurrence) {
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
        $urlRetourErr,
        $stoprecurrence
    ];

    $dataString = implode('*', $dataArray);
    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

// Fecha actual en el formato correcto
$date = date('d/m/Y:H:i:s');
$date_commande = date('d/m/Y'); // Fecha de la orden en el formato correcto

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

$mac = calculateMAC($securityKey, $tpe, $date, $montant, $reference, $texteLibre, $version, $lgue, $societe, $contexteCommande, $mail, $urlRetourOk, $urlRetourErr, $stoprecurrence);

$fields = [
    'version' => $version,
    'TPE' => $tpe,
    'date' => $date,
    'date_commande' => $date_commande,
    'montant' => $montant,
    'montant_a_capturer' => '0EUR',
    'montant_deja_capture' => '0EUR',
    'montant_restant' => '0EUR',
    'reference' => $reference,
    'lgue' => $lgue,
    'societe' => $societe,
    'stoprecurrence' => $stoprecurrence,
    'MAC' => $mac,
    'texte-libre' => $texteLibre,
    'contexte_commande' => $contexteCommande,
    'mail' => $mail,
    'url_retour_ok' => $urlRetourOk,
    'url_retour_err' => $urlRetourErr
];

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