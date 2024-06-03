<?php

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

    $country = $_SERVER['HTTP_CF_IPCOUNTRY'] ?? 'UNKNOWN';

    $language = $_POST['lang'] ?? ($countryToLanguageMap[$country] ?? 'en');

    // Roll 
    $nombre_cookie = "roll_usuario";
    $valor_cookie = "3";
    $tiempo_expiracion = time() + (86400 * 30); // La cookie expirará en 30 días

    setcookie('language', $language, time() + (86400 * 30), "/");
    setcookie('country', $country, time() + (86400 * 30), "/");
    // Roll setcookie
    setcookie($nombre_cookie, $valor_cookie, $tiempo_expiracion, "/");

    echo isset($_COOKIE['roll_usuario']) ? $_COOKIE['roll_usuario'] : 'Error al obtener la cookie';
    $cookie_establecida = isset($_COOKIE['roll_usuario']) ? $_COOKIE['roll_usuario'] : "No se pudo establecer la cookie.";
    echo $cookie_establecida;

    echo "Language set to: " . $language . "\n";
    echo "Country set to: " . $country . "\n";
} catch (Exception $e) {
    echo "Error determining location: " . $e->getMessage();
}
?>

<script>
    var php = "<?php echo 'hola'; ?>"

    console.log(php)
</script>