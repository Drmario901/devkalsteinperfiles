jQuery(document).ready(function($){
    $('.topBarInLogoArea').prepend("<div class='c-btnLoginSignup'></div>")
    showUserLoguer()

    function showUserLoguer(consulta){
        $.ajax({
			url: plugin_dir + "/php/infoAccountLoguer.php",
			type: "POST",
			data: {consulta},
        })
        .done(function(respuesta){
            $('.c-btnLoginSignup').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        })
    }

    $(document).on('click', '#btnLogout', function(e){
        e.preventDefault()
        logout()
    })

    function logout(consulta){
        $.ajax({
            url: plugin_dir + '/php/logout.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log('cerrando sesion');
            $(location).attr('href',`${main_domain}`)
        })
        .fail(function(){
            console.log("error")
        })
    }
})