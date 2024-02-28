let plugin_dir = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/';
let domain = 'https://dev.kalstein.plus/plataforma/wp-content/';



//COMPONER CORREO
jQuery(document).ready(function($) {
    console.log(document);

    $(document).on('click', '#sendMessage', function(e) {
      var remitenteId = $("#remitenteId").val();
      var destinatarioId = $("#destinatarioId").val();
      var asunto = $("#asunto").val();
      var contenido = $("#contenido").val();


      if (!destinatarioId.startsWith('@')) {
        iziToast.error({
          title: 'Error',
          message: 'The "Addressee ID" must start with an "@" symbol.',
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
          message: 'Are you sure you want to send this message?',
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
          message: 'Please fill in all the required fields.',
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
            message: 'Data updated successfully.',
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
