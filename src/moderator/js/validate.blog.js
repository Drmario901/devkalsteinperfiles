var verify = false;
var plugin_dir =
  "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/";

jQuery(document).ready(function ($) {
  // IDs de los checkboxes a validar
  let ids = [
    "name",
    "promotions-a",
    "quality-a",
    "professionalism-a",
    "promotions-b",
    "professionalism-b",
    "name-a",
    "promotions-c",
    "professionalism-c",
    "name-b",
    "promotions-d",
    "professionalism-d",
    "name-c",
    "promotions-e",
    "professionalism-e",
  ];

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

  // Subida de artículos
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
        message: "Are you sure you want <b>validate</b> this article?",
        position: "center",
        buttons: [
          [
            "<button><b>Yes</b></button>",
            function (instance, toast) {
              instance.hide({ transitionOut: "fadeOut" }, toast, "button");

              let artId = "<?php echo $artId; ?>";

              $.ajax({
                url: plugin_dir + "php/moderator/validateBlog.php",
                type: "POST",
                data: { artId },
              })
                .done(function (response) {
                  if (JSON.parse(response).status == "correcto") {
                    console.log("response");
                    iziToast.success({
                      overlay: true,
                      title: "Success",
                      message: "Validation successful!",
                      position: "center",
                    });
                    /* window.location.href =
                      "https://dev.kalstein.plus/plataforma/moderator/blog/"; */
                  } else {
                    iziToast.error({
                      overlay: true,
                      title: "Error",
                      message: "Error trying to validate the article!",
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
          message: "Are you sure you want <b>deny</b> this article?",
          position: "center",
          buttons: [
            [
              "<button><b>Yes</b></button>",
              function (instance, toast) {
                instance.hide({ transitionOut: "fadeOut" }, toast, "button");

                let artId = "<?php echo $artId; ?>";
                let msg = $("#message").val();
                let strike = document.querySelector("#strike").checked;

                $.ajax({
                  url: "your_deny_url.php",
                  type: "POST",
                  data: { artId, msg, strike },
                })
                  .done(function (response) {
                    if (JSON.parse(response).status == "correcto") {
                      iziToast.success({
                        overlay: true,
                        title: "Success",
                        message: "Message sent successfully!",
                        position: "center",
                      });
                      window.location.href = "your_redirect_url.php";
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
