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
            'host' => '185.28.22.154', 
            'username' => 'kalsteinde', 
            'password' => 'yzL6Djp1O@_I', 
            'database' => 'kalsteinde_he272456_de'
        ],
        'ee' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinee', 
            'password' => ')Qgsq7.K{DFX', 
            'database' => 'kalsteinee_u673369396_U38Rq'
        ],
        'en' => [
            'host' => '185.28.22.128', 
            'username' => 'he270716', 
            'password' => 'RP\$c_myoUeMK', 
            'database' => 'he270716_wp_en'
        ],
        'es' => [
            'host' => '185.28.22.128', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'he270716_wp_es'
        ],
        'fr' => [
            'host' => '185.28.22.128', 
            'username' => 'he270716', 
            'password' => 'RP\$c_myoUeMK', 
            'database' => 'he270716_wp_fr'
        ],
        'it' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinit', 
            'password' => 'ITDEPARTMENT1234*', 
            'database' => 'kalsteinit_he272456_it'
        ],
        'nl' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinnl', 
            'password' => 'raP^6uFD*1Dg', 
            'database' => 'kalsteinnl_he272456_nl'
        ],
        'pl' => [
            'host' => '185.28.22.128', 
            'username' => 'kalsteinpl', 
            'password' => 'ayW&x1q!K%Vw', 
            'database' => 'db_pkalsteinpl_he270711_pl_1'
        ],
        'pt' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinpt', 
            'password' => '61DS^z12R=rb', 
            'database' => 'kalsteinpt_he272456_pt'
        ],
        'se' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinse', 
            'password' => 'KwX9zQgl1w8', 
            'database' => 'kalsteinse_he272456_se'
        ]
    ];

    function obtenerConfiguracion($idioma, $configuraciones) {
        if ($idioma == 'plus') {
            return $configuraciones['plus'];
        } elseif (array_key_exists($idioma, $configuraciones)) {
            return $configuraciones[$idioma];
        } else {
            return $configuraciones['en']; // Por defecto, inglés
        }
    }
    
    // Función para obtener el idioma principal del país
    function obtenerIdiomaPrincipal($country) {
        // Asocia cada idioma con los países que lo comparten
        $idiomasPrincipales = [
            'en' => ['US', 'GB', 'CA', 'AU', 'NZ', 'IE', 'ZA', 'JM', 'BB', 'TT'],
            'es' => ['ES', 'MX', 'AR', 'PE', 'VE', 'CL', 'EC', 'GT', 'CU', 'BO', 'DO', 'HN', 'PY', 'SV', 'NI', 'CR', 'UY', 'PA', 'PR', 'CO'],
            'fr' => ['FR', 'BE', 'CH', 'LU', 'MC', 'DZ', 'MA', 'SN', 'HT'],
            'se' => ['SE', 'FI'],
            'it' => ['IT', 'CH', 'SM'],
            'pt' => ['PT', 'BR', 'MZ', 'AO'],
            'pl' => ['PL'],
            'nl' => ['NL', 'BE', 'SR', 'AW', 'CW'],
            'de' => ['DE', 'AT', 'CH', 'LU', 'LI'],
            'ee' => ['EE']
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

        // Ejecutar la funcion para obtener la configuracion de conexion
        $configuracionUsuario = obtenerConfiguracion('es', $configuraciones);


    // Establecer la conexion
    $conexion = new mysqli(
        $configuracionUsuario['host'],
        $configuracionUsuario['username'],
        $configuracionUsuario['password'],
        $configuracionUsuario['database']
    );

    // Establecer codificacion a UTF-8
    $acentos = $conexion->query("SET NAMES 'utf8'");

    // Verificar la conexión
    if ($conexion->connect_error) {
        // Si hay un error de conexión, mostrar un mensaje de error en la consola
        echo "Error de conexión: " . $conexion->connect_error;
    }
?>
