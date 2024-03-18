<?php
session_start();
require_once '/conexion.php';

$response = ['status' => 'session_inactive'];

if (isset($_SESSION['user_tag'])) {
    $response = [
        'status' => 'session_active', 
        'user_tag' => $_SESSION['user_tag']
    ];
} else {
    if (isset($_SESSION['emailAccount'])) {
        $emailAccount = $_SESSION["emailAccount"];

        $stmt = $conexion->prepare("SELECT user_tag FROM wp_account WHERE account_correo = ?");
        $stmt->bind_param("s", $emailAccount);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $_SESSION['user_tag'] = $row['user_tag'];

            $response = [
                'status' => 'session_active', 
                'user_tag' => $_SESSION['user_tag']
            ];
        }
    }
}

echo json_encode($response);
?>
