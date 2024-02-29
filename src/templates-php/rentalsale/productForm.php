<?php
    if ($add){
        $stock_inputs = "
        <div class='form-group mb-3 col-12'>
            <label data-i18n='rentalsale:labelUnitsToRent'>Units to rent</label>
            <input id='stockProduct' type='number' placeholder='0' class='form-control validate' min='0'/>
        </div>
        <div class='form-group mb-3 col-xs-12 col-sm-6' hidden>
            <label data-i18n='rentalsale:labelStatus'>Status</label>
            <select  id='statusProduct' style='width: 200px'>
                <option class='text-dark' data-i18n='rentalsale:optionInStock'>In stock</option>
                <option class='text-dark' data-i18n='rentalsale:optionOutStock'>Out of stock</option>
            </select>
        </div>
        ";
    }
    else{
        $stock_inputs = "
        <div class='form-group mb-3 col-12 col-sm-6'>
            <label data-i18n='rentalsale:labelUnitsToRent'>Units to rent</label>
            <input id='stockProduct' type='number' placeholder='0' class='form-control validate' min='0'/>
        </div>
        <div class='form-group mb-3 col-12 col-sm-6'>
            <label data-i18n='rentalsale:labelStatus'>Status</label>
            <select  id='statusProduct' style='width: 200px'>
                <option class='text-dark' data-i18n='rentalsale:optionInStock'>In stock</option>
                <option class='text-dark' data-i18n='rentalsale:optionOutStock'>Out of stock</option>
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
</style>
<form method="post" class="tm-edit-product-form">
    <div class="row">

        <?php echo $add ? '<div class="col-12"><div class="stock-title">Add new rental service</div></div>' : '<div class="col-12"><div class="stock-title">Edit product</div></div>'?>
        <!-- BASIC DATA -->
        <div class="col-12 col-md-6">

            <label data-i18n="rentalsale:labelEquipmentName">Equipment Name</label>
            <input id="nameProduct" type="text" class="form-control validate mb-3" data-placeholder="placeholderName" placeholder="Name"/>

            <label data-i18n="rentalsale:labelEquipmentBrand">Equipment Brand</label>
            <input id="productBrand" class="form-control validate mb-3" data-placeholder="placeholderBrand" placeholder ='Brand'>
            <label data-i18n="rentalsale:labelEquipmentModel">Equipment Model</label>
            <input id="modelProduct" type="text" class="form-control validate mb-3" data-placeholder="placeholderModel" placeholder="Model"/>
        </div>

        <img id='imgLoad' hidden/><!-- trash??? -->

        <!-- PRODUCT IMAGE -->
        <div class="col-12 col-md-6 mb-4">
            <label data-i18n="rentalsale:labelProductImage">Product Image</label>
            <div class="custom-file mt-3 mb-3">
                <label for="file-input" class="drop-container" id="dropcontainerImage">
                    <span class="drop-title" data-i18n="rentalsale:spanDragAndDrop">Select or drag and drop an image</span>
                    <img class="drop-image" src="https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png" alt="pdf">
                    <img id="thumbnail"/>
                </label>
                <input type="file" id="file-input">
            </div>
        </div>

        <div class="col-12 mb-4">
            <label data-i18n="rentalsale:labelEquipDescrip">Equipment Description</label>
            <textarea style="height: 200px" id="descriptionProduct" class="form-control validate tm-small" data-placeholder="placeholderDescripEquip" placeholder="Describe your product in less than 5000 characters
            "></textarea>
        </div>
    </div>

    <!-- TABLA TECNICA -->

    <div class="row">
        <label data-i18n="rentalsale:labelSpecSheet">Spec sheet</label>
        <div class="col-12">
            <div class='table-editor-selector mb-3'>
                <div id='stock-ignore-table' class="selected" data-i18n="rentalsale:elementNone">
                    None
                </div>
                <div id='stock-basic-editor' data-i18n="rentalsale:elementBasicT">
                    Basic Table
                </div>
                <div id='stock-excel-editor' data-i18n="rentalsale:elementExcelT">
                    Excel Table
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
                    <small data-i18n="rentalsale:elementTouchCellsET">Touch the cells for edit them</small>
                    <div class="row">
                        <div id="stock-table-keys" class="col-6">
                            <div><input id="table-keys-1" type="text" value="Example"></div>
                            <div><input id="table-keys-2" type="text" value="Example"></div>
                        </div>
                        <div id="stock-table-values" class="col-6">
                            <div><input id="table-values-1" type="text" value="example"></div>
                            <div><input id="table-values-2" type="text" value="example"></div>
                        </div>
                    </div>

                </div>
                
            </div>

            <!-- EXCEL -->
            <div id="stock-excel-table" class="mb-4" hidden>

                <span data-i18n="rentalsale:spanIncludeMicrosoft">Include an Microsoft Excel or csv table</span>
                
                <div id="paste-excel-clipboard" class="btn-clipboard mb-3">
                    <span data-i18n="rentalsale:spanPasteClipb">Paste from clipboard</span> <i class="fa-regular fa-clipboard"></i>
                </div>

                <textarea id="csv" hidden data-i18n="rentalsale:elementExampleUno">example</textarea>

                <span><strong data-i18n="rentalsale:elementHasHeader">Has Header</strong> <input type="checkbox" id="has_headers" style="border-radius: 0" class="d-inline"></span>

                <label data-i18n="rentalsale:labelPreview">Preview</label>
                <table id="resultTable" class='table p-prev-table'>
                    <thead>
                        <th data-i18n="rentalsale:elementExampleDos">Example</th>
                        <th data-i18n="rentalsale:elementExampleUno">example</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td data-i18n="rentalsale:elementExampleDos">Example</td>
                            <td data-i18n="rentalsale:elementExampleUno">example</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    <div>
        
    <!-- PRODUCT DATA -->

    <div class="col-12">
        <div class="stock-title" data-i18n="rentalsale:elementProductData">Product Data</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 form-group mb-3">
            <label data-i18n="rentalsale:labelCategory">Category</label>
            <select id="dataCategory" class="custom-select tm-select-accounts">
                <option value='' data-i18n="rentalsale:ChooseAnOption">-- Choose an option --</option>
                <?php
                    require __DIR__.'/../../../php/conexion.php';
                
                    $consulta = "SELECT categorie_description FROM wp_categories ORDER BY categorie_description ASC";
                        
                    $resultado = $conexion->query($consulta);

                    $already_printed = [];
                        
                    if ($resultado->num_rows > 0) {
                        while ($value = $resultado->fetch_assoc()) {
                            if (!in_array($value['categorie_description'], $already_printed)){
                                array_push($already_printed, $value['categorie_description']);
                                echo "<option value=".$value['categorie_description'].">".$value['categorie_description']."</option>";
                            }
                        }
                    }
                ?>
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
            <h6 class="tm-block-title mb-0"><span data-i18n="rentalsale:spanProduct">Product</span> <i class="fas fa-microscope"></i></h6>
            <label data-i18n="rentalsale:labelNetWeight">Net weight (kg)</label>
            <input
                id="weProduct"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n="rentalsale:labelWidth">Width (cm)</label>
            <input
                id="wiProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="rentalsale:labelHeight">Height (cm)</label>
            <input
                id="heProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="rentalsale:labelLength">Length (cm)</label>
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
            <h6 class="tm-block-title mb-0"><span data-i18n="rentalsale:spanPackaged">Packaged</span> <i class="fas fa-box"></i></h6>
            <label data-i18n="rentalsale:labelGrossWeight">Gross weight (kg)</label>
            <input
                id="weProductPa"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n="rentalsale:labelWidth">Width (cm)</label>
            <input
                id="wiProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="rentalsale:labelHeight">Height (cm)</label>
            <input
                id="heProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="rentalsale:labelLength">Length (cm)</label>
            <input
                id="leProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="rentalsale:labelPackageType">Package Type</label>
            <select id="packageType">
                <option class="text-dark" value="" data-i18n="rentalsale:elementSelectUno">-- select --</option>
                <option class="text-dark" value="carton" data-i18n="rentalsale:elementCartonBox">Carton box</option>
                <option class="text-dark" value="wooden" data-i18n="rentalsale:elementWoodenBox">Wooden box</option>
            </select>
        </div>
    </div>

    <!-- PRICING -->

    <div class="col-12">
        <div class="stock-title" data-i18n="rentalsale:elementPricing">Pricing</div>
    </div>

    <div class="row">
    <div class="form-group mb-3 col-sm-6 col-xsm-12">
    <label data-i18n="rentalsale:labelRentalType">Rental Type</label>
        <select id="rentalType">
            <option value="" data-i18n="rentalsale:elementSelectDos">-- Select --</option>
            <option value="Per Day" data-i18n="rentalsale:elementPerDay">Per Day</option>
            <option value="Per Week" data-i18n="rentalsale:elementPerWeek">Per Week</option>
            <option value="Per Month" data-i18n="rentalsale:elementPerMonth">Per Month</option>
        </select>
    </div>

        <div class="form-group mb-3 col-sm-6 col-xsm-12">
            <label data-i18n="rentalsale:elementFeePrice">Fee price</label>
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
            <label><span data-i18n="rentalsale:spanCurrency">Currency</span> <i class="far fa-money-bill-1 h5"></i></i></label>
                <select id="currency">
                <option class="text-dark" value="" data-i18n="rentalsale:elementSelectDos">-- Select --</option>
                <option class="text-dark" value="USD">USD</option>
                <option class="text-dark" value="EUR">EUR</option>
            </select>
        </div>
    <!-- FILES -->

    <div class="col-12">
        <div class="stock-title" data-i18n="rentalsale:elementSupplies">Supplies</div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 mb-3 p-4">
            <label data-i18n="rentalsale:labelCatalogInfo">Catalog info (optional)</label>
            <label for="catalogPDF" class="drop-container" id="dropcontainerCatalog">
                <span class="drop-title" data-i18n="rentalsale:spanSelectDragAndDrop">Select or drag and drop your file</span>
                <img class="drop-image" src="https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/PDF-document-upload.png" alt="pdf">
            </label>
            <input type="file" id="catalogPDF" accept="application/pdf" required>
            <p id='currentlyUploadedCatalog'></p>
        </div>
        <div class="col-12 col-md-6 mb-3 p-4">
            <label data-i18n="rentalsale:labelTechnicalManual">Technical manual (optional)</label>
            <label for="manualPDF" class="drop-container" id="dropcontainerManual">
                <span class="drop-title" data-i18n="rentalsale:spanSelectDragAndDrop">Select or drag and drop your file</span>
                <img class="drop-image" src="https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/PDF-document-upload.png" alt="pdf">
            </label>
            <input type="file" id="manualPDF" accept="application/pdf" required>
            <p id='currentlyUploadedManual'></p>
        </div>
    </div>
</form>