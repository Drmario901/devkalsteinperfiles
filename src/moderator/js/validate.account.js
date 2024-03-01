var verify = false;

var plugin_dir = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/';

jQuery(document).ready(function($){

    // actualizacion de boton
    ids = [
        'nombre',
        'passport',
        'name-b',
        'country-b',
        'zipcode-b',
        'adress-b',
        'phone-b',
        'web-b',
        'rif-b'
    ]

    checks = [];

    for (id of ids){
        checks.push(false);
    }

    for (let i = 0; i < ids.length; i++){
        
        let id = ids[i];

        $(document).on('change', '#'+id, function (){
            console.log('aaa');
            checks[i] = this.checked;

            if(!this.checked){
                
                verify = false;
                $('#message').removeAttr('hidden');
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
                    $('#btnValidate').html(`
                        <button type='button' class='btn btn-info btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">Verify</h4>
                        </button>
                    `);
                }
                else{

                    verify = false;
                    $('#message').removeAttr('hidden');
                    $('#btnValidate').html(`
                        <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">Denegate</h4>
                        </button>
                    `);
                }
            }
        });
    }
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
                message: 'Are you sure you want <b>validate</b> this account?',
                position: 'center',
                buttons: [
                ['<button><b>Yes</b></button>', function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                    let acc_id = $('#acc_id').val();
                    let email = $('#e-mail').val();


                    $.ajax({
                        url: plugin_dir + 'php/validateAcc.php',
                        type: 'POST',
                        data: {acc_id, email},
                    })
                    .done(function (response){
                        console.log(response);
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
                                window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/moderator/accounts';
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
                    message: 'Are you sure you want <b>deny</b> this account?',
                    position: 'center',
                    buttons: [
                        ['<button><b>Yes</b></button>', function(instance, toast) {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');

                            let acc_id = $('#acc_id').val();
                            let email = $('#e-mail').val();
                            let msg = $("#message").val();

                            $.ajax({
                                url: plugin_dir + 'php/denegateAcc.php',
                                type: 'POST',
                                data: {acc_id, email, msg},
                            })
                            .done(function (response){
                                console.log(response);
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
                                        window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/moderator/accounts';
                                    }
                                    else{
                                        iziToast.error({
                                            overlay: true,
                                            title: 'Error',
                                            message: 'Error trying to access user!',
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

});

jQuery(document).ready(function($){
    $('account')
});