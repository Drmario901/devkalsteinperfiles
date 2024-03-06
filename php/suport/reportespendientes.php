<?php
     require __DIR__ .'/../conexion.php';

     session_start();

     include 'translateText.php';
     translateText();

$acc_id = $_SESSION['emailAccount'];

      $consulta = "SELECT * FROM wp_reportes WHERE R_usuario_agente='$acc_id' and R_estado  = 'Pending'";
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