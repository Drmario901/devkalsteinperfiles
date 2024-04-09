<?php
session_start();
if (isset($_SESSION['idCotizacion'])) {
    $idCotizacion = $_SESSION['idCotizacion'];
} else {
    $idCotizacion = $_GET['idCotizacion'];
}

require __DIR__ . '/conexion.php';

$consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id = '$idCotizacion'";
$consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$idCotizacion'";

$result = $conexion->query($consulta);
$row = mysqli_fetch_array($result);

$id = $row["cotizacion_id"];
$sres = $row["cotizacion_sres"];
$atc = $row["cotizacion_atencion"];
$created = $row["cotizacion_create_at"];
$fecha = new DateTime($created);
$onlyDate = date_format($fecha, 'd-m-y');
$onlyHours = date_format($fecha, 'h:i A');
$subtotal = $row["cotizacion_submit"];
$iva = $row["cotizacion_iva"];
$desc = $row["cotizacion_descuento"];
$subtotal2 = $row["cotizacion_subtotal"];
$envio = $row["cotizacion_envio"];
$total = $row["cotizacion_total"];
$incoterm = $row["cotizacion_incoterm"];
$divisa = $row["cotizacion_divisa"];
$pago = $row["cotizacion_metodo_pago"];
$envioM = $row["cotizacion_metodo_envio"];
$country = $row["cotizacion_destino"];

if ($country == 0) {
    $nameC = "";
} else {
    $query = "SELECT * FROM wp_paises WHERE iso = '$country'";
    $rs = $conexion->query($query);
    $row = mysqli_fetch_array($rs);
    $nameC = $row['en'];
}

if ($incoterm === 'EXW Kalstein France') {
    $descuentoEspecial = '&nbsp;';
} else {
    $descuentoEspecial = 'Sonderrabatt (18%), angewandt.';
}

if ($envioM === 'Maritime') {
    $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>CIF $nameC (Kosten + Fracht + Versicherung).</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Seefracht.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>45 - 60 Tage.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Inklusive Versandversicherung</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'> $divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 Jahr gegen Fabrikationsfehler.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

    $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 19mm;'>Währung:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantie:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Art der Zahlung:</p>";
} else {
    if ($envioM === 'Aerial') {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>DAP $nameC (Geliefert am Ort).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Luftfracht (Kurierdienst).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'> 7 - 15 Tage.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Inklusive Versandversicherung</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 Jahr gegen Fabrikationsfehler.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 15mm;'>Währung:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantie:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Art der Zahlung:</p>";
    } else {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$incoterm.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 Jahr gegen Fabrikationsfehler.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Währung:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantie:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Art der Zahlung:</p>";
    }
}

$resultado = $conexion->query($consulta2);
?>
<link rel="stylesheet" type="text/css" href="pdf.css">
<div class='cp01'>
    <div class='h-01'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/francia-pais.jpg"
            style='float: right; width: 18%; margin-top: 25mm; margin-right: 45mm;'>
    </div>
    <div class='b-01'
        style='background-image: url(https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/fondo.png)'>
        <div class='id'>
            <div class='logo'>
                <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
                    style='float: right; width: 70%; margin-top: 55mm; margin-right: 2%;'>
            </div>
            <div class='hr'></div>
            <div class='n-id'>
                <p class='co'>QUOTE</p>
                <p class='id-title'>QUO<span class='id-n'><?php echo $id ?></span></p>
                <p class='msj'>EINE ANDERE BEGLEITUNG, ZU IHREN DIENSTEN</p>
            </div>
        </div>
        <div class='f-01'>
            <div class='qr'>
                <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/qr.jpg"
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
                <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo-blanco.png"
                    style='width: 50%; float: right;'>
            </div>
        </div>
    </div>
