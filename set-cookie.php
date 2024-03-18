<?php

require 'vendor/autoload.php';
use GeoIp2\Database\Reader;

$databasePath = '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/GeoDB/GeoLite2-Country.mmdb';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    $language = $_POST['lang'] ?? 'en'; 

    try {
        $reader = new Reader($databasePath);
        $record = $reader->country($_SERVER['REMOTE_ADDR']);
        
        $country = $record->country->isoCode;

        setcookie('language', $language, time() + (86400 * 30), "/");
        setcookie('country', $country, time() + (86400 * 30), "/");

        echo "Language set to: " . $language . "\n";
        echo "Country set to: " . $country . "\n";
    } catch (Exception $e) {
        echo "Error determining location: " . $e->getMessage();
    }
} else {
    echo "No POST data received. Ensure language is being sent correctly.\n";
}

?>
