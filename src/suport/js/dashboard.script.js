

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

  searchDataUserDashboard();
  $(".vce-row-content").attr("id", "vce-row-content");

  $(document).on("click", "#btnNewQuote", function () {
    $(location).attr("href", "https://dev.kalstein.plus/quote/");
  });

  $(document).on("click", "#btn-logout", function () {
    logout();
  });

  $(document).on("click", "#btn-historyQuoteUser", function () {
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "block" });
    $("#c-panel03").css({ display: "none" });
    let email = $("#h-emailUsers").val();
    showTblQuoteUsers(email);
  });

  $(document).on("click", "#btn-dashboard", function () {
    $("#c-panel01").css({ display: "block" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
  });

  $(document).on("click", "#btn-settingsQuote", function () {
    $("#c-panel03").css({ display: "block" });
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
  });

  $(document).on("click", ".menu_acordion li:has(ul)", function () {
    if ($(this).hasClass("activado")) {
      $(".menu_acordion .activado .fa-chevron-down").css({ display: "block" });
      $(".menu_acordion .activado .fa-chevron-up").css({ display: "none" });
      $(this).removeClass("activado");
      $(this).children("a").removeClass("select");
      $(this).children("ul").addClass("select");
      $(this).children("ul").slideUp();
      $(this)
        .children("a")
        .children(".fa-chevron-down")
        .css({ display: "block" });
      $(this).children("a").children(".fa-chevron-up").css({ display: "none" });
    } else {
      $(".menu_acordion .activado .fa-chevron-down").css({ display: "block" });
      $(".menu_acordion .activado .fa-chevron-up").css({ display: "none" });
      $(".menu_acordion li ul").slideUp();
      $(".menu_acordion li").removeClass("activado");
      $(".menu_acordion a").removeClass("select");
      $(this).addClass("activado");
      $(this).children("a").addClass("select");
      $(this).children("ul").addClass("select");
      $(this).children("ul").slideDown();
      $(this)
        .children("a")
        .children(".fa-chevron-down")
        .css({ display: "none" });
      $(this)
        .children("a")
        .children(".fa-chevron-up")
        .css({ display: "block" });
    }
  });

  $(".btnHoverMenu").hover(
    function () {
      $(this).css({ "background-color": "#fff" });
      $(this).children("h2").children("button").css({ color: "#212380" });
      $(this).children("h2").children("button").css({ "font-weight": "bold" });
    },
    function () {
      $(this).css({ background: "none" });
      $(this).children("h2").children("button").css({ color: "#fff" });
      $(this).children("h2").children("button").css({ "font-weight": "500" });
    }
  );

  function searchDataUserDashboard(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchUserLoguer.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        console.log(respuesta);
        let data = JSON.parse(respuesta);
        $("#dropdown-perfil").text(
          `${alertsTranslations.bienvenido}, ` + data.name
        );
        $("#h-emailUsers").val(data.emailAcc);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function showTblQuoteUsers(email) {
    $.ajax({
      url: "https://dev.kalstein.plus/wp-content/plataforma/plugins/kalsteinCotizacion/classes/searchTblQuoteUsers.php",
      type: "POST",
      data: { email },
    })
      .done(function (respuesta) {
        $("#c-tbl-quoteUser").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  function logout(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/logout.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $(location).attr("href", "https://dev.kalstein.plus/login/");
      })
      .fail(function () {
        console.log("error");
      });
  }

  var ctx = document.getElementById("sales");
  var sales = new Chart(ctx, {
    type: "bar",
    data: {
      labels: [
        alertsTranslations.enero,
        alertsTranslations.febrero,
        alertsTranslations.marzo,
        alertsTranslations.abril,
        alertsTranslations.mayo,
        alertsTranslations.junio,
        alertsTranslations.julio,
      ],
      datasets: [
        {
          label: alertsTranslations.ventasDelMes,
          data: [12, 19, 3, 5, 2, 3, 10],
          backgroundColor: [
            "rgba(33, 35, 128, 0.2)",
            "rgba(33, 35, 128, 0.2)",
            "rgba(33, 35, 128, 0.2)",
            "rgba(33, 35, 128, 0.2)",
            "rgba(33, 35, 128, 0.2)",
            "rgba(33, 35, 128, 0.2)",
            "rgba(33, 35, 128, 0.2)",
          ],
          borderColor: [
            "rgba(33, 35, 128, 1)",
            "rgba(33, 35, 128, 1)",
            "rgba(33, 35, 128, 1)",
            "rgba(33, 35, 128, 1)",
            "rgba(33, 35, 128, 1)",
            "rgba(33, 35, 128, 1)",
            "rgba(33, 35, 128, 1)",
          ],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });

  var ctx = document.getElementById("activity");
  var visitors = new Chart(ctx, {
    type: "line",
    data: {
      labels: [
        alertsTranslations.enero,
        alertsTranslations.febrero,
        alertsTranslations.marzo,
        alertsTranslations.abril,
        alertsTranslations.mayo,
        alertsTranslations.junio,
        alertsTranslations.julio,
      ],
      datasets: [
        {
          label: alertsTranslations.clienteMes,
          data: [12, 19, 3, 5, 2, 3, 10],
          backgroundColor: ["rgba(33, 35, 128, 0.2)"],
          borderColor: ["rgba(33, 35, 128, 1)"],
          borderWidth: 1,
        },
      ],
    },
    options: {
      scales: {
        y: {
          beginAtZero: true,
        },
      },
    },
  });
});
