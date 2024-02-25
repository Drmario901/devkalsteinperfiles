function array_sum(array){

    let res = 0;

    

    array.forEach(element => {

        res += element;

    });



    return res;

}



jQuery(document).ready(function($) {

    let plugin_dir = 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/';



    let months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];



    function prevMonthList(month){



        let res = [];



        for (let i = 5; i >= 0; i--){

            (month - i) < 0 ? res.push(months[month - i + 12]) : res.push(months[month - i]);

        }



        return res;

    }



    let date = new Date();

    let prevMonths = prevMonthList(date.getMonth());



    $.ajax({

        url: plugin_dir + 'php/manufacturer/getChartInfo.php',

        type: 'POST',

        data: '',

        dataType: 'html',



    })

    .done(function (response){



        // La cuenta se reiniciará en...



        $("#will-restart").html(`

            La cuenta se reiniciará en ${JSON.parse(response).will_restart} días

        `);



        // función para acotar decimales

        function parse_dec(val){

            return Math.floor(parseFloat(val) * (100)) / (100);

        }

        

        let graph_1 = JSON.parse(response).graph_1;



        let grow_1;



        if(graph_1[3] != 0){

            grow_1 = 100*(graph_1[4] - graph_1[3])/graph_1[3];

        }

        else{

            if(graph_1[4] != 0){

                grow_1 = -100;

            }

            else{

                grow_1 = 0;

            }

        }



        $('#graph-1-prevMonth').html(`

            <span class="material-symbols-rounded icon ${grow_1 >= 0? "green" : "red"}">trending_${grow_1 >= 0? "up" : "down"}</span>

            <div>

                <data class="revenue-item-data">${parse_dec(grow_1) + "% <br>(" + parse_dec(graph_1[3]) + "$ to " + parse_dec(graph_1[4]) + "$)"}</data>

                <p class="revenue-item-text">Prev Month (${prevMonths[4]})</p>

            </div>

        `);



        // ORDENES COMPLETADAS Y PENDIENTES



        $("#processed-orders").html(JSON.parse(response).processed_orders);



        $("#pending-orders").html(JSON.parse(response).pending_orders);



        if (JSON.parse(response).pending_orders > 0){

            $("#pending-orders-indicator").removeAttr('hidden');

        }



        // GRAFICO 2 ORDENES REALIZADAS



        var ctx = document.getElementById('activity');

        let graph_2 = JSON.parse(response).graph_2;



        var visitors = new Chart(ctx, {         

            type: 'line',

            data: {

                labels: prevMonths,

                datasets:[{

                    label: 'Clientes del mes',

                    data: graph_2,

                    backgroundColor: [

                        'rgba(33, 35, 128, 0.2)'

                    ],

                    borderColor: [

                        'rgba(33, 35, 128, 1)'

                    ],

                    borderWidth: 1

                }]

            },

            options: {

                scales: {

                    y: {

                        beginAtZero: true

                    }

                }

            }

        });



        let grow_2;



        if(graph_2[4] != 0){

            if(graph_2[3] != 0){

                grow_2 = 100*(graph_2[4] - graph_2[3])/graph_2[3];

            }

            else {

                grow_2 = 100;

            }

        }

        else{

            if(graph_2[3] != 0){

                grow_2 = -100;

            }

            else{

                grow_2 = 0;

            }

        }



        $('#graph-2-prevMonth').html(`

            <span class="material-symbols-rounded icon ${grow_2 >= 0? "green" : "red"}">trending_${grow_2 >= 0? "up" : "down"}</span>

            <div>

                <data class="revenue-item-data">${parse_dec(grow_2) + "% <br>(" + parse_dec(graph_2[3]) + " clientes de " + parse_dec(graph_2[4]) + " clientes)"}</data>

                <p class="revenue-item-text">Mes previo (${prevMonths[4]})</p>

            </div>

        `);

    });

});

    