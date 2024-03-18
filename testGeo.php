<?php

require_once 'vendor/autoload.php';

use GeoIp2\Database\Reader;

$databasePath = '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/GeoDB/GeoLite2-Country.mmdb';

try {
    $reader = new Reader($databasePath);

    $ipAddress = $_SERVER['REMOTE_ADDR'];

    $country = $reader->country($ipAddress);

    echo "IP: " . $ipAddress . "\n";
    echo "Country: " . $country->country->name . "\n";

} catch (\GeoIp2\Exception\AddressNotFoundException $e) {
    echo "The IP isn´t found in the database.\n";
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>


