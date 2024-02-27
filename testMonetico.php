<?php

require 'vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;

try {
    
    $monetico = new Monetico('7590531', 'ABCDEFG', 'kalsteinfr');

    echo "La librería Monetico ha sido cargada correctamente.\n";
    echo "<br>";
    if (method_exists($monetico, 'getFields')) {
        echo "El método getFields está disponible en la librería Monetico.\n";
    } else {
        echo "El método getFields no está disponible, verifica la instalación de la librería.\n";
    }
} catch (Exception $e) {
    echo 'Cargó pero con errores.' . "\n"; 
    echo '<br>';
    echo '<br>';
    echo "Error: " . $e->getMessage() . "\n";
}

?>

<?php 
echo "<p>Hola</p>";
?>
