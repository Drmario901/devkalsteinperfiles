<?PHP
session_start();
if ($_GET['idCotizacion']){
    $idCotizacion = $_GET['idCotizacion'];
}else{
    if (isset($_SESSION['idCotizacion'])) {
        $idCotizacion = $_SESSION['idCotizacion'];
    }else{
        $idCotizacion = '';   
    }
}

if(isset($_SESSION["emailAccount"])){
    $emailAcc = $_SESSION["emailAccount"];
    $emailEncrypt = md5($emailAcc);
} else {
    $emailAcc = empty($emailAcc) ? 'prueba' : $emailAcc;
    $emailEncrypt = md5($emailAcc);
}

if(isset($_SESSION["cName"])){
    $cName = $_SESSION["cName"];
    $cNameEncrypt = md5($cName);
} else {
    $cName = empty($cName) ? 'prueba' : $cName;
    $$cNameEncrypt = md5($cName);
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

if ($country === 0 || $country === ""){
    $nameC = "";
}else{
    $query = "SELECT * FROM wp_paises WHERE iso = '$country'";
    $rs = $conexion->query($query);
    $row = mysqli_fetch_array($rs);
    $nameC = $row['en'];
}

$consultCountryEU = "SELECT * FROM wp_eu_country WHERE eu_country_iso = '$country'";
    $resultCountryEU = $conexion->query($consultCountryEU);
    $countCountryEU = mysqli_num_rows($resultCountryEU);
    if ($countCountryEU > 0){
        $eu = 'EU';
    }else{
        $eu = '';
    }

if ($incoterm === 'EXW Kalstein Paris'){
    $encabezadoObservations = "<p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0; padding-left: 5mm;'>Observaciones:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -1.4mm;'>Tiempos de entrega:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Representante de ventas:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 4.35mm;'>Terminos comerciales:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Incoterm:</p>";
    $descuentoEspecial = '';
    $txtDiscount = '';
    $numDiscount = '';
    $txtSubTotalC = '';
    $subtotalC = ''; 
    $origin = 'Paris - Francia';
    $txtIncoterm = 'EXW Kalstein Paris.';
    $envio = "<a href='https://dev.kalstein.plus/plataforma/dashboard/?userToConsultPriceShipping=$emailEncrypt&countryToConsultPriceShipping=$country&idCotizacion=$idCotizacion'>A consultar</a>";
    if ($iva != 0){
        $txtIva = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>TVA (20%):</p>";            
        $numIva = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-left: 3mm;'>$iva</p>";
    }else{
        $txtIva = '';
        $numIva = '';
    }
    if ($envioM === 'Aerial'){
        $deliveryTime = '15 - 30 días aprox.';
    }else{
        $deliveryTime = '60 días aprox.';
    }
    $txtArancel = "";
    $numArancel = "";
    $transitTimeM = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>&nbsp;</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>&nbsp;</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>&nbsp;</p>";
    $transitTimeA = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>&nbsp;</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>&nbsp;</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>&nbsp;</p>";
}else{
    $encabezadoObservations = "<p style='font-weight: bold; font-size: 18px; margin: 0; padding: 0; padding-left: 5mm;'>Observaciones:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -1.4mm;'>Tiempos de entrega:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Representante de ventas:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 4.35mm;'>Terminos comerciales:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Incoterm:</p>";
    $descuentoEspecial = 'Descuento especial (18%), aplicado.';
    $deliveryTime = '7 - 10 días aprox.';
    $txtIva = '';
    $numIva = '';
    $txtDiscount = '<p style="font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 0.3mm;">Descuento (18%):</p>';
    $numDiscount = '<p style="font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 0.5mm; margin-left: 0mm;">'.$desc.'</p>';
    $txtSubTotalC = '<p style="font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 0mm;">Subtotal:</p>';
    $subtotalC = '<p style="font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.8pxmm; margin-left: 0.3mm;">'.$subtotal2.'</p>';
    $origin = 'Shanghai - China';
    if ($envioM === 'Aerial'){
        $txtIncoterm = 'DDP '.$nameC.' (Derechos de entrega pagados).';
    }else{
        $txtIncoterm = 'CIF '.$nameC.' (Costo + Seguro + Flete).';
    }

    if ($arancel != 0){
        $txtArancel = "<p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>Arancel:</p>";
        $numArancel = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 0.2mm; margin-left: 3mm;'>$arancel</p>";
    }else{
        $txtArancel = "";
        $numArancel = "";
    }

    $transitTimeM = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Transporte marítimo.</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>45 - 60 días.</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Seguro de transporte incluido</p>";
    $transitTimeA = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Flete aéreo (servicio de mensajería).</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'> 7 - 15 días.</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 0.8mm; margin-left: 3mm;'>Seguro de transporte incluido</p>";
}

if ($envioM === 'Maritime'){            
    $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -0.7mm; margin-left: 3mm;'>$txtIncoterm</p>
    $transitTimeM
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.5mm; margin-left: 3mm;'> $divisa.</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.5mm; margin-left: 3mm;'>1 año contra defectos de fabricación.</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.4mm; margin-left: 3mm;'>$pago.</p>
    <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.5mm; margin-left: 3mm;'>$origin.</p>";

    $a = "
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Tiempos de tránsito:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Moneda:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Garantía:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Método de pago:</p>
    <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Origen:</p>";
}else{
    if ($envioM === 'Aerial'){            
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -1mm; margin-left: 3mm;'>$txtIncoterm</p>
        $transitTimeA
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.5mm; margin-left: 3mm;'>$divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.5mm; margin-left: 3mm;'>1 año contra defectos de fabricación.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.5mm; margin-left: 3mm;'>$pago.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 1.5mm; margin-left: 3mm;'>$origin.</p>";

        $a = "
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Tiempos de tránsito:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Moneda:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Garantía:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Método de pago:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Origen:</p>";
    }else{
        $txtArancel = "";
        $numArancel = "";
        $b = "<p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -1mm; margin-left: 3.4mm;'>$incoterm.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3.8mm; margin-left: 3mm;'>&nbsp;</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 3.4mm; margin-left: 3mm;'>$divisa.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -0.189mm; margin-left: 3mm;'>1 año contra defectos de fabricación.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -0.4mm; margin-left: 3mm;'>$pago.</p>
        <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -0.5mm; margin-left: 3mm;'>$origin.</p>";

        $a = "
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Tiempos de tránsito:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 3.7mm;'>Moneda:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Garantía:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Método de pago:</p>
        <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.5mm;'>Origen:</p>";
    }        
}

$resultado = $conexion->query($consulta2);
$imagen01 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/francia-pais.jpg'; /* 557x534 */
/* $imagen02 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/fondo.png' */
$imagen03 = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/LogoActualizado2.png'; /* 1581x421 */
$imagen04 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/qr.jpg'; /* 238x238 */
$imagen05 = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/k+blanco.png';
$imagen06 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/imagen1.jpg';
$imagen07 = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/img2p.png';
$imagen08 = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/assets/images/img1p.png';
$imagen09 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono1.png';
$imagen10 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono2.png';
$imagen11 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono3.png';
$imagen12 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono4.png';
$imagen13 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono5.png';
$imagen14 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/icono6.png';
$imagen15 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/corazon.png';
$imagen16 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/img-ce.jpg';
$imagen17 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/imagen4.jpg';
$imagen18 = 'https://platform.kalstein.us/wp-content/plugins/kalsteinCotizacion/assets/images/FAQ_ES.png';
$imagen19 = __DIR__.'/../../kalsteinPerfiles/src/images/ImgUpload';

$titleContent = "UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO";
?>  
<div class="htmlTemplate">

    <link rel="stylesheet" type="text/css" href="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/pdfletter.css">
    <!-- pagina 01 -->
    <div class='cp01' style="position: relative;">
    <div class="emailAccValue" id="emailAccValue" data-email="<?php echo $emailAcc; ?>" style="display: none;"></div>
    <div class="cNameValue" id="cNameValue" data-name="<?php echo $cName; ?>" style="display: none;"></div>
    <div id="backgroundCp01">
    </div>
    <div class='h-01'>
        <img src="<?php echo $imagen01?>" style='position:absolute; width: 18%; top: 25mm; right: 25mm;' id="p1Img01">
    </div>
    <div class='b-01' >
        <div class='id'>
            <div class='logo'>
                <img src="<?php echo $imagen03?>" style='width: 287.86px; height: 84.72px; position:absolute; top:158.2mm' id = 'p1Img02'>
            </div>
            <div class='hr'></div>
            <div class='n-id' id="p1Titulo">
                <p class='co' id='p1T1P1'>COTIZACIÓN</p>
                <p class='id-title' id='p1T1P2'>QUO<span class='id-n' value='<?= $id?>'><?php echo $id?></span></p>
                <p class='msj' id='p1T1P3'>UN ACOMPAÑAMIENTO DIFERENTE, A SU SERVICIO</p>
            </div>
        </div> 
        <div class='f-01'>
            <div class='qr'>
                <img src="<?php echo $imagen04?>" style='width: 100%;margin-bottom: 47px;' id='qrF'>
            </div>
            <div class='f-text'>
                <p class='l-1 my-0 p1FooterP' id='p1FooterP1'>Todos los derechos reservados ® KALSTEIN France S. A. S.</p>
                <p class='l-2 my-0 p1FooterP' id='p1FooterP2'>2 Rue Jean Lantier •  75001 Paris •</p>
                <p class='l-3 my-0 p1FooterP' id='p1FooterP3'>+33 1 78 95 87 89 / +33 6 80 76 07 10 •</p>
                <p class='l-4 my-0 p1FooterP' id='p1FooterP4'>https://kalstein.eu</p>
                <p class='l-5 my-0 p1FooterP' id='p1FooterP5'>KALSTEIN FRANCE, S. A. S</p>
            </div>
            <div class='hr-2'></div>
            <div class='img-logo2' id="p1Img03C" style="width:35%; right: 86mm; top: 267mm;position: absolute;">
            <img src="<?php echo $imagen05?>" style='width: 136.14px;' id = 'p1Img03'>
            </div>
            <div id="margen" style="position: absolute;top: 269mm;height: 100%;width: 100%;">&nbsp;</div>
        </div>       
    </div>    
</div>

<!-- Pagina 03, ahora pagina 02 -->
<?php
        
            if ($resultado->num_rows > 0) {
                $i = 0;
                $max_i = 0;
                while ($value = $resultado->fetch_assoc()) {
                    $model = $value['cotizacion_detalle_model'];
                    $consultGroup = "SELECT * FROM wp_k_products WHERE product_model = '$model'";
                    $resultGroup = $conexion->query($consultGroup);
                    $valueGroup = mysqli_fetch_array($resultGroup);
                    $groupProduct = $valueGroup['product_group'];

                    if ($groupProduct == 0){
                        $name = $value['cotizacion_detalle_name'];
                        $image = $value['cotizacion_detalle_image'];
                        $cant = $value['cotizacion_detalle_cant'];
                        $unid = $value['cotizacion_detalle_unid'];
                        $maker = $value['cotizacion_detalle_maker'];
                        $valorUnit = $value['cotizacion_detalle_valor_unit'];
                        $valorTotal = $value['cotizacion_detalle_valor_total'];
                        $valorAnidado = $value['cotizacion_detalle_valor_anidado'];
                        $valorArancel = 'Arancel: '.$value['cotizacion_detalle_arancel'];
                        $newModel = str_replace("|", " ", $model);
                        $newMaker = str_replace("Fabricante", "Marca", $maker);
                        $newImage = __DIR__ . '/../../../uploads/kalsteinQuote/' . $image;

                        //TOMARLA DE OTRA PÁGINA
                        if (file_get_contents($newImage) !== false) {
                        } else {
                            $imageUrl = "https://dev.kalstein.plus/plataforma/es/wp-content/uploads/kalsteinQuote/$image";
                            if (file_get_contents($imageUrl) !== false) {
                                $newImage = $imageUrl;
                            } else {
                                echo "'$newImage' no existe.";
                            }
                        }
                        

                        $consultParent = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_id = '$idCotizacion' AND cotizacion_detalle_parent = '$model'";
                        $resultParent = $conexion->query($consultParent);
                        $countParent = mysqli_num_rows($resultParent);

                        if ($valorAnidado === '0.00'){
                            $newValor = "";
                        }else{
                            $newValor = "(+ $valorAnidado)";
                        }

                        $i = $i + 1;
                        if ($i > $max_i) {
                            $max_i = $i; 
                        }

                        if ($countParent > 0){
                            $consultPriceProduct = "SELECT * FROM wp_k_products WHERE product_model = '$model'";
                            $resultPriceProduct = $conexion->query($consultPriceProduct);
                            $rowPriceProduct = mysqli_fetch_array($resultPriceProduct);
                            $priceUnitProduct = $rowPriceProduct['product_priceUSD'];
                            if ($divisa === 'USD'){
                                $priceTotalProduct = 'USD$ '.$priceUnitProduct;
                            }else{
                                $priceTotalProduct = 'EUR€ '.$priceUnitProduct;
                            }
    
                            echo "
                                <table style='width: 100.2%; height:auto; margin-top: 50px;' class='fTableB'>
                                    <tr>
                                        <td class='tdb-i'>$i</td>
                                        <td class='tdb-m'>$newModel</td>
                                        <td class='tdb-img'>
                                            <img src='$newImage' style='width: 100%;'>
                                        </td>
                                        <td class='tdb-d'>
                                            <p style='margin: 0; padding: 0; font-size: 11px;'>$newMaker</p>
                                            <p style='margin: 0; padding: 0; font-size: 11px;'>$name ($priceTotalProduct)</p>
                                            ";
                                                if ($resultParent->num_rows > 0) {
                                                    echo "<h5 style='padding-bottom: 0px;font-size: 11px;'>Accesorios añadidos</h5>";
                                                    while ($valueParent = $resultParent->fetch_assoc()) {
                                                        $modelAccesorie = $valueParent['cotizacion_detalle_model'];
                                                        $consultAccesorie = "SELECT * FROM wp_k_products WHERE product_model = '$modelAccesorie'";
                                                        $resultAccesorie = $conexion->query($consultAccesorie);
                                                        $valueAccesorie = mysqli_fetch_array($resultAccesorie);
                                                        $nameAccesorie = $valueAccesorie['product_name_en'];
    
                                                        if ($divisa === 'USD'){                                                        
                                                            $priceAccesorie = 'USD$ '.$valueAccesorie['product_priceUSD'];
                                                        }else{                                                        
                                                            $usd = $valueAccesorie["product_priceUSD"];
                                                            $eur = $usd / 1.14;
                                                            $priceAccesorie = 'EUR€ '.round($eur, 2);
                                                        }
                                                        echo "
                                                            <p style='margin: 0; padding: 0; font-size: 10px; margin-left: 1rem;'>• $nameAccesorie ($priceAccesorie)</p>
                                                        ";
                                                        
                                                    }
                                                }
                                            echo "
                                        </td>
                                        <td class='tdb-c'>$cant,00</td>
                                        <td class='tdb-u'>$unid</td>
                                        <td class='tdb-v'>$valorUnit<br>$newValor</td>
                                        <td class='tdb-vt'>$valorTotal</td>                            
                                    </tr>
                                </table>
                            ";
                        }else{
                            echo "
                                <table style='width: 100.2%; height:auto; margin-top: 50px;' class='fTableB'>
                                    <tr>
                                        <td class='tdb-i'>$i</td>
                                        <td class='tdb-m'>$newModel</td>
                                        <td class='tdb-img'>
                                            <img src='$newImage' style='width: 100%;'>
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
                }
            }
        ?>
<div class='cp02' style='display: none; position: relative;'>
<page backtop="58mm" backbottom="30mm" backleft="0mm" backright="0mm"> 
    <page_header> 
        <div class='ht'>
            <div class='logo-03'>
                <img src="<?php echo $imagen03?>" style='width: 249px !important; height: 73px !important;' id='logoP2'>
            </div>
            <div class='tp-01'>
                <p>KALSTEIN FRANCE SIREN: 819 970 815</p>
            </div>
            <div class='tp-02'>
                <p style='font-weight: bold; margin: 0; padding: 0;'>Cotización N°: <span style='font-weight: lighter;'>QUO<?php echo $id?></span></p>
                <p style='margin: 0; padding: 0; margin-top: -1mm;'>Paris, <?php echo $onlyDate?> <?php echo $onlyHours?></p>
            </div>
        </div>
        <div class='hr-04'></div>   
        <div class='cliente'>
            <div class='sres'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Sres:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm; margin-top: -2mm; font-size: 13px;'><?php echo $sres?><!-- kalstein --></p>
            </div>
            <div class='atc'>
                <p style='margin: 0; padding: 0; font-weight: bold; margin-top: 2mm;'>Atención:</p>
                <p style='margin: 0; padding: 0; margin-top: 1mm; margin-top: -2mm; font-size: 13px;'><?php echo $atc?><!-- Alejandro Espidea --></p>
            </div>
        </div>  

    </page_header> 
    <page_footer> 
        <div class='ft'>
            <div class='ft-01'>
                <div class='img-ce'>
                    <img src="<?php echo $imagen16?>" id='p2Ce'>
                </div>
                <div class='text-ce'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px; margin-bottom: -5px;' class="p2P1" id='p2F1P1'>Marcado CE: para comprar con tranquilidad</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm; line-height: 1;' class="p2P2" id='p2F1P2'>Todos los equipos Kalstein cumplen los requisitos de la UE, de acuerdo con la normativa pertinente.</p>
                </div>
                <div class='img-cora'>
                    <img src="<?php echo $imagen11?>" style='float: right; width: 51.02px; height: 49.48px; margin-top: -5mm;' id="p2Img03">
                </div>
                <div class='text-cora'>
                    <p style='margin: 0; padding: 0; font-weight: bold; font-size: 12px; margin-bottom: -5px;' class="p2P3" id='p2F1P3'>Con la adquisición de un equipo Kalstein</p>
                    <p style='margin: 0; padding: 0; font-size: 10px; margin-top: 1mm; width: 284px; line-height: 1;' class="p2P4" id='p2F1P4'>Realizas una aportación a la Fundación Jacinto Convit, OneTreePlanted, Fundación Humatem y Fundación Maniapure.</p>
                </div>
            </div>
            <div class='hr-05'></div>
            <div class='ft-02'>
                <div class='ft-02-text'>
                    <p style='margin: 0; padding: 0; font-size: 9px; margin-top: 5mm;' class="p2P5" id='p2F2P1'>KALSTEIN FRANCE S.A.S</p>
                    <p style='margin: 0; padding: 0; font-size: 9px; margin-top: -0.5mm;' class="p2P6" id='p2F2P2'>• 2 Rue Jean Lantier, • 75001 Paris •</p>
                    <p style='margin: 0; padding: 0; font-size: 8px;' class="p2P7" id='p2F2P3'>+33 1 78 95 87 89 / +33 6 80 76 07 10 • https://kalstein.eu</p>
                </div>
                <div class='ftn-3'>
                    <p style='text-align: right; font-size: 9px; margin-top: 6.5mm; font-weight: bold;'>Página [[page_cu]] de [[page_nb]]</p>
                </div>
            </div>
        </div>
    </page_footer>

    <div class='dadCont'>
        <div class='c-table'>
                <table id='fTable'>
                    <tr>
                        <td class='td-i' id='p2TableTd'>Item</td>
                        <td class='td-m'>Modelo</td>
                        <td class='td-im'>Imagen</td>
                        <td class='td-d'>Descripción</td>
                        <td class='td-c'>Cant</td>
                        <td class='td-u'>Unid</td>
                        <td class='td-v'>Valor unitario</td>
                        <td class='td-vt'>Valor total</td>
                    </tr>
                </table>
                <!-- vdp open-->
            <!-- <table style="width: 100.2%; height:auto; margin-top: 50px;" class='fTableB'>
                    <tr>
                        <td class='tdb-i'>1</td>
                        <td class='tdb-m'>Sample Model</td>
                        <td class='tdb-img'>
                            <img src='https://es49a9mytev.exactdn.com/es/wp-content/uploads/2023/09/YR01862-1-1.png?strip=all&lossy=1&ssl=1' style='width: 100%;'>
                        </td>
                        <td class='tdb-d'>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Maker</p>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Product</p>
                        </td>
                        <td class='tdb-c'>5,00</td>
                        <td class='tdb-u'>Sample Unit</td>
                        <td class='tdb-v'>$50<br>Sample Value</td>
                        <td class='tdb-vt'>$250</td>                            
                    </tr>
                    <tr>
                        <td class='tdb-i'>1</td>
                        <td class='tdb-m'>Sample Model</td>
                        <td class='tdb-img'>
                            <img src='https://es49a9mytev.exactdn.com/es/wp-content/uploads/2023/09/YR01862-1-1.png?strip=all&lossy=1&ssl=1' style='width: 100%;'>
                        </td>
                        <td class='tdb-d'>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Maker</p>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Product</p>
                        </td>
                        <td class='tdb-c'>5,00</td>
                        <td class='tdb-u'>Sample Unit</td>
                        <td class='tdb-v'>$50<br>Sample Value</td>
                        <td class='tdb-vt'>$250</td>                            
                    </tr>
                    <tr>
                        <td class='tdb-i'>1</td>
                        <td class='tdb-m'>Sample Model</td>
                        <td class='tdb-img'>
                            <img src='https://es49a9mytev.exactdn.com/es/wp-content/uploads/2023/09/YR01862-1-1.png?strip=all&lossy=1&ssl=1' style='width: 100%;'>
                        </td>
                        <td class='tdb-d'>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Maker</p>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Product</p>
                        </td>
                        <td class='tdb-c'>5,00</td>
                        <td class='tdb-u'>Sample Unit</td>
                        <td class='tdb-v'>$50<br>Sample Value</td>
                        <td class='tdb-vt'>$250</td>                            
                    </tr>
                    <tr>
                        <td class='tdb-i'>1</td>
                        <td class='tdb-m'>Sample Model</td>
                        <td class='tdb-img'>
                            <img src='https://es49a9mytev.exactdn.com/es/wp-content/uploads/2023/09/YR01862-1-1.png?strip=all&lossy=1&ssl=1' style='width: 100%;'>
                        </td>
                        <td class='tdb-d'>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Maker</p>
                            <p style='margin: 0; padding: 0; font-size: 11px;'>Sample Product</p>
                        </td>
                        <td class='tdb-c'>5,00</td>
                        <td class='tdb-u'>Sample Unit</td>
                        <td class='tdb-v'>$50<br>Sample Value</td>
                        <td class='tdb-vt'>$250</td>                            
                    </tr>
                </table> -->
                <!-- vdp close-->
        </div>
        <div class='bt-02' id='billCont'>
            <div class='sbt-02'>
                <div class='ob'>
                    <div class='sob'>
                        <div class='ob-title'>   
                            <?php
                                echo $encabezadoObservations;
                                echo $a;
                            ?>
                        </div>
                        <div class='ob-p'>
                            <p id="p2BillP" style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: 7.5mm; margin-left: 3mm;'><?php echo $deliveryTime?></p>
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -0.5mm; margin-left: 3mm;'>Correo: sales.department@dev.kalstein.plus/plataforma</p>
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -1mm; margin-left: 3mm;'>Tlf: +33 1 7895 8789 / +33 6 8076 0710</p>
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -0.7mm; margin-left: 3mm;'>Pago anticipado con orden de compra.</p>
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: left; margin-top: -1mm; margin-left: 3mm;'><?php echo $descuentoEspecial?></p>
                            <?php 
                                echo $b;  
                            ?>
                        </div>
                    </div>
                </div>
                <div class='totales'>
                    <div class='subtotales'>
                        <div class='totales-t'>
                            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>Subtotal:</p>
                            <?php
                                echo $txtDiscount;
                                echo $txtSubTotalC;
                            ?>
                            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>Envío:</p>
                            <?php
                                echo $txtArancel;
                                echo $txtIva;
                            ?>
                            <!-- vdp -->
                           <!--  <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>TVA (20%):</p> -->

                            <p style='font-weight: bold; font-size: 12px; margin: 0; padding: 0; text-align: right;'>Total:</p>
                        </div>
                        <div class='totales-n'>
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-left: 3mm;'><?php echo $subtotal?><!-- vdp --><!-- 4531.88 --></p>
                            <?php
                                echo $numDiscount;
                                echo $subtotalC
                            ?>
                            <!-- vdp -->
                            <!-- <p style="font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 0.5mm; margin-left: 0mm;">815.74</p> -->
                            <!-- vdp -->
                            <!-- <p style="font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: -0.8pxmm; margin-left: 0.3mm;">3716.14</p> -->
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-top: 0mm; margin-left: 3mm;'><?php echo $envio?><!-- vdp --><!-- 1154.30 --></p>
                            <?php
                                echo $numArancel;
                                echo $numIva;
                            ?>
                            <!-- vdp -->
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-left: 3mm;'><!-- vdp --><!-- 1858.07 --></p>
                            <p style='font-size: 12px; margin: 0; padding: 0; text-align: right; margin-left: 3mm;'><?php echo $total?><!-- vdp --><!-- 6728.51 --></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="invSep"></div>
    </div>

<!--     <div id="margen" style="position: absolute;top: 269mm;height: 100%;width: 100%;">&nbsp;</div> -->
</page>
</div>
<!-- Pagina 04, ahora pagina 03 -->
<div class='cp03' style='display: none; position: relative;'>
<page backtop="0mm" backbottom="0mm" backleft="0mm" backright="0mm">
    <div class='style-05'></div>
<!--     <div class='style-06'></div> -->
    <div class='h4-02'>
        <div class='logo4-02'>
            <img src="<?php echo $imagen03?>" style='float: right; width: 241.88px; height: 71.19px;' id='logoP3'>
        </div>
        <div class='hr4-02'></div>
        <div class='h4-text-02'>
            <p class='lt4-01'>CONDICIONES COMERCIALES</p>
        </div>
    </div>
<!--     <div class='p2img-01'>
        <img src="<?php echo $imagen06?>" style='float: right; width: 100%;'>
    </div> -->
    <div class='p2img-02'>
        <img src="<?php echo $imagen07?>" style='float: right; width: 100%; height: 100%;' id='p3P2'>
    </div>
    <div class='p2img-03'>
        <img src="<?php echo $imagen08?>" style='float: right; width: 100%; height: 100%;' id='p3P3'>
    </div>
    <div class='main-text'>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; text-wrap: nowrap;' class="subtitle4" id='p3PSID'>ACEPTACIÓN DE LA ORDEN DE COMPRA</p>
        <div class='i-list'>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;' id='p3PID'>•</p>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 6mm;'>•</p>
        </div>
        <div class='i-txt'>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 4mm;'>Kalstein France SAS recibe una orden de compra a satisfacción, cuando este documento expresa fielmente las condiciones comerciales establecidas en la oferta.</p>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 2mm;'>Pagos en efectivo: Para la tramitación y envío de la mercancía solicitada, se requiere la verificación del pago en las cuentas bancarias de Kalstein France.</p>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1.7mm; margin-left: 0.2mm;'>Clientes con crédito: Para la tramitación y envío de la mercancía solicitada se requiere el justificante de pago en cuentas bancarias de Kalstein France.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 5mm;' class="subtitle4">NEGOCIACIÓN DE DIVISAS</p>
        <div class='i-list'>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 7mm;'>•</p>
        </div>
        <div class='i-txt2'>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 10mm;'>Ofertas en moneda extranjera, el cálculo de conversión de divisas se realizará de acuerdo con las disposiciones del Banco de Francia, fijado en el día de la facturación.</p>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 2mm;'>La moneda de negociación establecida para esta cotización es <?php echo $divisa?>.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: -14mm;' class="subtitle4">GARANTÍA</p>
        <div class='i-list'>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 4.5mm;'>•</p>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 6.5mm;'>•</p>
        </div>
        <div class='i-txt3'>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 0mm;'>Todos los equipos vendidos por Kalstein Francia tienen una garantía de un año a efectos de fabricación a partir de la fecha de facturación de la mercancía.</p>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La garantía no cubre los daños causados por una mala instalación o funcionamiento, defectos de transporte o por usos distintos de los especificados por el fabricante.</p>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La garantía excluye las piezas eléctricas o consumibles.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: -3mm;' class="subtitle4">TIEMPOS DE ENTREGA</p>
        <div class='i-list'>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 4mm;'>•</p>
        </div>
        <div class='i-txt4'>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 0mm;'>Los plazos de entrega indicados en este presupuesto son estimaciones sujetas a variables.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: -26mm;' class="subtitle4">ANULACIONES Y DEVOLUCIONES SIN CAUSA JUSTIFICADA</p>
        <div class='i-list'>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 3mm;'>•</p>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 3.5mm;'>•</p>
            <p class='p3P' style='text-align: center; margin: 0; padding: 0; margin-top: 9.5mm;'>•</p>
        </div>
        <div class='i-txt5'>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 3mm;'>La mercancía en existencias tendrá una penalización equivalente al 20% del valor de la orden de compra.</p>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>Mercancía de Importación, después de recibir la orden de compra a satisfacción, hay un máximo de (3) días para cancelar la orden de compra, después de este tiempo no se aceptan cancelaciones y la mercancía se facturará según lo establecido.</p>
            <p class='p3P' style='margin: 0; padding: 0; font-size: 11px; text-align: justify; margin-top: 1mm;'>La devolución de la mercancía será responsabilidad del Cliente, la caja, embalaje y todas las partes que componen el equipo a devolver, deberán estar en perfecto estado sin maltratos, arañazos y etiquetas adicionales, el equipo de Soporte Técnico y Logística de Kalstein Francia, realizará informe técnico e indicará la recepción satisfactoria de la mercancía. En caso de no ser recibida satisfactoriamente, el equipo será facturado de acuerdo con lo establecido en la Orden de Compra.</p>
        </div>
        <p style='margin: 0; padding: 0; color: #213280; font-weight: bold; font-size: 11px; margin-top: 22mm;' class="subtitle4">POLÍTICAS, TÉRMINOS Y CONDICIONES GENERALES</p>
        <p class="i-txt6 p3P" style='margin: 0; padding: 0; font-size: 11px; margin-top: 0mm;'>https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='style-07'><p id="footerP" style='text-align: right; color: #fff; font-size: 9px; margin-right: 12mm; margin-top: 6.5mm; font-weight: bold;'>Página [[page_cu]] de [[page_nb]]</p></div>
    <!-- <div class='style-08'></div> -->
</page>
</div>
</div>
<!-- fin -->

