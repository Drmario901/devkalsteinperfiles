<?php 
session_start();

$hostdb = "localhost";
$userdb = "he270716_wp4";
$passdb = "Q.LsGRSOl5J5EKlGBKY00";
$namedb = "he270716_wp4";

/* function getPublicIP() {

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, "http://httpbin.org/ip");

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $output = curl_exec($curl);
    curl_close($curl);

    $ip = json_decode($output, true);

    return $ip['origin'];
} */

$conexion = new mysqli($hostdb, $userdb, $passdb, $namedb);

if ($conexion->connect_error) {
    die("Error: " . $conexion->connect_error);
}

echo "Conectada a la base de datos";

$response = array();

if (isset($_POST['accountUser'])) {
    $m = $_POST['accountUser'];
    $nombre = $_POST['accountNombre'];
    $apellido = $_POST['accountApellido'];
    $pass = $_POST['accountPassword'];

    
    function getUsername($email) {
        $username = substr($email, 0, strpos($email, '@'));
        return $username;
    }
    
    /* $_SESSION['model-to-open-in-platform'] = $m; */
    
    $php_session = session_id();
    $_SESSION['accountUser'] = $m;
    /*  $php_model = $_SESSION['model-to-open-in-platform']; */
    /* $php_ip = getPublicIP(); */ 
    
    $php_session = $conexion->real_escape_string($php_session);
    $php_user = $conexion->real_escape_string($_SESSION['accountUser']);
    $usersName = getUsername($php_user);
    /* $php_ip = $conexion->real_escape_string($php_ip); */

    $current_time = time();
    $time_limit = $current_time - 600;

    $sql = "INSERT INTO account_session (ac_usuario, ac_email, ac_nombre, ac_apellido, ac_password, ac_session, `timestamp`) VALUES ('$usersName', '$m', '$nombre', '$apellido', '$pass', '$php_session', NOW())";
    $conexion->query($sql);

    $response['current'] = $usersName;
    session_write_close();
    $response['status'] = 'done';
} elseif (isset($_SESSION['accountUser'])) {
    $response['current'] = $_SESSION['accountUser'];
    $response['status'] = 'done';
} else {
    $response['status'] = 'none';
}

if(isset($_POST['logout'])){
    session_destroy();
    header('Location: https://biblioteca.kalstein.net/');
}elseif (isset($_SESSION['last-activity'])) {
    $duration = time() - $_SESSION['last-activity'];
    if($duration > 3600){
        session_destroy();
    }

}

/* $sql = "DELETE FROM account_session WHERE `timestamp` < NOW() - INTERVAL 10 MINUTE";
$conexion->query($sql);

$response['session'] = $_SESSION['model-to-open-in-platform']; */

echo json_encode($response);
?>