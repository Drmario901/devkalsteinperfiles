let plugin_dir = 'https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/';
let domain = 'https://testing.kalstein.digital/index.php/rentalsale/';

function validateProductData(name, brand, model, description, category, fileInput, stock, status, weight, length, width, height, weight_pa, length_pa, width_pa, height_pa, pa_type, price, rentaltime, currency, dont_image = false){
    
    err_msg = '';

    function scroll(selector) {

        const a = document.querySelector(selector);
        a.scrollIntoView({
            behavior: "smooth"
        })
        document.querySelector(selector).focus();
    }

    // void verifications
    if (name === '') {
        err_msg = 'Name empty';
        scroll('#nameProduct');
    }
    else if (brand === '') {
      err_msg = 'Brand empty';
      scroll('#productBrand');
  }
    else if (model === '') {
        err_msg = 'Model empty';
        scroll('#modelProduct');
    }
    else if (description === '') {
        err_msg = 'Description empty';
        scroll('#descriptionProduct');
    }
    else if ((fileInput === undefined || fileInput === '') && !dont_image) {
        err_msg = 'Add an image or fix problems with the current image';
        scroll('#file-input');
    }
    else if (category === '') {
        err_msg = 'Category empty';
        scroll('#dataCategory');
    }
    else if (stock === '') {
        err_msg = 'Stock empty';
        scroll('#stockProduct');
    }
    else if (status === '') {
        err_msg = 'Stock status empty';
        scroll('#statusProduct');
    }
    else if (weight === '') {
        err_msg = 'Weight empty';
        scroll('#weProduct');
    }
    else if (width === '') {
        err_msg = 'Width empty';
        scroll('#wiProduct');
    }
    else if (height === '') {
        err_msg = 'Height empty';
        scroll('#heProduct');
    }
    else if (length === '') {
        err_msg = 'Length empty';
        scroll('#leProduct');
    }
    else if (weight_pa === '') {
        err_msg = 'Packing weight empty';
        scroll('#weProductPa');
    }
    else if (width_pa === '') {
        err_msg = 'Packing width empty';
        scroll('#wiProductPa');
    }
    else if (height_pa === '') {
        err_msg = 'Packing height empty';
        scroll('#heProductPa');
    } 
    else if (length_pa === '') {
        err_msg = 'Packing length empty';
        scroll('#leProductPa');
    }
    else if (pa_type === '') {
        err_msg = 'Packing type empty';
        scroll('#packageType');
    } 
    else if (price === '') {
        err_msg = 'Unit price empty';
        scroll('#priceProduct');
    }
    else if (rentaltime === '') {
      err_msg = 'Rental Type empty';
      scroll('#rentalType');
   }
    else if (currency === '') {
        err_msg = 'Currency empty';
        scroll('#currency');
    }
    // negative verification
    else if (parseFloat(stock) <= 0) {
        err_msg = 'Stock cannot be less than 0';
        scroll('#stockProduct');
    }
    else if (parseFloat(price) <= 0) {
        err_msg = 'Price cannot be less than 0';
        scroll('#priceProduct');
    }
    else if (parseFloat(weight) <= 0) {
        err_msg = 'Weight cannot be less than 0';
        scroll('#weProduct');
    }
    else if (parseFloat(width) <= 0) {
        err_msg = 'Length cannot be less than 0';
        scroll('#wiProduct');
    }
    else if (parseFloat(height) <= 0) {
        err_msg = 'Width cannot be less than 0';
        scroll('#heProduct');
    }
    else if (parseFloat(length) <= 0) {
        err_msg = 'Height cannot be less than 0';
        scroll('#leProduct');
    } 
    else if (parseFloat(weight_pa) <= 0) {
        err_msg = 'Packing weight cannot be less than 0';
        scroll('#weProductPa');
    }
    else if (parseFloat(width_pa) <= 0) {
        err_msg = 'Packing length cannot be less than 0';
        scroll('#wiProductPa');
    }
    else if (parseFloat(height_pa) <= 0) {
        err_msg = 'Packing width cannot be less than 0';
        scroll('#heProductPa');
    }
    else if (parseFloat(length_pa) <= 0) {
        err_msg = 'Packing height cannot be less than 0';
        scroll('#leProductPa');
    }
    // length validations
    else if (name.length > 200) {
        err_msg = 'Name must be less than 200 characters';
        scroll('#nameProduct');
    }
    else if (model.length > 50) {
        err_msg = 'Name must be less than 50 characters';
        scroll('#modelProduct');
    }
    else if (description.length > 5000) {
        err_msg = 'Descriptiom must be less than 5000 characters';
        scroll('#descriptionProduct');
    }
    else {

        // verificacion de enlaces

        let reg = RegExp(/(\b(https?|ftp|file):\/\/|www\.[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig)

        let name_r = reg.test(name);
        let description_r = reg.test(description);

        if(name_r){
            err_msg = 'please avoid linking to external websites in the title';
            scroll('#nameProduct');
        }
        else if(description_r){
            err_msg = 'please avoid linking to external websites in the descrption';
            scroll('#descriptionProduct');
        }

        // verificacion de etiquetas HTML

        reg_ex1 = RegExp(/<(\S*?)[^>]*>.*?<\/\1>|<.*?\/>/g);
        reg_ex2 = RegExp(/<(\S*?)[^>]*>/g);

        if (reg_ex1.test(name) || reg_ex2.test(name)){
            err_msg = 'Please avoid using expressions of the form "&lt;xxx&gt;", "&lt;xxx/&gt;".';
            scroll('#nameProduct');
        }
        if (reg_ex1.test(description) || reg_ex2.test(description)){
            err_msg = 'Please avoid using expressions of the form "&lt;xxx&gt;", "&lt;xxx/&gt;".';
            scroll('#descriptionProduct');
        }

        // marca y modelo en el nombre

        let con2 = name.toLowerCase().includes(document.querySelector('#productBrand').value.toLowerCase());

        if(con2){
            err_msg = 'Please avoid placing the name of your brand in the name of your product<br>\
            Your brand will be filled in with your account information';
            scroll('#nameProduct');
        }

        // palabras clave

        const words = [
            "Exclusive",
            "cheap",
            "Incredible",
            "Miraculous",
            "Guaranteed",
            "Risk-free",
            "100% safe",
            "Limited offer",
            "Guaranteed savings",
            "Ancient product",
            "Definitive solution",
            "Amazing testimonials",
            "Secret revealed",
            "Easy money-making",
            "Number 1 in sales",
            "Clearance prices",
            "Exaggerated discounts",
            "Win instant prizes",
            "Unmatched",
            "Exceeds all expectations",
        ];

        for (let word of words){
            if(description.includes(word)){
                err_msg = 'Please avoid placing advertising words in the description';
                scroll('#descriptionProduct');
            }
            else if(name.includes(word)){
                err_msg = 'Please avoid placing advertising words in the name of the product';
                scroll('#nameProduct');
            }
        }
    }

    if (err_msg != ""){
        iziToast.error({
            title: 'Error',
            message: err_msg,
            position: 'center'
        });
        return false;
    }
    else return true;
}

function imgVal(file, id){

    err_msg = '';

    var maxSize = 10 * 1024 * 1024; // 10 MB
    var allowedTypes = ['image/jpeg', 'image/png'];
    var fileType = file.type;

    if (file.size > maxSize) {
        err_msg = 'The file size exceeds the limit of 10 MB.';
    }
    // formato de imagen
    else if (!allowedTypes.includes(fileType)) {
        err_msg = 'Only JPG, PNG, and JPEG files are allowed.';
    }

    // tamaño mínimo
    var _URL = window.URL || window.webkitURL;
    var objectUrl = _URL.createObjectURL(file);
    
    const image = document.createElement('img');

    image.setAttribute('hidden', '');
    
    if(err_msg == ""){
        image.onload = function() {
            if (image.width < 900 || image.height < 900) {
    
                iziToast.error({
                    title: 'Error',
                    message: 'The image must be at least 900x900px in size.',
                    position: 'center'
                });
    
                document.querySelector('#'+id).value = '';
            }
        }
    }

    image.src = objectUrl;
    document.body.appendChild(image);

    if (err_msg != ""){
        iziToast.error({
            title: 'Error',
            message: err_msg,
            position: 'center'
        });
        return false;
    }
    else return true;
}

function pdfVal(file){
    if (file != undefined){

        err_msg = '';
    
        var maxSize = 20 * 1024 * 1024; // 20 MB
        var allowedTypes = ['application/pdf'];
        var fileType = file.type;
    
        if (file.size > maxSize) {
            err_msg = 'File size exceeds the limit of 20 MB.';
        }
        // formato de imagen
        else if (!allowedTypes.includes(fileType)) {
            err_msg = 'Only PDF files are allowed.';
        }
    
        if (err_msg != ""){
            iziToast.error({
                title: 'Error',
                message: err_msg + ' The file will be discarded',
                position: 'center'
            });
            return false;
        }
        else return true;

    }
}

jQuery(document).ready(function($) {

    // SECCION: Envío de datos al servidor para añadir nuevo product

    $(document).on('change', '#file-input', () => {
        if (!imgVal($('#file-input')[0].files[0], 'file-input')){
            $('#file-input').val(undefined);
        }
    });

    $(document).on('change', '#manualPDF', () => {
        if (!pdfVal($('#manualPDF')[0].files[0])){
            $('#manualPDF').val(undefined);
        }
    });

    $(document).on('change', '#catalogPDF', () => {
        if (!pdfVal($('#catalogPDF')[0].files[0])){
            $('#catalogPDF').val(undefined);
        }
    });

    $(document).on('click', '#btnSendData', function(e) {

        var name = $('#nameProduct').val().replace(/'/g, "\\'");
        var model = $('#modelProduct').val().replace(/'/g, "\\'");
        var brand = $('#productBrand').val().replace(/'/g, "\\'");
        var description = $('#descriptionProduct').val().replace(/'/g, "\\'");
        var category = $('#dataCategory').val();
        var fileInput = $('#file-input')[0].files[0];
        var stock = $('#stockProduct').val();
        var status = $('#statusProduct').val();

        if($('#table-mode').val() == 'basic'){
            var longDescriptionCSV = csvFromBasicTable().replace(/'/g, "\\'");;
            let json = CSVJSON.csv2json(longDescriptionCSV, {parseNumbers: true});
            var longDescription = json2rawhtml(json, false);
        }
        else if($('#table-mode').val() == 'excel'){
            var longDescriptionCSV = $('#csv').html().replace(/'/g, "\\'");;
            let json = CSVJSON.csv2json(longDescriptionCSV, {parseNumbers: true});
            var longDescription = json2rawhtml(json, document.querySelector('#has_headers').checked);
        }
        else {
            var longDescriptionCSV = '';
            var longDescription = '';
        }
        
        var weight = $('#weProduct').val();
        var length = $('#leProduct').val();
        var width = $('#wiProduct').val();
        var height = $('#heProduct').val();

        var weight_pa = $('#weProductPa').val();
        var length_pa = $('#leProductPa').val();
        var width_pa = $('#wiProductPa').val();
        var height_pa = $('#heProductPa').val();
        var pa_type = $('#packageType').val();

        var price = $('#priceProduct').val();
        var rentaltime = $('#rentalType').val()
        console.log(rentaltime)
        var currency = $('#currency').val();

        var manual = $('#manualPDF')[0].files[0];
        var catalog = $('#catalogPDF')[0].files[0];

        manual = manual == undefined? '' : manual;
        catalog = catalog == undefined? '' : catalog;

        if (validateProductData(name, brand, model, description, category, fileInput, stock, status,
        weight, length, width, height,
        weight_pa, length_pa, width_pa, height_pa, pa_type,
        price, currency,rentaltime)){

            savedDataUpload(name, brand, model, description, category, fileInput, stock, status,
                weight, length, width, height,
                weight_pa, length_pa, width_pa, height_pa, pa_type,
                price, currency, rentaltime, manual, catalog,
                longDescription, longDescriptionCSV);
        }
    });

    function savedDataUpload(name, brand, model, description, category, fileInput, stock, status,
        weight, length, width, height,
        weight_pa, length_pa, width_pa, height_pa, pa_type,
        price, currency,rentaltime, manual, catalog,
        longDescription, longDescriptionCSV) {

        var formData = new FormData();
        
        formData.append('name', name);
        formData.append('model', model);
        formData.append('brand', brand);
        formData.append('description', description);
        formData.append('category', category);
        formData.append('fileName', fileInput);
        formData.append('stock', stock);
        formData.append('status', status);
        
        formData.append('longDescription', longDescription);
        formData.append('longDescriptionCSV', longDescriptionCSV);

        formData.append('we', weight);
        formData.append('le', length);
        formData.append('wi', width);
        formData.append('he', height);

        formData.append('we_pa', weight_pa);
        formData.append('le_pa', length_pa);
        formData.append('wi_pa', width_pa);
        formData.append('he_pa', height_pa);
        formData.append('pa_type', pa_type);
        
        formData.append('price', price);
        formData.append('rentaltime', rentaltime);
        formData.append('currency', currency);

        formData.append('manual', manual);
        formData.append('catalog', catalog);

       //$('#btnSendData').attr('disabled', '');

        $.ajax({
            contentType: "multipart/form-data",
            url: plugin_dir + 'php/rentalsale/uploadProductData.php',
            type: 'POST',
            data: formData,
            dataType: 'text',
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function (response){
         console.log(response)
            $('#btnSendData').removeAttr('disabled');
            if(!JSON.parse(response).err_msg){
                iziToast.success({
                    title: 'Success',
                    message: 'The data has been successfully uploaded.',
                    position: 'center'
                });
                window.location.href = domain + 'stock';
            }
            else {
                iziToast.error({
                    title: 'Error',
                    message: JSON.parse(response).err_msg,
                    position: 'center'
                });
            }
            
        })
        .fail(function (){
            //$('#btnSendData').removeAttr('disabled');
            iziToast.error({
                title: 'Error',
                message: 'Unable to connect whit the database!',
                position: 'center'
            });
        });
    }
});

jQuery(document).ready(function($) {

   //SECCION: Subir datos para actualizar un producto existente
    $(document).on('click', '#btnUpdateData', function(e) {
        var id = $('#dataEdit').val();

        var name = $('#nameProduct').val().replace(/'/g, "\\'");
        var model = $('#modelProduct').val().replace(/'/g, "\\'");
        var description = $('#descriptionProduct').val().replace(/'/g, "\\'");
        var category = $('#dataCategory').val();
        var fileInput = $('#file-input')[0].files[0];
        var stock = $('#stockProduct').val();
        var status = $('#statusProduct').val();

        if($('#table-mode').val() == 'basic'){
            var longDescriptionCSV = csvFromBasicTable().replace(/'/g, "\\'");
            let json = CSVJSON.csv2json(longDescriptionCSV, {parseNumbers: true});
            var longDescription = json2rawhtml(json, false);
        }
        else if($('#table-mode').val() == 'excel'){
            var longDescriptionCSV = $('#csv').html().replace(/'/g, "\\'");
            let json = CSVJSON.csv2json(longDescriptionCSV, {parseNumbers: true});
            var longDescription = json2rawhtml(json, document.querySelector('#has_headers').checked);
        }
        else {
            var longDescriptionCSV = '';
            var longDescription = '';
        }

        var weight = $('#weProduct').val();
        var length = $('#leProduct').val();
        var width = $('#wiProduct').val();
        var height = $('#heProduct').val();

        var weight_pa = $('#weProductPa').val();
        var length_pa = $('#leProductPa').val();
        var width_pa = $('#wiProductPa').val();
        var height_pa = $('#heProductPa').val();
        var pa_type = $('#packageType').val();

        var price = $('#priceProduct').val();
        var currency = $('#currency').val();

        dont_image = fileInput == null;
        
        var manual = $('#manualPDF')[0].files[0];
        var catalog = $('#catalogPDF')[0].files[0];

        manual = manual == undefined? '' : manual;
        catalog = catalog == undefined? '' : catalog;

        if (validateProductData(name, model, description, category, fileInput, stock, status,
        weight, length, width, height,
        weight_pa, length_pa, width_pa, height_pa, pa_type,
        price, currency,
        discount_1, discount_1_amount, discount_2, discount_2_amount, dont_image)){
        
            iziToast.question({
                title: 'Confirmation',
                message: 'Are you sure you want to edit the product?',
                position: 'center',
                buttons: [
                    ['<button><b>Yes</b></button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    
                        updateDataUpload(id, name, model, description, category, fileInput, stock, status,
                            weight, length, width, height,
                            weight_pa, length_pa, width_pa, height_pa, pa_type,
                            price, currency,
                            discount_1, discount_1_amount, discount_2, discount_2_amount, manual, catalog,
                            longDescription, longDescriptionCSV);
                    },
                    true], 
                    ['<button>No</button>', function (instance, toast) {
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    }]
                ]
            });
        }
    });

    function updateDataUpload(id, name, model, description, category, fileInput, stock, status,
        weight, length, width, height,
        weight_pa, length_pa, width_pa, height_pa, pa_type,
        price, currency,
        discount_1, discount_1_amount, discount_2, discount_2_amount, manual, catalog,
        longDescription, longDescriptionCSV) {

        var formData = new FormData();

        formData.append('id', id);

        formData.append('name', name);
        formData.append('model', model);
        formData.append('description', description);
        formData.append('category', category);
        formData.append('fileName', fileInput);
        formData.append('stock', stock);
        formData.append('status', status);

        formData.append('longDescription', longDescription);
        formData.append('longDescriptionCSV', longDescriptionCSV);

        formData.append('we', weight);
        formData.append('le', length);
        formData.append('wi', width);
        formData.append('he', height);

        formData.append('we_pa', weight_pa);
        formData.append('le_pa', length_pa);
        formData.append('wi_pa', width_pa);
        formData.append('he_pa', height_pa);
        formData.append('pa_type', pa_type);
        
        formData.append('price', price);
        formData.append('currency', currency);

        formData.append('discount_1', discount_1);
        formData.append('discount_1_amount', discount_1_amount);
        formData.append('discount_2', discount_2);
        formData.append('discount_2_amount', discount_2_amount);

        formData.append('manual', manual);
        formData.append('catalog', catalog);

        if(manual) {
            formData.append('manual', manual);
        }
        else{
            formData.append('dontUpdatePDF', true);
        }
        
        if(manual) {
            formData.append('manual', manual);
        }
        else{
            formData.append('dontUpdateCatalogPDF', true);
        }
        
        if (fileInput) {
            formData.append('fileName', fileInput);
        }
        else{
            formData.append('dontUpdateImg', true);
        }

        $('#btnUpdateData').attr('disabled', '');

        $.ajax({
            contentType: "multipart/form-data",
            url: plugin_dir + 'php/manufacturer/updateProductData.php',
            type: 'POST',
            data: formData,
            dataType: 'text',
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function (response){
            //$('#btnUpdateData').removeAttr('disabled');
            if(!JSON.parse(response).err_msg){
                iziToast.success({
                    title: 'Success',
                    message: 'The data has been successfully updated.',
                    position: 'center'
                });
                window.location.href = domain + 'stock';
            }
            else {
                iziToast.error({
                    title: 'Error',
                    message: JSON.parse(response).err_msg,
                    position: 'center'
                });
            }
            
        })
        .fail(function (){
            $('#btnUpdateData').removeAttr('disabled');
            iziToast.error({
                title: 'Error',
                message: 'Unable to connect whit the database!',
                position: 'center'
            });
        });
    }
});


jQuery(document).ready(function($){

    // SECCION: Eliminar producto desde el boton de la página

    $(document).on('click', '#btnDeleteProduct', function(){
        let delete_aid = $(this).val();

        iziToast.question({
            title: 'Confirmation',
            message: 'Are you sure you want to delete the product?',
            close: false,
            overlay: true,
            timeout: false,
            position: 'center',
            buttons: [
                ['<button><b>Yes</b></button>', function (instance, toast) {

                    $.ajax({
                        url: plugin_dir + 'php/manufacturer/deleteProduct.php',
                        type: 'POST',
                        data: {delete_aid}
                    })
                    .done(function(response){
                        console.log(response);
                        if(response == 'done'){
                            // muestra el iziToast
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            iziToast.success({
                                title: 'Success',
                                message: 'Product deleted.',
                                position: 'center'
                            });

                            // elimina el elemento html de la tabla
                            $("#product-" + delete_aid).remove();
                            
                            // si la tabla se vacía, muestra el mensaje de que no hay datos en stock
                            if(document.querySelector("#product-table-body").children.length == 0){
                                $("#missing-data-msg").html("<!--center><span class='material-symbols-rounded  icon'>sentiment_dissatisfied</span></center--><center><p style='color: #000;'>You don't have any product on stock</p></center>");
                            }
                        }
                        // error al borrar el registro
                        else {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            iziToast.error({
                                title: 'Error',
                                message: 'Product not deleted',
                                position: 'center'
                            });
                        }
                    })
                    // error al conectar con el archivo
                    .fail(function(){
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        iziToast.error({
                            title: 'Error',
                            message: "Can't connect with database",
                            position: 'center'
                        });
                    });
                    
                },
                true],
                ['<button>No</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    iziToast.error({
                        title: 'Error',
                        message: 'Product delete canceled.',
                        position: 'center'
                    });
                }]
            ]
        });
    });

    // BOTON QUE LLEVA A LA PAGINA PARA EDITAR EL FORMULARIO

    $(document).on('click', '#btnEditProduct', function (){
        let edit_id = $(this).val();

        let form = $("<form action='" + domain + "stock/edit" + "' method='get' hidden>" +
            "<input type='hidden' name='edit' value='" + edit_id + "' /></form>");

        $('body').append(form);
        form.submit();
    });
});


jQuery(document).ready(function($){

    // SECCIÓN: Preisualizar imagen del producto desde la tabla de stock

    $(document).on('click', '#btnView', function(){
        let image = $(this).val();
        showImage(image);
    });
    
    function showImage(image) {
        iziToast.show({
            title: '',
            message: '<img src="'+image+'" style="max-width: 400px; max-height: 400px; width: auto; height: auto; display: block; margin: 0 auto;">',
            close: true,
            imageAlt: 'Image',
            onClosing: function(instance, toast, closedBy){
            }
        });
    }
});

jQuery(document).ready(function($){

    // SECCIÓN: cambiar el estatus de un pedido

    $(document).on('click', '#btnUpdate', function(){
        var id = $(this).val();
        var selectedStatus = $(this).siblings('.status-select').val();
        var customerName = $(this).closest('tr').find('.customer-name').text();

        if (selectedStatus != ''){

            iziToast.question({
                timeout: false,
                close: false,
                overlay: true,
                displayMode: 'once',
                id: 'question',
                zindex: 999,
                title: 'Confirmation',
                message: 'Are you sure you want to change the status for ' + customerName + '?',
                position: 'center',
                buttons: [
                ['<button><b>Yes</b></button>', function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    quoteUpdateStatus(id, selectedStatus, customerName);
                }, true],
                ['<button>No</button>', function(instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                }]
                ],
                onClosing: function(instance, toast, closedBy) {
                    console.log('Closing...');
                },
                onClosed: function(instance, toast, closedBy) {
                    console.log('Closed...');
                }
            });
        }
        else{
            iziToast.warning({
                title: 'Warning',
                message: 'Please select an option!',
                position: 'topRight',
            });
        }
    });

    function quoteUpdateStatus(cotizacion_id, cotizacion_status, customerName) {
        $.ajax({
            url: plugin_dir + 'php/manufacturer/updateStatus.php',
            method: 'POST', 
            data: {cotizacion_id, cotizacion_status}
        })
        .done(function(respuesta){
            let data = JSON.parse(respuesta)
            if (data.update === 'correcto'){
            iziToast.success({
                title: 'Success',
                message: 'Update successful!',
                position: 'topRight',
            });
            window.location.href = domain + 'list-order/?i=' + $('#hiddenPage').val();
        }
        })
        .fail(function(){
            console.log("error");
        });
    }
});

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
});

jQuery(document).ready(function($) {
    $(document).on('click', '#btnSendDataShipping', function (){
        
        let country = $('#country-select').val();
        
        let aerial_weigth = $('#country-aerial-weigth').val();
        let aerial_price = $('#country-aerial-price').val();
        let maritimal = $('#country-maritimal').val();

        let err_msg = '';

        if (country == '') {
            err_msg = 'Country empty';
        }
        else if (aerial_weigth == '') {
            err_msg = 'Aerial weigth empty';
        }
        else if (aerial_price == '') {
            err_msg = 'Aerial price empty';
        }
        else if (maritimal == '') {
            err_msg = 'Maritimal price empty';
        }
        // negative verification
        else if (parseFloat(aerial_weigth) <= 0) {
            err_msg = 'Aerial weigth cannot be less than 0';
        }
        else if (parseFloat(aerial_price) <= 0) {
            err_msg = 'Aerial price cannot be less than 0';
        }
        else if (parseFloat(maritimal) <= 0) {
            err_msg = 'Maritimal cannot be less than 0';
        }
        console.log(err_msg);
        if (err_msg == ''){

            var formData = new FormData();

            formData.append('country', country);
            formData.append('aerial_we', aerial_weigth);
            formData.append('aerial_pr', aerial_price);
            formData.append('maritimal_pr', maritimal);

            $.ajax({
                contentType: "multipart/form-data",
                url: plugin_dir + 'php/manufacturer/uploadShippingPrices.php',
                type: 'POST',
                data: formData,
                dataType: 'text',
                processData: false,
                contentType: false,
                cache: false,
            })
            .done(function (response){
                console.log(response);
                if(!JSON.parse(response).err_msg){
                    iziToast.success({
                        title: 'Success',
                        message: 'The data has been successfully uploaded.',
                        position: 'center'
                    });
                }
                else {
                    iziToast.error({
                        title: 'Error',
                        message: JSON.parse(response).err_msg,
                        position: 'center'
                    });
                }
                
            })
            .fail(function (){
                iziToast.error({
                    title: 'Error',
                    message: 'Unable to connect whit the database!',
                    position: 'center'
                });
            });
        }
        else {
            iziToast.error({
                title: 'Error',
                message: err_msg,
                position: 'center'
            });
        }
    });
});