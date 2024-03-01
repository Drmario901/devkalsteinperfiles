<?php 
if(isset($_SESSION["emailAccount"])){
    $email = $_SESSION["emailAccount"];
}else{
    header('Location: https://dev.kalstein.plus/');
}

$consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";
$resultConsulta = $conexion->query($consulta);
$row = mysqli_fetch_array($resultConsulta);
$idAcc = $row[1];
$name = $row[3];
$lastname = $row[4];
$rolAccount = $row[5];
$addressAcc = $row[6];
$locationAcc = $row[7];
$countryAcc = $row[8];
$zipcodeAcc = $row[9];
$phoneAcc = $row[10];
$imgPerfil = $row[12];
$birthdayAcc = $row[13];
$newBirthdayAcc = date('Y-m-d', strtotime($birthdayAcc));
$firstLyricsName = strtoupper($name[0]);
$firstLyricsLastname = strtoupper($lastname[0]);
$iDocument = $row[14];
$imageDocument = $row[15];

$consulta2 = "SELECT * FROM wp_company WHERE company_account_correo = '$email'";
$resultConsulta2 = $conexion->query($consulta2);
$row2 = mysqli_fetch_array($resultConsulta2);
$companyRole = $row2[2];
$companyName = $row2[3];
$companyAddress = $row2[4];
$companyState = $row2[5];
$companyCountry = $row2[6];
$companyPhone = $row2[7];
$companyZipcode = $row2[8];
$companyWebsite = $row2[9];
$companyRif = $row2[10];
$company_image_rif = $row2[11];

$queryQuote = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
$rsQueryQuote = $conexion->query($queryQuote);
$cantQuote = mysqli_num_rows($rsQueryQuote);

$queryPendingQuote = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status = 'Pending'";
$rsPendingQuote = $conexion->query($queryPendingQuote);
$cantQuotePending = mysqli_num_rows($rsPendingQuote);

$queryProcessQuote = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status = '1'";
$rsProcessQuote = $conexion->query($queryProcessQuote);
$cantQuoteProcess = mysqli_num_rows($rsProcessQuote);

$queryProcessQuote2 = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email' AND cotizacion_status = 'Processed'";
$rsProcessQuote2 = $conexion->query($queryProcessQuote2);
$cantQuoteProcess2 = mysqli_num_rows($rsProcessQuote2);

$cantQuoteProcessFull = $cantQuoteProcess + $cantQuoteProcess2;

if ($imgPerfil == ''){
    $urlImagePerfil = 'Iconos/'.$firstLyricsName.'/'.$firstLyricsName.''.$firstLyricsLastname.'.png';
}else{
    $urlImagePerfil = 'upload/'.$imgPerfil;
}

?>

