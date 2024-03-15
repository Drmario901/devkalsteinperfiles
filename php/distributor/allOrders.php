<?php
      require __DIR__.'../../db/conexion.php';

      $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status = '3'";
      $respuesta = $conexion->query($consulta);

      if ($respuesta->num_rows > 0) {
        $suma = 0;
        while ($row = $respuesta->fetch_assoc()) {
          $suma += $row['cotizacion_id'];
        }
        
        $contador = mysqli_num_rows($respuesta);

        $salida = '  <span style="font-size: 3em; font-weight: bold; margin-top: 1.2rem;">'.$contador.'</span>';
      } else {
        $salida =  '<span style="font-size: 3em; font-weight: bold; margin-top: 1.2rem;">No data</span>';
      }

      echo $salida; 
      $conexion->close();
    ?>
  
