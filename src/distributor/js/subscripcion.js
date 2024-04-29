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

  //

  const $tbody = $("<tbody>");
  $.each(informacionTabla, function (index, fila) {
    const $trDatas = $("<tr>").attr("id", "tr-data");
    $("<td>").text(fila.titulo).appendTo($trDatas); // Añade el título de la fila
    $("<th>").text(fila.titulo).appendTo($trDatas);
    informacionTabla.forEach((data) => {
      data.assets.forEach((e) => {
        $("<th>").text(e).appendTo($trDatas);
      });
    });
    // Añade las celdas de assets, incluyendo un cheque si corresponde
  });
  $(".membership-table").append($tbody);
});
