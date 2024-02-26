jQuery(document).ready(function($) {
    $(document).on('click', '.btn-details', function() {

        var quote_id = $(this).val();

        $.ajax({
            url: plugin_dir + 'php/distributor/cotizacionInfo.php',
            method: 'POST', 
            data: {quote_id}
        })
        .done(function (response){

            console.log(response);

            let res = JSON.parse(response);

            res.forEach(elem => {
                productName = elem.product_name;
                productModel = elem.product_model;
                productQuantity = elem.product_quantity;
                productImage = elem.product_image;
                
                var details = 'Nombre de producto: ' + productName + '<br>' +
                              'Modelo de producto: ' + productModel + '<br>' +
                              'Cantidad: ' + productQuantity + '<br>' +
                              'Imágen: <img style="max-width: 200px;" src="https://kalstein.net/es/wp-content/uploads/kalsteinQuote/' + productImage + '">';
      
                iziToast.show({
                    title: 'Detalles de cotización (ID: ' + quote_id + ')',
                    message: details,
                    position: 'center',
                    timeout: false,
                    closeOnClick: true,
                    progressBar: false
                });
            });
        })
        .fail(function(){
            iziToast.error({
                title: 'Error',
                message: "No se puede conectar con la base de datos",
                position: 'center',
                timeout: false,
                closeOnClick: true,
                progressBar: false
            });
        });
    });
});
