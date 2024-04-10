<?php
require __DIR__ . '/../../../php/conexion.php';
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

?>

<header class="header" data-header>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <?php
  include 'navbar.php';
  ?>
  <script>
    let page = "render";

    document.querySelector('#link-' + page).classList.add("active");
    document.querySelector('#link-' + page).removeAttribute("style");
  </script>
</header>

<main>

  <br>
  <br>
  <br>
  <article class="container article">
    <h1 class="title">Render productos</h1>
    <div class="grid-render">
      <?php
      // get products from table render_products inner join wp_account order by ID_render_p
      $query = "SELECT render_product.ID_render_p, render_product.estado, render_product.fecha_solicitud, render_product.image_url, render_product.fotoLateral_izq, render_product.fotoLateral_der, render_product.fotoParte_tras, wp_account.account_nombre, wp_account.account_apellido FROM render_product INNER JOIN wp_account ON render_product.ID_user = wp_account.account_correo ORDER BY render_product.ID_render_p ASC;";

      $result = $conexion->query($query);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $id = $row["ID_render_p"];
          $name = $row["account_nombre"] . " " . $row["account_apellido"];
          $fecha = $row["fecha_solicitud"];
          //parse fecha
          $fecha = date("d-m-Y", strtotime($fecha));
          $image = $row["image_url"];
          $image2 = $row["fotoLateral_izq"];
          $image3 = $row["fotoLateral_der"];
          $image4 = $row["fotoParte_tras"];
          $estado = $row["estado"];

          //Parse image to use absolute path
      
          echo "
              <div class='card-render'>
                <div class='card-render-body'>
                  <img src='$image' id='principal' alt='Imagen principal' class='card-render-image'>
                  <img src='$image2' id='latIzquierdo' alt='Imagen lateral izquierda' class='card-render-image hidden'>
                  <img src='$image3' id='latDerecho' alt='Imagen lateral derecha' class='card-render-image hidden'>
                  <img src='$image4' id='atras' alt='Imagen parte trasera' class='card-render-image hidden'>
                  <span id='id-render'>$id</span>
                  <h2 class='card-render-title'>Solicitante: $name</h2>
                  <p class='card-render-text'> Fecha de solicitud: $fecha</p>
                  <p class=''>Estado: $estado</p>
                </div>
                <div class='card-render-footer'>
                  <button class='btn-render'>Renderizar</button>
                </div>
              </div>";
        }
      } else {
        echo "<p>No hay productos para renderizar</p>";
      }
      ?>
    </div>

    <!-- Modal oculto -->
    <div id="modal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Datos del producto</h2>
        <div id="modal-body">
          <div id="datos"></div>
          <!-- Botón para descargar imágenes -->
          <button id="download-images-btn" class="btn-download">Descargar Imágenes</button>
        </div>
        <div id="modal-footer">
          <h3 class="title-renderizado">Sube el archivo renderizado</h3>
          <form id="form-render" class="form-render" method="POST" enctype="multipart/form-data" class="form-file">
            <label class="custum-file-upload" for="file">
              <div class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24">
                  <g stroke-width="0" id="SVGRepo_bgCarrier"></g>
                  <g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g>
                  <g id="SVGRepo_iconCarrier">
                    <path fill=""
                      d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z"
                      clip-rule="evenodd" fill-rule="evenodd"></path>
                  </g>
                </svg>
              </div>
              <div class="text">
                <span>Click to upload image</span>
              </div>
              <input type="file" name="uploadedFile" id="imageUpload">
              <input type="hidden" id="userId" name="userId" value="">
            </label>
            <button type="submit" id="btn-render" class="btn-render">Enviar</button>
          </form>
        </div>
      </div>
    </div>
  </article>
</main>