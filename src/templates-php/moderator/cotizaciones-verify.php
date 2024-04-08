<?php
require __DIR__ . '/../../../db/conexion.php';
/* ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */

if (isset($_SESSION['privateEmailAccount'])){
    $acc_id = $_SESSION['privateEmailAccount'];
}
else{
    echo "<script>window.location.replace('https://dev.kalstein.plus/plataforma/acceder');</script>";
}

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

