<style>
    .tm-edit-product-form input, .tm-edit-product-form select {
        border-color: #999;
        border-radius: 0.35rem;
    }
    .tm-edit-product-form textarea{
        border-color: #999;
        border-radius: 0.35rem;
    }
    .tm-edit-product-form input::placeholder, .tm-edit-product-form textarea::placeholder{
        color: #bbb;
    }
    .stock-title {
        background-color: #213280;
        color: white;
        padding: 5px;
        border-radius: 0.25rem;
        font-size: 18px;
        text-align: center;
        margin-bottom: 15px;
    }
    .stock-special-input {
        border-radius: 0 !important;
        margin: 5px 0;
        padding: 5px !important;
        height: auto !important;
    }
    label {
        font-weight: bold;
    }
    .table-editor-selector{
        border: 1px solid #333;
        display: flex;
        flex-direction: row;
        width: 380px;
    }
    .table-editor-selector > div{
        box-sizing: border-box;
        margin: 0;
        padding: 8px;
        width: 100%;
        text-align: center;
        font-weight: bold;
        cursor: pointer;
    }
    .table-editor-selector:first-child, .table-editor-selector:nth-child(2){
        border-right: 1px solid #333;
    }
    .table-editor-selector > div.selected{
        background-color: #333;
        color: #fff;
    }

    .p-prev-table {
        width: 100%;
    }
    .p-prev-table th {
        background-color: #fff;
        color: #000;
        border: 1px solid #aaa;
        padding: 12px;
    }
    .p-prev-table td {
        background-color: #fff;
        color: #000;
        border: 1px solid #aaa;
        padding: 12px;
    }
    .p-prev-table tr td:first-child {
        font-weight: bold;
    }

    .btn-clipboard{
        background-color: #213280;
        color: white;
        padding: 5px;
        border-radius: 0.25rem;
        width: 200px;
        cursor: pointer;
    }

    #stock-table-keys {
        padding: 0;
    }
    #stock-table-values {
        padding: 0;
    }
    #stock-table-keys > div{
        background-color: #fff;
        color: #000;
        border: 1px solid #aaa;
        font-weight: bold;
    }
    #stock-table-values > div{
        background-color: #fff;
        color: #000;
        border: 1px solid #aaa;
    }
    #stock-table-keys > div > input, #stock-table-values > div > input{
        padding: 12px;
        width: 100%;
        height: 100%;
        margin: 0;
        padding: auto;
        border: none
    }

    .stock-table-buttons {
        display: row;
        font-weight: 12px;
        display: flex;
        width: 100px;
        margin-top: 10px;
    }
    #stock-table-button-plus {
        padding: 5px;
        font-size: 15px;
        font-weight: bold;
        background-color: #333;
        color: #fff;
        width: 100%;
        text-align: center;
    }
    #stock-table-button-minus {
        padding: 5px;
        font-size: 15px;
        font-weight: bold;
        background-color: #ddd;
        border: 1px solid #333;
        color: #333;
        width: 100%;
        text-align: center;
    }
</style>

<?php 
    ini_set( 'display_errors', 1 );
    ini_set('error_reporting', E_ALL);
    error_reporting( E_ALL | E_STRICT );

    session_start(); $a = !$add ? 'A' : '' ;
?>

