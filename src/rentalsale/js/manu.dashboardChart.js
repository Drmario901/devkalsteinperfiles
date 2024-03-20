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

jQuery(document).ready(function ($) {
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

  var ctx = document.getElementById("#activity");
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
          label: "Costumers of the month",
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

  var ctx = document.getElementById("sales2");
  var visitors = new Chart(ctx, {
    type: "pie",
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
          backgroundColor: ["#c8474d"],
          borderColor: ["#fff"],
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

  var ctx = document.getElementById("visitors");
  var visitors = new Chart(ctx, {
    type: "pie",
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
          backgroundColor: ["#c8474d"],
          borderColor: ["#212380"],
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
