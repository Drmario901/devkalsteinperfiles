jQuery(document).ready(function($){
    $(document).on('click', '#btn-logout', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/logout.php',
            type: 'POST',
            data: {},
        })
        .done(function(respuesta){
            $(location).attr('href','https://dev.kalstein.plus/plataforma/acceder/');
        })
        .fail(function(){
            console.log("error");
        });
    });
});