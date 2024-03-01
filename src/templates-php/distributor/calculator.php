<style>
    .container-calc {
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
    }

    .container-history {
        height: 720px;
        padding: 20px;
        background-color: #efefef;
        box-shadow: 0 0 6px rgba(0, 0, 0, 0.2);
    }

    .calculator-form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        font-weight: bold;
    }

    .calculator-form select,
    .calculator-form input {
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #888 !important;
        border-radius: 4px;
    }
    #results-history{
        border: 2px inset #ddd;
        background-color: #fff;
        height: 92%;
        overflow-y: auto;
    }
    .result-div{
        padding: 10px;
        padding-bottom: 0;
        border-bottom: 1px solid #aaa;
    }
</style>

<div class="container-fluid">
    <div class="row mt-3">
        
        <div class="col-12 col-md-7">
            <div class="container-calc">
                <form class='calculator-form' method="post">
        
                    <label data-i18n="distribuidor:labelMetodo" for="product">Por favor selecciona el método que quieras consultar</label>
                    <select style="color: #000 !important" name="product" id="product">
                        <option value="selected" data-i18n="distribuidor:optionMetodoOne">Selecciona una opción para calcular</option>
                        <option value="maritime" data-i18n="distribuidor:optionMetodoTwo">Marítimo</option>
                        <option value="aerial" data-i18n="distribuidor:optionMetodoThree">Aéreo</option>
                    </select>
        
                    <div id="show-aerial" hidden>
                        <center><p style="font-size: 30px">EXW Kalstein Shangai</p></center>
                        <label for="show-maritime" data-i18n="distribuidor:labelAlmacen">Por favor ingresa las medidas necesarias para calcular</label>
                        <input type="number" style="color: #000 !important" id="height-a" data-placeholder="distribuidor:labelAlto" placeholder="Alto" value="" />
                        <input type="number" style="color: #000 !important" id="width-a" data-placeholder="distribuidor:labelAncho" placeholder="Ancho" value="" />
                        <input type="number" style="color: #000 !important" id="length-a" data-placeholder="distribuidor:labelLargo" placeholder="Largo" value="" />
                        <input type="number" style="color: #000 !important" id="quantity-a" data-placeholder="distribuidor:labelCantidad" placeholder="Cantidad" value="" />
                        <input type="number" style="color: #000 !important" id="weightBoxFT" data-placeholder="distribuidor:labelPesoNeto" placeholder="Peso" value="" />
                        <label for="show-maritime" data-i18n="distribuidor:labelPais">Selecciona el país que quieres calcular:</label>
                        <select style="color: #000 !important" name="selectCountryAerial" id="selectCountryAerial"></select>
                        <input type="number" style="color: #000 !important" id="result-a" data-placeholder="distribuidor:labelResultado" placeholder="Resultado" value="" readonly/>
                    </div>
            
                    <div id="show-maritime" hidden>
                        <center><p style="font-size: 30px">EXW Kalstein Shangai</p></center>
                        <label for="show-maritime" data-i18n="distribuidor:labelAlmacenTwo">Por favor ingresa las medidas necesarias</label>
                        <input type="number" style="color: #000 !important" id="height-m" data-placeholder="distribuidor:labelAlto" placeholder="Alto" value="" />
                        <input type="number" style="color: #000 !important" id="width-m" data-placeholder="distribuidor:labelAncho" placeholder="Ancho" value="" />
                        <input type="number" style="color: #000 !important" id="length-m" data-placeholder="distribuidor:labelLargo" placeholder="Largo" value="" />
                        <label for="show-maritime" data-i18n="distribuidor:labelPaisTwo">Selecciona el país al que quieres calcular:</label>
                        <select style="color: #000 !important" id="selectCountryMaritimal"></select>
                        <input type="number" style="color: #000 !important" id="result-m" data-placeholder="distribuidor:labelResultado" placeholder="Resultado" value="" readonly/>
                    </div>
        
                </form>

                <div id="shipping-estimate">
                </div>
            
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="container-history">
                <label class="mb-2" data-i18n="distribuidor:labelHistorial"> Historial</label>
                <div id="results-history">

                </div>
            </div>
        </div>
    </div>
</div>