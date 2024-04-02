<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$archivo = __DIR__ . '/txt/prueba.txt';

// Leer el contenido del archivo
$contenidoJson = file_get_contents($archivo);


// Decodificar el JSON a un objeto PHP
$objeto = json_decode($contenidoJson);

// Acceder a los valores de montant y reference
$montant = $objeto->montant;
$reference = $objeto->reference;

// Imprimir los valores
echo "Montant: " . $montant . "\n";
echo "Reference: " . $reference . "\n";


?>