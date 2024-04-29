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
  const $titlesTh = $("#tr-titles");

  const $thead = $("<thead>");
  const $trTitles = $("<tr>").attr("id", "tr-titles");
  $.each(titulos, function (index, titulo) {
    $("<th>").text(titulo).appendTo($trTitles);
  });
  $thead.append($trTitles);
  $(".membership-table").append($thead);
});
