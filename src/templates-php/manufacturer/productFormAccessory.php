<div></div>
<form action=""></form>
<form id="accessories_editor" method="post" class="tm-edit-product-form">
    <input type="hidden" id="imageURL" value="">
    <div class="row mb-3">

        <input type="hidden" id="accessoyId" data-item="new" data-id="">

        <!-- BASIC DATA -->
        <div class="col-12 col-md-6">

            <label data-i18n='manofacturer:nombre'>Nombre</label>
            <input id="nameProductAcc" type="text" class="form-control validate mb-3" placeholder="Nombre" data-placeholder='nombre'/>
            
            <label class="mb-3" data-i18n='manofacturer:descripcionOptional'>Descripción (opcional)</label>
            <textarea id="descriptionProductAcc" class="form-control validate tm-small" style="height: 200px" placeholder="Describa su producto en menos de 1000 caracteres"
            data-placeholder='describe1000'></textarea>

        </div>
        
        <!-- PRODUCT IMAGE -->
        <div class="col-12 col-md-6 mb-4">
            
            <label data-i18n='manofacturer:modelo'>Modelo</label>
            <input id="modelProductAcc" type="text" class="form-control validate mb-3" placeholder="Model" data-placeholder='modelo'/>

            <label data-i18n='manofacturer:imagenOptional'>Imagen (opcional)</label>
            <div class="custom-file mt-3 mb-3">
                <label for="file-inputAcc" class="drop-container" id="dropcontainerImageAcc">
                    <span class="drop-title" data-i18n='manofacturer:seleccionarOdrop'>Seleccionar o arrastrar y soltar una imagen</span>
                    <img class="drop-image" src="https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png" alt="pdf">
                    <img id="thumbnailAcc"/>
                </label>
                <input type="file" id="file-inputAcc">
            </div>

        </div>
    </div>
    
    <!-- PRODUCT DATA -->

    <div class="col-12">
        <div class="stock-title" data-i18n='manofacturer:medidasPrecios'>Medidas y precios</div>
    </div>

    <div class="row mb-3">
        <!-- GROSS -->
        <div class="col-sm-6 col-xsm-12">
            <h6 class="tm-block-title mb-0" data-i18n='manofacturer:producto'>Producto <i class="fas fa-microscope"></i></h6>
            <label data-i18n='manofacturer:netWeight'>Peso neto (kg)</label>
            <input
                id="weProductAcc"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-2"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n='manofacturer:anchuraAlt'>Anchura / altura / longitud netas (cm)</label>
            <div class='triplette mb-2'>
                <input
                    id="wiProductAcc"
                    type="number"
                    placeholder="0.00"
                    min="0"
                />
                <input
                    id="heProductAcc"
                    type="number"
                    placeholder="0.00"
                    min="0"
                />
                <input
                    id="leProductAcc"
                    type="number"
                    placeholder="0.00"
                    min="0"
                    />
                </div>

                <br>

                <label data-i18n='manofacturer:precioUnitario'>Precio unitario <i class="far fa-money-bill-1 h5"></i></label>
                <input
                id="priceProductAcc"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="form-control mb-1 validate"
                    min="0"
                />

                <label data-i18n='manofacturer:moneda'>Moneda <i class="far fa-money-bill-1 h5"></i></label>
                <select id="currencyAcc">
                    <option class="text-dark" value="" data-i18n='manofacturer:seleccionar'>-- seleccionar --</option>
                    <option class="text-dark" value="USD">USD</option>
                    <option class="text-dark" value="EUR">EUR</option>
                </select>
            </div>
        <!-- PACKAGED -->
        <div class=" col-sm-6 col-xsm-12 mb-4">
            <h6 class="tm-block-title mb-0" data-i18n='manofacturer:empaquetado'>Empaquetado <i class="fas fa-box"></i></h6>
            <label data-i18n='manofacturer:grossW'>Peso bruto (kg)</label>
            <input
                id="weProductPaAcc"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-2"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n='manofacturer:anchuraAltBru'>Anchura / altura / longitud brutas (cm)</label>
            <div class='triplette mb-2'>
                <input
                    id="wiProductPaAcc"
                    type="number"
                    placeholder="0.00"
                    min="0"
                />
                <input
                    id="heProductPaAcc"
                    type="number"
                    placeholder="0.00"
                    min="0"
                />
                <input
                    id="leProductPaAcc"
                    type="number"
                    placeholder="0.00"
                    min="0"
                />
            </div>

            <br>

            <label data-i18n='manofacturer:tipoPaquete'>Tipo de paquete</label>
            <select id="packageTypeAcc">
                <option class="text-dark" value="" data-i18n='manofacturer:seleccionar'>-- seleccionar --</option>
                <option class="text-dark" value="carton" data-i18n='manofacturer:cajaCarton'>Caja de cartón</option>
                <option class="text-dark" value="wooden" data-i18n='manofacturer:cajaMadera'>Caja de madera</option>
            </select>
        </div>

    </div>
</form>

<div class="col-12 d-flex">
    <button type="button" id="btnUpladAccesory" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none' data-i18n='manofacturer:agregar'>Añadir</button>
    <button type="button" id="btnResetAccesory" class="btn btn-primary btn-block text-uppercase ms-3" style='color: white; background-color: #de3a46 !important; border: none' data-i18n='manofacturer:restablecer'>Restablecer</button>
</div>
