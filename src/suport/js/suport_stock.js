jQuery(document).ready(function($) {

    //SOPORTE

    //Funcion para mostrar la tabla de reportes
    let category= $('#category').val()
    let inputSearch = $('#searchreport').val()
    Stock_suport(inputSearch,category);

    function Stock_suport(inputSearch, category){
        
        $.ajax({
            url: "https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/suport/suport_stock.php",
            type: "POST",
            data: {inputSearch, category},
        })
        .done(function(respuesta){
            $('#services_stock').html(respuesta)
        })
        .fail(function(){
            console.log("error");

        })
    }

    $(document).on('keyup', '#searchreport', function(){
        let inputSearch = $(this).val();
        let category = $('#category').val();
        Stock_suport(inputSearch, category)
    })


    $(document).on('change', '#category', function(){
        let category = $(this).val();
        let inputSearch = $('#searchreport').val();
        Stock_suport(inputSearch, category)
    })
});
    
      
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
            $('#category').html(respuesta);
        })
        .fail(function() {
            console.log("error");
        });
    }
});

jQuery(document).ready(function($){

    $(document).on('click', '#add_report', function (){
        let edit_id = $(this).val();

        console.log('detectó');

        let form = $("<form action='https://plataforma.kalstein.net/index.php/addreports/'" + "' method='get' hidden>" +
            "<input type='hidden' name='edit' value='" + edit_id + "' /></form>");

        $('body').append(form);
        form.submit();
    });
});