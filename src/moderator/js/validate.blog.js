var verify = false;

jQuery(document).ready(function ($) {
  // IDs de los checkboxes a validar
  let ids = [
    "name",
    "promotions-i",
    "quality-i",
    "professionalism-i",
    "promotions-d",
    "professionalism-d",
  ];

  let checks = [];

  for (let id of ids) {
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
                        <h4 class="text-white pb-0">Denegate</h4>
                    </button>
                `);
      } else {
        let allChecked = checks.every((check) => check);

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
  }

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
                url: "your_validate_url.php",
                type: "POST",
                data: { artId },
              })
                .done(function (response) {
                  if (JSON.parse(response).status == "correcto") {
                    iziToast.success({
                      overlay: true,
                      title: "Success",
                      message: "Validation successful!",
                      position: "center",
                    });
                    window.location.href = "your_redirect_url.php";
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
