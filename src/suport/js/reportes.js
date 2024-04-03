jQuery(document).ready(function ($) {
  //Funcion para mostrar la tabla de reportes
  let inputSearch = $("#searchreport").val();
  let dateFrom = $("#dateFrom").val();
  let status = $("#estatus").val();
  let dateTo = $("#dateTo").val();

  tablaconsulta(inputSearch, status, dateFrom, dateTo);

  function tablaconsulta(inputSearch, status, dateFrom, dateTo) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/tabla_reportes.php",
      type: "POST",
      data: { inputSearch, status, dateFrom, dateTo },
    })
      .done(function (respuesta) {
        $("#report-fails").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("keyup", "#searchreport", function () {
    let inputSearch = $(this).val();
    let dateFrom = $("#dateFrom").val();
    let status = $("#estatus").val();
    let dateTo = $("#dateTo").val();
    tablaconsulta(inputSearch, status, dateFrom, dateTo);
  });

  $(document).on("change", "#estatus-reporte", function () {
 
    let status = $(this).val();
    let dateFrom = $("#dateFrom").val();
    let dateTo = $("#dateTo").val();
    let inputSearch = $("#searchreport").val();
    console.log('cambios', 'status:',status, "dateFrom:", dateFrom, 'dateTo:', 'inputSearch:',inputSearch )
    tablaconsulta(inputSearch, status, dateFrom, dateTo);
  });

  $(document).on("change", "#dateTo", function () {
    let dateTo = $(this).val();
    let dateFrom = $("#dateFrom").val();
    let status = $("#estatus").val();
    let inputSearch = $("#searchreport").val();
    tablaconsulta(inputSearch, status, dateFrom, dateTo);
  });

  function showInfoReportRequest(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/showInfoReportRequest.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $(".c-reportRequest").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btn-report-details", function () {
    let valor = $(this).val();
    showInfoReportRequest(valor);
  });

  $(document).on("click", "#btn-AddDescription", function () {
    let cant = $("#ih-cant").val();
    cant = parseInt(cant) + parseInt(1);
    $("#c-descriptionQuote").append(
      "<div id='row-" +
        cant +
        "' class='row'><div class='col-3'><input type='number' id='cant-" +
        cant +
        "' class='form-control' placeholder='Quantity' aria-label='Username'></div><div class='col-6'><input type='text' id='description-" +
        cant +
        "' class='form-control' placeholder='Description' aria-label='Username'></div><div class='col-3'><input type='number' id='price-" +
        cant +
        "' class='form-control' placeholder='Price $' aria-label='Username'></div></div>"
    );
    $("#ih-cant").val(cant);
  });

  $(document).on("click", "#btn-lessDescription", function () {
    let cant = $("#ih-cant").val();
    $("#row-" + cant).remove();
    cant = parseInt(cant) - parseInt(1);
    if (cant <= 1) {
      cant = 1;
    }
    $("#ih-cant").val(cant);
  });

  $(document).on("click", "#btn-savedGeneratedQuo", function () {
    let description = $("#txtObservation").val();
    let count = $("#ih-cant").val();
    let nItem = parseInt(count) + parseInt(1);
    let id = $("#idReport").val();
    let cant2 = $("#cant-1").val();
    let description2 = $("#description-1");
    let price2 = $("#price-1").val();
    let precioMoneda = $("#precio_uno").val();
    let datas = [];

    for (let i = 1; i < nItem; i++) {
      let cant = $("#cant-" + i + "").val();
      let description = $("#description-" + i + "").val();
      let price = $("#price-" + i + "").val();

      datas.push({
        cant: cant,
        description: description,
        price: price,
      });
    }

    savedGeneratedQuo(id, description, datas, precioMoneda);
  });

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

  function savedGeneratedQuo(id, description, datas, precioMoneda) {
    console.log('id', id);
    console.log('description', description);
    console.log('datas', datas);
    console.log('precioMoneda',precioMoneda);
    
    
    
    
    // $.ajax({
    //   url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/savedGeneratedQuo.php",
    //   type: "POST",
    //   data: { id, description, datas, precioMoneda },
    // })
    //   .done(function (respuesta) {
    //     let data = JSON.parse(respuesta);
    //     if (data.registro === "correcto") {
    //       iziToast.success({
    //         title: "Exito",
    //         message: alertsTranslations.quoteGenerated,
    //         position: "topRight",
    //       });
    //       createdSessionCotizacion(data.id);
    //       $("#btnClosedModalReportSupport").click();
    //       $("#txtObservation").val();
    //       $("#cant-1").val("");
    //       $("#description-1").val("");
    //       $("#price-1").val("");
    //       let cant = $("#ih-cant").val();
    //       for (let i = 1; i < cant; i++) {
    //         $("#row-" + i).remove();
    //       }
    //       cant = 1;
    //       $("#ih-cant").val(cant);
    //       window.open(
    //         "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/reportQUO.php",
    //         "_blank"
    //       );
    //       let inputSearch = $("#searchreport").val();
    //       let dateFrom = $("#dateFrom").val();
    //       let status = $("#estatus").val();
    //       let dateTo = $("#dateTo").val();

    //       tablaconsulta(inputSearch, status, dateFrom, dateTo);
    //     }
    //   })
    //   .fail(function () {
    //     console.log("error");
    //   });
  }

  function createdSessionCotizacion(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/createSessionReportSupport.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {})
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnViewQuoteSupport", function () {
    let id = $(this).val();
    window.open(
      "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinCotizacion/classes/reportQUO.php?idCotizacion=" +
        id,
      "_blank"
    );
  });
});

jQuery(document).ready(function ($) {
  allPendingCardCount();

  function allPendingCardCount(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/reportespendientes.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#reportes-pendientes").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $('#reportes-pendientes').on('click', function(consulta){
    console.log('activadoo');
      $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/reportescompletados.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        console.log('respuesta', respuesta);
        $("#reportes-completados").html(respuesta);
      })
      .fail(function (error) {
        console.log("error", error);
      });
    
  })

});

jQuery(document).ready(function ($) {
  allPendingCirculatorCount();

  function allPendingCirculatorCount(consulta) {
    console.log('entree');
    console.log('consulta', consulta);
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/reportescompletados.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        console.log('respuesta', respuesta);
        $("#reportes-completados").html(respuesta);
      })
      .fail(function (error) {
        console.log("error", error);
      });
  }

  // $('#reportes-completados').on('click', async function(consulta){
  //   console.log('activadoo');
  //  await $.ajax({
  //     url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/reportescompletados.php",
  //     type: "POST",
  //     data: { consulta },
  //   })
  //     .done(function (respuesta) {
  //       console.log('respuesta', respuesta);
  //       $("#reportes-completados").html(respuesta);
  //     })
  //     .fail(function (error) {
  //       console.log("error", error);
  //     });
    
  // })

});

jQuery(document).ready(function ($) {
  $(document).on("click", "#btnEditreport", function () {
    let edit_id = $(this).val();

    console.log("detectó");

    let form = $(
      "<form action='https://dev.kalstein.plus/plataforma/index.php/kalstein-support/modreports/'" +
        "' method='get' hidden>" +
        "<input type='hidden' name='edit' value='" +
        edit_id +
        "' /></form>"
    );

    $("body").append(form);
    form.submit();
  });
});
