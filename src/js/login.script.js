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
        console.log(alertsTranslations);
      });
  };

  loadTranslations(cookieLng);

  var path = $(location).attr("pathname");

  if (path == "/registrarse/") {
    accNotValidated();
  }

  function getIPAddress() {
    $.getJSON("https://api.ipify.org?format=json", function (dataIP) {
      $("#ipConnect").val(dataIP.ip);
    });
  }
  getIPAddress();
  issetSessionUser();

  $(document).ready(function () {
    $(document).on("click", "#btnContinueLogIn", function () {
      let user = $("#emailUser").val();
      let password = $("#passwordGrid").val();
      if (user == "") {
        alert("El correo es requerido");
      } else {
        if (user.includes("@")) {
          let position = user.indexOf("@");
          let newUser = user.substr(position);
          if (newUser.includes(".")) {
            validarCorreoLogin(user);
          } else {
            $(".emailError").css({ display: "block" });
            $("#emailUser").focus();
          }
        } else {
          $(".emailError").css({ display: "block" });
          $("#emailUser").focus();
        }
      }
    });

    $(document).on("click", "#btnContinueLogIn2", function () {
      let ip = $("#ipConnect").val();
      let browser = "";

      if (
        navigator.userAgent.includes("Chrome") &&
        !navigator.userAgent.includes("Edg")
      ) {
        browser = "Chrome";
      } else if (navigator.userAgent.includes("Edg")) {
        browser = "Edge";
      } else if (navigator.userAgent.includes("Safari")) {
        browser = "Safari";
      } else if (navigator.userAgent.includes("Firefox")) {
        browser = "Firefox";
      } else if (navigator.userAgent.includes("Opera")) {
        browser = "Opera";
      } else if (navigator.userAgent.includes("Trident")) {
        browser = "Internet Explorer";
      } else if (navigator.userAgent.includes("YaBrowser")) {
        browser = "Yandex Browser";
      } else if (navigator.userAgent.includes("OPR")) {
        browser = "Opera";
      } else if (navigator.userAgent.includes("UCBrowser")) {
        browser = "UC Browser";
      } else if (navigator.userAgent.includes("FxiOS")) {
        browser = "Firefox for iOS";
      } else if (navigator.userAgent.includes("CriOS")) {
        browser = "Chrome for iOS";
      } else if (navigator.userAgent.includes("fxios")) {
        browser = "Firefox for iOS";
      } else {
        browser = "Unknown browser";
      }

      let user = $("#emailUser").val();
      let password = $("#passwordGrid").val();
      if (password == "") {
        alert("Password is required");
      } else {
        accessAccount(user, password, ip, browser);
      }
    });
  });

  $(document).on("click", "#btnContinueSignUp", function () {
    let user = $("#emailUser").val();

    let password = $("#passwordGrid").val();

    let telefono = $("#telefono").val();

    if (user == "") {
      alert("Mail is required");
    } else {
      if (user.includes("@")) {
        let position = user.indexOf("@");

        let newUser = user.substr(position);

        if (newUser.includes(".")) {
          validarCorreo(user);
        } else {
          $(".emailError").css({ display: "block" });

          $("#emailUser").focus();
        }
      } else {
        $(".emailError").css({ display: "block" });

        $("#emailUser").focus();
      }
    }
  });

  $(document).on("click", "#btnContinueSignUp4", function () {
    $(".c-codeRequest").css({ display: "block" });
    $(".c-password").css({ display: "block" });
  });

  $(document).on("click", "#btnContinueSignUp2", function () {
    let user = $("#emailUser").val();

    let userTag = $("#userTag").val();

    let password = $("#passwordGrid").val();

    let telefono = $("#telefono").val();

    if (password == "") {
      alert("Password is required");
    } else {
      if (
        $(".p01").hasClass("aprobado") &&
        $(".p02").hasClass("aprobado") &&
        $(".p03").hasClass("aprobado") &&
        $(".p04").hasClass("aprobado") &&
        $(".p05").hasClass("aprobado")
      ) {
        registrarCuenta(user, userTag, password, telefono);
      } else {
        $("#passwordGrid").focus();

        $("#passwordGrid").css({ outline: "2px solid #de3a46" });
      }
    }
  });

  $(document).on("click", "#btnForgotPassword", function (e) {
    e.preventDefault();

    let email = $("#emailUser").val();

    let positionAroba = email.indexOf("@");

    let lettersBeferoAroba = email.substr(0, positionAroba);

    let letterAfterAroba = email.substr(positionAroba);

    let cantLetter = lettersBeferoAroba.length;

    let midString = parseInt(cantLetter) / parseInt(2);

    let round = Math.round(midString);

    let letterBefore = lettersBeferoAroba.substr(0, round);

    let letterReplace = lettersBeferoAroba.substr(round, cantLetter);

    let asteriskos =
      "**********************************************************************************************************";

    let asteriskosCant = asteriskos.substr(0, round);

    let replace = letterReplace.replace(letterReplace, asteriskosCant);

    let emailChange = letterBefore + "" + replace + "" + letterAfterAroba;

    $("#pMsjSendingResetPassword").html(
      '<span data-i18n="account:confirmEmail" ></span> <b>' +
        emailChange +
        '</b> <span data-i18n="account:sendLinkPassword"></span>'
    );

    $("#contentLogin").css({ display: "none" });

    $("#contentEmailSendingRecovery").css({ display: "block" });

    $("#emailUserConfirm").focus();
  });

  $(document).on("click", "#back", function (e) {
    e.preventDefault();

    location.reload();
  });

  $(document).on("click", "#btnValidatedEmail", function () {
    let email = $("#emailUser").val();

    let confirmEmail = $("#emailUserConfirm").val();

    if (email == "") {
      alert("Mail is required");
    } else {
      if (email.includes("@")) {
        let position = email.indexOf("@");

        let newUser = email.substr(position);

        if (newUser.includes(".")) {
          if (email == confirmEmail) {
            sendLinkRecoveryPassword(confirmEmail);
          } else {
            $(".emailErrorRecoveryPassword").css({ display: "block" });

            $("#emailUserConfirm").focus();
          }
        } else {
          $(".emailErrorRecoveryPassword").css({ display: "block" });

          $("#emailUserConfirm").focus();
        }
      } else {
        $(".emailErrorRecoveryPassword").css({ display: "block" });

        $("#emailUserConfirm").focus();
      }
    }
  });

  $(document).on("keyup", "#emailUserConfirm", function () {
    $(".emailErrorRecoveryPassword").css({ display: "none" });
  });

  $(document).on("click", "#btnContinueSignUp3", function () {
    let code = $("#txtCodeVerification").val();

    validarCode(code);
  });

  $(document).on("keyup", "#emailUser", function () {
    $(".emailError").css({ display: "none" });

    $(".availableMail").css({ display: "none" });

    $(".mailExists").css({ display: "none" });

    $(".emailNoRegister").css({ display: "none" });
  });

  $(document).on("keyup", "#txtCodeVerification", function () {
    $(".codeExpired").css({ display: "none" });

    $(".codeError").css({ display: "none" });
  });

  $(document).on("keyup", "#passwordGrid", function (e) {
    let valor = $(this).val();

    $("#passwordGrid").css({ outline: "1px solid #213280" });

    $(".passwordIncorrect").css({ display: "none" });

    if (
      valor.includes("A") ||
      valor.includes("B") ||
      valor.includes("C") ||
      valor.includes("D") ||
      valor.includes("E") ||
      valor.includes("F") ||
      valor.includes("G") ||
      valor.includes("H") ||
      valor.includes("I") ||
      valor.includes("J") ||
      valor.includes("K") ||
      valor.includes("L") ||
      valor.includes("M") ||
      valor.includes("N") ||
      valor.includes("Ñ") ||
      valor.includes("O") ||
      valor.includes("P") ||
      valor.includes("Q") ||
      valor.includes("R") ||
      valor.includes("S") ||
      valor.includes("T") ||
      valor.includes("U") ||
      valor.includes("V") ||
      valor.includes("W") ||
      valor.includes("X") ||
      valor.includes("Y") ||
      valor.includes("Z")
    ) {
      $(".p03").css({ color: "#229e1e" });

      $(".p03").addClass("aprobado");
    } else {
      $(".p03").css({ color: "#000" });

      $(".p03").removeClass("aprobado");
    }

    if (
      valor.includes("a") ||
      valor.includes("b") ||
      valor.includes("c") ||
      valor.includes("d") ||
      valor.includes("e") ||
      valor.includes("f") ||
      valor.includes("g") ||
      valor.includes("h") ||
      valor.includes("i") ||
      valor.includes("j") ||
      valor.includes("k") ||
      valor.includes("l") ||
      valor.includes("m") ||
      valor.includes("n") ||
      valor.includes("ñ") ||
      valor.includes("o") ||
      valor.includes("p") ||
      valor.includes("q") ||
      valor.includes("r") ||
      valor.includes("s") ||
      valor.includes("t") ||
      valor.includes("u") ||
      valor.includes("v") ||
      valor.includes("w") ||
      valor.includes("x") ||
      valor.includes("y") ||
      valor.includes("z")
    ) {
      $(".p02").css({ color: "#229e1e" });

      $(".p02").addClass("aprobado");
    } else {
      $(".p02").css({ color: "#000" });

      $(".p02").removeClass("aprobado");
    }

    if (
      valor.includes("0") ||
      valor.includes("1") ||
      valor.includes("2") ||
      valor.includes("3") ||
      valor.includes("4") ||
      valor.includes("5") ||
      valor.includes("6") ||
      valor.includes("7") ||
      valor.includes("8") ||
      valor.includes("9")
    ) {
      $(".p04").css({ color: "#229e1e" });

      $(".p04").addClass("aprobado");
    } else {
      $(".p04").css({ color: "#000" });

      $(".p04").removeClass("aprobado");
    }

    if (
      valor.includes("!") ||
      valor.includes('"') ||
      valor.includes("#") ||
      valor.includes("$") ||
      valor.includes("%") ||
      valor.includes("&") ||
      valor.includes("/") ||
      valor.includes("(") ||
      valor.includes(")") ||
      valor.includes("=") ||
      valor.includes("?") ||
      valor.includes("¡") ||
      valor.includes("¿") ||
      valor.includes("+") ||
      valor.includes("*") ||
      valor.includes("[") ||
      valor.includes("]") ||
      valor.includes("{") ||
      valor.includes("}") ||
      valor.includes(",") ||
      valor.includes(";") ||
      valor.includes(".") ||
      valor.includes(":") ||
      valor.includes("-") ||
      valor.includes("_") ||
      valor.includes("@") ||
      valor.includes("|")
    ) {
      $(".p05").css({ color: "#229e1e" });

      $(".p05").addClass("aprobado");
    } else {
      $(".p05").css({ color: "#000" });

      $(".p05").removeClass("aprobado");
    }

    if (valor.length >= 8) {
      $(".p01").css({ color: "#229e1e" });

      $(".p01").addClass("aprobado");
    } else {
      $(".p01").css({ color: "#000" });

      $(".p01").removeClass("aprobado");
    }

    //if (e.which >= 97 && e.which <= 122){

    //    $('.p02').css({'color' : '#229e1e'})

    //}
  });

  $(document).on("keyup", "#newPassword", function (e) {
    $(".confirmPassword").css({ display: "block" });

    let valor = $(this).val();

    $("#passwordGrid").css({ outline: "1px solid #213280" });

    $(".passwordIncorrect").css({ display: "none" });

    if (
      valor.includes("A") ||
      valor.includes("B") ||
      valor.includes("C") ||
      valor.includes("D") ||
      valor.includes("E") ||
      valor.includes("F") ||
      valor.includes("G") ||
      valor.includes("H") ||
      valor.includes("I") ||
      valor.includes("J") ||
      valor.includes("K") ||
      valor.includes("L") ||
      valor.includes("M") ||
      valor.includes("N") ||
      valor.includes("Ñ") ||
      valor.includes("O") ||
      valor.includes("P") ||
      valor.includes("Q") ||
      valor.includes("R") ||
      valor.includes("S") ||
      valor.includes("T") ||
      valor.includes("U") ||
      valor.includes("V") ||
      valor.includes("W") ||
      valor.includes("X") ||
      valor.includes("Y") ||
      valor.includes("Z")
    ) {
      $(".p03").css({ color: "#229e1e" });

      $(".p03").addClass("aprobado");
    } else {
      $(".p03").css({ color: "#000" });

      $(".p03").removeClass("aprobado");
    }

    if (
      valor.includes("a") ||
      valor.includes("b") ||
      valor.includes("c") ||
      valor.includes("d") ||
      valor.includes("e") ||
      valor.includes("f") ||
      valor.includes("g") ||
      valor.includes("h") ||
      valor.includes("i") ||
      valor.includes("j") ||
      valor.includes("k") ||
      valor.includes("l") ||
      valor.includes("m") ||
      valor.includes("n") ||
      valor.includes("ñ") ||
      valor.includes("o") ||
      valor.includes("p") ||
      valor.includes("q") ||
      valor.includes("r") ||
      valor.includes("s") ||
      valor.includes("t") ||
      valor.includes("u") ||
      valor.includes("v") ||
      valor.includes("w") ||
      valor.includes("x") ||
      valor.includes("y") ||
      valor.includes("z")
    ) {
      $(".p02").css({ color: "#229e1e" });

      $(".p02").addClass("aprobado");
    } else {
      $(".p02").css({ color: "#000" });

      $(".p02").removeClass("aprobado");
    }

    if (
      valor.includes("0") ||
      valor.includes("1") ||
      valor.includes("2") ||
      valor.includes("3") ||
      valor.includes("4") ||
      valor.includes("5") ||
      valor.includes("6") ||
      valor.includes("7") ||
      valor.includes("8") ||
      valor.includes("9")
    ) {
      $(".p04").css({ color: "#229e1e" });

      $(".p04").addClass("aprobado");
    } else {
      $(".p04").css({ color: "#000" });

      $(".p04").removeClass("aprobado");
    }

    if (
      valor.includes("!") ||
      valor.includes('"') ||
      valor.includes("#") ||
      valor.includes("$") ||
      valor.includes("%") ||
      valor.includes("&") ||
      valor.includes("/") ||
      valor.includes("(") ||
      valor.includes(")") ||
      valor.includes("=") ||
      valor.includes("?") ||
      valor.includes("¡") ||
      valor.includes("¿") ||
      valor.includes("+") ||
      valor.includes("*") ||
      valor.includes("[") ||
      valor.includes("]") ||
      valor.includes("{") ||
      valor.includes("}") ||
      valor.includes(",") ||
      valor.includes(";") ||
      valor.includes(".") ||
      valor.includes(":") ||
      valor.includes("-") ||
      valor.includes("_") ||
      valor.includes("@") ||
      valor.includes("|")
    ) {
      $(".p05").css({ color: "#229e1e" });

      $(".p05").addClass("aprobado");
    } else {
      $(".p05").css({ color: "#000" });

      $(".p05").removeClass("aprobado");
    }

    if (valor.length >= 8) {
      $(".p01").css({ color: "#229e1e" });

      $(".p01").addClass("aprobado");
    } else {
      $(".p01").css({ color: "#000" });

      $(".p01").removeClass("aprobado");
    }

    //if (e.which >= 97 && e.which <= 122){

    //    $('.p02').css({'color' : '#229e1e'})

    //}
  });

  $(document).on("keydown", "#confirmPassword", function () {
    $(".required-info").css({ display: "none" });

    $("#passwordNotMatch").css({ display: "none" });

    $("#confirmPassword").css({ outline: "1px solid #213280" });
  });

  $(document).on("click", "#btnSavedNewPassword", function () {
    let newPassword = $("#newPassword").val();

    let confirmPassword = $("#confirmPassword").val();

    if (newPassword == confirmPassword) {
      updatePassword(confirmPassword);
    } else {
      $("#passwordNotMatch").css({ display: "block" });

      $("#confirmPassword").css({ outline: "1px solid red" });

      $("#confirmPassword").focus();
    }
  });

  $(document).on("click", ".fa-user-pen", function () {
    $("#emailUser").removeAttr("readonly");

    $("#emailUser").css({ "padding-right": "" });

    $(".input-wrapper").remove("fa-user-pen");

    $("#c-password").css({ display: "none" });

    $("#emailUser").focus();

    $("#passwordGrid").val("");

    $("#btnContinueLogIn").css({ display: "block" });

    $("#btnContinueLogIn2").css({ display: "none" });
  });

  $(document).on("click", ".eye-03", function () {
    if ($(this).hasClass("fa-eye")) {
      $(this).addClass("fa-eye-slash");

      $(this).removeClass("fa-eye");

      $("#passwordGrid").attr("type", "text");

      $("#passwordGrid").focus();
    } else {
      $(this).addClass("fa-eye");

      $(this).removeClass("fa-eye-slash");

      $("#passwordGrid").attr("type", "password");

      $("#passwordGrid").focus();
    }
  });

  $(document).on("click", ".eye-01", function () {
    if ($(this).hasClass("fa-eye")) {
      $(this).addClass("fa-eye-slash");

      $(this).removeClass("fa-eye");

      $("#newPassword").attr("type", "text");

      $("#newPassword").focus();
    } else {
      $(this).addClass("fa-eye");

      $(this).removeClass("fa-eye-slash");

      $("#newPassword").attr("type", "password");

      $("#newPassword").focus();
    }
  });

  $(document).on("click", ".eye-02", function () {
    if ($(this).hasClass("fa-eye")) {
      $(this).addClass("fa-eye-slash");

      $(this).removeClass("fa-eye");

      $("#confirmPassword").attr("type", "text");

      $("#confirmPassword").focus();
    } else {
      $(this).addClass("fa-eye");

      $(this).removeClass("fa-eye-slash");

      $("#confirmPassword").attr("type", "password");

      $("#confirmPassword").focus();
    }
  });

  $(document).on("click", ".newCode", function () {
    reenviarCorreo();

    $(".codeExpired").css({ display: "none" });
  });

  function validarCorreo(consulta) {
    $.ajax({
      url: plugin_dir + "/php/searchAccount.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.status === "disponible") {
          $(".availableMail").css({ display: "block" });

          $("#userTag").val(data.userTag);

          $("#emailUser").attr("readonly", "readonly");

          $("#emailUser").css({ "padding-right": "3rem" });

          $(".input-wrapper").append(
            "<i class='fa-sharp fa-solid fa-user-pen'></i>"
          );

          $("#c-password").css({ display: "block" });

          $("#passwordGrid").focus();

          $("#btnContinueSignUp").css({ display: "none" });

          $("#btnContinueSignUp4").css({ display: "block" });

          // bueno mi pana bloqueate
          //$("#btnContinueSignUp2").css({ display: "block" });
        } else {
          $(".mailExists").css({ display: "block" });
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function validarCorreoLogin(consulta) {
    $.ajax({
      url: plugin_dir + "/php/accessEmail.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);

        if (data.statusAcc === "pending") {
          if ($("#search-product").val() != "") {
            $(location).attr(
              "href",
              domain + "/registrarse/?search=" + $("#search-product").val()
            );
          } else {
            $(location).attr("href", domain + "/registrarse/");
          }
        } else {
          if (data.status === "registrado") {
            $("#emailUser").attr("readonly", "readonly");

            $("#emailUser").css({ "padding-right": "3rem" });

            $(".input-wrapper").append(
              "<i class='fa-sharp fa-solid fa-user-pen'></i>"
            );

            $("#c-password").css({ display: "block" });

            $("#passwordGrid").focus();

            $("#btnContinueLogIn").css({ display: "none" });

            $("#btnContinueLogIn2").css({ display: "block" });
          } else {
            $(".emailNoRegister").css({ display: "block" });

            $("#emailUser").focus();
          }
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function accNotValidated(consulta) {
    $.ajax({
      url: plugin_dir + "/php/accNotValidated.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);

        if (data.email !== "") {
          enviarCorreo();
        } else {
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function accessAccount(consulta, consulta1, ip, browser) {
    $.ajax({
      url: plugin_dir + "/php/accessAcount.php",

      type: "POST",

      data: { consulta, consulta1, ip, browser },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);

        if (data.status === "correcto") {
          if (data.name != "") {
            if (data.tipo == "regular") {
              console.log($("#search-product").val());
              if ($("#search-product").val() != "") {
                $(location).attr(
                  "href",
                  domain +
                    "/account_redirect/?search=" +
                    $("#search-product").val()
                );
              } else {
                $(location).attr("href", domain + "/account_redirect/");
              }
            } else {
              $(location).attr("href", domain + "/moderator/quotes/");
            }
          } else {
            if ($("#search-product").val() != "") {
              $(location).attr(
                "href",
                domain + "/asistente/?search=" + $("#search-product").val()
              );
            } else {
              $(location).attr("href", domain + "/asistente/");
            }
          }
        } else {
          $(".passwordIncorrect").css({ display: "block" });

          $("#passwordGrid").focus();
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function registrarCuenta(consulta, consulta1, consulta2, consulta3) {
    $.ajax({
      url: plugin_dir + "/php/registerAccount.php",

      type: "POST",

      data: { consulta, consulta1, consulta2, consulta3 },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);

        if (data.registro === "correcto") {
          $(".c-codeRequest").css({ display: "block" });
        } else {
          console.log("error");
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function sendLinkRecoveryPassword(consulta) {
    $.ajax({
      url: plugin_dir + "/php/sendEmailRecoveryPassword.php",

      type: "POST",

      data: { consulta },
    })

      .done(function () {
        iziToast.success({
          title: "Mail sent",

          message: alertsTranslations.checkInboxOrSpam,

          position: "center",
        });

        location.reload();
      })

      .fail(function () {
        iziToast.error({
          title: "Error",

          message: alertsTranslations.errorSendingMessage,

          position: "center",
        });
      });
  }

  function enviarCorreo(consulta) {
    $.ajax({
      url: plugin_dir + "/php/testTwilio.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        var path = $(location).attr("pathname");

        if (path == "/registrarse/") {
          $(".card-title").text("Available mail");
        } else {
        }

        $(".redirectLogin").css({ display: "none" });

        $(".c-email").css({ display: "none" });

        $("#c-password").css({ display: "none" });

        $(".emailError").css({ display: "none" });

        $(".availableMail").css({ display: "none" });

        $("#btnContinueSignUp").css({ display: "none" });

        $("#btnContinueSignUp2").css({ display: "none" });

        $("#btnContinueSignUp3").css({ display: "block" });

        $(".c-codeVerification").css({ display: "block" });

        $(".spanEmail").text($("#emailUser").val());

        $("#txtCodeVerification").focus();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function reenviarCorreo(consulta) {
    $.ajax({
      url: plugin_dir + "/php/newCodeValidation.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        enviarCorreo();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function validarCode(consulta) {
    $.ajax({
      url: plugin_dir + "/php/validarCode.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.timer === "caducado") {
          $(".codeExpired").css({ display: "block" });
        } else {
          if (data.sameCode === "coinciden") {
            iziToast.success({
              title: "Éxito",

              message: alertsTranslations.emailVerified,

              position: "topRight",
            });

            if ($("#search-product").val() != "") {
              $(location).attr(
                "href",
                domain + "/asistente/?search=" + $("#search-product").val()
              );
            } else {
              $(location).attr("href", domain + "/asistente/");
            }
          } else {
            $(".codeError").css({ display: "block" });
          }
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function issetSessionUser(consulta) {
    $.ajax({
      url: plugin_dir + "/php/issetSessionUser.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);
      })

      .fail(function () {
        console.log("error");
      });
  }

  function updatePassword(password) {
    $.ajax({
      url: plugin_dir + "/php/updatePasswordRecovery.php",

      type: "POST",

      data: { password },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.update === "correcto") {
          iziToast.success({
            title: "Success",

            message: alertsTranslations.passwordSuccessfullyChanged,

            position: "center",
          });

          $(location).attr("href", domain + "/acceder/");
        } else {
          iziToast.error({
            title: "Error",

            message: alertsTranslations.failedToUpdatePassword,

            position: "center",
          });
        }
      })

      .fail(function () {
        console.log("error");
      });
  }
});
