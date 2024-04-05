<?php
    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
    $country = isset($_COOKIE['country']) ? $_COOKIE['country'] : 'NET_EN';

    // Lista de bases de datos por país
    $configuraciones = [
        'plus' => [
            'host' => 'localhost', 
            'username' => 'kalsteinplus', 
            'password' => 'OqA;}vKA94PO', 
            'database' => 'kalsteinplus_he270716_wp_es'
        ],
        'EU' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteineu_he270711_wp1'
        ],
        'US' => [
            'host' => '185.28.22.128', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'he269186_he270716_wp_en'
        ],
        'FR' => [
            'host' => '185.28.22.128', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinfr_he270711_kalsteinfr'
        ],
        'PE' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteincompe_he270711_kalsteincompe'
        ],
        'EC' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinec_he270711_kalsteinec'
        ],
        'PA' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinpa_he270711_kalsteincompa'
        ],
        'BO' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinbo_he270711_combo'
        ],
        'VE' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinco_he270711_kalsteincove'
        ],
        'ES' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteines_he270711_kalsteines'
        ],
        'MX' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinmx_he270711_kalsteincommx'
        ],
        'CO' => [
            'host' => '185.28.22.84', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteincolombia_kalsteincol_he270711_kalsteinco'
        ],
        'IN' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinhindi_u305949244_migration1'
        ],
        'UK' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinuk_he272456_wp2'
        ],
        'NZ' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinnz_he272456_conz'
        ],
        'CR' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteincocr_he272456_cocr'
        ],
        'CL' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteincl_he270711_kalsteincl'
        ],
        'BE' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinbe_he272456_be'
        ],
        'AFRICA_IN' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinafrica_he272456_africa_wp1'
        ],
        'AFRICA_FR' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinafrica_he272456_africa_wp2'
        ],
        'NET_ES' => [
            'host' => '185.28.22.128', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'he270716_wp_es'
        ],
        'NET_FR' => [
            'host' => '185.28.22.128', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'he270716_wp_fr'
        ],
        'NET_EN' => [
            'host' => '185.28.22.128', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'he270716_wp_en'
        ],
        'PL' => [
            'host' => '185.28.22.128', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinpl_he270711_pl_1'
        ],
        'PK' => [
            'host' => '185.28.22.154', 
            'username' => 'plus', 
            'password' => 'Yuleana24.', 
            'database' => 'kalsteinpk_he272456_pk'
        ]
    ];

    function obtenerConfiguracion($country, $configuraciones) {
        if ($country == 'plus') {
            return $configuraciones['plus'];
        } elseif (array_key_exists($country, $configuraciones)) {
            return $configuraciones[$country];
        } else {
            return $configuraciones['plus']; // Por defecto, NET en inglés
        }
    }

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

    // Verificar la conexión
    if ($conexion->connect_error) {
        // Si hay un error de conexión, mostrar un mensaje de error en la consola
        echo "Error de conexión: " . $conexion->connect_error;
    }
?>
