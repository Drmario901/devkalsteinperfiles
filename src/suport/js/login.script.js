jQuery(document).ready(function($){
    $(document).on('click', '#btnContinueLogIn', function(){
        let user = $('#emailUser').val()
        let password = $('#passwordGrid').val()
        if (user == ''){
            alert("Mail is required")
        }else{
            if(user.includes('@')){
                let position = user.indexOf('@')
                let newUser = user.substr(position)
                if(newUser.includes('.')){                 
                    $('#emailUser').attr('readonly', 'readonly')
                    $('#emailUser').css({'padding-right' : '3rem'})
                    $('.input-wrapper').append("<i class='fa-sharp fa-solid fa-user-pen'></i>")
                    $('#c-password').css({'display' : 'block'})
                    $('#passwordGrid').focus()
                    $('#btnContinueLogIn').css({'display' : 'none'})
                    $('#btnContinueLogIn2').css({'display' : 'block'})
                }else{
                    $('.emailError').css({'display' : 'block'})
                    $('#emailUser').focus()
                }
            }else{
                $('.emailError').css({'display' : 'block'})
                $('#emailUser').focus()
            }    
        }
    })

    $(document).on('click', '#btnContinueLogIn2', function(){
        let user = $('#emailUser').val()
        let password = $('#passwordGrid').val()
        if (password == ''){
            alert("Password is required")
        }else{
            alert('Enviando petición!!!')      
        }
    })

    $(document).on('click', '#btnContinueSignUp', function(){
        let user = $('#emailUser').val()
        let password = $('#passwordGrid').val()
        if (user == ''){
            alert("Mail is required")
        }else{
            if(user.includes('@')){
                let position = user.indexOf('@')
                let newUser = user.substr(position)
                if(newUser.includes('.')){                
                    validarCorreo(user)   
                }else{
                    $('.emailError').css({'display' : 'block'})
                    $('#emailUser').focus()
                }
            }else{
                $('.emailError').css({'display' : 'block'})
                $('#emailUser').focus()
            }    
        }
    })

    $(document).on('click', '#btnContinueSignUp2', function(){
        let user = $('#emailUser').val()
        let password = $('#passwordGrid').val()
        if (password == ''){
            alert("Password is required")
        }else{
            if ($('.p01').hasClass('aprobado') && $('.p02').hasClass('aprobado') && $('.p03').hasClass('aprobado') && $('.p04').hasClass('aprobado') && $('.p05').hasClass('aprobado')){
                registrarCuenta(user, password)
            }else{
                $('#passwordGrid').focus()
                $('#passwordGrid').css({'outline' : '2px solid #de3a46'})
            }     
        }
    })

    $(document).on('click', '#btnContinueSignUp3', function(){
        let code = $('#txtCodeVerification').val()
        validarCode(code)
    })

    $(document).on('keyup', '#emailUser', function(){
        $('.emailError').css({'display' : 'none'})
        $('.availableMail').css({'display' : 'none'})
        $('.mailExists').css({'display' : 'none'})
    })

    $(document).on('keyup', '#txtCodeVerification', function(){
        $('.codeExpired').css({'display' : 'none'})
        $('.codeError').css({'display' : 'none'})
    })

    $(document).on('keyup', '#passwordGrid', function(e){
        let valor = $(this).val()
        $('#passwordGrid').css({'outline' : '1px solid #213280'})

        if (valor.includes('A') || valor.includes('B') || valor.includes('C') || valor.includes('D') || valor.includes('E') || valor.includes('F') || valor.includes('G') || valor.includes('H') || valor.includes('I') || valor.includes('J') || valor.includes('K') || valor.includes('L') || valor.includes('M') || valor.includes('N') || valor.includes('Ñ') || valor.includes('O') || valor.includes('P') || valor.includes('Q') || valor.includes('R') || valor.includes('S') || valor.includes('T') || valor.includes('U') || valor.includes('V') || valor.includes('W') || valor.includes('X') || valor.includes('Y') || valor.includes('Z')){
            $('.p03').css({'color' : '#229e1e'})
            $('.p03').addClass('aprobado')
        }else{
            $('.p03').css({'color' : '#000'})
            $('.p03').removeClass('aprobado')
        }

        if (valor.includes('a') || valor.includes('b') || valor.includes('c') || valor.includes('d') || valor.includes('e') || valor.includes('f') || valor.includes('g') || valor.includes('h') || valor.includes('i') || valor.includes('j') || valor.includes('k') || valor.includes('l') || valor.includes('m') || valor.includes('n') || valor.includes('ñ') || valor.includes('o') || valor.includes('p') || valor.includes('q') || valor.includes('r') || valor.includes('s') || valor.includes('t') || valor.includes('u') || valor.includes('v') || valor.includes('w') || valor.includes('x') || valor.includes('y') || valor.includes('z')){
            $('.p02').css({'color' : '#229e1e'})
            $('.p02').addClass('aprobado')
        }else{
            $('.p02').css({'color' : '#000'})
            $('.p02').removeClass('aprobado')
        }

        if (valor.includes('0') || valor.includes('1') || valor.includes('2') || valor.includes('3') || valor.includes('4') || valor.includes('5') || valor.includes('6') || valor.includes('7') || valor.includes('8') || valor.includes('9')){
            $('.p04').css({'color' : '#229e1e'})
            $('.p04').addClass('aprobado')
        }else{
            $('.p04').css({'color' : '#000'})
            $('.p04').removeClass('aprobado')
        }

        if (valor.includes('!') || valor.includes('"') || valor.includes('#') || valor.includes('$') || valor.includes('%') || valor.includes('&') || valor.includes('/') || valor.includes('(') || valor.includes(')') || valor.includes('=') || valor.includes('?') || valor.includes('¡') || valor.includes('¿') || valor.includes('+') || valor.includes('*') || valor.includes('[') || valor.includes(']') || valor.includes('{') || valor.includes('}') || valor.includes(',') || valor.includes(';') || valor.includes('.') || valor.includes(':') || valor.includes('-') || valor.includes('_') || valor.includes('@') || valor.includes('|')){
            $('.p05').css({'color' : '#229e1e'})
            $('.p05').addClass('aprobado')
        }else{
            $('.p05').css({'color' : '#000'})
            $('.p05').removeClass('aprobado')
        }

        if (valor.length >= 8){
            $('.p01').css({'color' : '#229e1e'})
            $('.p01').addClass('aprobado')
        }else{
            $('.p01').css({'color' : '#000'})
            $('.p01').removeClass('aprobado')
        }

        //if (e.which >= 97 && e.which <= 122){
        //    $('.p02').css({'color' : '#229e1e'})
        //}

        
    })

    $(document).on('click', '.fa-user-pen', function(){
        $('#emailUser').removeAttr('readonly')
        $('#emailUser').css({'padding-right' : ''})
        $('.input-wrapper').remove("fa-user-pen")
        $('#c-password').css({'display' : 'none'})
        $('#emailUser').focus()
        $('#passwordGrid').val('')        
        $('#btnContinueLogIn').css({'display' : 'block'})
        $('#btnContinueLogIn2').css({'display' : 'none'})
    })

    $(document).on('click', '.fa-eye', function(){
        $('#passwordGrid').attr('type', 'text')
        $('.fa-eye').addClass('fa-eye-slash')
        $('.fa-eye-slash').removeClass('fa-eye')
        $('#passwordGrid').focus()
    })

    $(document).on('click', '.fa-eye-slash', function(){
        $('#passwordGrid').attr('type', 'password')
        $('.fa-eye-slash').addClass('fa-eye')
        $('.fa-eye').removeClass('fa-eye-slash')
        $('#passwordGrid').focus()
    })

    $(document).on('click', '.newCode', function(){
        reenviarCorreo()
        $('.codeExpired').css({'display' : 'none'})
    })

    function validarCorreo(consulta){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchAccount.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)
            let data = JSON.parse(respuesta)
            if (data.status === 'disponible'){           
                $('.availableMail').css({'display' : 'block'})
                $('#emailUser').attr('readonly', 'readonly')
                $('#emailUser').css({'padding-right' : '3rem'})
                $('.input-wrapper').append("<i class='fa-sharp fa-solid fa-user-pen'></i>")
                $('#c-password').css({'display' : 'block'})
                $('#passwordGrid').focus()
                $('#btnContinueSignUp').css({'display' : 'none'})
                $('#btnContinueSignUp2').css({'display' : 'block'})
            }else{
                $('.mailExists').css({'display' : 'block'})
            }
        })
        .fail(function(){
            console.log("error");
        })
    }

    function registrarCuenta(consulta, consulta1){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/registerAccount.php',
            type: 'POST',
            data: {consulta, consulta1},
        })
        .done(function(respuesta){
            console.log(respuesta)
            let data = JSON.parse(respuesta)
            if (data.registro === 'correcto'){           
                enviarCorreo()
            }else{
                console.log("error");
            }
        })
        .fail(function(){
            console.log("error");
        })
    }

    function enviarCorreo(consulta){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/testmail.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            $('.card-title').text('Available Mail')               
            $('.redirectLogin').css({'display' : 'none'})
            $('.c-email').css({'display' : 'none'})
            $('#c-password').css({'display' : 'none'})
            $('.emailError').css({'display' : 'none'})
            $('.availableMail').css({'display' : 'none'})
            $('#btnContinueSignUp2').css({'display' : 'none'})
            $('#btnContinueSignUp3').css({'display' : 'block'})
            $('.c-codeVerification').css({'display' : 'block'})
            $('.spanEmail').text($('#emailUser').val())
            $('#txtCodeVerification').focus()
        })
        .fail(function(){
            console.log("error");
        })
    }

    function reenviarCorreo(consulta){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/newCodeValidation.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            enviarCorreo()
        })
        .fail(function(){
            console.log("error");
        })
    }

    function validarCode(consulta){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/validarCode.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)
            let data = JSON.parse(respuesta)
            if (data.timer === 'caducado'){           
                $('.codeExpired').css({'display' : 'block'})
            }else{
                if (data.sameCode === 'coinciden'){
                    alert('email verificado!!')
                    $(location).attr('href','https://kalstein.co.ve/assistant/')
                }else{
                    $('.codeError').css({'display' : 'block'})
                }
            }
        })
        .fail(function(){
            console.log("error");
        })
    }
})