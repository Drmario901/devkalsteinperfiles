jQuery(document).ready(function($){
    let isToastOpen = false; 

      const cookieLng = document.cookie
        .split("; ")
        .find((row) => row.startsWith("language="))
        .split("=")[1];
      let alertsTranslations = {};

      // cargar json de traducciones
      const loadTranslations = (lng) => {
        return fetch(
          `https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`
        )
          .then((response) => response.json())
          .then((translation) => {
            // save in a global variable
            alertsTranslations = translation;
          });
      };

      loadTranslations(cookieLng);

    $(document).on('click', '.btn-view-accessory', function() {
        if (isToastOpen) {
            return; 
        }

        var quote_id = $(this).data().id;
        console.log(quote_id);

        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/manufacturer/getAccessoryInfo.php',
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

                var details = `${alertsTranslations.nombreProducto}:` + productName + '<br>' +
                              `${alertsTranslations.modeloProducto}:` + productModel + '<br>' +
                              `${alertsTranslations.descripcion}:` + product_description + '<br>' +
                              `${alertsTranslations.precio}:` + product_price + '<br>' +
                            'Imagen: <img style="max-width: 200px;" src="' + productImage + '">';

                iziToast.show({
                    title: alertsTranslations.titleDetalles,
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
                title: alertsTranslations.error,
                message: alertsTranslations.obtenerError,
                position: 'center',
                timeout: false,
                closeOnClick: true,
                progressBar: false
            });
            isToastOpen = true; 
        });
    });
});
