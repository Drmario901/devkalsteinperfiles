<?php
    session_start();

    require __DIR__ . '/conexion.php';

    if(isset($_SESSION["emailAccount"])){
        $emailAcc = $_SESSION["emailAccount"];
        $emailEncrypt = md5($emailAcc);
    }

    if ($_GET['idCotizacion']){
        $idCotizacion = $_GET['idCotizacion'];
    }else{
        if (isset($_SESSION['idCotizacion'])) {
            $idCotizacion = $_SESSION['idCotizacion'];
        }else{
            $idCotizacion = '';   
        }
    }
        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id = '$idCotizacion'";
        $resultado = $conexion->query($consulta);
        $row = mysqli_fetch_array($resultado);
        $cotizacionIdRemitente = $row["cotizacion_id_remitente"];
    

/*     if(isset($_SESSION["nameQuery"])){
        $cName = $_SESSION["nameQuery"];
        $cNameEncrypt = md5($cName);
    } else {
        $cName = empty($cName) ? 'prueba' : $cName;
        $$cNameEncrypt = md5($cName);
    } 

    if(isset($_SESSION["cName"])){
        $cName = $_SESSION["cName"];
        $cNameEncrypt = md5($cName);
    } else {
        $cName = empty($cName) ? 'prueba' : $cName;
        $$cNameEncrypt = md5($cName);
    } */

    if(isset($_SESSION["nameQuery"])){
        $cName = $_SESSION["nameQuery"];
        $cNameEncrypt = md5($cName);
    } else {
        echo "<script>
        alert('Inicia sesión.');

        window.location.replace('https://dev.kalstein.plus/plataforma/acceder/'); 
        </script>";
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
        $encabezadoObservations = "<p id='autoGen1'>Observaciones:</p>
        <p id='autoGen2'>Tiempos de entrega:</p>
        <p id='autoGen3'>Representante de ventas:</p>
        <p id='autoGen4'>Terminos comerciales:</p>
        <p id='autoGen5'>Incoterm:</p>";
        $descuentoEspecial = '';
        $txtDiscount = '';
        $numDiscount = '';
        $txtSubTotalC = '';
        $subtotalC = ''; 
        $origin = 'Paris - Francia';
        $txtIncoterm = 'EXW Kalstein Paris.';
        $envio = "<a href='https://dev.kalstein.plus/plataforma/dashboard/?userToConsultPriceShipping=$emailEncrypt&countryToConsultPriceShipping=$country&idCotizacion=$idCotizacion'>A consultar</a>";
        if ($iva != 0){
            $txtIva = "<p id='autoGen6'>TVA (20%):</p>";            
            $numIva = "<p id='autoGen7'>$iva</p>";
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
        $transitTimeM = "<p id='autoGen8'>&nbsp;</p>
        <p id='autoGen9'>&nbsp;</p>
        <p id='autoGen10'>&nbsp;</p>";
        $transitTimeA = "<p id='autoGen11'>&nbsp;</p>
        <p id='autoGen12'>&nbsp;</p>
        <p id='autoGen13'>&nbsp;</p>";
        }else{
            $encabezadoObservations = "<p id='autoGen62'>Observaciones:</p>
            <p id='autoGen14'>Tiempos de entrega:</p>
            <p id='autoGen15'>Representante de ventas:</p>
            <p id='autoGen16'>Terminos comerciales:</p>
            <p id='autoGen17'>Incoterm:</p>";
            $descuentoEspecial = 'Descuento especial (18%), aplicado.';
            $deliveryTime = '7 - 10 días aprox.';
            $txtIva = '';
            $numIva = '';
            $txtDiscount = '<p id="autoGen18">Descuento (18%):</p>';
            $numDiscount = '<p id="autoGen19">'.$desc.'</p>';
            $txtSubTotalC = '<p id="autoGen20">Subtotal:</p>';
            $subtotalC = '<p id="autoGen21">'.$subtotal2.'</p>';
            $origin = 'Shanghai - China';
            if ($envioM === 'Aerial'){
                $txtIncoterm = 'DDP '.$nameC.' (Derechos de entrega pagados).';
            }else{
                $txtIncoterm = 'CIF '.$nameC.' (Costo + Seguro + Flete).';
            }
        
            if ($arancel != 0){
                $txtArancel = "<p id='autoGen22'>Arancel:</p>";
                $numArancel = "<p id='autoGen23'>$arancel</p>";
        }else{
            $txtArancel = "";
            $numArancel = "";
        }

        $transitTimeM = "<p id='autoGen24'>Transporte marítimo.</p>
        <p id='autoGen25'>45 - 60 días.</p>
        <p id='autoGen26'>Seguro de transporte incluido</p>";
        $transitTimeA = "<p id='autoGen27'>Flete aéreo (servicio de mensajería).</p>
        <p id='autoGen28'>7 - 15 días.</p>
        <p id='autoGen29'>Seguro de transporte incluido</p>";
        }
        
        if ($envioM === 'Maritime'){            
            $b = "<p id='autoGen30'>$txtIncoterm</p>
            $transitTimeM
            <p id='autoGen31'> $divisa.</p>
            <p id='autoGen32'>1 año contra defectos de fabricación.</p>
            <p id='autoGen33'>$pago.</p>
            <p id='autoGen34'>$origin.</p>";
        
            $a = "
            <p id='autoGen35'>Tiempos de tránsito:</p>
            <p id='autoGen36'>Moneda:</p>
            <p id='autoGen37'>Garantía:</p>
            <p id='autoGen38'>Método de pago:</p>
            <p id='autoGen39'>Origen:</p>";
        }else{
            if ($envioM === 'Aerial'){            
                $b = "<p id='autoGen40'>$txtIncoterm</p>
                $transitTimeA
                <p id='autoGen41'>$divisa.</p>
                <p id='autoGen42'>1 año contra defectos de fabricación.</p>
                <p id='autoGen43'>$pago.</p>
                <p id='autoGen44'>$origin.</p>";
        
                $a = "
                <p id='autoGen45'>Tiempos de tránsito:</p>
                <p id='autoGen46'>Moneda:</p>
                <p id='autoGen47'>Garantía:</p>
                <p id='autoGen48'>Método de pago:</p>
                <p id='autoGen49'>Origen:</p>";
            }else{
                $txtArancel = "";
                $numArancel = "";
                $b = "<p id='autoGen50'>$incoterm.</p>
                <p id='autoGen51'>&nbsp;</p>
                <p id='autoGen52'>&nbsp;</p>
                <p id='autoGen53'>$divisa.</p>
                <p id='autoGen54'>1 año contra defectos de fabricación.</p>
                <p id='autoGen55'>$pago.</p>
                <p id='autoGen56'>$origin.</p>";
        
                $a = "
                <p id='autoGen57'>Tiempos de tránsito:</p>
                <p id='autoGen58'>Moneda:</p>
                <p id='autoGen59'>Garantía:</p>
                <p id='autoGen60'>Método de pago:</p>
                <p id='autoGen61'>Origen:</p>";
        }        
    }

    $resultado = $conexion->query($consulta2);

    


    $imagen01 = __DIR__.'/../assets/images/francia-pais.jpg';
    $imagen02 = __DIR__.'/../assets/images/fondoSolid.png';
    $imagen03 = __DIR__.'/../assets/images/LogoActualizado2.png';
    $imagen0302 = __DIR__.'/../assets/images/LogoActualizado2.png';
    $imagen0303 = __DIR__.'/../assets/images/LogoActualizado2.png';
    $imagen04 = __DIR__.'/../assets/images/qr.jpg';
    $imagen05 = __DIR__.'/../assets/images/k+blanco.png';
    $imagen06 = __DIR__.'/../assets/images/imagen1.jpg';
    $imagen07 = __DIR__.'/../assets/images/img2p.png';
    $imagen08 = __DIR__.'/../assets/images/img1p.png';
    $imagen09 = __DIR__.'/../assets/images/icono1.png';
    $imagen10 = __DIR__.'/../assets/images/icono2.png';
    $imagen11 = __DIR__.'/../assets/images/icono3.png';
    $imagen12 = __DIR__.'/../assets/images/icono4.png';
    $imagen13 = __DIR__.'/../assets/images/icono5.png';
    $imagen14 = __DIR__.'/../assets/images/icono6.png';
    $imagen15 = __DIR__.'/../assets/images/corazon.png';
    $imagen16 = __DIR__.'/../assets/images/img-ce.jpg';
    $imagen17 = __DIR__.'/../assets/images/imagen4.jpg';
    $imagen18 = __DIR__.'/../assets/images/FAQ_ES.png';


?>


<?php

//QUERY FOR TEMPLATE EDITOR

$sql = "SELECT template_html, template_mail, template_variables, template_user 
        FROM wp_customize_template 
        WHERE template_mail LIKE '%$emailAcc%' 
        ORDER BY template_id DESC 
        LIMIT 1";

$result = $conexion->query($sql);

if ($result) {
    $row = $result->fetch_assoc();
    $templateHtml = $row['template_html'];
    $template_variables = $row['template_variables'];
    $template_user = $row['template_user'];
} else {
    echo "Error al obtener datos: " . $conexion->error;
}

if ($result && $result->num_rows > 0) {
    
    $verify = "positivo";
} else {
    
    $verify = "negativo"; 
}

/* $sql2 = "SELECT template_html, template_mail, template_variables, template_user 
         FROM wp_customize_template 
         WHERE template_mail LIKE '%$cotizacionIdRemitente%' 
         ORDER BY template_id DESC 
         LIMIT 1";

$result2 = $conexion->query($sql2);

if ($result2) {
    $row2 = $result2->fetch_assoc();

    if ($row2['template_html'] !== $templateHtml) {
        $templateHtml = $row2['template_html'];
        $template_variables = $row2['template_variables'];
        $template_user = $row2['template_user'];
    }
} else {
    echo "Error al obtener datos: " . $conexion->error;
} */

/* $conexion->close(); */
?>


<!-- declaracion de variables php importadas -->
<?php 

    eval($template_variables); 
    

?>

<link rel='stylesheet' type='text/css' href='pdf.css'>
<style id='estilosGenerados'>
    <?php echo $templateHtml?>
</style>
<style>
    <?php 

        $estilosGenerados = ob_get_contents(); // Esto obtiene el contenido generado hasta este punto

        // Verificamos si el estilo contiene la regla deseada
        if (strpos($estilosGenerados, '.PDFbackground-img {position: absolute; left: -9999px;}') !== false) {
            echo '.PDFf-text { color: rgb(51, 51, 51);}';
            $imagen05 = __DIR__.'/../assets/images/k+azul.png';
        }

        if (strpos($estilosGenerados, '#PDFp2img-02-img {position: absolute; top: -9999px;}') !== false) {
            echo '#PDFp2img-03-img {  margin-bottom: 190px; }';
        }

        if (strpos($estilosGenerados, '#PDFp2img-03-img {position: absolute; top: -9999px;}') !== false) {
            echo '#PDFp2img-02-img {  margin-top: 130px; }';
        }  
        
        if (isset($imagen01FL) && $imagen01FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p1Img01' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p1Img01' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p1Img01' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen01 = $rutaArchivo; 
        }
        
        if ($imagen03FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p1Img02' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p1Img02' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p1Img02' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen03 = $rutaArchivo; 
        }  
        
        if (isset($imagen05FL) && $imagen05FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p1Img03' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p1Img03' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p1Img03' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen05 = $rutaArchivo; 
        }   

        if (isset($imagen0303FL) && $imagen0303FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p2Img01' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p2Img01' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p2Img01' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen0303 = $rutaArchivo; 
        } 

        if (isset($imagen16FL) && $imagen16FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p2Img02' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p2Img02' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p2Img02' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen16 = $rutaArchivo; 
        } 
        
        if (isset($imagen11FL) && $imagen11FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p2Img03' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p2Img03' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p2Img03' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen11 = $rutaArchivo; 
        }

        if (isset($imagen0302FL) && $imagen0302FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p3Img01' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p3Img01' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p3Img01' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen0302 = $rutaArchivo; 
        } 

        if (isset($imagen07FL) && $imagen07FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p3Img02' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p3Img02' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p3Img02' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen07 = $rutaArchivo; 
        }

        if (isset($imagen08FL) && $imagen08FL) {
            $nombreCliente = $template_user;
            $rutaImagen = '/home/he270716/public_html/dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/ImgUpload/';
        
            $archivos = scandir($rutaImagen);
            $numeros = [];
        
            // Buscar archivos con el formato p1Img01pruebaX.png
            foreach ($archivos as $archivo) {
                if (preg_match('/p3Img03' . preg_quote($nombreCliente) . '(\d+)\.\w+/', $archivo, $matches)) {
                    $numeros[] = intval($matches[1]);
                }
                if (strpos($archivo, 'p3Img03' . $nombreCliente) === 0) {
                    $nombreCompleto = pathinfo($archivo);
                    $extension = $nombreCompleto['extension'];
                }
            }
        
            // Obtener el número más alto de forma precisa
            $numeroMasAlto = max($numeros); // Utilizar la función max() para obtener el número más alto
        
            // Crear la ruta con el número más alto
            $rutaArchivo = $rutaImagen . 'p3Img03' . $nombreCliente . $numeroMasAlto . '.' . $extension;
        
            $imagen08 = $rutaArchivo; 
        } 

    ?>

</style>
<div class='PDFcp01'>
    <div class="PDFbackground-img" style="background-image: url(<?php echo $imagen02; ?>);">
    </div>
    <div class='PDFh-01'>
        <img src='<?php echo $imagen01?>' id='PDFp1Img01'>
    </div>
    <div class='PDFb-01'>
        <div class='PDFid'>
            <div class='PDFlogo'>
                <img src='<?php echo $imagen03?>'  id="PDFLogoP1">
            </div>
            <div class='PDFhr'></div>
            <div class='PDFn-id'>
                <p class='PDFco'><?php echo $PDFcoContent ?></p>
                <p class='PDFid-title'><?php echo $PDFidTitleContent?><span class='PDFid-n'><?php echo $id?></span></p>
                <p class='PDFmsj'><?php echo $PDFmsjContent?></p>
            </div>
        </div> 
        <div class='PDFf-01'>
            <div class='PDFqr'>
                <img src='<?php echo $imagen04?>' id='PDFf-01-img'>
            </div>
            <div class='PDFf-text'>
                <p class='PDFl-1'><?php echo $PDFp1L1Content?></p>
                <p class='PDFl-2'><?php echo $PDFp1L2Content?></p>
                <p class='PDFl-3'><?php echo $PDFp1L3Content?></p>
                <p class='PDFl-4'><?php echo $PDFp1L4Content?></p>
                <p class='PDFl-5'><?php echo $PDFp1L5Content?></p>
            </div>
            <div class='PDFhr-2'></div>
            <div class='PDFimg-logo2'>
            <img src='<?php echo $imagen05?>' id="PDFLogo2P1">
            </div>
        </div>       
    </div>    
</div>
<page backtop='58mm' backbottom='30mm' backleft='0mm' backright='0mm'> 
    <page_header> 
        <div class='PDFht'>
            <div class='PDFlogo-03'>
                <img src='<?php echo $imagen0303?>' id='PDFlogoP2'>
            </div>
            <div class='PDFtp-01'>
                <p>KALSTEIN FRANCE SIREN: 819 970 815</p>
            </div>
            <div class='PDFtp-02'>
                <p id='PDFtp-02-p1'>Cotización N°: <span style='font-weight: lighter;'>QUO<?php echo $id?></span></p>
                <p id='PDFtp-02-p2'>Paris, <?php echo $onlyDate?> <?php echo $onlyHours?></p>
            </div>
        </div>
        <div class='PDFhr-04'></div>   
        <div class='PDFcliente'>
            <div class='PDFsres'>
                <p id='PDFsres-p1'>Sres:</p>
                <p id='PDFsres-p2'><?php echo $sres?></p>
            </div>
            <div class='PDFatc'>
                <p id='PDFatc-p1'>Atención:</p>
                <p id='PDFatc-p2'><?php echo $atc?></p>
            </div>
        </div>  
        <div class='PDFc-table'>
            <table>
                <tr>
                    <td class='PDFtd-i'>Item</td>
                    <td class='PDFtd-m'>Modelo</td>
                    <td class='PDFtd-im'>Imagen</td>
                    <td class='PDFtd-d'>Descripción</td>
                    <td class='PDFtd-c'>Cant</td>
                    <td class='PDFtd-u'>Unid</td>
                    <td class='PDFtd-v'>Valor unitario</td>
                    <td class='PDFtd-vt'>Valor total</td>
                </tr>
            </table>
        </div>
    </page_header> 
    <page_footer> 
        <div class='PDFft'>
            <div class='PDFft-01'>
                <div class='PDFimg-ce'>
                    <img src='<?php echo $imagen16?>' id='PDFimg-ce-img'>
                </div>
                <div class='PDFtext-ce' style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>
                    <p id='PDFtext-ce-p1'><?php echo $PDFtextCeP1Content?></p>
                    <p id='PDFtext-ce-p2'><?php echo $PDFtextCeP2Content?></p>
                </div>
                <div class='PDFimg-cora'>
                    <img src='<?php echo $imagen11?>' id='PDFimg-cora-img'>
                </div>
                <div class='PDFtext-cora' style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>
                    <p id='PDFtext-cora-p1'><?php echo $PDFtextCoraP1Content?></p>
                    <p id='PDFtext-cora-p2'><?php echo $PDFtextCoraP2Content?></p>
                </div>
            </div>
            <div class='PDFhr-05'></div>
            <div class='PDFft-02'>
                <div class='PDFft-02-text' style='display: flex; flex-direction: column; justify-content: center; align-items: center;'>
                    <p id='PDFft-02-text-p1'><?php echo $PDFft02TextP1Content?></p>
                    <p id='PDFft-02-text-p2'><?php echo $PDFft02TextP2Content?></p>
                    <p id='PDFft-02-text-p3'><?php echo $PDFft02TextP3Content?></p>
                </div>
                <div class='PDFftn-3'>
                    <p id='PDFftn-3-p'>Página [[page_cu]] de [[page_nb]]</p>
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
                        <table>
                            <tr>
                                <td class='PDFtdb-i'>$i</td>
                                <td class='PDFtdb-m'>$newModel</td>
                                <td class='PDFtdb-img'>
                                    <img src='$newImage' id='autoGen66'>
                                </td>
                                <td class='PDFtdb-d'>
                                    <p id='autoGen63'>$newMaker</p>
                                    <p id='autoGen64'>$name ($priceTotalProduct)</p>
                                    ";
                                        if ($resultParent->num_rows > 0) {
                                            echo "<h5>Accesorios añadidos</h5>";
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
                }else{
                    echo "
                        <table>
                            <tr>
                                <td class='PDFtdb-i'>$i</td>
                                <td class='PDFtdb-m'>$newModel</td>
                                <td class='PDFtdb-img'>
                                    <img src='$newImage' style='width: 100%;'>
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
                        <p id='PDFob-p-p1'><?php echo $deliveryTime?></p>
                        <p id='PDFob-p-p2'>Correo: sales.department@dev.kalstein.plus/plataforma</p>
                        <p id='PDFob-p-p3'>Tlf: +33 1 7895 8789 / +33 6 8076 0710</p>
                        <p id='PDFob-p-p4'>Pago anticipado con orden de compra.</p>
                        <p id='PDFob-p-p5'><?php echo $descuentoEspecial?></p>
                        <?php 
                            echo $b;  
                        ?>
                    </div>
                </div>
            </div>
            <div class='PDFtotales'>
                <div class='PDFsubtotales'>
                    <div class='PDFtotales-t PDFp3P'>
                        <p id='PDFtotales-t-p1'>Subtotal:</p>
                        <?php
                            echo $txtDiscount;
                            echo $txtSubTotalC;
                        ?>
                        <p id='PDFtotales-t-p2'>Envío:</p>
                        <?php
                            echo $txtArancel;
                            echo $txtIva;
                        ?>
                        <p id='PDFtotales-t-p3'>Total:</p>
                    </div>
                    <div class='PDFtotales-n PDFp3P'>
                        <p id='PDFtotales-n-p1'><?php echo $subtotal?></p>
                        <?php
                            echo $numDiscount;
                            echo $subtotalC
                        ?>
                        <p id='PDFtotales-n-p2'><?php echo $envio?></p>
                        <?php
                            echo $numArancel;
                            echo $numIva;
                        ?>            
                        <p id='PDFtotales-n-p3'><?php echo $total?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</page>
<page backtop='0mm' backbottom='0mm' backleft='0mm' backright='0mm'>
    <div class='PDFstyle-05'></div>
    <div class='PDFh4-02'>
        <div class='PDFlogo4-02'>
            <img src='<?php echo $imagen0302?>' id='PDFlogo4-02-img'>
        </div>
        <div class='PDFhr4-02'></div>
        <div class='PDFh4-text-02'>
            <p class='PDFlt4-01'>CONDICIONES COMERCIALES</p>
        </div>
    </div>
    <div class='PDFp2img-02'>
        <img src='<?php echo $imagen07?>' id='PDFp2img-02-img'>
    </div>
    <div class='PDFp2img-03'>
        <img src='<?php echo $imagen08?>' id='PDFp2img-03-img'>
    </div>
    <div class='PDFmain-text'>
        <p id='p3Sub1' class='PDFp3ST'>ACEPTACIÓN DE LA ORDEN DE COMPRA</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p1'>•</p>
            <p id='PDFi-list-p2'>•</p>
            <p id='PDFi-list-p3'>•</p>
        </div>
        <div class='PDFi-txt PDFp3P'>
            <p id='PDFi-txt-p1'>Kalstein France SAS recibe una orden de compra a satisfacción, cuando este documento expresa fielmente las condiciones comerciales establecidas en la oferta.</p>
            <p id='PDFi-txt-p2'>Pagos en efectivo: Para la tramitación y envío de la mercancía solicitada, se requiere la verificación del pago en las cuentas bancarias de Kalstein France.</p>
            <p id='PDFi-txt-p3'>Clientes con crédito: Para la tramitación y envío de la mercancía solicitada se requiere el justificante de pago en cuentas bancarias de Kalstein France.</p> 
        </div>
        <p id='p3Sub2' class='PDFp3ST'>NEGOCIACIÓN DE DIVISAS</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p4'>•</p>
            <p id='PDFi-list-p5'>•</p>
        </div>
        <div class='PDFi-txt2 PDFp3P'>
            <p id='PDFi-txt2-p1'>Ofertas en moneda extranjera, el cálculo de conversión de divisas se realizará de acuerdo con las disposiciones del Banco de Francia, fijado en el día de la facturación.</p>
            <p id='PDFi-txt2-p2'>La moneda de negociación establecida para esta cotización es <?php echo $divisa?>.</p>
        </div>
        <p id='p3Sub3' class='PDFp3ST' >GARANTÍA</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p5'>•</p>
            <p id='PDFi-list-p6'>•</p>
            <p id='PDFi-list-p7'>•</p>
        </div>
        <div class='PDFi-txt3 PDFp3P'>
            <p id='PDFi-txt3-p1'>Todos los equipos vendidos por Kalstein Francia tienen una garantía de un año a efectos de fabricación a partir de la fecha de facturación de la mercancía.</p>
            <p id='PDFi-txt3-p2'>La garantía no cubre los daños causados por una mala instalación o funcionamiento, defectos de transporte o por usos distintos de los especificados por el fabricante.</p>
            <p id='PDFi-txt3-p3'>La garantía excluye las piezas eléctricas o consumibles.</p>
        </div>
        <p id='p3Sub4' class='PDFp3ST'>TIEMPOS DE ENTREGA</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p8'>•</p>
        </div>
        <div class='PDFi-txt4 PDFp3P'>
            <p id='PDFi-text4-p1'>Los plazos de entrega indicados en este presupuesto son estimaciones sujetas a variables.</p>
        </div>
        <p id='p3Sub5' class='PDFp3ST'>ANULACIONES Y DEVOLUCIONES SIN CAUSA JUSTIFICADA</p>
        <div class='PDFi-list PDFp3P'>
            <p id='PDFi-list-p9'>•</p>
            <p id='PDFi-list-p10'>•</p>
            <p id='PDFi-list-p11'>•</p>
        </div>
        <div class='PDFi-txt5 PDFp3P'>
            <p id='PDFi-text5-p1'>La mercancía en existencias tendrá una penalización equivalente al 20% del valor de la orden de compra.</p>
            <p id='PDFi-text5-p2'>Mercancía de Importación, después de recibir la orden de compra a satisfacción, hay un máximo de (3) días para cancelar la orden de compra, después de este tiempo no se aceptan cancelaciones y la mercancía se facturará según lo establecido.</p>
            <p id='PDFi-text5-p3'>La devolución de la mercancía será responsabilidad del Cliente, la caja, embalaje y todas las partes que componen el equipo a devolver, deberán estar en perfecto estado sin maltratos, arañazos y etiquetas adicionales, el equipo de Soporte Técnico y Logística de Kalstein Francia, realizará informe técnico e indicará la recepción satisfactoria de la mercancía. En caso de no ser recibida satisfactoriamente, el equipo será facturado de acuerdo con lo establecido en la Orden de Compra.</p>
        </div>
        <p id='p3Sub6' class='PDFp3ST'>POLÍTICAS, TÉRMINOS Y CONDICIONES GENERALES</p>
        <p id='p3Sub7' class="PDFp3P">https://kalstein.eu/p12/Terms-and-Conditions/pages.html</p>
    </div>
    <div class='PDFstyle-07'><p id='PDFstyle-07-p1'>Página [[page_cu]] de [[page_nb]]</p></div>
</page>


    