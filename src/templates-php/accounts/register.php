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

    session_write_close();
    
    $search = $_GET? $_GET['search'] : '';

?>
<input type="hidden" id="search-product" value="<?php echo $search ?>">
<script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
<div class='d-flex align-items-center' style='min-height: 100vh'>
    <div class='container' style='margin-top: -35px'>
        <div class='card w-75 mb-3' style='margin: 0 auto; margin-top: 2rem; -webkit-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); -moz-box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); box-shadow: 0px 7px 34px -10px rgba(0,0,0,0.75); padding: 1rem;'>
            <div class='card-body'>
                <h5 class='card-title' style='text-align: center; font-size: 2em; font-weight: bold;'>Asistente</h5>
                <p class='card-text' style='text-align: justify; font-size: 1.2em;'>Gracias por formar parte de nuestra plataforma Kalstein Francia, ahora ayúdenos a personalizar su perfil según sus necesidades.</p>
                <div class='c-01'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 1%; background-color: #213280;'></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='nameUser' placeholder='Juan' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32) || event.charCode == 39">
                                <label for='nameUser'>Nombre</label>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='lastnameUser' placeholder='Peréz' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode == 32) || event.charCode == 39">
                                <label for='lastnameUser'>Apellido</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-3'></div>
                        <div class='col-sm-6'>
                            <p class='card-text' style='text-align: center; font-size: 1.5em; font-weight: bold;'>¿Cómo utilizará nuestra plataforma?</p>
                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='cmbPrimary'>
                                <option value='0' selected>Elija una opción</option>
                                <option value='1'>Cotizar, comprar o consumir recursos proporcionados por la plataforma</option>
                                <option value='2'>Anunciar y vender sus productos</option>
                                <!-- <option value='3'>Impartir conocimientos en el ámbito científico, dar cursos, etc.</option>
                                <option value='4'>Prestación de servicios técnicos</option -->
                            </select>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNext1'>Siguiente</button></div>
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
                                <input type='text' class='form-control' id='identityPassport' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='identityPassport'>Documento de identidad/pasaporte (opcional)</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title">Cargar foto del documento (Opcional)</span>
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
                                <label for='countryUser'>País</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <i class='paisesPrefijos' id='paisesPrefijos'></i>                                              
                                <input type='number' class='form-control' id='phoneUser' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;">Teléfono</label>                                           
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem; display: none;'>    
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressUser' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressUser'>Dirección</label>                               
                            </div>
                        </div>            
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='number' class='form-control' id='zipcodeUser' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeUser'>Código postal</label>                            
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem; display: none;'>  
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <i class='paisesPrefijos' id='paisesPrefijos'></i>                                              
                                <input type='number' class='form-control' id='phoneUser' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;">Télefono</label>                                           
                            </div>
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
    
                        </div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient1'>Anterior</button></div>
                        <div>
                            <button type='button' class='btn px-4 btnEndingClient' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingClient'>Finalizar</button>
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
                            <p class='card-text' style='text-align: center; font-size: 1.5em; font-weight: bold;'>Do you own or belong to a company?</p>
                            <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='question-business'>
                                <option value='0' selected>Elija una opción</option>
                                <option value='1'>Si</option>
                                <option value='2'>No</option>
                            </select>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                    <div class='row' style='margin-top: 1rem; display: none;' id='c-optionsQuestionBusiness'>
                        <div class='col-sm-3'></div>
                        <div class='col-sm-6'>
                            <div class='form-floating'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='jobRole'>
                                    <option value='0' selected>Elija una opción</option>
                                    <option value='1'>Ingeniero</option>
                                    <option value='2'>Dirección de Ingeniería</option>
                                    <option value='3'>Diseñador</option>
                                    <option value='4'>Compras / Comprador / Finanzas</option>
                                    <option value='5'>Gestión de programas y proyectos</option>
                                    <option value='6'>Operaciones / Gestión de MRO</option>
                                    <option value='7'>Liderazgo ejecutivo (CXO, VP, fundador, etc.))</option>
                                    <option value='8'>Ventas y marketing</option>
                                    <option value='9'>Otros</option>
                                </select>
                                <label for='jobRole'>Función</label>                               
                            </div>
                        </div>
                        <div class='col-sm-3'></div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div class='col-sm-2'><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient2'>Anterior</button></div>
                        <div class='col-sm-2'>
                            <button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextClient2'>Siguiente</button>
                            <button type='button' class='btn px-4 btnEndingClient' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem; display: none;' id='btnEndingClient'>Finalizar</button>
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
                                <input type='text' class='form-control' id='taxDocument' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='taxDocument'>Documento fiscal (opcional)</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title">Cargar foto del documento (Opcional)</span>
                                    or
                                    <input type="file" id="imageTaxDocument" accept="image/png, image/jpeg" required>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='BusinessName' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='BusinessName'>Razón social</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryBusiness'>
    
                                </select>
                                <label for='countryBusiness'>País</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateBusiness' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateBusiness'>Estado</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressBusiness' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressBusiness'>Dirección fiscal</label>                               
                            </div>                                        
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <input type='number' class='form-control' id='zipcodeBusiness' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeBusiness'>Código postal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>  
                                <i class='paisesPrefijos' id='paisesPrefijos2'></i>                                              
                                <input type='number' class='form-control' id='phoneBusiness' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;">Teléfono</label>                                           
                            </div>
                        </div>                                    
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                                           
                                <input type='text' class='form-control' id='websiteBusiness' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='websiteBusiness'>Sitio web empresarial</label>                                        
                            </div>    
                        </div>
                        <div class='col-sm-6'>
    
                        </div>                                   
                    </div>                                
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusClient3'>Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingClient'>Finalizar</button></div>
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
                                <input type='text' class='form-control' id='identityPassportManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='identityPassportManu'>Documento de identidad/Pasaporte</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title">Cargar foto del documento</span>
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
                                <label for='countryUser'>País</label>
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateUserManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateUser'>Estado</label>
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressUserManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressUser'>Dirección</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='number' class='form-control' id='zipcodeUserManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeUser'>Código postal</label>                            
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>     
                                <i class='paisesPrefijos' id='paisesPrefijos3'></i>                                                  
                                <input type='number' class='form-control' id='phoneUserManu' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser' style="margin-left: 2.5rem;">Teléfono</label>                                           
                            </div>
                        </div>
                        <div class='col-sm-6'>
    
                        </div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnAnteriorManu1'>Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextManu1'>Siguiente</button></div>
                    </div>
                </div>
                <div class='c-manu02' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 75%; background-color: #213280;'></div>
                    </div>
                    <p class='card-text' style='text-align: center; font-size: 1.5em; font-weight: bold;'>Which category best suits your business?</p>
                    <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;' id='profileRole'>
                        <option value='0' selected>Elija una opción</option>
                        <option value='3'>Fabricante</option>
                        <option value='2'>Distribuidor</option>
                        <option value='4'>Soporte Técnico</option>
                        <option value='5'>Servicios de alquiler y equipos usados</option>
                    </select>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusManu2'>Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNextManu2'>Siguiente</button></div>
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
                                <label for='taxDocumentManu'>Documento fiscal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title">Cargar foto del documento</span>
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
                                <label for='BusinessName'>Razón social</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryBusinessManu'>
    
                                </select>
                                <label for='countryBusinessManu'>País</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateBusinessManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateBusiness'>Estado</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressBusinessManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressBusiness'>Dirección</label>                               
                            </div>                                        
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <input type='number' class='form-control' id='zipcodeBusinessManu' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em;'>
                                <label for='zipcodeBusiness'>Código postal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>          
                                <i class='paisesPrefijos' id='paisesPrefijos4'></i>                                        
                                <input type='number' class='form-control' id='phoneBusinessManu' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneBusiness' style="margin-left: 2.5rem;">Teléfono</label>                                        
                            </div>    
                        </div>                                    
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                                           
                                <input type='text' class='form-control' id='websiteBusinessManu' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='websiteBusiness'>Sitio web empresarial</label>                                        
                            </div>    
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='jobRoleManu'>
                                    <option value='0' selected>Elija una opción</option>
                                    <option value='1'>Ingeniero</option>
                                    <option value='2'>Dirección de Ingeniería</option>
                                    <option value='3'>Diseñador</option>
                                    <option value='4'>Compras / Comprador / Finanzas</option>
                                    <option value='5'>Gestión de programas y proyectos</option>
                                    <option value='6'>Operaciones / Gestión de MRO</option>
                                    <option value='7'>Liderazgo ejecutivo (CXO, VP, fundador, etc.))</option>
                                    <option value='8'>Ventas y marketing</option>
                                    <option value='9'>Otros</option>
                                </select>
                                <label for='jobRoleManu'>Función</label>  
                            </div>
                        </div>                                   
                    </div>                                
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPreviusManu3'>Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEndingManu'>Finalizar</button></div>
                    </div>
                </div
                
                 <!-- XXX RUTA SOPORTE XXX -->
    
                <!--div class='c-soporte01' style='display: none;'>
                    <div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='margin-bottom: 2rem;'>
                        <div class='progress-bar' style='width: 50%; background-color: #213280;'></div>
                    </div>
                    <div class="row">
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper' style='margin-top: 6rem;'>
                                <input type='text' class='form-control' id='identityPassport-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='identityPassport-soporte'>Documento de identidad/Pasaporte</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="manualPDF" class="drop-container" id="dropcontainer">
                                    <span class="drop-title">Cargar foto del documento</span>
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
                                <label for='countryUser-soporte'>País</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateUser-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateUser-soporte'>Estado</label>                                
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressUser-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressUser-soporte'>Dirección</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='number' class='form-control' id='zipcodeUser-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeUser-soporte'>Código postal</label>                            
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                    
                                <i class='paisesPrefijos' id='paisesPrefijos5'></i>                               
                                <input type='number' class='form-control' id='phoneUser-soporte' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneUser-soporte' style="margin-left: 2.5rem;">Teléfono</label>                                              
                            </div>
                        </div>
                        <div class='col-sm-6'>
    
                        </div>
                    </div>
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPrevius-soporte1'>Anterior</button></div>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnNext-soporte1'>Siguiente</button></div>
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
                                <label for='taxDocument-soporte'>Documento fiscal</label>                                
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class="form-group mb-3 p-4">
                                <label for="imageTaxDocument-soporte" class="drop-container" id="dropcontainer">
                                    <span class="drop-title">Cargar foto del documento</span>
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
                                <label for='BusinessName-soporte'>Razón social</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='jobRole-soporte'>
                                    <option value='0' selected>Elija una opción</option>
                                    <option value='1'>Ingeniero</option>
                                    <option value='2'>Dirección de Ingeniería</option>
                                    <option value='3'>Diseñador</option>
                                    <option value='4'>Compras / Comprador / Finanzas</option>
                                    <option value='5'>Gestión de programas y proyectos</option>
                                    <option value='6'>Operaciones / Gestión de MRO</option>
                                    <option value='7'>Liderazgo ejecutivo (CXO, VP, fundador, etc.))</option>
                                    <option value='8'>Ventas y marketing</option>
                                    <option value='9'>Otros</option>
                                </select>
                                <label for='jobRole-soporte'>Función</label>  
                            </div>
                        </div> 
                    </div>
                    <div class='row' style='margin-top: 2rem;'>  
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <select class='form-select' aria-label='Default select example' style='height: 3rem; outline: 1px solid #213280; font-size: 0.9em;' id='countryBusiness-soporte'>
    
                                </select>
                                <label for='countryBusiness-soporte'>País</label>                               
                            </div>
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='stateBusiness-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4 Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='stateBusiness-soporte'>Estado</label>                               
                            </div>
                        </div>
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>
                                <input type='text' class='form-control' id='addressBusiness-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='addressBusiness-soporte'>Dirección</label>                               
                            </div>                                        
                        </div>
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>  
                                <input type='text' class='form-control' id='zipcodeBusiness-soporte' placeholder='Suzy Queue 4455 Landing Lange, APT 4
                                Louisville, KY 40018-1234' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;'>
                                <label for='zipcodeBusiness-soporte'>Código postal</label>                                
                            </div>
                        </div>                                
                    </div>
                    <div class='row' style='margin-top: 2rem;'>
                        <div class='col-sm-6'>
                            <div class='form-floating input-wrapper'>                    
                                <i class='paisesPrefijos' id='paisesPrefijos6'></i>                                          
                                <input type='text' class='form-control' id='phoneBusiness-soporte' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-left: 3rem;' autofocus>
                                <label for='phoneBusiness-soporte' style="margin-left: 2.5rem;">Teléfono</label>                                        
                            </div>    
                        </div>    
                        <div class='col-sm-6 mb-3 mb-sm-0'>
                            <div class='form-floating input-wrapper'>                                           
                                <input type='text' class='form-control' id='websiteBusiness-soporte' placeholder='+000000000000' style='height: 3rem; outline: 1px solid #213280; font-size: 1.4em; padding-right: 3rem;' autofocus>
                                <label for='websiteBusiness-soporte'>Sitio web empresarial</label>                                        
                            </div>    
                        </div>                            
                    </div>   
                    <div class='d-flex flex-column flex-md-row justify-content-between'>
                        <div><button type='button' class='btn px-4' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnPrevius-soporte2'>Anterior</button></div>
                        <div>
                            <button type='button' class='btn px-4 btnEnding-soporte' style='background-color: #213280; color: #fff; margin-top:1rem; width: 100%; height: 3rem;' id='btnEnding-soporte'>Finalizar</button>
                        </div>
                    </div>
                </div-->
            </div>
        </div>
    </div>
</div>