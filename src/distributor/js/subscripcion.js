const titulos = [
  "Facturación mensual",
  "Membresía 1",
  "Membresía 2",
  "Membresía 3",
];

jQuery(document).ready(function ($) {
  const $subscripcionTh = $("#tr-subscripcion");

  titulos.forEach((titulo) => {
    $subscripcionTh.append($("<th>").text(titulo));
  });
});
