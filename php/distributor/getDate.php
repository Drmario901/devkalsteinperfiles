<?php 
require __DIR__ . '../../db/conexion.php';

if (isset($_POST['message_id'])) {

  $message_id = $_POST['message_id'];

  $consulta = "SELECT fecha_envio FROM wp_mensajes WHERE id = '$message_id'";
  $resultado = $conexion->query($consulta);
  $row = $resultado->fetch_assoc();
  $fecha_envio = $row['fecha_envio'];

  function get_format($df) {
    if ($df->y > 0) {
        if ($df->y == 1) {
            return '1 Year Ago';
        } else {
            return $df->y . ' Years Ago';
        }
    }

    if ($df->m > 0) {
        if ($df->m == 1) {
            return '1 Month Ago';
        } else {
            return $df->m . ' Months Ago';
        }
    }

    if ($df->d > 0) {
        if ($df->d == 1) {
            return '1 Day Ago';
        } else {
            return $df->d . ' Days Ago';
        }
    }

    if ($df->h > 0) {
        if ($df->h == 1) {
            return '1 Hour Ago';
        } else {
            return $df->h . ' Hours Ago';
        }
    }

    if ($df->i > 0) {
        if ($df->i == 1) {
            return '1 Minute Ago';
        } else {
            return $df->i. ' Minutes Ago';
        }
    }

    if ($df->s <= 60) {
        return 'Just Now';
    }

    return '';
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
