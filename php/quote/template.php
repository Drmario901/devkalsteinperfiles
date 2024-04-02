<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_GET['idCotizacion']) {
    $idCotizacion = $_GET['idCotizacion'];
} else {
    if (isset($_SESSION['idCotizacion'])) {
        $idCotizacion = $_SESSION['idCotizacion'];
    } else {
        $idCotizacion = '';
    }
}

if (isset($_SESSION["emailAccount"])) {
    $emailAcc = $_SESSION["emailAccount"];
    $emailEncrypt = md5($emailAcc);
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
$arancel = $row["cotizacion_arancel"];
$envio = $row["cotizacion_envio"];
$total = $row["cotizacion_total"];
$incoterm = $row["cotizacion_incoterm"];
$divisa = $row["cotizacion_divisa"];
$pago = $row["cotizacion_metodo_pago"];
$envioM = $row["cotizacion_metodo_envio"];
$country = $row["cotizacion_destino"];

if ($country === 0 || $country === "") {
    $nameC = "";
} else {
    $query = "SELECT * FROM wp_paises WHERE iso = '$country'";
    $rs = $conexion->query($query);
    $row = mysqli_fetch_array($rs);
    $nameC = $row['en'];
}

$consultCountryEU = "SELECT * FROM wp_eu_country WHERE eu_country_iso = '$country'";
$resultCountryEU = $conexion->query($consultCountryEU);
$countCountryEU = mysqli_num_rows($resultCountryEU);
if ($countCountryEU > 0) {
    $eu = 'EU';
} else {
    $eu = '';
}

if ($incoterm === 'EXW Kalstein Paris') {
    $encabezadoObservations = "<p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0; padding-left: 5mm;'>Observations:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2mm;'>Délais de livraison:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 1.5mm;'>Représentant des ventes:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 6.3mm;'>Conditions commerciales:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 2.3mm;'>Incoterm:</p>";
    $descuentoEspecial = '';
    $txtDiscount = '';
    $numDiscount = '';
    $txtSubTotalC = '';
    $subtotalC = '';
    $origin = 'Paris - Francia';
    $txtIncoterm = 'EXW Kalstein Paris.';
    $envio = "<a href='https://plateforme.kalstein.be/dashboard/?userToConsultPriceShipping=$emailEncrypt&countryToConsultPriceShipping=$country&idCotizacion=$idCotizacion'>Pour consulter</a>";
    if ($iva != 0) {
        $txtIva = "<p id='autoGen6'>TVA (20%):</p>";
        $numIva = "<p id='autoGen7'>$iva</p>";
    } else {
        $txtIva = '';
        $numIva = '';
    }
    if ($envioM === 'Aerial') {
        $deliveryTime = '15 - 30 jours environ.';
    } else {
        $deliveryTime = '60 jours environ.';
    }
    $txtArancel = "";
    $numArancel = "";
    $transitTimeM = "<p id='autoGen8'>&nbsp;</p>
        <p id='autoGen9'>&nbsp;</p>
        <p id='autoGen10'>&nbsp;</p>";
    $transitTimeA = "<p id='autoGen11'>&nbsp;</p>
        <p id='autoGen12'>&nbsp;</p>
        <p id='autoGen13'>&nbsp;</p>";
} else {
    $encabezadoObservations = "<p id='autoGen62'>Observations:</p>
        <p id='autoGen14'>Délais de livraison:</p>
        <p id='autoGen15'>Représentant des ventes:</p>
        <p id='autoGen16'>Conditions commerciales:</p>
        <p id='autoGen17'>Incoterm:</p>";
    $descuentoEspecial = 'Remise spéciale (18 %), appliquée.';
    $deliveryTime = '7 - 10 jours environ.';
    $txtIva = '';
    $numIva = '';
    $txtDiscount = '<p id="autoGen18">Remise (18 %) :</p>';
    $numDiscount = '<p id="autoGen19">' . $desc . '</p>';
    $txtSubTotalC = '<p id="autoGen20">Sous-total:</p>';
    $subtotalC = '<p id="autoGen21">' . $subtotal2 . '</p>';
    $origin = 'Shanghai - China';
    if ($envioM === 'Aerial') {
        $txtIncoterm = 'DDP ' . $nameC . ' (Rendu Droits Acquittés).';
    } else {
        $txtIncoterm = 'CIF ' . $nameC . ' (Coût + Assurance + Fret).';
    }

    if ($arancel != 0) {
        $txtArancel = "<p id='autoGen22'>Tarif:</p>";
        $numArancel = "<p id='autoGen23'>$arancel</p>";
    } else {
        $txtArancel = "";
        $numArancel = "";
    }

    $transitTimeM = "<p id='autoGen24'>Fret maritime.</p>
        <p id='autoGen25'>45 - 60 jours.</p>
        <p id='autoGen26'>Assurance transport incluse</p>";
    $transitTimeA = "<p id='autoGen27'>Fret aérien (service de messagerie).</p>
        <p id='autoGen28'> 7 - 15 jours.</p>
        <p id='autoGen29'>Assurance transport incluse</p>";
}

if ($envioM === 'Maritime') {
    $b = "<p id='autoGen30'>$txtIncoterm</p>
        $transitTimeM
        <p id='autoGen31'> $divisa.</p>
        <p id='autoGen32'>1 an contre les défauts de fabrication.</p>
        <p id='autoGen33'>$pago.</p>
        <p id='autoGen34'>$origin.</p>";

    $a = "
        <p id='autoGen35'>Temps de transit:</p>
        <p id='autoGen36'>Devise:</p>
        <p id='autoGen37'>Garantie:</p>
        <p id='autoGen38'>Méthode de paiement:</p>
        <p id='autoGen39'>Origine:</p>";
} else {
    if ($envioM === 'Aerial') {
        $b = "<p id='autoGen40'>$txtIncoterm</p>
            $transitTimeA
            <p id='autoGen41'>$divisa.</p>
            <p id='autoGen42'>1 an contre les défauts de fabrication.</p>
            <p id='autoGen43'>$pago.</p>
            <p id='autoGen44'>$origin.</p>";

        $a = "
            <p id='autoGen45'>Temps de transit:</p>
            <p id='autoGen46'>Devise:</p>
            <p id='autoGen47'>Garantie:</p>
            <p id='autoGen48'>Méthode de paiement:</p>
            <p id='autoGen49'>Origine:</p>";
    } else {
        $txtArancel = "";
        $numArancel = "";
        $b = "<p id='autoGen50'>$incoterm.</p>
            <p id='autoGen51'>&nbsp;</p>
            <p id='autoGen52'>&nbsp;</p>
            <p id='autoGen53'>$divisa.</p>
            <p id='autoGen54'>1 an contre les défauts de fabrication.</p>
            <p id='autoGen55'>$pago.</p>
            <p id='autoGen56'>$origin.</p>";

        $a = "
            <p id='autoGen57'>Temps de transit:</p>
            <p id='autoGen58'>Devise:</p>
            <p id='autoGen59'>Garantie:</p>
            <p id='autoGen60'>Méthode de paiement:</p>
            <p id='autoGen61'>Origine:</p>";
    }
}

$resultado = $conexion->query($consulta2);
$imagen01 = __DIR__ . '/../assets/images/francia-pais.jpg';
$imagen02 = __DIR__ . '/../assets/images/fondoSolid.png';
$imagen03 = __DIR__ . '/../assets/images/LogoActualizado2.png';
$imagen04 = __DIR__ . '/../assets/images/qr.jpg';
$imagen05 = __DIR__ . '/../assets/images/k+blanco.png';
$imagen06 = __DIR__ . '/../assets/images/imagen1.jpg';
$imagen07 = __DIR__ . '/../assets/images/img2p.png';
$imagen08 = __DIR__ . '/../assets/images/img1p.png';
$imagen09 = __DIR__ . '/../assets/images/icono1.png';
$imagen10 = __DIR__ . '/../assets/images/icono2.png';
$imagen11 = __DIR__ . '/../assets/images/icono3.png';
$imagen12 = __DIR__ . '/../assets/images/icono4.png';
$imagen13 = __DIR__ . '/../assets/images/icono5.png';
$imagen14 = __DIR__ . '/../assets/images/icono6.png';
$imagen15 = __DIR__ . '/../assets/images/corazon.png';
$imagen16 = __DIR__ . '/../assets/images/img-ce.jpg';
$imagen17 = __DIR__ . '/../assets/images/imagen4.jpg';
$imagen18 = __DIR__ . '/../assets/images/FAQ_ES.png';
?>
<link rel="stylesheet" type="text/css" href="pdf.css">
<div class='PDFcp01'>
    <div class="PDFbackground-img" style="background-image: url(<?php echo $imagen02; ?>);">
    </div>
    <div class='PDFh-01'>
        <img src="<?php echo $imagen01 ?>" id='PDFp1Img01'>
    </div>
    <div class='PDFb-01'>
        <div class='PDFid'>
            <div class='PDFlogo'>
                <img src="<?php echo $imagen03 ?>" id="PDFLogoP1">
            </div>
            <div class='PDFhr'></div>
            <div class='PDFn-id'>
                <p class='PDFco'>DEVIS</p>
                <p class='PDFid-title'>QUO<span class='id-n'>
                        <?php echo $id ?>
                    </span></p>
                <p class='PDFmsj'>UN ACCOMPAGNEMENT DIFFÉRENT, À VOTRE SERVICE</p>
            </div>
        </div>
        <div class='PDFf-01'>
            <div class='PDFqr'>
                <img src="<?php echo $imagen04 ?>" id='PDFf-01-img'>
            </div>
            <div class='PDFf-text'>
                <p class='PDFl-1'>Tous droits réservés ® KALSTEIN France S. A. S.,</p>
                <p class='PDFl-2'>5 rue de Castiglione • 75001 Paris •</p>
                <p class='PDFl-3'>+33 1 70 39 26 50 / +33 6 80 76 07 10 •</p>
                <p class='PDFl-4'>https://kalstein.eu</p>
                <p class='PDFl-5'>KALSTEIN FRANCE, S. A. S</p>
            </div>
            <div class='PDFhr-2'></div>
            <div class='PDFimg-logo2'>
                <img src="<?php echo $imagen05 ?>" id="PDFLogo2P1">
            </div>
        </div>
    </div>
</div>
<page backtop="58mm" backbottom="30mm" backleft="0mm" backright="0mm">
    <page_header>
        <div class='PDFht'>
            <div class='PDFlogo-03'>
                <img src="<?php echo $imagen03 ?>" id='PDFlogoP2'>
            </div>
            <div class='PDFtp-01'>
                <p>KALSTEIN FRANCE SIREN: 819 970 815</p>
            </div>
            <div class='PDFtp-02'>
                <p id='PDFtp-02-p1'>Devis N°: <span style='font-weight: lighter;'>QUO
                        <?php echo $id ?>
                    </span></p>
                <p id='PDFtp-02-p2'>Paris,
                    <?php echo $onlyDate ?>
                    <?php echo $onlyHours ?>
                </p>
            </div>
        </div>
        <div class='PDFhr-04'></div>
        <div class='PDFcliente'>
            <div class='PDFsres'>
                <p id='PDFsres-p1'>Messieurs.:</p>
                <p id='PDFsres-p2'>
                    <?php echo $sres ?>
                </p>
            </div>
            <div class='PDFatc'>
                <p id='PDFatc-p1'>Attention:</p>
                <p id='PDFatc-p2'>
                    <?php echo $atc ?>
                </p>
            </div>
        </div>
        <div class='PDFc-table'>
            <table>
                <tr>
                    <td class='PDFtd-i'>Article</td>
                    <td class='PDFtd-m'>Modèle</td>
                    <td class='PDFtd-im'>Image</td>
                    <td class='PDFtd-d'>Description</td>
                    <td class='PDFtd-c'>Qté</td>
                    <td class='PDFtd-u'>Unité</td>
                    <td class='PDFtd-v'>Valeur unitaire</td>
                    <td class='PDFtd-vt'>Valeur totale</td>
                </tr>
            </table>
        </div>
    </page_header>
    <page_footer>
        <div class='PDFft'>
            <div class='PDFft-01'>
                <div class='PDFimg-ce'>
                    <img src="<?php echo $imagen16 ?>" id='PDFimg-ce-img'>
                </div>
                <div class='PDFtext-ce'
                    style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>
                    <p id='PDFtext-ce-p1'>Marquage CE : pour acheter en toute tranquillité</p>
                    <p id='PDFtext-ce-p2'>Tous les équipements Kalstein sont conformes aux exigences de l'UE
                        conformément aux réglementations pertinentes..</p>
                </div>
                <div class='PDFimg-cora'>
                    <img src="<?php echo $imagen11 ?>" id='PDFimg-cora-img'>
                </div>
                <div class='PDFtext-cora'
                    style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>
                    <p id='PDFtext-cora-p1'>Avec l'acquisition d'un Kalstein</p>
                    <p id='PDFtext-cora-p2'>Vous apportez une contribution à la Fondation Jacinto Convit,
                        OneTreePlanted, la Fondation Humatem et la Fondation Maniapure.</p>
                </div>
            </div>
            <div class='PDFhr-05'></div>
            <div class='PDFft-02'>
                <div class='PDFft-02-text'
                    style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>
                    <p id='PDFft-02-text-p1'>KALSTEIN FRANCE S.A.S</p>
                    <p id='PDFft-02-text-p2'>• 5 rue de Castiglione, • 75001 Paris •</p>
                    <p id='PDFft-02-text-p3'>+33 1 70 39 26 50 / +33 6 80 76 07 10 • https://kalstein.eu</p>
                </div>
                <div class='PDFftn-3'>
                    <p id='PDFftn-3-p'>Page [[page_cu]] de [[page_nb]]</p>
                </div>
            </div>
        </div>
    </page_footer>
    <?php

    if ($resultado->num_rows > 0) {
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $model = $value['cotizacion_detalle_model'];
            $consultGroup = "SELECT * FROM wp_k_products WHERE product_model = '$model'";
            $resultGroup = $conexion->query($consultGroup);
            $valueGroup = mysqli_fetch_array($resultGroup);
            $groupProduct = $valueGroup['product_group'];

            if ($groupProduct == 0) {
                $name = $value['cotizacion_detalle_name'];
                $image = $value['cotizacion_detalle_image'];
                $cant = $value['cotizacion_detalle_cant'];
                $unid = $value['cotizacion_detalle_unid'];
                $maker = $value['cotizacion_detalle_maker'];
                $valorUnit = $value['cotizacion_detalle_valor_unit'];
                $valorTotal = $value['cotizacion_detalle_valor_total'];
                $valorAnidado = $value['cotizacion_detalle_valor_anidado'];
                $newModel = str_replace("|", " ", $model);
                $newMaker = str_replace("Manufacturer", "Brand", $maker);
                $pathImage = __DIR__ . '/../../../uploads/kalsteinQuote/' . $image;

                //echo $image;
                //VERIFICA SI EXISTE EN RUTA LOCAL.
                if (file_exists($pathImage)) {
                    $newImage = $pathImage;
                } else {
                    //SI NO EXISTE, BUSCA EN RUTA ABSOLUTA DEL DIRECTORIO RAÍZ.
                    $newImage = "https://dev.kalstein.plus/plataforma/wp-content/uploads/kalsteinQuote/$image";
                }

                $consultParent = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$idCotizacion' AND cotizacion_detalle_parent = '$model'";
                $resultParent = $conexion->query($consultParent);
                $countParent = mysqli_num_rows($resultParent);

                if ($valorAnidado === '0.00') {
                    $newValor = "";
                } else {
                    $newValor = "(+ $valorAnidado)";
                }
                $i = $i + 1;

                if ($countParent > 0) {
                    $consultPriceProduct = "SELECT * FROM wp_k_products WHERE product_model = '$model'";
                    $resultPriceProduct = $conexion->query($consultPriceProduct);
                    $rowPriceProduct = mysqli_fetch_array($resultPriceProduct);
                    $priceUnitProduct = $rowPriceProduct['product_priceUSD'];
                    if ($divisa === 'USD') {
                        $priceTotalProduct = 'USD$ ' . $priceUnitProduct;
                    } else {
                        $priceTotalProduct = 'EUR€ ' . $priceUnitProduct;
                    }

                    echo "
                                <table>
                                    <tr>
                                        <td class='PDFtdb-i'>$i</td>
                                        <td class='PDFtdb-m'>$newModel</td>
                                        <td class='PDFtdb-img'>
                                            <img src='$pathImage'>
                                        </td>
                                        <td class='PDFtdb-d'>
                                            <p id='autoGen63'>$newMaker</p>
                                            <p id='autoGen64'>$name ($priceTotalProduct)</p>
                                            ";
                    if ($resultParent->num_rows > 0) {
                        echo "<h5>Added accessories</h5>";
                        while ($valueParent = $resultParent->fetch_assoc()) {
                            $modelAccesorie = $valueParent['cotizacion_detalle_model'];
                            $consultAccesorie = "SELECT * FROM wp_k_products WHERE product_model = '$modelAccesorie'";
                            $resultAccesorie = $conexion->query($consultAccesorie);
                            $valueAccesorie = mysqli_fetch_array($resultAccesorie);
                            $nameAccesorie = $valueAccesorie['product_name_en'];

                            if ($divisa === 'USD') {
                                $priceAccesorie = 'USD$ ' . $valueAccesorie['product_priceUSD'];
                            } else {
                                $usd = $valueAccesorie["product_priceUSD"];
                                $eur = $usd / 1.14;
                                $priceAccesorie = 'EUR€ ' . round($eur, 2);
                            }
                            echo "
                                                            <p id='autoGen65'>• $nameAccesorie ($priceAccesorie)</p>
                                                        ";
                        }
                    }
                    echo "
                                        </td>
                                        <td class='PDFtdb-c'>$cant,00</td>
                                        <td class='PDFtdb-u'>$unid</td>
                                        <td class='PDFtdb-v'>$valorUnit<br>$newValor</td>
                                        <td class='PDFtdb-vt'>$valorTotal</td>                            
                                    </tr>
                                </table>
                            ";
                } else {
                    echo "
                                <table>
                                    <tr>
                                        <td class='PDFtdb-i'>$i</td>
                                        <td class='PDFtdb-m'>$newModel</td>
                                        <td class='PDFtdb-img'>
                                            
                                        </td>
                                        <td class='PDFtdb-d'>
                                            <p id='autoGen67'>$newMaker</p>
                                            <p id='autoGen68'>$name</p>
                                        </td>
                                        <td class='PDFtdb-c'>$cant,00</td>
                                        <td class='PDFtdb-u'>$unid</td>
                                        <td class='PDFtdb-v'>$valorUnit<br>$newValor</td>
                                        <td class='PDFtdb-vt'>$valorTotal</td>                            
                                    </tr>
                                </table>
                            ";
                }
            }
        }
    }
    ?>
    <div class='PDFbt-02'>
        <div class='PDFsbt-02'>
            <div class='PDFob'>
                <div class='PDFsob'>
                    <div class='PDFob-title'>
                        <?php
                        echo $encabezadoObservations;
                        echo $a;
                        ?>
                    </div>
                    <div class='PDFob-p'>
                        <p id='PDFob-p-p1'>
                            <?php echo $deliveryTime ?>
                        </p>
                        <p id='PDFob-p-p2'>Mail: sales.department@kalstein.us</p>
                        <p id='PDFob-p-p3'>Phone: +33 1 7895 8789 / +33 6 8076 0710</p>
                        <p id='PDFob-p-p4'>Prepayment with purchase order.</p>
                        <p id='PDFob-p-p5'>
                            <?php echo $descuentoEspecial ?>
                        </p>
                        <?php
                        echo $b;
                        ?>
                    </div>
                </div>
            </div>
            <div class='PDFtotales'>
                <div class='PDFsubtotales'>
                    <div class='PDFtotales-t PDFp3P'>
                        <p id='PDFtotales-t-p1'>Sous-total:</p>
                        <?php
                        echo $txtDiscount;
                        echo $txtSubTotalC;
                        ?>
                        <p id='PDFtotales-t-p2'>Expédition:</p>
                        <?php
                        echo $txtArancel;
                        echo $txtIva;
                        ?>
                        <p id='PDFtotales-t-p3'>Total:</p>
                    </div>
                    <div class='PDFtotales-n PDFp3P'>
                        <p id='PDFtotales-n-p1'>
                            <?php echo $subtotal ?>
                        </p>
                        <?php
                        echo $numDiscount;
                        echo $subtotalC
                            ?>
                        <p id='PDFtotales-n-p2'>
                            <?php echo $envio ?>
                        </p>
                        <?php
                        echo $numArancel;
                        echo $numIva;
                        ?>
                        <p id='PDFtotales-n-p3'>
                            <?php echo $total ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</page>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='PDFstyle-05'></div>
    <div class='PDFh4-02'>
        <div class='PDFlogo4-02'>
            <img src="<?php echo $imagen03 ?>" id='PDFlogo4-02-img'>
        </div>
        <div class='PDFhr4-02'></div>
        <div class='PDFh4-text-02'>
            <p class='PDFlt4-01'>Termes commerciaux</p>
        </div>
    </div>
    <div class='PDFp2img-02'>
        <img src="<?php echo $imagen07 ?>" id='PDFp2img-02-img'>
    </div>
    <div class='PDFp2img-03'>
        <img src="<?php echo $imagen08 ?>" id='PDFp2img-03-img'>
    </div>
    <div class='PDFmain-text'>
        <p id='p3Sub1' class='PDFp3ST'>ACCEPTATION DE LA COMMANDE D'ACHAT</p>
        <div class='PDFi-list'>
            <p id='PDFi-list-p1'>•</p>
            <p id='PDFi-list-p2'>•</p>
            <p id='PDFi-list-p3'>•</p>
        </div>
        <div class='PDFi-txt PDFp3P'>
            <p id='PDFi-txt-p1'>Kalstein France SAS accepte une commande d'achat à sa satisfaction lorsque ce document
                reflète fidèlement les conditions commerciales énoncées dans l'offre..</p>
            <p id='PDFi-txt-p2'>Paiements en espèces : Pour le traitement et l'expédition des marchandises commandées,
                une vérification du paiement sur les comptes bancaires de Kalstein France est nécessaire.</p>
            <p id='PDFi-txt-p3'>Clients avec crédit : Une preuve de paiement sur les comptes bancaires de Kalstein
                France est nécessaire pour le traitement et l'expédition des marchandises commandées.</p>
        </div>
        <p id='p3Sub2' class='PDFp3ST'>TRADING DE DEVISES</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p4'>•</p>
            <p id='PDFi-list-p5'>•</p>
        </div>
        <div class='PDFi-txt2 PDFp3P'>
            <p id='PDFi-txt2-p1'>Les offres en monnaie étrangère seront soumises au calcul de conversion de devises
                conformément aux dispositions de la Banque de France, fixées le jour de la facturation.</p>
            <p id='PDFi-txt2-p2'>La devise de négociation établie pour cette offre est
                <?php echo $divisa ?>.
            </p>
        </div>
        <p id='p3Sub3' class='PDFp3ST'>GARANTIE</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p5'>•</p>
            <p id='PDFi-list-p6'>•</p>
            <p id='PDFi-list-p7'>•</p>
        </div>
        <div class='PDFi-txt3 PDFp3P'>
            <p id='PDFi-txt3-p1'>Tout l'équipement vendu par Kalstein France est garanti pendant un an à des fins de
                fabrication à compter de la date de facturation des marchandises.</p>
            <p id='PDFi-txt3-p2'>La garantie ne couvre pas les dommages causés par une installation ou une utilisation
                incorrecte, des défauts de transport ou des utilisations autres que celles spécifiées par le fabricant.
            </p>
            <p id='PDFi-txt3-p3'>La garantie exclut les pièces électriques ou consommables.</p>
        </div>
        <p id='p3Sub4' class='PDFp3ST'>DÉLAIS DE LIVRAISON</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p8'>•</p>
        </div>
        <div class='PDFi-txt4 PDFp3P'>
            <p id='PDFi-text4-p1'>Les délais de livraison indiqués dans cette offre sont des estimations susceptibles de
                changer.</p>
        </div>
        <p id='p3Sub5' class='PDFp3ST'>ANNULATIONS ET REMBOURSEMENTS SANS CAUSE JUSTIFIÉE</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p9'>•</p>
            <p id='PDFi-list-p10'>•</p>
            <p id='PDFi-list-p11'>•</p>
        </div>
        <div class='PDFi-txt5 PDFp3P'>
            <p id='PDFi-text5-p1'>Les marchandises en stock seront soumises à une pénalité équivalente à 20 % de la
                valeur de la commande d'achat.</p>
            <p id='PDFi-text5-p2'>Pour les marchandises importées, après réception de la commande d'achat à
                satisfaction, il y a un maximum de trois (3) jours pour annuler la commande d'achat. Passé ce délai,
                aucune annulation ne sera acceptée et les marchandises seront facturées comme prévu.</p>
            <p id='PDFi-text5-p3'>Le retour des marchandises sera de la responsabilité du client. La boîte, l'emballage
                et toutes les pièces qui composent l'équipement à retourner doivent être en parfait état, sans dommages,
                rayures ni étiquettes supplémentaires. L'équipe de support technique et logistique de Kalstein France
                établira un rapport technique et indiquera la réception satisfaisante des marchandises. Si les
                marchandises ne sont pas reçues de manière satisfaisante, l'équipement sera facturé conformément à la
                commande d'achat.</p>
        </div>
        <p id='p3Sub6' class='PDFp3ST'>POLITIQUES GÉNÉRALES, TERMES ET CONDITIONS</p>
        <p id='p3Sub7' class='PDFp3ST'>https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='PDFstyle-07'>
        <p id='PDFstyle-07-p1'>Page [[page_cu]] de [[page_nb]]</p>
    </div>
</page>