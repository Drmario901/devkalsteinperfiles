<?php
    if ($add){
        $stock_inputs = "
        <div class='form-group mb-3 col-12'>
            <label data-i18n='distribuidor:labelUnidexis'>Unidades en existencias</label>
            <input id='stockProduct' type='number' placeholder='0' class='form-control validate' min='0'/>
        </div>
        <div class='form-group mb-3 col-xs-12 col-sm-6' hidden>
            <label data-i18n='distribuidor:labelStatus'>Status</label>F
            <select  id='statusProduct' style='width: 200px'>
            <option class='text-dark' value='in stock' data-i18n='distribuidor:optionExistencias'> En existencias </option>
            <option class='text-dark' value='out of stock' data-i18n='distribuidor:optionAgotado'> Agotado </option>
            </select>
        </div>
        ";
    }
    else{
        $stock_inputs = "
        <div class='form-group mb-3 col-12 col-sm-6'>
            <label data-i18n='distribuidor:labelUnidexis'>Unidades en existencias</label>
            <input id='stockProduct' type='number' placeholder='0' class='form-control validate' min='0'/>
        </div>
        <div class='form-group mb-3 col-12 col-sm-6'>
            <label data-i18n='distribuidor:labelStatus'>Status</label>
            <select  id='statusProduct' style='width: 200px'>
                <option class='text-dark' value='in stock' data-i18n='distribuidor:optionExistencias'> En existencias </option>
                <option class='text-dark' value='out of stock' data-i18n='distribuidor:optionAgotado'> Agotado </option>
            </select>
        </div>
        ";
    }
