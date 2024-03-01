<?php
    if (isset($acc_id)){
        $email = $acc_id;
    }
?>
<div class='container-xl px-4 mt-4'>
    <nav class='nav nav-borders'>
        <a class='nav-link active ms-0' href='#' id='btnProfilePR01' data-i18n="client:perfil">Perfil</a>
        <a class='nav-link' href='#' id='btnIdentityVerifyPR01' data-i18n="client:identificaciones">Identificaciones</a>
        <a class='nav-link' href='#' id='btnSecurityPR01' data-i18n="client:seguridad">Seguridad</a>
    </nav>
    <hr class='mt-0 mb-4'>
    <div id='c-profile'>
        <div class='row'>
            <div class='col-xl-4'>
                <div class='card mb-4 mb-xl-0' style='border-color: #213280;'>
                    <div class='card-header' data-i18n="client:fotoPerfil">
                        Foto de perfil
                    </div>
                    <div class='card-body text-center' style='margin: 0 auto;'>
                        <img class='img-account-profile rounded-circle mb-2'
                            src='<?php echo isset($outerClient) ? $urlImagePerfil : 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/'.$urlImagePerfil?>'
                            alt>
                        <div class='small font-italic text-muted mb-4'>
                            JPG o PNG
                        </div>
                        <button id='btnUploadImagePerfil' class='btn-complete-profile rounded' type='button'
                            style='width: 100%; text-align: center;' data-i18n="client:subirImg">Subir una nueva imágen</button>
                        <input type='file' name='i-uploadImagePerfil' id='i-uploadImagePerfil'
                            accept='image/png,image/jpeg'>
                    </div>
                </div>
            </div>
            <div class='col-xl-8'>
                <div class='card mb-4'>
                    <div class='card-header fw-bold' data-i18n="client:detallesCuenta">
                        Detalles de la cuenta
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputEmailAddress' data-i18n="client:direccionCorreo">Dirreción de correo electrónico</label>
                                <input class='form-control' id='inputEmailAddress' type='email' data-placeholder='client:addEmail'
                                    placeholder='Ingresa tu dirección de correo electrónico' value='<?php echo $email ?>' readonly
                                    style='outline: 1px solid #213280; font-size: 0.9em;'>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputFirstNameProfile' data-i18n="client:primerNombre">Primer nombre</label>
                                    <input class='form-control' id='inputFirstName' type='text'
                                        placeholder='Ingresa tu primer nombre'
                                        data-placeholder='client:primerNombre'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputLastNameProfile' data-i18n="client:segundoNombre">Segundo nombre</label>
                                    <input class='form-control' id='inputLastName' type='text'
                                        placeholder='Ingresa tu segundo nombre' data-placeholder='client:segundoNombre'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='countryUserProfile' >País</label>
                                    <select class='form-select' aria-label='Ejemplo de select por defecto'
                                        style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'
                                        id='countryUserProfile'>
                    
                                    </select>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputLocationProfile' data-i18n="client:estado">Estado</label>
                                    <input class='form-control' id='inputLocationProfile' type='text'
                                        placeholder='Ingresa tu Estado'
                                        data-placeholder='client:estado'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputAddressProfile' data-i18n="client:direccionS">Dirección</label>
                                    <input class='form-control' id='inputAddressProfile' type='text'
                                        placeholder='Ingresa tu dirección'
                                        data-placeholder='client:direccionS'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputZipcodeProfile' data-i18n="client:codigoZip">Código ZIP</label>
                                    <input class='form-control' id='inputZipcodeProfile' type='text'
                                        placeholder='Ingresa tu código ZIP'
                                        data-placeholder='client:zipPlaceHolder'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputPhone' data-i18n="client:numeroTlf">Número de teléfono</label>
                                    <input class='form-control' id='inputPhone' type='tel'
                                        data-placeholder='client:numeroTlf'
                                        placeholder='Ingresa tu número de teléfono'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputBirthday' data-i18n="client:cumple" >Cumpleaños</label>
                                    <input class='form-control' id='inputBirthday' type='date' name='birthday'
                                        placeholder='Ingresa tu cumpleaños'
                                        data-placeholder='client:cumple'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                        </form>
                    </div>
                    <hr class='mt-0 mb-4'>
                    <div class='card-header fw-bold' data-i18n="client:detallesOrganizacion">
                        Detalles de la Organización
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputOrgName' data-i18n="client:nombreOrganizacion">Nombre de la Organización
                                    </label>
                                    <input class='form-control' id='inputOrgName' type='text'
                                        data-placeholder='client:organizationNamePlaceholder'
                                        placeholder='Ingresa el nombre de tu organización'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='jobRoleOrg' data-i18n="client:rolEmpleo">Rol de empleo</label>
                                    <select class='form-select' aria-label='Default select example'
                                        style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'
                                        id='jobRoleOrg'>
                                        <option value='0' selected data-i18n="client:elegirOpcion" >Elige una opción</option>
                                        <option value='1' data-i18n="client:ingeniero">Ingeniero</option>
                                        <option value='2' data-i18n="client:gestionIng">Gestión de Ingeniería</option>
                                        <option value='3' data-i18n="client:diseñador">Diseñador</option>
                                        <option value='4' data-i18n="client:comprasFinanzas">Compras / Comprador / Finanzas</option>
                                        <option value='5' data-i18n="client:gestionProyecto">Programa / Gestión de proyecto</option>
                                        <option value='6' data-i18n="client:gestionMro">Operaciones / Gestión MRO</option>
                                        <option value='7' data-i18n="client:liderazgoCxo">Liderazgo ejecutivo (CXO, VP, fundador, etc.)</option>
                                        <option value='8' data-i18n="client:ventasMarketing">Ventas y Marketing</option>
                                        <option value='9' data-i18n="client:otros">Otros</option>
                                    </select>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputCountryOrg' data-i18n="client:pais">País</label>
                                    <select class='form-select' aria-label='Default select example'
                                        style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'
                                        id='inputCountryOrg'>
                    
                                    </select>
                                </div>                                                
                                <div class=' col-md-6'>
                                    <label class='small mb-1' for='inputStateOrg' data-i18n="client:estado">Estado</label>
                                    <input class='form-control' id='inputStateOrg' type='text'
                                        placeholder='Ingresa el Estado de tu organización'
                                        data-placeholder='client:estado'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputAddressOrg' data-i18n="client:direccion">Dirección</label>
                                    <input class='form-control' id='inputAddressOrg' type='text'
                                        placeholder='Ingresa la dirección de tu Organización'
                                        data-placeholder='client:direccion'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputZipcodeOrg' data-i18n="client:codigoZip">Codigo ZIP</label>
                                    <input class='form-control' id='inputZipcodeOrg' type='text'
                                        placeholder='Ingresa el código ZIP de tu organización'
                                        data-placeholder='client:codigoZip'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <div class='row gx-3 mb-3'>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputPhoneOrg' data-i18n="client:numeroTlf">Número de teléfono</label>
                                    <input class='form-control' id='inputPhoneOrg' type='tel'
                                        placeholder='Ingresa el número de teléfono de tu Organización'
                                        data-placeholder='client:numeroTlf'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                                <div class='col-md-6'>
                                    <label class='small mb-1' for='inputUrlWebSiteOrg' data-i18n="client:sitioUrl">URL de sitio web</label>
                                    <input class='form-control' id='inputUrlWebSiteOrg' type='text'
                                        placeholder='Ingresa el sitio Web de tu Organización'
                                        data-placeholder='client:sitioUrl'
                                        style='outline: 1px solid #213280; font-size: 0.9em;'>
                                </div>
                            </div>
                            <button class='btn-complete-profile rounded' type='button' id='savedUpdateInfo'
                                style='width: 100%; text-align: center;' data-i18n="client:guardarCambios">Guardar cambios</button>
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
                    <div class='card-header' data-i18n="client:cambiarContr">Cambiar contraseña</div>
                    <div class='card-body'>
                        <form>
                            <!-- Form Group (current password)-->
                            <div class='mb-3'>
                                <label class='small mb-1' for='currentPassword' data-i18n="client:contraActual">Contraseña actual</label>
                                <input class='form-control' id='currentPassword' type='password'
                                    placeholder='Ingresa la contraseña actual'
                                    data-placeholder='client:contraActual'
                                    style='outline: 1px solid #213280; font-size: 0.9em;' autocomplete='on'>
                            </div>
                            <!-- Form Group (new password)-->
                            <div class='mb-3'>
                                <label class='small mb-1' for='newPassword' data-i18n="client:nuevaContra">Nueva contraseña</label>
                                <input class='form-control' id='newPassword' type='password'
                                    placeholder='Ingresa una nueva contraseña'
                                    data-placeholder='client:nuevaContra'
                                    style='outline: 1px solid #213280; font-size: 0.9em;' autocomplete='on'>
                            </div>
                            <!-- Form Group (confirm password)-->
                            <div class='mb-3'>
                                <label class='small mb-1' for='confirmPassword' data-i18n="client:confirmarContra">Confirmar contraseña</label>
                                <input class='form-control' id='confirmPassword' type='password'
                                    placeholder='Confirmar nueva contraseña'
                                    data-placeholder='client:confirmarContra'
                                    style='outline: 1px solid #213280; font-size: 0.9em;' autocomplete='on'>
                            </div>
                            <button class='btn-complete-profile rounded' type='button' id='btnSavedNewPassword'
                                style='width: 100%; text-align: center;' data-i18n="client:guardar">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class='col-lg-4'>
                <!-- Delete account card-->
                <div class='card mb-4' style='border-color: #213280;'>
                    <div class='card-header' data-i18n="client:borrarCuenta">Borrar cuenta</div>
                    <div class='card-body'>
                        <p data-i18n="client:borrarCuentaPar">Eliminar su cuenta es una acción permanente y no se puede deshacer. Si estás seguro de que
                             Si desea eliminar su cuenta, seleccione el botón a continuación.</p>
                        <button class='btn btn-danger-soft text-danger' type='button' id='btnDeleteAccount' data-i18n="client:siBorrar">Entiendo, borrar cuenta</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='c-identities' style='display: none;'>
        <div class='row'>
            <div class='col-xl-6'>
                <div class='card mb-4 mb-xl-0' style='border-color: #213280;'>
                    <div class='card-header' data-i18n="client:tarjetaIden">
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
                                        <img class='drop-image' src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png' alt='jpg/png'>
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
                                    src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$imageDocument'
                                    alt>
                                <div class='small font-italic text-muted mb-4'>
                                    $iDocument
                                </div>
                                <div style='margin: 0 auto; width: 5rem; height: 3rem;'>
                                    <img class='img-account-profil mb-2'
                                        src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/verify.png'
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
                    <div class='card-header' data-i18n="client:documentoFiscal">
                        Documento fiscal
                    </div>
                    <div class='card-body text-center' style='margin: 0 auto;'>
                    <?php
                        $html = "";
                        if ($companyRif == '' && $company_image_rif == ''){
                            $html.="
                                <div class='custom-file mt-3 mb-3'>
                                    <label for='catalogPDF' class='drop-container' id='dropcontainerImage'>
                                        <span class='drop-title' data-i18n='client:selectDrop' >Select or drag and drop an image</span>
                                        <img class='drop-image' src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png' alt='jpg/png'>
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
                                <button class='btn' style='color: #fff; background-color: #213280; margin: 0 auto;' id='savedInfoTaxCompany'  data-i18n='client:guardar' >Saved</button>
                            ";
                        }else{
                            $html.= "
                                <img class='img-account-profil mb-2'
                                    src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/$company_image_rif'
                                    alt>
                                <div class='small font-italic text-muted mb-4'>
                                    $companyRif
                                </div>
                                <div style='margin: 0 auto; width: 5rem; height: 3rem;'>
                                    <img class='img-account-profil mb-2'
                                        src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/images-verify/verify.png'
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