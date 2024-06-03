jQuery(document).ready(function ($) {
  $(document).on("click", "#hola", function () {
    console.log("hola");

    let cookieValue = getCookie("roll_usuario")
      ? getCookie("roll_usuario")
      : "No se encuentra";
    console.log("cookies", cookieValue);

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
});
