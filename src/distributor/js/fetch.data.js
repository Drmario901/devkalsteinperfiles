jQuery(document).ready(function($) {

    const cookieLng = document.cookie.split('; ').find(row => row.startsWith('language=')).split('=')[1]
    let alertsTranslations = {};

    // cargar json de traducciones
    const loadTranslations = (lng) => {
        return fetch(`https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`)
            .then(response => response.json())
            .then(translation => {
                // save in a global variable
                alertsTranslations = translation;
            });
    }; 

    loadTranslations(cookieLng)
    
    mostrarDatos($("#dataEdit").val());

    // Evento on change

    $(document).on('change', '#dataEdit', function(){
        let valor = $(this).val();
        mostrarDatos(valor);
    })

    function mostrarDatos(consulta){
        $.ajax({
            url: plugin_dir + "php/distributor/productData.php",
            type: "POST",
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta);
            let data = JSON.parse(respuesta);

            // Coloca el nombre del input el cual mostrara los datos dependiendo de si es un id o una clase vas a hacer lo mismo con todos
            $('#nameProduct').val(data.name);
            $('#modelProduct').val(data.model);
            $('#brandProduct').val(data.brand);
            $('#descriptionProduct').val(data.description.replace(/<br \/>/g, ''));
            $('#dataCategory').val(data.category);
            $('#stockProduct').val(data.stock);
            $('#statusProduct').val(data.status);

            $('#csv').val(data.lDescrCSV);

            $('#weProduct').val(data.weight);
            $('#wiProduct').val(data.width);
            $('#heProduct').val(data.height);
            $('#leProduct').val(data.length);

            $('#weProductPa').val(data.weight_pa);
            $('#wiProductPa').val(data.width_pa);
            $('#heProductPa').val(data.height_pa);
            $('#leProductPa').val(data.length_pa);
            $('#packageType').val(data.package);

            $('#priceProduct').val(data.price);
            $('#currency').val(data.currency);
            
            $('#discount1').val(data.d1);
            $('#discount1Amount').val(data.d1a);
            $('#discount2').val(data.d2);
            $('#discount2Amount').val(data.d2a);

            // colocacion de la imagen

            $('#thumbnail').attr('style', 'background-color: white; background-image: url('+data.image+'); position: absolute; width: 100%; height: 100%; background-size: contain; background-position: 50% 50%;');
            $('#thumbnail').removeAttr('hidden');

            consulta != "0"? $('#formElements').removeAttr('hidden') : $('#formElements').attr('hidden', '');
            consulta != "0"? $('#formElementsbutton').removeAttr('hidden') : $('#formElements').attr('hidden', '');

            if (data.pdf != ''){
                $('#currentlyUploadedManual').html(`
                <p><b class='d-inline'>${alertsTranslations.CurrentlyUploaded}</b>:
                <a target='_blank' style='dislpay: inline; text-decoration: underline' href='${plugin_dir}src/manuals/upload/${data.pdf}'><i class="fa-solid fa-file-pdf"></i> ${data.namepdf}.pdf</a></p>
                `);
            }
            else{
                $('#currentlyUploadedManual').html('');
            }

            if (data.catalog != '' ){
                $('#currentlyUploadedCatalog').html(`
                <p><b class='d-inline'>${alertsTranslations.FileUploaded}</b>:
                <a target='_blank' style='dislpay: inline; text-decoration: underline' href='${plugin_dir}src/catalogs/upload/${data.catalog}'><i class="fa-solid fa-file-pdf"></i> ${data.namecatalog}.pdf</a></p>
                `);
            }
            else{
                $('#currentlyUploadedCatalog').html('');
            }

            // colocacion de la tabla de especificaciones

            if(data.lDescrCSV != ''){

                let json = CSVJSON.csv2json(data.lDescrCSV, {parseNumbers: true});
                has_at_least_3_rows = Object.keys(json[0]).length > 2;
                
                if(!has_at_least_3_rows){
                    let keys = Object.keys(json[0]);

                    $('#stock-table-keys').empty();
                    $('#stock-table-values').empty();

                    $('#stock-basic-table').removeAttr('hidden');
                    $('#stock-basic-editor').addClass('selected');
                    $('#stock-ignore-table').removeClass('selected');
                    $('#table-mode').val('basic');

                    $('#stock-table-keys').append(`
                        <div><input id="table-keys-0" type="text" value="${keys[0]}"></div>
                    `);
                    $('#stock-table-values').append(`
                        <div><input id="table-values-0" type="text" value="${keys[1]}"></div>
                    `);
                    
                    for (let i = 0; i < json.length; i++){
                        $('#stock-table-keys').append(`
                            <div><input id="table-keys-${i+1}" type="text" value="${json[i][keys[0]]}"></div>
                        `);
                        $('#stock-table-values').append(`
                            <div><input id="table-values-${i+1}" type="text" value="${json[i][keys[1]]}"></div>
                        `);
                    }
                }
                else {
                    has_headers = data.lDescr.search('<thead') != -1 ? true : false;

                    $('#stock-excel-table').removeAttr('hidden');
                    $('#stock-excel-editor').addClass('selected');
                    $('#stock-ignore-table').removeClass('selected');
                    $('#table-mode').val('excel');

                    $('#csv').html(data.lDescrCSV);

                    // PREVIEW TABLE
                    let csv = $('#csv').html();
                    let json = CSVJSON.csv2json(csv, {parseNumbers: true});
                    let table = $('#resultTable');
                    table.html(json2rawhtml(json, has_headers));
        
                    document.querySelector('#has_headers').checked = has_headers;
                }
            }

            console.log('gergergegegegerg')
            $.ajax({
                url:  "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/distributor/accesories/fetchAccessories.php",
                type: "POST",
                data: {product_aid : consulta},
            })
            .done(function (response){
                console.log(JSON.parse(response));

                
                for(let accessory_array of Object.values(JSON.parse(response))){
                    money = accessory_array.currency == 'USD' ? '$' : accessory_array.currency == 'EUR' ? '€' : '';

                    $('#uploadAccesoryList').append(`
                        <div class="card accessoryTarget p-3" data-item="uploaded" data-id="${accessory_array.product_aid}">
                            <textarea type="hidden" class="json" hidden>${JSON.stringify(accessory_array)}</textarea>
                            <div class="accessoryPreview d-flex flex-row">
                                <img src="" width="150" style="background-color: white; background-image: url('${accessory_array.fileInput}'); background-size: contain; background-position: 50% 50%;">
                                <div class="ms-3">
                                    <h6>${accessory_array.name}</h6>
                                    <p><b>${alertsTranslations.textModel} </b> ${accessory_array.model}</p>
                                    <p><b>${alertsTranslations.textPrice} </b> ${accessory_array.price} ${money}</p>
                                </div>
                            </div>
                        </div>
                    `);
                    currentFileAccessories[accessory_array.product_aid] = accessory_array.fileInput;
                }

            })
            .fail(function (){

            })
        
        })
        .fail(function(){
            console.log('error');
        });
    }
    
});
