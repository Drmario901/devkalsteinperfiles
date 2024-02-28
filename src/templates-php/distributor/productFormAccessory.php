<div></div>
<form action=""></form>
<form id="accessories_editor" method="post" class="tm-edit-product-form">
    <input type="hidden" id="imageURL" value="">
    <div class="row mb-3">

        <input type="hidden" id="accessoyId" data-item="new" data-id="">

        <!-- BASIC DATA -->
        <div class="col-12 col-md-6">

            <label data-i18n="distribuidor:labelNombre">Nombre</label>
            <input id="nameProductAcc" type="text" class="form-control validate mb-3" placeholder="Nombre"/>
            
            <label class="mb-3" data-i18n="distribuidor:labelDescriptionOptional">Descripción (opcional)</label>
            <textarea id="descriptionProductAcc" class="form-control validate tm-small" style="height: 200px" placeholder="Describe tu productos en menos de 1000 caracteres
            "></textarea>

        </div>
        
        <!-- PRODUCT IMAGE -->
        <div class="col-12 col-md-6 mb-4">
            
            <label data-i18n="distribuidor:labelModelo">Modelo</label>
            <input id="modelProductAcc" type="text" class="form-control validate mb-3" placeholder="Modelo"/>

            <label data-i18n="distribuidor:labelImagenOpcional">Imagen (opcional)</label>
            <div class="custom-file mt-3 mb-3">
                <label for="file-inputAcc" class="drop-container" id="dropcontainerImageAcc">
                    <span class="drop-title" data-i18n="distribuidor:dragAndDrop" >Selecciona o arrastra y suelta una imagen</span>
                    <img class="drop-image" src="https://platform.kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png" alt="pdf">
                    <img id="thumbnailAcc"/>
                </label>
                <input type="file" id="file-inputAcc">
            </div>

        </div>
    </div>
    
    <!-- PRODUCT DATA -->

    <div class="col-12">
        <div class="stock-title" data-i18n="distribuidor:medidasPrecios">Medidas y precios</div>
    </div>

    <div class="row mb-3">
        <!-- GROSS -->
        <div class="col-sm-6 col-xsm-12">
            <h6 class="tm-block-title mb-0" data-i18n="distribuidor:labelSubtitleProduct">Producto <i class="fas fa-microscope"></i></h6>
            <label data-i18n="distribuidor:labelPesoNeto">Peso neto (kg)</label>
            <input
                id="weProductAcc"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-2"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n="distribuidor:anchoLargo">Ancho / alto / largo neto (cm)</label>
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

                <label data-i18n="distribuidor:labelPrecioUnit">Precio unitario <i class="far fa-money-bill-1 h5"></i></label>
                <input
                id="priceProductAcc"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="form-control mb-1 validate"
                    min="0"
                />

                <label data-i18n="distribuidor:subtitleMoneda">Moneda <i class="far fa-money-bill-1 h5"></i></label>
                <select id="currencyAcc">
                    <option class="text-dark" value="" data-i18n="distribuidor:optionSelecciona">-- Selecciona --</option>
                    <option class="text-dark" value="USD">USD</option>
                    <option class="text-dark" value="EUR">EUR</option>
                </select>
            </div>
        <!-- PACKAGED -->
        <div class=" col-sm-6 col-xsm-12 mb-4">
            <h6 class="tm-block-title mb-0" data-i18n="distribuidor:subtitleEmpaque">Empaque <i class="fas fa-box"></i></h6>
            <label data-i18n="distribuidor:labelPesoBruto">Peso bruto (kg)</label>
            <input
                id="weProductPaAcc"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-2"
                data-large-mode="true"
                min="0"
            />

            <label data-i18n="distribuidor:anchoLargo">Ancho / alto / largo bruto (cm)</label>
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

            <label data-i18n="distribuidor:labelTipoEmpaque">Tipo de empaque</label>
            <select id="packageTypeAcc">
                <option class="text-dark" value="" data-i18n="distribuidor:optionSelecciona">-- Selecciona --</option>
                <option class="text-dark" value="carton" data-i18n="distribuidor:CajaCarton">Caja de carton</option>
                <option class="text-dark" value="wooden" data-i18n="distribuidor:CajaMadera">Caja de madera</option>
            </select>
        </div>

    </div>
</form>

<center><div class="col-12 d-flex">
    <center><button type="button" id="btnUpladAccesory" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none' data-i18n="distribuidor:adjuntar">Adjuntar</button></center>
    <center><button type="button" id="btnResetAccesory" class="btn btn-primary btn-block text-uppercase ms-3" style='color: white; background-color: #de3a46 !important; border: none' data-i18n="distribuidor:reiniciar">Reiniciar</button></center>
</div></center>
