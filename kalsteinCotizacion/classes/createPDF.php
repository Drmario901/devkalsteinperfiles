<?php
session_start();

require __DIR__ . '/../vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;

/*require __DIR__ . '/conexion.php';



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

	if ($cotizacionIdRemitente != 'KALSTEIN-INTERNAL') {
		$templateFile = __DIR__.'/customTemplate.php';
	} else {
		$templateFile = __DIR__.'/template.php';
	}

	 $templateFile = __DIR__.'/template.php'; 

	if(isset($_SESSION["cName"])){
				$cName = $_SESSION["cName"];
				$cNameEncrypt = md5($cName);
		} else {
				$cName = empty($cName) ? 'prueba' : $cName;
				$$cNameEncrypt = md5($cName);
		} 

	$consulta = "SELECT * FROM wp_customize_template WHERE template_user = '$cName' ORDER BY template_id DESC LIMIT 1";
	$resultado = $conexion->query($consulta);
	
	if ($resultado) {
		
		if (mysqli_num_rows($resultado) > 0) {
			
			$templateFile = __DIR__.'/customTemplate.php';
			
		} else {
			
			$templateFile = __DIR__.'/template.php';
		}
	} else {
		
		
	}*/

$templateFile = __DIR__ . '/template.php';

ob_start();
require_once $templateFile;
$html = ob_get_clean();

$html2pdf = new HTML2PDF('P', 'letter', 'es', true, 'UTF-8', 3);
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($html);
$html2pdf->output('cotizacion.pdf');
?>