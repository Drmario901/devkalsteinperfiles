<?php
    session_start();

    if (isset($_GET['search'])){        
        $search = $_GET? $_GET['search'] : '';
    }
    else {
        if(isset($_SESSION['model-to-open-in-platform'])) {
            $search = $_SESSION['model-to-open-in-platform'] != '' ? $_SESSION['model-to-open-in-platform'] : $search;
        }
    }

    if (isset($_SESSION['consulta1'])){        
        $scientistPass = $_SESSION? $_SESSION['consulta1'] : '';
    }

    session_write_close();
    
    $search = $_GET? $_GET['search'] : '';
    $scientistPass = $_SESSION['consulta1'] ? $_SESSION['consulta1'] : '';

?>
<input type="hidden" id="search-product" value="<?php echo $search ?>">
<script>
    var php = '<?php echo $scientistPass?>'
    console.log(php); 
</script>
<script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
<div class='d-flex align-items-center' style='min-height: 100vh'>
    <div class='container' style='margin-top: -35px'>
        <div class='card w-75 mb-3' style='margin: 0 auto; margin-top: 2rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); padding: 1rem;'>
            <div class='card-body'>
                <h5 class='card-title' style='text-align: center; font-size: 2em; font-weight: bold;' data-i18n="account:registerTitle" >Asistente</h5>
                <p class='card-text' style='text-align: justify; font-size: 1.2em;' data-i18n="account:registerMsg">Gracias por formar parte de nuestra plataforma Kalstein Francia, ahora ayúdenos a personalizar su perfil según sus necesidades.</p>
                <div class='c-01'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 1%; background-color: #213280;'></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='nameUser' data-placeholder="account:placeholderName" placeholder='Juan' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32) || event.charCode == 39">
                                <label for='nameUser' data-i18n="account:registerNombreLabel" >Nombre</label>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='lastnameUser' data-placeholder="account:apellidoPlace" placeholder='Peréz' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32) || event.charCode == 39">
                                <label for='lastnameUser' data-i18n="account:registerApellidoLabel">Apellido</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-3'></div>
                        <div class='col-sm-6'>
                            <p class='card-text' data-i18n="account:registerUsoLabel" style='text-align: center; font-size: 1.5em; font-weight: bold;'>¿Cómo utilizará nuestra plataforma?</p>
                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='cmbPrimary'>
                                <option value='0' selected data-i18n="account:selectDefault">Elija una opción</option>
                                <option value='1' selected data-i18n="account:opcion1">Cotizar, comprar o consumir recursos proporcionados por la plataforma</option>
                                <option value='2' selected data-i18n="account:opcion2">Anunciar y vender sus productos</option>
                                 <option value='6' selected data-i18n="account:opcion3">Impartir conocimientos en el ámbito científico, dar cursos, etc.</option>
                                <option value='4'>Prestación de servicios técnicos</option>
                            </select>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div></div>
                        <div><button data-i18n="account:botonSiguiente" type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNext1'>Siguiente</button></div>
                    </div>
                </div>
    
                <!-- XXX RUTA DE CLIENTE XXX -->
    
                <div class='c-client01' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 100%; background-color: #213280;'></div>
                    </div>
                    <div class='row' style='display: none;'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper' style='margin-top: 6rem;'>
                                <input type='text' class='form-control' id='identityPassport' data-placeholder="account:direccionPlace" placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='identityPassport' data-i18n="account:document">Documento de identidad/pasaporte (opcional)</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title" data-i18n="account:fotoDocumento">Cargar foto del documento (Opcional)</span>
                                    or
                                    <input type="file" id="imageDocument" accept="image/png, image/jpeg" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryUser'>
    
                                </select>
                                <label for='countryUser' data-i18n="account:labelPais" >País</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <i class='paisesPrefijos' id='paisesPrefijos'></i>                                              
                                <input type='number' class='form-control' id='phoneUser' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;" data-i18n="account:labelNumero">Teléfono</label>                                           
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem; display: none;'>    
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressUser' data-placeholder="account:direccionPlace" placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressUser' data-i18n="account:labelDireccion" >Dirección</label>                               
                            </div>
                        </div>            
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='number' class='form-control' id='zipcodeUser' data-placeholder="account:direccionPlace" placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeUser' data-i18n="account:labelPostal" >Código postal</label>                            
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem; display: none;'>  
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <i class='paisesPrefijos' id='paisesPrefijos'></i>                                              
                                <input type='number' class='form-control' id='phoneUser' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;" data-i18n="account:labelNumero">Télefono</label>                                           
                            </div>
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
    
                        </div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient1' data-i18n="account:botonAnterior">Anterior</button></div>
                        <div>
                            <!-- <button type='button' class='btn px-4 btnEndingClient' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingClient' data-i18n="account:botonFinalizar">Finalizar</button> -->
                            <button type='button' class='btn px-4 btnEndingClient' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingClient'>finalizarrr</button>
                            <div class="spinner center" >
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                                <div class="spinner-blade"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='c-client02' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 75%; background-color: #213280;'></div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-3'></div>
                        <div class='col-sm-6'>
                            <p class='card-text' style='text-align: center; font-size: 1.5em; font-weight: bold;' data-i18n="account:EmpresaPregunta" >¿Es propietario o pertenece a una empresa?</p>
                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='question-business'>
                                <option value='0' selected data-i18n="selectDefault" >Elija una opción</option>
                                <option value='1' data-i18n="SelectSi" >Si</option>
                                <option value='2' data-i18n="SelectNo">No</option>
                            </select>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                    <div class='row' style='margin-top: 1rem; display: none;' id='c-optionsQuestionBusiness'>
                        <div class='col-sm-3'></div>
                        <div class='col-sm-6'>
                            <div class='form-floating'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='jobRole'>
                                    <option value='0' selected data-i18n="account:selectDefault" >Elija una opción</option>
                                    <option value='1' data-i18n="account:selectIngeniero" >Ingeniero</option>
                                    <option value='2' data-i18n="account:selectDireccion">Dirección de Ingeniería</option>
                                    <option value='3' data-i18n="account:selectDesign">Diseñador</option>
                                    <option value='4' data-i18n="account:selectCompras">Compras / Comprador / Finanzas</option>
                                    <option value='5' data-i18n="account:selectGestion">Gestión de programas y proyectos</option>
                                    <option value='6' data-i18n="account:selectOperaciones">Operaciones / Gestión de MRO</option>
                                    <option value='7' data-i18n="account:selectLiderazgo">Liderazgo ejecutivo (CXO, VP, fundador, etc.)</option>
                                    <option value='8' data-i18n="account:selectVentas">Ventas y marketing</option>
                                    <option value='9' data-i18n="account:selectOtros">Otros</option>
                                </select>
                                <label for='jobRole' data-i18n="account:selectFuncion" >Función</label>                               
                            </div>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div class='col-sm-2'><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient2' data-i18n="account:botonAnterior" >Anterior</button></div>
                        <div class='col-sm-2'>
                            <button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextClient2' data-i18n="account:botonSiguiente">Siguiente</button>
                            <button type='button' class='btn px-4 btnEndingClient' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnEndingClient' data-i18n="account:botonFinalizar" >Finalizar</button>
                        </div>
                    </div>
                </div>
                <div class='c-client03' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 100%; background-color: #213280;'></div>
                    </div>
                    <div class="row" style='display: none;'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper' style='margin-top: 6rem;'>
                                <input type='text' class='form-control' id='taxDocument'  placeholder='' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='taxDocument' data-i18n="account:documentFiscal" >Documento fiscal (opcional)</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title" data-i18n="account:fotoDocumento" >Cargar foto del documento (Opcional)</span>
                                    or
                                    <input type="file" id="imageTaxDocument" accept="image/png, image/jpeg" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='BusinessName' placeholder='' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='BusinessName' data-i18n="account:labelRazon" >Razón social</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryBusiness'>
    
                                </select>
                                <label for='countryBusiness' data-i18n="account:labelPais" >País</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateBusiness' placeholder='' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateBusiness' data-i18n="account:labelEstado" >Estado</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressBusiness' placeholder='' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressBusiness' data-i18n="account:labelDireccionFiscal" >Dirección fiscal</label>                               
                            </div>                                        
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <input type='number' class='form-control' id='zipcodeBusiness' placeholder='' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeBusiness' data-i18n="account:labelPostal" >Código postal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>  
                                <i class='paisesPrefijos' id='paisesPrefijos2'></i>                                              
                                <input type='number' class='form-control' id='phoneBusiness' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;" data-i18n="account:labelNumero" >Teléfono</label>                                           
                            </div>
                        </div>                                    
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                                           
                                <input type='text' class='form-control' id='websiteBusiness' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='websiteBusiness' data-i18n="account:labelWeb" >Sitio web empresarial</label>                                        
                            </div>    
                        </div>
                        <div class='col-sm-6'>
    
                        </div>                                   
                    </div>                                
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient3' data-i18n="account:botonAnterior" >Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingClient' data-i18n="account:botonFinalizar">Finalizar</button></div>
                    </div>
                </div>
                
                <!-- XXX RUTA DE FABRICANTE Y DISTRIBUIDOR XXX -->
    
                <div class='c-manu01' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 50%; background-color: #213280;'></div>
                    </div>
                    <h5>Sus datos</h5>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper' style='margin-top: 6rem;'>
                                <input type='text' class='form-control' id='identityPassportManu' placeholder='' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='identityPassportManu' data-i18n="account:labelDocumentoObligatorio" >Documento de identidad/Pasaporte</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title" data-i18n="account:fotoDocumentoObligatorio" >Cargar foto del documento</span>
                                    or
                                    <input type="file" id="imageDocumentManu" accept="image/png, image/jpeg" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryUserManu'>
    
                                </select>
                                <label for='countryUser' data-i18n="account:labelPais" >País</label>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateUserManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateUser' data-i18n="account:labelEstado">Estado</label>
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressUserManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressUser' data-i18n="account:labelDireccion">Dirección</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='number' class='form-control' id='zipcodeUserManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeUser' data-i18n="account:labelPostal">Código postal</label>                            
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>     
                                <i class='paisesPrefijos' id='paisesPrefijos3'></i>                                                  
                                <input type='number' class='form-control' id='phoneUserManu' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;" data-i18n="account:labelNumero">Teléfono</label>                                           
                            </div>
                        </div>
                        <div class='col-sm-6'>
    
                        </div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnAnteriorManu1' data-i18n="account:botonAnterior">Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextManu1' data-i18n="account:botonFinalizar">Siguiente</button></div>
                    </div>
                </div>
                <div class='c-manu02' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 75%; background-color: #213280;'></div>
                    </div>
                    <p class='card-text' style='text-align: center; font-size: 1.5em; font-weight: bold;' data-i18n="account:pCategoria" >¿Qué categoría se adapta mejor a tu negocio?</p>
                    <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='profileRole'>
                        <option value='0' selected data-i18n="account:selectDefault">Elija una opción</option>
                        <option value='3' data-i18n="account:selectFabricante">Fabricante</option>
                        <option value='2' data-i18n="account:selectDistribuidor">Distribuidor</option>
                        <option value='4' data-i18n="account:selectSoporte">Soporte técnico</option>
                        <!--option value='5' data-i18n="account:selectServiciosUsados" >Servicios de alquiler y equipos usados</option-->
                        <option value='6' data-i18n="account:selectCientifico">Científico</option>
                    </select>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusManu2' data-i18n="account:botonAnterior" >Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextManu2' data-i18n="account:botonSiguiente">Siguiente</button></div>
                    </div>
                </div>
                <div class='c-manu03' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 100%; background-color: #213280;'></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper' style='margin-top: 6rem;'>
                                <input type='text' class='form-control' id='taxDocumentManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='taxDocumentManu' data-i18n="account:documentFiscalObligatorio" >Documento fiscal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title" data-i18n="account:fotoDocumentoObligatorio">Cargar foto del documento</span>
                                    or
                                    <input type="file" id="imageTaxDocumentManu" accept="image/png, image/jpeg" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='BusinessNameManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='BusinessName' data-i18n="account:labelRazon">Razón social</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryBusinessManu'>
    
                                </select>
                                <label for='countryBusinessManu' data-i18n="account:labelPais">País</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateBusinessManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateBusiness' data-i18n="account:labelEstado">Estado</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressBusinessManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressBusiness' data-i18n="account:labelDireccion">Dirección</label>                               
                            </div>                                        
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <input type='number' class='form-control' id='zipcodeBusinessManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;'>
                                <label for='zipcodeBusiness' data-i18n="account:labelPostal">Código postal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>          
                                <i class='paisesPrefijos' id='paisesPrefijos4'></i>                                        
                                <input type='number' class='form-control' id='phoneBusinessManu' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneBusiness' style="margin-left: 2.5rem;" data-i18n="account:labelNumero">Teléfono</label>                                        
                            </div>    
                        </div>                                    
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                                           
                                <input type='text' class='form-control' id='websiteBusinessManu' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='websiteBusiness' data-i18n="account:labelWeb">Sitio web empresarial</label>                                        
                            </div>    
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='jobRoleManu'>
                                    <option value='0' selected data-i18n="account:selectDefault" >Elija una opción</option>
                                    <option value='1' data-i18n="account:selectIngeniero" >Ingeniero</option>
                                    <option value='2' data-i18n="account:selectDireccion">Dirección de Ingeniería</option>
                                    <option value='3' data-i18n="account:selectDesign">Diseñador</option>
                                    <option value='4' data-i18n="account:selectCompras">Compras / Comprador / Finanzas</option>
                                    <option value='5' data-i18n="account:selectGestion">Gestión de programas y proyectos</option>
                                    <option value='6' data-i18n="account:selectOperaciones">Operaciones / Gestión de MRO</option>
                                    <option value='7' data-i18n="account:selectLiderazgo">Liderazgo ejecutivo (CXO, VP, fundador, etc.)</option>
                                    <option value='8' data-i18n="account:selectVentas">Ventas y marketing</option>
                                    <option value='9' data-i18n="account:selectOtros">Otros</option>
                                </select>
                                <label for='jobRoleManu' data-i18n="account:selectFuncion" >Función</label>  
                            </div>
                        </div>                                   
                    </div>                                
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusManu3' data-i18n="account:botonAnterior" >Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingManu' data-i18n="account:botonFinalizar">Finalizar</button></div>
                    </div>
                    
                    </div>
                 <!-- XXX RUTA SOPORTE XXX -->
    
                <div class='c-soporte01' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 50%; background-color: #213280;'></div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper' style='margin-top: 6rem;'>
                                <input type='text' class='form-control' id='identityPassport-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='identityPassport-soporte' data-i18n="account:labelDocumentoObligatorio">Documento de identidad/Pasaporte</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title" data-i18n="account:fotoDocumentoObligatorio">Cargar foto del documento</span>
                                    or
                                    <input type="file" id="imageDocument-soporte" accept="image/png, image/jpeg" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryUser-soporte'>
    
                                </select>
                                <label for='countryUser-soporte' data-i18n="account:labelPais" >País</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateUser-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateUser-soporte' data-i18n="account:labelEstado" >Estado</label>                                
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressUser-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressUser-soporte' data-i18n="account:labelDireccion" >Dirección</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='number' class='form-control' id='zipcodeUser-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeUser-soporte' data-i18n="account:labelPostal" >Código postal</label>                            
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                    
                                <i class='paisesPrefijos' id='paisesPrefijos5'></i>                               
                                <input type='number' class='form-control' id='phoneUser-soporte' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser-soporte' style="margin-left: 2.5rem;" data-i18n="account:labelNumero" >Teléfono</label>                                              
                            </div>
                        </div>
                        <div class='col-sm-6'>
    
                        </div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPrevius-soporte1' data-i18n="account:botonAnterior" >Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNext-soporte1' data-i18n="account:botonSiguiente">Siguiente</button></div>
                    </div>
                </div>
                <div class='c-soporte02' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 100%; background-color: #213280;'></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper' style='margin-top: 6rem;'>
                                <input type='text' class='form-control' id='taxDocument-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='taxDocument-soporte' data-i18n="account:documentoFiscalObligatorio">Documento fiscal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="imageTaxDocument-soporte" class="drop-container" id="dropcontainer">
                                    <span class="drop-title" data-i18n="account:fotoDocumentoObligatorio" >Cargar foto del documento</span>
                                    or
                                    <input type="file" id="imageTaxDocument-soporte" accept="image/png, image/jpeg" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='BusinessName-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='BusinessName-soporte' data-i18n="account:labelRazon" >Razón social</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='jobRole-soporte'>
                                <option value='0' selected data-i18n="account:selectDefault" >Elija una opción</option>
                                    <option value='1' data-i18n="account:selectIngeniero" >Ingeniero</option>
                                    <option value='2' data-i18n="account:selectDireccion">Dirección de Ingeniería</option>
                                    <option value='3' data-i18n="account:selectDesign">Diseñador</option>
                                    <option value='4' data-i18n="account:selectCompras">Compras / Comprador / Finanzas</option>
                                    <option value='5' data-i18n="account:selectGestion">Gestión de programas y proyectos</option>
                                    <option value='6' data-i18n="account:selectOperaciones">Operaciones / Gestión de MRO</option>
                                    <option value='7' data-i18n="account:selectLiderazgo">Liderazgo ejecutivo (CXO, VP, fundador, etc.)</option>
                                    <option value='8' data-i18n="account:selectVentas">Ventas y marketing</option>
                                    <option value='9' data-i18n="account:selectOtros">Otros</option>
                                </select>
                                <label for='jobRole-soporte' data-i18n="account:selectFuncion" >Función</label>  
                            </div>
                        </div> 
                    </div>
                    <div class='row' style='margin-top: 2rem;'>  
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryBusiness-soporte'>
    
                                </select>
                                <label for='countryBusiness-soporte' data-i18n="account:labelPais" >País</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateBusiness-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateBusiness-soporte' data-i18n="account:labelEstado" >Estado</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressBusiness-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressBusiness-soporte' data-i18n="account:labelDireccion">Dirección</label>                               
                            </div>                                        
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <input type='text' class='form-control' id='zipcodeBusiness-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeBusiness-soporte' data-i18n="account:labelPostal">Código postal</label>                                
                            </div>
                        </div>                                
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>                    
                                <i class='paisesPrefijos' id='paisesPrefijos6'></i>                                          
                                <input type='text' class='form-control' id='phoneBusiness-soporte' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneBusiness-soporte' style="margin-left: 2.5rem;" data-i18n="account:labelNumero">Teléfono</label>                                        
                            </div>    
                        </div>    
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                                           
                                <input type='text' class='form-control' id='websiteBusiness-soporte' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='websiteBusiness-soporte' data-i18n="account:labelWeb">Sitio web empresarial</label>                                        
                            </div>    
                        </div>                            
                    </div>   
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPrevius-soporte2' data-i18n="account:botonAnterior">Anterior</button></div>
                        <div>
                            <button type='button' class='btn px-4 btnEnding-soporte' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEnding-soporte' data-i18n="account:botonFinalizar" >Finalizar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>