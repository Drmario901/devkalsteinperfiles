jQuery(document).ready(function ($) {
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

  $(document).on("click", "#btn-update_quotes", function () {
    /* if($("#cotizacion_status").val() === '0'){
            iziToast.show({
                title: 'Atención!',
                message: 'Por favor debe elegir el tipo de status',
                position: 'center', // Puedes elegir entre "bottomRight", "bottomLeft", "topRight", "topLeft", "topCenter", "bottomCenter"
                color: 'red', // Puedes elegir entre "red", "orange", "green", "blue", "purple"
            });

    } */
    let form = $("#cotizacion_status_form").serialize();
    /* alert(form); */
    if (form) {
      iziToast.question({
        timeout: false,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        title: "Confirmation",
        message: "<?php echo $cambiarEstado ?>?",
        position: "center",
        buttons: [
          [
            `<button><b>✅</b></button>`,
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
              $.ajax({
                url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/updateCotizacion.php",
                method: "POST",
                /* dataType: 'json', */
                data: form,
              }).done(function (respuesta) {
                /* let response = JSON.parse(respuesta); */
                console.log(respuesta);
                console.log(respuesta.status + " " + respuesta.mensaje);
                if (respuesta.status === "Correcto") {
                  /* alert(respuesta.status + " " + respuesta.mensaje); */
                  iziToast.show({
                    title: "Réussite!",
                    message: "La commande a été mise à jour avec succès",
                    position: "center", // Puedes elegir entre "bottomRight", "bottomLeft", "topRight", "topLeft", "topCenter", "bottomCenter"
                    color: "green", // Puedes elegir entre "red", "orange", "green", "blue", "purple"
                  });
                }
                /* alert(respuesta.cotizacion_status + " " + respuesta.cotizacion_status_nombre); */
                window.location.href =
                  "https://dev.kalstein.plus/plataforma/index.php/support/quotes/";
              });
            },
            true,
          ],
          [
            `<button><b>❌</b></button>`,
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
        onClosing: function (instance, toast, closedBy) {
          console.log("Closing...");
        },
        onClosed: function (instance, toast, closedBy) {
          console.log("Closed...");
        },
      });
    } else {
      iziToast.warning({
        title: "Warning",
        message: "<?php echo $seleccionarOpcion ?>",
        position: "topRight",
      });
    }
  });

  $(document).on("click", "#prevPage", function () {
    var page = $(this).data("page");
    if (page > 1) {
      loadQuotes(page - 1);
    }
  });

  $(document).on("click", "#nextPage", function () {
    var page = $(this).data("page");
    loadQuotes(page + 1);
  });

  function loadQuotes(page) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/quotes.php",
      method: "POST",
      data: { page },
    })
      .done(function (respuesta) {
        $("#quoteTable").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }
});

jQuery(document).ready(function ($) {
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

  $(document).on("click", "#btn-details", function () {
    console.log("asdsadasdd");

    var quotes_id = $(this).val();
    console.log(quotes_id);

    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/cotizacionInfo.php",
      method: "POST",
      data: { quotes_id },
    }).done(function (response) {
      console.log(response);
      let res = JSON.parse(response);

      res.forEach((elem) => {
        product_name = elem.product_name;
        product_maker = elem.product_maker;
        var details =
          `${alertsTranslations.nombreDelServicio}: ` +
          product_name +
          "<br>" +
          `${alertsTranslations.agenteSoporte}: ` +
          product_maker +
          "<br>";

        iziToast.show({
          title: `${alertsTranslations.quoteDetails} (ID:${quotes_id})`,
          message: details,
          position: "center",
          timeout: false,
          closeOnClick: true,
          progressBar: false,
        });
      });
    });
  });
});

jQuery(document).ready(function ($) {
  $(document).on("keyup", "#btn-details", function () {
    let consulta = $(this).val();
    createdSessionCotizacion(consulta);
  });
});

function createdSessionCotizacion(consulta) {
  $.ajax({
    url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/createSession.php",
    type: "POST",
    data: { consulta },
  })
    .done(function (respuesta) {
      window.open(
        "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinperfiles/php/suport/createPDF.php",
        "_blank"
      );
    })
    .fail(function () {
      console.log("error");
    });
}
