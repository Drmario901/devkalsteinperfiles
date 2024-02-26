jQuery(document).ready(function($){
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
                    message: 'The link has expired',
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