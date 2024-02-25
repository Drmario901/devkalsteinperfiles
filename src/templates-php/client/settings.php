<?php
    if (isset($acc_id)){
        $email = $acc_id;
    }
?>
<div class='container-xl px-4 mt-4'>
    <nav class='nav nav-borders'>
        <a class='nav-link active ms-0' href='#' id='btnProfilePR01'>Perfil</a>
        <a class='nav-link' href='#' id='btnIdentityVerifyPR01'>Identificaciones</a>
        <a class='nav-link' href='#' id='btnSecurityPR01'>Seguridad</a>
    </nav>
    <hr class='mt-0 mb-4'>
    <div id='c-profile'>
        <div class='row'>
            <div class='col-xl-4'>
                <div class='card mb-4 mb-xl-0' style='border-color: #213280;'>
                    <div class='card-header'>
                        Foto de perfil
                    </div>
                    <div class='card-body text-center' style='margin: 0 auto;'>
                        <img class='img-account-profile rounded-circle mb-2'
                            src='<?php echo isset($outerClient) ? $urlImagePerfil : 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/'.$urlImagePerfil?>'
                            alt>
                        <div class='small font-italic text-muted mb-4'>
                            JPG o PNG
                        </div>
                        <button id='btnUploadImagePerfil' class='btn-complete-profile rounded' type='button'
                            style='width: 100%; text-align: center;'>Subir una nueva imágen</button>
                        <input type='file' name='i-uploadImagePerfil' id='i-uploadImagePerfil'
                            accept='image/png,image/jpeg'>
                    </div>
                </div>
            </div>
            <div class='col-xl-8'>
                <div class='card mb-4'>
                    <div class='card-header fw-bold'>
                        Detalles de la cuenta
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputEmailAddress'>Dirreción de correo electrónico</label>
                                <input class='form-control' id='inputEmailAddress' type='email'
                                    placeholder='Ingresa tu dirección de correo electrónico' value='<?php echo $email ?>' readonly
                                    style='outline: 1px solid #213280; font-size: 0.9em;'>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputFirstNameProfile'>Primer nombre</label>
                                    <input class='form-control' id='inputFirstName' type='text'
                                        placeholder='Ingresa tu primer nombre'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputLastNameProfile'>Segundo nombre</label>
                                    <input class='form-control' id='inputLastName' type='text'
                                        placeholder='Ingresa tu segundo nombre'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='countryUserProfile'>País</label>
                                    <select class='form-select' aria-label='Ejemplo de select por defecto'
                                        style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'
                                        id='countryUserProfile'>
                    
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputLocationProfile'>Estado</label>
                                    <input class='form-control' id='inputLocationProfile' type='text'
                                        placeholder='Ingresa tu Estado'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputAddressProfile'>Dirección</label>
                                    <input class='form-control' id='inputAddressProfile' type='text'
                                        placeholder='Ingresa tu dirección'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputZipcodeProfile'>Código ZIP</label>
                                    <input class='form-control' id='inputZipcodeProfile' type='text'
                                        placeholder='Ingresa tu código ZIP'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputPhone'>Número de teléfono</label>
                                    <input class='form-control' id='inputPhone' type='tel'
                                        placeholder='Ingresa tu número de teléfono'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputBirthday'>Cumpleaños</label>
                                    <input class='form-control' id='inputBirthday' type='date' name='birthday'
                                        placeholder='Ingresa tu cumpleaños'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class='mt-0 mb-4'>
                    <div class='card-header fw-bold'>
                        Detalles de la Organización
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputOrgName'>Nommbre de la Organización
                                    </label>
                                    <input class='form-control' id='inputOrgName' type='text'
                                        placeholder='Ingresa el nombre de tu organización'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='jobRoleOrg'>Rol de empleo</label>
                                    <select class='form-select' aria-label='Default select example'
                                        style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'
                                        id='jobRoleOrg'>
                                        <option value='0' selected>Elige una opción</option>
                                        <option value='1'>Ingeniero</option>
                                        <option value='2'>Gestión de Ingeniería</option>
                                        <option value='3'>Diseñador</option>
                                        <option value='4'>Compras / Comprador / Finanzas</option>
                                        <option value='5'>Programa / Gestión de proyecto</option>
                                        <option value='6'>Operaciones / Gestión MRO</option>
                                        <option value='7'>Liderazgo ejecutivo (CXO, VP, fundador, etc.)</option>
                                        <option value='8'>Ventas y Marketing</option>
                                        <option value='9'>Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputCountryOrg'>País</label>
                                    <select class='form-select' aria-label='Default select example'
                                        style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'
                                        id='inputCountryOrg'>
                    
                                    </select>
                                </div>                                                
                                <div class=' col-md-6'>
                                    <label class='small mb-1' for='inputStateOrg'>Estado</label>
                                    <input class='form-control' id='inputStateOrg' type='text'
                                        placeholder='Ingresa el Estado de tu organización'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputAddressOrg'>Dirección</label>
                                    <input class='form-control' id='inputAddressOrg' type='text'
                                        placeholder='Ingresa la dirección de tu Organización'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputZipcodeOrg'>Codigo ZIP</label>
                                    <input class='form-control' id='inputZipcodeOrg' type='text'
                                        placeholder='Ingresa el código ZIP de tu organización'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputPhoneOrg'>Número de teléfono</label>
                                    <input class='form-control' id='inputPhoneOrg' type='tel'
                                        placeholder='Ingresa el número de teléfono de tu Organización'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputUrlWebSiteOrg'>URL de sitio web</label>
                                    <input class='form-control' id='inputUrlWebSiteOrg' type='text'
                                        placeholder='Ingresa el sitio Web de tu Organización'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <button class='btn-complete-profile rounded' type='button' id='savedUpdateInfo'
                                style='width: 100%; text-align: center;'>Guardar cambios</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='c-security' style='display: none;'>
        <div class='row'>
            <div class='col-lg-8'>
                <!-- Change password card-->
                <div class='card mb-4' style='border-color: #213280;'>
                    <div class='card-header'>Cambiar contraseña</div>
                    <div class='card-body'>
                        <form>
                            <!-- Form Group (current password)-->
                            <div class='mb-3'>
                                <label class='small mb-1' for='currentPassword'>Contraseña actual</label>
                                <input class='form-control' id='currentPassword' type='password'
                                    placeholder='Ingresa la contraseña actual'
                                    style='outline: 1px solid #213280; font-size: 0.9em;' autocomplete='on'>
                            </div>
                            <!-- Form Group (new password)-->
                            <div class='mb-3'>
                                <label class='small mb-1' for='newPassword'>Nueva contreseña</label>
                                <input class='form-control' id='newPassword' type='password'
                                    placeholder='Ingresa una nueva contraseña'
                                    style='outline: 1px solid #213280; font-size: 0.9em;' autocomplete='on'>
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class='mb-3'>
                                <label class='small mb-1' for='confirmPassword'>Confirmar contraseña</label>
                                <input class='form-control' id='confirmPassword' type='password'
                                    placeholder='Confirmar nueva contraseña'
                                    style='outline: 1px solid #213280; font-size: 0.9em;' autocomplete='on'>
                            </div>
                            <button class='btn-complete-profile rounded' type='button' id='btnSavedNewPassword'
                                style='width: 100%; text-align: center;'>Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class='col-lg-4'>
                <!-- Delete account card-->
                <div class='card mb-4' style='border-color: #213280;'>
                    <div class='card-header'>Borrar cuenta</div>
                    <div class='card-body'>
                        <p>Eliminar su cuenta es una acción permanente y no se puede deshacer. Si estás seguro de que
                             Si desea eliminar su cuenta, seleccione el botón a continuación.</p>
                        <button class='btn btn-danger-soft text-danger' type='button' id='btnDeleteAccount'>Entiendo, borrar cuenta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='c-identities' style='display: none;'>
        <div class='row'>
            <div class='col-xl-6'>
                <div class='card mb-4 mb-xl-0' style='border-color: #213280;'>
                    <div class='card-header'>
                       Tarjeta de identificación
                    </div>
                    <div class='card-body text-center' style='margin: 0 auto;'>
                    <?php
                        $html = "";
                        if ($iDocument == '' && $imageDocument == ''){
                            $html.="
                                <div class='custom-file mt-3 mb-3'>
                                    <label for='catalogPDF' class='drop-container' id='dropcontainerImage'>
                                        <span class='drop-title'>Select or drag and drop an image</span>
                                        <img class='drop-image' src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png' alt='jpg/png'>
                                        <img id='thumbnail'/>
                                    </label>
                                    <input type='file' id='i-uploadImageIDCard' class='filedrop-input'>
                                </div>
                                <div class='row gx-3 mb-3'>
                                    <div class='col'>
                                        <input class='form-control' id='inputIDCard' type='text'
                                            placeholder='Enter your Identity Card'
                                            style='outline: 1px solid #213280; font-size: 0.9em;'>
                                    </div>
                                </div>
                                <button class='btn' style='color: #fff; background-color: #213280; margin: 0 auto;' id='savedInfoIDCard'>Saved</button>
                            ";
                        }else{
                            $html.= "
                                <img class='img-account-profil mb-2' style='max-height: 16rem;'
                                    src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$imageDocument'
                                    alt>
                                <div class='small font-italic text-muted mb-4'>
                                    $iDocument
                                </div>
                                <div style='margin: 0 auto; width: 5rem; height: 3rem;'>
                                    <img class='img-account-profil mb-2'
                                        src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/verify.png'
                                        alt>
                                </div>
                            ";
                        }
                    ?>
                    <?php echo $html ?>
                    </div>
                </div>
            </div>
            <div class='col-xl-6'>
                <div class='card mb-4 mb-xl-0' style='border-color: #213280;'>
                    <div class='card-header'>
                        Documento fiscal
                    </div>
                    <div class='card-body text-center' style='margin: 0 auto;'>
                    <?php
                        $html = "";
                        if ($companyRif == '' && $company_image_rif == ''){
                            $html.="
                                <div class='custom-file mt-3 mb-3'>
                                    <label for='catalogPDF' class='drop-container' id='dropcontainerImage'>
                                        <span class='drop-title'>Select or drag and drop an image</span>
                                        <img class='drop-image' src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png' alt='jpg/png'>
                                        <img id='thumbnail'/>
                                    </label>
                                    <input type='file' id='i-uploadImageTaxDocument' class='filedrop-input'>
                                </div>
                                <div class='row gx-3 mb-3'>
                                    <div class='col'>
                                        <input class='form-control' id='i-rifCompany' type='text'
                                            placeholder='Enter your Tax Document'
                                            style='outline: 1px solid #213280; font-size: 0.9em;'>
                                    </div>
                                </div>
                                <button class='btn' style='color: #fff; background-color: #213280; margin: 0 auto;' id='savedInfoTaxCompany'>Saved</button>
                            ";
                        }else{
                            $html.= "
                                <img class='img-account-profil mb-2'
                                    src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$company_image_rif'
                                    alt>
                                <div class='small font-italic text-muted mb-4'>
                                    $companyRif
                                </div>
                                <div style='margin: 0 auto; width: 5rem; height: 3rem;'>
                                    <img class='img-account-profil mb-2'
                                        src='https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/verify.png'
                                        alt>
                                </div>
                            ";
                        }
                    ?>
                    <?php echo $html ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php 
 $test = isset($_SESSION['user_tag']) ? $_SESSION['user_tag'] : ''; 
?>


<script>
    var user_tag = '<?php echo $test?>';
    console.log('User tag encontrado' + ' ' + user_tag);
</script>