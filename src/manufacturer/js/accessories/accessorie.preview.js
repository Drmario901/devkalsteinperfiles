jQuery(document).ready(function($){
    let isToastOpen = false; 

    $(document).on('click', '.btn-view-accessory', function() {
        if (isToastOpen) {
            return; 
        }

        var quote_id = $(this).data().id;
        console.log(quote_id);

        $.ajax({
            url: 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/manufacturer/getAccessoryInfo.php',
            method: 'POST',
            data: { quote_id }
        })
        .done(function (response){
            console.log(response);
            let res = JSON.parse(response);

            res.forEach(elem => {
                productName = elem.product_name;
                productModel = elem.product_model;
                product_description = elem.product_description;
                productImage = elem.product_image;
                product_price = elem.product_price;

                var details = 'Nombre del producto: ' + productName + '<br>' +
                            'Modelo del producto: ' + productModel + '<br>' +
                            'Descripción: ' + product_description + '<br>' +
                            'Precio: USD ' + product_price + '<br>' +
                            'Imagen: <img style="max-width: 200px;" src="' + productImage + '">';

                iziToast.show({
                    title: 'Detalles',
                    message: details,
                    position: 'center',
                    timeout: false,
                    closeOnClick: true,
                    progressBar: false,
                    onClosed: function() {
                        isToastOpen = false; 
                    }
                });
                isToastOpen = true; 
            });
        })
        .fail(function(){
            iziToast.error({
                title: 'Error',
                message: "No se pueden obtener datos de la base de datos",
                position: 'center',
                timeout: false,
                closeOnClick: true,
                progressBar: false
            });
            isToastOpen = true; 
        });
    });
});
