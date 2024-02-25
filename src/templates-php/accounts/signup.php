<?php
    session_start();

    if (isset($_GET['search'])){        
        $search = $_GET? $_GET['search'] : '';
    }else{
        if(isset($_SESSION['model-to-open-in-platform'])){
            $search = $_SESSION['model-to-open-in-platform'] != '' ? $_SESSION['model-to-open-in-platform'] : $search;
        }

        session_write_close();
    }

?>

<input type="hidden" id="search-product" value="<?php echo $search ?>">
<script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
<div class='container'>
    <div class='row align-items-start'>
        <div class='col'>
            <div class='card' style='min-width: 18rem; max-width: 26rem; margin: 0 auto; margin-top: 10rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75);'>
                <a href='https://kalstein.net/es/' style='margin: 0 auto;'><img src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png' class='card-img-top' style='width: 200px;  margin-top: 4rem; margin-bottom: 2rem;'></a>
                <div class='card-body'>
                    <h5 class='card-title text-center fs-5'>Cree su cuenta</h5>
                    <div class='col-md' style='margin-top: 1rem;'>
                        <div class='form-floating input-wrapper c-email'>
                            <input type='email' class='form-control' id='emailUser' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                            <label for='emailUser'>Correo electrónico</label>                               
                        </div>
                        <div class='emailError'  style='display: none;'><p style='color: #de3a46; font-weight: bold;'>El correo no es válido</p></div>
                        <div class='availableMail'  style='display: none;'><p style='color: #229e1e; font-weight: bold;'>Correo disponible</p></div>
                        <div class='mailExists'  style='display: none;'><p style='color: #de3a46; font-weight: bold;'>Este correo electrónico ya está registrado, intente iniciar sesión.</p></div>
                        <div id='c-password' style='margin-top: 1rem; display: none;'>
                            <div class='form-floating c-email'>
                                <input type='email' class='form-control' id='userTag' placeholder='@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' readonly>
                                <label for='emailUser'>Etiqueta de usuario</label>                               
                            </div>
                            <div class='form-floating input-wrapper-p' style='margin-top: 1rem;'>
                                <input type='password' class='form-control' id='passwordGrid' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='passwordGrid'>Contraseña</label>
                                <i class='fa-sharp fa-solid eye-03 fa-eye'></i>
                            </div>
                            <div class='container required-info'>
                                <p>Your password must containt:</p>
                                <div class='container subRequired-info'>
                                    <p class='p01'>• Al menos 8 caracteres</p>
                                    <p class='p02'>• Letras minúsculas (a-z)</p>
                                    <p class='p03'>• Letras mayúsculas (A-Z)</p>
                                    <p class='p04'>• Numeros (0-9)</p>
                                    <p class='p05'>• Caracteres especiales (!@#$%^&*)</p>
                                </div>
                            </div>
                        </div>
                        <div class='c-codeVerification' style='display: none;'>
                            <p style='font-size: 1.3em; text-align: justify;'>Hemos enviado un correo electrónico a <span class='spanEmail' style='font-weight: bold;'></span> con el código de verificación.</p>
                            <hr>
                            <div class='form-floating'>
                                <input type='text' class='form-control' id='txtCodeVerification' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='txtCodeVerification'>Verificación de códigos</label>                               
                            </div>
                            <div class='codeExpired' style='display: none;'><p style='color: #de3a46; font-weight: bold;'>El código de validación ha caducado, solicite un nuevo código.</p></div>
                            <div class='codeError' style='display: none;'><p style='color: #de3a46; font-weight: bold;'>El código de validación no es válido.</p></div>
                            <p class='newCode' style='cursor: pointer; margin-top: 0.5rem; margin-left: 10px; font-size: 1.2em;'>Solicite aquí un nuevo código de validación</p>
                        </div>
                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnContinueSignUp'>Continuar</button>
                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnContinueSignUp2'>Continuar</button>
                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnContinueSignUp3'>Continuar</button>
                    </div>
                    <p class='redirectLogin' style='margin-top: 1rem; margin-bottom: 4rem; font-size: 1.2em;'>¿Ya tiene una cuenta? <span class='singup' style='color: #213280; cursor: pointer; font-weight: bold;'><a href='https://plataforma.kalstein.net/acceder/<?php echo $search != '' ? "?search=$search" : '' ?>'>Iniciar sesión</a></span></p>
                </div>
            </div>
        </div>
    </div>
</div>