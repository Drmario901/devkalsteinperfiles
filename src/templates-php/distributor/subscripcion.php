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
<h1>Subscripcion dis</h1>

<style>
  body {
    font-family: Arial, sans-serif;
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
    background-color: #4CAF50;
    color: white;
  }

  .membership-table tr:nth-child(even) {
    background-color: #f2f2f2
  }

  .checkmark {
    color: #4CAF50;
    font-size: 1.5em;
  }
</style>
</head>

<body>

  <h2>FORTALECE TU IDENTIDAD CON K+</h2>
  <p>Planes de Membresía</p>
  <p>Estos planes están diseñados para ofrecer un soporte sin precedentes.</p>

  <table class="membership-table">
    <tr>
      <th>Facturación mensual</th>
      <th>Membresía 1</th>
      <th>Membresía 2</th>
      <th>Membresía 3</th>
    </tr>
    <tr>
      <td>Soporte Multilingüe en 10 idiomas</td>
      <td><span class="checkmark">&#10003;</span></td>
      <td><span class="checkmark">&#10003;</span></td>
      <td><span class="checkmark">&#10003;</span></td>
    </tr>
    <!-- Más filas según necesites -->
  </table>

</body>

<!-- FOOTER -->
<?php
$footer_img = 'Footer-fabricante-IMG.png';
include 'footer.php';
?>