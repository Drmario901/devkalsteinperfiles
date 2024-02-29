/*let plugin_dir = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/';
let domain = 'https://dev.kalstein.plus/plataforma/index.php/fabricante/';*/
function validateProductData(name, model, description, category, fileInput, stock, status,
                                 weight, length, width, height,
                                 weight_pa, length_pa, width_pa, height_pa, pa_type,
                                 price, currency,
                                 discount_1, discount_1_amount, discount_2, discount_2_amount, dont_image = false){
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
        err_msg = 'Nombre vacío';
        scroll('#nameProduct');
    }
    else if (model === '') {
        err_msg = 'Modelo vacío';
        scroll('#modelProduct');
    }
    else if (description === '') {
        err_msg = 'Descripción vacía';
        scroll('#descriptionProduct');
    }
    else if ((fileInput === undefined || fileInput === '' || fileInput == []) && !dont_image) {
        err_msg = 'Agrega una imágen o soluciona los problemas de la imágen actual';
        scroll('#file-input');
    }
    else if (category === '') {
        err_msg = 'Categoría vacía';
        scroll('#dataCategory');
    }
    else if (stock === '') {
        err_msg = 'manufacturer/stock en existencias vacío';
        scroll('#stockProduct');
    }
    else if (status === '') {
        err_msg = 'Estatus de existencias vacío';
        scroll('#statusProduct');
    }
    else if (weight === '') {
        err_msg = 'Peso vacío';
        scroll('#weProduct');
    }
    else if (width === '') {
        err_msg = 'Ancho vacío';
        scroll('#wiProduct');
    }
    else if (height === '') {
        err_msg = 'Alto vacío';
        scroll('#heProduct');
    }
    else if (length === '') {
        err_msg = 'Largo vacío';
        scroll('#leProduct');
    }
    else if (weight_pa === '') {
        err_msg = 'Peso de empaque vacío';
        scroll('#weProductPa');
    }
    else if (width_pa === '') {
        err_msg = 'Ancho de empaque vacío';
        scroll('#wiProductPa');
    }
    else if (height_pa === '') {
        err_msg = 'Alto de empaque vacío';
        scroll('#heProductPa');
    } 
    else if (length_pa === '') {
        err_msg = 'Largo de empaque vacío';
        scroll('#leProductPa');
    }
    else if (pa_type === '') {
        err_msg = 'Tipo de empaque vacío';
        scroll('#packageType');
    } 
    else if (price === '') {
        err_msg = 'Precio unitario vacío';
        scroll('#priceProduct');
    }
    else if (currency === '') {
        err_msg = 'Tipo de moneda vacío';
        scroll('#currency');
    }
    // negative verification
    else if (parseFloat(stock) <= 0) {
        err_msg = 'Las existencias no pueden ser inferiores a 0';
        scroll('#stockProduct');
    }
    else if (parseFloat(price) <= 0) {
        err_msg = 'Precio no puede ser inferior a 0';
        scroll('#priceProduct');
    }
    else if (parseFloat(weight) <= 0) {
        err_msg = 'Peso no puede ser inferior a 0';
        scroll('#weProduct');
    }
    else if (parseFloat(width) <= 0) {
        err_msg = 'Largo no puede ser inferior a 0';
        scroll('#wiProduct');
    }
    else if (parseFloat(height) <= 0) {
        err_msg = 'Ancho no puede ser inferior a 0';
        scroll('#heProduct');
    }
    else if (parseFloat(length) <= 0) {
        err_msg = 'Alto no puede ser inferior a 0';
        scroll('#leProduct');
    } 
    else if (parseFloat(weight_pa) <= 0) {
        err_msg = 'Peso de empaque no puede ser inferior a 0';
        scroll('#weProductPa');
    }
    else if (parseFloat(width_pa) <= 0) {
        err_msg = 'El largo del paquete no puede ser inferior a 0';
        scroll('#wiProductPa');
    }
    else if (parseFloat(height_pa) <= 0) {
        err_msg = 'Ancho del paquete no puede ser inferior a 0';
        scroll('#heProductPa');
    }
    else if (parseFloat(length_pa) <= 0) {
        err_msg = 'Alto del paquete no puede ser inferior a 0';
        scroll('#leProductPa');
    }
    // discount validations
    else if (parseFloat(discount_1_amount) < 0) {
        err_msg = 'Monto de descuento 1 no puede ser inferior a 0';
        scroll('#discount1Amount');
    }
    else if (parseFloat(discount_2_amount) < 0) {
        err_msg = 'Monto de descuento 2 no puede ser inferior a 0';
        scroll('#discount2Amount');
    }
    else if (parseFloat(price) < 2){
        err_msg = 'Precio no puede ser inferior a 2';
        scroll('#priceProduct');
    }
    // length validations
    else if (name.length > 200) {
        err_msg = 'El nombre no puede ser inferior de 200 carácteres';
        scroll('#nameProduct');
    }
    else if (model.length > 50) {
        err_msg = 'El modelo no puede ser menos de 50 carácteres';
        scroll('#modelProduct');
    }
    else if (description.length > 5000) {
        err_msg = 'Descripción no puede ser inferior de 5000 carácteres';
        scroll('#descriptionProduct');
    }
    else {


        // verificacion de enlaces


        let reg = RegExp(/(\b(https?|ftp|file):\/\/|www\.[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig)


        let name_r = reg.test(name);
        let description_r = reg.test(description);


        if(name_r){
            err_msg = 'Evite vincular a sitios web externos en el título';
            scroll('#nameProduct');
        }
        else if(description_r){
            err_msg = 'Evite vincular a sitios web externos en la descripción';
            scroll('#descriptionProduct');
        }


        // verificacion de etiquetas HTML


        reg_ex1 = RegExp(/<(\S*?)[^>]*>.*?<\/\1>|<.*?\/>/g);
        reg_ex2 = RegExp(/<(\S*?)[^>]*>/g);


        if (reg_ex1.test(name) || reg_ex2.test(name)){
            err_msg = 'Evite el uso de expresiones del tipo "&lt;xxx&gt;", "&lt;xxx/&gt;".';
            scroll('#nameProduct');
        }
        if (reg_ex1.test(description) || reg_ex2.test(description)){
            err_msg = 'Evite el uso de expresiones del tipo "&lt;xxx&gt;", "&lt;xxx/&gt;".';
            scroll('#descriptionProduct');
        }


        // marca y modelo en el nombre


        let con2 = name.toLowerCase().includes(document.querySelector('#productBrand').value.toLowerCase());


        if(con2){
            err_msg = `Evite colocar el nombre de su marca en el nombre de su producto<br>
            Su marca se completará con la información de su cuenta`;
            scroll('#nameProduct');
        }


        // validacion de los descuentos


        if (parseFloat(discount_1_amount) > 0){


            if (discount_1 == '') {
                err_msg = 'Descuento 1 vacío';
                scroll('#discount1');
            }
            else if (parseFloat(discount_1) > 100) {
                err_msg = 'El descuento 1 no puede ser mayor que 100';
                scroll('#discount1');
            }
            else if (parseFloat(discount_1) <= 0) {
                err_msg = 'Descuento 1 no puede ser menor que 0';
                scroll('#discount1');
            }
            
        }
        
        if (parseFloat(discount_2_amount) > 0){
            
            if (discount_2 == '') {
                err_msg = 'Descuento vacío';
                scroll('#discount2');
            }
            else if (parseFloat(discount_2) > 100) {
                err_msg = 'El descuento 2 no puede ser mayor que 100';
                scroll('#discount2');
            }
            else if (parseFloat(discount_2) <= 0) {
                err_msg = 'El descuento 2 no puede ser menor que 0';
                scroll('#discount2');
            }
            
            if(discount_2_amount <= discount_1_amount){
                err_msg = 'El descuento de 2 unidades debe ser mayor que el descuento de 1 unidad';
                scroll('#discount2Amount');
            }
            else if(discount_2 <= discount_1){
                err_msg = 'El descuento 2 por ciento debe ser mayor que el descuento 1 por ciento';
                scroll('#discount2');
            }


        }


        // palabras clave


        const words = [
            "Exclusivo",
            "Económico",
            "Increíble",
            "Milagroso",
            "Garantizado",
            "Libre de riesgo",
            "100% seguro",
            "Oferta limitada",
            "Ahorros garantizados",
            "Producto antiguo",
            "Solución definitiva",
            "Testimonios asombrosos",
            "Secreto revelado",
            "Fácil ganar dinero",
            "Número 1 en ventas",
            "Precios de liquidación",
            "Descuentos exagerados",
            "Gana premios al instante",
            "Incomparable",
            "Supera todas las expectativas",
        ];
        


        for (let word of words){
            if(description.includes(word)){
                err_msg = 'Evite colocar palabras publicitarias en la descripción';
                scroll('#descriptionProduct');
            }
            else if(name.includes(word)){
                err_msg = 'Evite colocar palabras publicitarias en el nombre del producto';
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
        err_msg = 'El tamaño del archivo excede a 10 MB.';
    }
    // formato de imagen
    else if (!allowedTypes.includes(fileType)) {
        err_msg = 'Solo archivos JPG, PNG, and JPEG están permitidos.';
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
                    message: 'La imágen debe de ser al menos de 900x900px en tamaño.',
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
            err_msg = 'Archivo excede el límite de 20 MB.';
        }
        // formato de imagen
        else if (!allowedTypes.includes(fileType)) {
            err_msg = 'Solo archivos PDF están permitidos.';
        }
    
        if (err_msg != ""){
            iziToast.error({
                title: 'Error',
                message: err_msg + ' El archivo puede ser descartado ',
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

    $(document).on('keydown', '#modelProduct', function(e) {
        if (e.which === 32) {
          e.preventDefault();
          
          iziToast.warning({
            title: 'Información',
            message: 'No está permitido el espaciado en este campo.',
            position: 'topCenter', 
            timeout: 3000
          });
        }
      });

    $(document).on('click', '#btnSendData', function(e) {


        var name = $('#nameProduct').val().replace(/'/g, "\\'");
        var model = $('#modelProduct').val().replace(/'/g, "\\'");
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
        var currency = $('#currency').val();


        var discount_1 = $('#discount1').val();
        var discount_1_amount = $('#discount1Amount').val();
        var discount_2 = $('#discount2').val();
        var discount_2_amount = $('#discount2Amount').val();


        var manual = $('#manualPDF')[0].files[0];
        var catalog = $('#catalogPDF')[0].files[0];


        manual = manual == undefined? '' : manual;
        catalog = catalog == undefined? '' : catalog;


        if (validateProductData(name, model, description, category, fileInput, stock, status,
        weight, length, width, height,
        weight_pa, length_pa, width_pa, height_pa, pa_type,
        price, currency,
        discount_1, discount_1_amount, discount_2, discount_2_amount)){


            savedDataUpload(name, model, description, category, fileInput, stock, status,
                weight, length, width, height,
                weight_pa, length_pa, width_pa, height_pa, pa_type,
                price, currency,
                discount_1, discount_1_amount, discount_2, discount_2_amount, manual, catalog,
                longDescription, longDescriptionCSV);
        }
    });


    function savedDataUpload(name, model, description, category, fileInput, stock, status,
        weight, length, width, height,
        weight_pa, length_pa, width_pa, height_pa, pa_type,
        price, currency,
        discount_1, discount_1_amount, discount_2, discount_2_amount, manual, catalog,
        longDescription, longDescriptionCSV) {


        var formData = new FormData();
        
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

        
        var all_accessories = [];
        
        for (let elem of document.querySelector('#uploadAccesoryList').children){
            all_accessories.push(JSON.parse(elem.querySelector('textarea').value));
        }
        
        all_accessories = JSON.stringify(all_accessories)
        
        formData.append('accessoryData', all_accessories);

        for (let key of Object.keys(currentFileAccessories)){

            formData.append('accessoryFiles-'+key, currentFileAccessories[key]);
        }

        console.log(all_accessories);

        $('#btnSendData').attr('disabled', '');


        $.ajax({
            contentType: "multipart/form-data",
            url: plugin_dir + '/php/manufacturer/uploadProductData.php',
            type: 'POST',
            data: formData,
            dataType: 'text',
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function (response){
            //$('#btnSendData').removeAttr('disabled');
            console.log(response);
            if(!JSON.parse(response).err_msg){
                iziToast.success({
                    title: 'Éxito',
                    message: 'Los datos se subieron correctamente.',
                    position: 'center'
                });
                window.location.href = domain + '/manufacturer/stock';
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
            $('#btnSendData').removeAttr('disabled');
            iziToast.error({
                title: 'Error',
                message: '¡No se puede conectar con la base de datos!',
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


        var discount_1 = $('#discount1').val();
        var discount_1_amount = $('#discount1Amount').val();
        var discount_2 = $('#discount2').val();
        var discount_2_amount = $('#discount2Amount').val();;


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
                title: 'Confirmación',
                message: '¿Estás seguro de que deseas editar este producto?',
                position: 'center',
                buttons: [
                    ['<button><b>Sí</b></button>', function (instance, toast) {
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

        var all_accessories = [];

        
        for (let elem of document.querySelector('#uploadAccesoryList').children){
            all_accessories.push(JSON.parse(elem.querySelector('textarea').value));
        }
        
        all_accessories = JSON.stringify(all_accessories)
        
        formData.append('accessoryData', all_accessories);

        for (let key of Object.keys(currentFileAccessories)){

            formData.append('accessoryFiles-'+key, currentFileAccessories[key]);
        }

        $('#btnUpdateData').attr('disabled', '');

        console.log(all_accessories);


        $.ajax({
            contentType: "multipart/form-data",
            url: plugin_dir + '/php/manufacturer/updateProductData.php',
            type: 'POST',
            data: formData,
            dataType: 'text',
            processData: false,
            contentType: false,
            cache: false,
        })
        .done(function (response){
            //$('#btnUpdateData').removeAttr('disabled');
            console.log(response);
            if(!JSON.parse(response).err_msg){
                iziToast.success({
                    title: 'Éxito',
                    message: 'Los datos se actualizaron correctamente.',
                    position: 'center'
                });
                window.location.href = domain + '/manufacturer/stock';
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
                message: '¡No se puede conectar con la base de datos!',
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
            title: 'Confirmación',
            message: '¿Estás seguro de que deseas eliminar este producto?',
            close: false,
            overlay: true,
            timeout: false,
            position: 'center',
            buttons: [
                ['<button><b>Sí</b></button>', function (instance, toast) {


                    $.ajax({
                        url: plugin_dir + '/php/manufacturer/deleteProduct.php',
                        type: 'POST',
                        data: {delete_aid}
                    })
                    .done(function(response){
                        console.log(response);
                        if(response == 'done'){
                            // muestra el iziToast
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            iziToast.success({
                                title: 'Éxito',
                                message: 'Producto eliminado.',
                                position: 'center'
                            });


                            // elimina el elemento html de la tabla
                            $("#product-" + delete_aid).remove();
                            
                            // si la tabla se vacía, muestra el mensaje de que no hay datos en stock
                            if(document.querySelector("#product-table-body").children.length == 0){
                                $("#missing-data-msg").html("<!--center><span class='material-symbols-rounded  icon'>sentiment_dissatisfied</span></center--><center><p style='color: #000;'>No tienes ningún producto en existencias</p></center>");
                            }
                        }
                        // error al borrar el registro
                        else {
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            iziToast.error({
                                title: 'Error',
                                message: 'Producto no eliminado',
                                position: 'center'
                            });
                        }
                    })
                    // error al conectar con el archivo
                    .fail(function(){
                        instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                        iziToast.error({
                            title: 'Error',
                            message: "No se puede conectar con la base de datos",
                            position: 'center'
                        });
                    });
                    
                },
                true],
                ['<button>No</button>', function (instance, toast) {
                    instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                    iziToast.error({
                        title: 'Error',
                        message: 'Borrar producto cancelado',
                        position: 'center'
                    });
                }]
            ]
        });
    });

    // BOTON QUE LLEVA A LA PAGINA PARA EDITAR EL FORMULARIO

    $(document).on('click', '#btnEditProduct', function (){
        let edit_id = $(this).val();

        let form = $("<form action='" + domain + "/manufacturer/stock/edit" + "' method='get' hidden>" +
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
                title: 'Confirmación',
                message: '¿Estás seguro de que quieres cambiar el estatus de ' + customerName + '?',
                position: 'center',
                buttons: [
                ['<button><b>Sí</b></button>', function(instance, toast) {
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
                title: 'Advetencia',
                message: '¡Por favor seleccione una opción!',
                position: 'topRight',
            });
        }
    });


    function quoteUpdateStatus(cotizacion_id, cotizacion_status, customerName) {
        $.ajax({
            url: plugin_dir + '/php/manufacturer/updateStatus.php',
            method: 'POST', 
            data: {cotizacion_id, cotizacion_status}
        })
        .done(function(respuesta){
            let data = JSON.parse(respuesta)
            if (data.update === 'correcto'){
            iziToast.success({
                title: 'Éxito',
                message: '¡Se actualizo correctamente!',
                position: 'topRight',
            });
            window.location.href = domain + 'ordenes/?i=' + $('#hiddenPage').val();
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
            err_msg = 'País vacío';
        }
        else if (aerial_weigth == '') {
            err_msg = 'Peso aéreo vacío';
        }
        else if (aerial_price == '') {
            err_msg = 'Precio aéreo vacío';
        }
        else if (maritimal == '') {
            err_msg = 'Precio marítimo vacío';
        }
        // negative verification
        else if (parseFloat(aerial_weigth) <= 0) {
            err_msg = 'Peso aéreo no puede ser menor que 0';
        }
        else if (parseFloat(aerial_price) <= 0) {
            err_msg = 'Precio aéreo no puede ser menor que 0';
        }
        else if (parseFloat(maritimal) <= 0) {
            err_msg = 'Marítimo no puede ser menor que 0';
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
                url: plugin_dir + '/php/manufacturer/uploadShippingPrices.php',
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
                        title: 'Éxito',
                        message: '¡Los datos se subieron correctamente!',
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
                    message: '¡No se puede conectar con la base de datos!',
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


