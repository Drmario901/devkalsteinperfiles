<?php
$nombre_cookie = "roll_usuario";
$valor_cookie = "3";
$tiempo_expiracion = time() + (86400 * 30); // La cookie expirará en 30 días

// Guardar la cookie
setcookie($nombre_cookie, $valor_cookie, $tiempo_expiracion, "/");
?>

<h1>hola</h1>

<button id="hola" role="<?php echo $valor_cookie ?>">Hola</button>