<div class="row tm-edit-product-form">
    <form id="addservices_form">
    <div class="col-12"><div class="stock-title" data-i17n='client:tipoServicio'>Tipo de Servicio</div></div>

    <div class="row mb-4 mt-3">
        <div class="col-12 col-md-6 col-lg-4">
            <!-- <label data-i17n='client:tituloServicio'>Titulo de Servicio</label> -->
            <label >asdfasdf</label>
            <input
                id="SE<?php echo$a?>nombre"
                name="service"
                type="text"
                class="form-control validate"
                placeholder="ej: Instalación de Autoclave"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label data-i17n='client:company' >Compañia</label>
            <input
                id="SE<?php echo$a?>company"
                type="text"
                name="service_company"
                class="form-control validate"
                value="<?php echo $acc_company ?>"
                placeholder="nombre de Compañia"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label>Agente</label>
            <input
                id="SE<?php echo$a?>agente"
                type="text"
                name="service_agente"
                class="form-control validate"
                value="<?php echo $acc_name; echo $acc_lname ?>"
                placeholder="nombre y apellido"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <!-- HACER QUE SE REGISTREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE -->
            <label for="Email" data-i17n='client:telefono' >Telefono</label>
            <input
                id="SE<?php echo$a?>telefono"
                type="number"
                class="form-control validate"
                value="<?php echo $acc_correo; ?>"
                placeholder="numero de Telefono"
                name="service_telefono"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label for="Email" data-i17n='client:correo'>Correo</label>
            <input
                id="SE<?php echo$a?>correo"
                type="text"
                class="form-control validate"
                value="<?php echo $acc_correo; ?>"
                placeholder="Correo de contacto"
                name="service_correo"
            />
        </div>
    </div>

    <div class="col-12"><div class="stock-title" data-i17n='client:direccion'>Dirección</div></div>

    <div class="row mb-4 mt-3">
        <div class="col-12 col-md-6 col-lg-4">
            <label for="Level" data-i17n='client:pais' >Pais</label>
            <select id="SE<?php echo$a?>pais" class="tm-select-accounts" name="category">
                <option selected value='0' data-i17n='client:eligeOpcion'>Elige una Opción</option>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label data-i17n='client:direccion'>Dirección</label>
            <input
                id="SE<?php echo$a?>direccion"
                type="text"
                name="service_direccion"
                class="form-control validate"
                placeholder="Dirección"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label data-i17n='client:estadoOpcional'>Estado (opcional?)</label>
            <input
                id="SE<?php echo$a?>estadoLugar"
                type="text"
                name="service_estadolugar"
                class="form-control validate"
                placeholder="Estado"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label for="name" data-i17n='client:ciudadOpcional' >Ciudad (opcional?)</label>
            <input
                id="SE<?php echo$a?>ciudad"
                type="text"
                name="service_ciudad"
                class="form-control validate"
                placeholder="Ciudad"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label for="name" data-i17n='client:provinciaOpcional'>Provincia (opcional?)</label>
            <input
                id="SE<?php echo$a?>provincia"
                type="text"
                name="service_provincia"
                class="form-control validate"
                placeholder="Provincia"
            />
        </div>
    </div>

    <div class="col-12"><div class="stock-title" data-i17n='client:acercaDelProducto'>Acerca del producto</div></div>

    <div class="row mb-4 mt-3">
        <div class="col-12 col-md-6 col-lg-4">
            <label for="Level" data-i17n='client:categoriaProducto'>Categoria de Producto</label>
            <select id="SE<?php echo$a?>category" name="service_category" class="custom-select tm-select-accounts">
                <option selected value='0' data-i17n='client:eligeOpcion'>Elige una opción</option>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
        <label for="Level">Status</label>
            <select id="SE<?php echo$a?>estado" class="custom-select tm-select-accounts" name="service_estado">
                <option value='0' selected data-i17n='client:eligeOpcion'>Elige una opción</option>
                <option value="Activated" data-i17n='client:activado'>Activado</option>
                <option value="Disabled" data-i17n='client:desactivado'>Desactivado</option>
            </select>
        </div>
        <div class="col-12 col-md-12 col-lg-4">
            <label for="name" data-i17n='client:tiempoEstimado'>Tiempo Estimado</label>
            <input
                id="SE<?php echo$a?>tiempoEstimado"
                type="text"
                name="service_tiempo"
                class="form-control validate"
                placeholder="ej: 3 dias"
            />
        </div>
        <div class="col-12">
            <label for="description" data-i17n='client:descripcion'>Descripción</label>
            <textarea
                id="SE<?php echo$a?>Descripción"                   
                class="form-control validate"
                rows="5"
                placeholder="describe what you are offering"
                name="service_description"
            ></textarea>
        </div>
    </div>
