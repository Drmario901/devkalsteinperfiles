<header class="header" data-header>
  <style>
    .btnVerTienda:hover {
      color: white !important;
    }
  </style>
  <?php

  require __DIR__ . '/../../../php/conexion.php';
  /* ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL); */

  include 'navbar.php';

  ?>

  <script>
    let page = "stores";

    document.querySelector('#link-' + page).classList.add("active");
    document.querySelector('#link-' + page).removeAttribute("style");
  </script>
</header>
<main>
  <article class="container article">

    <div class="row">
      <h4 class='mt-2'><span style='font-weight: 600; display: inline;'>Subscripciones</span> a cancelar</h4>
      <?php

      // inner join wp_account on wp_subscripcion.user_id = wp_account.account_aid
      
      $query = "
      SELECT wp_subscripcion.*, wp_account.*
      FROM wp_subscripcion
      INNER JOIN wp_account ON wp_subscripcion.user_id = wp_account.account_aid
      WHERE wp_subscripcion.estado_membresia = 2
      ORDER BY wp_subscripcion.user_id ASC;
      ";


      $result = $conexion->query($query);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

          $nombre = $row['account_nombre'];
          $apellido = $row['account_apellido'];
          $nombreCompleto = $nombre . " " . $apellido;
          $img = $row['account_url_image_perfil'];
          $acc_img = $row['account_url_image_perfil'];
          $rol = $row['account_rol_aid'];

          $firstLyricsName = strtoupper($nombre);
          $firstLyricsLastname = strtoupper($apellido);
          $membresia = $row['tipo_membresia'];
          $fechaInicio = $row['fecha_inicio'];
          $fechaFin = $row['fecha_final'];


          if ($acc_img == '') {
            $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/' . $firstLyricsName . '/' . $firstLyricsName . '' . $firstLyricsLastname . '.png';
          } else {
            $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/upload/' . $acc_img;
          }

          if ($rol == 1) {
            $rol = 'Cliente';
          } elseif ($rol == 2) {
            $rol = 'Distribuidor';
          } elseif ($rol == 3) {
            $rol = 'Fabricante';
          }

          if ($membresia == 1) {
            $tipo_membresia = 'Plan de membresia 1';
          } elseif ($membresia == 2) {
            $tipo_membresia = 'Plan de membresia 2';
          }


          echo "<div class='col-lg-6'>
            <div class='card row m-2'>
              <div class='col-12'>
                <div class='row mb-2'>
                  <div class='col-4'>
                    <img class='mx-1'
                      src=$urlImagePerfil
                      width=150>
                  </div>
                  <div class='col-8'>
                    <h6 style='font-weight: 600;'>$nombreCompleto ($rol)</h6>
                    <p class='mb-2'>$tipo_membresia</p>
                    <p class='mb-2'>Inicio de suscripción: $fechaInicio</p>
                    <p class='mb-2'>Fin de la suscripción: $fechaFin</p>
                  </div>
                </div>
              </div>
              <div class='col-12' style='display: flex; justify-content: flex-start'>
                <a href='https://dev.kalstein.plus/plataforma/template-editor/assets/vistas/articulos_blog.php'>
                  <button type='button' id='btnUpdate' class='btn btn-info btn-block p-2 px-4'>Cancelar membresia</button>
                </a>
                <a href='https://dev.kalstein.plus/plataforma/tienda-de-prueba/'>
                  <button type='button' id='btnUpdate'
                    class='btnVerTienda btn btn-outline-secondary btn-block p-2 px-4 ms-3' style='color: #333'>Ver Historial</button>
                </a>
              </div>
    
            </div>
          </div>
            ";
        }
      } else {
        echo "
            <p>No hay subscripciones para cancelar</p>";
      }
      ?>


    </div>
    <!-- <?php

    // require __DIR__.'/../../../php/conexion.php';
    
    function time_elapsed_string($datetime, $full = false)
    {
      $now = new DateTime;
      $ago = new DateTime($datetime);
      $diff = $now->diff($ago);

      $diff->w = floor($diff->d / 7);
      $diff->d -= $diff->w * 7;

      $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
      );
      foreach ($string as $k => &$v) {
        if ($diff->$k) {
          $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
          unset($string[$k]);
        }
      }

      if (!$full)
        $string = array_slice($string, 0, 1);
      return $string ? implode(', ', $string) . ' ago' : 'just now';
    }

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {

        $elapsed = time_elapsed_string($row['account_created_at']);

        $aid = $row['account_aid'];

        $rol = $dict[$row['account_rol_aid']];
        $correo = $row['account_correo'];

        $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'account' AND action_id = '$aid'";
        $resultAction = $conexion->query($queryAction);

        if ($resultAction->num_rows > 0) {
          $mod = $resultAction->fetch_array()[1];

          $verifying_by = "
                            <div class='fw-bold card' style='border: solid 1px #27aa3f; border-radius: 5px; background-color: #86e397; padding: 10px 20px;'>
                            <p class='m-0 p-0'><i class='fa-regular fa-circle-check'></i> Verifying by: $mod</p>
                            </div>
                            ";
        } else {
          $verifying_by = "";
        }

        echo "
                        
                        ";
      }
    } else {
      echo 'No pending tasks';
    }
    ?> -->
    </div>
  </article>
</main>