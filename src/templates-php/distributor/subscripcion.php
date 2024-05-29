<style>
section {
    font-family: Montserrat, Arial, sans-serif;
    /* margin: 3rem; */
    padding-bottom: 2rem;
}

.fa-solid {
    font-size: 1.5em;
}

.membership-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    table-layout: auto;
}

.membership-table th,
.membership-table td {
    text-align: center;
    padding: 1em 0.5em;
    border: 1px solid #c9c9c9;
}

.membership-table th {
    /* background-color: #4CAF50; */
    color: #213280;
    line-height: 1.5em;
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
    color: var(--e-global-color-text);
    font-size: 1.7em;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0px;
    display: inline-block;
    padding-top: 0.5rem;
}

.title_k::before {
    content: "";
    /* Necesario para que el pseudo-elemento se muestre */
    position: absolute;
    left: 0;
    top: 0;
    width: 60px;
    /* Ancho de la barra como porcentaje del elemento */
    height: 4px;
    /* Altura de la barra */
    background-color: #213280;
    /* Color de la barra */
    display: block;
    margin-bottom: 3px;
    padding-bottom: 2px;
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

.btn-nav-subs {
    color: #213280;
}

.btn-tbl-cancelar {
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
    background-color: #c1121f;
    font-weight: bolder;
    box-shadow: 0 2px 0 2px #000;
}

.btn-tbl-cancelar:before {
    content: "";
    position: absolute;
    width: 100px;
    height: 120%;
    background-color: #fff;
    top: 50%;
    transform: skewX(30deg) translate(-150%, -50%);
    transition: all 0.5s;
}


.btn-tbl-cancelar:hover {
    background-color: #c1121f;
    color: #fff !important;
    box-shadow: 0 2px 0 2px #c1121f;
}

.btn-tbl-cancelar:hover::before {
    transform: skewX(30deg) translate(150%, -50%);
    transition-delay: 0.1s;
}

.btn-tbl-cancelar:active {
    transform: scale(0.9);
}

html a:hover,
.btLightSkin a:hover,
.btn-tbl-cancelar:hover {
    text-decoration: none;
    color: #fff !important;
}

.th-active {
    background-color: #213280;
}
</style>

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
  require __DIR__ . '/../../../php/getMembresia.php';

  $mebresia = $_SESSION['tipo_membresia'];
  // echo  'Membresiaaa' . $mebresia;
  ?>
    <script>
    let page = "home";
    document.querySelector('#link-' + page).classList.add("active");
    document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>

<section style="margin-top: 2rem;">

    <h2 class="title_k">FORTALECE TU <br> <span>IDENTIDAD CON K+</span></h2>
    <h5 style="font-size: 1.5em; color: #213280; font-weight: 700;">Planes de Membresía</h5>

    <table class="membership-table">
        <thead>
            <tr id="tr-titles">
                <!-- Los títulos se llenarán aquí -->
                <th style="font-size: 1.35em">Facturación mensual<br><span
                        style="color: black; font-weight: 500; font-size: 14px;">Estos planes están diseñados para
                        ofrecer un soporte sin precedentes.</span></th>
                <th id="th-membresia-1" style="background-color: <?php echo $membresia == 0 ? '#213280' : 'transparent'; ?>; 
          color: <?php echo $membresia == 0 ? '#FFFFFF' : 'inherit'; ?>;">
                    <?php if ($membresia == 0) echo "<span style='font-size: 12px; font-weight: 400; color: #FFFFFF;'><i class='fa-solid fa-circle-exclamation' style='font-size: 12px;'></i> Suscripción actual</span>"; ?>
                    Membresía 1<br>
                    <span style="font-size: 1.35em">Gratis</span>
                </th>
                <th id="th-membresia-2" style="background-color: <?php echo $membresia == 1 ? '#213280' : 'transparent'; ?>; 
          color: <?php echo $membresia == 1 ? '#FFFFFF' : 'inherit'; ?>;">
                    <?php if ($membresia == 1) echo "<span style='font-size: 12px; font-weight: 400; color: #FFFFFF;'><i class='fa-solid fa-circle-exclamation' style='font-size: 12px;'></i> Suscripción actual</span>"; ?>
                    Membresía 2<br>
                    <span style="font-size: 1.35em">$59 al mes</span>
                </th>
                <th id="th-membresia-3" style="background-color: <?php echo $membresia == 2 ? '#213280' : 'transparent'; ?>; 
          color: <?php echo $membresia == 2 ? '#FFFFFF' : 'inherit'; ?>;">
                    <?php if ($membresia == 2) echo "<span style='font-size: 12px; font-weight: 400; color: #FFFFFF;'><i class='fa-solid fa-circle-exclamation' style='font-size: 12px;'></i> Suscripción actual</span>"; ?>
                    Membresía 3<br>
                    <span style="font-size: 1.35em">$79 al mes</span>
                </th>

            </tr>
        </thead>
        <tbody id="tr-data" style="font-family: Roboto, Arial, sans-serif">
            <!-- Los datos se llenarán aquí -->
        </tbody>
    </table>

    <div id='tbl-botones' style="display: flex; justify-content: center; gap: 2rem; margin-top: 1.5rem;">
        <?php if ($membresia != 0) : ?>
        <!-- <a href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/testPayRecurrentCancel.php" id="btn-cancelar-subs" class="btn-tbl-cancelar">Cancelar</a> -->
        <button href="" id="btn-cancelar-subs" class="btn-tbl-cancelar">Cancelar</button>
        <?php endif; ?>

        <?php if ($membresia != 1 && $membresia != 2) : ?>
        <a href="" id="membresia-1" class="btn-tbl" user=<?php echo $email; ?>>Membresía 2</a>
        <?php endif; ?>

        <?php if ($membresia != 2) : ?>
        <a href="" id="membresia-2" class="btn-tbl" user=<?php echo $email; ?>>Membresía 3</a>
        <?php endif; ?>
    </div>

</section>

<!-- FOOTER -->
<?php
$footer_img = 'Footer-fabricante-IMG.png';
include 'footer.php';
?>