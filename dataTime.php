

<?php

$fecha = new DateTime();

$fechaFinal = new DateTime();
$fechaFinal->modify('+30 days');

echo 'fecha: ' . $fecha;
echo 'fechaFinal: ' . $fechaFinal;

?>