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

    form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
        font-weight: bold;
    }

    select,
    input {
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    #results-history{
        border: 2px inset #ddd;
        background-color: #fff;
        height: 92%;
        overflow: scroll;
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
                <form method="post">
        
                    <label for="product" data-i18n="rentalsale:labelSelectMethod">Please select the send method you want to query</label>
                    <select style="color: #000 !important" name="product" id="product">
                        <option value="selected" data-i18n="rentalsale:optSelectCalc">Select an option to calculate</option>
                        <option value="maritime" data-i18n="rentalsale:optMaritime">Maritime</option>
                        <option value="aerial" data-i18n="rentalsale:optAerial">Aerial</option>
                    </select>
        
                    <div id="show-aerial" hidden>
                        <center><p style="font-size: 30px">EXW Kalstein Shangai</p></center>
                        <label for="show-maritime" data-i18n="rentalsale:labelEnterMeasures">Please enter needed measures to calculate:</label>
                        <input type="number" style="color: #000 !important" id="height-a" placeholder="Height" value="" data-placeholder="inputHeight"/>
                        <input type="number" style="color: #000 !important" id="width-a" placeholder="Width" value="" data-placeholder="inputWidth"/>
                        <input type="number" style="color: #000 !important" id="length-a" placeholder="Length" value="" data-placeholder="inputLength"/>
                        <input type="number" style="color: #000 !important" id="quantity-a" placeholder="Quantity" value="" data-placeholder="inputQuantity"/>
                        <input type="number" style="color: #000 !important" id="weightBoxFT" placeholder="Weight" value="" data-placeholder="inputWeight"/>
                        <label for="show-maritime" data-i18n="rentalsale:labelSelectCountry">Select the country you want to calculate:</label>
                        <select style="color: #000 !important" name="selectCountryAerial" id="selectCountryAerial"></select>
                        <input type="number" style="color: #000 !important" id="result-a" placeholder="Result" value="" readonly data-placeholder="inputResult"/>
                    </div>
            
                    <div id="show-maritime" hidden>
                        <center><p style="font-size: 30px">EXW Kalstein Shangai</p></center>
                        <label for="show-maritime" data-i18n="rentalsale:labelEnterMeasuresCalc">Please enter needed measures to calc:</label>
                        <input type="number" style="color: #000 !important" id="height-m" placeholder="Height" value="" data-placeholder="inputHeight"/>
                        <input type="number" style="color: #000 !important" id="width-m" placeholder="Width" value="" data-placeholder="inputWidth"/>
                        <input type="number" style="color: #000 !important" id="length-m" placeholder="Length" value="" data-placeholder="inputLength"/>
                        <label for="show-maritime" data-i18n="rentalsale:labelSelectCountryCalc">Select the country you want to calc:</label>
                        <select style="color: #000 !important" id="selectCountryMaritimal"></select>
                        <input type="number" style="color: #000 !important" id="result-m" placeholder="Result" value="" readonly data-placeholder="inputResult"/>
                    </div>
        
                </form>

                <div id="shipping-estimate">
                </div>
            
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="container-history">
                <label class="mb-2" data-i18n="rentalsale:labelCalcHist"> Calculation history </label>
                <div id="results-history">

                </div>
            </div>
        </div>
    </div>
</div>