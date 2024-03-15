<?php 
require __DIR__ . '/../conexion.php';

if (isset($_POST['message_id'])) {

  $message_id = $_POST['message_id'];

  $consulta = "SELECT fecha_envio FROM wp_mensajes WHERE id = '$message_id'";
  $resultado = $conexion->query($consulta);
  $row = $resultado->fetch_assoc();
  $fecha_envio = $row['fecha_envio'];

  function get_format($df) {
    if($df->i < 1 && $df->s < 60) { 
      return 'Just Now';
    }

    $str = '';
    $str .= ($df->invert == 1) ? ' - ' : '';
    if ($df->y > 0) {
      $str .= ($df->y > 1) ? $df->y . ' Years ' : $df->y . ' Year '; 
    }
    if ($df->m > 0) {
      $str .= ($df->m > 1) ? $df->m . ' Months ' : $df->m . ' Month ';
    }
    if ($df->d > 0) {
      $str .= ($df->d > 1) ? $df->d . ' Days ' : $df->d . ' Day ';
    }
    if ($df->h > 0) {
      $str .= ($df->h > 1) ? $df->h . ' Hours ' : $df->h . ' Hour ';
    }
    if ($df->i > 0) {
      $str .= ($df->i > 1) ? $df->i . ' Minutes ' : $df->i . ' Minute '; 
    }

    return $str;
  }

  $date1 = new DateTime($fecha_envio);
  $date2 = new DateTime("now");
  $diff = $date1->diff($date2);

  $tiempoTranscurrido = get_format($diff);
  echo json_encode($tiempoTranscurrido);

} else {
  echo json_encode("Error: Message ID not provided."); 
}
?>