?>
<style>
    .tm-edit-product-form input, .tm-edit-product-form select {
        border-color: #999;
        border-radius: 0.35rem;
    }
    .tm-edit-product-form textarea{
        border-color: #999;
        border-radius: 0;
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
    select {
        outline: 1px solid #1110;
        transition: outline .3s, border-color 0.3s;
    }
    select:focus {
        outline: 1px solid yellow;
        border-color: #000;
    }

    .triplette {
        display: flex;
        flex-direction: row;
        border: 1px solid #999;
        border-radius: 0.35rem;
    }

    .triplette input {
        border: none;
        margin: 0;
        border-right: 1px solid #999;
        border-radius: 0;
    }
    .triplette input:last-child {
        border-right: none;
    }
    .accordion-button:focus {
        z-index: 0;
    }

    .accessoryTarget {
        transition: background-color .2s;
    }
    .accessoryTarget:hover {
        background-color: #eee;
        cursor: pointer;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<form method="post" class="tm-edit-product-form">
    <div class="row">

        <?php echo $add ? '<div class="col-12"><div class="stock-title">Agregar un nuevo producto</div></div>' : '<div class="col-12"><div class="stock-title">Editar producto</div></div>'?>
        <!-- BASIC DATA -->
        <div class="col-12 col-md-6">

            <label data-i18n="distribuidor:labelNombre">Nombre</label>
            <input id="nameProduct" type="text" class="form-control validate mb-3" data-placeholder="distribuidor:labelNombre" placeholder="Nombre"/>

            
            <!-- no fake brand input -->
                <label data-i18n="distribuidor:labelMarca">Marca</label>
                <input style="color: #000 !important;" name="brandProduct"  id="brandProduct" type="text"  class="form-control validate" data-placeholder="distribuidor:labelMarca" placeholder="Marca"/>
            
            <label data-i18n="distribuidor:labelModelo">Modelo</label>
            <input id="modelProduct" type="text" class="form-control validate mb-3" data-placeholder="distribuidor:labelModelo" placeholder="Modelo"/>
            
        </div>

        <img id='imgLoad' hidden/><!-- trash??? -->

        <!-- PRODUCT IMAGE -->
        <div class="col-12 col-md-6 mb-4">
            <label data-i18n="distribuidor:labelImagenProduct">Imágen de producto</label>
            <div class="custom-file mt-3 mb-3">
                <label for="file-input" class="drop-container" id="dropcontainerImage">
                    <span class="drop-title" data-i18n="distribuidor:labelDragAndDrop">Selecciona o arrastra y suelta una imágen</span>
                    <img class="drop-image" src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png" alt="pdf">
                    <img id="thumbnail"/>
                </label>
                <input type="file" id="file-input">
            </div>
        </div>

        <div class="col-12 mb-4">
            <label data-i18n="distribuidor:labelDescripcion">Descripción</label>
            <textarea style="height: 200px" id="descriptionProduct" class="form-control validate tm-small" data-placeholder="distribuidor:placeholderDescripcion" placeholder="Describe tu producto en menos de 5000 carácteres
            "></textarea>
        </div>
    </div>

    <!-- TABLA TECNICA -->

    <div class="row">
        <label data-i18n="distribuidor:labelHojaEspecific">Hoja de especificaciones</label>
        <div class="col-12">
            <div class='table-editor-selector mb-3'>
                <div id='stock-ignore-table' class="selected" data-i18n="distribuidor:labelNinguna">
                    Ninguna
                </div>
                <div id='stock-basic-editor' data-i18n="distribuidor:labelTablaBasica">
                    Tabla básica
                </div>
                <div id='stock-excel-editor' data-i18n="distribuidor:labelTablaExcel">
                    Tabla de Excel
                </div>
            </div>
            <input type="hidden" id="table-mode" value="ignore">
            
            <!-- BASIC -->
            <div id="stock-basic-table" class="mb-4" hidden>
                
                <div>

                    <div class='stock-table-buttons mb-3'>
                        <button id="stock-table-button-plus">+</button>
                        <button id="stock-table-button-minus">-</button>
                    </div>
                    <small data-i18n="distribuidor:celdasEdit">Toca las celdas para editarlas</small>
                    <div class="row">
                        <div id="stock-table-keys" class="col-6">
                            <div><input id="table-keys-1" type="text" value="Ejemplo"></div>
                            <div><input id="table-keys-2" type="text" value="Ejemplo"></div>
                        </div>
                        <div id="stock-table-values" class="col-6">
                            <div><input id="table-values-1" type="text" value="ejemplo"></div>
                            <div><input id="table-values-2" type="text" value="ejemplo"></div>
                        </div>
                    </div>

                </div>
                
            </div>

            <!-- EXCEL -->
            <div id="stock-excel-table" class="mb-4" hidden data-i18n="distribuidor:archivoExcelCSV">

                Incluye un archivo Microsoft Excel o un .csv
                
                <div id="paste-excel-clipboard" class="btn-clipboard mb-3" data-i18n="distribuidor:textPortapapeles">
                    Pegar del portapapeles <i class="fa-regular fa-clipboard"></i>
                </div>

                <textarea id="csv" hidden data-i18n="distribuidor:textEjemplo">ejemplo</textarea>

                <span data-i18n="distribuidor:textHaveHeader">Tiene cabecera<input type="checkbox" id="has_headers" style="border-radius: 0" class="d-inline"></span>

                <label data-i18n="distribuidor:textPrevista">Prevista</label>
                <table id="resultTable" class='table p-prev-table'>
                    <thead>
                        <th>Ejemplo</th>
                        <th>ejemplo</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ejemplo</td>
                            <td>ejemplo</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    <div>
        
    <!-- PRODUCT DATA -->

    <div class="col-12">
        <div class="stock-title" data-i18n="distribuidor:textDatosProduct">Datos del producto</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 form-group mb-3">
            <label data-i18n="distribuidor:labelCategoria">Categoría</label>
            <select id="dataCategory" class="custom-select tm-select-accounts">
                <option value='' data-i18n="distribuidor:optionElige">-- Elige una opción --</option>
                <?php
                    require __DIR__.'/../../../php/conexion.php';
                
                    $consulta = "SELECT categorie_description_es FROM wp_categories ORDER BY categorie_description_es ASC";		
                        
                    $resultado = $conexion->query($consulta);

                    $already_printed = [];
                        
                    if ($resultado->num_rows > 0) {
                        while ($value = $resultado->fetch_assoc()) {
                            if (!in_array($value['categorie_description_es'], $already_printed)){
                                array_push($already_printed, $value['categorie_description_es']);
                                echo "<option value='".$value['categorie_description_es']."'>".$value['categorie_description_es']."</option>";
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <div class="col-12 col-sm-6 form-group mb-3">
            <label>Subcategoría</label>
            <select class="custom-select tm-select-accounts" id="subCategorySelect" name="subCategory" disabled>
                <option value="">Seleccione una categoría...</option>
            </select>
        </div>
        <div class="col-12 col-sm-6">
            <div class="row">
                <?php echo $stock_inputs?>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <!-- GROSS -->
        <div class="col-sm-6 col-xsm-12">
            <h6 class="tm-block-title mb-0"><span data-i18n="distribuidor:labelSubtitleProduct">Producto</span> <i class="fas fa-microscope"></i></h6>
            <label data-i18n="distribuidor:labelPesoNeto">Peso neto (kg)</label>
            <input
                id="weProduct"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n="distribuidor:labelAncho">Ancho (cm)</label>
            <input
                id="wiProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="distribuidor:labelAlto">Alto (cm)</label>
            <input
                id="heProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="distribuidor:labelLargo">Largo (cm)</label>
            <input
                id="leProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />
        </div>
        <!-- PACKAGED -->
        <div class=" col-sm-6 col-xsm-12">
            <h6 class="tm-block-title mb-0"><span data-i18n="distribuidor:subtitleEmpaque">Empaque</span> <i class="fas fa-box"></i></h6>
            <label data-i18n="distribuidor:labelPesoBruto">Peso bruto (kg)</label>
            <input
                id="weProductPa"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n="distribuidor:labelAncho">Ancho (cm)</label>
            <input
                id="wiProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="distribuidor:labelAlto">Alto (cm)</label>
            <input
                id="heProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="distribuidor:labelLargo">Largo (cm)</label>
            <input
                id="leProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="distribuidor:labelTipoEmpaque">Tipo de empaque</label>
            <select id="packageType">
                <option class="text-dark" value="" data-i18n="distribuidor:optionSelecciona">-- Selecciona --</option>
                <option class="text-dark" value="carton" data-i18n="distribuidor:CajaDeCarton">Caja de cartón</option>
                <option class="text-dark" value="wooden" data-i18n="distribuidor:CajaDeMadera">Caja de madera</option>
            </select>
        </div>
    </div>

    <!-- PRICING -->

    <div class="col-12">
        <div class="stock-title" data-i18n="distribuidor:subtitlePrecios">Precios</div>
    </div>

    <div class="row">
        <input type="checkbox" id="specialPrice" class="form-check-input" style="margin-left: 15px;">
        <div class="form-group mb-3 col-sm-6 col-xsm-12">
            <label data-i18n="distribuidor:labelPrecioUnit">Precio unitario</label>
            <input
                id="priceProduct"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control mb-1 validate"
                min="0"
            />
        </div>
        <div class="form-group mb-3 col-sm-6 col-xsm-12">
            <label><span data-i18n="distribuidor:subtitleMoneda">Moneda</span> <i class="far fa-money-bill-1 h5"></i></i></label>
            <select id="currency">
                <option class="text-dark" value="" data-i18n="distribuidor:optionSelecciona">-- Selecciona --</option>
                <option class="text-dark" value="USD">USD</option>
                <option class="text-dark" value="EUR">EUR</option>
            </select>
        </div>

        <h6 class="tm-block-title mb-0" data-i18n="distribuidor:subtitleDescuentoUno">Descuento mayorista 1 (opcional)</h6>
        <div class='form-group col-12 mb-3 ms-3'>
            <span data-i18n="distribuidor:spanAplica">Aplica </span> 
            <input style="width: 45px;"
                id="discount1"
                type="number"
                placeholder="0"
                class="form-control validate mb-2 d-inline-block stock-special-input"
                min="0"
                max="100"
            /> 
            <span data-i18n="distribuidor:spanDescuento">% descuento de </span>
            <input style="width: 55px;"
                id="discount1Amount"
                type="number"
                placeholder="24"
                class="form-control validate d-inline-block stock-special-input"
                min="0"
            /> 
            <span data-i18n="distribuidor:spanUnidades">unidades</span> 
        </div>

        <h6 class="tm-block-title mb-0" data-i18n="distribuidor:subtitleDescuentoDos">Descuento mayorista 2 (opcional)</h6>
        <div class='form-group col-12 mb-3 ms-3'>
            <span data-i18n="distribuidor:spanAplica">Aplica </span> 
            <input style="width: 45px;"
                id="discount2"
                type="number"
                placeholder="0"
                class="form-control validate mb-2 d-inline-block stock-special-input"
                min="0"
                max="100"
            /> 
            <span data-i18n="distribuidor:spanDescuento">% descuento de </span>
            <input style="width: 55px;"
                id="discount2Amount"
                type="number"
                placeholder="50"
                class="form-control validate d-inline-block stock-special-input"
                min="0"
            /> 
            <span data-i18n="distribuidor:spanUnidades">unidades</span> 
        </div>
    </div>

 <!--acessories -->
    <div class="col-12">
        <div class="stock-title" data-i18n="distribuidor:subtitleAccesorios">Accesorios</div>
    </div>
    <div class="row mb-3 d-flex justify-content-center">
        <div class="accordion col-12 col-md-8" id="accordionExample">

            <!-- ACORDEON ACCESSORY -->

            <div class="accordion-item">
                <h2 class="accordion-header pb-0" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <b data-i18n="distribuidor:subtitleAggNewAcces">Agregar un nuevo accesorio</b>
                    </button>
                </h2>


                <div id="collapseOne" class="accordion-collapse show mx-3" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <?php

                            include 'productFormAccessory.php';
                        
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div id='uploadAccesoryList' class='mt-4 col-12 col-md-4'>
        </div>
    </div>

                    

    <!-- FILES -->

    <div class="col-12">
        <div class="stock-title" data-i18n="distribuidor:suplements">Suplementos</div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 mb-3 p-4">
            <label data-i18n="distribuidor:catalogOpcional" >Catálogo informativo (opcional)</label>
            <p id='currentlyUploadedCatalog'></p>
            <label for="catalogPDF" class="drop-container" id="dropcontainerCatalog">
                <span class="drop-title" data-i18n="distribuidor:dragAndDrop" >Selecciona o arrastra y suelta tu archivo</span>
                <img class="drop-image" src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/PDF-document-upload.png" alt="pdf">
            </label>
            <input type="file" id="catalogPDF" accept="application/pdf" required>
        </div>
        <div class="col-12 col-md-6 mb-3 p-4">
            <label data-i18n="distribuidor:manualOpcional">Manual técnico (opcional)</label>
            <p id='currentlyUploadedManual'></p>
            <label for="manualPDF" class="drop-container" id="dropcontainerManual">
                <span class="drop-title" data-i18n="distribuidor:dragAndDrop">Selecciona o arrastra y suelta tu archivo</span>
                <img class="drop-image" src="https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/PDF-document-upload.png" alt="pdf">
            </label>
            <input type="file" id="manualPDF" accept="application/pdf" required>
        </div>
    </div>
</form>

<script>
        $('#dataCategory').change(function() {
            var category = $(this).val();

            $.ajax({
                url: plugin_dir + "/php/manufacturer/updateSubcategory.php",
                method: 'POST',
                data: { category: category },
                dataType: 'html',
                success: function(response) {
                    if (response.trim() === '') {
                        $('#subCategorySelect').html('<option value="">' + category + '</option>');
                        $('#subCategorySelect').prop('disabled', true);
                    } else {
                        $('#subCategorySelect').html(response);
                        $('#subCategorySelect').prop('disabled', false);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error en la solicitud AJAX:', status, error);
                }
            });
        });
    </script>
