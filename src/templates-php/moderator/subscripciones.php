<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Bootstrap CSS -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- jQuery and Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <header class="header" data-header>
    <style>
      .btnVerTienda:hover {
        color: white !important;
      }

      .buton-paginate {
        color: #0d6efd;
      }

      .boton-paginate:hover {
        color: white;
      }

      .table>thead {
        background-color: hsl(229.26deg 59.01% 31.57%);
        color: white;
      }

      .pay-pendiente {
        background-color: orange !important;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        font-weight: 600;
      }

      .pay-pagado {
        background-color: green !important;
        color: white;
        text-align: center;
      }
    </style>
    <?php
    require __DIR__ . '/../../../php/conexion.php';
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
        <h4 class='mt-2'><span style='font-weight: 600; display: inline;'>Suscripciones activas</span></h4>
        <?php
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
            $id_account = $row['account_aid'];
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
                        <img class='mx-1' src=$urlImagePerfil width=150>
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
                    <input type='hidden' id='id_account' value='$id_account'>
                    <button type='button' onclick='openPaymentModal($id_account)' id='btnHistorial' data-toggle='modal' data-target='#paymentModal'
                      class='btnVerTienda btn btn-outline-secondary btn-block p-2 px-4 ms-3' style='color: #333'>Ver Historial</button>
                  </div>
                </div>
              </div>";
          }
        } else {
          echo "<p>No hay subscripciones para cancelar</p>";
        }
        ?>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="paymentModalLabel">Historial de Pagos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Code Retour</th>
                    <th>Fecha Inicio</th>
                    <th>Fecha Final</th>
                    <th>Referencia Pago</th>
                    <th>Estado Membresia</th>
                    <th>Monto</th>
                    <th>Fecha y Hora</th>
                    <th>Dominio</th>
                  </tr>
                </thead>
                <tbody id="paymentTableBody">
                  <!-- Aquí se insertarán los pagos mediante JavaScript -->
                </tbody>
              </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
          </div>
        </div>
      </div>
    </article>
  </main>
</body>

</html>