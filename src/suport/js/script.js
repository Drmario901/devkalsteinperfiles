jQuery(document).ready(function($) {
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
    $(document).on('click', '#registrar', function(e) {
        var R_name = $('#Rnombre').val();
        var R_description = $('#RDescription').val();
        var R_category = $('#Rcategory').val();
        var R_producto = $('#Rproduct').val();
        var R_usuario = $('#Rusuario').val();
        var R_Tipo_US = $('#RTipo_US').val();
        var R_nivel = $('#Rnivel').val();
        var R_agente= $('#Ragente').val();
        var R_correo= $('#Rcorreo').val();
        var R_id_servicio = $('#Rid').val();
        var R_company= $('#Rcompany').val();
        var R_company_soporte= $('#Rcompanysoporte').val();

        console.log(R_company)
        console.log(R_company_soporte)

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
                                            if (R_company === '0') {
                                                iziToast.error({
                                                    title: 'Error',
                                                    message: alertsTranslations.assignCompanyofTheAgent,
                                                    position: 'center'
                                                });
                                            }
                                            else{
                                                if (R_company_soporte === '0') {
                                                    iziToast.error({
                                                        title: 'Error',
                                                        message: alertsTranslations.assignSupportCompany,
                                                        position: 'center'
                                                    });
                                                }
                                                else{
                                                    uploadFormData(R_name, R_usuario,R_Tipo_US, R_category, R_producto,R_description, R_nivel, R_agente,R_correo, R_id_servicio,R_company,R_company_soporte)
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
    });
  
    function  uploadFormData(R_name, R_usuario,R_Tipo_US, R_category, R_producto,R_description, R_nivel, R_agente,R_correo, R_id_servicio,R_company,R_company_soporte) {
        var formData = new FormData(); 

        console.log(R_company)
        console.log(R_company_soporte)
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
        formData.append('Registrar_company',R_company);
        formData.append('Registrar_company_soporte',R_company_soporte);
        $.ajax({ contentType: "multipart/form-data", url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/insert.php',
            type: 'POST', 
            data: formData, 
            dataType: 'text', 
            processData: false, 
            contentType: false, 
            cache: false, 
            success: function(response) {
                console.log(response); alert('alert'); window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/kalstein-support/reports/';
            },
            error: function(xhr, status, error) {
                console.log(xhr.responseText);
            }
        });
    } 
});
    
jQuery(document).ready(function($) {  
    category();  
    function category(consulta) {
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/category_product.php',
            type: 'POST',
            data: { consulta },
        })
        .done(function(respuesta) {
            console.log(respuesta);
            $('#Rcategory').html(respuesta);
        })
        .fail(function() {
            console.log("error");
        });
    }
    $(document).on('change', '#Rcategory', function(){
        let valor = $(this).val()
        products(valor)
    })

    function products(categoryProduct){
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/data_productos.php',
            type: 'POST',
            data: {categoryProduct},
        })
        .done(function(respuesta){
            $('#Rproduct').html(respuesta)   
        })
        .fail(function(){
            console.log("error")
        });
    }
});
