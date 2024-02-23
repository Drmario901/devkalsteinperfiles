<?php
    if ($add){
        $stock_inputs = "
        <div class='form-group mb-3 col-12'>
            <label>Units to sell or rent</label>
            <input id='stockProduct' type='number' placeholder='0' class='form-control validate' min='0'/>
        </div>
        <div class='form-group mb-3 col-xs-12 col-sm-6' hidden>
            <label>Status</label>
            <select  id='statusProduct' style='width: 200px'>
                <option class='text-dark'>In stock</option>
                <option class='text-dark'>Out of stock</option>
            </select>
        </div>
        ";
    }
    else{
        $stock_inputs = "
        <div class='form-group mb-3 col-12 col-sm-6'>
            <label>Units to sell or rent</label>
            <input id='stockProduct' type='number' placeholder='0' class='form-control validate' min='0'/>
        </div>
        <div class='form-group mb-3 col-12 col-sm-6'>
            <label>Status</label>
            <select  id='statusProduct' style='width: 200px'>
                <option class='text-dark'>In stock</option>
                <option class='text-dark'>Out of stock</option>
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
</style>
<form method="post" class="tm-edit-product-form">
    <div class="row">

        <?php echo $add ? '<div class="col-12"><div class="stock-title">Add new product</div></div>' : '<div class="col-12"><div class="stock-title">Edit product</div></div>'?>
        <!-- BASIC DATA -->
        <div class="col-12 col-md-6">

            <label>Name</label>
            <input id="nameProduct" type="text" class="form-control validate mb-3" placeholder="Name"/>

            
            <!-- no fake brand input -->
                <label>Brand</label>
                <input style="color: #000 !important;"  id="brandProduct" type="text"  class="form-control validate" placeholder="Brand"/>
            
            <label>Model</label>
            <input id="modelProduct" type="text" class="form-control validate mb-3" placeholder="Model"/>

            
    <label>Condition</label>
         <select id="productCondition">
            <option value="">-- Select --</option>
            <option value="New">New</option>
            <option value="Like new">Like new</option>
            <option value="Very good">Very good</option><option value="good">Good</option>
            <option value="Acceptable">Acceptable</option> 
        </select>
            
        </div>

        <img id='imgLoad' hidden/><!-- trash??? -->

        <!-- PRODUCT IMAGE -->
        <div class="col-12 col-md-6 mb-4">
            <label>Product Image</label>
            <div class="custom-file mt-3 mb-3">
                <label for="catalogPDF" class="drop-container" id="dropcontainerImage">
                    <span class="drop-title">Select or drag and drop an image</span>
                    <img class="drop-image" src="https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png" alt="pdf">
                    <img id="thumbnail"/>
                </label>
                <input type="file" id="file-input">
            </div>
        </div>

        <div class="col-12 mb-4">
            <label>Description</label>
            <textarea style="height: 200px" id="descriptionProduct" class="form-control validate tm-small" placeholder="Describe your product in less than 5000 characters
            " ></textarea>
        </div>
    </div>

    <!-- TABLA TECNICA -->

    <div class="row">
        <label>Spec sheet</label>
        <div class="col-12">
            <div class='table-editor-selector mb-3'>
                <div id='stock-ignore-table' class="selected">
                    None
                </div>
                <div id='stock-basic-editor'>
                    Basic Table
                </div>
                <div id='stock-excel-editor'>
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
                    <small>Touch the cells for edit them</small>
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

                Include an Microsoft Excel or csv table
                
                <div id="paste-excel-clipboard" class="btn-clipboard mb-3">
                    Paste from clipboard <i class="fa-regular fa-clipboard"></i>
                </div>

                <textarea id="csv" hidden>example</textarea>

                <span>Has Header <input type="checkbox" id="has_headers" style="border-radius: 0" class="d-inline"></span>

                <label>Preview</label>
                <table id="resultTable" class='table p-prev-table'>
                    <thead>
                        <th>Example</th>
                        <th>example</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Example</td>
                            <td>example</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    <div>
        
    <!-- PRODUCT DATA -->

    <div class="col-12">
        <div class="stock-title">Product Data</div>
    </div>

    <div class="row">
        <div class="col-12 col-sm-6 form-group mb-3">
            <label>Category</label>
            <select id="dataCategory" class="custom-select tm-select-accounts">
                <option value=''>-- Choose an option --</option>
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
            <h6 class="tm-block-title mb-0">Product <i class="fas fa-microscope"></i></h6>
            <label>Net weight (kg)</label>
            <input
                id="weProduct"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <labe>Width (cm)</label>
            <input
                id="wiProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label>Height (cm)</label>
            <input
                id="heProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label>Length (cm)</label>
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
            <h6 class="tm-block-title mb-0">Packaged <i class="fas fa-box"></i></h6>
            <label>Gross weight (kg)</label>
            <input
                id="weProductPa"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <label>Width (cm)</label>
            <input
                id="wiProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label>Height (cm)</label>
            <input
                id="heProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label>Length (cm)</label>
            <input
                id="leProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label>Package Type</label>
            <select id="packageType">
                <option class="text-dark" value="">-- select --</option>
                <option class="text-dark" value="carton">Carton box</option>
                <option class="text-dark" value="wooden">Wooden box</option>
            </select>
        </div>
    </div>

    <!-- PRICING -->

    <div class="col-12">
        <div class="stock-title">Pricing</div>
    </div>

    <div class="row">
        <div class="form-group mb-3 col-sm-6 col-xsm-12">
            <label>Unit price</label>
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
            <label>Currency <i class="far fa-money-bill-1 h5"></i></i></label>
            <select id="currency">
                <option class="text-dark" value="">-- select --</option>
                <option class="text-dark" value="USD">USD</option>
                <option class="text-dark" value="EUR">EUR</option>
            </select>
        </div>
        </div>
    </div>

    <!-- FILES -->

    <div class="col-12">
        <div class="stock-title">Supplies</div>
    </div>

    <div class="row">
        <div class="col-12 col-md-6 mb-3 p-4">
            <label>Catalog info (optional)</label>
            <p id='currentlyUploadedCatalog'></p>
            <label for="catalogPDF" class="drop-container" id="dropcontainerCatalog">
                <span class="drop-title">Select or drag and drop your file</span>
                <img class="drop-image" src="https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/PDF-document-upload.png" alt="pdf">
            </label>
            <input type="file" id="catalogPDF" accept="application/pdf" required>
        </div>
        <div class="col-12 col-md-6 mb-3 p-4">
            <label>Technical manual (optional)</label>
            <p id='currentlyUploadedManual'></p>
            <label for="manualPDF" class="drop-container" id="dropcontainerManual">
                <span class="drop-title">Select or drag and drop your file</span>
                <img class="drop-image" src="https://testing.kalstein.digital/wp-content/plugins/kalsteinPerfiles/src/images/PDF-document-upload.png" alt="pdf">
            </label>
            <input type="file" id="manualPDF" accept="application/pdf" required>
        </div>
    </div>
</form>