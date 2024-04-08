<?php

 ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); 

require __DIR__ . '/../../../db/conexion.php';


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

<body>
<div class="container mt-5">
    <table class="table table-responsive-md">
        <thead>
            <tr>
                <th>ID</th>
                <th>ID Cotización</th>
                <th>Monto Total</th>
                <th>Divisa</th>
                <th>ID Remitente</th>
                <th>Estado del Pago</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($datos as $fila): ?>
            <tr>
                <td><?php echo htmlspecialchars($fila['id']); ?></td>
                <td><?php echo htmlspecialchars($fila['id_cotizacion']); ?></td>
                <td><?php echo htmlspecialchars($fila['monto_total']); ?></td>
                <td><?php echo htmlspecialchars($fila['cotizacion_divisa']); ?></td>
                <td><?php echo htmlspecialchars($fila['cotizacion_id_remitente']); ?></td>
                <td><?php echo htmlspecialchars($fila['status_payment']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php for($i = 1; $i <= $totalPaginas; $i++): ?>
                <li class="page-item <?php if($i === $pagina) echo 'active'; ?>">
                    <a class="page-link" href="tabla.php?pagina=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

