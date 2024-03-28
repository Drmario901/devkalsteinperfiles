<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();

require __DIR__ . '/../../../php/conexion.php';
if (isset($_GET['search'])) {
    $search = $_GET ? $_GET['search'] : '';
} else {
    if (isset($_SESSION['model-to-open-in-platform'])) {
        $search = $_SESSION['model-to-open-in-platform'] != '' ? $_SESSION['model-to-open-in-platform'] : $search;
    }

    session_write_close();
}

$query = "SELECT nombre, prefijo_internacional FROM wp_paises_prefijos ORDER BY nombre ASC";
$resultado = $conexion->query($query);

?>

<input type="hidden" id="search-product" value="<?php echo $search ?>">
<script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
<div class='container'>
    <div class='row align-items-start'>
        <div class='col'>
            <div class='card'
                style='min-width: 18rem; max-width: 26rem; margin: 0 auto; margin-top: 10rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75);'>
                <a href='https://kalstein.net/es/' style='margin: 0 auto;'><img
                        src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png'
                        class='card-img-top' style='width: 200px;  margin-top: 4rem; margin-bottom: 2rem;'></a>
                <div class='card-body'>
                    <h5 class='card-title text-center fs-5' data-i18n="account:createAccount">Cree su cuenta</h5>
                    <div class='col-md' style='margin-top: 1rem;'>
                        <div class='form-floating input-wrapper c-email'>
                            <input type='email' class='form-control' id='emailUser' placeholder='name@example.com'
                                style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'
                                autofocus>
                            <label for='emailUser' data-i18n="account:LabelCorreo">Correo electrónico</label>
                        </div>
                        <div class='emailError' data-i18n="account:CorreoNoValido" style='display: none;'>
                            <p style='color: #de3a46; font-weight: bold;'>El correo no es válido</p>
                        </div>
                        <div class='availableMail' data-i18n="account:correoDisponible" style='display: none;'>
                            <p style='color: #229e1e; font-weight: bold;'>Correo disponible</p>
                        </div>
                        <div class='mailExists' data-i18n="account:correoRegistrado" style='display: none;'>
                            <p style='color: #de3a46; font-weight: bold;'>Este correo electrónico ya está registrado,
                                intente iniciar sesión.</p>
                        </div>
                        <div id='c-password' style='margin-top: 1rem; display: none;'>
                            <div class='form-floating c-email'>
                                <input type='email' class='form-control' id='userTag' placeholder='@example.com'
                                    style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' readonly>
                                <label for='emailUser' data-i18n="account:labelUsuario">Etiqueta de usuario</label>
                            </div>
                            <div class='form-floating input-wrapper' style='margin-top: 1.3rem; position: relative;'>
                                <select class='paisesPrefijos' id='paisesPrefijos' <?php
                                if ($resultado->num_rows > 0) {
                                    while ($fila = $resultado->fetch_assoc()) {
                                        echo "<option value='" . $fila['prefijo_internacional'] . "'>" . $fila['nombre'] . " (" . $fila['prefijo_internacional'] . ")</option>";
                                    }
                                } else {
                                    echo "<option>No hay países disponibles</option>";
                                }
                                ?> </select>
                                    <input type='number' class='form-control' id='telefono' name="telefono"
                                        placeholder='Número de teléfono'
                                        style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: calc(100px + 2em); margin-left: 100px;'
                                        autofocus>
                                    <label for='telefono' style="margin-left: calc(100px + 2.5rem);"
                                        data-i18n="account:labelNumero">Teléfono</label>
                            </div>
                            <div>
                                <label for="countryPrefix">Prefijo del país:</label>
                                <select id="countryPrefix" onchange="setPhonePrefix()">
                                    <option value="">Selecciona un prefijo</option>
                                    <option value="+1">Estados Unidos (+1)</option>
                                    <option value="+34">España (+34)</option>
                                    <option value="+52">México (+52)</option>
                                    <!-- Agrega más países y sus prefijos aquí -->
                                </select>

                                <label for="phoneNumber">Teléfono:</label>
                                <input type="text" id="phoneNumber" placeholder="Tu número de teléfono aquí">
                            </div>
                            <div class='form-floating input-wrapper-p' style='margin-top: 1rem;'>
                                <input type='password' class='form-control' id='passwordGrid'
                                    placeholder='name@example.com'
                                    style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'
                                    autofocus>
                                <label for='passwordGrid' data-i18n="account:Password">Contraseña</label>
                                <i class='fa-sharp fa-solid eye-03 fa-eye'></i>
                            </div>
                            <div class='container required-info'>
                                <p data-i18n="account:passwordInfo">Su contraseña debe contener:</p>
                                <div class='container subRequired-info'>
                                    <p class='p01' data-i18n="account:passwordO1">• Al menos 8 caracteres</p>
                                    <p class='p02' data-i18n="account:passwordO2">• Letras minúsculas (a-z)</p>
                                    <p class='p03' data-i18n="account:passwordO3">• Letras mayúsculas (A-Z)</p>
                                    <p class='p04' data-i18n="account:passwordO4">• Numeros (0-9)</p>
                                    <p class='p05' data-i18n="account:passwordO5">• Caracteres especiales (!@#$%^&*)</p>
                                </div>
                            </div>
                        </div>
                        <div class="container c-codeRequest" style='display: none;'>
                            <p style='font-size: 1.3em; text-align: justify;'>
                                Como desea que enviemos el código de verificación?</p>
                            <div style='margin-top: 1rem;'>
                                <input type="radio" id="tel" name="codeSelect" value="telefonoCheck"
                                    style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                                <label for="tel"
                                    style="display: inline-block; vertical-align: middle; padding-right: 20px;">Telefono</label><br>
                                <input type="radio" id="correo" name="codeSelect" value="emailCheck"
                                    style="display: inline-block; vertical-align: middle; margin-right: 5px;">
                                <label for="correo"
                                    style="display: inline-block; vertical-align: middle; padding-right: 20px;">Correo</label><br>
                            </div>
                        </div>
                        <div class=' c-codeVerification' style='display: none;'>
                            <p data-i18n="account:verificationEmail" style='font-size: 1.3em; text-align: justify;'>
                                Hemos enviado el codigo de verificación a su metodo seleccionado.</p>
                            <hr>
                            <div class='form-floating'>
                                <input type='text' class='form-control' id='txtCodeVerification'
                                    placeholder='name@example.com'
                                    style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'
                                    autofocus>
                                <label for='txtCodeVerification' data-i18n="account:labelCodigo">Verificación de
                                    códigos</label>
                            </div>
                            <div class='codeExpired' style='display: none;'>
                                <p style='color: #de3a46; font-weight: bold;' data-i18n="account:codigoCaducado">El
                                    código de validación ha caducado, solicite un nuevo código.</p>
                            </div>
                            <div class='codeError' style='display: none;'>
                                <p data-i18n="account:codigoNoValido" style='color: #de3a46; font-weight: bold;'>El
                                    código de validación no es válido.</p>
                            </div>
                            <p data-i18n="account:nuevoCodigo" class='newCode'
                                style='cursor: pointer; margin-top: 0.5rem; margin-left: 10px; font-size: 1.2em;'>
                                Solicite aquí un nuevo código de validación</p>
                        </div>
                        <button type='button' class='btn'
                            style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;'
                            id='btnContinueSignUp' data-i18n="account:tittleButton">Continuar</button>
                        <button type='button' class='btn'
                            style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;'
                            id='btnContinueSignUp4' data-i18n="account:tittleButton">Continuar</button>
                        <button type='button' class='btn'
                            style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;'
                            id='btnContinueSignUp2' data-i18n="account:tittleButton">Continuar</button>
                        <button type='button' class='btn'
                            style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;'
                            id='btnContinueSignUp3' data-i18n="account:tittleButton">Continuar</button>
                    </div>
                    <div style="display: flex; align-items: center;">
                        <p style="margin-top: 1rem; margin-bottom: 4rem; font-size: 1.2em; margin-right: 0.5rem;"
                            data-i18n="account:yaRegistrado">¿Ya tiene una cuenta?</p>
                        <span class='singup'
                            style='color: #213280; cursor: pointer; font-weight: bold; margin-top: -3rem;'>
                            <a data-i18n="account:iniciarSesion"
                                href='https://dev.kalstein.plus/plataforma/acceder/<?php echo $search != '' ? "?search=$search" : '' ?>'>Iniciar
                                sesión</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>