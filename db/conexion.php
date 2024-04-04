<?php
    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
    $country = isset($_COOKIE['country']) ? $_COOKIE['country'] : 'US';

    // Configuraciones de conexion para cada idioma
    $configuraciones = [
        'plus' => [
            'host' => 'localhost', 
            'username' => 'kalsteinplus', 
            'password' => 'OqA;}vKA94PO', 
            'database' => 'kalsteinplus_he270716_wp_es'
        ],
        'de' => [
            'host' => 'localhost', 
            'username' => 'user_de', 
            'password' => 'pass_de', 
            'database' => 'db_de'
        ],
        'ee' => [
            'host' => 'localhost', 
            'username' => 'user_ee', 
            'password' => 'pass_ee', 
            'database' => 'db_ee'
        ],
        'en' => [
            'host' => 'localhost', 
            'username' => 'user_en', 
            'password' => 'RP\$c_myoUeMK', 
            'database' => 'he270716_wp_en'
        ],
        'es' => [
            'host' => 'localhost', 
            'username' => 'he270716', 
            'password' => 'RP\$c_myoUeMK', 
            'database' => 'he270716_wp_es'
        ],
        'fr' => [
            'host' => 'localhost', 
            'username' => 'he270716', 
            'password' => 'RP\$c_myoUeMK', 
            'database' => 'he270716_wp_fr'
        ],
        'it' => [
            'host' => 'localhost', 
            'username' => 'user_it', 
            'password' => 'pass_it', 
            'database' => 'db_it'
        ],
        'nl' => [
            'host' => 'localhost', 
            'username' => 'user_nl', 
            'password' => 'pass_nl', 
            'database' => 'db_nl'
        ],
        'pl' => [
            'host' => 'localhost', 
            'username' => 'kalsteinpl', 
            'password' => 'ayW&x1q!K%Vw', 
            'database' => 'db_pkalsteinpl_he270711_pl_1'
        ],
        'pt' => [
            'host' => 'localhost', 
            'username' => 'user_pt', 
            'password' => 'pass_pt', 
            'database' => 'db_pt'
        ],
        'se' => [
            'host' => 'localhost', 
            'username' => 'user_se', 
            'password' => 'pass_se', 
            'database' => 'db_se'
        ]
    ];

    // Funcion para obtener la configuracion de conexion basada en el idioma
    function obtenerConfiguracion($idioma, $configuraciones) {
        // Si la configuracion es 'plus'
        if ($idioma == 'plus') {
            return $configuraciones['plus'];
        } elseif (array_key_exists($idioma, $configuraciones)) {
            // Si el idioma esta definido
            return $configuraciones[$idioma];
        } else {
            // Si el idioma no está definido
            return $configuraciones['en'];
        }
    }

    // Ejecutar la funcion para obtener la configuracion de conexion
    $configuracionUsuario = obtenerConfiguracion('plus', $configuraciones);

    // Establecer la conexion
    $conexion = new mysqli(
        $configuracionUsuario['host'],
        $configuracionUsuario['username'],
        $configuracionUsuario['password'],
        $configuracionUsuario['database']
    );

    // Establecer codificacion a UTF-8
    $acentos = $conexion->query("SET NAMES 'utf8'");

    // Función para obtener el idioma principal del país
    function obtenerIdiomaPrincipal($country) {
        // Asocia cada idioma con los países que lo comparten
        $idiomasPrincipales = [
            'en' => ['US', 'AU', 'NZ'],
            'es' => ['ES', 'VE', 'CO', 'PE'],
            'de' => ['DE'],
            'nl' => ['NL'],
            'pl' => ['PL'],
            'pt' => ['PT'],
            'se' => ['SE'],
            'fr' => ['FR'],
            'ee' => ['EE'],
            'it' => ['IT']
        ];

        // Busca el idioma principal del país en el arreglo de idiomas principales
        foreach ($idiomasPrincipales as $idioma => $paises) {
            if (in_array($country, $paises))
                return $idioma;
            }

            return 'en'; // Por defecto, inglés
        }

        $langToUse = obtenerIdiomaPrincipal($country);
        // echo "<script>console.log('LANG: " . $langToUse . "');</script>";

    // Verificar la conexion
    if ($conexion->connect_error) {
        die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
    }
?>
