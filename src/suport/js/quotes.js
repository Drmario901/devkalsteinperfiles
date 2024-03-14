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

  $(document).on("click", "#btn-update_quote", function () {
    var id = $(this).val();
    var selectedStatus = $(this).siblings(".status-select").val();
    var customerName = $(this).closest("tr").find(".customer-name").text();

    if (selectedStatus != "") {
      iziToast.question({
        timeout: false,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        title: "Confirmation",
        message: `${alertsTranslations.youSureYouWantToChangeTheStatusFor} ${alertsTranslations.customerName}?`,
        position: "center",
        buttons: [
          [
            `<button><b>${alertsTranslations.si}</b></button>`,
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
              quoteUpdateStatus(id, selectedStatus, customerName);
            },
            true,
          ],
          [
            `<button><b>${alertsTranslations.no}</b></button>`,
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
        message: alertsTranslations.pleaseSelectOption,
        position: "topRight",
      });
    }
  });

  function quoteUpdateStatus(cotizacion_id, cotizacion_status, customerName) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/updateStatus.php",
      method: "POST",
      data: {
        cotizacion_id,
        cotizacion_status,
      },
    })
      .done(function (respuesta) {
        console.log(respuesta);
        let data = JSON.parse(respuesta);
        if (data.update === "correcto") {
          iziToast.success({
            title: "Success",
            message: alertsTranslations.updateSuccessful,
            position: "topRight",
            timeout: 1500,
          });
          window.location.href =
            domain +
            "https://dev.kalstein.plus/wp-local/orders/?i=" +
            $("#hiddenPage").val();
        }
      })
      .fail(function (error) {
        console.log("error", error);
      });
  }

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
