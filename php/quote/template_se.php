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
    $descuentoEspecial = 'Särskild rabatt (18%), tillämpas.';
}

if ($envioM === 'Maritime') {
    $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>CIF $nameC (Kostnad + frakt + försäkring).</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Sjöfrakt.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>45 - 60 dagar.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Försäkring för leverans ingår</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'> $divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 år mot tillverkningsfel.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

    $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 19mm;'>Valuta:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garanti:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Betalningsmetod:</p>";
} else {
    if ($envioM === 'Aerial') {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>DAP $nameC (Levereras på plats).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Luftfrakt (kurirtjänst).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'> 7 - 15 dagar.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Försäkring för leverans ingår</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 år mot tillverkningsfel.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 15mm;'>Valuta:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garanti:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Betalningsmetod:</p>";
    } else {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$incoterm.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 år mot tillverkningsfel.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Valuta:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garanti:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Betalningsmetod:</p>";
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
                <p class='co'>OFFERT</p>
                <p class='id-title'>QUO<span class='id-n'><?php echo $id ?></span></p>
                <p class='msj'>EN ANNAN MEDFÖLJANDE, TILL DIN TJÄNST</p>
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
            <p class='lt-01'>VÅRA TJÄNSTER</p>
            <p class='lt-02'>Fördelar och support</p>
            <p class='lt-03'>På Kalstein France tar vi hand om våra kunders fulla tillfredsställelse, det är därför vi
                tillhandahåller mervärdestjänster på högsta nivå baserat på vår erfarenhet.</p>
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
            <p class='i-title'>Introduktion och onlineutbildning</p>
            <p class='i-p'>I alla delar av världen, ta emot din introduktion eller utbildning från vårt specialiserade
                team av ingenjörer.</p>
        </div>
    </div>
    <div class='cmsj-02'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono2.png"
                style='float: right; width: 90%; margin-top: 45%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Snabbt svar</p>
            <p class='i-p'>Vårt arbetsteam är alltid tillgängligt för att svara på alla dina frågor eller frågor, för
                att hjälpa till i alla situationer.</p>
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
            <p class='i-p'>Tack vare ditt köp kommer en donation att göras till en ideell stiftelse som bekämpar
                bröstcancer och hjälper de mest utsatta grupperna.</p>
        </div>
    </div>
    <div class='cmsj-04'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono4.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title1'>Teknisk support</p>
            <p class='i-p'>Njut av personlig rådgivning för korrekt förebyggande och korrigerande underhåll av din
                utrustning, tack vare Kalstein manualer och artiklar, särskilda kataloger och video handledningar.</p>
        </div>
    </div>
    <div class='cmsj-05'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono5.png"
                style='float: right; width: 100%; margin-top: 58%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title2'>Leveranslogistik</p>
            <p class='i-p'>Vi tar hand om all logistik som krävs för att frakta dina produkter, oavsett om det sker till
                sjöss, på land eller med flyg.</p>
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
            <p class='i-p'>Med över 25 års tillväxt med våra kunder finns Kalsteins moderna innehåll i flera format nu i
                över 10 länder och växer.</p>
        </div>
    </div>
    <div class='f2-text'>
        <p class='t-1'>Med ensamrätt ® KALSTEIN France S. A. S.,</p>
    </div>
    <div class='style-03'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Sidan [[page_cu]] av [[page_nb]]</p>
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
                <p style='font-weight: bold; margin: 0; padding: 0;'>Offert N°: <span
                        style='font-weight: lighter;'>QUO<?php echo $id ?></span></p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'>Paris, <?php echo $onlyDate ?> <?php echo $onlyHours ?>
                </p>
            </div>
        </div>
        <div class='hr-04'></div>
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Serviceenheter:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $sres ?></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Uppmärksamhet:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $atc ?></p>
            </div>
        </div>
        <div class='c-table'>
            <table>
                <tr>
                    <td class='td-i'>Item</td>
                    <td class='td-m'>Modell</td>
                    <td class='td-im'>Bild</td>
                    <td class='td-d'>Beskrivning</td>
                    <td class='td-c'>Kvantitet</td>
                    <td class='td-u'>Unid</td>
                    <td class='td-v'>Enhetsvärde</td>
                    <td class='td-vt'>Totalt värde</td>
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
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>CE-märkning: att köpa med
                        sinnesro</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>All Kalsteinutrustning uppfyller
                        EU:s krav i enlighet med relevanta bestämmelser.</p>
                </div>
                <div class='img-cora'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono3.png"
                        style='float: right; width: 90%; margin-top: 7mm;'>
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Med förvärvet av en
                        Kalstein-utrustning</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Du bidrar till Jacinto Convit
                        Foundation, OneTreePlanted, Humatem Foundation och Maniapure Foundation.</p>
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
                    <p style='text-align: right; font-size: 9px; margin-top: 6.5mm; font-weight: bold;'>Sidan
                        [[page_cu]] av [[page_nb]]</p>
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
                        <p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0;'>Iakttagelser:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm;'>
                            Leveranstider:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>
                            Säljare:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 12mm;'>
                            Handelsvillkor:</p>
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
                            7 - 10 dagar ca.</p>
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
                            Förskottsbetalning med inköpsorder.</p>
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
                            Delsumma:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>IVA:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Avstängning (18%):</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Delsumma:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Leverans:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Summa:</p>
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
            <p class='lt4-01'>HANDELSVILLKOR</p>
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
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px;'>GODKÄNNANDE AV INKÖPSORDER
        </p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 4mm;'>•</p>
        </div>
        <div class='i-txt'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Kalstein France SAS
                får en köpordertillfredsställelse, när detta dokument troget uttrycker de kommersiella villkor som
                fastställs i erbjudandet.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Kontantbetalningar:
                För hantering och avsändande av de begärda varorna krävs kontroll av betalning på Kalstein Frances
                bankkonton.</p>
            <p
                style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm; margin-left: 0.2mm;'>
                Kunder med kredit: För behandling och avsändning av de begärda varorna krävs betalningsbevis i Kalstein
                France bankkonton.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 10mm;'>
            HANDELSVALUTA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
        </div>
        <div class='i-txt2'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: -3mm;'>Anbud i utländsk
                valuta, valutakonverteringen kommer att utföras i enlighet med bestämmelserna i Bank of France, som
                fastställts på fakturadagen.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Den etablerade
                handelsvalutan för denna notering är <?php echo $divisa ?>.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>GARANTI
        </p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 4mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 5.8mm;'>•</p>
        </div>
        <div class='i-txt3'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: -6.5mm;'>All utrustning
                som säljs av Kalstein France har ett års garanti för tillverkningsändamål från och med fakturadatumet
                för varorna.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Garantin omfattar
                inte skador som orsakats av dålig installation eller drift, transportdefekter eller av andra
                användningsområden än de som anges av tillverkaren.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Garantin gäller
                inte reservdelar eller förbrukningsartiklar.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>
            LEVERANSTIDER</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
        </div>
        <div class='i-txt4'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: -10mm;'>De leveranstider
                som anges i denna offert är uppskattningar som omfattas av variabler.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 7mm;'>
            AVBOKNINGAR OCH RETURER UTAN SKÄLIG ORSAK</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 9.5mm;'>•</p>
        </div>
        <div class='i-txt5'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: -10mm;'>Varor i lager
                kommer att ha en straffavgift som motsvarar 20% av värdet på inköpsordern.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Importera varor,
                efter att ha mottagit inköpsordern till belåtenhet, det finns ett maximum av (3) dagar för att annullera
                inköpsordern, efter denna tid annulleringar inte accepteras och varorna kommer att faktureras som
                etablerade.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Återlämnandet av
                varorna kommer att vara kundens ansvar, lådan, förpackningen och alla delar som utgör utrustningen som
                ska returneras, måste vara i perfekt skick utan misshandel, repor och ytterligare etiketter, Kalstein
                Frankrike teknisk support och logistik team, utföra teknisk rapport och kommer att ange
                tillfredsställande mottagande av varorna. Om utrustningen inte tas emot på ett tillfredsställande sätt
                kommer den att faktureras i enlighet med bestämmelserna i inköpsordern.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 22mm;'>ALLMÄNNA
            PRINCIPER, VILLKOR</p>
        <p style='margin: 0; padding: 0; font-size: 11px; margin-top: 1mm;'>
            https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='style-07'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Sidan [[page_cu]] av [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
    <div class='style-06'></div>

    <div class='logo-05'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
            style='float: left; width: 60%; margin-top: 15mm; margin-left: 10mm;'><br><br><br><br><br><br><br><br>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 9px; margin-top: -2mm; margin-left: 28mm;'>Ett
            annorlunda tillbehör till din tjänst</p>
    </div>
    <div class='img-loc'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen4.jpg"
            style='float: left; width: 100%;'>
    </div>
    <div class='inf-cont'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 18px;'>NÅGRA FRÅGOR?</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>Kontakta oss:</p>
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
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/FAQ_SE.png"
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
            Sidan [[page_cu]] av [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>