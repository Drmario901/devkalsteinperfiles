jQuery(document).ready(function($){
    $(document).on('click', '#btn-logout', function(){
        $.ajax({
            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/logout.php',
            type: 'POST',
            data: {},
        })
        .done(function(respuesta){
            $(location).attr('href','https://plataforma.kalstein.net/acceder/');
        })
        .fail(function(){
            console.log("error");
        });
    });
});