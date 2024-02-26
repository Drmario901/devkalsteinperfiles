jQuery(document).ready(function($){
    searchDataUserDashboard()

    function searchDataUserDashboard(consulta){

        $.ajax({
            url: 'https://www.platform.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/searchUserLoguer.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)            
            let data = JSON.parse(respuesta)
            $('#sres').val(data.name)
            $('#atc').val(data.name)
        })
        .fail(function(){
            console.log("error")
        })
    }
})