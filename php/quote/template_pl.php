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
    $descuentoEspecial = 'Specjalny rabat (18%), zastosowany.';
}

if ($envioM === 'Maritime') {
    $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>CIF $nameC (Koszt + fracht + ubezpieczenie).</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Fracht morski.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>45 - 60 dni.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Ubezpieczenie przesyłki wliczone w cenę</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'> $divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 rok na wady produkcyjne.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

    $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 19mm;'>Waluta:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Gwarancja:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Sposób płatności:</p>";
} else {
    if ($envioM === 'Aerial') {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>DAP $nameC (Dostarczane na miejsce).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Fracht lotniczy (usługa kurierska).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'> 7 - 15 dni.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Ubezpieczenie przesyłki wliczone w cenę</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 rok na wady produkcyjne.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 15mm;'>Waluta:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Gwarancja:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Sposób płatności::</p>";
    } else {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$incoterm.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 rok na wady produkcyjne.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Waluta:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Gwarancja:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Sposób płatności::</p>";
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
                <p class='co'>CYTAT</p>
                <p class='id-title'>QUO<span class='id-n'><?php echo $id ?></span></p>
                <p class='msj'>INNY AKOMPANIAMENT, DO TWOJEJ DYSPOZYCJI</p>
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
            <p class='lt-01'>NASZE US&#322;UGI</p>
            <p class='lt-02'>Korzyści i wsparcie</p>
            <p class='lt-03'>W Kalstein France dbamy o pełną satysfakcję naszych klientów, dlatego świadczymy usługi o
                wartości dodanej na najwyższym poziomie w oparciu o nasze doświadczenie.</p>
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
            <p class='i-title'>Indukcje i szkolenia online</p>
            <p class='i-p'>W dowolnej części świata skorzystaj z indukcji lub szkolenia od naszego wyspecjalizowanego
                zespołu inżynierów.</p>
        </div>
    </div>
    <div class='cmsj-02'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono2.png"
                style='float: right; width: 90%; margin-top: 45%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Szybka odpowiedź</p>
            <p class='i-p'>Nasz zespół roboczy jest zawsze dostępny, aby odpowiedzieć na wszystkie pytania lub pytania,
                aby pomóc w każdej sytuacji.</p>
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
            <p class='i-p'>Dzięki zakupowi zostanie przekazana darowizna na rzecz fundacji non-profit, która zwalcza
                raka piersi i pomaga najbardziej narażonym społecznościom.</p>
        </div>
    </div>
    <div class='cmsj-04'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono4.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title1'>Pomoc techniczna</p>
            <p class='i-p'>Korzystaj z spersonalizowanych porad dotyczących prawidłowej konserwacji zapobiegawczej i
                naprawczej sprzętu, dzięki podręcznikom i artykułom firmy Kalstein, katalogom specjalnym i samouczkom
                wideo.</p>
        </div>
    </div>
    <div class='cmsj-05'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono5.png"
                style='float: right; width: 100%; margin-top: 58%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title2'>Logistyka wysyłki</p>
            <p class='i-p'>Dbamy o wszystkie logistyki niezbędne do wysyłki produktów, czy to drogą morską, lądową czy
                powietrzną.</p>
        </div>
    </div>
    <div class='cmsj-06'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono6.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title3'>Kalstein na całym świecie</p>
            <p class='i-p'>WWraz z ponad 25-letnim rozwojem naszych klientów, nowoczesne, wieloformatowe treści
                Kalsteina są obecnie obecne w ponad 10 krajach i rozwijają się.</p>
        </div>
    </div>
    <div class='f2-text'>
        <p class='t-1'>Wszelkie prawa zastrzeżone ® KALSTEIN France S. A. S.,</p>
    </div>
    <div class='style-03'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Strona [[page_cu]] z [[page_nb]]</p>
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
                <p style='font-weight: bold; margin: 0; padding: 0;'>Cytat N°: <span
                        style='font-weight: lighter;'>QUO<?php echo $id ?></span></p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'>Paris, <?php echo $onlyDate ?> <?php echo $onlyHours ?>
                </p>
            </div>
        </div>
        <div class='hr-04'></div>
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Panowie:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $sres ?></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Uwaga:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $atc ?></p>
            </div>
        </div>
        <div class='c-table'>
            <table>
                <tr>
                    <td class='td-i'>Item</td>
                    <td class='td-m'>Wzór</td>
                    <td class='td-im'>Obraz</td>
                    <td class='td-d'>Opis</td>
                    <td class='td-c'>Ilość</td>
                    <td class='td-u'>Unid</td>
                    <td class='td-v'>Wartość jednostki</td>
                    <td class='td-vt'>Łączna wartość</td>
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
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Oznakowanie CE: kupić z
                        spokojem</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Wszystkie urządzenia Kalstein
                        spełniają wymagania UE, zgodnie z odpowiednimi przepisami.</p>
                </div>
                <div class='img-cora'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono3.png"
                        style='float: right; width: 90%; margin-top: 7mm;'>
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Wraz z zakupem sprzętu
                        Kalsteina</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Wnosisz wkład w Fundację Jacinto
                        Convit, OneTreePlanted, Fundację Humatem i Fundację Maniapure.</p>
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
                    <p style='text-align: right; font-size: 9px; margin-top: 6.5mm; font-weight: bold;'>Strona
                        [[page_cu]] z [[page_nb]]</p>
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
                        <p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0;'>Uwagi:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm;'>
                            Godziny dostawy:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>
                            Przedstawiciel handlowy:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 12mm;'>
                            Warunki handlowe:</p>
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
                            7 - 10 dni ok.</p>
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
                            Przedpłata z zamówieniem zakupu.</p>
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
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>Suma
                            częściowa:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>IVA:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Rabat (18%):</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Suma częściowa:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Wysyłka:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Ogółem:</p>
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
            <p class='lt4-01'>WARUNKI HANDLOWE</p>
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
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px;'>PURCHASE ORDER ACCEPTANCE
        </p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
        </div>
        <div class='i-txt'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Kalstein France SAS
                otrzymuje satysfakcję z zamówienia zakupu, gdy dokument ten wiernie wyraża warunki handlowe ustanowione
                w ofercie.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Płatności
                gotówkowe: Do przetwarzania i wysyłki zamówionego towaru wymagana jest weryfikacja płatności na
                rachunkach bankowych Kalstein France.</p>
            <p
                style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm; margin-left: 0.2mm;'>
                Klienci z Credit: Do przetwarzania i wysyłki zamówionego towaru wymagany jest dowód wpłaty na rachunkach
                bankowych Kalstein France.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 10mm;'>WALUTA
            HANDLOWA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
        </div>
        <div class='i-txt2'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 0mm;'>Oferty w walucie
                obcej, przeliczenie waluty zostanie przeprowadzone zgodnie z przepisami Banku Francji, ustalonymi w dniu
                fakturowania.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Ustanowiona waluta
                handlowa dla tej aukcji to <?php echo $divisa ?>.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>GWARANCJA
        </p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 4mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt3'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: -3mm;'>Wszystkie
                urządzenia sprzedawane przez Kalstein France objęte są roczną gwarancją na cele produkcyjne od daty
                wystawienia faktury za towar.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Gwarancja nie
                obejmuje uszkodzeń spowodowanych złą instalacją lub działaniem, wadami transportowymi lub innymi
                zastosowaniami niż podane przez producenta.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Gwarancja nie
                obejmuje części elektrycznych i eksploatacyjnych.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>CZASY
            DOSTAWY</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 5mm;'>•</p>
        </div>
        <div class='i-txt4'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: -5mm;'>Czasy dostawy
                wskazane w tej ofercie są szacunkami podlegającymi zmiennym.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 7mm;'>ODWOŁANIA
            I ZWROTY BEZ UZASADNIONEJ PRZYCZYNY</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 9.5mm;'>•</p>
        </div>
        <div class='i-txt5'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: -3mm;'>Merchandise in
                inventory will have a penalty equivalent to 20% of the value of the purchase order.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Importuj towar, po
                otrzymaniu zamówienia zakupu w sposób zadowalający, istnieje maksymalnie (3) dni na anulowanie
                zamówienia zakupu, po tym czasie anulowania nie są akceptowane, a towar zostanie zafakturowany, jak
                ustalono.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Za zwrot towaru
                odpowiedzialny będzie Klient, pudełko, opakowanie i wszystkie części składające się na sprzęt, który ma
                być zwrócony, musi być w idealnym stanie bez złego traktowania, zadrapań i dodatkowych etykiet, Zespół
                Wsparcia Technicznego i Logistyki Kalstein France, prowadzący raport techniczny i wskaże zadowalający
                odbiór towaru. W przypadku niezadowalającego odbioru sprzęt zostanie zafakturowany zgodnie z
                postanowieniami Zamówienia.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 22mm;'>OGÓLNE
            ZASADY, WARUNKI I POSTANOWIENIA</p>
        <p style='margin: 0; padding: 0; font-size: 11px; margin-top: 1mm;'>
            https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='style-07'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Strona [[page_cu]] z [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
    <div class='style-06'></div>

    <div class='logo-05'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
            style='float: left; width: 60%; margin-top: 15mm; margin-left: 10mm;'><br><br><br><br><br><br><br><br>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 9px; margin-top: -2mm; margin-left: 28mm;'>Inny
            akompaniament, do usług</p>
    </div>
    <div class='img-loc'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen4.jpg"
            style='float: left; width: 100%;'>
    </div>
    <div class='inf-cont'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 16px;'>MASZ JAKIEŚ PYTANIA?</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>Skontaktuj się z nami:</p>
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
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/FAQ_PL.png"
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
            Strona [[page_cu]] z [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>