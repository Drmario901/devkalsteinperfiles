<?php

require_once 'vendor/autoload.php';

use GeoIp2\Database\Reader;

$databasePath = '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/GeoDB/GeoLite2-Country.mmdb';

try {

    $reader = new Reader($databasePath);

    $ipAddress = $_SERVER['REMOTE_ADDR'];

    $location = $reader->city($ipAddress);

    echo "IP: " . $ipAddress . "\n";
    echo "Country: " . $location->country->name . "\n";
    echo "Region: " . $location->mostSpecificSubdivision->name . "\n";
    echo "City: " . $location->city->name . "\n";
    echo "ZIP Code: " . $location->postal->code . "\n";
    echo "Latitude: " . $location->location->latitude . ", Longitud: " . $location->location->longitude . "\n";

} catch (\GeoIp2\Exception\AddressNotFoundException $e) {
    echo "La dirección IP no fue encontrada en la base de datos.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>
