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
  .buttonPaginate {
 appearance: button;
 background-color: #1899D6;
 border: solid transparent;
 border-radius: 16px;
 border-width: 0 0 4px;
 box-sizing: border-box;
 color: #FFFFFF;
 cursor: pointer;
 display: inline-block;
 font-size: 15px;
 font-weight: 700;
 letter-spacing: .8px;
 line-height: 20px;
 margin: 0;
 outline: none;
 overflow: visible;
 padding: 13px 19px;
 text-align: center;
 text-transform: uppercase;
 touch-action: manipulation;
 transform: translateZ(0);
 transition: filter .2s;
 user-select: none;
 -webkit-user-select: none;
 vertical-align: middle;
 white-space: nowrap;
}

.buttonPaginate:after {
 background-clip: padding-box;
 background-color: #1CB0F6;
 border: solid transparent;
 border-radius: 16px;
 border-width: 0 0 4px;
 bottom: -4px;
 content: "";
 left: 0;
 position: absolute;
 right: 0;
 top: 0;
 z-index: -1;
}

.buttonPaginate:main, button:focus {
 user-select: auto;
}

.buttonPaginate:hover:not(:disabled) {
 filter: brightness(1.1);
}

.buttonPaginate:disabled {
 cursor: auto;
}

.buttonPaginate:active:after {
 border-width: 0 0 0px;
}

.buttonPaginate:active {
 padding-bottom: 10px;
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

    <div id="paginacion">
        <!-- Los controles de paginación se generarán dinámicamente -->
    </div>
    <div style="display: flex;">
      <button id="boton-prev" class="buttonPaginate" >Prev</button> <button id="boton-next" class="buttonPaginate">Next</button>
    </div>
    
</div>


</body>