</div>
    
    <!--div class="tm-bg-primary-dark tm-block tm-block-h-auto">
        <div class="row tm-edit-product-row">
        <div class="col-xl-6 col-lg-6 col-12">
            <form method="post" class="tm-edit-product-form">
                <div class="form-group mb-3">
                    <label for="name">Service title</label>
                    <input style="color: white !important;"
                        id="SEnombre"
                        name="name"
                        type="text"
                        class="form-control validate"
                        value=""
                        required
                    />
                </div>
            </form>
        </div>
    </div>
    
    <div class="row tm-edit-product-row">
        <div class="col-xl-6 col-lg-6 col-12">
            <form method="post" class="tm-edit-product-form">
                <div class="form-group mb-3">
                    <label for="name">company</label>
                    <input style="color: white !important;"
                        id="SEcompany"
                        name="title"
                        type="text"
                        class="form-control validate"
                        value="<?php echo $acc_company ?>"
                        required
                    />
                </div>
            </form>
        </div>
    </div>
    
    <div class="row tm-edit-product-row">
        <div class="col-xl-6 col-lg-6 col-12">
            <form method="post" class="tm-edit-product-form">
                <div class="form-group mb-3">
                    <label for="name">
                        agente
                    </label>
                    <input style="color: white !important;"
                        id="SEagente"
                        name="name"
                        type="text"
                        class="form-control validate"
                        value="<?php echo $acc_name; echo $acc_lname ?>"
                        required
                    />
                </div>
            </form>
        </div>
    </div>
    <div class="row tm-edit-product-row">
        <div class="col-xl-6 col-lg-6 col-12">
            <form method="post" class="tm-edit-product-form">
                <div class="form-group mb-5">
                    <label for="Email">Email</label>
                    <input style="color: white !important;"
                        id="SEcorreo"
                        name="usuario"
                        type="text"
                        class="form-control validate"
                        required
                        value="<?php echo $acc_correo; ?>"
                    />
                </div>
            </form>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="Level">pais</label>
        <select id="SEpais" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category" >
            <option selected value='0'>Elige una Opción</option>
        </select>
    </div>
    
    <div class="row tm-edit-product-row">
        <div class="col-xl-6 col-lg-6 col-12">
            <form method="post" class="tm-edit-product-form">
                <div class="form-group mb-3">
                    <label for="name">ciudad</label>
                    <input style="color: white !important;"
                        id="SEciudad"
                        name="city"
                        type="text"
                        class="form-control validate"
                        value=""
                        required
                    />
                </div>
            </form>
        </div>
    </div>
    
    <div class="row tm-edit-product-row">
        <div class="col-xl-6 col-lg-6 col-12">
            <form method="post" class="tm-edit-product-form">
                <div class="form-group mb-3">
                    <label for="name">direccion</label>
                    <input style="color: white !important;"
                        id="SEdireccion"
                        name="address"
                        type="text"
                        class="form-control validate"
                        value=""
                        required
                    />
                </div>
            </form>
        </div>
    </div>
    <div class="form-group mb-3">
        <label for="Level">categoria de productos</label>
        <select id="SEcategory" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category">
            <option selected value='0'  style="color: #000 !important;">Choose an option</option>
        </select>
    </div>
    
    <div class="row tm-edit-product-row">
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea
                id="SEdescription"                   
                class="form-control validate"
                style="color: #fff !important;"
                rows="5"
                required>
            </textarea>
        </div>
    
        <div class="form-group mb-3">
            <label for="Level">estado</label>
            <select id="SEestado" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category">
                <option selected value='0' style="color: #000 !important;">Choose an option</option>
                <option value="activado" style="color: #000 !important;">activado</option>
                <option value="desactivado" style="color: #000 !important;">deasctivado</option>
            </select>
        </div>
                
        <div class="col-12">
            <center><button id="Register_service" name="send" class="btn btn-primary btn-block text-uppercase">agregar servicio</button></center>
        </div>
    </div-->
</div>

<!-- <script>
    jQuery(document).ready(function($){
        $('#Register_service').on('click', function(){
            alert("Boton presionado");
        });
    });
</script> -->