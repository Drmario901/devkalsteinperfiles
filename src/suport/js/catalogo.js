jQuery(document).ready(function($) {
    
    //Funcion para mostrar la tabla de reportes
    let category= $('#category-ma').val()
    let inputSearch = $('#searchreport-ma').val()

    catalogo(inputSearch,category);

    function catalogo(inputSearch, category){
        

        $.ajax({
            url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/catalogo.php",
            type: "POST",
            data: {inputSearch, category},
        })
        .done(function(respuesta){
            $('#manuales').html(respuesta)
        })
        .fail(function(){
            console.log("error");

        })
    }
    
    $(document).on('keyup', '#searchreport-ma', function(){
        let inputSearch = $(this).val();
        let category = $('#category-ma').val();
        catalogo(inputSearch, category)
    })


    $(document).on('change', '#category-ma', function(){
        let category = $(this).val();
        let inputSearch = $('#searchreport-ma').val();
        catalogo(inputSearch, category)
    })

});

  
jQuery(document).ready(function($) {

    category();  
    function category(consulta) {
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/category_product.php',
            type: 'POST',
            data: { consulta },
        })
        .done(function(respuesta) {
            console.log(respuesta);
            $('#category-ma').html(respuesta);
        })
        .fail(function() {
            console.log("error");
        });
    }
      
})   