</div>
<br />
<br />
<br />
<div class='cp02'>
    <div class='style-01'></div>
    <div class='style-02'></div>
    <div class='h-02'>
        <div class='logo-02'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
                style='float: right; width: 70%; margin-top: 15mm; margin-right: 2mm;'>
        </div>
        <div class='hr-02'></div>
        <div class='h-text-02'>
            <p class='lt-01'>UNSERE LEISTUNGEN</p>
            <p class='lt-02'>Vorteile und Support</p>
            <p class='lt-03'>Bei Kalstein Frankreich kümmern wir uns um die volle Zufriedenheit unserer Kunden, deshalb
                bieten wir Mehrwertdienste auf höchstem Niveau basierend auf unserer Erfahrung.</p>
        </div>
    </div>
    <div class='p2img-01'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen1.jpg"
            style='float: right; width: 100%;'>
    </div>
    <div class='p2img-02'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen2.jpg"
            style='float: right; width: 100%;'>
    </div>
    <div class='p2img-03'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen3.jpg"
            style='float: right; width: 100%;'>
    </div>
    <div class='cmsj-01'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono1.png"
                style='float: right; width: 100%; margin-top: 50%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Einführung und Online-Schulungen</p>
            <p class='i-p'>In jedem Teil der Welt, erhalten Sie Ihre Einführung oder Ausbildung von unserem
                spezialisierten Team von Ingenieuren.</p>
        </div>
    </div>
    <div class='cmsj-02'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono2.png"
                style='float: right; width: 90%; margin-top: 45%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Schnelle Antwort</p>
            <p class='i-p'>Unser Team steht Ihnen jederzeit zur Verfügung, um Ihre Fragen zu beantworten, um Ihnen in
                jeder Situation zu helfen.</p>
        </div>
    </div>
    <div class='cmsj-03'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono3.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>#Letsgivemore <img
                    src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/corazon.png"
                    style='width: 12px'></p>
            <p class='i-p'>Dank Ihres Kaufs erhalten Sie eine Spende an eine gemeinnützige Stiftung, die Brustkrebs
                bekämpft und den am stärksten gefährdeten Gemeinschaften hilft.</p>
        </div>
    </div>
    <div class='cmsj-04'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono4.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title1'>Technischer Support</p>
            <p class='i-p'>Genießen Sie mit Kalstein Handbüchern und Artikeln, speziellen Katalogen und Video-Tutorials
                eine persönliche Beratung zur korrekten präventiven und korrektiven Wartung Ihrer Geräte.</p>
        </div>
    </div>
    <div class='cmsj-05'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono5.png"
                style='float: right; width: 100%; margin-top: 58%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title2'>Versandlogistik</p>
            <p class='i-p'>Wir kümmern uns um die gesamte Logistik, die für den Versand Ihrer Produkte erforderlich ist,
                sei es auf dem See-, Land- oder Luftweg.</p>
        </div>
    </div>
    <div class='cmsj-06'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono6.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title3'>Kalstein Worldwide</p>
            <p class='i-p'>Mit über 25 Jahren Wachstum bei unseren Kunden sind die modernen, multiformatigen Inhalte von
                Kalstein nun in über 10 Ländern präsent und wachsen weiter.</p>
        </div>
    </div>
    <div class='f2-text'>
        <p class='t-1'>Alle Rechte vorbehalten ® KALSTEIN France S. A. S.,</p>
    </div>
    <div class='style-03'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Seite [[page_cu]] von [[page_nb]]</p>
    </div>
    <div class='style-04'></div>
</div>


