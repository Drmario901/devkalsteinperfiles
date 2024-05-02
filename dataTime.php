<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$fechaInicio = new DateTime(); // Fecha actual
$fechaFinal = new DateTime();
$fechaFinal->modify('+30 days');

echo 'fecha final:  ' . $fechaFinal;
