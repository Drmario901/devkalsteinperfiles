<?php
/*ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);*/

session_start();
if (isset($_SESSION["emailAccount"])) {
  $email = $_SESSION["emailAccount"];
}

/*require '/home/he270716/public_html/plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/conexion.php';

	$consulta = "SELECT * FROM wp_account WHERE account_correo = '$email'";*/

// if (isset($_GET['pay'])) {
//   $idCotizacion = $_GET['idCotizacion'];
//   $pay = $_GET['pay'];
// }

/*$urlImg = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/templates-php/client/404_plataforma/pago_aprobado.png';*/
?>

<!DOCTYPE html>
<html lang="en" prefix="og: http://ogp.me/ns#">

<head>
  <meta charset="UTF-8" />
  <title>Pago Aprobado</title>
  <meta name="robots" content="index, follow" />
  <meta name="distribution" content="global" />
  <meta name="copyright" content="Pago Aprobado" />
  <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0" />

  <!-- Meta datos sociales -->
  <meta property="og:title" content="Kalstein C.A." />
  <meta property="og:type" content="website" />

  <!-- <link rel="shortcut icon" href="assets/public/images/favicon/favicon.ico"/>
		<link rel="icon" type="image/png" href="assets/public/images/favicon/favicon.ico"/> -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

  <style>
    .montserrat-.aprob_details>h1 {
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

    .success_container {
      max-width: 100%;
      height: 100%;
      margin: 0px auto;
      padding: 0px;
      box-sizing: border-box;
    }

    .aprob__container {
      display: flex;
      flex-direction: row;
      justify-content: center;
      align-items: center;
      width: 82%;
      margin: 0px auto;
      padding: 0px;
      box-sizing: border-box;
    }

    .aprob_details {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      width: 50%;
      margin-right: 20px;
    }

    .aprob_details>h1 {
      position: relative;
      width: 100%;
      margin: 0px auto;
      font-size: 55px;
      font-family: 'Montserrat';
      text-align: center;
      color: #213280;
    }

    .aprob_details>h1::before {
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

    .aprob_details>span {
      width: 100%;
      margin: 35px 0px 42px;
      font-size: 20px;
      font-family: 'Roboto';
      font-weight: bold;
      text-align: center;
      color: #878787e3;
    }

    .aprob_details>a {
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

    .aprob_details>a:hover {
      border: 2px solid #213280;
      background-color: #ffffff;
      color: #213280;
    }

    .aprob_img_container {
      width: 50%;
      margin-left: 20px;
    }

    .check-container {
      width: 330px;
      height: 365px;
      display: flex;
      flex-flow: column;
      align-items: center;
      justify-content: space-between;
      transform: translateY(35px);
    }

    .check-container .check-background {
      width: 100%;
      height: calc(100% - 1.25rem);
      background: linear-gradient(to bottom right, #328021, #328021);
      box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
      transform: scale(0.84);
      border-radius: 50%;
      animation: animateContainer 0.75s ease-out forwards 0.75s;
      display: flex;
      align-items: center;
      justify-content: center;
      opacity: 0;
    }

    .check-container .check-background svg {
      width: 65%;
      transform: translateY(0.25rem);
      stroke-dasharray: 80;
      stroke-dashoffset: 80;
      animation: animateCheck 0.35s forwards 1.25s ease-out;
    }

    .check-container .check-shadow {
      bottom: calc(-15% - 5px);
      left: 0;
      border-radius: 50%;
      animation: animateShadow 0.75s ease-out forwards 0.75s;
    }

    @keyframes animateContainer {
      0% {
        opacity: 0;
        transform: scale(0);
        box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
      }

      25% {
        opacity: 1;
        transform: scale(0.9);
        box-shadow: 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
      }

      43.75% {
        transform: scale(1.15);
        box-shadow: 0px 0px 0px 43.334px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 65px rgba(255, 255, 255, 0.25) inset;
      }

      62.5% {
        transform: scale(1);
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 21.667px rgba(255, 255, 255, 0.25) inset;
      }

      81.25% {
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
      }

      100% {
        opacity: 1;
        box-shadow: 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset, 0px 0px 0px 0px rgba(255, 255, 255, 0.25) inset;
      }
    }

    @keyframes animateCheck {
      from {
        stroke-dashoffset: 80;
      }

      to {
        stroke-dashoffset: 0;
      }
    }

    @keyframes animateShadow {
      0% {
        opacity: 0;
        width: 100%;
        height: 15%;
      }

      25% {
        opacity: 0.25;
      }

      43.75% {
        width: 40%;
        height: 7%;
        opacity: 0.35;
      }

      100% {
        width: 85%;
        height: 15%;
        opacity: 0.25;
      }
    }

    .check-container {
      animation: moveAlert 1.5s ease-in-out infinite;
    }

    @keyframes moveAlert {
      50% {
        transform: translateY(0px);
      }

      100% {
        transform: translateY(35px);
      }
    }

    @media (max-width: 860px) {
      .aprob_details>h1 {
        font-size: 60px;
      }

      .aprob_details>h1::before {
        height: 6px;
      }
    }

    @media (max-width: 750px) {
      .aprob__container {
        flex-direction: column-reverse;
      }

      .aprob_details {
        width: 100%;
        align-items: center;
      }

      .aprob_details>h1 {
        width: auto;
        text-align: center;
      }

      .aprob_details>span {
        margin: 30px 0px;
        text-align: center;
      }

      .aprob_img_container {
        width: 80%;
        margin: auto;
      }
    }

    @media (max-width: 550px) {
      .aprob_details>h1 {
        font-size: 50px;
      }

      .aprob_details>h1::before {
        height: 5px;
      }

      .aprob_img_container {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <div class="contenedor_ppal">
    <div class="success_container">
      <div class="aprob__container">
        <div class="aprob_details">
          <h1>¡Subscripcion<strong> Aprobada</strong>!</h1>
          <span class="roboto-black">Su subscripcion ha sido aprobada exitosamente.</span>
          <a href="https://dev.kalstein.plus/plataforma/account_redirect?pay=<?php echo $pay ?>&idCotizacion=<?php echo $idCotizacion ?>" title="Back to Homepage" class="roboto-black">
            Volver a la Plataforma
          </a>
        </div>

        <div class="aprob_img_container">
          <div class="check-container">
            <div class="check-background">
              <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13" stroke-linecap="round" stroke-linejoin="round"></path>
              </svg>
            </div>
            <div class="check-shadow"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>

</html>