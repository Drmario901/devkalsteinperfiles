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
    "nombre",
    "passport",
    "name-b",
    "country-b",
    "zipcode-b",
    "adress-b",
    "phone-b",
    "web-b",
    "rif-b",
  ];

  let discountGilson = $("#discountGilson").val();

  checks = [];

  for (id of ids) {
    checks.push(false);
  }

  for (let i = 0; i < ids.length; i++) {
    let id = ids[i];

    $(document).on("change", "#" + id, function () {
      console.log("aaa");
      checks[i] = this.checked;

      if (!this.checked) {
        verify = false;
        $("#message").removeAttr("hidden");
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
          $("#btnValidate").html(`
                        <button type='button' class='btn btn-info btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">${alertsTranslations.verify}</h4>
                        </button>
                    `);
        } else {
          verify = false;
          $("#message").removeAttr("hidden");
          $("#btnValidate").html(`
                        <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">${alertsTranslations.denegate}</h4>
                        </button>
                    `);
        }
      }
    });
  }
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
        message: `Are you sure you want <b>${alertsTranslations.validate}</b> this account?`,
        position: "center",
        buttons: [
          [
            "<button><b>Yes</b></button>",
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");

              let acc_id = $("#acc_id").val();
              let email = $("#e-mail").val();
              let discountGilson = $("#discountGilson").val();
              console.log(discountGilson);
              $.ajax({
                url: plugin_dir + "/php/validateAcc.php",
                type: "POST",
                data: { acc_id, email, discountGilson },
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
                        message: alertsTranslations.validateSuccess,
                        position: "center",
                      });
                      window.location.href =
                        "https://dev.kalstein.plus/plataforma/index.php/moderator/accounts";
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
          message: alertsTranslations.areYouSureWantToDenyThisAccount,
          position: "center",
          buttons: [
            [
              "<button><b>Yes</b></button>",
              function (instance, toast) {
                instance.hide({ transitionOut: "fadeOut" }, toast, "button");

                let acc_id = $("#acc_id").val();
                let email = $("#e-mail").val();
                let msg = $("#message").val();

                $.ajax({
                  url: plugin_dir + "php/denegateAcc.php",
                  type: "POST",
                  data: { acc_id, email, msg },
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
                          "https://dev.kalstein.plus/plataforma/index.php/moderator/accounts";
                      } else {
                        iziToast.error({
                          overlay: true,
                          title: alertsTranslations.error,
                          message: alertsTranslations.errorTryingToAccessUser,
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
});

jQuery(document).ready(function ($) {
  $("account");
});
