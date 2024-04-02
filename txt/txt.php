    <?php


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $archivo = __DIR__ . '/prueba.txt';
    
    // Asegúrate de que el archivo existe y se puede leer.
    if (!is_readable($archivo)) {
        die("El archivo no existe o no se puede leer.");
    }
    
    $lines = file($archivo); // Lee el archivo en un array de líneas
    
    foreach ($lines as $line) {
        // Verificar si la línea contiene "Datos recibidos"
        if (strpos($line, 'Datos recibidos:') !== false) {
            // Extraer el JSON de la línea
            $jsonString = substr($line, strpos($line, '{'));
            $jsonData = json_decode($jsonString);
    
            // Comprobar si el JSON se decodificó correctamente
            if ($jsonData !== null && json_last_error() === JSON_ERROR_NONE) {
                // Obtener el campo 'reference'
                $reference = $jsonData->reference ?? 'No encontrado';
                $codeRetour = $jsonData->{'code-retour'} ?? 'No encontrado';
                echo "Reference: " . $reference . "\n";
                echo "code-retour: " . $code_retour . "\n";
                
                // Aquí puedes agregar el código para insertar en la base de datos
                // Por ejemplo: insertReferenceToDatabase($reference);
            } else {
                echo "Error al decodificar JSON: " . json_last_error_msg() . "\n";
            }
        }
    }

    // Imprimir los valores
    // echo "Montant: " . $montant . "\n";
    // echo "Reference: " . $reference . "\n";


    ?>