jQuery(document).ready(function($) {
    mostrarDatos($('#dataEdit').val());
    /*dataCMB()
    function dataCMB(consulta) {
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/selectdata.php',
            type: 'POST',
            data: { consulta },
        })
        .done(function(respuesta) {
            console.log(respuesta);
            $('#dataEdit').html(respuesta);
        })
        .fail(function() {
            console.log("error");
        });
        
      

    }*/

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

    function mostrarDatos(consulta){

        $.ajax({
            // Cambia mificherophp.php por el nombre de tu fichero
            url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/reportdata.php",
            type: "POST",
            data: {consulta},
        })
        .done(function(respuesta){
            console.log(respuesta)
            let data = JSON.parse(respuesta)
            // Coloca el nombre del input el cual mostrara los datos dependiendo de si es un id o una clase vas a hacer lo mismo con todos
            $('#Anombre').val(data.name)
            $('#Ausuario').val(data.usuario)
            $('#ATipo_US').val(data.Tipo_US)
            $('#Acategory').val(data.category)
            $('#Aproducto').val(data.producto)
            $('#Adescription').val(data.description)
            $('#Anivel').val(data.nivel)
            $('#Aestado').val(data.estado)
            $('#agente').val(data.agente)
            $('#RAid').val(data.id_servicio)
            $('#Acompany').val(data.company)
            $('#Acompanysupport').val(data.company_support)
            $('#Acorreo').val(data.correo)
        })
        .fail(function(){
            console.log(data.id);
        })
    }


    // Evento on change
    
    $(document).on('change', '#dataEdit', function(){
        let valor = $(this).val()
        mostrarDatos(valor)
    })

    
    //Haciendo todo esto de manera correcta debe de cargarte los datos
    
    $(document).on('click', '#actualizar', function(e) {
        var A_id = $('#dataEdit').val();
        var A_observacion = $('#observacion').val();
        var A_moneda = $('#Amoneda').val();
        var A_price = $('#Aprice').val();
        console.log(A_price);
        
        if (A_id === '0') {
            iziToast.error({
                title: 'Error',
                message: alertsTranslations.selectId,
                position: 'center'
              });
        } else { 
            if (A_observacion === '0') {
                iziToast.error({
                    title: 'Error',
                    message: alertsTranslations.insertAnswer,
                    position: 'center'
                });
            }
            else {
                updateFormData(A_id,A_observacion,A_moneda,A_price);
            }
        }
    });


    function updateFormData( A_id, A_observacion,A_moneda,A_price) {

        var formData = new FormData();
        console.log(A_price);
        formData.append('Actualizar_id',A_id);
        formData.append('observacion',A_observacion);
        formData.append('moneda',A_moneda);
        formData.append('price',A_price);

        $.ajax({ contentType: "multipart/form-data", url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/update.php', 
            type: 'POST',
            data: formData,
            dataType: 'text',
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);  alert('hola'); window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/kalstein-support/reports/';
            },
            error: function(xhr, status, error){
                console.log(xhr.responseText);
            } 
        });
    }
});
  
jQuery(document).ready(function($) {

    $(document).on('click', '#Generador_Cotizacion', function(){
        var cotizacion = document.querySelector('#Generador_Cotizacion').checked;
        console.log(cotizacion)
        if(cotizacion== true){
            $('#datos_cotizacion').css({'display' : 'block'})}
        else{
            $('#datos_cotizacion').css({'display' : 'none'})
        }
    })
});

