jQuery(document).ready(function ($) {
  $(document).on("click", "#hola", function () {
    console.log("hola");
    const cookies = document.cookie;
    console.log("cookies", cookies);

    iziToast.success({
      title: "Success",
      message: "hola",
      position: "center",
    });
  });

  const elboton = document.querySelector("#hola");
  console.log("elboton", elboton);
  let algo = () => {
    console.log("algo");
  };
  algo();

  function getCookie(name) {
    let nameEQ = name + "=";
    let ca = document.cookie.split(";");
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == " ") c = c.substring(1, c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
  }

  document.addEventListener("DOMContentLoaded", function () {
    let cookieValue = getCookie("roll_usuario");
    if (cookieValue) {
      console.log('El valor de la cookie "usuario" es: ' + cookieValue);
    } else {
      console.log('La cookie "usuario" no está configurada.');
    }
  });
});
