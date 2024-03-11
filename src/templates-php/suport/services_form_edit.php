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

<div class="row tm-edit-product-form">
    <div class="col-12"><div class="stock-title">Type de service</div></div>

    <div class="row mb-4 mt-3">
        <div class="col-12 col-md-6 col-lg-4">
            <label>Titre du service</label>
            <input
                id="SEnombre"
                name="name"
                type="text"
                class="form-control validate"
                placeholder="ex : Installation d'un autoclave"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label>Entreprise</label>
            <input
                id="SEcompany"
                type="text"
                class="form-control validate"
                value="<?php echo $acc_company ?>"
                placeholder="nom de l'entreprise"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label>Agent</label>
            <input
                id="SEagente"
                type="text"
                class="form-control validate"
                value="<?php echo $acc_name; echo $acc_lname ?>"
                placeholder="nom et prénom"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <!-- HACER QUE SE REGISTREEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEEE -->
            <label for="Email">Téléphone</label>
            <input
                id="SEtelefono"
                type="number"
                class="form-control validate"
                value="<?php echo $acc_correo; ?>"
                placeholder="numéro de téléphone"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label for="Email">Courriel</label>
            <input
                id="SEcorreo"
                type="text"
                class="form-control validate"
                value="<?php echo $acc_correo; ?>"
                placeholder="courriel de contact"
            />
        </div>
    </div>

    <div class="col-12"><div class="stock-title">Adresse</div></div>

    <div class="row mb-4 mt-3">
        <div class="col-12 col-md-6 col-lg-4">
            <label for="Level">Pays</label>
            <select id="SEpais" class="tm-select-accounts" name="category">
                <option selected value='0'>Choisir une option</option>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label>Adresse</label>
            <input
                id="SEdireccion"
                type="text"
                class="form-control validate"
                placeholder="Adresse"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label>État</label>
            <input
                id="SEestadoLugar"
                type="text"
                class="form-control validate"
                placeholder="État"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label for="name">Ville</label>
            <input
                id="SEciudad"
                type="text"
                class="form-control validate"
                placeholder="Ville"
            />
        </div>
        <div class="col-12 col-md-6 col-lg-4">
            <label for="name">Province</label>
            <input
                id="SEprovincia"
                type="text"
                class="form-control validate"
                placeholder="province"
            />
        </div>
    </div>

    <div class="col-12"><div class="stock-title">A propos du produit</div></div>

    <div class="row mb-4 mt-3">
        <div class="col-12 col-md-6 col-lg-4">
            <label for="Level">Catégorie de produits</label>
            <select id="SEcategory" class="custom-select tm-select-accounts">
                <option selected value='0'>Choisir une option</option>
            </select>
        </div>
        <div class="col-12 col-md-6 col-lg-4">
        <label for="Level">Status</label>
            <select id="SEestado" class="custom-select tm-select-accounts">
                <option selected value='0'>Choisir une option</option>
                <option value="activé">activé</option>
                <option value="désactivé">désactivé</option>
            </select>
        </div>
        <div class="col-12 col-lg-4">
            <label for="name">Temps estimé</label>
            <input
                id="SEtiempoEstimado"
                type="text"
                class="form-control validate"
                placeholder="ex : 3 jours"
            />
        </div>
        <div class="col-12">
            <label for="description">Description</label>
            <textarea
                id="SEdescription"                   
                class="form-control validate"
                rows="5"
                placeholder="décrire ce que vous proposez"
            ></textarea>
        </div>
    </div>
</div>