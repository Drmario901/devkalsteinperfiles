<?php

 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

// require __DIR__ . '/../../../db/conexion.php';

// require_once __DIR__ . '/../../../php/moderator/quotesMonetico.php'
require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/quotesMonetico.php';


//  if(isset($_SESSION['privateEmailAccount'])){
//         $acc_id = $_SESSION['privateEmailAccount'];
//     }
//     else{
//         echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder');</script>";
//     }

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

<body>
<div class="container mt-5">
    <div id="datos-tabla">
        <!-- La tabla se llenará dinámicamente con AJAX -->
    </div>

    <div id="paginacion">
        <!-- Los controles de paginación se generarán dinámicamente -->
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

