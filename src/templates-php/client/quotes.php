<div id='c-panel02' style='display: none;'>
    <?php
        $banner_img = 'Header-usuario-IMG.png';
        $banner_text = "Mis cotizaciones";
        include 'banner.php';
    ?>
    <div class='container-xl px-4 mt-4'>
        <nav class='nav nav-borders my-quotes-nav'>
            <a class='nav-link active ms-0' href='#' id='btnHistoryQuotePR01'>Historial</a>
            <a class='nav-link' href='#' id='btnSettingQuotePR01'>Configuración</a>
        </nav>
        <hr class='mt-0 mb-4 my-quotes-nav'>
        <div id='c-historyQuote'>
            <div class='row'>
                <div class='col-xl-7'>
                    <canvas id='lineChartQuote' style='width: 100%; height: 100%;'></canvas>
                </div>
                <div class='col-xl-5'>
                    <p style='text-align: center; color: #69707a;'>Productos recientemente cotizados</p>
                    <div class='content-recentProduct'>

                    </div>
                </div>
            </div>
            <br>
            <hr class='mt-0 mb-4'>
            <div class='row'>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='dateFrom'>De</label>
                    <input type='date' id='dateFrom'
                        style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                </div>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='dateTO'>Para</label>
                    <input type='date' id='dateTO' style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                </div>
                <div class='col-xl-2'>
                    <label class='small mb-1' for='cmbStatus'>Estatus</label>
                    <select class='form-select' aria-label='Default select example' id='cmbStatus'
                        style='height: 2.8em; outline: 1px solid #213280; font-size: 0.9em;'>
                        <option selected='' style='text-align: center;' value='0'>-- Selecciona --</option>
                        <option value='0'>Pendiente</option>
                        <option value='1'>Procesar</option>
                        <option value='2'>Cancelar</option>
                        <option value='3'>Procesado</option>
                        <option value='4'>Cancelado</option>
                    </select>
                </div>
                <div class='col-xl-6 input-wrapper-p'>
                    <label class='small mb-1 d-block' for='inputSearchQuote'>&nbsp;</label>
                    <div class="d-flex flex-row">
                        <input type='text' id='inputSearchQuote' class='inputSearchQuote'>
                        <button id='btnSearchQuote' class='btnSearchQuote'>Buscar</button>
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
                    <div class='card-header fw-bold'>
                        Detalles de pago
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputWarehouse'>Almacén</label>
                                <select class='form-select' aria-label='Default select example' id='inputWarehouse'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0'>-- Seleccionar --</option>
                                    <option value='EXW Kalstein Shanghai'>EXW Kalstein Shanghai</option>
                                    <option value='EXW Kalstein Paris'>EXW Kalstein Paris</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputCurrency'>Moneda</label>
                                <select class='form-select' aria-label='Default select example' id='inputCurrency'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0'>-- Seleccionar --</option>
                                    <option value='EUR'>EUR</option>
                                    <option value='USD'>USD</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputPaymentM'>Método de pago</label>
                                <select class='form-select' aria-label='Default select example' id='inputPaymentM'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0'>-- Seleccionar --</option>
                                    <option value='Bank Transfer'>Transferencia bancaria</option>
                                    <option value='Credit/Debit Card (Payment Gateway)'>Credito/Tarjeta de débito (Pasarela de pago)</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <hr class='mt-0 mb-4'>
                    <div class='card-header fw-bold'>
                        Detalles de destino
                    </div>
                    <div class='card-body'>
                        <form>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputShippingM'>Método de envio</label>
                                <select class='form-select' aria-label='Default select example' id='inputShippingM'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>
                                    <option selected='' style='text-align: center;' value='0'>-- Seleccionar --</option>
                                    <option value='Aerial'>Aereo</option>
                                    <option value='Maritime'>Maítimo</option>
                                </select>
                                <select class='form-select' aria-label='Default select example' id='inputShippingMFR'
                                    style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em; display: none;'>
                                    <option selected='' style='text-align: center;' value='0'>-- Seleccionar --</option>
                                    <option value='Aerial'>15 - 30 días</option>
                                    <option value='Maritime'>60 días</option>
                                </select>
                            </div>
                            <div class='mb-3'>
                                <label class='small mb-1' for='inputDestination'>Destino</label>
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
                                <label class='small mb-1' for='inputZipcode'>Código ZIP</label>
                                <input class='form-control' id='inputZipcode' type='email'
                                    placeholder='Enter your default zipcode'
                                    style='outline: 1px solid #213280; font-size: 0.9em;'>
                            </div>
                        </form>
                    </div>
                    <hr class='mt-0 mb-4'>
                    <button class='btn-complete-profile rounded' type='button' id='savedInfoToQuotes'
                        style='width: 100%; text-align: center;'>Guardar cambios</button>
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
                <h1 class='modal-title fs-5' id='exampleModalLabel'>Título del modal</h1>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
                ...
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                <button type='button' class='btn btn-primary'>Guardar cambios</button>
            </div>
        </div>
    </div>
</div>