jQuery(document).ready(function($){

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
    $.ajax({
        url: plugin_dir + '/php/verifySessionRecoveryPassword.php',
        type: 'POST'
    })
    .done(function(respuesta){
        console.log(respuesta) 
        let userRecoveryPassword = $('#emailRecoveryPassword').val()
        data = JSON.parse(respuesta)
        let emailEncrypt = data.email           
        if (emailEncrypt == userRecoveryPassword){           
            if (data.sessionTTL > data.inactividad){
                iziToast.error({
                    title: 'Error',
                    message: alertsTranslations.linkExpired,
                    position: 'center'
                })                
                window.location.replace(domain + '/acceder')
            }
        }else{
            window.location.replace(domain + '/acceder')
        }
    })
    .fail(function(){
        console.log("error")
    })
})