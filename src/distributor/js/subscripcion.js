const titulos = [
  "Facturación mensual",
  "Membresía 1",
  "Membresía 2",
  "Membresía 3",
];

const datos = [
  {
    item: ["Soporte Multilingüe en 10 idiomas", "✅", "✅", "✅"],
  },
  // Puedes añadir más objetos con la misma estructura para más filas
];

jQuery(document).ready(function ($) {
  function crearTitulos() {
    $.each(titulos, function (i, titulo) {
      $("#tr-titles").append($("<th>").text(titulo));
    });
  }

  // Función para crear las filas de datos
  function crearDatos() {
    $.each(datos, function (i, objeto) {
      const $tr = $("<tr>");
      $.each(objeto.item, function (j, dato) {
        $tr.append($("<td>").html(dato)); // Se utiliza .html() para permitir el uso de HTML dentro de la celda
      });
      $("#tr-data").append($tr);
    });
  }

  // Llamadas a las funciones
  crearTitulos();
  crearDatos();
});
