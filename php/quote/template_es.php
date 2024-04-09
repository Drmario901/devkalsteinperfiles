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
    $descuentoEspecial = 'Descuento especial (18%), aplicado.';
}

if ($envioM === 'Maritime') {
    $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>CIF $nameC (Coste + Flete + Seguro).</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Flete marítimo.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>45 - 60 días.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Seguro de envío, incluido</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'> $divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 año contra defectos de fabricación.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

    $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 19mm;'>Moneda:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantía:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Método de pago:</p>";
} else {
    if ($envioM === 'Aerial') {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>DAP $nameC (Entregado en el lugar).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Envío aéreo (servicio de mensajería).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'> 7 - 15 días.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Seguro de envío, incluido</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 año contra defectos de fabricación.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 15mm;'>Moneda:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantía:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Método de pago:</p>";
    } else {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$incoterm.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 año contra defectos de fabricación.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Moneda:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantía:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Método de pago:</p>";
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
                <p class='co'>COTIZACIÓN</p>
                <p class='id-title'>QUO<span class='id-n'><?php echo $id ?></span></p>
                <p class='msj'>UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO.</p>
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
            <p class='lt-01'>NUESTROS SERVICIOS</p>
            <p class='lt-02'>Beneficios y Respaldo</p>
            <p class='lt-03'>En Kalstein France, nos ocupamos de la plena sastifacción de nuestros clientes, es por eso
                que brindamos servicios de valor agregado del más alto nivel basados en nuestra experiencia.</p>
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
            <p class='i-title'>Inducciones y Entrenamientos Online</p>
            <p class='i-p'>En cualquier parte del mundo, reciba su inducción o capacitación de nuestro equipo
                especializado de ingenieros.</p>
        </div>
    </div>
    <div class='cmsj-02'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono2.png"
                style='float: right; width: 90%; margin-top: 45%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Rápida Respuesta</p>
            <p class='i-p'>Nuestro equipo de trabajo siempre está disponible para responder a todas sus consultas o
                preguntas, con el fin de ayudarlo en cualquier situación.</p>
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
            <p class='i-p'>Gracias a su compra, se hará una donación a una fundación sin fines de lucro que lucha contra
                el cáncer de seno y ayuda a las comunidades más vulnerables.</p>
        </div>
    </div>
    <div class='cmsj-04'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono4.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title1'>Soporte Técnico</p>
            <p class='i-p'>Disfrute de asesoramiento personalizado para el correcto mantenimiento preventivo y
                correctivo de su equipo, gracias a los manuales y artículos de Kalstein, catálogos especiales y video
                tutoriales.</p>
        </div>
    </div>
    <div class='cmsj-05'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono5.png"
                style='float: right; width: 100%; margin-top: 58%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title2'>Logísticas de Envío</p>
            <p class='i-p'>Nos ocupamos de toda la logística necesaria para el envío de sus productos, ya sea por mar,
                tierra o aire.</p>
        </div>
    </div>
    <div class='cmsj-06'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono6.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title3'>Kalstein a Nivel Mundial</p>
            <p class='i-p'>Con más de 25 años creciendo con nuestros clientes, el contenido multiformato y moderno de
                Kalstein ahora está presente en más de 10 países y sigue aumentando.</p>
        </div>
    </div>
    <div class='f2-text'>
        <p class='t-1'>Todos los derechos reservados ® KALSTEIN France S. A. S.,</p>
    </div>
    <div class='style-03'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Página [[page_cu]] de [[page_nb]]</p>
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
                <p style='font-weight: bold; margin: 0; padding: 0;'>Cotización N°: <span
                        style='font-weight: lighter;'>QUO<?php echo $id ?></span></p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'>Paris, <?php echo $onlyDate ?> <?php echo $onlyHours ?>
                </p>
            </div>
        </div>
        <div class='hr-04'></div>
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Sres:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $sres ?></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Atención:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $atc ?></p>
            </div>
        </div>
        <div class='c-table'>
            <table>
                <tr>
                    <td class='td-i'>Item</td>
                    <td class='td-m'>Modelo</td>
                    <td class='td-im'>Imagen</td>
                    <td class='td-d'>Descripción</td>
                    <td class='td-c'>Cant</td>
                    <td class='td-u'>Unid</td>
                    <td class='td-v'>Valor Unit.</td>
                    <td class='td-vt'>Valor Total</td>
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
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Marcado CE: para comprar con
                        tranquilidad</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Todos los equipos de Kalstein
                        cumplen con los requisitos de la UE, de acuerdo con las regulaciones pertinentes.</p>
                </div>
                <div class='img-cora'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono3.png"
                        style='float: right; width: 90%; margin-top: 7mm;'>
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Con la adquision de un equipo
                        Kalstein</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Usted hace una contribucion a la
                        Fundacion Jacinto Convit, OneTreePlanted, Humatem Foundation y la Fundacion Maniapure.</p>
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
                    <p style='text-align: right; font-size: 9px; margin-top: 6.5mm; font-weight: bold;'>Página
                        [[page_cu]] de [[page_nb]]</p>
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
                        <p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0;'>Observaciones:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm;'>
                            Tiempo de entrega:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>
                            Representante de ventas:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 12mm;'>
                            Terminos comerciales:</p>
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
                            7 - 10 días aprox.</p>
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
                            Pago anticipado con orden de compra.</p>
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
                            Subtotal:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>IVA:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Descuento (18%):</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Subtotal:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Envío:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Total:</p>
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
            <p class='lt4-01'>CONDICIONES COMERCIALES</p>
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
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px;'>ACEPTACIÓN DE ORDEN DE
            COMPRA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Kalstein France SAS
                recibe a satisfacción la orden de compra, cuando este documento expresa fielmente las condiciones
                comerciales establecidas en la oferta.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Pagos de contado:
                Para el trámite y despacho de la mercancía solicitada, es requerida la comprobación de pago en cuentas
                bancarias de Kalstein France.</p>
            <p
                style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm; margin-left: 0.2mm;'>
                Clientes con Crédito: Para el trámite y despacho de la mercancía solicitada, es requerida la
                comprobación de pago en cuentas bancarias de Kalstein France.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 10mm;'>MONEDA
            DE NEGOCIACIÓN</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
        </div>
        <div class='i-txt2'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Ofertas en moneda
                extranjera, se realizará el cálculo de conversión de moneda de acuerdo a lo establecido por el Banco de
                Francia, fijado el día de la facturación.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La moneda de
                negociacion establecida para la presente cotizacion es <?php echo $divisa ?>.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>GARANTIA
        </p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
        </div>
        <div class='i-txt3'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Todos los equipos
                comercializados por Kalstein France, tienen garantía de un año pordefectos de fabricación a partir de la
                fecha de la facturacion de la mercancía.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La garantía no
                cubre daños causados por mala instalación u operacion, defectos portransporte o por usos diferentes a
                los especificados por el fabricante.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La garantia excluye
                partes electricas o consumibles.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>TIEMPOS
            DE ENTREGA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
        </div>
        <div class='i-txt4'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Los tiempos de
                entrega indicados en esta cotizacion son estimaciones sujetas a variables.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 7mm;'>
            CANCELACIONES Y DEVOLUCIONES SIN JUSTA CAUSA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 9.5mm;'>•</p>
        </div>
        <div class='i-txt5'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Mercancía en
                inventario, tendrá una penalización equivalente al 20% del valor de la orden de compra.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Mercancía de
                Importación, después de recibida la orden de compra a satisfacción se disponede un máximo de (3) días
                para la cancelación de la orden de compra, pasado este tiempo no se aceptan cancelaciones y la mercancía
                será facturada conforme a lo establecido.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La devolución de la
                mercancía será responsabilidad del Cliente, la caja, envoltorios y todas las partes que conforman el
                equipo a devolver, deberán estar en perfectas condiciones sin maltrato, rayas y etiquetas adicionales,
                el equipo de Soporte técnico y logística de Kalstein France, realizará informe técnico e indicará el
                recibo a satisfacción de la mercancía. De no ser recibida a satisfacción se facturará el equipo conforme
                a lo establecido en la Orden de compra.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 22mm;'>
            POLÍTICAS, TÉRMINOS Y CONDICIONES GENERALES</p>
        <p style='margin: 0; padding: 0; font-size: 11px; margin-top: 1mm;'>
            https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='style-07'>
        <p
            style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>
            Página [[page_cu]] de [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
    <div class='style-06'></div>

    <div class='logo-05'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/logo.png"
            style='float: left; width: 60%; margin-top: 15mm; margin-left: 10mm;'><br><br><br><br><br><br><br><br>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 9px; margin-top: -2mm; margin-left: 28mm;'>Un
            acompañamiento diferente, a su servicio</p>
    </div>
    <div class='img-loc'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen4.jpg"
            style='float: left; width: 100%;'>
    </div>
    <div class='inf-cont'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 16px;'>¿ALGUNA PREGUNTA?</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>Contáctanos:</p>
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
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/FAQ_ES.png"
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
            Página [[page_cu]] de [[page_nb]]</p>
    </div>
    <div class='style-08'></div>
</page>