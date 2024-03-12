jQuery(document).ready(function ($) {
  //Funcion para mostrar la tabla de reportes
  let pagina = $(".pagina");
  let sig = $(".sig");
  let prev = $(".prev");
  let body = $("#tblListService");
  let page = pagina.text();
  let status = $("#estatus").val();
  let category = $("#category").val();

  function tablaconsulta(status, category, page, error) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/listservice.php",
      type: "POST",
      data: { status, category, page },
    })
      .done(function (respuesta) {
        console.log(respuesta);
        respuesta = JSON.parse("respuestaa", respuesta);
        body.html(respuesta.html);
        page = respuesta.pagina;
        pagina.text(page);
        page <= 1 ? prev.attr("disabled", "") : prev.removeAttr("disabled");
        page * 5 >= respuesta.total
          ? sig.attr("disabled", "")
          : sig.removeAttr("disabled");
        // console.log(page)
      })
      .fail(function () {
        console.log("errorrrr", error);
      });
  }

  tablaconsulta(status, category, page);
  sig.click((e) => {
    sig.attr("disable") ? e.preventDefault() : pagina.text(page++);
    tablaconsulta($("#estatus").val(), $("#category").val(), page);
  });
  prev.click((e) => {
    prev.attr("disable") ? e.preventDefault() : pagina.text(page--);
    tablaconsulta($("#estatus").val(), $("#category").val(), page);
  });

  $(document).on("change", "#estatus", function () {
    let status = $(this).val();
    let category = $("#category").val();
    tablaconsulta(status, category, page);
  });

  $(document).on("change", "#category", function () {
    let category = $(this).val();
    let status = $("#estatus").val();
    tablaconsulta(status, category, page);
  });

  $(document).on("click", "#Register_service", function () {
    let SE_servicio = $("#SEnombre").val();
    let SE_company = $("#SEcompany").val();
    let SE_agente = $("#SEagente").val();
    let SE_telefono = $("#SEtelefono").val();
    let SE_correo = $("#SEcorreo").val();
    let SE_pais = $("#SEpais").val();
    let SE_direccion = $("#SEdireccion").val();
    let SE_estadolugar = $("#SEestadoLugar").val();
    let SE_ciudad = $("#SEciudad").val();
    let SE_provincia = $("#SEprovincia").val();
    let SE_category = $("#SEcategory").val();
    let SE_estado = $("#SEestado").val();
    let SE_tiempo = $("#SEtiempoEstimado").val();
    let SE_descripcion = $("#SEdescription").val();

    let err_msg = "";

    if (SE_servicio === "") {
      iziToast.error({
        title: "Erreur",
        message: "name empty",
        position: "center",
      });
    } else {
      if (SE_category === "") {
        iziToast.error({
          title: "Erreur",
          message: "category empty",
          position: "center",
        });
      } else {
        if (SE_company === "") {
          iziToast.error({
            title: "Erreur",
            message: "company name empty",
            position: "center",
          });
        } else {
          if (SE_pais === "0") {
            iziToast.error({
              title: "Erreur",
              message: "country name empty",
              position: "center",
            });
          } else {
            if (SE_direccion === "") {
              iziToast.error({
                title: "Erreur",
                message: "address empty",
                position: "center",
              });
            } else {
              if (SE_agente === "") {
                iziToast.error({
                  title: "Erreur",
                  message: "service agent name empty",
                  position: "center",
                });
              } else {
                if (SE_correo === "") {
                  iziToast.error({
                    title: "Erreur",
                    message: "email empty",
                    position: "center",
                  });
                } else {
                  if (SE_descripcion === "") {
                    iziToast.error({
                      title: "Erreur",
                      message: "description empty",
                      position: "center",
                    });
                  } else {
                    if (SE_estado === "0") {
                      iziToast.error({
                        title: "Erreur",
                        message: "status empty",
                        position: "center",
                      });
                    } else {
                      if (SE_tiempo === "") {
                        iziToast.error({
                          title: "Erreur",
                          message: "expected time empty",
                          position: "center",
                        });
                      } else {
                        if (SE_tiempo < 0) {
                          iziToast.error({
                            title: "Erreur",
                            message: "expected time can not be less than 0",
                            position: "center",
                          });
                        } else {
                          if (SE_telefono === "") {
                            iziToast.error({
                              title: "Erreur",
                              message: "phone number empty",
                              position: "center",
                            });
                            err_msg == "";
                          } else {
                            if (SE_telefono <= 0) {
                              iziToast.error({
                                title: "Erreur",
                                message: "invalid phone number",
                                position: "center",
                              });
                            } else {
                              uploadFormData(
                                SE_servicio,
                                SE_company,
                                SE_agente,
                                SE_telefono,
                                SE_correo,
                                SE_pais,
                                SE_direccion,
                                SE_estadolugar,
                                SE_ciudad,
                                SE_provincia,
                                SE_category,
                                SE_descripcion,
                                SE_tiempo,
                                SE_estado
                              );
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  });

  function uploadFormData(
    SE_servicio,
    SE_company,
    SE_agente,
    SE_telefono,
    SE_correo,
    SE_pais,
    SE_direccion,
    SE_estadolugar,
    SE_ciudad,
    SE_provincia,
    SE_category,
    SE_descripcion,
    SE_tiempo,
    SE_estado
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/service_insert.php",
      type: "POST",
      data: {
        SE_servicio,
        SE_company,
        SE_agente,
        SE_telefono,
        SE_correo,
        SE_pais,
        SE_direccion,
        SE_estadolugar,
        SE_ciudad,
        SE_provincia,
        SE_category,
        SE_descripcion,
        SE_tiempo,
        SE_estado,
      },
      success: function (response) {
        let data = JSON.parse(response);
        if (data.status === "correcto") {
          iziToast.success({
            title: "Succès",
            message: "Data register successfully.",
            position: "center",
          });
          window.location.href =
            "https://dev.kalstein.plus/plataforma/index.php/support/services";
        }
      },
      error: function (xhr, status, error) {
        console.log(xhr.responseText);
      },
    });
  }
});

jQuery(document).ready(function ($) {
  //Haciendo todo esto de manera correcta debe de cargarte los datos

  $(document).on("click", "#actualizar_btn", function (e) {
    let actualizar_id = $("#dataEdit").val();
    let SE_servicio = $("#SEnombre").val();
    let SE_company = $("#SEcompany").val();
    let SE_agente = $("#SEagente").val();
    let SE_telefono = $("#SEtelefono").val();
    let SE_correo = $("#SEcorreo").val();
    let SE_pais = $("#SEpais").val();
    let SE_direccion = $("#SEdireccion").val();
    let SE_estadolugar = $("#SEestadoLugar").val();
    let SE_ciudad = $("#SEciudad").val();
    let SE_provincia = $("#SEprovincia").val();
    let SE_category = $("#SEcategory").val();
    let SE_estado = $("#SEestado").val();
    let SE_tiempo = $("#SEtiempoEstimado").val();
    let SE_descripcion = $("#SEdescription").val();

    if (SE_servicio === "") {
      iziToast.error({
        title: "Erreur",
        message: "name empty",
        position: "center",
      });
    } else {
      if (SE_category === "") {
        iziToast.error({
          title: "Erreur",
          message: "category empty",
          position: "center",
        });
      } else {
        if (SE_company === "") {
          iziToast.error({
            title: "Erreur",
            message: "company name empty",
            position: "center",
          });
        } else {
          if (SE_pais === "0") {
            iziToast.error({
              title: "Erreur",
              message: "country name empty",
              position: "center",
            });
          } else {
            if (SE_direccion === "") {
              iziToast.error({
                title: "Erreur",
                message: "address empty",
                position: "center",
              });
            } else {
              if (SE_agente === "") {
                iziToast.error({
                  title: "Erreur",
                  message: "service agent name empty",
                  position: "center",
                });
              } else {
                if (SE_correo === "") {
                  iziToast.error({
                    title: "Erreur",
                    message: "email empty",
                    position: "center",
                  });
                } else {
                  if (SE_descripcion === "") {
                    iziToast.error({
                      title: "Erreur",
                      message: "description empty",
                      position: "center",
                    });
                  } else {
                    if (SE_estado === "0") {
                      iziToast.error({
                        title: "Erreur",
                        message: "status empty",
                        position: "center",
                      });
                    } else {
                      if (SE_tiempo === "") {
                        iziToast.error({
                          title: "Erreur",
                          message: "expected time empty",
                          position: "center",
                        });
                      } else {
                        if (SE_tiempo < 0) {
                          iziToast.error({
                            title: "Erreur",
                            message: "expected time can not be less than 0",
                            position: "center",
                          });
                        } else {
                          if (SE_telefono === "") {
                            iziToast.error({
                              title: "Erreur",
                              message: "phone number empty",
                              position: "center",
                            });
                            err_msg == "";
                          } else {
                            if (SE_telefono <= 0) {
                              iziToast.error({
                                title: "Erreur",
                                message: "invalid phone number",
                                position: "center",
                              });
                            } else {
                              updateFormData(
                                actualizar_id,
                                SE_servicio,
                                SE_company,
                                SE_agente,
                                SE_telefono,
                                SE_correo,
                                SE_pais,
                                SE_direccion,
                                SE_estadolugar,
                                SE_ciudad,
                                SE_provincia,
                                SE_category,
                                SE_descripcion,
                                SE_tiempo,
                                SE_estado
                              );
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  });

  function updateFormData(
    actualizar_id,
    SE_servicio,
    SE_company,
    SE_agente,
    SE_telefono,
    SE_correo,
    SE_pais,
    SE_direccion,
    SE_estadolugar,
    SE_ciudad,
    SE_provincia,
    SE_category,
    SE_descripcion,
    SE_tiempo,
    SE_estado
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/service-update.php",
      type: "POST",
      data: {
        actualizar_id,
        SE_servicio,
        SE_company,
        SE_agente,
        SE_telefono,
        SE_correo,
        SE_pais,
        SE_direccion,
        SE_estadolugar,
        SE_ciudad,
        SE_provincia,
        SE_category,
        SE_descripcion,
        SE_tiempo,
        SE_estado,
      },
    })
      .done(function (response) {
        response = JSON.parse(response);
        if (response.status === "Correcto") {
          iziToast.success({
            title: "Succès",
            message: "Data updated successfully.",
            position: "center",
          });
          window.location.href =
            "https://dev.kalstein.plus/plataforma/index.php/support/services";
        } else {
          iziToast.error({
            title: "Erreur",
            message: "An error found.",
            position: "center",
          });
        }
      })
      .fail(function (xhr, status, error) {
        console.log(xhr.responseText);
      });
  }
});

jQuery(document).ready(function ($) {
  $(document).on("click", "#btn-service-details", function () {
    var service_id = $(this).val();

    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/serviceinfo.php",
      method: "POST",
      data: { service_id },
    }).done(function (response) {
      // console.log(response)
      let res = JSON.parse(response);

      res.forEach((elem) => {
        SE_descripcion = elem.SE_descripcion;
        var details = SE_descripcion + "<br>";

        iziToast.show({
          title: "Service description: ",
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
  category();
  function category(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/category_product.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#SEcategory").html(respuesta);
        $("#SEAcategory").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }
});

jQuery(document).ready(function ($) {
  $(document).on("click", "#btnEditService", function () {
    let edit_id = $(this).val();
    console.log("detectó");

    let form = $(
      "<form action='https://dev.kalstein.plus/plataforma/index.php/support/services/edit/' method='get' hidden>" +
        "<input type='hidden' name='edit' value='" +
        edit_id +
        "' /></form>"
    );

    $("body").append(form);
    form.submit();
  });
});

jQuery(document).ready(function ($) {
  searchCountry();

  function searchCountry(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/pais.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#SEpais").html(respuesta);
        $("#SEApais").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }
});

jQuery(document).ready(function ($) {
  // Sección: Eliminar producto desde el botón de la página

  $(document).on("click", "#btnDeleteService", function () {
    let delete_aid = $(this).val();

    // Mostrar una alerta de confirmación usando IziToast
    iziToast.question({
      title: "Confirmation",
      message: "Êtes-vous sûr de vouloir supprimer ce service ?",
      close: false,
      overlay: true,
      timeout: false,
      position: "center",
      buttons: [
        [
          "<button><b>Yes</b></button>",
          function (instance, toast) {
            // Realizar una solicitud AJAX para eliminar el servicio
            $.ajax({
              url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/delete-service.php",
              type: "POST",
              data: { delete_aid },
            })
              .done(function (response) {
                // console.log(response);

                if (response === "done") {
                  iziToast.success({
                    title: "Succès",
                    message: "Service supprimé.",
                    position: "center",
                    onClosing: function () {
                      setTimeout(function () {
                        window.location.href =
                          "https://dev.kalstein.plus/plataforma/index.php/support/services";
                      }, 1000);
                    },
                  });
                } else {
                  iziToast.error({
                    title: "Erreur",
                    message: "Service non supprimé",
                    position: "center",
                  });
                }
              })
              .fail(function () {
                iziToast.error({
                  title: "Erreur",
                  message: "Impossible de se connecter à la base de données",
                  position: "center",
                });
              });

            instance.hide({ transitionOut: "fadeOut" }, toast, "button");
          },
          true,
        ],
        [
          "<button>No</button>",
          function (instance, toast) {
            instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            iziToast.error({
              title: "Erreur",
              message: "Suppression du service annulée.",
              position: "center",
            });
          },
        ],
      ],
    });
  });
});
