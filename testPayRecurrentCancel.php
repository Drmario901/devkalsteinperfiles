<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

// COMPOSER DEPENDENCIES.
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/vendor/autoload.php';

use GuzzleHttp\Client;

function calculateMAC($securityKey, $fields) {
    ksort($fields, SORT_STRING);

    $dataString = '';
    foreach ($fields as $key => $value) {
        $dataString .= $key . '=' . $value . '*';
    }

    $dataString = rtrim($dataString, '*');

    return strtoupper(hash_hmac('sha1', $dataString, pack('H*', $securityKey)));
}

// Datos proporcionados
$dateTime = new DateTime('now', new DateTimeZone('Europe/Paris'));
$date = $dateTime->format('d/m/Y:H:i:s'); // Formato correcto según documentación
$date_commande = $dateTime->format('d/m/Y');

// Verificar formatos de fecha
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}:\d{2}:\d{2}:\d{2}$/', $date)) {
    die('Formato de fecha "date" incorrecto. Debe ser JJ/MM/AAAA:HH:MM:SS');
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_commande)) {
    die('Formato de fecha "date_commande" incorrecto. Debe ser JJ/MM/AAAA');
}

// Resto de los parámetros
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = '10USD'; // Asegúrate de que el formato es correcto y en USD
$reference = 'SUB1-1716563690';
$texte_libre = 'uniqid: c15a3f97b46c7ce010e5a49ec3b6b3a2664f7f01063ea1.38026363  userID:@valfonsob12';
$code_retour = 'payetest';
$cvx = 'oui';
$vld = '1226';
$brand = 'VI';
$motifrefus = '';
$usage = 'inconnu';
$typecompte = 'inconnu';
$ecard = 'non';
$originecb = 'FRA';
$bincb = '00000100';
$hpancb = 'B552FD6DB65EC37C5B5C95F0E02A00841634AD86';
$ipclient = '185.28.22.84';
$originetr = 'USA';
$cbmasquee = '00000100******21';
$modepaiement = 'CB';
$authentification = 'ewogICAiZGV0YWlscyIgOiB7CiAgICAgICJsaWFiaWxpdHlTaGlmdCIgOiAiTkEiLAogICAgICAibWVyY2hhbnRQcmVmZXJlbmNlIiA6ICJjaGFsbGVuZ2VfbWFuZGF0ZWQiCiAgIH0sCiAgICJwcm90b2NvbCIgOiAiM0RTZWN1cmUiLAogICAic3RhdHVzIiA6ICJub3RfZW5yb2xsZWQiLAogICAidmVyc2lvbiIgOiAiMi4yLjAiCn0K';

$fields = [
    'TPE' => $tpe,
    'date' => $date,
    'montant' => $montant,
    'reference' => $reference,
    'texte-libre' => $texte_libre,
    'code-retour' => $code_retour,
    'cvx' => $cvx,
    'vld' => $vld,
    'brand' => $brand,
    'motifrefus' => $motifrefus,
    'usage' => $usage,
    'typecompte' => $typecompte,
    'ecard' => $ecard,
    'originecb' => $originecb,
    'bincb' => $bincb,
    'hpancb' => $hpancb,
    'ipclient' => $ipclient,
    'originetr' => $originetr,
    'cbmasquee' => $cbmasquee,
    'modepaiement' => $modepaiement,
    'authentification' => $authentification
];

$mac = calculateMAC($securityKey, $fields);

$fields['MAC'] = $mac;

$url = "https://p.monetico-services.com/test/capture_paiement.cgi";

// Enviar la solicitud de cancelación
$client = new Client();
$response = $client->request('POST', $url, [
    'form_params' => $fields
]);

$responseBody = $response->getBody()->getContents();
$responseStatusCode = $response->getStatusCode();

echo "Solicitud Enviada:<br>";
foreach ($fields as $key => $value) {   
    echo $key . ': ' . htmlspecialchars($value) . '<br>';
}

echo "<br>MAC Calculada: " . $mac . "<br>";

echo "<br>Respuesta del Servidor:<br>";
echo "Código de Estado: " . $responseStatusCode . "<br>";
echo "Cuerpo de la Respuesta: " . htmlspecialchars($responseBody) . "<br>";

if ($responseStatusCode == 200) {
    echo "Pago recurrente cancelado exitosamente.";
} else {
    echo "Error al cancelar el pago recurrente: " . $responseBody;
}
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
