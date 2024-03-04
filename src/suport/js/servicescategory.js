jQuery(document).ready(function($) {
    category();  
    function category(consulta) {
        $.ajax({
            url: 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/suport/category_product.php',
            type: 'POST',
            data: { consulta },
        })
        .done(function(respuesta) {
            console.log(respuesta);
            $('#category').html(respuesta);
        })
        .fail(function() {
            console.log("error");
        });
    }
})   