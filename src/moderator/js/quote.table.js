jQuery(document).ready(function($){
    const cookieLng = document.cookie.split('; ').find(row => row.startsWith('language=')).split('=')[1]
    let alertsTranslations = {};

    // cargar json de traducciones
    const loadTranslations = (lng) => {
        return fetch(`https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`)
            .then(response => response.json())
            .then(translation => {
                // save in a global variable
                alertsTranslations = translation;
            });
    }; 

    loadTranslations(cookieLng)
    let status = $('#cmbStatus').val();
    let inputSearch = $('#inputSearchQuote').val();
    searchDataProductTbl(inputSearch, status);

    let isToastOpen = false;

    function searchDataProductTbl(consulta, status, dateFrom, dateTo) {
        $.ajax({
            url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchQuoteTbl.php",
            type: "POST",
            data: { consulta, status, dateFrom, dateTo },
        })
        .done(function(respuesta) {
            $('#tblQuoteClient').html(respuesta);
            searchQuoteTblPagination(consulta, status, dateFrom, dateTo);
        })
        .fail(function() {
            console.log("error");
        });
    }

    function searchQuoteTblPagination(consulta, status, dateFrom, dateTo){
        $(".pagination #form-next").submit(function(e) {
            e.preventDefault();
            var nextPage = $(this).find("input[name=u]").val();
      
            $.ajax({
                url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchQuoteTbl.php',
                type: "POST",
                data: { consulta, status, dateFrom, dateTo, u: nextPage },
                success: function(data) {
                    var tableContent = $(data).find('#tblQuoteClientBody').html();
                    $('#tblQuoteClientBody').html(tableContent);

                    if (tableContent.trim() === "") {
                        return;
                    }

                    var currentPage = nextPage;
                    $("#currentPageIndicator").text(`${alertsTranslations.page}: ${currentPage}`);
            
                    $(".pagination #form-next input[name=u]").val(parseInt(currentPage) + 1);
                    let prev = parseInt(currentPage) > 1? parseInt(currentPage) - 1 : 1;
                    $(".pagination #form-previous input[name=u]").val(prev);
                },
                error: function() {
                    alert(alertsTranslations.errorLoadingQuoteData);
                }
            });
        });
    
        $(".pagination #form-previous").submit(function(e) {
            e.preventDefault();
            var nextPage = $(this).find("input[name=u]").val();
        
            $.ajax({
                url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchQuoteTbl.php',
                type: "POST",
                data: { consulta, status, dateFrom, dateTo, u: nextPage },
                success: function(data) {
                    var tableContent = $(data).find('#tblQuoteClientBody').html();
                    $('#tblQuoteClientBody').html(tableContent);

                    if (tableContent.trim() === "") {
                        return;
                    }
        
                    var currentPage = nextPage;
                    $("#currentPageIndicator").text("Page: " + currentPage);
            
                    $(".pagination #form-next input[name=u]").val(parseInt(currentPage) + 1);
                    let prev = parseInt(currentPage) > 1? parseInt(currentPage) - 1 : 1;
                    $(".pagination #form-previous input[name=u]").val(prev);
                },
                error: function() {
                    alert(alertsTranslations.errorLoadingQuoteData);
                }
            });
        });
    }

    $(document).on('change', '#cmbStatus', function(){
        let status = $(this).val();
        let dateFrom = $('#dateFrom').val();
        let dateTo = $('#dateTO').val();
        let inputSearch = $('#inputSearchQuote').val();
        searchDataProductTbl(inputSearch, status, dateFrom, dateTo);
    });

    $(document).on('change', '#dateTO', function(){
        let dateTo = $(this).val();
        let dateFrom = $('#dateFrom').val();
        let status = $('#cmbStatus').val();
        let inputSearch = $('#inputSearchQuote').val();
        searchDataProductTbl(inputSearch, status, dateFrom, dateTo);
    });

    $(document).on('keyup', '#inputSearchQuote', function(){
        let inputSearch = $(this).val();
        let dateFrom = $('#dateFrom').val();
        let status = $('#cmbStatus').val();
        let dateTo = $('#dateTO').val();
        searchDataProductTbl(inputSearch, status, dateFrom, dateTo);
    });


    $(document).on('click', '.btn-details', function() {

        var quote_id = $(this).attr('value');

        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/cotizacionInfo.php',
            method: 'POST', 
            data: {quote_id}
        })
        .done(function (response){

            console.log(response);

            let res = JSON.parse(response);

            res.forEach(elem => {
                productName = elem.product_name;
                productModel = elem.product_model;
                productQuantity = elem.product_quantity;
                productImage = elem.product_image;
                
                var details = `${alertsTranslations.nombreDelProducto}: ${productName} <br>` +
                `${alertsTranslations.modelProduct}: ${productModel} <br>` +
                `${alertsTranslations.qty}: ${productQuantity} <br>` +
                `${alertsTranslations.image}: <img style="max-width: 200px;" src="https://kalstein.net/es/wp-content/uploads/kalsteinQuote/'${productImage}'">`;
      
                iziToast.show({
                    title: `${alertsTranslations.quoteDetails} (ID:  ${quote_id} ')`,
                    message: details,
                    position: 'center',
                    timeout: false,
                    closeOnClick: true,
                    progressBar: false
                });
            });
        })
        .fail(function(){
            iziToast.error({
                title: alertsTranslations.error,
                message: alertsTranslations.couldNotRetrieveInfoFromDatabase,
                position: 'center',
                timeout: false,
                closeOnClick: true,
                progressBar: false
            });
        });
    });

    $(document).on('click', '#btnProcess', function(){

        var id = $(this).val();

        iziToast.question({
            timeout: false,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: alertsTranslations.confirmacion,
            message: `${alertsTranslations.areYouSureYouWantToProcessTheQuote} ${id} ?`,
            position: 'center',
            buttons: [
                [`<button><b>${alertsTranslations.yes}</b></button>`, function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    quoteUpdateStatus(id, 3);
                },
                true
                ],
                [`<button>${alertsTranslations.no}</button>`, function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }]
            ],
            onClosing: function(instance, toast, closedBy) {
                console.log('Closing...');
                searchDataProductTbl();
            },
            onClosed: function(instance, toast, closedBy) {
                console.log('Closed...');
            }
        });
    });
    $(document).on('click', '#btnDeny', function(){

        var id = $(this).val();

        iziToast.question({
            timeout: false,
            close: false,
            overlay: true,
            displayMode: 'once',
            id: 'question',
            zindex: 999,
            title: alertsTranslations.confirmacion,
            message: `${alertsTranslations.areYouSureYouWantToDeniedTheQuote} ${id}?`,
            position: 'center',
            buttons: [
                [`<button><b>${alertsTranslations.yes}</b></button>`, function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    quoteUpdateStatus(id, 4);
                },
                true
                ],
                [`<button>${alertsTranslations.no}</button>`, function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }]
            ],
            onClosing: function(instance, toast, closedBy) {
                console.log('Closing...');
                searchDataProductTbl();
            },
            onClosed: function(instance, toast, closedBy) {
                console.log('Closed...');
            }
        });
    });

    function quoteUpdateStatus(cotizacion_id, cotizacion_status) {
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/updateStatus.php',
            method: 'POST', 
            data: {cotizacion_id, cotizacion_status}
        })
        .done(function(respuesta){
            console.log(respuesta)
            let data = JSON.parse(respuesta)
            if (data.update === 'correcto'){
            iziToast.success({
                title: alertsTranslations.exito,
                message: alertsTranslations.updateSuccessful,
                position: 'topRight',
            });
        }
        })
        .fail(function(){
            console.log("error");
        });
    }

    $(document).on('click', '#btnInfoClientQuote', function(){
        let aid = $(this).val()
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoClientQuote.php',
            method: 'POST', 
            data: {aid}
        })
        .done(function(respuesta){            
            $('.tblInfoClient').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnViewMoreAccClient', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoClientAcc.php',
            method: 'POST'
        })
        .done(function(respuesta){            
            $('.tblClientAcc').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnViewMoreAccDistribuitor', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoDistribuitorAcc.php',
            method: 'POST'
        })
        .done(function(respuesta){            
            $('.tblDistribuitorAcc').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnViewMoreAccManufacturer', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoManufacturerAcc.php',
            method: 'POST'
        })
        .done(function(respuesta){            
            $('.tblManufacturerAcc').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnViewMoreAccRental', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoRental&SalesAcc.php',
            method: 'POST'
        })
        .done(function(respuesta){            
            $('.tblRentalAcc').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnViewMoreAccTechnical', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoTechnicalAcc.php',
            method: 'POST'
        })
        .done(function(respuesta){            
            $('.tblTechnicalAcc').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnViewMoreAccScientist', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoScientistAcc.php',
            method: 'POST'
        })
        .done(function(respuesta){            
            $('.tblScientistAcc').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnViewMoreAccUndetermined', function(){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchInfoUndeterminedAcc.php',
            method: 'POST'
        })
        .done(function(respuesta){            
            $('.tblUndeterminedAcc').html(respuesta)
        })
        .fail(function(){
            console.log("error");
        });
    })

    $(document).on('click', '#btnDonwloadInfoClientQuote', function(){
        let code = $(this).val()
        window.location.href = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/generateCSVDataClient.php?code='+code
    })

    $(document).on('click', '#btnExportAllDataCSV', function(){
        let valor = $('#cmbTypeClient').val()
        let valor2 = $('#cmbDayShifts').val()
        let valor3 = $('#dateFromCSV').val()
        let valor4 = $('#dateToCSV').val()
        let valor5 = $('#cmbTypeClient2').val()   
        let currentDate = new Date()
        let d = currentDate.getDate()
        let m = currentDate.getMonth() + 1
        let Y = currentDate.getFullYear()
        let fecha = Y+'-'+m+'-'+d

        if (valor != '' && valor2 != '' || valor3 != '' && valor4 != '' && valor5 != ''){
            window.location.href = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/generateCSVAllDataClient.php?typeClient='+valor+'&dayShifts='+valor2+'&currentDate='+fecha+'&dateFrom='+valor3+'&dateTo='+valor4+'&typeClient2='+valor5
        }else{
            iziToast.warning({
                title: alertsTranslations.warning,
                message: alertsTranslations.doNotLeaveFieldsEmpty,
                position: 'center',
                timeout: 2000,
                closeOnClick: true,
                progressBar: false,
                onClosed: function() {
                    isToastOpen = false; 
                }
            });
            isToastOpen = true;
        }
    })    

    $(document).on('change', '#cmbTypeClient', function(e){
        if (isToastOpen) {
            return; 
        }

        let valor = $('#cmbTypeClient2').val()
        let valor2 = $('#dateToCSV').val()
        let valor3 = $('#dateFromCSV').val()

        if (valor != 0 || valor2 != '' || valor3 != ''){
            $('#cmbTypeClient').val(0)
            iziToast.warning({
                title: alertsTranslations.warning,
                message: alertsTranslations.dataParameters,
                position: 'center',
                timeout: 2000,
                closeOnClick: true,
                progressBar: false,
                onClosed: function() {
                    isToastOpen = false; 
                }
            });
            isToastOpen = true; 
        }
    })

    $(document).on('change', '#cmbDayShifts', function(e){
        if (isToastOpen) {
            return; 
        }

        let valor = $('#cmbTypeClient2').val()
        let valor2 = $('#dateToCSV').val()
        let valor3 = $('#dateFromCSV').val()

        if (valor != 0 || valor2 != '' || valor3 != ''){
            $('#cmbDayShifts').val(0)
            iziToast.warning({
                title: alertsTranslations.warning,
                message: alertsTranslations.dataParameters,
                position: 'center',
                timeout: 2000,
                closeOnClick: true,
                progressBar: false,
                onClosed: function() {
                    isToastOpen = false; 
                }
            });
            isToastOpen = true; 
        }
    })

    $(document).on('change', '#cmbTypeClient2', function(){
        if (isToastOpen) {
            return; 
        }

        let valor = $('#cmbTypeClient').val()
        let valor2 = $('#cmbDayShifts').val()

        if (valor != 0 || valor2 != 0){
            $('#cmbTypeClient2').val(0)
            iziToast.warning({
                title: alertsTranslations.warning,
                message: alertsTranslations.dataParameters,
                position: 'center',
                timeout: 2000,
                closeOnClick: true,
                progressBar: false,
                onClosed: function() {
                    isToastOpen = false; 
                }
            });
            isToastOpen = true; 
        }
    })

    $(document).on('change', '#dateFromCSV', function(){
        if (isToastOpen) {
            return; 
        }

        let valor = $('#cmbTypeClient').val()
        let valor2 = $('#cmbDayShifts').val()

        if (valor != 0 || valor2 != 0){
            $('#dateFromCSV').val('')
            iziToast.warning({
                title: alertsTranslations.warning,
                message: alertsTranslations.dataParameters,
                position: 'center',
                timeout: 2000,
                closeOnClick: true,
                progressBar: false,
                onClosed: function() {
                    isToastOpen = false; 
                }
            });
            isToastOpen = true; 
        }
    })

    $(document).on('change', '#dateToCSV', function(){
        if (isToastOpen) {
            return; 
        }

        let valor = $('#cmbTypeClient').val()
        let valor2 = $('#cmbDayShifts').val()

        if (valor != 0 || valor2 != 0){
            $('#dateFromCSV').val('')
            iziToast.warning({
                title: alertsTranslations.warning,
                message: alertsTranslations.dataParameters,
                position: 'center',
                timeout: 2000,
                closeOnClick: true,
                progressBar: false,
                onClosed: function() {
                    isToastOpen = false; 
                }
            });
            isToastOpen = true; 
        }
    })

    $(document).on('click', '.rowAccount', function(){
        let email = $(this).attr('email')

        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchHistoryQuotesAccount.php',
            method: 'POST', 
            data: {email}
        })
        .done(function (response){
            $.ajax({
                url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/searchHistoryActivityAccount.php',
                method: 'POST', 
                data: {email}
            })
            .done(function (response2){
                var content = '<div style="width: 50rem; max-height: 35rem;" id="contentHistoryActivityAccount"><div class="row"><div class="col-12"><h6>Activity history</h6></div><div class="col-6" style="border-right: 1px solid #c9c9c9;"><div class="row"><div class="col-12"><b>Quotes</b></div><div class="col-12"><div id="tblHistoryQuote" style="max-height: 30rem; overflow-y: auto;"></div></div></div></div><div class="col-6" style="border-left: 1px solid #c9c9c9;"><div class="row"><div class="col-12"><b>Activity</b></div><div class="col-12"><div id="tblHistoryActivity" style="max-height: 30rem; overflow-y: auto;"></div></div></div></div></div></div>';
    
                iziToast.show({
                    message: content,
                    position: 'topCenter',
                    timeout: false,
                    closeOnClick: true,
                    progressBar: false
                });
    
                $('#tblHistoryQuote').html(response)
                $('#tblHistoryActivity').html(response2)

                // Calcular la posición final del scroll
                var maxScroll = $("#tblHistoryActivity")[0].scrollHeight - $("#tblHistoryActivity").height();

                // Actualizar la posición del scroll
                $("#tblHistoryQuote").scrollTop(maxScroll);
            })
            .fail(function(){
                iziToast.error({
                    title: alertsTranslations.error,
                    message: alertsTranslations.couldNotRetrieveInfoFromDatabase,
                    position: 'center',
                    timeout: false,
                    closeOnClick: true,
                    progressBar: false
                });
            });
        })
        .fail(function(){
            iziToast.error({
                title: alertsTranslations.error,
                message: alertsTranslations.couldNotRetrieveInfoFromDatabase,
                position: 'center',
                timeout: false,
                closeOnClick: true,
                progressBar: false
            });
        });
    })
});

