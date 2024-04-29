const titulos = [
  "Facturación mensual",
  "Membresía 1",
  "Membresía 2",
  "Membresía 3",
];

const informacionTabla = [
  {
    titulo: "Soporte Multilingüe en 10 idiomas",
    assets: ["1 idioma", "2 idiomas", "3 idiomas"],
  },
];

jQuery(document).ready(function ($) {
  const $thead = $("<thead>");
  const $trTitles = $("<tr>").attr("id", "tr-titles");
  $.each(titulos, function (index, titulo) {
    $("<th>").text(titulo).appendTo($trTitles);
  });
  $thead.append($trTitles);
  $(".membership-table").append($thead);

  const $tbody = $("<tbody>");
  $.each(informacionTabla, function (index, fila) {
    const $tr = $("<tr>");
    $("<td>").text(fila.titulo).appendTo($tr); // Añade el título de la fila

    // Añade las celdas de assets, incluyendo un cheque si corresponde
    $.each(titulos, function (index, titulo) {
      const $td = $("<td>");
      if (index > 0) {
        // Saltea el primer título porque es para la columna de descripción
        const assetExists = fila.assets.includes(titulo);
        $td.html(assetExists ? '<span class="checkmark">&#10003;</span>' : "");
      }
      $tr.append($td);
    });

    $tbody.append($tr); // Añade la fila al tbody
  });
  $(".membership-table").append($tbody);
});
