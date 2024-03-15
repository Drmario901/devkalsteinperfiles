<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
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
            'password' => 'pass_en', 
            'database' => 'db_en'
        ],
        'es' => [
            'host' => 'localhost', 
            'username' => 'user_es', 
            'password' => 'pass_es', 
            'database' => 'db_es'
        ],
        'fr' => [
            'host' => 'localhost', 
            'username' => 'user_fr', 
            'password' => 'pass_fr', 
            'database' => 'db_fr'
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
            'username' => 'user_pl', 
            'password' => 'pass_pl', 
            'database' => 'db_pl'
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

    // Deteccion del Idioma con la Cookie de idiomas
    $idiomaUsuario =  'plus';

    // Ejecutar la funcion para obtener la configuracion de conexion
    $configuracionUsuario = obtenerConfiguracion($idiomaUsuario, $configuraciones);

    // Establecer la conexion
    $conexion = new mysqli(
        $configuracionUsuario['host'],
        $configuracionUsuario['username'],
        $configuracionUsuario['password'],
        $configuracionUsuario['database']
    );

    // Establecer codificacion a UTF-8
    $acentos = $conexion->query("SET NAMES 'utf8'");

    // Verificar la conexion
    if ($conexion->connect_error) {
        die("<script>alert('Error de conexión: " . $conexion->connect_error . "');</script>");
    }
?>