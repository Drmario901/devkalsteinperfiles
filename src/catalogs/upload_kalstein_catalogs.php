<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '/home/he270716/public_html/plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/conexion.php';

$file_name_list = scandir(__DIR__.'/upload');

$countYR = 0;
$countTotal = 0;

foreach ($file_name_list as $index => $name) {
    // Ignorar '.' y '..'
    if ($name === '.' || $name === '..') continue;

    // Extraer el nombre original sin la extensión .pdf para usar en la base de datos
    $originalNameWithoutPdf = preg_replace('/\.pdf$/i', '', $name);

    // Reemplazar '*' por '°' y otros caracteres especiales por '_'
    $safeFileName = str_replace('*', '°', $name);
    $safeFileName = preg_replace('/[^a-zA-Z0-9°_-]/', '_', $safeFileName);

    // Verificar y corregir el patrón '_pdf_pdf' antes de la extensión '.pdf'
    $pattern = '/_pdf_pdf\.pdf$/i';
    if (preg_match($pattern, $safeFileName)) {
        $safeFileName = preg_replace($pattern, '.pdf', $safeFileName);
    }

    // Renombrar el archivo físicamente en el directorio si es necesario
    if ($name !== $safeFileName && !file_exists(__DIR__ . '/upload/' . $safeFileName)) {
        rename(__DIR__ . '/upload/' . $name, __DIR__ . '/upload/' . $safeFileName);
    }

    // Preparar el query con parámetros de sustitución para evitar inyecciones SQL
    $query = "INSERT INTO wp_catalogs_es (catalog_name_es, catalog_pdf, catalog_image) VALUES (?, ?, ?)";

    // Preparar sentencia
    $stmt = $conexion->prepare($query);

    // Vincular parámetros al statement: original para el nombre, seguro para el archivo y la imagen
    $stmt->bind_param("sss", $originalNameWithoutPdf, $safeFileName, $safeFileName);

    // Ejecutar sentencia
    $stmt->execute();

    // Contadores para la lógica específica de tu aplicación
    if (strpos($originalNameWithoutPdf, 'YR') !== false) {
        $countYR++;
    }
    $countTotal++;
}

echo $countTotal . '<br>';
echo $countYR;

// Cerrar la conexión de base de datos
$conexion->close();
?>
