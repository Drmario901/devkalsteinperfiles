

jQuery(document).ready(function ($) {
  console.log('entre');
  

<<<<<<< HEAD
=======
  function array_sum(array) {
    let res = 0;
    array.forEach((element) => {
      res += element;
    });

    return res;
  }
>>>>>>> 48c24b5e2 (Cambio)

  const cookieLng = document.cookie
  .split("; ")
  .find((row) => row.startsWith("language="))
  .split("=")[1];

  console.log('cookie', cookieLng);
  
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

  //! meses 

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
      completoA: "täielikult",
      reportes: "aruanded",
      mesPrevio: "Eelmine kuu",
      clienteMes: "Kuu kliendid",
      cuentaReinicio: "konto lähtestub",
      days: "päeva"
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
      completoA: "kompletny do",
      reportes: "raporty",
      mesPrevio: "Poprzedni miesiąc",
      clienteMes: "Klienci miesiąca",
      cuentaReinicio: "konto zostanie zresetowane za",
      days: "dni"
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
      completoA: "volledig aan",
      reportes: "rapporten",
      mesPrevio: "Vorige maand",
      clienteMes: "Klanten van de maand",
      cuentaReinicio: "het account wordt opnieuw ingesteld in",
      days: "dagen"
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
      completoA: "completos de",
      reportes: "reportes",
      mesPrevio: "Mes previo",
      clienteMes: "Clientes del mes",
      cuentaReinicio: "la cuenta se reiniciara en",
      days: "dias", 
     
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
      completoA: "complete to",
      reportes: "reports",
      mesPrevio: "Previous month",
      clienteMes: "Clients of the month",
      cuentaReinicio: "the account will reset in",
      days: "days"
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
      completoA: "completare a",
      reportes: "report",
      mesPrevio: "Mese precedente",
      clienteMes: "Clienti del mese",
      cuentaReinicio: "l'account si riavvierà in",
      days: "giorni"
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
      completoA: "completo para",
      reportes: "relatórios",
      mesPrevio: "Mês anterior",
      clienteMes: "Clientes do mês",
      cuentaReinicio: "a conta será reiniciada em",
      days: "dias"
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
      completoA: "komplett till",
      reportes: "rapporter",
      mesPrevio: "Föregående månad",
      clienteMes: "Månadens kunder",
      cuentaReinicio: "kontot återställs om",
      days: "dagar"
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
      completoA: "complet à",
      reportes: "rapports",
      mesPrevio: "Mois précédent",
      clienteMes: "Clients du mois",
      cuentaReinicio: "le compte sera réinitialisé dans",
      days: "jours"
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
      completoA: "vollständig zu",
      reportes: "Berichte",
      mesPrevio: "Vorheriger Monat",
      clienteMes: "Kunden des Monats",
      cuentaReinicio: "Das Konto wird in",
      days: "Tagen zurückgesetzt"
    }
  };

  let clienteMes = meses[cookieLng].clienteMes
  let completoA = meses[cookieLng].completoA
  let reportes = meses[cookieLng].reportes
  let mesPrevio = meses[cookieLng].mesPrevio
  
  



  loadTranslations(cookieLng);


  let plugin_dir =
    "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/";

  // let months = [
  //   alertsTranslations.enero,
  //   alertsTranslations.febrero,
  //   alertsTranslations.marzo,
  //   alertsTranslations.abril,
  //   alertsTranslations.mayo,
  //   alertsTranslations.junio,
  //   alertsTranslations.julio,
  //   alertsTranslations.agosto,
  //   alertsTranslations.septiembre,
  //   alertsTranslations.octubre,
  //   alertsTranslations.noviembre,
  //   alertsTranslations.diciembre,
  // ];

  let months = [
    meses[cookieLng].enero,
    meses[cookieLng].febrero,
    meses[cookieLng].marzo,
    meses[cookieLng].abril,
    meses[cookieLng].mayo,
    meses[cookieLng].junio,
    meses[cookieLng].julio,
    meses[cookieLng].agosto,
    meses[cookieLng].septiembre,
    meses[cookieLng].octubre,
    meses[cookieLng].noviembre,
    meses[cookieLng].diciembre
  ]

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
    url: plugin_dir + "manufacturer/getChartInfo.php",
    type: "POST",
    data: "",
    dataType: "html",
  }).done(function (response) {
    // La cuenta se reiniciará en...

    console.log(response);

    $("#will-restart").html(`
        ${
          cuentaReinicio
        } ${JSON.parse(response).will_restart} ${days}
        `);

    // GRAFICO 1 VENTAS

    var ctx = document.getElementById("sales");
    let graph_1 = JSON.parse(response).graph_1;

    var sales = new Chart(ctx, {
      type: "bar",
      data: {
        labels: prevMonths,
        datasets: [
          {
            label: alertsTranslations.ventasDelMes,
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

    // función para acotar decimales
    function parse_dec(val) {
      return Math.floor(parseFloat(val) * 100) / 100;
    }

    let grow_1 =
      graph_1[3] != 0 ? (100 * (graph_1[4] - graph_1[3])) / graph_1[3] : -100;

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
                }, (${prevMonths[4]})</p>
            </div>
        `);

    // ORDENES COMPLETADAS Y PENDIENTES

    $("#processed-orders").html(JSON.parse(response).processed_orders);
    $("#pending-orders").html(JSON.parse(response).pending_orders);
    console.log('ordendes',  $("#processed-orders").html(JSON.parse(response).processed_orders));
    console.log('pending',  $("#pending-orders").html(JSON.parse(response).pending_orders));
    

    // GRAFICO 2 ORDENES REALIZADAS

    var ctx = document.getElementById("activity");
    let graph_2 = JSON.parse(response).graph_2;

    var visitors = new Chart(ctx, {
      type: "line",
      data: {
        labels: prevMonths,
        datasets: [
          {
            label: clienteMes,
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

    let grow_2 =
      graph_2[3] != 0 ? (100 * (graph_2[4] - graph_2[3])) / graph_2[3] : 0;

      // $("#graph-2-prevMonth").on('click', function(){
      //   console.log('grow_2',grow_2);
      //   console.log('graph_2', graph_2[4]);
      //   console.log('prevMonths',prevMonths);
      //   console.log('months',months);
      //   console.log('meses', meses[cookieLng].enero);
      // })

    $("#graph-2-prevMonth").html(`
            <span class="material-symbols-rounded icon ${
              grow_2 >= 0 ? "green" : "red"
            }">trending_${grow_2 >= 0 ? "up" : "down"}</span>
            <div>
                <data class="revenue-item-data">${
                  parse_dec(grow_2) +
                  "% <br>(" +
                  parse_dec(graph_2[3]) +
                  ` ${completoA} ` +
                  parse_dec(graph_2[4]) +
                  ` ${reportes}) `
                }</data>
                <p class="revenue-item-text">${mesPrevio} (${prevMonths[4]})</p>
            </div>
        `);
  });
});
