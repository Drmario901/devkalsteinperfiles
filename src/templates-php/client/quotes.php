<div id='c-panel02' style='display: none;'>
    <?php
        $banner_img = 'Header-usuario-IMG.png';
        $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

        // Incluir el archivo de traducciones
        include 'translations.php';

        // Determinar el texto del banner según el idioma
        $banner_text_translation = isset($translations[$language]['banner_text_my_quotes']) ? $translations[$language]['banner_text_my_quotes'] : $translations['en']['banner_text_my_quotes'];

        // Incluir el banner.php pasando el texto traducido
        $banner_text = $banner_text_translation;
        include 'banner.php';
    ?>
    <div class='container-xl px-4 mt-4'>
        <nav class='nav nav-borders my-quotes-nav'>
            <a class='nav-link active ms-0' href='#' id='btnHistoryQuotePR01' data-i18n="client:historial">Historial</a>
            <a class='nav-link' href='#' id='btnSettingQuotePR01' data-i18n="client:configuracion" >Configuración</a>
        </nav>
        <hr class='mt-0 mb-4 my-quotes-nav'>
        <div id='c-historyQuote'>
            <div class='row'>
                <div class='col-xl-7'>
                    <canvas id='lineChartQuote' style='width: 100%; height: 100%;'></canvas>
                </div>
                <div class='col-xl-5'>
                    <p style='text-align: center; color: #69707a;' data-i18n="client:productosRecientesCot">Productos recientemente cotizados</p>
                    <div class='content-recentProduct'>

                    </div>
                </div>
            </div>
            <br>
            <hr class='mt-0 mb-4'>
            <div class='row'>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='dateFrom' data-i18n="client:de">De</label>
                    <input type='date' id='dateFrom'
                        style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                </div>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='dateTO' data-i18n="client:paraMsj">Para</label>
                    <input type='date' id='dateTO' style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                </div>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='cmbStatus' data-i18n="client:estatus">Estatus</label>
                    <select class='form-select' aria-label='Default select example' id='cmbStatus'
                        style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                        <option selected='' style='text-align: center;' value='0' data-i18n="client:selecciona">-- Selecciona --</option>
                        <option value='0' data-i18n="client:pendiente">Pendiente</option>
                        <option value='1' data-i18n="client:procesar">Procesar</option>
                        <option value='2' data-i18n="client:cancelar">Cancelar</option>
                        <option value='3' data-i18n="client:procesado">Procesado</option>
                        <option value='4' data-i18n="client:cancelado">Cancelado</option>
                    </select>
                </div>
                <div class='col-xl-6 input-wrapper-p'>
                    <label class='small mb-1 d-block' for='inputSearchQuote'>&nbsp;</label>
                    <div class="d-flex flex-row">
                        <input type='text' id='inputSearchQuote' class='inputSearchQuote'>
                        <button id='btnSearchQuote' class='btnSearchQuote' data-i18n="client:buscar">Buscar</button>
                    </div>
                    <i class='fa-solid fa-magnifying-glass second-glass'></i>
                </div>
            </div>
            <br>
            <hr class='mt-0 mb-4'>
            <div class='row'>
                <div class='col-xl-12'>

                    <div id="quoteTableContainer">
                        <div id='tblQuoteClient' class='table-responsive'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id='c-settingsQuote' style='display: none;'>
        <div class='row'>
            <div class='col-xl-2'></div>
            <div class='col-xl-8'>
                <div class='card mb-4 mb-xl-0'>
                    <div class='card-header fw-bold' data-i18n="client:detallesDePago">
                        Detalles de pago
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputWarehouse' data-i18n="client:almacen">Almacén</label>
                                <select class='form-select' aria-label='Default select example' id='inputWarehouse'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --</option>
                                    <option value='EXW Kalstein Shanghai'>EXW Kalstein Shanghai</option>
                                    <option value='EXW Kalstein Paris'>EXW Kalstein Paris</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputCurrency' data-i18n="client:moneda">Moneda</label>
                                <select class='form-select' aria-label='Default select example' id='inputCurrency'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --</option>
                                    <option value='EUR'>EUR</option>
                                    <option value='USD'>USD</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputPaymentM' data-i18n="client:metodoDePago">Método de pago</label>
                                <select class='form-select' aria-label='Default select example' id='inputPaymentM'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --</option>
                                    <option value='Bank Transfer' data-i18n="client:transferencia">Transferencia bancaria</option>
                                    <option value='Credit/Debit Card (Payment Gateway)' data-i18n="client:creditoTarjetaPas">Credito/Tarjeta de débito (Pasarela de pago)</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <hr class='mt-0 mb-4'>
                    <div class='card-header fw-bold' data-i18n="client:detallesDestino">
                        Detalles de destino
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputShippingM' data-i18n="client:metodoEnvio">Método de envio</label>
                                <select class='form-select' aria-label='Default select example' id='inputShippingM'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --</option>
                                    <option value='Aerial' data-i18n="client:aereo">Aereo</option>
                                    <option value='Maritime' data-i18n="client:maritimo">Marsítimo</option>
                                </select>
                                <select class='form-select' aria-label='Default select example' id='inputShippingMFR'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em; display: none;'>
                                    <option selected='' style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --</option>
                                    <option value='Aerial' data-i18n="client:days15" >15 - 30 días</option>
                                    <option value='Maritime' data-i18n="client:days60">60 días</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputDestination' data-i18n="client:destino">Destino</label>
                                <select class='form-select' aria-label='Default select example'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'
                                    id='inputDestination'>

                                </select>
                                <select class='form-select' aria-label='Default select example'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em; display: none;'
                                    id='inputDestinationEU'>

                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputZipcode' data-i18n="client:codigoZip">Código ZIP</label>
                                <input class='form-control' id='inputZipcode' type='email'
                                    placeholder='Enter your default zipcode'
                                    style='outline: 1px solid #213280; font-size: 0.9em;'>
                            </div>
                        </form>
                    </div>
                    <hr class='mt-0 mb-4'>
                    <button class='btn-complete-profile rounded' type='button' id='savedInfoToQuotes'
                        style='width: 100%; text-align: center;' data-i18n="client:guardarCambios" >Guardar cambios</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class='modal fade' id='modalStatusQuote' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <h1 class='modal-title fs-5' id='exampleModalLabel' data-i18n="client:tituloModal">Título del modal</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                ...
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' data-i18n="client:cerrar">Cerrar</button>
                <button type='button' class='btn btn-primary' data-i18n="client:guardarCambios">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>