jQuery(document).ready(function($) {
    // Evento on change

    $(document).on('change', '#country-select', function(){
        let valor = $(this).val();
        mostrarDatos(valor);
    })

    function mostrarDatos(consulta){
        $.ajax({
            // Cambia mificherophp.php por el nombre de tu fichero
            url: plugin_dir + "php/shippingData.php",
            type: "POST",
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta);
            let data = JSON.parse(respuesta);
            // Coloca el nombre del input el cual mostrara los datos dependiendo de si es un id o una clase vas a hacer lo mismo con todos
            $('#country-aerial-weigth').val(data.caw);
            $('#country-aerial-price').val(data.cap);
            $('#country-maritimal').val(data.cmp);
        })
        .fail(function(){
            console.log(data.name);
        });
    }
    
});
