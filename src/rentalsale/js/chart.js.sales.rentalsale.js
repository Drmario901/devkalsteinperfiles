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

function sumArray(array) {
  let res = 0;

  array.forEach((element) => {
    res += element;
  });

  return res;
}

jQuery(document).ready(function ($) {
  let plugin_dir =
    "https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/";

  let months = [
    alertsTranslations.enero,
    alertsTranslations.febrero,
    alertsTranslations.marzo,
    alertsTranslations.abril,
    alertsTranslations.mayo,
    alertsTranslations.junio,
    alertsTranslations.julio,
    alertsTranslations.agosto,
    alertsTranslations.septiembre,
    alertsTranslations.octubre,
    alertsTranslations.noviembre,
    alertsTranslations.diciembre,
  ];

  function prevMonthList(month) {
    let res = [];

    for (let i = 5; i >= 0; i--) {
      month - i < 0
        ? res.push(months[month - i + 12])
        : res.push(months[month - i]);
    }

    return res;
  }

  let date = new Date();
  let prevMonths = prevMonthList(date.getMonth());

  $.ajax({
    url: plugin_dir + "php/distributor/getChartInfo.php",
    type: "POST",
    data: "",
    dataType: "html",
  }).done(function (response) {
    console.log(response);
    let data = JSON.parse(response);

    // La cuenta se reiniciará en...
    $("#will-restart").html(`
        ${
          alertsTranslations.CountDown
        } ${JSON.parse(response).will_restart} ${alertsTranslations.textDays}
        `);

    let graph_3_quan = data.graph_3_quan;
    let graph_3_names = data.graph_3_names;

    var ctx3 = document.getElementById("products").getContext("2d");
    var products = new Chart(ctx3, {
      type: "pie",
      data: {
        labels: data.graph_3_names,
        datasets: [
          {
            label: alertsTranslations.pruductosVendidos,
            data: graph_3_quan,

            backgroundColor: [
              "rgba(33, 35, 128, 0.2)",
              "rgba(54, 162, 235, 0.2)",
              "rgba(255, 99, 132, 0.2)",
              "rgba(255, 205, 86, 0.2)",
              "rgba(75, 192, 192, 0.2)",
              "rgba(153, 102, 255, 0.2)",
              "rgba(255, 159, 64, 0.2)",
            ],
            borderColor: [
              "rgba(33, 35, 128, 1)",
              "rgba(54, 162, 235, 1)",
              "rgba(255, 99, 132, 1)",
              "rgba(255, 205, 86, 1)",
              "rgba(75, 192, 192, 1)",
              "rgba(153, 102, 255, 1)",
              "rgba(255, 159, 64, 1)",
            ],
            borderWidth: 1,
          },
        ],
      },
      options: {
        plugins: {
          legend: {
            position: "bottom",
          },
        },
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });

    let total_sold = sumArray(graph_3);
    $("#graph-3-totalSold").html(`
            <data class="revenue-item-data">${total_sold}</data>
            <p class="revenue-item-text">${alertsTranslations.ventasTotal}</p>
        `);
  });

  // DINERO GANADO

  $("#income").html(parse_dec(JSON.parse(response).total_income));
});
