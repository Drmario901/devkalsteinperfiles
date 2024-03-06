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



jQuery(document).ready(function($){
    $('.topBarInLogoArea').prepend("<div class='c-btnLoginSignup'></div>")
    showUserLoguer()

    function showUserLoguer(consulta){
        $.ajax({
			url: "https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/infoAccountLoguer.php",
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
            url: 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/logout.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            $(location).attr('href','https://dev.kalstein.plus/login/')
        })
        .fail(function(){
            console.log("error")
        })
    }
})