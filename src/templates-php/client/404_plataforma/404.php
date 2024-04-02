<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	//session_start();
	if(isset($_SESSION["emailAccount"])){
		$email = $_SESSION["emailAccount"];
	}

	//require '/home/he270716/public_html/plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/conexion.php';

	if (isset($_GET['pay'])) {
		$idCotizacion = $_GET['idCotizacion'];
		$pay = $_GET['pay'];
	}
	
?>

<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">
	<head>
		<meta charset="UTF-8"/>
		<title>Error</title>
		<meta name="robots" content="index, follow"/>
		<meta name="distribution" content="global"/>
		<meta name="copyright" content="Error"/>
		<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0"/>

		<!-- Meta datos sociales -->
		<meta property="og:title" content="Kalstein C.A."/>
		<meta property="og:type" content="website"/>

		<!-- <link rel="shortcut icon" href="assets/public/images/favicon/favicon.ico"/>
		<link rel="icon" type="image/png" href="assets/public/images/favicon/favicon.ico"/> -->
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

		<style>
			.montserrat-.error_details > h1 {
				font-family: "Montserrat", sans-serif;
				font-optical-sizing: auto;
				font-weight: bold;
				font-style: normal;
			}

			.roboto-black {
				font-family: "Roboto", sans-serif;
				font-weight: 900;
				font-style: normal;
			}

			body:not(.btPageTransitions) {
				min-height: 100vh !important;
			}

			.vce {
				margin-bottom: 0px !important;
			}

			.vce-row-content {
				padding: 0em !important;
			}

			.contenedor_ppal {
				display: flex;
				flex-direction: row;
				justify-content: center;
				align-items: center;
				min-height: 95vh;
				overflow: hidden;
			}

			.errors_container {
				max-width: 100%;
				height: 100%;
				margin: 0px auto;
				padding: 0px;
				box-sizing: border-box;
			}

			.error__container {
				display: flex;
				flex-direction: row;
				justify-content: center;
				align-items: center;
				width: 82%;
				margin: 0px auto;
				padding: 0px;
				box-sizing: border-box;
			}

			.error_details {
				display: flex;
				flex-direction: column;
				justify-content: center;
				align-items: center;
				width: 50%;
			}

			.error_details > h1 {
				position: relative;
				width: 100%;
				margin: 0px auto;
				font-size: 55px;
				font-family: 'Montserrat';
				text-align: center;
				color: #213280;
			}

			.error_details > h1::before {
				position: absolute;
				bottom: 0%;
				left: 0%;
				content: '';
				width: 100%;
				height: 8px;
				border: none;
				border-radius: 20px;
				box-sizing: border-box;
				background-color: #213280;
			}

			.error_details > span {
				width: 100%;
				margin: 35px 0px 42px;
				font-size: 20px;
				font-family: 'Roboto';
				font-weight: bold;
				text-align: center;
				color: #878787e3;
			}

			.error_details > a {
				display: inline-block;
				margin: 0px;
				padding: 7px 12px;
				border: 2px solid #213280;
				border-radius: 20px;
				font-size: 18px;
				font-family: 'Roboto';
				font-weight: bold;
				text-align: center;
				text-decoration: none;
				background-color: #213280;
				color: #ffffff;
				transition: 0.3s ease all;
			}

			.error_details > a:hover {
				border: 2px solid #213280;
				background-color: #ffffff;
				color: #213280;
			}

			.error_img_container {
				width: 50%;
			}

			.error_img {
				display: flex;
				flex-direction: row;
				justify-content: center;
				align-items: center;
				width: 100%;
				height: 100%;
				margin: 0px;
				animation: moveAlert 1.5s ease-in-out infinite;
			}

			@keyframes moveAlert {
				0% {transform: scale(1,1);}
				50% {transform: scale(1.05,1.05);}
				100% {transform: scale(1,1);}
			}

			@media (max-width: 860px) {
				.error_details > h1 {
					font-size: 60px;
				}

				.error_details > h1::before {
					height: 6px;
				}
			}

			@media (max-width: 750px) {
				.error__container {
					flex-direction: column-reverse;
				}

				.error_details {
					width: 100%;
					align-items: center;
				}

				.error_details > h1 {
					width: auto;
					text-align: center;
				}

				.error_details > span {
					margin: 30px 0px;
					text-align: center;
				}

				.error_img_container {
					width: 80%;
					margin: auto;
				}
			}

			@media (max-width: 550px) {
				.error_details > h1 {
				    font-size: 50px;
				}

				.error_details > h1::before {
				    height: 5px;
				}

				.error_img_container {
				    width: 100%;
				}
			}
		</style>
	</head>
<body>

	<div class="contenedor_ppal">
		<div class="errors_container">
			<div class="error__container">
				<div class="error_details">
					<h1>Pago <strong>rechazado</strong> o <strong>cancelado</strong>.</h1>
					<span class="roboto-black">Lo sentimos, ha ocurrido un problema con su pago.</span>
					<a href="https://dev.kalstein.plus/plataforma/account_redirect?pay=<?php echo $pay?>&idCotizacion=<?php echo $idCotizacion ?>" title="Back to Homepage" class="roboto-black">
						Volver a la Plataforma
					</a>
				</div>

				<div class="error_img_container">
					<div class="error_img">
						<svg xmlns="http://www.w3.org/2000/svg" width="320" height="320" viewBox="0 0 512 512">
							<path fill="#de3a46" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"/>
						</svg>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>