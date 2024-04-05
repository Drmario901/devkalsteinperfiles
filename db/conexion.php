<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
    $country = isset($_COOKIE['country']) ? $_COOKIE['country'] : 'NET_EN';

    echo 'country:  ', $country, '<br/>';

    // Configuraciones de conexion para cada idioma
    $configuraciones = [
        'plus' => [
            'host' => 'localhost', 
            'username' => 'kalsteinplus', 
            'password' => 'OqA;}vKA94PO', 
            'database' => 'kalsteinplus_he270716_wp_es'
        ],
        'EU' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteineu', 
            'password' => 'fnrKdL2&RN.s', 
            'database' => 'kalsteineu_he270711_wp1'
        ],
        'US' => [
            'host' => '185.28.22.84', 
            'username' => 'he269186', 
            'password' => '{m_a,([19n*L', 
            'database' => 'he269186_he270716_wp_en'
        ],
        'FR' => [
            'host' => '185.28.22.128', 
            'username' => 'kalsteinfr', 
            'password' => 'T%AY_[oJYz;3', 
            'database' => 'kalsteinfr_he270711_kalsteinfr'
        ],
        'PE' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteincompe', 
            'password' => 'tf@u[l~]c^Py', 
            'database' => 'kalsteincompe_he270711_kalsteincompe'
        ],
        'EC' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteinec', 
            'password' => '4#hxT=]DGiKG', 
            'database' => 'kalsteinec_he270711_kalsteinec'
        ],
        'PA' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteinpa', 
            'password' => 'jdxOYxU1CFPQ', 
            'database' => 'kalsteinpa_he270711_kalsteincompa'
        ],
        'BO' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteinbo', 
            'password' => '5=w;Tl*I]Z6A', 
            'database' => 'kalsteinbo_he270711_combo'
        ],
        'VE' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteinco', 
            'password' => 'ku,oMnVdIWt]', 
            'database' => 'kalsteinco_he270711_kalsteincove'
        ],
        'ES' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteines', 
            'password' => 'Lu%2WGm6=JES', 
            'database' => 'kalsteines_he270711_kalsteines'
        ],
        'MX' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinmx', 
            'password' => ']FttT%lFO5V(', 
            'database' => 'kalsteinmx_he270711_kalsteincommx'
        ],
        'CO' => [
            'host' => '185.28.22.84', 
            'username' => 'kalsteincolombia', 
            'password' => 'Kalstein1234', 
            'database' => 'kalsteincolombia_kalsteincol_he270711_kalsteinco'
        ],
        'DE' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinde', 
            'password' => 'yzL6Djp1O@_I', 
            'database' => 'kalsteinde_he272456_de'
        ],
        'EE' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinee', 
            'password' => ')Qgsq7.K{DFX', 
            'database' => 'kalsteinee_u673369396_U38Rq'
        ],
        'IN' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinhindi', 
            'password' => 'fpo5{y,f5]]1', 
            'database' => 'kalsteinhindi_u305949244_migration1'
        ],
        'UK' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinuk', 
            'password' => '-cvMgWZ~0Xi2', 
            'database' => 'kalsteinuk_he272456_wp2'
        ],
        'NZ' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinnz', 
            'password' => 'Ph5d;^[x7qvX', 
            'database' => 'kalsteinnz_he272456_conz'
        ],
        'CR' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteincocr', 
            'password' => ']okgqH&=9=df', 
            'database' => 'kalsteincocr_he272456_cocr'
        ],
        'CL' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteincl', 
            'password' => 'MN~Zau6O0N+l', 
            'database' => 'kalsteincl_he270711_kalsteincl'
        ],
        'BE' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinbe', 
            'password' => 'KUS4(K3q)S9*', 
            'database' => 'kalsteinbe_he272456_be'
        ],
        'AFRICA_IN' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinafrica', 
            'password' => '&vvm1VnXreh?', 
            'database' => 'kalsteinafrica_he272456_africa_wp1'
        ],
        'AFRICA_FR' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinafrica', 
            'password' => '&vvm1VnXreh?', 
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
            'username' => 'he270716', 
            'password' => 'RP\$c_myoUeMK', 
            'database' => 'he270716_wp_fr'
        ],
        'NET_EN' => [
            'host' => '185.28.22.128', 
            'username' => 'he270716', 
            'password' => 'RP\$c_myoUeMK', 
            'database' => 'he270716_wp_en'
        ],
        'IT' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinit', 
            'password' => 'ITDEPARTMENT1234*', 
            'database' => 'kalsteinit_he272456_it'
        ],
        'NL' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinnl', 
            'password' => 'raP^6uFD*1Dg', 
            'database' => 'kalsteinnl_he272456_nl'
        ],
        'PL' => [
            'host' => '185.28.22.128', 
            'username' => 'kalsteinpl', 
            'password' => 'ayW&x1q!K%Vw', 
            'database' => 'db_pkalsteinpl_he270711_pl_1'
        ],
        'PK' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinpk', 
            'password' => 'H5HSkELr!!%B', 
            'database' => 'kalsteinpk_he272456_pk'
        ],
        'PT' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinpt', 
            'password' => '61DS^z12R=rb', 
            'database' => 'kalsteinpt_he272456_pt'
        ],
        'SE' => [
            'host' => '185.28.22.154', 
            'username' => 'kalsteinse', 
            'password' => 'KwX9zQgl1w8', 
            'database' => 'kalsteinse_he272456_se'
        ]
    ];

    function obtenerConfiguracion($country, $configuraciones) {
        if ($country == 'plus') {
            return $configuraciones['plus'];
        } elseif (array_key_exists($country, $configuraciones)) {
            return $configuraciones[$country];
        } else {
            return $configuraciones['NET_EN']; // Por defecto, NET en inglés
        }
    }

    $configuracionUsuario = obtenerConfiguracion($country, $configuraciones);

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
