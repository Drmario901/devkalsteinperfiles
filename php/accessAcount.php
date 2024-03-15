<?php
session_start();
require __DIR__ . '/conexion.php';

$email = $_POST['consulta'];
$password = $_POST['consulta1'];
$_SESSION['consulta1'] = $password;

$ip = $_POST['ip'];
$browser = $_POST['browser'];
$passwordEncrypted = md5($password);
$consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$consulta2 = "SELECT * FROM wp_private_account WHERE account_email = '$email'";

$userTagQuery = "SELECT user_tag FROM wp_account WHERE account_correo = '$email'";
$resultUserTag = $conexion->query($userTagQuery);
$userTagRow = mysqli_fetch_assoc($resultUserTag);

if ($userTagRow) {
    $userTag = $userTagRow['user_tag'];
    $_SESSION['user_tag'] = $userTag;
}

$nameQuery = "SELECT account_nombre FROM wp_account WHERE account_correo = '$email'";
$resultNameQuery = $conexion->query($nameQuery);

if ($resultNameQuery && $resultUserTag->num_rows > 0) {
    $nameQueryRow = mysqli_fetch_assoc($resultNameQuery);

    if ($nameQueryRow) {
        $accountName = $nameQueryRow['account_nombre'];
        $_SESSION['nameQuery'] = $accountName;
    }
} else {
    //echo "Error: " . $conexion->error;
}

$session_id = session_id();

$resultConsulta = $conexion->query($consulta);
$resultConsulta2 = $conexion->query($consulta2);
$row = mysqli_fetch_array($resultConsulta);
$count = mysqli_num_rows($resultConsulta);
$row2 = mysqli_fetch_array($resultConsulta2);
$pass = $row[2];
$name = $row[3];

$pass2 = $row2[2];
$name2 = $row2[3];

if ($count > 0) {
    if ($pass == $passwordEncrypted) {
        $status = 'correcto';
        $_SESSION["emailAccount"] = $email;
        $_SESSION["cName"] = $name;
        // Asigna el valor de correo electrónico a la cookie de sesión
        $_SESSION['email'] = $email;
        // Establece el nombre de la cookie de sesión como "email"
        session_name('email');
        // Configura la cookie de sesión
        $session_lifetime = 30 * 24 * 60 * 60; // 30 días
        session_set_cookie_params([
            'lifetime' => $session_lifetime,
            'path' => '/',
            'domain' => 'dev.kalstein.plus',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        session_start();

        $query = "INSERT INTO wp_register_access(aid_access, account_id, access_date, access_ip, access_user_agent) VALUES ('', '$email', CURRENT_TIMESTAMP, '$ip', '$browser')";
        $conexion->query($query);

        //TABLA CIENTIFICO
        /*$query2 = "UPDATE wp_account_scientist SET account_session = '$session_id' WHERE account_correo = '$email'";
        $conexion2->query($query2);

        $query3 = "UPDATE wp_users SET account_session = '$session_id' WHERE user_email = '$email'";
        $conexion2->query($query3);*/

        $tipo = 'regular';
    } else {
        $status = 'incorrecto';
    }
} else {
    if ($pass2 == $passwordEncrypted) {
        $status = 'correcto';
        $_SESSION["privateEmailAccount"] = $email;
        // Asigna el valor de correo electrónico a la cookie de sesión
        $_SESSION['email'] = $email;
        // Establece el nombre de la cookie de sesión como "email"
        session_name('email');
        // Configura la cookie de sesión
        $session_lifetime = 30 * 24 * 60 * 60; // 30 días
        session_set_cookie_params([
            'lifetime' => $session_lifetime,
            'path' => '/',
            'domain' => 'dev.kalstein.plus',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax'
        ]);
        session_start();

        $query = "INSERT INTO wp_register_access(aid_access, account_id, access_date, access_ip, access_user_agent) VALUES ('', '$email', CURRENT_TIMESTAMP, '$ip', '$browser')";
        $conexion->query($query);
        $tipo = 'moderador';
    } else {
        $status = 'incorrecto';
    }
}

$datos = array(
    'status' => $status,
    'name' => $name,
    'tipo' => $tipo
);

echo json_encode($datos, JSON_FORCE_OBJECT);
$conexion->close();
?>