<page backtop="58mm" backbottom="30mm" backleft="0mm" backright="0mm">
    <page_header>
        <div class='ht'>
            <div class='logo-03'>
                <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
                    style='float: right; width: 70%; margin-top: 15mm; margin-right: 2mm;'>
            </div>
            <div class='tp-01'>
                <p>KALSTEIN FRANCE SIREN: 819 970 815</p>
            </div>
            <div class='tp-02'>
                <p style='font-weight: bold; margin: 0; padding: 0;'>Quote N°: <span
                        style='font-weight: lighter;'>QUO<?php echo $id ?></span></p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'>Paris, <?php echo $onlyDate ?> <?php echo $onlyHours ?>
                </p>
            </div>
        </div>
        <div class='hr-04'></div>
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Herr:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $sres ?></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>ACHTUNG:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $atc ?></p>
            </div>
        </div>
        <div class='c-table'>
            <table>
                <tr>
                    <td class='td-i'>Item</td>
                    <td class='td-m'>Modell</td>
                    <td class='td-im'>Abbild</td>
                    <td class='td-d'>Beschreibung</td>
                    <td class='td-c'>Menge</td>
                    <td class='td-u'>Unid</td>
                    <td class='td-v'>Einheitswert</td>
                    <td class='td-vt'>Gesamtwert</td>
                </tr>
            </table>
        </div>
    </page_header>
    <page_footer>
        <div class='ft'>
            <div class='ft-01'>
                <div class='img-ce'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/img-ce.jpg"
                        style='float: right; width: 100%; margin-top: 5mm;'>
                </div>
                <div class='text-ce'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>CE-Kennzeichnung: sorgenfrei
                        kaufen</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Die gesamte Ausrüstung von
                        Kalstein entspricht den Anforderungen der EU gemäß den einschlägigen Vorschriften.</p>
                </div>
                <div class='img-cora'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono3.png"
                        style='float: right; width: 90%; margin-top: 7mm;'>
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Mit der Anschaffung einer
                        Kalstein Ausrüstung</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Sie leisten einen Beitrag für
                        die Jacinto Convit Foundation, OneTreePlanted, Humatem Foundation und die Maniapure Foundation.
                    </p>
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
                    <p style='text-align: right; font-size: 9px; margin-top: 6.5mm; font-weight: bold;'>Seite
                        [[page_cu]] von [[page_nb]]</p>
                </div>
            </div>
        </div>
    </page_footer>
    <?php

    if ($resultado->num_rows > 0) {
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $model = $value['cotizacion_detalle_model'];
            $name = $value['cotizacion_detalle_name'];
            $image = $value['cotizacion_detalle_image'];
            $cant = $value['cotizacion_detalle_cant'];
            $unid = $value['cotizacion_detalle_unid'];
            $maker = $value['cotizacion_detalle_maker'];
            $valorUnit = $value['cotizacion_detalle_valor_unit'];
            $valorTotal = $value['cotizacion_detalle_valor_total'];
            $valorAnidado = $value['cotizacion_detalle_valor_anidado'];
            $newModel = str_replace("|", " ", $model);
            $newMaker = str_replace("Fabricante", "Marca", $maker);

            if ($valorAnidado === '0.00') {
                $newValor = "";
            } else {
                $newValor = "(+ $valorAnidado)";
            }
            $i = $i + 1;
            echo "
                        <table>
                            <tr>
                                <td class='tdb-i'>$i</td>
                                <td class='tdb-m'>$newModel</td>
                                <td class='tdb-img'>
                                    <img src='$image' style='width: 100%;'>
                                </td>
                                <td class='tdb-d'>
                                    <p style='margin: 0; padding: 0; font-size: 11px;'>$newMaker</p>
                                    <p style='margin: 0; padding: 0; font-size: 11px;'>$name</p>
                                </td>
                                <td class='tdb-c'>$cant,00</td>
                                <td class='tdb-u'>$unid</td>
                                <td class='tdb-v'>$valorUnit<br>$newValor</td>
                                <td class='tdb-vt'>$valorTotal</td>                            
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
                        <p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0;'>Beobachtungen:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm;'>
                            Lieferzeiten:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>
                            Handelsvertreter:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 11.8mm;'>
                            Handelsbedingungen:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 7mm;'>
                            Incoterm:</p>
                        <?php
                        echo $a;
                        ?>
                    </div>
                    <div class='ob-p'>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 7mm; margin-left: 3mm;'>
                            7 - 10 Tage ca.</p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>
                            Yuleana Mia</p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1mm; margin-left: 3mm;'>
                            Email: mia@kalstein.eu</p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1mm; margin-left: 3mm;'>
                            Tlf: +33 1 7895 8789 / +33 6 8076 0710</p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>
                            Vorauszahlung mit Bestellung.</p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1mm; margin-left: 3mm;'>
                            <?php echo $descuentoEspecial ?></p>
                        <?php
                        echo $b;
                        ?>
                    </div>
                </div>
            </div>
            <div class='totales'>
                <div class='subtotales'>
                    <div class='totales-t'>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>
                            Zwischensumme:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>IVA:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Rabatt (18%):</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Zwischensumme:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Versand:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Gesamt:</p>
                    </div>
                    <div class='totales-n'>
                        <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-left: 3mm;'>
                            <?php echo $subtotal ?></p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'>
                            <?php echo $iva ?></p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'>
                            <?php echo $desc ?></p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'>
                            <?php echo $subtotal2 ?></p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'>
                            <?php echo $envio ?></p>
                        <p
                            style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.1mm; margin-left: 3mm;'>
                            <?php echo $total ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
    <div class='style-06'></div>
    <div class='h4-02'>
        <div class='logo4-02'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
                style='float: right; width: 70%; margin-top: 12mm; margin-right: 2mm;'>
        </div>
        <div class='hr4-02'></div>
        <div class='h4-text-02'>
            <p class='lt4-01'>HANDELSBEDINGUNGEN</p>
        </div>
    </div>
    <div class='p2img-01'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen1.jpg"
            style='float: right; width: 100%;'>
    </div>
    <div class='p2img-02'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen2.jpg"
            style='float: right; width: 100%;'>
    </div>
    <div class='p2img-03'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen3.jpg"
            style='float: right; width: 100%;'>
    </div>
    <div class='main-text'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px;'>BESTELLANNAHME</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Kalstein France SAS
                erhält eine Zufriedenheit mit der Bestellung, wenn dieses Dokument die im Angebot festgelegten
                Geschäftsbedingungen getreu wiedergibt.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Barzahlungen: Für
                die Bearbeitung und den Versand der angeforderten Ware ist eine Überprüfung der Zahlung auf Kalstein
                France Bankkonten erforderlich.</p>
            <p
                style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm; margin-left: 0.2mm;'>
                Kunden mit Guthaben: Für die Bearbeitung und den Versand der angeforderten Ware ist ein Zahlungsnachweis
                in Kalstein France-Bankkonten erforderlich.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 10mm;'>
            HANDELSWÄHRUNG</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt2'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Bei Angeboten in
                Fremdwährung erfolgt die Währungsumrechnung nach den am Tag der Rechnungsstellung geltenden Bestimmungen
                der Bank of France.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Die etablierte
                Handelswährung für diesen Eintrag ist <?php echo $divisa ?>.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>
            GEWÄHRLEISTUNG</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 4mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt3'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Für alle von
                Kalstein France verkauften Geräte gilt eine einjährige Garantie für Herstellungszwecke ab dem
                Rechnungsdatum der Ware.
            </p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Die Garantie
                erstreckt sich nicht auf Schäden, die durch unsachgemäße Installation oder Bedienung, Transportfehler
                oder durch andere als die vom Hersteller angegebenen Verwendungen verursacht wurden.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Die Garantie
                schließt elektrische oder Verbrauchsmaterialien aus.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>
            LIEFERZEITEN</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
        </div>
        <div class='i-txt4'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Die in diesem
                Angebot angegebenen Lieferzeiten sind Schätzungen, die von Variablen abhängig sind.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 7mm;'>
            STORNIERUNGEN UND RÜCKSENDUNGEN OHNE BEGRÜNDUNG</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 2.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 9.5mm;'>•</p>
        </div>
        <div class='i-txt5'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Die Ware im Lager
                wird eine Strafe in Höhe von 20% des Wertes der Bestellung haben.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Importieren Sie
                Waren, nachdem Sie die Bestellung zur Zufriedenheit erhalten haben, gibt es maximal (3) Tage, um die
                Bestellung zu stornieren, nachdem diese Zeit Stornierungen nicht akzeptiert werden und die Waren wie
                festgelegt in Rechnung gestellt werden.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Die Rücksendung der
                Ware obliegt dem Kunden, die Box, Verpackung und alle Teile, aus denen die zurückzusendende Ausrüstung
                besteht, müssen in einwandfreiem Zustand ohne Misshandlung, Kratzer und zusätzliche Etiketten sein, das
                technische Support- und Logistikteam von Kalstein France führt den technischen Bericht durch und zeigt
                den zufriedenstellenden Empfang der Ware an. Wenn es nicht zufriedenstellend empfangen wird, wird das
                Gerät gemäß den Bestimmungen der Bestellung in Rechnung gestellt.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 22mm;'>
            ALLGEMEINE RICHTLINIEN, GESCHÄFTSBEDINGUNGEN</p>
        <p style='margin: 0; padding: 0; font-size: 11px; margin-top: 1mm;'>
            https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='style-07'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Seite [[page_cu]] von [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
    <div class='style-06'></div>

    <div class='logo-05'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
            style='float: left; width: 60%; margin-top: 15mm; margin-left: 10mm;'><br><br><br><br><br><br><br><br>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 9px; margin-top: -2mm; margin-left: 28mm;'>Eine
            andere Begleitung, zu Ihren Diensten</p>
    </div>
    <div class='img-loc'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen4.jpg"
            style='float: left; width: 100%;'>
    </div>
    <div class='inf-cont'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 16px;'>IRGENDWELCHE FRAGEN?</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>Kontakt:</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 4mm;'>PARIS - FRANCE</p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 1mm;'>S E D E
        </p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>2 Rue Jean Lantier</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>Paris - France</p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 1mm;'>Fax:
            <span style='color: #213280; font-size: 11px; font-weight: lighter;'>+33 (0) 1 78 95 87 89</span></p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 1mm;'>Tlf:
            <span style='color: #213280; font-size: 11px; font-weight: lighter;'>+33 (0) 6 80 76 07 10</span></p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>sales@kalstein.eu</p>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 1mm;'>
            https://dev.kalstein.plus/plataforma/</p>
    </div>
    <div class='img-cont'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/FAQ_DE.png"
            style='float: left; width: 100%; height: 100%;'>
    </div>
    <div class='f-last'>
        <p style='margin: 0; padding: 0; text-align: center; font-size: 7px; margin-top: 5mm;'>KALSTEIN FRANCE S.A.S</p>
        <p style='margin: 0; padding: 0; text-align: center; font-size: 7px; margin-top: 0.1mm;'>• 2 Rue Jean Lantier, •
            75001 Paris •</p>
        <p style='margin: 0; padding: 0; text-align: center; font-size: 7px; margin-top: 0.1mm;'>+33 1 78 95 87 89 / +33
            6 80 76 07 10 • https://kalstein.eu</p>
    </div>
    <div class='style-07'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Seite [[page_cu]] von [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>