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
    // Ordenar los campos alfabéticamente por clave
    ksort($fields);
    
    // Crear el string de datos concatenando los valores de los campos
    $dataString = '';
    foreach ($fields as $value) {
        $dataString .= $value . '*';
    }
    // Eliminar el último asterisco
    $dataString = rtrim($dataString, '*');
    
    // Calcular el HMAC-SHA1
    return strtoupper(hash_hmac('sha1', $dataString, $securityKey));
}

// Datos proporcionados
$date = '23/05/2024_a_16:26:35'; // Fecha y hora de la transacción original
$date_commande = '23/05/2024'; // Solo la fecha de la transacción original

// Asegurarse de que las fechas están en el formato correcto
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}_a_\d{2}:\d{2}:\d{2}$/', $date)) {
    die('Formato de fecha "date" incorrecto. Debe ser dd/mm/yyyy_a_hh:mm:ss');
}
if (!preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $date_commande)) {
    die('Formato de fecha "date_commande" incorrecto. Debe ser dd/mm/yyyy');
}

// Resto de los parámetros
$securityKey = '255D023E7A0BDE9EEAC7516959CD93A9854F3991';
$tpe = '7593339';
$montant = '10.00USD'; // Asegurarse de que el monto esté en el formato correcto
$montant_a_capturer = '0.00USD';
$montant_deja_capture = '0.00USD';
$montant_restant = '0.00USD';
$reference = 'SUB1-1716474386';
$version = '3.0';
$lgue = 'ES';
$societe = 'kalsteinfr';
$stoprecurrence = 'OUI';

// Crear arreglo de campos
$fields = [
    'version' => $version,
    'TPE' => $tpe,
    'date' => $date,
    'date_commande' => $date_commande,
    'montant' => $montant,
    'montant_a_capturer' => $montant_a_capturer,
    'montant_deja_capture' => $montant_deja_capture,
    'montant_restant' => $montant_restant,
    'reference' => $reference,
    'lgue' => $lgue,
    'societe' => $societe,
    'stoprecurrence' => $stoprecurrence
];

$mac = calculateMAC($securityKey, $fields);

$fields['MAC'] = $mac;

$url = "https://p.monetico-services.com/test/capture_paiement.cgi"; // URL de pruebas

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
