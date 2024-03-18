<?php
    session_start();

    //prueba
    $search = '';

    if (isset($_GET['search'])){        
        $search = $_GET ? $_GET['search'] : '';
    }
    else {
        if(isset($_SESSION['model-to-open-in-platform'])) {
            $search = $_SESSION['model-to-open-in-platform'] != '' ? $_SESSION['model-to-open-in-platform'] : $search;
        }
    }

    session_write_close();
?>

<input type="hidden" id="search-product" value="<?php echo $search ?>">
<link rel="icon" type="image/x-icon" href="https://kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/favicon.ico">
<script src="https://cdn.tailwindcss.com"></script>
<script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/i18next@21.6.10/i18next.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-i18next@1.2.1/jquery-i18next.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/i18next-browser-languagedetector@6.1.3/i18nextBrowserLanguageDetector.min.js"></script>

<body>
<div class='container'>
    <div id='contentLogin' class='row align-items-start'>
        <div class='col'>
            <div class='card' style='min-width: 18rem; max-width: 26rem; margin: 0 auto; margin-top: 10rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75);'>
                <a href='https://kalstein.net/es/' style='margin: 0 auto;'><img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png' class='card-img-top' style='width: 200px;  margin-top: 4rem; margin-bottom: 2rem;'></a>
                <div class='card-body'>
                    <h5 class='card-title text-center fs-5' data-i18n="account:Bienvenida">Kalstein Plus Development Enviroment.</h5>
                    <div class='col-md' style='margin-top: 1rem;'>
                        <div class='form-floating input-wrapper'>
                            <input type='email' class='form-control' autocomplete="off" id='emailUser' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                            <label for='emailUser' data-i18n="account:LabelCorreo">Correo electrónico</label>                             
                        </div>
                        <div class='emailError' style='display: none;'><p data-i18n="account:CorreoNoValido" style='color: #de3a46; font-weight: bold;'>El correo no es válido</p></div>
                        <div class='emailNoRegister' style='display: none;'><p data-i18n="account:CorreoNoRegistrado" style='color: #de3a46; font-weight: bold;'>Correo electrónico no registrado</p></div>
                        <div id='c-password' style='margin-top: 1rem; display: none;'>
                            <div class='form-floating input-wrapper-p'>
                                <input type='hidden' id='ipConnect'>
                                <input type='password' class='form-control' id='passwordGrid' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='passwordGrid' data-i18n="account:Password">Contraseña es requerida</label>
                                <i class='fa-sharp fa-solid fa-eye eye-03'></i>
                            </div>
                            <div class='passwordIncorrect' style='display: none;'><p data-i18n="account:PasswordIncorrecta" style='color: #de3a46; font-weight: bold;'>Contraseña incorrecta</p></div>
                            <p style='margin-top: 0.5rem; margin-left: 10px; font-size: 1.2em;'><span class='forgotpw' style='color: #213280; cursor: pointer; font-weight: bold;'><a href='#' id='btnForgotPassword' data-i18n="account:forgotPassword">¿Olvidaste tu contraseña?</a></span></p>
                        </div>
                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnContinueLogIn' data-i18n="account:tittleButton">Continuar</button>
                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnContinueLogIn2' data-i18n="account:tittleButton">Continuar</button>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <p style="margin-top: 1rem; margin-bottom: 4rem; font-size: 1.2em; margin-right: 0.5rem;" data-i18n="account:noAccount">¿No posees una cuenta?</p>
                        <span class='singup' style='color: #213280; cursor: pointer; font-weight: bold; margin-top: -3rem;'>
                            <a data-i18n="account:registrate" href='https://dev.kalstein.plus/plataforma/registrarse/<?php echo $search != '' ? "?search=$search" : '' ?>'>Regístrate</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='contentEmailSendingRecovery' class='row align-items-start' style='display: none;'>
        <div class='col'>
            <div class='card' style='min-width: 18rem; max-width: 26rem; margin: 0 auto; margin-top: 10rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75);'>
                <a href='https://kalstein.net/es/' style='margin: 0 auto;'><img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png' class='card-img-top' style='width: 200px;  margin-top: 4rem; margin-bottom: 2rem;'></a>
                <div class='card-body'>
                    <h5 class='card-title text-center fs-5' data-i18n="account:restorePassword">Enviar correo para restablecer la contraseña</h5>
                    <p id='pMsjSendingResetPassword' style='text-align: justify;'></p>
                    <div class='col-md' style='margin-top: 1rem;'>
                        <div class='form-floating'>
                            <input type='email' class='form-control' id='emailUserConfirm' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' autofocus>
                            <label for='emailUserConfirm' data-i18n="account:LabelCorreo">Correo electrónico</label>                               
                        </div>
                        <div class='emailErrorRecoveryPassword' style='display: none;'><p data-i18n="account:CorreoNoValido" style='color: #de3a46; font-weight: bold;'>El correo no es válido.</p></div>
                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnValidatedEmail' data-i18n="account:sendEmail">Enviar correo</button>
                    </div>
                    <p style='margin-top: 1rem; margin-bottom: 4rem; font-size: 1.2em;'><span class='back' style='color: #213280; cursor: pointer; font-weight: bold;'><a data-i18n="account:botonAtras" id='back' href='#'>&#8592; Atrás</a></span></p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

<script>
jQuery(document).ready(function($) {
    $.ajax({
        url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/set-cookie.php',
        type: 'POST', 
        success: function(response) {
            console.log("Response: ", response); 
            console.log("Cookie set");
        },
        error: function(xhr, status, error) {
            console.log('Error al intentar establecer las cookies.');
            console.log("Status: ", status);
            console.log("Error: ", error);
        }
    });
});


</script>
