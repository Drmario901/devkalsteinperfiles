jQuery(document).ready(function($){
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
                        searchCountry()
                        $('.c-01').css({'display' : 'none'})
                        $('.c-client01').css({'display' : 'block'})
                    }else{
                        if ($('#cmbPrimary').val() == 2){

                        }else{
                            if ($('#cmbPrimary').val() == 3){

                            }else{
                                if ($('#cmbPrimary').val() == 4){

                                    $('.c-01').css({'display' : 'none'})
                                    $('.c-soporte01').css({'display' : 'block'})

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
    })

    $(document).on('click', '#btnNextClient1', function(){
        let country = $('#countryUser').val()
        let state = $('#stateUser').val()
        let address = $('#addressUser').val()
        let zipcode = $('#zipcodeUser').val()
        let phone = $('#phoneUser').val()

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
            $('#c-optionsQuestionBusiness').css({'display' : 'block'})
            $('.btnEndingClient').css({'display' : 'none'})
            $('#btnNextClient2').css({'display' : 'block'})
        }else{
            if (valor == 2){
                $('#c-optionsQuestionBusiness').css({'display' : 'none'})
                $('.progress-bar').css({'width' : '100%'})
                $('.btnEndingClient').css({'display' : 'block'})
                $('#btnNextClient2').css({'display' : 'none'})
            }else{
                if (valor == 0){
                    $('#c-optionsQuestionBusiness').css({'display' : 'none'})
                    $('.btnEndingClient').css({'display' : 'block'})
                    $('#btnNextClient2').css({'display' : 'none'})
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

        if (jobRole == 0){
            savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole)
         }else{
            if (nameB == ''){
                $('#BusinessName').css({'outline' : '2px solid #de3a46'})
                $('#BusinessName').focus()
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
                                        savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole)
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    })

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

    $(document).on('click', '#countryBusiness', function(){
        $('#countryBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#stateUser', function(){
        $('#stateUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#addressUser', function(){
        $('#addressUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#zipcodeUser', function(){
        $('#zipcodeUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#phoneUser', function(){
        $('#phoneUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#BusinessName', function(){
        $('#BusinessName').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#stateBusiness', function(){
        $('#stateBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#addressBusiness', function(){
        $('#addressBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#zipcodeBusiness', function(){
        $('#zipcodeBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#phoneBusiness', function(){
        $('#phoneBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#websiteBusiness', function(){
        $('#websiteBusiness').css({'outline' : '1px solid #213280'})
    })

    function searchCountry(consulta){

        $.ajax({
            url: 'https://kalstein.co.ve/wp-content/plugins/kalsteinPerfiles/php/searchCountry.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)
            $('#countryUser').html(respuesta)
            $('#countryBusiness').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        })
    }

    function savedInformationClientN(nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole){

        $.ajax({
            url: 'https://kalstein.co.ve/wp-content/plugins/kalsteinPerfiles/php/savedInfoClient.php',
            type: 'POST',
            data: {nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole},
        })
        .done(function(respuesta){
            console.log(respuesta)            
            let data = JSON.parse(respuesta)
            if (data.update === 'correcto'){
                $(location).attr('href','https://kalstein.co.ve/dashboard/')
            }else{
                console.log("error")
            }
        })
        .fail(function(){
            console.log("error")
        })
    }

    $(document).on('click', '#btnPreviussoporte1', function(){
        $('.c-suporte01').css({'display' : 'none'})
        $('.c-01').css({'display' : 'block'})
    })

    $(document).on('click', '#btnPreviussoporte2', function(){
        $('.c-soporte02').css({'display' : 'none'})
        $('.c-suporte01').css({'display' : 'block'})
    })

    $(document).on('click', '#btnPreviussoporte3', function(){
        $('.c-soporte03').css({'display' : 'none'})
        $('.c-soporte02').css({'display' : 'block'})
    })

    $(document).on('click', '#btnNextsoporte1', function(){
        let country = $('#countryUser').val()
        let state = $('#stateUser').val()
        let address = $('#addressUser').val()
        let zipcode = $('#zipcodeUser').val()
        let phone = $('#phoneUser').val()

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
                            $('.c-soporte01').css({'display' : 'none'})
                            $('.c-soporte02').css({'display' : 'block'})
                        }
                    }
                }
            }
        }
    })

    $(document).on('click', '#btnNextsoporte2', function(){
        $('.c-soporte02').css({'display' : 'none'})
        $('.c-soporte03').css({'display' : 'block'})
    })

    $(document).on('change', '#question-business', function(){
        let valor = $(this).val()
        if (valor == 1){
            $('#c-optionsQuestionBusiness').css({'display' : 'block'})
            $('.btnEndingsoporte').css({'display' : 'none'})
            $('#btnNextsoporte1').css({'display' : 'block'})
        }else{
            if (valor == 2){
                $('#c-optionsQuestionBusiness').css({'display' : 'none'})
                $('.progress-bar').css({'width' : '100%'})
                $('.btnEndingClient').css({'display' : 'block'})
                $('#btnNextsoporte2').css({'display' : 'none'})
            }else{
                if (valor == 0){
                    $('#c-optionsQuestionBusiness').css({'display' : 'none'})
                    $('.btnEndingsoporte').css({'display' : 'block'})
                    $('#btnNextsoporte2').css({'display' : 'none'})
                }
            }
        }
    })

    $(document).on('click', '#btnEndingsoporte', function(){
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

        if (jobRole == 0){
            savedInformationsoporte(nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole)
         }else{
            if (nameB == ''){
                $('#BusinessName').css({'outline' : '2px solid #de3a46'})
                $('#BusinessName').focus()
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
                                        savedInformationsoporte(nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole)
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    })

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

    $(document).on('click', '#countryBusiness', function(){
        $('#countryBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#stateUser', function(){
        $('#stateUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#addressUser', function(){
        $('#addressUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#zipcodeUser', function(){
        $('#zipcodeUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#phoneUser', function(){
        $('#phoneUser').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#BusinessName', function(){
        $('#BusinessName').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#stateBusiness', function(){
        $('#stateBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#addressBusiness', function(){
        $('#addressBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#zipcodeBusiness', function(){
        $('#zipcodeBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#phoneBusiness', function(){
        $('#phoneBusiness').css({'outline' : '1px solid #213280'})
    })

    $(document).on('keyup', '#websiteBusiness', function(){
        $('#websiteBusiness').css({'outline' : '1px solid #213280'})
    })

    function searchCountry(consulta){

        $.ajax({
            url: 'https://kalstein.co.ve/wp-content/plugins/kalsteinPerfiles/php/searchCountry.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)
            $('#countryUser').html(respuesta)
            $('#countryBusiness').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        })
    }

    function savedInformationsoporte(nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole){

        $.ajax({
            url: 'https://kalstein.co.ve/wp-content/plugins/kalsteinPerfiles/php/savedInfoClient.php',
            type: 'POST',
            data: {nameB, countryB, stateB, addressB, zipcodeB, phoneB, websiteB, nameUser, lastnameUser, countryUser, stateUser, addressUser, zipcodeUser, phoneUser, jobRole},
        })
        .done(function(respuesta){
            console.log(respuesta)            
            let data = JSON.parse(respuesta)
            if (data.update === 'correcto'){
                $(location).attr('href','http://127.0.0.1/wp-local/suport/home')
            }else{
                console.log("error")
            }
        })
        .fail(function(){
            console.log("error")
        })
    }



})