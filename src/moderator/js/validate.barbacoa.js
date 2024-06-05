var verify = false;
var plugin_dir =
  "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/";

jQuery(document).ready(function ($) {
  // IDs de los checkboxes estáticos
  let staticIds = [
    "name_1",
    "promotions_i_1",
    "quality_i_1",
    "professionalism_i_1",
    "promotions_d_1",
    "professionalism_d_1",
    "name_2",
    "promotions_i_2",
    "quality_i_2",
    "professionalism_i_2",
    "promotions_d_2",
    "professionalism_d_2",
    "name_3",
    "promotions_i_3",
    "quality_i_3",
    "professionalism_i_3",
    "promotions_d_3",
    "professionalism_d_3",
    "name_4",
    "promotions_i_4",
    "quality_i_4",
    "professionalism_i_4",
    "promotions_d_4",
    "professionalism_d_4",
    "product1_name",
    "product1_model",
    "product2_name",
    "product2_model",
    "product3_name",
    "product3_model",
    "product4_name",
    "product4_model",
    "bestSeller_name",
    "bestSeller_model",
    "video_url",
    "promotions_i_video",
    "professionalism_i_video",
  ];

  let dynamicIds = [];
  $("input[type=checkbox]").each(function () {
    let id = $(this).attr("id");
    if (id && id !== "strike" && !staticIds.includes(id)) {
      dynamicIds.push(id);
    }
  });

  let ids = staticIds.concat(dynamicIds);

  let checks = {};

  // Inicializar checks con el estado actual de los checkboxes
  ids.forEach((id) => {
    let element = document.querySelector("#" + id);
    if (element) {
      checks[id] = element.checked;
    }
  });

  ids.forEach((id) => {
    $(document).on("change", "#" + id, function () {
      checks[id] = this.checked;

      if (!this.checked) {
        verify = false;
        $("#message").removeAttr("hidden");
        $("#strikeContainer").removeAttr("hidden");
        $("#btnValidate").html(`
                    <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                        <h4 class="text-white pb-0">Denegate</h4>
                    </button>
                `);
      } else {
        let allChecked = Object.values(checks).every((check) => check);

        if (allChecked) {
          verify = true;
          $("#message").attr("hidden", "");
          $("#strikeContainer").attr("hidden", "");
          $("#btnValidate").html(`
                        <button type='button' class='btn btn-success btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">Validate</h4>
                        </button>
                    `);
        } else {
          verify = false;
          $("#message").removeAttr("hidden");
          $("#strikeContainer").removeAttr("hidden");
          $("#btnValidate").html(`
                        <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                            <h4 class="text-white pb-0">Denegate</h4>
                        </button>
                    `);
        }
      }
    });
  });

  // Subida de guías
  $(document).on("click", "#btnValidate button", function () {
    if (verify) {
      iziToast.question({
        timeout: false,
        close: false,
        overlay: true,
        displayMode: "once",
        id: "question",
        zindex: 999,
        title: "Confirmation",
        message: "Are you sure you want <b>validate</b> this guide?",
        position: "center",
        buttons: [
          [
            "<button><b>Yes</b></button>",
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");

              let guideId = document.querySelector("#guideId").value;

              $.ajax({
                url: plugin_dir + "php/moderator/validateGuide.php",
                type: "POST",
                data: { guideId },
              })
                .done(function (response) {
                  if (JSON.parse(response).status == "correcto") {
                    iziToast.success({
                      overlay: true,
                      title: "Success",
                      message: "Validation successful!",
                      position: "center",
                    });
                    window.location.href =
                      "https://dev.kalstein.plus/plataforma/moderator/guide/";
                  } else {
                    iziToast.error({
                      overlay: true,
                      title: "Error",
                      message: "Error trying to validate the guide!",
                      position: "center",
                    });
                  }
                })
                .fail(function () {
                  iziToast.error({
                    overlay: true,
                    title: "Error",
                    message: "Unable to connect with the database!",
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
          title: "Confirmation",
          message: "Are you sure you want <b>deny</b> this guide?",
          position: "center",
          buttons: [
            [
              "<button><b>Yes</b></button>",
              function (instance, toast) {
                instance.hide({ transitionOut: "fadeOut" }, toast, "button");

                let guideId = document.querySelector("#guideId").value;
                let msg = $("#message").val();
                let strike = document.querySelector("#strike").checked;

                $.ajax({
                  url: plugin_dir + "php/moderator/denyGuide.php",
                  type: "POST",
                  data: { guideId, msg, strike },
                })
                  .done(function (response) {
                    if (JSON.parse(response).status == "correcto") {
                      iziToast.success({
                        overlay: true,
                        title: "Success",
                        message: "Message sent successfully!",
                        position: "center",
                      });
                      window.location.href =
                        "https://dev.kalstein.plus/plataforma/moderator/guide/";
                    } else {
                      iziToast.error({
                        overlay: true,
                        title: "Error",
                        message: "Error trying to send message!",
                        position: "center",
                      });
                    }
                  })
                  .fail(function () {
                    iziToast.error({
                      overlay: true,
                      title: "Error",
                      message: "Unable to connect with the database!",
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
          title: "Warning",
          message: "Specify in the text field the reasons for the denial!",
          position: "center",
        });
      }
    }
  });
});
