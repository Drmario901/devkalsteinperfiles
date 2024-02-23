<?php

/*$apiKey = 'marketing2.kalstein@gmail.com_efa7e33856202c4565831076cd13bb0675f5ffb42d409b9b4c4f70c57a16594e04040970';

$pdfFolderPath = '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload/';
$thumbnailFolderPath = '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/thumbnails/';

$pdfFiles = glob($pdfFolderPath . '*.pdf');

foreach ($pdfFiles as $pdfFile) {
    $pdfFileName = basename($pdfFile);

    
    $pdfFileName = str_replace('', '%', $pdfFileName);


    $sourceFileUrl = 'https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload/' . $pdfFileName;

    
    $postFields = [
        'name' => $pdfFileName,
        'url' => $sourceFileUrl,
        'firstPageToConvert' => 1,
        'singleImage' => true
    ];


    $ch = curl_init('https://api.pdf.co/v1/pdf/convert/to/jpg');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'x-api-key: ' . $apiKey
    ]);

    $result = curl_exec($ch);

    curl_close($ch);

    $result = json_decode($result, true);

    if ($result['error'] == false) {
        $jpgUrl = $result['urls'][2];

        $ch = curl_init($jpgUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $jpgImage = curl_exec($ch);
        curl_close($ch);

    
        $thumbnailFilePath = $thumbnailFolderPath . pathinfo($pdfFileName, PATHINFO_FILENAME) . '.jpg';
        file_put_contents($thumbnailFilePath, $jpgImage);

        echo "Miniatura generada para: " . $pdfFileName . "<br>";
    } else {
        echo "Error al generar miniatura para: " . $pdfFileName . " - Error: " . $result['message'] . "<br>";
    }
}*/

$pdfFolder = '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload/';
$jpgFolder = '/home/he290532/testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/catalogs/thumbnails';

$pdfFiles = glob($pdfFolder . '*.pdf');

foreach ($pdfFiles as $pdfFile) {
    $pdfFileName = pathinfo($pdfFile, PATHINFO_FILENAME);
    
    $jpgFile = $jpgFolder . $pdfFileName . '.jpg';
    
    if (!file_exists($jpgFile)) {
        $im = new Imagick();
        
        $im->readImage($pdfFile);
        
        $im->setIteratorIndex(2);
        
        $im->setImageFormat('jpg');
        
        $im->writeImage($jpgFile);
        
        $im->clear();
        
        echo "Se ha generado la imagen $jpgFile.<br>";
    } else {
        echo "La imagen $jpgFile ya existe, no se generará de nuevo.<br>";
    }
}

echo 'Proceso completado.';


?>

