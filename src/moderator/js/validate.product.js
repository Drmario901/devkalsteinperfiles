var verify = false;

var plugin_dir =
  "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/";
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

jQuery(document).ready(function ($) {
  // actualizacion de boton
  ids = [
    "name",
    "model",
    "promotions-i",
    "quality-i",
    "professionalism-i",
    "accessories",
    "category",
    "brand",
    "promotions-d",
    "professionalism-d",
    "measures",
    "measures-p",
    "catalog",
    "manual",
    "wholesale",
  ];

  checks = [];

  for (id of ids) {
    checks.push(false);
  }

  for (let i = 0; i < ids.length; i++) {
    let id = ids[i];

    checks[i] = document.querySelector("#" + id).checked;

    $(document).on("change", "#" + id, function () {
      checks[i] = this.checked;

      if (!this.checked) {
        verify = false;
        $("#message").removeAttr("hidden");
        $("#strikeContainer").removeAttr("hidden");
        $("#btnValidate").html(`
                    <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                        <h4 class="text-white pb-0">${alertsTranslations.denegate}</h4>
                    </button>
                `);
      } else {
        let green = true;

        for (check of checks) {
          if (!check) {
            green = false;
            break;
          }
        }

        if (green) {
          verify = true;
          $("#message").attr("hidden", "");
          $("#strikeContainer").attr("hidden", "");
          $("#btnValidate").html(`
                        <button type='button' class='btn btn-info btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">${alertsTranslations.verify}</h4>
                        </button>
                    `);
        } else {
          verify = false;
          $("#message").removeAttr("hidden");
          $("#strikeContainer").removeAttr("hidden");
          $("#btnValidate").html(`
                        <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">${alertsTranslations.denegate}</h4>
                        </button>
                    `);
        }
      }
    });
  }

  // subida de productos

  //apply gilson discount

  $(document).on("click", "#btnDiscountGilson", function () {
    let discount = $("#discountGilson").val();
    let id = $("#p-id").val();
    let price = $("#price").val();
    let priceGilsonEl = $("#priceGilson");

    let priceGilson = price - (price * discount) / 100;

    $.ajax({
      url: plugin_dir + "php/moderator/applyGilsonDiscount.php",
      type: "POST",
      data: { discount, id },
    })
      .done(function (response) {
        console.log(response);
        if (response.status == "correcto") {
          iziToast.success({
            overlay: true,
            title: alertsTranslations.exito,
            message: alertsTranslations.discountAppliedSuccessfully,
            position: "center",
          });
          priceGilsonEl.text(response.priceGilson);
        } else {
          iziToast.error({
            overlay: true,
            title: alertsTranslations.error,
            message: alertsTranslations.errorApplyingDiscount,
            position: "center",
          });
        }
      })
      .fail(function () {
        iziToast.error({
          overlay: true,
          title: alertsTranslations.error,
          message: alertsTranslations.couldNotRetrieveInfoFromDatabase,
          position: "center",
        });
      });
  });
});

