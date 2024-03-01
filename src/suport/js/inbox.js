let plugin_dir = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/';
let domain = 'https://dev.kalstein.plus/plataforma/wp-content/';



//COMPONER CORREO
jQuery(document).ready(function($) {
  const cookieLng = document.cookie.split('; ').find(row => row.startsWith('language=')).split('=')[1]
        let alertsTranslations = {};

        // cargar json de traducciones
        const loadTranslations = (lng) => {
            return fetch(`https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`)
                .then(response => response.json())
                .then(translation => {
                    // save in a global variable
                    alertsTranslations = translation;
                });
        }; 

        loadTranslations(cookieLng)
    console.log(document);

    $(document).on('click', '#sendMessage', function(e) {
      var remitenteId = $("#remitenteId").val();
      var destinatarioId = $("#destinatarioId").val();
      var asunto = $("#asunto").val();
      var contenido = $("#contenido").val();


      if (!destinatarioId.startsWith('@')) {
        iziToast.error({
          title: 'Error',
          message: alertsTranslations.addressIdMustStartWith,
          position: 'center'
        });
        return;
      }

      if (remitenteId && destinatarioId && asunto && contenido) {
        iziToast.question({
          timeout: false,
          close: false,
          overlay: true,
          displayMode: 'once',
          id: 'question',
          zindex: 999,
          title: 'Confirmación',
          message: alertsTranslations.areYouSureYouWantToSendThisMessage,
          position: 'center',
          buttons: [
            ['<button><b>Yes</b></button>', function(instance, toast) {
              instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
              uploadMessageContent(remitenteId, destinatarioId, asunto, contenido);
            }, true],
            ['<button>No</button>', function(instance, toast) {
              instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
            }]
          ]
        });
      } else {
        iziToast.error({
          title: 'Error',
          message: alertsTranslations.pleaseFillRequiredFields,
          position: 'center'
        });
      }
    });

    function uploadMessageContent(remitenteId, destinatarioId, asunto, contenido) {
      var formData = new FormData();

      formData.append('remitente_id', remitenteId);
      formData.append('destinatario_id', destinatarioId);
      formData.append('asunto', asunto);
      formData.append('contenido', contenido);

      $.ajax({
        contentType: "multipart/form-data",
        url: plugin_dir + 'suport/sendEmail.php',
        type: 'POST',
        data: formData,
        dataType: 'text',
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
          console.log(response);
          iziToast.success({
            title: 'Success',
            message: alertsTranslations.dataSuccessfullySaved,
            position: 'center'
          });
          window.location.href = domain + 'suport/compose';
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }


    //SESIONES

});
