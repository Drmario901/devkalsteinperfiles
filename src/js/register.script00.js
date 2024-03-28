jQuery(document).ready(function($){

  
        const cookieLng = document.cookie
          .split("; ")
          .find((row) => row.startsWith("language="))
          .split("=")[1];
        let alertsTranslations = {};
      
        // cargar json de traducciones
        const loadTranslations = (lng) => {
          return fetch(
            `https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`
          )
            .then((response) => response.json())
            .then((translation) => {
              // save in a global variable
              alertsTranslations = translation;
            });
        };
      
        loadTranslations(cookieLng);

        const alerts = {
            de:[],
            ee:[],
            en:[],
            es:[],
            fr:[],
            it:[],
            nl:[],
            pl:[],
            pt:[],
            se:[],
       }
            

        

    $(document).on('change', '#countryUser', function(){
        searchCountryPrefijo($(this).val())
    })



    $(document).on('change', '#countryUserManu', function(){
        searchCountryPrefijo3($(this).val())
    })



    $(document).on('change', '#countryUser-soporte', function(){
        searchCountryPrefijo5($(this).val())
    })



    $(document).on('change', '#countryBusiness', function(){
        searchCountryPrefijo2($(this).val())
    })



    $(document).on('change', '#countryBusinessManu', function(){

        searchCountryPrefijo4($(this).val())

    })



    $(document).on('change', '#countryBusiness-soporte', function(){

        searchCountryPrefijo6($(this).val())

    })

    



    // Client Path Control



    $(document).on('click', '#btnNext1', function(){

        let cmb = $('#cmbPrimary').val()

        let nameUser = $('#nameUser').val()

        let lastnameUser = $('#lastnameUser').val()

        if (nameUser == ''){

            $('#nameUser').focus()

            $('#nameUser').css({'outline' : '2px solid #de3a46'})

        }else{

            if (lastnameUser == ''){

                $('#lastnameUser').focus()

                $('#lastnameUser').css({'outline' : '2px solid #de3a46'})

            }else{

                if (cmb == 0){

                    $('#cmbPrimary').focus()

                    $('#cmbPrimary').css({'outline' : '2px solid #de3a46'})

                    $('#cmbPrimary').css({'box-shadow' : 'unset 5px 5px #de3a46'})

                }else{

                    if ($('#cmbPrimary').val() == 1){

                        searchCountry('', ['countryUser', 'countryBusiness']);

                        $('.c-01').css({'display' : 'none'})

                        $('.c-client01').css({'display' : 'block'})

                    }else{

                        if ($('#cmbPrimary').val() == 2){

                            searchCountry('', ['countryUserManu', 'countryBusinessManu']);

                            $('.c-01').css({'display' : 'none'})

                            $('.c-manu01').css({'display' : 'block'})

                        }else{

                            if ($('#cmbPrimary').val() == 3){

                            }

                            else {

                                if ($('#cmbPrimary').val() == 5){

                                }else{

                                    if ($('#cmbPrimary').val() == 4){

                                        searchCountry('', ['countryUser-soporte', 'countryBusiness-soporte']);

                                        $('.c-01').css({'display' : 'none'})

                                        $('.c-soporte01').css({'display' : 'block'})

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    })



    $(document).on('click', '#btnPreviusClient1', function(){

        $('.c-client01').css({'display' : 'none'})

        $('.c-01').css({'display' : 'block'})

    })



    $(document).on('click', '#btnPreviusClient2', function(){

        $('.c-client02').css({'display' : 'none'})

        $('.c-client01').css({'display' : 'block'})

    })



    $(document).on('click', '#btnPreviusClient3', function(){

        $('.c-client03').css({'display' : 'none'})

        $('.c-client02').css({'display' : 'block'})

        $('#BusinessName').val('')

        $('#countryBusiness').val('')

        $('#stateBusiness').val('')

        $('#addressBusiness').val('')

        $('#zipcodeBusiness').val('')

        $('#phoneBusiness').val('')

        $('#websiteBusiness').val('')

        $('#imageTaxDocument').val('')

        $('#taxDocument').val('')

    })



    $(document).on('click', '#btnNextClient1', function(){

        let country = $('#countryUser').val()

        let state = $('#stateUser').val()

        let address = $('#addressUser').val()

        let zipcode = $('#zipcodeUser').val()

        let phone = $('#phoneUser').val()

        let imageDocument = $('#imageDocument').val()

        let idDocument = $('#identityPassport').val()



        if (country == 0){

            $('#countryUser').css({'outline' : '2px solid #de3a46'})

            $('#countryUser').focus()

        }else{

            if (state == ''){

                $('#stateUser').css({'outline' : '2px solid #de3a46'})

                $('#stateUser').focus()

            }else{

                if (address == ''){

                    $('#addressUser').css({'outline' : '2px solid #de3a46'})

                    $('#addressUser').focus()

                }else{

                    if (zipcode == ''){

                        $('#zipcodeUser').css({'outline' : '2px solid #de3a46'})

                        $('#zipcodeUser').focus()

                    }else{

                        if (phone == ''){

                            $('#phoneUser').css({'outline' : '2px solid #de3a46'})

                            $('#phoneUser').focus()

                        }else{

                            $('.c-client01').css({'display' : 'none'})

                            $('.c-client02').css({'display' : 'block'})

                        }

                    }

                }

            }

        }

    })



    $(document).on('click', '#btnNextClient2', function(){

        $('.c-client02').css({'display' : 'none'})

        $('.c-client03').css({'display' : 'block'})

    })



    $(document).on('change', '#question-business', function(){

        let valor = $(this).val()

        if (valor == 1){

            $('#c-optionsQuestionBusiness').css({'display' : 'flex'})

            $('.btnEndingClient').css({'display' : 'none'})

            $('#btnNextClient2').css({'display' : 'block'})

        }else{

            if (valor == 2){

                $('#c-optionsQuestionBusiness').css({'display' : 'none'})

                $('.progress-bar').css({'width' : '100%'})

                $('.btnEndingClient').css({'display' : 'block'})

                $('#btnNextClient2').css({'display' : 'none'})

                $('#jobRole').val(0)

            }else{

                if (valor == 0){

                    $('#c-optionsQuestionBusiness').css({'display' : 'none'})

                    $('.btnEndingClient').css({'display' : 'none'})

                    $('#btnNextClient2').css({'display' : 'block'})

                    $('#jobRole').val(0)

                }

            }

        }

    })



    $(document).on('click', '#btnEndingClient', function(){

        let nameB = $('#BusinessName').val()

        let countryB = $('#countryBusiness').val()

        let stateB = $('#stateBusiness').val()

        let addressB = $('#addressBusiness').val()

        let zipcodeB = $('#zipcodeBusiness').val()

        let phoneB = $('#phoneBusiness').val()

        let websiteB = $('#websiteBusiness').val()

        let nameUser = $('#nameUser').val()

        let lastnameUser = $('#lastnameUser').val()

        let countryUser = $('#countryUser').val()

        let stateUser = $('#stateUser').val()

        let addressUser = $('#addressUser').val()

        let zipcodeUser = $('#zipcodeUser').val()

        let phoneUser = $('#phoneUser').val()

        let jobRole = $('#jobRole').val()        

        let imageDocument = $('#imageDocument')[0].files[0]

        let idDocument = $('#identityPassport').val()        

        let imageTaxDocument = $('#imageTaxDocument')[0].files[0]

        let taxDocument = $('#taxDocument').val()

        let paisesPrefijos = $('#paisesPrefijos').text()

        let numberPhoneUser = paisesPrefijos+''+phoneUser

        let paisesPrefijos2 = $('#paisesPrefijos2').text()

        let numberBussines = paisesPrefijos2+''+phoneB



        if (jobRole == 0){

           
            console.log('country',countryUser);
            
            // savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, numberBussines, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, numberPhoneUser, jobRole, '1', idDocument, imageDocument, taxDocument, imageTaxDocument)

            // alert('primeroo');
            // console.log('primerooo')
            // const botonFinalizar = document.getElementById('btnEndingClient')
            // botonFinalizar.addEventListener('click', function(){
            //     alert('Cargando...')
            //     botonFinalizar.disabled = true;
            // })

           
            alert('activando');
            
            // Actualiza el botón para incluir el spinner y cambia el texto
            // $(this).prop('disabled', true);
            // $(this).html('<div class="spinner"></div>');
            
            // Simula una operación asíncrona con setTimeout
            // setTimeout(() => {
            //     $(this).html('Finalizar'); // Restablece el texto original del botón
            //     $(this).prop('disabled', false); // Reactiva el botón
            // }, 3000);

        }else{

            if (nameB == ''){

                $('#BusinessName').css({'outline' : '2px solid #de3a46'})

                $('#BusinessName').focus()

            }else{

                if (taxDocument == ''){

                    $('#taxDocument').css({'outline' : '2px solid #de3a46'})

                    $('#taxDocument').focus()

                }else{

                    if (imageTaxDocument == ''){

                        $('#imageTaxDocument').css({'outline' : '2px solid #de3a46'})

                        $('#imageTaxDocument').focus()

                   }else{

                        if (countryB == 0){

                            $('#countryBusiness').css({'outline' : '2px solid #de3a46'})

                            $('#countryBusiness').focus()

                        }else{

                            if (stateB == ''){

                                $('#stateBusiness').css({'outline' : '2px solid #de3a46'})

                                $('#stateBusiness').focus()

                            }else{

                                if (addressB == ''){

                                    $('#addressBusiness').css({'outline' : '2px solid #de3a46'})

                                    $('#addressBusiness').focus()

                                }else{

                                    if (zipcodeB == ''){

                                        $('#zipcodeBusiness').css({'outline' : '2px solid #de3a46'})

                                        $('#zipcodeBusiness').focus()

                                    }else{

                                        if (phoneB == ''){

                                            $('#phoneBusiness').css({'outline' : '2px solid #de3a46'})

                                            $('#phoneBusiness').focus()

                                        }else{

                                            if (websiteB == ''){

                                                $('#websiteBusiness').css({'outline' : '2px solid #de3a46'})

                                                $('#websiteBusiness').focus()

                                            }else{
                                                $(this).prop('disabled', true);
                                                $(this).html('<div class="spinner"></div>');
                                                savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, numberBussines, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, numberPhoneUser, jobRole, '1', idDocument, imageDocument, taxDocument, imageTaxDocument)

                                                alert('holaaa');
                                                console.log('holaaa');
                                                

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    })



    // Manufacturer Path Control



    $(document).on('click', '#btnPreviousManu1', function(){

        $('.c-manu01').css({'display' : 'none'});

        $('.c-01').css({'display' : 'block'});

    })



    $(document).on('click', '#btnPreviusManu2', function(){

        $('.c-manu02').css({'display' : 'none'});

        $('.c-manu01').css({'display' : 'block'});

    })



    $(document).on('click', '#btnPreviusManu3', function(){

        $('.c-manu03').css({'display' : 'none'});

        $('.c-manu02').css({'display' : 'block'});

    })



    $(document).on('click', '#btnNextManu1', function(){

        let country = $('#countryUserManu').val();

        let state = $('#stateUserManu').val();

        let address = $('#addressUserManu').val();

        let zipcode = $('#zipcodeUserManu').val();

        let phone = $('#phoneUserManu').val();

        let jobRole = $('#jobRoleManu').val();        

        let imageDocument = $('#imageDocumentManu').val()

        let idDocument = $('#identityPassportManu').val()



        if (idDocument == ''){

            $('#identityPassportManu').css({'outline' : '2px solid #de3a46'})

            $('#identityPassportManu').focus()

        }else{

            if (imageDocument == ''){

                $('#imageDocumentManu').css({'outline' : '2px solid #de3a46'})

                $('#imageDocumentManu').focus()

           }else{

                if (country == 0){

                    $('#countryUserManu').css({'outline' : '2px solid #de3a46'})

                    $('#countryUserManu').focus()

                }else{

                    if (state == ''){

                        $('#stateUserManu').css({'outline' : '2px solid #de3a46'})

                        $('#stateUserManu').focus()

                    }else{

                        if (address == ''){

                            $('#addressUserManu').css({'outline' : '2px solid #de3a46'})

                            $('#addressUserManu').focus()

                        }else{

                            if (zipcode == ''){

                                $('#zipcodeUserManu').css({'outline' : '2px solid #de3a46'})

                                $('#zipcodeUserManu').focus()

                            }else{

                                if (phone == ''){

                                    $('#phoneUserManu').css({'outline' : '2px solid #de3a46'})

                                    $('#phoneUserManu').focus()

                                }else{

                                    $('.c-manu01').css({'display' : 'none'})

                                    $('.c-manu02').css({'display' : 'block'})

                                }

                            }

                        }

                    }

                }

            }

        }

    });



    $(document).on('click', '#btnNextManu2', function(){

        

        profileRole = $('#profileRole').val();



        if(profileRole === '0'){

            $('#profileRole').css({'outline' : '2px solid #de3a46'});

            $('#profileRole').focus();

        }

        else {

            $('.c-manu02').css({'display' : 'none'});

            $('.c-manu03').css({'display' : 'block'});

        }

    })



    $(document).on('click', '#btnPrevius-soporte1', function(){

        $('.c-soporte01').css({'display' : 'none'});

        $('.c-01').css({'display' : 'block'});

    })



    $(document).on('click', '#btnPrevius-soporte2', function(){

        $('.c-soporte02').css({'display' : 'none'});

        $('.c-soporte01').css({'display' : 'block'});

    })



    $(document).on('click', '#btnNext-soporte1', function(){

        let country = $('#countryUser-soporte').val();

        let state = $('#stateUser-soporte').val();

        let address = $('#addressUser-soporte').val();

        let zipcode = $('#zipcodeUser-soporte').val();

        let phone = $('#phoneUser-soporte').val();

        let jobRole = $('#jobRole-soporte').val();        

        let imageDocument = $('#imageDocument-soporte').val()

        let idDocument = $('#identityPassport-soporte').val()



        if (idDocument == ''){

            $('#identityPassport-soporte').css({'outline' : '2px solid #de3a46'})

            $('#identityPassport-soporte').focus()

        }else{

            if (imageDocument == ''){

                $('#imageDocument-soporte').css({'outline' : '2px solid #de3a46'})

                $('#imageDocument-soporte').focus()

           }else{

                if (country == 0){

                    $('#countryUser-soporte').css({'outline' : '2px solid #de3a46'})

                    $('#countryUser-soporte').focus()

                }else{

                    if (state == ''){

                        $('#stateUser-soporte').css({'outline' : '2px solid #de3a46'})

                        $('#stateUser-soporte').focus()

                    }else{

                        if (address == ''){

                            $('#addressUser-soporte').css({'outline' : '2px solid #de3a46'})

                            $('#addressUser-soporte').focus()

                        }else{

                            if (zipcode == ''){

                                $('#zipcodeUser-soporte').css({'outline' : '2px solid #de3a46'})

                                $('#zipcodeUser-soporte').focus()

                            }else{

                                if (phone == ''){

                                    $('#phoneUser-soporte').css({'outline' : '2px solid #de3a46'})

                                    $('#phoneUser-soporte').focus()

                                }else{

                                    $('.c-soporte01').css({'display' : 'none'})

                                    $('.c-soporte02').css({'display' : 'block'})

                                }

                            }

                        }

                    }

                }

            }

        }

    });



    $(document).on('click', '#btnNextManu2', function(){

        

        profileRole = $('#profileRole').val();



        if(profileRole === '0'){

            $('#profileRole').css({'outline' : '2px solid #de3a46'});

            $('#profileRole').focus();

        }

        else {

            $('.c-manu02').css({'display' : 'none'});

            $('.c-manu03').css({'display' : 'block'});

        }

    })



    $(document).on('click', '#btnEndingManu', function(){

        let nameB = $('#BusinessNameManu').val()

        let countryB = $('#countryBusinessManu').val()

        let stateB = $('#stateBusinessManu').val()

        let addressB = $('#addressBusinessManu').val()

        let zipcodeB = $('#zipcodeBusinessManu').val()

        let phoneB = $('#phoneBusinessManu').val()

        let websiteB = $('#websiteBusinessManu').val()

        let nameUser = $('#nameUser').val()

        let lastnameUser = $('#lastnameUser').val()

        let countryUser = $('#countryUserManu').val()

        let stateUser = $('#stateUserManu').val()

        let addressUser = $('#addressUserManu').val()

        let zipcodeUser = $('#zipcodeUserManu').val()

        let phoneUser = $('#phoneUserManu').val()

        let jobRole = $('#jobRoleManu').val()

        let imageDocument = $('#imageDocumentManu')[0].files[0]

        let idDocument = $('#identityPassportManu').val()        

        let imageTaxDocument = $('#imageTaxDocumentManu')[0].files[0]

        let taxDocument = $('#taxDocumentManu').val()

        let paisesPrefijos = $('#paisesPrefijos3').text()

        let numberPhoneUser = paisesPrefijos+''+phoneUser

        let paisesPrefijos2 = $('#paisesPrefijos4').text()

        let numberBussines = paisesPrefijos2+''+phoneB

        

        let profileRole = $('#profileRole').val();



        if (jobRole == 0){
            // console.log('alerta');
            // window.alert('alertaa')
            $(this).prop('disabled', true);
            $(this).html('<div class="spinner"></div>');
            savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, numberBussines, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, numberPhoneUser, jobRole, profileRole, idDocument, imageDocument, taxDocument, imageTaxDocument)

        }else{

            if (imageTaxDocument == ''){

                $('#imageTaxDocumentManu').css({'outline' : '2px solid #de3a46'})

                $('#imageTaxDocumentManu').focus()

           }else{

                if (countryB == 0){

                    $('#countryBusinessManu').css({'outline' : '2px solid #de3a46'})

                    $('#countryBusinessManu').focus()

                }else{

                    if (stateB == ''){

                        $('#stateBusinessManu').css({'outline' : '2px solid #de3a46'})

                        $('#stateBusinessManu').focus()

                    }else{

                        if (addressB == ''){

                            $('#addressBusinessManu').css({'outline' : '2px solid #de3a46'})

                            $('#addressBusinessManu').focus()

                        }else{

                            if (zipcodeB == ''){

                                $('#zipcodeBusinessManu').css({'outline' : '2px solid #de3a46'})

                                $('#zipcodeBusinessManu').focus()

                            }else{

                                if (phoneB == ''){

                                    $('#phoneBusinessManu').css({'outline' : '2px solid #de3a46'})

                                    $('#phoneBusinessManu').focus()

                                }else{

                                    if (websiteB == ''){

                                        $('#websiteBusinessManu').css({'outline' : '2px solid #de3a46'})

                                        $('#websiteBusinessManu').focus()

                                    }else{
                                        // console.log('alerta 2');
                                        // window.alert('alertaa 222')
                                        $(this).prop('disabled', true);
                                        $(this).html('<div class="spinner"></div>');
                                        savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, numberBussines, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, numberPhoneUser, jobRole, profileRole, idDocument, imageDocument, taxDocument, imageTaxDocument)

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    })



    $(document).on('click', '#btnEnding-soporte', function(){

        let nameB = $('#BusinessName-soporte').val()

        let countryB = $('#countryBusiness-soporte').val()

        let stateB = $('#stateBusiness-soporte').val()

        let addressB = $('#addressBusiness-soporte').val()

        let zipcodeB = $('#zipcodeBusiness-soporte').val()

        let phoneB = $('#phoneBusiness-soporte').val()

        let websiteB = $('#websiteBusiness-soporte').val()

        let nameUser = $('#nameUser').val()

        let lastnameUser = $('#lastnameUser').val()

        let countryUser = $('#countryUser-soporte').val()

        let stateUser = $('#stateUser-soporte').val()

        let addressUser = $('#addressUser-soporte').val()

        let zipcodeUser = $('#zipcodeUser-soporte').val()

        let phoneUser = $('#phoneUser-soporte').val()

        let jobRole = $('#jobRole-soporte').val()

        let imageDocument = $('#imageDocument-soporte')[0].files[0]

        let idDocument = $('#identityPassport-soporte').val()        

        let imageTaxDocument = $('#imageTaxDocument-soporte')[0].files[0]

        let taxDocument = $('#taxDocument-soporte').val()

        let paisesPrefijos = $('#paisesPrefijos5').text()

        let numberPhoneUser = paisesPrefijos+''+phoneUser

        let paisesPrefijos2 = $('#paisesPrefijos6').text()

        let numberBussines = paisesPrefijos2+''+phoneB

        

        let profileRole = 4



        if (jobRole == 0){
            $(this).prop('disabled', true);
            $(this).html('<div class="spinner"></div>');
            savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, numberBussines, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, numberPhoneUser, jobRole, profileRole, idDocument, imageDocument, taxDocument, imageTaxDocument)

        }else{

            if (nameB == ''){

                $('#BusinessName-soporte').css({'outline' : '2px solid #de3a46'})

                $('#BusinessName-soporte').focus()

            }else{

                if (taxDocument == ''){

                    $('#taxDocument-soporte').css({'outline' : '2px solid #de3a46'})

                    $('#taxDocument-soporte').focus()

                }else{

                    if (imageTaxDocument == ''){

                        $('#imageTaxDocument-soporte').css({'outline' : '2px solid #de3a46'})

                        $('#imageTaxDocument-soporte').focus()

                   }else{

                        if (countryB == 0){

                            $('#countryBusiness-soporte').css({'outline' : '2px solid #de3a46'})

                            $('#countryBusiness-soporte').focus()

                        }else{

                            if (stateB == ''){

                                $('#stateBusiness-soporte').css({'outline' : '2px solid #de3a46'})

                                $('#stateBusiness-soporte').focus()

                            }else{

                                if (addressB == ''){

                                    $('#addressBusiness-soporte').css({'outline' : '2px solid #de3a46'})

                                    $('#addressBusiness-soporte').focus()

                                }else{

                                    if (zipcodeB == ''){

                                        $('#zipcodeBusiness-soporte').css({'outline' : '2px solid #de3a46'})

                                        $('#zipcodeBusiness-soporte').focus()

                                    }else{

                                        if (phoneB == ''){

                                            $('#phoneBusiness-soporte').css({'outline' : '2px solid #de3a46'})

                                            $('#phoneBusiness-soporte').focus()

                                        }else{

                                            if (websiteB == ''){

                                                $('#websiteBusiness-soporte').css({'outline' : '2px solid #de3a46'})

                                                $('#websiteBusiness-soporte').focus()

                                            }else{
                                                $(this).prop('disabled', true);
                                                $(this).html('<div class="spinner"></div>');
                                                savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, numberBussines, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, numberPhoneUser, jobRole, profileRole, idDocument, imageDocument, taxDocument, imageTaxDocument)

                                            }

                                        }

                                    }

                                }

                            }

                        }

                    }

                }

            }

        }

    })



    // form styling control



    $(document).on('click', '#question-business', function(){

        $(this).css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#cmbPrimary', function(){

        $('#cmbPrimary').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#nameUser', function(){

        $('#nameUser').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#lastnameUser', function(){

        $('#lastnameUser').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#countryUser', function(){

        $('#countryUser').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#countryUserManu', function(){

        $('#countryUserManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#countryUser-soporte', function(){

        $('#countryUser-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#countryBusiness', function(){

        $('#countryBusiness').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#countryBusinessManu', function(){

        $('#countryBusinessManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#countryBusiness-soporte', function(){

        $('#countryBusiness-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#imageDocument', function(){

        $('#imageDocument').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#imageDocumentManu', function(){

        $('#imageDocumentManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#imageDocument-soporte', function(){

        $('#imageDocument-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#imageTaxDocument', function(){

        $('#imageDocument').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#imageTaxDocumentManu', function(){

        $('#imageDocumentManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('click', '#imageTaxDocument-soporte', function(){

        $('#imageDocument-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#stateUser', function(){

        $('#stateUser').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#stateUserManu', function(){

        $('#stateUserManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#stateUser-soporte', function(){

        $('#stateUser-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#identityPassport', function(){

        $('#identityPassport').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#identityPassportManu', function(){

        $('#identityPassportManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#identityPassport-soporte', function(){

        $('#identityPassport-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#addressUser', function(){

        $('#addressUser').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#addressUserManu', function(){

        $('#addressUserManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#addressUser-soporte', function(){

        $('#addressUser-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#zipcodeUser', function(){

        $('#zipcodeUser').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#zipcodeUserManu', function(){

        $('#zipcodeUserManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#zipcodeUser-soporte', function(){

        $('#zipcodeUser-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#phoneUser', function(){

        $('#phoneUser').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#phoneUserManu', function(){

        $('#phoneUserManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#phoneUser-soporte', function(){

        $('#phoneUser-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#BusinessName', function(){

        $('#BusinessName').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#BusinessNameManu', function(){

        $('#BusinessNameManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#BusinessNameManu-soporte', function(){

        $('#BusinessNameManu-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#stateBusiness', function(){

        $('#stateBusiness').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#stateBusinessManu', function(){

        $('#stateBusinessManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#stateBusiness-soporte', function(){

        $('#stateBusiness-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#addressBusiness', function(){

        $('#addressBusiness').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#addressBusinessManu', function(){

        $('#addressBusinessManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#addressBusiness-soporte', function(){

        $('#addressBusiness-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#zipcodeBusiness', function(){

        $('#zipcodeBusiness').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#zipcodeBusinessManu', function(){

        $('#zipcodeBusinessManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#zipcodeBusiness-soporte', function(){

        $('#zipcodeBusiness-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#phoneBusiness', function(){

        $('#phoneBusiness').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#phoneBusinessManu', function(){

        $('#phoneBusinessManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#phoneBusiness-soporte', function(){

        $('#phoneBusiness-soporte').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#websiteBusiness', function(){

        $('#websiteBusiness').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#websiteBusinessManu', function(){

        $('#websiteBusinessManu').css({'outline' : '1px solid #213280'})

    })



    $(document).on('keyup', '#websiteBusiness-soporte', function(){

        $('#websiteBusiness-soporte').css({'outline' : '1px solid #213280'})

    })



    function searchCountry(consulta, fields){

        $.ajax({
            url: plugin_dir + '/php/searchCountry.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(fields)
            for (let field of fields){
                $('#' + field).html(respuesta);
            }
        })
        .fail(function(){
            console.log("error");
        })
    }



    function savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole, profileRole, idDocument, imageDocument, taxDocument, imageTaxDocument){

        var formData = new FormData() 

        formData.append('nameB', nameB)

        formData.append('countryB', countryB)

        formData.append('stateB', stateB)

        formData.append('addressB', addressB)

        formData.append('zipcodeB', zipcodeB)

        formData.append('phoneB', phoneB)

        formData.append('websiteB', websiteB)

        formData.append('nameUser', nameUser)

        formData.append('lastnameUser', lastnameUser)

        formData.append('countryUser', countryUser)

        formData.append('stateUser', stateUser)

        formData.append('addressUser', addressUser)

        formData.append('zipcodeUser', zipcodeUser)

        formData.append('phoneUser', phoneUser)

        formData.append('jobRole', jobRole)

        formData.append('profileRole', profileRole)

        formData.append('idDocument', idDocument)

        formData.append('imageDocument', imageDocument)

        formData.append('taxDocument', taxDocument)

        formData.append('imageTaxDocument', imageTaxDocument)



        $.ajax({

            contentType: "multipart/form-data",

			url: plugin_dir + "/php/savedInfoClient.php",

			type: "POST",

			data: formData,

			dataType: "text",

			processData: false,

			contentType: false,

			cache: false,

        })

        .done(function(respuesta){

            console.log(respuesta)            

            let data = JSON.parse(respuesta)
                console.log('la data', data.profileRole);
                
            if(data.profileRole != 1){
                console.log('redireccionando...');
                
                alert(alertsTranslations.verficacion48horas);
                window.location.href = "https://dev.kalstein.plus/plataforma/acceder/";
                
            } else {
                if (data.update === 'correcto'){
                    sendCodeDiscount()
                    if($('#search-product').val() != ''){
                        $(location).attr('href', domain + '/account_redirect/?search='+$('#search-product').val())
                    }
                    else {
                        $(location).attr('href', domain + '/account_redirect/')
                    }
                }else{  
                    console.log("error")
                }
            }
        })

        .fail(function(error){

            console.log("error", error)

        })

    }

    function sendCodeDiscount(consulta){

        $.ajax({
            url: plugin_dir + '/php/firstDiscount.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            
        })

        .fail(function(){
            console.log("error");

        })

    }

    function searchCountryPrefijo(country){



        $.ajax({

            url: plugin_dir + '/php/searchCountryPrefijo.php',

            type: 'POST',

            data: {country},

        })

        .done(function(respuesta){

            console.log(respuesta)            

            let data = JSON.parse(respuesta)

            $('#paisesPrefijos').text(data.prefijo)

        })

        .fail(function(){

            console.log("error")

        })

    }



    function searchCountryPrefijo2(country){



        $.ajax({

            url: plugin_dir + '/php/searchCountryPrefijo.php',

            type: 'POST',

            data: {country},

        })

        .done(function(respuesta){

            console.log(respuesta)            

            let data = JSON.parse(respuesta)

            $('#paisesPrefijos2').text(data.prefijo)

        })

        .fail(function(){

            console.log("error")

        })

    }



    function searchCountryPrefijo3(country){



        $.ajax({

            url: plugin_dir + '/php/searchCountryPrefijo.php',

            type: 'POST',

            data: {country},

        })

        .done(function(respuesta){

            console.log(respuesta)            

            let data = JSON.parse(respuesta)

            $('#paisesPrefijos3').text(data.prefijo)

        })

        .fail(function(){

            console.log("error")

        })

    }



    function searchCountryPrefijo4(country){



        $.ajax({

            url: plugin_dir + '/php/searchCountryPrefijo.php',

            type: 'POST',

            data: {country},

        })

        .done(function(respuesta){

            console.log(respuesta)            

            let data = JSON.parse(respuesta)

            $('#paisesPrefijos4').text(data.prefijo)

        })

        .fail(function(){

            console.log("error")

        })

    }



    function searchCountryPrefijo5(country){



        $.ajax({

            url: plugin_dir + '/php/searchCountryPrefijo.php',

            type: 'POST',

            data: {country},

        })

        .done(function(respuesta){

            console.log(respuesta)            

            let data = JSON.parse(respuesta)

            $('#paisesPrefijos5').text(data.prefijo)

        })

        .fail(function(){

            console.log("error")

        })

    }



    function searchCountryPrefijo6(country){



        $.ajax({

            url: plugin_dir + '/php/searchCountryPrefijo.php',

            type: 'POST',

            data: {country},

        })

        .done(function(respuesta){

            console.log(respuesta)            

            let data = JSON.parse(respuesta)

            $('#paisesPrefijos6').text(data.prefijo)

        })

        .fail(function(){

            console.log("error")

        })

    }



    const dropContainer = document.getElementById("dropcontainer");

    const fileInput = document.getElementById("images");



    dropContainer.addEventListener("dragover", (e) => {

        // prevent default to allow drop

        e.preventDefault();

    }, false)



    dropContainer.addEventListener("dragenter", () => {

        dropContainer.classList.add("drag-active");

    })



    dropContainer.addEventListener("dragleave", () => {

        dropContainer.classList.remove("drag-active");

    })



    dropContainer.addEventListener("drop", (e) => {

        e.preventDefault();

        dropContainer.classList.remove("drag-active");

        fileInput.files = e.dataTransfer.files;

    })

})