jQuery(document).ready(function ($) {
  $(document).on("click", "#btnValidate", function () {
    if (verify) {
      iziToast.question({
        timeout: false,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        title: alertsTranslations.confirmacion,
        message: alertsTranslations.areYouSureWantToValidateThisProduct,
        position: "center",
        buttons: [
          [
            `<button><b>${alertsTranslations.yes}</b></button>`,
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");

              let p_id = $("#p-id").val();

              $.ajax({
                url: plugin_dir + "php/validateProduct.php",
                type: "POST",
                data: { p_id },
              })
                .done(function (response) {
                  if (JSON.parse(response).status == "busy") {
                    iziToast.error({
                      overlay: true,
                      title: alertsTranslations.error,
                      message:
                        alertsTranslations.anotherModeratorHasAlreadyDonethisAction,
                      position: "center",
                    });
                  } else {
                    if (JSON.parse(response).status == "correcto") {
                      iziToast.success({
                        overlay: true,
                        title: alertsTranslations.exito,
                        message: alertsTranslations.validateSuccess,
                        position: "center",
                      });
                      window.location.href =
                        "https://dev.kalstein.plus/plataforma/index.php/moderator/products";
                    } else {
                      iziToast.error({
                        overlay: true,
                        title: alertsTranslations.error,
                        message: alertsTranslations.errorValidatingUser,
                        position: "center",
                      });
                    }
                  }
                })
                .fail(function () {
                  iziToast.error({
                    overlay: true,
                    title: alertsTranslations.error,
                    message:
                      alertsTranslations.couldNotRetrieveInfoFromDatabase,
                    position: "center",
                  });
                });
            },
            true,
          ],
          [
            "<button>No</button>",
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            },
          ],
        ],
      });
    } else {
      if ($("#message").val() != "") {
        iziToast.question({
          timeout: false,
          close: false,
          overlay: true,
          displayMode: "once",
          id: "question",
          zindex: 999,
          title: alertsTranslations.confirmacion,
          message: alertsTranslations.areYouSureWantToDenyThisProduct,
          position: "center",
          buttons: [
            [
              `<button><b>${alertsTranslations.yes}</b></button>`,
              function (instance, toast) {
                instance.hide({ transitionOut: "fadeOut" }, toast, "button");

                let p_id = $("#p-id").val();
                let msg = $("#message").val();
                let strike = document.querySelector("#strike").checked;

                $.ajax({
                  url: plugin_dir + "php/denegateProduct.php",
                  type: "POST",
                  data: { p_id, msg, strike },
                })
                  .done(function (response) {
                    console.log(response);
                    if (JSON.parse(response).status == "busy") {
                      iziToast.error({
                        overlay: true,
                        title: alertsTranslations.error,
                        message:
                          alertsTranslations.anotherModeratorHasAlreadyDonethisAction,
                        position: "center",
                      });
                    } else {
                      if (JSON.parse(response).status == "correcto") {
                        iziToast.success({
                          overlay: true,
                          title: alertsTranslations.exito,
                          message: alertsTranslations.messageSentSuccessfully,
                          position: "center",
                        });
                        window.location.href =
                          "https://dev.kalstein.plus/plataforma/index.php/moderator/products";
                      } else {
                        iziToast.error({
                          overlay: true,
                          title: alertsTranslations.error,
                          message: alertsTranslations.errorSendingMessage,
                          position: "center",
                        });
                      }
                    }
                  })
                  .fail(function () {
                    iziToast.error({
                      overlay: true,
                      title: alertsTranslations.error,
                      message:
                        alertsTranslations.couldNotRetrieveInfoFromDatabase,
                      position: "center",
                    });
                  });
              },
              true,
            ],
            [
              "<button>No</button>",
              function (instance, toast) {
                instance.hide({ transitionOut: "fadeOut" }, toast, "button");
              },
            ],
          ],
        });
      } else {
        iziToast.error({
          overlay: true,
          title: alertsTranslations.warning,
          message: alertsTranslations.specifyReasonOfDeny,
          position: "center",
        });
      }
    }
  });

  $(document).on("click", ".btn-view-accessory", function () {
    var quote_id = $(this).data().id;
    console.log(quote_id);

    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/manufacturer/getAccessoryInfo.php",
      method: "POST",
      data: { quote_id },
    })
      .done(function (response) {
        console.log(response);

        let res = JSON.parse(response);

        res.forEach((elem) => {
          productName = elem.product_name;
          productModel = elem.product_model;
          product_description = elem.product_description;
          productImage = elem.product_image;
          product_price = elem.product_price;

          var details =
            `${alertsTranslations.nombreDelProducto}: ${productName} <br>` +
            `${alertsTranslations.modelProduct}: ${productModel} <br>` +
            `${alertsTranslations.description}: ${product_description} <br>` +
            `${alertsTranslations.price}: ${product_price} <br>` +
            `${alertsTranslations.image}: <img style="max-width: 200px;" src="https://kalstein.net/es/wp-content/uploads/kalsteinQuote/'${productImage}'">`;

          iziToast.show({
            title: "Detalles",
            message: details,
            position: "center",
            timeout: false,
            closeOnClick: true,
            progressBar: false,
          });
        });
      })
      .fail(function () {
        iziToast.error({
          title: alertsTranslations.error,
          message: alertsTranslations.couldNotRetrieveInfoFromDatabase,
          position: "center",
          timeout: false,
          closeOnClick: true,
          progressBar: false,
        });
      });
  });
});
