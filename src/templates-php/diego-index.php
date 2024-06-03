<?php
$nombre_cookie = "roll_usuario";
$valor_cookie = "3";
$tiempo_expiracion = time() + (86400 * 30); // La cookie expirará en 30 días

// Guardar la cookie
setcookie($nombre_cookie, $valor_cookie, $tiempo_expiracion, "/");

if (isset($_COOKIE[$nombre_cookie])) {
  echo "La cookie '" . $nombre_cookie . "' se ha establecido correctamente con el valor '" . $_COOKIE[$nombre_cookie] . "'.";
} else {
  echo "No se pudo establecer la cookie.";
}
?>


<h1>hola</h1>

<button id="hola" role="<?php echo $valor_cookie ?>">Hola</button>