<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/conexion.php';
session_start();

// EMAIL ACCOUNT SESSION.
/*if (isset($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];
}*/

// LANGUAGE FOR THE TEXT OF LOADER.
$esText = '<h2>Redirigiendo a pasarela de pago</h2>';

// CANCEL FUNCTIONALITY
/*if (!isset($_GET["idMembership"])) {
    die('Error: ID de membresía no proporcionado');
}
$idMembership = $_GET["idMembership"];*/

// MAIN QUERYS
$consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$row = $conexion->query($consulta)->fetch_assoc();

if (!$row) {
    die('Error: Usuario no encontrado.');
}

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
    'reference' => 'Membresia-SUB2-@valfonsob12-1714666086',
    'language' => 'ES',
    'currency' => 'USD',
    'amount' => 20 
]);

$url = $cancel->getUrl();
$fields = $monetico->getFields($cancel);

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
