<header class="header" data-header>
  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  if (session_status() == PHP_SESSION_NONE) {
    session_start();
  }
  if (isset($_SESSION['emailAccount'])) {
    $email = $_SESSION['emailAccount'];
  }
  include 'navbar.php';
  ?>
  <script>
    let page = "home";
    document.querySelector('#link-' + page).classList.add("active");
    document.querySelector('#link-' + page).removeAttribute("style");
  </script>
</header>



<style>
  section {
    font-family: Arial, sans-serif;
    /* margin: 3rem; */
    padding-bottom: 2rem;
  }

  .membership-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);

  }

  .membership-table th,
  .membership-table td {
    text-align: center;
    padding: 5px;
    border: 1px solid #ddd;
    max-width: 3rem;

  }

  .membership-table th {
    /* background-color: #4CAF50; */
    color: #213280;
    width: 10rem;
  }

  .membership-table tr:nth-child(even) {
    background-color: #f2f2f2
  }

  .checkmark {
    color: #4CAF50;
    font-size: 1.5em;
  }

  .title_k {
    position: relative;
    /* Posicionamiento relativo para el pseudo-elemento */
    color: var(--e-global-color-text);
    font-size: 1.7em;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0px;
    display: inline-block;
    /* Esto permite que la barra se ajuste al ancho del texto */
  }

  .title_k::before {
    content: "";
    /* Necesario para que el pseudo-elemento se muestre */
    position: absolute;
    left: 0;
    top: 0;
    width: 25%;
    /* Ancho de la barra como porcentaje del elemento */
    height: 5px;
    /* Altura de la barra */
    background-color: #213280;
    /* Color de la barra */
    display: block;
  }


  .btn-tbl {
    padding: 1.1em 2em;
    background: none;
    border: 2px solid #fff;
    font-size: 15px;
    color: white !important;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition: all 0.3s;
    border-radius: 12px;
    background-color: #213280;
    font-weight: bolder;
    box-shadow: 0 2px 0 2px #000;
  }

  .btn-tbl:before {
    content: "";
    position: absolute;
    width: 100px;
    height: 120%;
    background-color: #fff;
    top: 50%;
    transform: skewX(30deg) translate(-150%, -50%);
    transition: all 0.5s;
  }

  .btn-tbl:hover {
    background-color: #213280;
    color: #fff !important;
    box-shadow: 0 2px 0 2px #0d3b66;
  }

  .btn-tbl:hover::before {
    transform: skewX(30deg) translate(150%, -50%);
    transition-delay: 0.1s;
  }

  .btn-tbl:active {
    transform: scale(0.9);
  }

  html a:hover,
  .btLightSkin a:hover,
  .btn-tbl:hover {
    text-decoration: none;
    color: #fff !important;
  }
</style>
</head>

<section style="margin-top: 2rem;">

  <h2 class="title_k">FORTALECE TU <br> <span>IDENTIDAD CON K+</span></h2>
  <p>Planes de Membresía</p>
  <p>Estos planes están diseñados para ofrecer un soporte sin precedentes.</p>

  <table class="membership-table">
    <thead>
      <tr id="tr-titles">
        <!-- Los títulos se llenarán aquí -->
      </tr>
    </thead>
    <tbody id="tr-data">
      <!-- Los datos se llenarán aquí -->
    </tbody>
  </table>
  <div id='tbl-botones' style="display: flex; justify-content: end; gap: 2rem; margin-top: 1.5rem;">

  </div>

</section>

<!-- FOOTER -->
<?php
$footer_img = 'Footer-fabricante-IMG.png';
include 'footer.php';
?>