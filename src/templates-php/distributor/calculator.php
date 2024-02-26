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
        
                    <label for="product">Por favor selecciona el método que quieras consultar</label>
                    <select style="color: #000 !important" name="product" id="product">
                        <option value="selected">Selecciona una opción para calcular</option>
                        <option value="maritime">Marítimo</option>
                        <option value="aerial">Aéreo</option>
                    </select>
        
                    <div id="show-aerial" hidden>
                        <center><p style="font-size: 30px">EXW Kalstein Shangai</p></center>
                        <label for="show-maritime">Por favor ingresa las medidas necesarias para calcular</label>
                        <input type="number" style="color: #000 !important" id="height-a" placeholder="Alto" value="" />
                        <input type="number" style="color: #000 !important" id="width-a" placeholder="Ancho" value="" />
                        <input type="number" style="color: #000 !important" id="length-a" placeholder="Largo" value="" />
                        <input type="number" style="color: #000 !important" id="quantity-a" placeholder="Cantidad" value="" />
                        <input type="number" style="color: #000 !important" id="weightBoxFT" placeholder="Peso" value="" />
                        <label for="show-maritime">Selecciona el país que quieres calcular:</label>
                        <select style="color: #000 !important" name="selectCountryAerial" id="selectCountryAerial"></select>
                        <input type="number" style="color: #000 !important" id="result-a" placeholder="Resultado" value="" readonly/>
                    </div>
            
                    <div id="show-maritime" hidden>
                        <center><p style="font-size: 30px">EXW Kalstein Shangai</p></center>
                        <label for="show-maritime">Por favor ingresa las medidas necesarias</label>
                        <input type="number" style="color: #000 !important" id="height-m" placeholder="Alto" value="" />
                        <input type="number" style="color: #000 !important" id="width-m" placeholder="Ancho" value="" />
                        <input type="number" style="color: #000 !important" id="length-m" placeholder="Largo" value="" />
                        <label for="show-maritime">Selecciona el país al que quieres calcular:</label>
                        <select style="color: #000 !important" id="selectCountryMaritimal"></select>
                        <input type="number" style="color: #000 !important" id="result-m" placeholder="Resultado" value="" readonly/>
                    </div>
        
                </form>

                <div id="shipping-estimate">
                </div>
            
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="container-history">
                <label class="mb-2"> Historial</label>
                <div id="results-history">

                </div>
            </div>
        </div>
    </div>
</div>