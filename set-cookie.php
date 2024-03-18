<?php

require 'vendor/autoload.php';
use GeoIp2\Database\Reader;

$databasePath = '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/GeoDB/GeoLite2-Country.mmdb';

$countryToLanguageMap = [
    // Español
    'ES' => 'es', 'MX' => 'es', 'AR' => 'es', 'PE' => 'es', 'VE' => 'es',
    'CL' => 'es', 'EC' => 'es', 'GT' => 'es', 'CU' => 'es', 'BO' => 'es',
    'DO' => 'es', 'HN' => 'es', 'PY' => 'es', 'SV' => 'es', 'NI' => 'es',
    'CR' => 'es', 'UY' => 'es', 'PA' => 'es', 'PR' => 'es', 'CO' => 'es',
    // Inglés
    'US' => 'en', 'GB' => 'en', 'CA' => 'en', 'AU' => 'en', 'NZ' => 'en',
    'IE' => 'en', 'ZA' => 'en', 'JM' => 'en', 'BB' => 'en', 'TT' => 'en',
    // Francés
    'FR' => 'fr', 'BE' => 'fr', 'CH' => 'fr', 'LU' => 'fr', 'MC' => 'fr',
    'DZ' => 'fr', 'MA' => 'fr', 'SN' => 'fr', 'HT' => 'fr',
    // Sueco
    'SE' => 'se', 'FI' => 'se',
    // Italiano
    'IT' => 'it', 'CH' => 'it', 'SM' => 'it',
    // Portugués
    'PT' => 'pt', 'BR' => 'pt', 'MZ' => 'pt', 'AO' => 'pt',
    // Polaco
    'PL' => 'pl',
    // Neerlandés
    'NL' => 'nl', 'BE' => 'nl', 'SR' => 'nl', 'AW' => 'nl', 'CW' => 'nl',
    // Alemán
    'DE' => 'de', 'AT' => 'de', 'CH' => 'de', 'LU' => 'de', 'LI' => 'de',
    // Estonio
    'EE' => 'ee',
];


try {
    $reader = new Reader($databasePath);
    $record = $reader->country($_SERVER['REMOTE_ADDR']);
    $country = $record->country->isoCode;

    $language = $_POST['lang'] ?? ($countryToLanguageMap[$country] ?? 'en');

    setcookie('language', $language, time() + (86400 * 30), "/");
    setcookie('country', $country, time() + (86400 * 30), "/");

    echo "Language set to: " . $language . "\n";
    echo "Country set to: " . $country . "\n";
} catch (Exception $e) {
    echo "Error determining location: " . $e->getMessage();
}
?>
