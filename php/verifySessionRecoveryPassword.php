<?
    session_start();    
    $codeTimeOut = isset($_SESSION["linkTimeOut"]) ? $_SESSION["linkTimeOut"] : '';
    $email = isset($_SESSION["emailPasswordChangeRequest"]) ? $_SESSION["emailPasswordChangeRequest"] : '';
    $email = md5($email);
    $inactividad = 600;
    $sessionTTL = time() - $codeTimeOut;

    $datos = array(
        'email' => $email,
        'inactividad' => $inactividad,
        'sessionTTL' => $sessionTTL
    );

    echo json_encode($datos, JSON_FORCE_OBJECT);
?>