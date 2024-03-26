// let plugin_dir =
//   "https://dev.kalstein.plus/plataforma/wp-local/wp-content/plugins/kalsteinPerfiles/";

jQuery(document).ready(function ($) {
  console.log("entreee");
  console.log('entre de nuevo');
  

  function array_sum(array) {
    let res = 0;

    array.forEach((element) => {
      res += element;
    });

    return res;
  }

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

  const meses = {
    ee: {
      enero: "Jaanuar",
      febrero: "Veebruar",
      marzo: "Märts",
      abril: "Aprill",
      mayo: "Mai",
      junio: "Juuni",
      julio: "Juuli",
      agosto: "August",
      septiembre: "September",
      octubre: "Oktoober",
      noviembre: "November",
      diciembre: "Detsember",
    },
    pl: {
      enero: "Styczeń",
      febrero: "Luty",
      marzo: "Marzec",
      abril: "Kwiecień",
      mayo: "Maj",
      junio: "Czerwiec",
      julio: "Lipiec",
      agosto: "Sierpień",
      septiembre: "Wrzesień",
      octubre: "Październik",
      noviembre: "Listopad",
      diciembre: "Grudzień",
    },
    nl: {
      enero: "Januari",
      febrero: "Februari",
      marzo: "Maart",
      abril: "April",
      mayo: "Mei",
      junio: "Juni",
      julio: "Juli",
      agosto: "Augustus",
      septiembre: "September",
      octubre: "Oktober",
      noviembre: "November",
      diciembre: "December",
    },
    es: {
      enero: "Enero",
      febrero: "Febrero",
      marzo: "Marzo",
      abril: "Abril",
      mayo: "Mayo",
      junio: "Junio",
      julio: "Julio",
      agosto: "Agosto",
      septiembre: "Septiembre",
      octubre: "Octubre",
      noviembre: "Noviembre",
      diciembre: "Diciembre",
    },
    en: {
      enero: "January",
      febrero: "February",
      marzo: "March",
      abril: "April",
      mayo: "May",
      junio: "June",
      julio: "July",
      agosto: "August",
      septiembre: "September",
      octubre: "October",
      noviembre: "November",
      diciembre: "December",
    },
    it: {
      enero: "Gennaio",
      febrero: "Febbraio",
      marzo: "Marzo",
      abril: "Aprile",
      mayo: "Maggio",
      junio: "Giugno",
      julio: "Luglio",
      agosto: "Agosto",
      septiembre: "Settembre",
      octubre: "Ottobre",
      noviembre: "Novembre",
      diciembre: "Dicembre",
    },
    pt: {
      enero: "Janeiro",
      febrero: "Fevereiro",
      marzo: "Março",
      abril: "Abril",
      mayo: "Maio",
      junio: "Junho",
      julio: "Julho",
      agosto: "Agosto",
      septiembre: "Setembro",
      octubre: "Outubro",
      noviembre: "Novembro",
      diciembre: "Dezembro",
    },
    se: {
      enero: "Januari",
      febrero: "Februari",
      marzo: "Mars",
      abril: "April",
      mayo: "Maj",
      junio: "Juni",
      julio: "Juli",
      agosto: "Augusti",
      septiembre: "September",
      octubre: "Oktober",
      noviembre: "November",
      diciembre: "December",
    },
    fr: {
      enero: "Janvier",
      febrero: "Février",
      marzo: "Mars",
      abril: "Avril",
      mayo: "Mai",
      junio: "Juin",
      julio: "Juillet",
      agosto: "Août",
      septiembre: "Septembre",
      octubre: "Octobre",
      noviembre: "Novembre",
      diciembre: "Décembre",
    },
    de: {
      enero: "Januar",
      febrero: "Februar",
      marzo: "März",
      abril: "April",
      mayo: "Mai",
      junio: "Juni",
      julio: "Juli",
      agosto: "August",
      septiembre: "September",
      octubre: "Oktober",
      noviembre: "November",
      diciembre: "Dezember",
    }
  };


  let plugin_dir =
    "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/";

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

 console.log('meses', months);
 
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
    url: plugin_dir + "php/manufacturer/getChartInfo.php",

    type: "POST",

    data: "",

    dataType: "html",
  }).done(function (response) {
    // La cuenta se reiniciará en...

    $("#will-restart").html(`

        ${
          alertsTranslations.CountDown
        } ${JSON.parse(response).will_restart} ${alertsTranslations.textDays}

        `);

    // función para acotar decimales

    function parse_dec(val) {
      return Math.floor(parseFloat(val) * 100) / 100;
    }

    let graph_1 = JSON.parse(response).graph_1;

    let grow_1;

    if (graph_1[3] != 0) {
      grow_1 = (100 * (graph_1[4] - graph_1[3])) / graph_1[3];
    } else {
      if (graph_1[4] != 0) {
        grow_1 = -100;
      } else {
        grow_1 = 0;
      }
    }

    $("#graph-1-prevMonth").html(`

            <span class="material-symbols-rounded icon ${
              grow_1 >= 0 ? "green" : "red"
            }">trending_${grow_1 >= 0 ? "up" : "down"}</span>

            <div>

                <data class="revenue-item-data">${
                  parse_dec(grow_1) +
                  "% <br>(" +
                  parse_dec(graph_1[3]) +
                  "$ to " +
                  parse_dec(graph_1[4]) +
                  "$)"
                }</data>

                <p class="revenue-item-text">${
                  alertsTranslations.mesPrevio
                } (${prevMonths[4]})</p>

            </div>

        `);

    // ORDENES COMPLETADAS Y PENDIENTES

    $("#processed-orders").html(JSON.parse(response).processed_orders);

    $("#pending-orders").html(JSON.parse(response).pending_orders);

    if (JSON.parse(response).pending_orders > 0) {
      $("#pending-orders-indicator").removeAttr("hidden");
    }

    // GRAFICO 2 ORDENES REALIZADAS

    var ctx = document.getElementById("activity");

    let graph_2 = JSON.parse(response).graph_2;

    var visitors = new Chart(ctx, {
      type: "line",

      data: {
        labels: prevMonths,

        datasets: [
          {
            label: 'clientes del mes...',

            data: graph_2,

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

    let grow_2 = graph_2[3] != 0 ? (100 * (graph_2[4] - graph_2[3])) / graph_2[3] : 0;

   


    if (graph_2[4] != 0) {
      if (graph_2[3] != 0) {
        grow_2 = (100 * (graph_2[4] - graph_2[3])) / graph_2[3];
      } else {
        grow_2 = 100;
      }
    } else {
      if (graph_2[3] != 0) {
        grow_2 = -100;
      } else {
        grow_2 = 0;
      }
    }

    $("#graph-2-prevMonth").html(`

            <span class="material-symbols-rounded icon ${
              grow_2 >= 0 ? "green" : "red"
            }">trending_${grow_2 >= 0 ? "up" : "down"}</span>

            <div>

                <data class="revenue-item-data">${
                  parse_dec(grow_2) +
                  "% <br>(" +
                  parse_dec(graph_2[3]) +
                  " clientes de " +
                  parse_dec(graph_2[4]) +
                  " clientes)"
                }</data>

                <p class="revenue-item-text">${
                  alertsTranslations.mesPrevio
                } (${prevMonths[4]})</p>

            </div>

        `);
  });

  $("#graph-2-prevMonth").on('click', function(){
    console.log('grow_2',grow_2);
    console.log('graph_2', graph_2[4]);
    console.log('prevMonths',prevMonths);
    console.log('months',months);
    console.log('meses', meses[cookieLng].enero);
  })
});
