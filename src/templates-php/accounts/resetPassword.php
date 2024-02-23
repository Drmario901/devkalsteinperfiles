<script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
<div class='container'>
    <input type='hidden' id='emailRecoveryPassword' value='<?php echo $_GET['email']?>'/>
    <div class='row align-items-start'>
        <div class='col'>
            <div class='card' style='min-width: 18rem; max-width: 30rem; margin: 0 auto; margin-top: 10rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75);'>
                <a href='https://plataforma.kalstein.net/' style='margin: 0 auto;'><img src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/logo_kalstein.png' class='card-img-top' style='width: 200px;  margin-top: 4rem; margin-bottom: 2rem;'></a>
                <div class='card-body'>
                    <h5 class='card-title text-center fs-5'>Hola, introduzca su nueva contraseña.</h5>
                    <div class='col-md' style='margin-top: 1rem;'>
                        <div id='c-password' style='margin-top: 1rem;'>
                            <div class='form-floating input-wrapper-p'>
                                <input type='password' class='form-control' id='newPassword' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='newPassword'>Nueva contraseña</label>
                                <i class='fa-sharp fa-solid fa-eye eye-01'></i>
                            </div>
                            <div class='form-floating input-wrapper-p'>
                                <input type='password' class='form-control' id='confirmPassword' placeholder='name@example.com' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem; margin-top: 1rem;' autofocus>
                                <label for='confirmPassword'>Confirmar contraseña</label>
                                <i class='fa-sharp fa-solid fa-eye eye-02'></i>
                            </div>
                            <div class='container required-info'>
                                <p>Su contraseña debe contener:</p>
                                <div class='container subRequired-info'>
                                    <p class='p01'>• Al menos 8 caracteres</p>
                                    <p class='p02'>• Letras minúsculas (a-z)</p>
                                    <p class='p03'>• Letras mayúsculas (A-Z)</p>
                                    <p class='p04'>• Numeros (0-9)</p>
                                    <p class='p05'>• Caracteres especiales (!@#$%^&*)</p>
                                </div>
                            </div>
                            <div id='passwordNotMatch' style='display: none;'>
                                <p style='color: #de3a46; font-weight: bold;'>Las contraseñas no coinciden.</p>
                            </div>
                        </div>
                        <button type='button' class='btn' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnSavedNewPassword'>Guardar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>