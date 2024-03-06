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


jQuery(document).ready(function($){
    searchDataUserDashboard()
    $('.vce-row-content').attr('id', 'vce-row-content')

    $(document).on('click', '#btnNewQuote', function(){
        $(location).attr('href','https://dev.kalstein.plus/quote/')
    })

    $(document).on('click', '#btn-logout', function(){
        logout()
    })

    $(document).on('click', '#btn-historyQuoteUser', function(){
        $('#c-panel01').css({'display' : 'none'});
        $('#c-panel02').css({'display' : 'block'});
        $('#c-panel03').css({'display' : 'none'});
        let email = $('#h-emailUsers').val()
        showTblQuoteUsers(email)
    })

    $(document).on('click', '#btn-dashboard', function(){
        $('#c-panel01').css({'display' : 'block'});
        $('#c-panel02').css({'display' : 'none'});
        $('#c-panel03').css({'display' : 'none'});
    })

    $(document).on('click', '#btn-settingsQuote', function(){
        $('#c-panel03').css({'display' : 'block'});
        $('#c-panel01').css({'display' : 'none'});
        $('#c-panel02').css({'display' : 'none'});
    })

    $(document).on('click', '.menu_acordion li:has(ul)', function(){
        if ($(this).hasClass('activado')) {
            $('.menu_acordion .activado .fa-chevron-down').css({'display' : 'block'})
			$('.menu_acordion .activado .fa-chevron-up').css({'display' : 'none'})
			$(this).removeClass('activado')
            $(this).children('a').removeClass('select')
            $(this).children('ul').addClass('select')
			$(this).children('ul').slideUp()	            	            
            $(this).children('a').children('.fa-chevron-down').css({'display' : 'block'})
            $(this).children('a').children('.fa-chevron-up').css({'display' : 'none'})				
		}else{
            $('.menu_acordion .activado .fa-chevron-down').css({'display' : 'block'})
			$('.menu_acordion .activado .fa-chevron-up').css({'display' : 'none'})
			$('.menu_acordion li ul').slideUp();
			$('.menu_acordion li').removeClass('activado');
            $('.menu_acordion a').removeClass('select')
			$(this).addClass('activado')
            $(this).children('a').addClass('select')
            $(this).children('ul').addClass('select')
			$(this).children('ul').slideDown()
            $(this).children('a').children('.fa-chevron-down').css({'display' : 'none'})
            $(this).children('a').children('.fa-chevron-up').css({'display' : 'block'})
		}
    })

    $('.btnHoverMenu').hover(
        function() {
          $(this).css({'background-color' : '#fff'})
          $(this).children('h2').children('button').css({'color' : '#212380'})
          $(this).children('h2').children('button').css({'font-weight' : 'bold'})
        }, function() {
          $(this).css({'background' : 'none'})
          $(this).children('h2').children('button').css({'color' : '#fff'})
          $(this).children('h2').children('button').css({'font-weight' : '500'})
        }
    )

    function searchDataUserDashboard(consulta){
        $.ajax({
            url: 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/searchUserLoguer.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)            
            let data = JSON.parse(respuesta)
            $('#dropdown-perfil').text('Welcome, '+data.name)
            $('#h-emailUsers').val(data.emailAcc)
        })
        .fail(function(){
            console.log("error")
        })
    }

    function showTblQuoteUsers(email){
        $.ajax({
            url: 'https://dev.kalstein.plus/wp-content/plugins/kalsteinCotizacion/classes/searchTblQuoteUsers.php',
            type: 'POST',
            data: {email},
        })
        .done(function(respuesta){
            $('#c-tbl-quoteUser').html(respuesta)
        })
        .fail(function(){
            console.log("error")
        })
    }

    function logout(consulta){
        $.ajax({
            url: 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/logout.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            $(location).attr('href','https://dev.kalstein.plus/login/')
        })
        .fail(function(){
            console.log("error")
        })
    }
   
   

    function dataForLineChartjsQuote(consulta){
        $.ajax({
            url: 'https://dev.kalstein.plus/wp-local/wp-content/plugins/kalsteinPerfiles/php/salesMonth.php',
            type: 'POST',
            data: {consulta},
        })
        .done(function(respuesta){
            let datos = JSON.parse(respuesta)
            var ctx2 = document.getElementById('lineChartQuote')
            const fecha = new Date();
            const mesActual = fecha.getMonth()
            var january = 0
            var february = 0
            var march = 0
            var april = 0
            var may = 0
            var june = 0
            var july = 0
            var august = 0
            var september = 0
            var october = 0
            var november = 0
            var december = 0
            $.each(datos, function (i, element){
                if (element.date == 01){
                    january = parseInt(january) + parseInt(1)
                }else{
                    if (element.date == 02){
                        february = parseInt(february) + parseInt(1)
                    }else{
                        if (element.date == 03){
                            march = parseInt(march) + parseInt(1)
                        }else{
                            if (element.date == 04){
                                april = parseInt(april) + parseInt(1)
                            }else{
                                if (element.date == 05){
                                    may = parseInt(may) + parseInt(1)
                                }else{
                                    if (element.date == 06){
                                        june = parseInt(june) + parseInt(1)
                                    }else{
                                        if (element.date == 07){
                                            july = parseInt(july) + parseInt(1)
                                        }else{
                                            if (element.date == 08){
                                                august = parseInt(august) + parseInt(1)
                                            }else{
                                                if (element.date == 09){
                                                    september = parseInt(september) + parseInt(1)
                                                }else{
                                                    if (element.date == 10){
                                                        october = parseInt(october) + parseInt(1)
                                                    }else{
                                                        if (element.date == 11){
                                                            november = parseInt(november) + parseInt(1)
                                                        }else{
                                                            if (element.date == 12){
                                                                december = parseInt(december) + parseInt(1)
                                                            }   
                                                        }   
                                                    }   
                                                }   
                                            }   
                                        }   
                                    }   
                                }   
                            }   
                        }   
                    }   
                }
            })
            let months = []
            var dataQuote = ''
            if (mesActual == 0){
                months = [alertsTranslations.agosto, 
                        alertsTranslations.septiembre,
                        alertsTranslations.octubre,
                        alertsTranslations.noviembre, 
                        alertsTranslations.diciembre, 
                        alertsTranslations.enero]

                dataQuote = [
                            august,
                            september,
                            october,
                            november,
                            december,
                            january
                        ]
            }else{
                if (mesActual == 1){
                    months = [
                        alertsTranslations.septiembre,
                        alertsTranslations.octubre,
                        alertsTranslations.noviembre, 
                        alertsTranslations.diciembre, 
                        alertsTranslations.enero, 
                        alertsTranslations.febrero
                    ]

                dataQuote = [
                            september,
                            october,
                            november,
                            december,
                            january,
                            february
                        ]
                }else{
                    if (mesActual == 2){
                        months = [
                            alertsTranslations.octubre, 
                            alertsTranslations.noviembre, 
                            alertsTranslations.diciembre, 
                            alertsTranslations.enero, 
                            alertsTranslations.febrero, 
                            alertsTranslations.marzo
                        ]
    
                    dataQuote = [
                                october,
                                november,
                                december,
                                january,
                                february,
                                march
                            ]
                    }else{
                        if (mesActual == 3){
                            months = [
                                alertsTranslations.noviembre, 
                                alertsTranslations.diciembre, 
                                alertsTranslations.enero, 
                                alertsTranslations.febrero, 
                                alertsTranslations.marzo,
                                alertsTranslations.abril
                            ]
        
                        dataQuote = [
                                    november,
                                    december,
                                    january,
                                    february,
                                    march,
                                    april
                                ]
                        }else{
                            if (mesActual == 4){
                                months = [
                                    alertsTranslations.diciembre,  
                                    alertsTranslations.enero, 
                                    alertsTranslations.febrero, 
                                    alertsTranslations.marzo,
                                    alertsTranslations.abril,
                                    alertsTranslations.mayo
                                ]
            
                            dataQuote = [
                                        december,
                                        january,
                                        february,
                                        march,
                                        april,
                                        may
                                    ]
                            }else{
                                if (mesActual == 5){
                                    months = [
                                        alertsTranslations.enero, 
                                        alertsTranslations.febrero, 
                                        alertsTranslations.marzo,
                                        alertsTranslations.abril,
                                        alertsTranslations.mayo,
                                        alertsTranslations.junio
                                    ]
                
                                dataQuote = [
                                            january,
                                            february,
                                            march,
                                            april,
                                            may,
                                            june
                                        ]
                                }else{
                                    if (mesActual == 6){
                                        months = [
                                            alertsTranslations.febrero, 
                                            alertsTranslations.marzo,
                                            alertsTranslations.abril,
                                            alertsTranslations.mayo,
                                            alertsTranslations.junio,
                                            alertsTranslations.julio
                                        ]
                    
                                    dataQuote = [
                                                february,
                                                march,
                                                april,
                                                may,
                                                june,
                                                july
                                            ]
                                    }else{
                                        if (mesActual == 7){
                                            months = [
                                                alertsTranslations.marzo,
                                                alertsTranslations.abril,
                                                alertsTranslations.mayo,
                                                alertsTranslations.junio,
                                                alertsTranslations.julio,
                                                alertsTranslations.agosto
                                            ]
                        
                                        dataQuote = [
                                                    march,
                                                    april,
                                                    may,
                                                    june,
                                                    july,
                                                    august
                                                ]
                                        }else{
                                            if (mesActual == 8){
                                                months = [
                                                    alertsTranslations.abril,
                                                    alertsTranslations.mayo,
                                                    alertsTranslations.junio,
                                                    alertsTranslations.julio,
                                                    alertsTranslations.agosto,
                                                    alertsTranslations.septiembre
                                                ]
                            
                                            dataQuote = [
                                                        april,
                                                        may,
                                                        june,
                                                        july,
                                                        august,
                                                        september
                                                    ]
                                            }else{
                                                if (mesActual == 9){
                                                    months = [
                                                        alertsTranslations.mayo,
                                                        alertsTranslations.junio,
                                                        alertsTranslations.julio,
                                                        alertsTranslations.agosto,
                                                        alertsTranslations.septiembre,
                                                        alertsTranslations.octubre,
                                                    ]
                                
                                                dataQuote = [
                                                            may,
                                                            june,
                                                            july,
                                                            august,
                                                            september,
                                                            october
                                                        ]
                                                }else{
                                                    if (mesActual == 10){
                                                        months = [
                                                            alertsTranslations.junio,
                                                            alertsTranslations.julio,
                                                            alertsTranslations.agosto,
                                                            alertsTranslations.septiembre,
                                                            alertsTranslations.octubre,
                                                            alertsTranslations.noviembre
                                                        ]
                                    
                                                    dataQuote = [
                                                                june,
                                                                july,
                                                                august,
                                                                september,
                                                                october,
                                                                november
                                                            ]
                                                    }else{
                                                        if (mesActual == 11){
                                                            months = [
                                                                alertsTranslations.julio,
                                                                alertsTranslations.agosto,
                                                                alertsTranslations.septiembre,
                                                                alertsTranslations.octubre,
                                                                alertsTranslations.noviembre,
                                                                alertsTranslations.diciembre
                                                            ]
                                        
                                                        dataQuote = [
                                                                    july,
                                                                    august,
                                                                    september,
                                                                    october,
                                                                    november,
                                                                    december
                                                                ]
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
                
            }
            var myChart2 = new Chart(ctx2, {
                type: 'bar',
                data: {
                    labels: months,
                    datasets: [{
                        label: alertsTranslations.ventasDelMes,
                        data: dataQuote,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                }
            }) 
        })
        .fail(function(){
            console.log("error");
        })
    }

    

})

jQuery(document).ready(function($){
    $('.circulatorDiv').hover(
        function(){
            $(this).css({'cursor' : 'pointer'})
            $(this).children('.div01').animate({"left": "-100%"}, "slow");
            $(this).children('.div02').animate({"right": "0"}, "slow");
        }, function(){       
            $(this).children('.div01').animate({"left": "0"}, "slow");
            $(this).children('.div02').animate({"right": "-100%"}, "slow");
        }
    )
})
