const titulos = [
  "Facturación mensual",
  "Membresía 1",
  "Membresía 2",
  "Membresía 3",
];

const datos = [
  {
    descripcion: "Soporte Multilingüe en 10 idiomas",
    membresia1: true,
    membresia2: true,
    membresia3: true,
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
    $.each(datos, function (i, fila) {
      const $tr = $("<tr>");

      // Añadir la descripción
      $tr.append($("<td>").text(fila.descripcion));

      // Añadir los datos de membresía
      titulos.slice(1).forEach((titulo) => {
        // slice(1) para saltar la descripción
        $tr.append(
          $("<td>").append(
            fila[titulo.toLowerCase().replace(/ /g, "")]
              ? $("<span>").addClass("checkmark").html("&#10003;")
              : ""
          )
        );
      });

      $("#tr-data").append($tr);
    });
  }

  // Llamadas a las funciones
  crearTitulos();
  crearDatos();
});
