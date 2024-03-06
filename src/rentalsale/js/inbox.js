let plugin_dir = 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/';
let domain = 'https://dev.kalstein.plus/index.php/';


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



//COMPONER CORREO
jQuery(document).ready(function($) {
    console.log(document);

    $(document).on('click', '#sendMessage', function(e) {
      var remitenteId = $("#remitenteId").val();
      var destinatarioId = $("#destinatarioId").val();
      var asunto = $("#asunto").val();
      var contenido = $("#contenido").val();


      if (remitenteId && destinatarioId && asunto && contenido) {
        iziToast.question({
          timeout: false,
          close: false,
          overlay: true,
          displayMode: 'once',
          id: 'question',
          zindex: 999,
          title: alertsTranslations.confirmacion,
          message: alertsTranslations.enviarMensaje,
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
          title: alertsTranslations.error,
          message: alertsTranslations.camposRequeridos,
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
        url: plugin_dir + 'php/distributor/sendEmail.php',
        type: 'POST',
        data: formData,
        dataType: 'text',
        processData: false,
        contentType: false,
        cache: false,
        success: function(response) {
          console.log(response);
          iziToast.success({
            title: alertsTranslations.exito,
            message: alertsTranslations.datosActualizados,
            position: 'center'
          });
          window.location.href = domain + 'inbox/compose';
        },
        error: function(xhr, status, error) {
          console.log(xhr.responseText);
        }
      });
    }
});