jQuery(document).ready(function($) {
    $(document).on('click', '#cotizacion', function(e) {
        var R_name = $('#Anombre').val();
        var R_description = $('#ADescription').val();
        var R_category = $('#Acategory').val();
        var R_producto = $('#Aproduct').val();
        var R_usuario = $('#Ausuario').val();
        var R_Tipo_US = $('#ATipo_US').val();
        var R_nivel = $('#Anivel').val();
        var R_agente= $('#Aagente').val();
        var R_correo= $('#Acorreo').val();
        var R_id_servicio = $('#Aid').val();
        var R_moneda = $('#Amoneda').val();
        var R_metodo = $('#Ametodo').val();
        var R_price = $('#Aprice').val();
        
        if (R_name === '') {
            iziToast.error({
                title: 'Error',
                message: alertsTranslations.addName,
                position: 'center'
            });
        }
        else {
            if (R_usuario === '') {
                iziToast.error({
                    title: 'Error',
                    message: alertsTranslations.addUser,
                    position: 'center'
                });
            }
            else {
                if (R_Tipo_US === '') {
                    iziToast.error({
                        title: 'Error',
                        message: alertsTranslations.addUserType,
                        position: 'center'
                      });
                }
                else{
                    if (R_category === '0') {
                        iziToast.error({
                            title: 'Error',
                            message: alertsTranslations.selectCategory,
                            position: 'center'
                        });
                    }
                    else {
                        if (R_producto === '0') {
                            iziToast.error({
                                title: 'Error',
                                message: alertsTranslations.selectProductYouHaveIssueWith,
                                position: 'center'
                            });
                        }
                        else {
                            if (R_description === '0') {
                                iziToast.error({
                                    title: 'Error',
                                    message: alertsTranslations.insertDescription,
                                    position: 'center'
                                });
                            }
                            else{
                            
                                if (R_nivel === '0') {
                                    iziToast.error({
                                        title: 'Error',
                                        message: alertsTranslations.selectRequirementLevel,
                                        position: 'center'
                                    });
                              
                                }
                                else {
                                    if (R_agente === '0') {
                                        iziToast.error({
                                            title: 'Error',
                                            message: alertsTranslations.assignReportToAgent,
                                            position: 'center'
                                        });
                                    }
                                    else{
                                        if (R_correo === '0') {
                                            iziToast.error({
                                                title: 'Error',
                                                message: alertsTranslations.assignReportToAgent,
                                                position: 'center'
                                            });
                                        }
                                        else{
                                            if (R_metodo === '0') {
                                                iziToast.error({
                                                    title: 'Error',
                                                    message: alertsTranslations.asssignMethod,
                                                    position: 'center'
                                                });
                                            }
                                            else{
                                                cotizacion(R_name, R_usuario,R_Tipo_US, R_category, R_producto,R_description, R_nivel, R_agente,R_correo, R_id_servicio,R_metodo,R_moneda,R_price)
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
    });
  
    function  cotizacion(R_name, R_usuario,R_Tipo_US, R_category, R_producto,R_description, R_nivel, R_agente,R_correo, R_id_servicio,R_metodo,R_moneda,R_price) { var formData = new FormData(); 
        
        formData.append('Registrar_name',R_name); 
        formData.append('Registrar_usuario',R_usuario); 
        formData.append('Registrar_Tipo_US',R_Tipo_US);
        formData.append('Registrar_category',R_category);
        formData.append('Registrar_producto',R_producto);
        formData.append('Registrar_description',R_description);
        formData.append('Registrar_nivel',R_nivel);  
        formData.append('Registrar_agente',R_agente);
        formData.append('Registrar_correo',R_correo);
        formData.append('Registrar_id_servicio',R_id_servicio);
        formData.append('Registrar_metodo',R_metodo);
        formData.append('Registrar_moneda',R_moneda);
        formData.append('Registrar_price',R_price);

        $.ajax({ contentType: "multipart/form-data", url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/insert_cotizacion.php',
            type: 'POST', 
            data: formData, 
            dataType: 'text', 
            processData: false, 
            contentType: false, 
            cache: false, 
            success: function(response) {
                console.log(response);
                iziToast.success({
                    title: 'Success',
                    message: alertsTranslations.updateSuccessful,
                    position: 'center'
                });
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    }
});
