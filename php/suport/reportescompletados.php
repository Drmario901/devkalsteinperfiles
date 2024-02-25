<?php
     require __DIR__ .'/../conexion.php';

     session_start();

$acc_id = $_SESSION['emailAccount'];


      $consulta = "SELECT * FROM wp_reportes WHERE R_usuario_agente='$acc_id' and R_estado  = 'Process'";
      $respuesta = $conexion->query($consulta);

      if ($respuesta->num_rows > 0) {
        $suma = 0;
        while ($row = $respuesta->fetch_assoc()) {
          $suma += $row['R_id'];
        }
        
        $contador = mysqli_num_rows($respuesta);

        $salida = '  <center><data class="card-data">'.$contador.'</data></center>';
      } else {
        $salida =  '<center><data class="card-data">No Hay Datos</data></center>';
      }

      echo $salida; 
      $conexion->close();
    ?>