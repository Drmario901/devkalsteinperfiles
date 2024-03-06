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
  let plugin_dir =
    "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/";

  $.ajax({
    url: plugin_dir + "php/manufacturer/getChartInfoSales.php",

    type: "POST",

    data: "",

    dataType: "html",
  })

    .done(function (response) {
      function parse_dec(val) {
        return Math.floor(parseFloat(val) * 100) / 100;
      }

      // LABELS DE LOS MESES

      let months = [
        `${alertsTranslations.enero}`,
        `${alertsTranslations.febrero}`,
        `${alertsTranslations.marzo}`,
        `${alertsTranslations.abril}`,
        `${alertsTranslations.mayo}`,
        `${alertsTranslations.junio}`,
        `${alertsTranslations.julio}`,
        `${alertsTranslations.agosto}`,
        `${alertsTranslations.septiembre}`,
        `${alertsTranslations.octubre}`,
        `${alertsTranslations.noviembre}`,
        `${alertsTranslations.diciembre}`,
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

      let graph_1 = JSON.parse(response).graph_1;

      // TARJETA 1

      // GRAFICO DE RUEDA DE VENTAS

      var ctx = document.getElementById("sales2");

      var products = new Chart(ctx, {
        type: "pie",

        data: {
          labels: JSON.parse(response).graph_3_names,

          datasets: [
            {
              label: "Vendidos",

              data: JSON.parse(response).graph_3_quan,

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

      // TARJETA 2 MES ANTERIOR

      //TITULO

      $("#last-month-h2").html(
        `${alertsTranslations.mesPrevio} (${prevMonths[4]})`
      );

      // CREIMIENTO DE VENTAS DEL MES ANTERIOR

      let grow_1;

      if (graph_1[4] != 0) {
        if (graph_1[3] != 0) {
          grow_1 = (100 * (graph_1[4] - graph_1[3])) / graph_1[3];
        } else {
          grow_1 = 100;
        }
      } else {
        if (graph_1[3] != 0) {
          grow_1 = -100;
        } else {
          grow_1 = 0;
        }
      }

      $("#graph-1-month").html(`

            <span class="material-symbols-rounded icon ${
              grow_1 >= 0 ? "green" : "red"
            }">trending_${grow_1 >= 0 ? "up" : "down"}</span>

            <div>

                <data class="revenue-item-data">${
                  parse_dec(grow_1) + "%"
                }</data>

            </div>

        `);

      // DINERO GANADO

      $("#income").html(parse_dec(JSON.parse(response).total_income));

      // EL CONTEO SE REINICIA EN

      $("#will-restart").html(`

      ${
        alertsTranslations.CountDown
      } ${JSON.parse(response).will_restart} ${alertsTranslations.textDays}

        `);

      // TOTAL VENDIDO

      $("#products-sold").html(JSON.parse(response).sold_products);

      // TARJETA 3

      // GRAFICO DE VENTAS

      var ctx = document.getElementById("sales");

      var sales = new Chart(ctx, {
        type: "bar",

        data: {
          labels: prevMonths,

          datasets: [
            {
              label: "Sales of the month",

              data: graph_1,

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

      // COSTUMERS

      $("#total-costumers").html(JSON.parse(response).total_costumers);
    })

    .fail(function () {
      iziToast.warning({
        title: alertsTranslations.advertencia,

        message: alertsTranslations.noBd,

        position: "topRight",
      });
    });
});
