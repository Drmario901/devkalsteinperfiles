jQuery(document).ready(function ($) {
  $(".topBarInLogoArea").prepend("<div class='c-btnLoginSignup'></div>");
  showUserLoguer();

  console.log("btnLoginRegister.js");

  function showUserLoguer(consulta) {
    $.ajax({
      url: "https://piattaforma.kalstein.it/wp-content/plugins/kalsteinPerfiles/php/infoAccountLoguer.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $(".c-btnLoginSignup").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnLogout", function (e) {
    e.preventDefault();
    logout();
  });

  function logout(consulta) {
    $.ajax({
      url: "https://piattaforma.kalstein.it/wp-content/plugins/kalsteinPerfiles/php/logout.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $(location).attr("href", "https://piattaforma.kalstein.it/acceder/");
      })
      .fail(function () {
        console.log("error");
      });
  }
});
