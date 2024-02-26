jQuery(document).ready(function ($) {

    updateFieldsVisibility();
    maritimalPrice();
    aerialPrice();



    $('#product').change(function () {
        updateFieldsVisibility();
    });



    function updateFieldsVisibility() {
        const selectedOption = $('#product').val();

        if (selectedOption === 'selected') {
            $('#show-maritime').attr('hidden', 'hidden');
            $('#show-aerial').attr('hidden', 'hidden');
        }

        if (selectedOption === 'aerial') {
            $('#show-aerial').removeAttr('hidden');
            $('#show-maritime').attr('hidden', 'hidden');
        }

        if (selectedOption === 'maritime') {
            $('#show-maritime').removeAttr('hidden');
            $('#show-aerial').attr('hidden', 'hidden');
        }

    }



    function maritimalPrice() {
        $.ajax({
            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/distributor/selectCountryMaritimal.php',
            method: 'GET',
            
            success: function (consulta) {
                $('#selectCountryMaritimal').html(consulta);
                $('#selectCountryMaritimal').change(function () {
                    const selectedCountry = $(this).val();
                    let tarifa = $(`#selectCountryMaritimal [value="${selectedCountry}"]`).attr('price');
                    calculateMaritimePrice(selectedCountry, tarifa);
                });

            },

            error: function () {

                alert("Error seleccionando el país para el precio marítimo.");

            }

        });

    }



    function calculateMaritimePrice(ctry, tarifa) {

        const height = parseFloat($('#height-m').val());

        const width = parseFloat($('#width-m').val());

        const length = parseFloat($('#length-m').val());



        const precio_m3 = height * width * length;

        let precio_total = (precio_m3 / 1000000) * tarifa;



        if (precio_m3 < 0.3000) {

            $('#result-m').attr('placeholder', 'Intenta con Envío Aéreo');

        } else if (precio_total > 1) {

            const cubicMeters = (precio_total / tarifa);

            var totalPrice = cubicMeters * tarifa;



            alert(`El precio calculado es menor de un metro cubico, el precio se ha ajustado para ${cubicMeters} metro(s) cúbico(s) a la tarifa principal.`);

            precio_total = totalPrice;

            $('#result-m').attr('placeholder', precio_total.toFixed(2));



            $('#results-history').prepend(`

                <div class='result-div d-flex flex-column'>

                    <div>

                        <b>Maritimal:&nbsp;</b>

                        <b>${ctry}</b>

                    <div>

                    <b>USD ${precio_total.toFixed(2)}</b>

                </div>

            `);

        } else {

            var totalPrice = tarifa;

            $('#result-m').attr('placeholder', precio_total.toFixed(2));



            $('#results-history').prepend(`

                <div class='result-div d-flex flex-column'>

                    <div>

                        <b>Maritimal:&nbsp;</b>

                        <b>${ctry}</b>

                    <div>

                    <b>USD ${precio_total.toFixed(2)}</b>

                </div>

            `);

        }

    }



    function aerialPrice() {

        $.ajax({

            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/distributor/selectCountryAerial.php',

            method: 'GET',

            success: function (consulta) {

                $('#selectCountryAerial').html(consulta);



                $('#selectCountryAerial').change(function () {

                    const selectedCountry = $(this).val();

                    const long = parseFloat($('#length-a').val());

                    const width = parseFloat($('#width-a').val());

                    const height = parseFloat($('#height-a').val());

                    const cant = parseFloat($('#quantity-a').val());

                    const weightBoxFT = parseFloat($('#weightBoxFT').val());

                    calculateAerialShippingPrice(selectedCountry, long, width, height, cant, weightBoxFT);

                });

            },

            error: function () {

                alert("Error selecccionando país.");

            }

        });

    }



    function calculateAerialShippingPrice(tarifa, long, width, height, cant, weightBoxFT) {

        const multi4 = parseFloat(long) * parseFloat(width);

        const multi5 = parseFloat(multi4) * parseFloat(height);

        const division = parseFloat(multi5) / parseFloat(1000000);

        const round = parseFloat(division.toFixed(3));

        const chW = parseFloat(round) / parseFloat(0.005);

        const chWeight = chW.toFixed(2);

        const weightE = parseFloat(chWeight) * parseFloat(cant);

        const n3 = parseFloat(round) * parseFloat(cant);

        const m3 = n3.toFixed(3);



        if (weightE > weightBoxFT){

            var weight = weightE;

        }else{

            var weight = weightBoxFT;

        }



        traerPrecios(tarifa, weight);

    }



    function traerPrecios(country, peso){

        $.ajax({

            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/distributor/getRateForCountry.php',

            type: 'POST',

            data: {country, peso},

            

        })

        .done(function(respuesta){

            let data = JSON.parse(respuesta);

            $('#result-a').attr('placeholder', data.priceE);



            let ctry = $(`#selectCountryAerial [value=${country}]`).html();



            $('#results-history').prepend(`

                <div class='result-div d-flex flex-column'>

                    <div>

                        <b>Aerial:&nbsp;</b>

                        <b>${ctry}</b>

                    <div>

                    <b>USD ${data.priceE}</b>

                </div>

            `);

        })

        .fail(function(){

            console.log("error");

        });

    }

});

