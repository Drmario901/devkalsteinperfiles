jQuery(document).ready(function($) {
    category();  
    function category(consulta) {
        $.ajax({
            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/suport/category_product.php',
            type: 'POST',
            data: { consulta },
        })
        .done(function(respuesta) {
            console.log(respuesta);
            $('#SEAcategory').html(respuesta);
        })
        .fail(function() {
            console.log("error");
        });
    }   
});
