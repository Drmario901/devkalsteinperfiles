<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once __DIR__ . '/../../db/conexion.php';

     session_start();

     require_once __DIR__ .'/../translateText.php';
     translateText();

    $acc_id = $_SESSION['emailAccount'];


      $consulta = "SELECT * FROM wp_reportes WHERE R_usuario_agente='$acc_id' and R_estado  = 'Procesado'";
      $respuesta = $conexion->query($consulta);

      if ($respuesta->num_rows > 0) {
        $suma = 0;
        while ($row = $respuesta->fetch_assoc()) {
          $suma += $row['R_id'];
        }
        
        $contador = mysqli_num_rows($respuesta);

        $salida = '  <center><data class="card-data">'.$contador.'</data></center>';
      } else {
        $salida =  '<center><data class="card-data" data-i17n="client:dataNotFound">No Hay Datos</data></center>';
      }

      echo $salida; 
      $conexion->close();
?>