var verify = false;

var plugin_dir = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/';

jQuery(document).ready(function($){

    // actualizacion de boton
    ids = [
        'name',
        'model',
        'promotions-i',
        'quality-i',
        'professionalism-i',
        'accessories',
        'category',
        'brand',
        'promotions-d',
        'professionalism-d',
        'measures',
        'measures-p',
        'catalog',
        'manual',
        'wholesale'
    ]

    checks = [];

    for (id of ids){
        checks.push(false);
    }

    for (let i = 0; i < ids.length; i++){
        
        let id = ids[i];

        checks[i] = document.querySelector('#'+id).checked;

        $(document).on('change', '#'+id, function (){
            checks[i] = this.checked;

            if(!this.checked){
                
                verify = false;
                $('#message').removeAttr('hidden');
                $('#strikeContainer').removeAttr('hidden');
                $('#btnValidate').html(`
                    <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                        <h4 class="text-white pb-0">Denegate</h4>
                    </button>
                `);
            }
            else{
                let green = true;

                for (check of checks){
                    if (!check){
                        green = false;
                        break;
                    }
                }

                if (green){

                    verify = true;
                    $('#message').attr('hidden', '');
                    $('#strikeContainer').attr('hidden', '');
                    $('#btnValidate').html(`
                        <button type='button' class='btn btn-info btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">Verify</h4>
                        </button>
                    `);
                }
                else{

                    verify = false;
                    $('#message').removeAttr('hidden');
                    $('#strikeContainer').removeAttr('hidden');
                    $('#btnValidate').html(`
                        <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">Denegate</h4>
                        </button>
                    `);
                }
            }
        });
    }

    // subida de productos

});

jQuery(document).ready(function($){
    $(document).on('click', '#btnValidate', function (){
        if(verify){
            iziToast.question({
                timeout: false,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Confirmation',
                message: 'Are you sure you want <b>validate</b> this product?',
                position: 'center',
                buttons: [
                ['<button><b>Yes</b></button>', function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    let p_id = $('#p-id').val();

                    $.ajax({
                        url: plugin_dir + 'php/validateProduct.php',
                        type: 'POST',
                        data: {p_id},
                    })
                    .done(function (response){
                        if (JSON.parse(response).status == 'busy'){
                            iziToast.error({
                                overlay: true,
                                title: 'Error',
                                message: 'Another moderator has already done this action!',
                                position: 'center'
                            });
                        }
                        else{
                            if(JSON.parse(response).status == 'correcto'){

                                iziToast.success({
                                    overlay: true,
                                    title: 'Success',
                                    message: 'Validate successful!',
                                    position: 'center',
                                });
                                window.location.href = 'https://plataforma.kalstein.net/index.php/moderator/products';
                            }
                            else{
                                iziToast.error({
                                    overlay: true,
                                    title: 'Error',
                                    message: 'Error trying to validate user!',
                                    position: 'center'
                                });
                            }
                        }
                    })
                    .fail(function (){
                        iziToast.error({
                            overlay: true,
                            title: 'Error',
                            message: 'Unable to connect whit the database!',
                            position: 'center'
                        });
                    });
                }, true],
                ['<button>No</button>', function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }]
                ],
            });
        }
        else{

            if ($("#message").val() != ''){

                iziToast.question({
                    timeout: false,
                    close: false,
                    overlay: true,
                    displayMode: 'once',
                    id: 'question',
                    zindex: 999,
                    title: 'Confirmation',
                    message: 'Are you sure you want <b>deny</b> this product?',
                    position: 'center',
                    buttons: [
                        ['<button><b>Yes</b></button>', function(instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            
                            let p_id = $('#p-id').val();
                            let msg = $("#message").val();
                            let strike = document.querySelector("#strike").checked;

                            $.ajax({
                                url: plugin_dir + 'php/denegateProduct.php',
                                type: 'POST',
                                data: {p_id, msg, strike},
                            })
                            .done(function (response){
                                console.log(response)
                                if (JSON.parse(response).status == 'busy'){
                                    iziToast.error({
                                        overlay: true,
                                        title: 'Error',
                                        message: 'Another moderator has already done this action!',
                                        position: 'center'
                                    });
                                }
                                else{

                                    if(JSON.parse(response).status == 'correcto'){
    
                                        iziToast.success({
                                            overlay: true,
                                            title: 'Success',
                                            message: 'Message sent successful!',
                                            position: 'center',
                                        });
                                        window.location.href = 'https://plataforma.kalstein.net/index.php/moderator/products';
                                    }
                                    else{
                                        iziToast.error({
                                            overlay: true,
                                            title: 'Error',
                                            message: 'Error trying to send message!',
                                            position: 'center'
                                        });
                                    }

                                }
                            })
                            .fail(function (){
                                iziToast.error({
                                    overlay: true,
                                    title: 'Error',
                                    message: 'Unable to connect whit the database!',
                                    position: 'center'
                                });
                            });
                        }, true],
                        ['<button>No</button>', function(instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        }]
                    ],
                });
            }
            else {
                iziToast.error({
                    overlay: true,
                    title: 'Warning',
                    message: 'Specify in the text field the reasons of the deny!',
                    position: 'center',
                });
            }
        }
    });

    $(document).on('click', '.btn-view-accessory', function() {

        var quote_id = $(this).data().id;
        console.log(quote_id)

        $.ajax({
            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/manufacturer/getAccessoryInfo.php',
            method: 'POST', 
            data: {quote_id}
        })
        .done(function (response){

            console.log(response);

            let res = JSON.parse(response);

            res.forEach(elem => {
                productName = elem.product_name;
                productModel = elem.product_model;
                product_description = elem.product_description;
                productImage = elem.product_image;
                product_price = elem.product_price;
                
                var details = 'Nombre del producto: ' + productName + '<br>' +
                              'Modelo del producto: ' + productModel + '<br>' +
                              'Descripción: ' + product_description + '<br>' +
                              'Precio: USD ' + product_price + '<br>' +
                              'Imagen: <img style="max-width: 200px;" src="' + productImage + '">';
      
                iziToast.show({
                    title: 'Detalles',
                    message: details,
                    position: 'center',
                    timeout: false,
                    closeOnClick: true,
                    progressBar: false
                })
            })
        })
        .fail(function(){
            iziToast.error({
                title: 'Error',
                message: "No se pueden obtener datos de la base de datos",
                position: 'center',
                timeout: false,
                closeOnClick: true,
                progressBar: false
            })
        })
    })
});