<input type='hidden' id='count' value='0' />
<input type='hidden' id='ih-chWeight' value='0' />
<input type='hidden' id='ih-weight3' value='0' />
<!-- Modal -->
<div class='modal fade modal-lg' id='cotModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='exampleModalLabel' data-i18n='client:infoReqCotizacion'>Información requerida -
          Cotización</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <input type='hidden' id='ih-model' />
        <input type='hidden' id='ih-cant' />
        <div class='input-group mb-3' style='display: none;'>
          <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:sirs">Sirs:</span>
          <input type='text' style='width: 0; height: 10mm;' class='form-control' id='sres' placeholder='Kalstein Paris'
            aria-label='Username' aria-describedby='basic-addon1'>
          <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:attention">Attention:</span>
          <input type='text' style='width: 0; height: 10mm;' class='form-control' id='atc' placeholder='Yul Rosal'
            aria-label='Username' aria-describedby='basic-addon1'>
        </div>
        <div class='input-group mb-3'>
          <h5 style='width: 100%; text-align: center;' data-i18n="client:selectAlmacen">Seleccione un almacén</h5>
          <br><br>
          <div class='form-check' style='margin: 0px auto;'>
            <input class='form-check-input p-2' type='radio' name='r01' id='r01''>
                                    <label class=' form-check-label' id='r01txt' for='r01'
              style='font-weight: bold; font-size: 1.2em;'>
            EXW Kalstein Shanghai
            </label>
          </div>
          <div class='form-check' style='margin: 0px auto;'>
            <input class='form-check-input p-2' type='radio' name='r02' id='r02''>
                                    <label class=' form-check-label' id='r02txt' for='r02'
              style='font-weight: bold; font-size: 1.2em;'>
            EXW Kalstein Paris
            </label>
          </div>
        </div>
        <div id='cEXWShanghai' class='none'>
          <hr style='width: 50%; margin-left: 25%;'>
          <div class='input-group' style='text-align: center;'>
            <h5 style='width: 100%; text-align: center;' data-i18n="client:retirementMethod">Método de retirada</h5>
            <br>
            <div style='width: 60%; margin-left: 20%;'>
              <select class='form-select' aria-label='Default select example' id='withdrawalMethod'>
                <option selected style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --
                </option>
                <option value='1' data-i18n="client:envioDestino">Envío a destino</option>
                <option value='2' data-i18n="client:retiroFabrica">Retiro en fábrica</option>
              </select>
              <br>
              <h5 style='width: 100%; text-align: center;' data-i18n="client:discountCode">Código de descuento</h5>
              <input type='text' class='form-control' id='discountCode' data-placeholder='client:codeHere'
                placeholder='Ingresa tu código aquí' aria-label='Discount Code' aria-describedby='basic-addon-discount'>
              <a id='checkCodeBtn' href='javascript:void(0);'
                style='display: inline-block; padding: 10px 20px; margin-top: 15px; background-color: #007bff; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; text-align: center; text-decoration: none;'>Comprobar
                código</a>
              <span id='msgCodeStatus01' style='color: #21a500; display: none;' data-i18n="client:codeAvailable">Código
                disponible</span>
              <span id='msgCodeStatus02' style='color: #ea0404; display: none;'
                data-i18n="client:codeNoAvailable">Código no disponible</span>
            </div>
          </div>
          <div id='c-withdrawal' style='display: none;'>
            <div class='container-shipping none'>
              <hr>
              <div class='input-group'>
                <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:metodoEnvio">Método de
                  envío:</i></span>
                <select class='form-select' aria-label='Default select example' id='envioM'>
                  <option selected style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --
                  </option>
                  <option value='Aerial' data-i18n="client:aereo">Aéreo</option>
                  <option value='Maritime' data-i18n="client:maritimo">Marítimo</option>
                </select>
                <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:destino">Destino:</i></span>
                <select class='form-select' aria-label='Default select example' id='country'>

                </select>
                <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:postalCode">Código
                  postal:</span>
                <input type='number' style='width: 0;' class='form-control mb-0' id='zipcode' aria-label='Username'
                  aria-describedby='basic-addon1'>
              </div>
            </div>
          </div>
        </div>
        <div id='cEXWParis' class='none'>
          <hr style='width: 50%; margin-left: 25%;'>
          <div class='input-group' style='text-align: center;'>
            <h5 style='width: 100%; text-align: center;' data-i18n="client:deliveryTime">Tiempos de entrega</h5>
            <br>
            <div style='width: 60%; margin-left: 20%;'>
              <select class='form-select' aria-label='Default select example' id='deliveryTimes'>
                <option selected style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --
                </option>
                <option value='1' data-i18n="client:days15">15 - 30 días</option>
                <option value='2' data-i18n="client:days60">60 días</option>
              </select>
            </div>
          </div>
          <div class='container-shippingParis none'>
            <hr>
            <div class='c-countryParis' style='width: 100%; float: left;'>
              <div style='width: 30%; margin-left: 35%;'>
                <div class='form-check' style='width: 100%; padding-left: 20%;'>
                  <input class='form-check-input' type='radio' name='r03' id='r03'>
                  <label class='form-check-label' for='r03' style='font-weight: bold; font-size: 1.2em;'
                    data-i18n="client:insideFrance">
                    Dentro de Francia
                  </label>
                </div>
                <div class='form-check' style='width: 100%; padding-left: 20%;'>
                  <input class='form-check-input' type='radio' name='r04' id='r04'>
                  <label class='form-check-label' for='r04' style='font-weight: bold; font-size: 1.2em;'
                    data-i18n="client:otrosPaisesUE">
                    Otro país de la UE
                  </label>
                </div>
              </div>
            </div>
            <div class='c-countryEU none' style='width: 50%; float: left; margin-top: 1.3rem;'>
              <div class='input-group'>
                <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:destino">Destino:</i></span>
                <select class='form-select' aria-label='Default select example' id='countryEU'>

                </select>
              </div>
            </div>
          </div>
        </div>
        <br>
        <hr>
        <div class='input-group'>
          <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:moneda">Moneda:</i></span>
          <select class='form-select' aria-label='Default select example' id='divisa'>
            <option selected style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --
            </option>
            <option value='EUR'>EUR</option>
            <option value='USD'>USD</option>
          </select>
          <span class='input-group-text fw-bold' id='basic-addon1' data-i18n="client:metodoDePago">Método de
            pago:</span>
          <select class='form-select' aria-label='Default select example' id='pago'>
            <option selected style='text-align: center;' value='0' data-i18n="client:selecciona">-- Seleccionar --
            </option>
            <option value='Transferencia bancaria' data-i18n="client:transferencia">Transferencia bancaria</option>
            <option value='Tarjeta de Credito/Debito (Pasarela de pago)' data-i18n="client:creditoTarjetaPas">Tarjeta de
              Credito/Debito (Pasarela de pago)
            </option>
          </select>
        </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary btnClosedModal' data-bs-dismiss='modal'
          data-i18n="client:cerrar">Cerrar</button>
        <button type='button' id='btnSavedInfoQuote' class='btn btn-primary' data-i18n="client:guardar">Guardar</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class='modal fade' id='changeCountry' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='exampleModalLabel'>Country</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <div class='input-group'>
          <span class='input-group-text fw-bold' id='basic-addon1'>Destination:</i></span>
          <select class='form-select' aria-label='Default select example' id='country2'>

          </select>
          <span class='input-group-text fw-bold' id='basic-addon1'>Zipcode City:</span>
          <input type='number' class='form-control' id='zipcode2' aria-label='Username' aria-describedby='basic-addon1'>
        </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary btnCancelChangeCountry' data-bs-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary btnSaveChangeCountry'>Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class='modal fade' id='changeMEnvio' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='exampleModalLabel'>Shipping method</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <div class='input-group'>
          <select class='form-select' aria-label='Default select example' id='envioM2'>
            <option selected style='text-align: center;' value='0'>-- Seleccionar --</option>
            <option value='Aerial'>Aerial</option>
            <option value='Maritime'>Maritime</option>
          </select>
        </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary btnCancelChangeMEnvio' data-bs-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary btnSaveChangeMEnvio'>Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class='modal fade' id='changeIncoterm' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='exampleModalLabel'>Incoterm</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <div class='input-group'>
          <select class='form-select' aria-label='Default select example' id='incoterm2'>
            <option selected style='text-align: center;' value='0'>-- Seleccionar --</option>
            <option value='EXW Kalstein Shanghai'>EXW Kalstein Shanghai</option>
            <option value='EXW Kalstein Paris'>EXW Kalstein Paris</option>
          </select>
        </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary btnCancelChangeIncoterm' data-bs-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary btnSaveChangeIncoterm'>Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div class='modal fade' id='changeMPayment' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
  <div class='modal-dialog modal-dialog-centered'>
    <div class='modal-content'>
      <div class='modal-header'>
        <h1 class='modal-title fs-5' id='exampleModalLabel'>Payment method</h1>
        <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
      </div>
      <div class='modal-body'>
        <div class='input-group'>
          <select class='form-select' aria-label='Default select example' id='pago2'>
            <option selected style='text-align: center;' value='0'>-- Seleccionar --</option>
            <option value='Bank Transfer'>Bank Transfer</option>
            <option value='Credit/Debit Card (Payment Gateway)'>Credit/Debit Card (Payment Gateway)</option>
            <option value='Paypal'>Paypal</option>
          </select>
        </div>
      </div>
      <div class='modal-footer'>
        <button type='button' class='btn btn-secondary btnCancelChangeMPayment' data-bs-dismiss='modal'>Close</button>
        <button type='button' class='btn btn-primary btnSaveChangeMPayment'>Save changes</button>
      </div>
    </div>
  </div>
</div>