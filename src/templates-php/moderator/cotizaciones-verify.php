<?php

 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

// require __DIR__ . '/../../../db/conexion.php';

// require_once __DIR__ . '/../../../php/moderator/quotesMonetico.php'
// require '/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/quotesMonetico.php';


//  if(isset($_SESSION['privateEmailAccount'])){
//         $acc_id = $_SESSION['privateEmailAccount'];
//     }
//     else{
//         echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder');</script>";
//     }

?>

<style>
.buton-paginate {
  color: black;
}
 .boton-paginate:hover {
  color: white;
 }

.table > thead {
  background-color: hsl(229.26deg 59.01% 31.57%);
  color: white;
}

.pay-pendiente {
  background-color: orange !important;
  color: orange;
}
.pay-pagado {
  background-color: green !important;
  color: green;
  text-align: center;
}
</style>

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
    <h1>Cotizaciones</h1>
    <button id="boton-verify">Click Aqui</button>
<div class="container mt-5">
    <div id="datos-tabla">
        <!-- La tabla se llenará dinámicamente con AJAX -->
    </div>

  <!--  <div id="paginacion">
         Los controles de paginación se generarán dinámicamente 
    </div> -->
    <div style="display: flex; justify-content: space-between">
        <button id="boton-prev" class="btn btn-outline-primary buton-paginate" aria-label="Previous" >
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </button>

      <ul id="paginado" class="pagination" >
  
      </ul>
  
        <button id="boton-next" class="btn btn-outline-primary buton-paginate" aria-label="Next" >
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </button>
    </div>
    
    
</div>


</body>

