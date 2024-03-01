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
    <div class="row mb-3">

        <?php echo $add ? '<div class="col-12"><div class="stock-title" data-i18n="manofacturer:agregarAccesorio">Add new accessory</div></div>' : '<div class="col-12"><div class="stock-title" data-i18n="manofacturer:editarProducto">Edit product</div></div>'?>
        <!-- BASIC DATA -->
        <div class="col-12 col-md-6">

            <label data-i18n="manofacturer:nombre">Name</label>
            <input id="nameProduct" type="text" class="form-control validate mb-3" data-placeholder='nombre' placeholder="Name"/>
            
            <label data-i18n="manofacturer:modelo">Model</label>
            <input id="modelProduct" type="text" class="form-control validate mb-3" data-placeholder='modelo' placeholder="Model"/>

            <label data-i18n="manofacturer:productosBelongs" >Product to which it belongs</label>
            <select id="parentProduct" class="validate mb-3">
                <?php
                    require __DIR__.'/../../../../php/conexion.php';
        
                    $acc_id = $_SESSION['emailAccount'];

                    $consulta = "SELECT product_aid, product_model, product_name_en FROM wp_k_products WHERE product_maker = '$acc_id' ORDER BY product_aid DESC";

                    $resultado = $conexion->query($consulta);

                    echo "<option selected value='0' data-i18n='manofacturer:seleccionar'> -- select -- </option>";
                        
                    if ($resultado->num_rows > 0) {
                        while ($value = $resultado->fetch_assoc()) {
                            $p_id = $value["product_aid"];
                            $p_name = $value["product_name_en"];
                            
                            echo "<option value='$p_id'>(ID: $p_id) $product_model $p_name</option>";
                        }
                    }
                ?>
            </select>
            
            <label data-i18n="manofacturer:descripcionOptional">Description (optional)</label>
            <textarea style="height: 200px" id="descriptionProduct" class="form-control validate tm-small" 
            data-placeholder='describe1000'
            placeholder="Describe your product in less than 1000 characters
            "></textarea>
        </div>

        <img id='imgLoad' hidden/><!-- trash??? -->

        <!-- PRODUCT IMAGE -->
        <div class="col-12 col-md-6 mb-4">
            <label data-i18n="manofacturer:imagenOptional">Image (optional)</label>
            <div class="custom-file mt-3 mb-3">
                <label for="file-input" class="drop-container" id="dropcontainerImage">
                    <span class="drop-title" data-i18n="manofacturer:seleccionarOdrop" >Select or drag and drop an image</span>
                    <img class="drop-image" src="https://platform.kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png" alt="pdf">
                    <img id="thumbnail"/>
                </label>
                <input type="file" id="file-input">
            </div>
        </div>
    </div>
    
    <!-- PRODUCT DATA -->

    <div class="col-12">
        <div class="stock-title" data-i18n="manofacturer:measurePricing" >Measures and Pricing</div>
    </div>

    <div class="row mb-3">
        <!-- GROSS -->
        <div class="col-sm-6 col-xsm-12">
            <h6 class="tm-block-title mb-0" data-i18n="manofacturer:producto" >Product <i class="fas fa-microscope"></i></h6>
            <label data-i18n="manofacturer:netoWeight">Net weight (kg)</label>
            <input
                id="weProduct"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <labe data-i18n="manofacturer:widthCm">Width (cm)</label>
            <input
                id="wiProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="manofacturer:heightCm" >Height (cm)</label>
            <input
                id="heProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="manofacturer:lengthCm">Length (cm)</label>
            <input
                id="leProduct"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />
        </div>
        <!-- PACKAGED -->
        <div class=" col-sm-6 col-xsm-12 mb-4">
            <h6 class="tm-block-title mb-0" data-i18n="manofacturer:packaged">Packaged <i class="fas fa-box"></i></h6>
            <label data-i18n="manofacturer:grossW" >Gross weight (kg)</label>
            <input
                id="weProductPa"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-1"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n="manofacturer:widthCm">Width (cm)</label>
            <input
                id="wiProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="manofacturer:heightCm">Height (cm)</label>
            <input
                id="heProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="manofacturer:lengthCm">Length (cm)</label>
            <input
                id="leProductPa"
                type="number"
                placeholder="0.00"
                class="form-control validate mb-1"
                min="0"
            />

            <label data-i18n="manofacturer:paqueteTipo">Package Type</label>
            <select id="packageType">
                <option class="text-dark" value="" data-i18n="manofacturer:seleccionar">-- select --</option>
                <option class="text-dark" value="carton" data-i18n="manofacturer:cartonBox">Carton box</option>
                <option class="text-dark" value="wooden" data-i18n="manofacturer:woodenBox">Wooden box</option>
            </select>
        </div>

        <div class="form-group mb-3 col-sm-6 col-xsm-12">
            <label data-i18n="manofacturer:precioUnico">Unit price</label>
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
            <label data-i18n="manofacturer:moneda">Currency <i class="far fa-money-bill-1 h5"></i></i></label>
            <select id="currency">
                <option class="text-dark" value="" data-i18n="manofacturer:seleccionar">-- select --</option>
                <option class="text-dark" value="USD">USD</option>
                <option class="text-dark" value="EUR">EUR</option>
            </select>
        </div>
    </div>
</form>