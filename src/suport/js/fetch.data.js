jQuery(document).ready(function($) {

    dataCMB()
    function dataCMB(consulta) {
        $.ajax({
            url: 'http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/php/fetchData.php',
            type: 'POST',
            data: { consulta },
        })
        .done(function(respuesta) {
            console.log(respuesta);
            $('#dataEdit').html(respuesta);
        })
        .fail(function() {
            console.log("error");
        });
    }

    function mostrarDatos(consulta){
        $.ajax({
            // Cambia mificherophp.php por el nombre de tu fichero
            url: "http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/php/productData.php",
            type: "POST",
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)
            let data = JSON.parse(respuesta)
            // Coloca el nombre del input el cual mostrara los datos dependiendo de si es un id o una clase vas a hacer lo mismo con todos
            $('#name').val(data.name)
            $('#description').val(data.description)
            $('#dataCategory').val(data.category)
            $('#weight').val(data.weight)
            $('#stock').val(data.stock)
            $('#lenght').val(data.lenght)
            $('#width').val(data.width)
            $('#height').val(data.height)
            $('#status').val(data.status)
            $('#price').val(data.price)
            $('#thumbnail').attr('src', 'http://127.0.0.1/wp-local/wp-content/plugins/kalsteinPerfiles/src/images/upload/' + data.image)
        })
        .fail(function(){
            console.log(data.name);
        });
    }

    // Evento on change
    
    $(document).on('change', '#dataEdit', function(){
        let valor = $(this).val()
        mostrarDatos(valor)
    });
});
