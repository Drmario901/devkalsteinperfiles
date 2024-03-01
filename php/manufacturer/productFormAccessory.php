<div></div>
<form action=""></form>
<form id="accessories_editor" method="post" class="tm-edit-product-form">
    <input type="hidden" id="imageURL" value="">
    <div class="row mb-3">

        <input type="hidden" id="accessoyId" data-item="new" data-id="">

        <!-- BASIC DATA -->
        <div class="col-12 col-md-6">

            <label>Name</label>
            <input id="nameProductAcc" type="text" class="form-control validate mb-3" placeholder="Name"/>
            
            <label class="mb-3">Description (optional)</label>
            <textarea id="descriptionProductAcc" class="form-control validate tm-small" style="height: 200px" placeholder="Describe your product in less than 1000 characters
            "></textarea>

        </div>
        
        <!-- PRODUCT IMAGE -->
        <div class="col-12 col-md-6 mb-4">
            
            <label>Model</label>
            <input id="modelProductAcc" type="text" class="form-control validate mb-3" placeholder="Model"/>

            <label>Image (optional)</label>
            <div class="custom-file mt-3 mb-3">
                <label for="file-inputAcc" class="drop-container" id="dropcontainerImageAcc">
                    <span class="drop-title">Select or drag and drop an image</span>
                    <img class="drop-image" src="https://platform.kalstein.us/wp-content/plugins/kalsteinPerfiles/src/images/IMAGE-document.png" alt="pdf">
                    <img id="thumbnailAcc"/>
                </label>
                <input type="file" id="file-inputAcc">
            </div>

        </div>
    </div>
    
    <!-- PRODUCT DATA -->

    <div class="col-12">
        <div class="stock-title">Measures and Pricing</div>
    </div>

    <div class="row mb-3">
        <!-- GROSS -->
        <div class="col-sm-6 col-xsm-12">
            <h6 class="tm-block-title mb-0">Product <i class="fas fa-microscope"></i></h6>
            <label>Net weight (kg)</label>
            <input
                id="weProductAcc"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-2"
                data-large-mode="true"
                min="0"
            />

            <label>Net width / height / length (cm)</label>
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

                <label>Unit price <i class="far fa-money-bill-1 h5"></i></label>
                <input
                id="priceProductAcc"
                    type="number"
                    step="0.01"
                    placeholder="0.00"
                    class="form-control mb-1 validate"
                    min="0"
                />

                <label>Currency <i class="far fa-money-bill-1 h5"></i></label>
                <select id="currencyAcc">
                    <option class="text-dark" value="">-- select --</option>
                    <option class="text-dark" value="USD">USD</option>
                    <option class="text-dark" value="EUR">EUR</option>
                </select>
            </div>
        <!-- PACKAGED -->
        <div class=" col-sm-6 col-xsm-12 mb-4">
            <h6 class="tm-block-title mb-0">Packaged <i class="fas fa-box"></i></h6>
            <label>Gross weight (kg)</label>
            <input
                id="weProductPaAcc"
                type="number"
                step="0.01"
                placeholder="0.00"
                class="form-control validate mb-2"
                data-large-mode="true"
                min="0"
            />

            <label>Gross width / height / length (cm)</label>
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

            <label>Package Type</label>
            <select id="packageTypeAcc">
                <option class="text-dark" value="">-- select --</option>
                <option class="text-dark" value="carton">Carton box</option>
                <option class="text-dark" value="wooden">Wooden box</option>
            </select>
        </div>

    </div>
</form>

<div class="col-12 d-flex">
    <button type="button" id="btnUpladAccesory" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none'>Append</button>
    <button type="button" id="btnResetAccesory" class="btn btn-primary btn-block text-uppercase ms-3" style='color: white; background-color: #de3a46 !important; border: none'>Reset</button>
</div>
