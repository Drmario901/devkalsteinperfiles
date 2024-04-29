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
  }

  .membership-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .membership-table th,
  .membership-table td {
    text-align: left;
    padding: 12px;
    border: 1px solid #ddd;

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
    color: var(--e-global-color-text);
    font-size: 1.7em;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0px;
  }

  @media (max-width: 768px) {
    .membership-table {
      border: 0;
    }

    .membership-table th,
    .membership-table td {
      padding: 10px;
      display: block;
    }

    .membership-table thead {
      display: none;
      /* esconder la cabecera en dispositivos pequeños */
    }

    .membership-table td {
      border-bottom: 1px solid #ddd;
      position: relative;
      padding-left: 50%;
      /* da espacio para el contenido del 'pseudo-elemento' */
      text-align: right;
    }

    .membership-table td:before {
      content: attr(data-label);
      position: absolute;
      left: 0;
      width: 45%;
      padding-left: 15px;
      font-weight: bold;
      text-align: left;
    }

    .membership-table tr {
      margin-bottom: 10px;
      display: block;
      background: none;
    }

    .membership-table tr:nth-child(even) {
      background: none;
      /* remueve el estilo zebra para filas pares */
    }
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

</section>

<!-- FOOTER -->
<?php
$footer_img = 'Footer-fabricante-IMG.png';
include 'footer.php';
?>