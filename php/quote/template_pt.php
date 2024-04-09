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
    $descuentoEspecial = 'Desconto especial (18%), aplicado.';
}

if ($envioM === 'Maritime') {
    $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>CIF $nameC (Custo + Frete + Seguro).</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Carga marítima.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>45 - 60 dias.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Seguro de embarque incluído</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'> $divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 ano contra defeitos de fabrico.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

    $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 19mm;'>Moeda:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantia:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Forma de pagamento:</p>";
} else {
    if ($envioM === 'Aerial') {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>DAP $nameC (Entregue no local).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Carga aérea (serviço de courier).</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'> 7 - 15 dias.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Seguro de embarque incluído</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 ano contra defeitos de fabrico.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 15mm;'>Moeda:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantia:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Forma de pagamento:</p>";
    } else {
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$incoterm.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$divisa.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>1 ano contra defeitos de fabrico.</p>
            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3mm; margin-left: 3mm;'>$pago.</p>";

        $a = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Moeda:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Garantia:</p>
            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>Forma de pagamento:</p>";
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
                <p class='co'>CITAÇÃO</p>
                <p class='id-title'>QUO<span class='id-n'><?php echo $id ?></span></p>
                <p class='msj'>UM ACOMPANHAMENTO DIFERENTE, AO SEU SERVIÇO</p>
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
            <p class='lt-01'>NOSSOS SERVIÇOS</p>
            <p class='lt-02'>Benefícios e suporte</p>
            <p class='lt-03'>Na Kalstein France, cuidamos da plena satisfação dos nossos clientes, razão pela qual
                prestamos serviços de valor acrescentado ao mais alto nível com base na nossa experiência.</p>
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
            <p class='i-title'>Induções e treinamentos on-line</p>
            <p class='i-p'>Em qualquer parte do mundo, receba sua indução ou treinamento de nossa equipe especializada
                de engenheiros.</p>
        </div>
    </div>
    <div class='cmsj-02'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono2.png"
                style='float: right; width: 90%; margin-top: 45%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title'>Resposta rápida</p>
            <p class='i-p'>Nossa equipe de trabalho está sempre disponível para responder a todas as suas perguntas, a
                fim de ajudar em qualquer situação.</p>
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
            <p class='i-p'>Graças à sua compra, será feita uma doação a uma fundação sem fins lucrativos que combate o
                câncer de mama e ajuda as comunidades mais vulneráveis.</p>
        </div>
    </div>
    <div class='cmsj-04'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono4.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title1'>Suporte técnico</p>
            <p class='i-p'>Desfrute de conselhos personalizados para a correta manutenção preventiva e corretiva do seu
                equipamento, graças a manuais e artigos da Kalstein, catálogos especiais e tutoriais em vídeo.</p>
        </div>
    </div>
    <div class='cmsj-05'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono5.png"
                style='float: right; width: 100%; margin-top: 58%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title2'>Logística de Entrega</p>
            <p class='i-p'>Nós cuidamos de toda a logística necessária para o envio de seus produtos, seja por mar,
                terra ou ar.</p>
        </div>
    </div>
    <div class='cmsj-06'>
        <div class='i'>
            <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono6.png"
                style='float: right; width: 100%; margin-top: 48%'>
        </div>
        <div class='hr-03'></div>
        <div class='i-text'>
            <p class='i-title3'>Kalstein no mundo inteiro</p>
            <p class='i-p'>Com mais de 25 anos crescendo com nossos clientes, o conteúdo moderno e multiformato da
                Kalstein está presente em mais de 10 países e crescendo.</p>
        </div>
    </div>
    <div class='f2-text'>
        <p class='t-1'>Todos os direitos reservados ® KALSTEIN France S. A. S.,</p>
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
                <p style='font-weight: bold; margin: 0; padding: 0;'>Citação N°: <span
                        style='font-weight: lighter;'>QUO<?php echo $id ?></span></p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'>Paris, <?php echo $onlyDate ?> <?php echo $onlyHours ?>
                </p>
            </div>
        </div>
        <div class='hr-04'></div>
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Senhores:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $sres ?></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Atenção:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm;'><?php echo $atc ?></p>
            </div>
        </div>
        <div class='c-table'>
            <table>
                <tr>
                    <td class='td-i'>Item</td>
                    <td class='td-m'>Modelo</td>
                    <td class='td-im'>Imagem</td>
                    <td class='td-d'>Descrição</td>
                    <td class='td-c'>Qtd.</td>
                    <td class='td-u'>Unid</td>
                    <td class='td-v'>Valor Unitário.</td>
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
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Marcação CE: comprar com
                        tranquilidade</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>Todos os equipamentos Kalstein
                        cumprem os requisitos da UE, em conformidade com a regulamentação pertinente.</p>
                </div>
                <div class='img-cora'>
                    <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/icono3.png"
                        style='float: right; width: 90%; margin-top: 7mm;'>
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px;'>Com a aquisição de um
                        equipamento Kalstein</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm;'>YVocê contribui para a Fundação
                        Convite de Jacinto, OneTreePlanted, Humatem Foundation e a Fundação Maniapure.</p>
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
                        <p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0;'>Observações:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm;'>
                            Prazos de entrega:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3mm;'>
                            Representante de vendas:</p>
                        <p
                            style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 12mm;'>
                            Termos comerciais:</p>
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
                            7 - 10 dias aprox..</p>
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
                            Pagamento antecipado com Ordem de Compra.</p>
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
                        margin-top: 2mm;'>Desconto (18%):</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Subtotal:</p>
                        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;
                        margin-top: 2mm;'>Remessa:</p>
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
            <p class='lt4-01'>TERMOS COMERCIAIS</p>
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
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px;'>ACEITAÇÃO DA ORDEM DE
            COMPRA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>A Kalstein France
                SAS recebe uma ordem de compra satisfatória, quando o presente documento exprime fielmente as condições
                comerciais estabelecidas na oferta.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Pagamentos em
                numerário: Para o processamento e expedição da mercadoria solicitada, é necessária a verificação do
                pagamento nas contas bancárias da Kalstein France.</p>
            <p
                style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm; margin-left: 0.2mm;'>
                Clientes com Crédito: para o processamento e despacho da mercadoria solicitada, é necessária prova de
                pagamento em contas bancárias Kalstein France.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 10mm;'>MOEDA
            COMERCIAL</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
        </div>
        <div class='i-txt2'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Ofertas em moeda
                estrangeira, o cálculo da conversão cambial será realizado de acordo com as disposições do Banco de
                França, definidas no dia da faturação.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>A moeda comercial
                estabelecida para esta listagem é <?php echo $divisa ?>.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>GARANTIA
        </p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 4.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 5.5mm;'>•</p>
        </div>
        <div class='i-txt3'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Todos os
                equipamentos vendidos pela Kalstein France têm uma garantia de um ano para efeitos de fabrico a partir
                da data de faturação dos bens.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>A garantia não
                cobre danos causados por má instalação ou operação, defeitos de transporte ou por outros usos que não os
                especificados pelo fabricante.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>A garantia exclui
                peças elétricas ou consumíveis.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 5mm;'>PRAZOS DE
            ENTREGA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
        </div>
        <div class='i-txt4'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>Os prazos de
                entrega indicados nesta cotação são estimativas sujeitas a variáveis.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 7mm;'>
            CANCELAMENTOS E DEVOLUÇÕES SEM JUSTA CAUSA</p>
        <div class='i-list'>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p style='text-align: center; margin: 0; padding: 0; margin-top: 9.5mm;'>•</p>
        </div>
        <div class='i-txt5'>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>A mercadoria em
                estoque terá penalidade equivalente a 20% do valor da ordem de compra.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>IImportar
                Mercadoria, depois de receber a ordem de compra a contento, há um máximo de (3) dias para cancelar a
                ordem de compra, depois desse tempo os cancelamentos não são aceitos e a mercadoria será faturada
                conforme estabelecido.</p>
            <p style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>A devolução da
                mercadoria ficará a cargo do Cliente, da caixa, da embalagem e de todas as peças que compõem o
                equipamento a ser devolvido, devendo estar em perfeitas condições, sem maus-tratos, arranhões e
                etiquetas adicionais, realizando o relatório técnico da equipe de Suporte Técnico e Logística Kalstein
                France e indicando o recebimento satisfatório da mercadoria. Se não for recebido de forma satisfatória,
                o equipamento será faturado de acordo com as disposições do Pedido de compra.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 12px; margin-top: 22mm;'>GENERAL
            POLICIES, TERMS AND CONDITIONS</p>
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
        <p style='margin: 0; padding: 0; color: #213280; font-size: 9px; margin-top: -2mm; margin-left: 28mm;'>Um
            acompanhamento diferente, ao seu serviço</p>
    </div>
    <div class='img-loc'>
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/imagen4.jpg"
            style='float: left; width: 100%;'>
    </div>
    <div class='inf-cont'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 16px;'>ALGUMA PERGUNTA?</p>
        <p style='margin: 0; padding: 0; color: #213280; font-size: 11px; margin-top: 1mm;'>CFale conosco:</p>
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
        <img src="https://dev.kalstein.plus/plataforma/en/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/assets/images/FAQ_PT.png"
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