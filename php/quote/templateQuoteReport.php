<?php
session_start();
require __DIR__ . '/conexion.php';
if ($_GET['idCotizacion']) {
    $idCotizacion = $_GET['idCotizacion'];
} else {
    if (isset($_SESSION['idCotizacionSupport'])) {
        $idCotizacion = $_SESSION['idCotizacionSupport'];
    } else {
        $idCotizacion = '';
    }
}

$sql = "SELECT * FROM wp_cotizacion WHERE cotizacion_id = '$idCotizacion'";
$sql2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$idCotizacion'";
$resultado = $conexion->query($sql2);
$result = $conexion->query($sql);
$row = mysqli_fetch_array($result);
$name = $row['cotizacion_sres'];
$created = $row['cotizacion_create_at'];
$date = new DateTime($created);
$onlyDate = date_format($date, 'Y-m-d');
$onlyHours = date_format($date, 'h:i A');
$total = $row['cotizacion_total'];
$divisa1 = $row["cotizacion_divisa"];
?>
<link rel="stylesheet" type="text/css" href="pdf.css">
<div class='cp01'>
    <div class='h-01'>
        <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/francia-pais.jpg"
            style='float: right; width: 18%; margin-top: 25mm; margin-right: 45mm;'>
    </div>
    <div class='b-01'
        style='background-image: url(https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/fondo.png)'>
        <div class='id'>
            <div class='logo'>
                <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
                    style='float: right; width: 70%; margin-top: 55mm; margin-right: 2%;'>
            </div>
            <div class='hr'></div>
            <div class='n-id'>
                <p class='co'>QUOTE</p>
                <p class='id-title'>QUO<span class='id-n'><?php echo $idCotizacion ?></span></p>
                <p class='msj'>A DIFFERENT ACCOMPANIMENT, AT YOUR SERVICE</p>
            </div>
        </div>
        <div class='f-01'>
            <div class='qr'>
                <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/qr.jpg"
                    style='width: 100%;'>
            </div>
            <div class='f-text'>
                <p class='l-1'>All rights reserved ® KALSTEIN France S. A. S.,</p>
                <p class='l-2'>2 Rue Jean Lantier • 75001 Paris •</p>
                <p class='l-3'>+33 1 78 95 87 89 / +33 6 80 76 07 10 •</p>
                <p class='l-4'>https://kalstein.eu</p>
                <p class='l-5'>KALSTEIN FRANCE, S. A. S</p>
            </div>
            <div class='hr-2'></div>
            <div class='img-logo2'>
                <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo-blanco.png"
                    style='width: 50%; float: right;'>
            </div>
        </div>
    </div>
</div>
<page backtop="58mm" backbottom="30mm" backleft="0mm" backright="0mm">
    <page_header>
        <div class='ht'>
            <div class='logo-03'>
                <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
                    style='float: right; width: 70%; margin-top: 15mm; margin-right: 2mm;'>
            </div>
            <div class='tp-01'>
                <p>KALSTEIN FRANCE SIREN: 819 970 815</p>
            </div>
            <div class='tp-02'>
                <p style='font-weight: bold; margin: 0; padding: 0;'>Cotización N°: <span
                        style='font-weight: lighter;'>QUO<?php echo $idCotizacion ?></span></p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'>Paris, <?php echo $onlyDate ?> <?php echo $onlyHours ?>
                </p>
            </div>
        </div>
        <div class='hr-04'></div>
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Señores:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $name ?></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Atención:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $name ?></p>
            </div>
        </div>
        <div class='c-table'>
            <table>
                <tr>
                    <td class='td-i'>Item</td>
                    <td class='td-d2'>Descripción</td>
                    <td class='td-c'>Cantidad</td>
                    <td class='td-v'>Valor Unitario</td>
                    <td class='td-vt'>Valor Total</td>
                </tr>
            </table>
        </div>
    </page_header>
    <page_footer>
        <div class='ft'>
            <div class='ft-01'>
                <div class='img-ce'>
                    <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/img-ce.jpg"
                        style='float: right; width: 100%; margin-top: 5mm;'>
                </div>
                <div class='text-ce'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>CE marking: to buy with peace
                        of mind</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>All Kalstein equipment complies
                        with the requirements of the EU, in accordance with the relevant regulations.</p>
                </div>
                <div class='img-cora'>
                    <img src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono3.png"
                        style='float: right; width: 90%; margin-top: 7mm;'>
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>With the acquisition of a
                        Kalstein equipment</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>You make a contribution to the
                        Jacinto Convit Foundation, OneTreePlanted, Humatem Foundation and the Maniapure Foundation.</p>
                </div>
            </div>
            <div class='hr-05'></div>
            <div class='ft-02'>
                <div class='ft-02-text'>
                    <p style='margin: 0; padding: 0; font-size: 9px; margin-top: 5mm;'>KALSTEIN FRANCE S.A.S</p>
                    <p style='margin: 0; padding: 0; font-size: 9px; margin-top: 1mm;'>• 2 Rue Jean Lantier, • 75001
                        Paris •</p>
                    <p style='margin: 0; padding: 0; font-size: 8px; margin-top: 1mm;'>+33 1 78 95 87 89 / +33 6 80 76
                        07 10 • https://kalstein.eu</p>
                </div>
                <div class='ftn-3'>
                    <p style='text-align: right; font-size: 9px; margin-top: 6.5mm; font-weight: bold;'>Page [[page_cu]]
                        of [[page_nb]]</p>
                </div>
            </div>
        </div>
    </page_footer>

    <?php
    $subtotal = 0;
    if ($resultado->num_rows > 0) {
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $description = $value['cotizacion_detalle_name'];
            $cant = $value['cotizacion_detalle_cant'];
            $valorUnit = $value['cotizacion_detalle_valor_unit'];
            $valorTotal = $value['cotizacion_detalle_valor_total'];
            $subtotal = $valorTotal + $subtotal;
            $divisa = $value["cotizacion_divisa"];

            $i = $i + 1;
            echo "
                        <table>
                            <tr>
                                <td class='tdb-i2'>$i</td>
                                <td class='tdb-d2'>
                                    <p style='margin: 0; padding: 0; font-size: 11px;'>$description</p>
                                </td>
                                <td class='tdb-c2'>$cant</td>
                                <td class='tdb-v2'>$valorUnit $divisa<br></td>
                                <td class='tdb-vt2'>$valorTotal $divisa</td>                            
                            </tr>
                        </table>
                    ";
        }
    }
    ?>

    <div class='bt-02'>
        <div class='sbt-02'>
            <div class='ob'>
                <div class='sob'>
                    <div class='ob-title'>
                    </div>
                    <div class='ob-p'>
                    </div>
                </div>
            </div>
            <div class='totales'>
                <div class='subtotales'>
                    <div class='totales-t'>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>
                            Subtotal:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>IVA:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Total:</p>
                    </div>
                    <div class='totales-n'>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-left: 3mm;'>
                            <?php echo $subtotal ?>.00 <?php echo " " . $divisa ?></p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm; margin-left: 3mm;'>
                            0.00 <?php echo " " . $divisa ?></p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm; margin-left: 3mm;'>
                            <?php echo $total . " " . $divisa ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</page>