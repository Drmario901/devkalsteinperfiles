<?php

$fechaInicio = new DateTime(); // Fecha actual
$fechaFinal = new DateTime();
$fechaFinal->modify('+30 days');

echo 'fecha final:  ' . $fechaFinal;
