<div class="container">
    <?php

        include 'navdar.php';

    ?>

    <script>
        let page = "reports";

        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>

    <article class="container article">

        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcomeTwo';
            $banner_text = translateTextBanner($banner) .' '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/reports/" target="__blank" data-i18n="support:listReports" >List Reports
            </a>
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/index.php/support/reports/management" target="__blank" data-i18n="support:reportManagement" >Report Management</a>
        </nav>
        
        <br>
        <hr class="mt-0 mb-4">
        <br>
        
        <div class="container tm-mt-big tm-mb-big">
            <div class="row">
                <div class="col-xl-9 col-lg-10 col-12 col-sm-12 mx-auto">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <div class="row">
                            <div class="col-12">
                                <h2 class="tm-block-title d-inline-block" style="color: white !important;"></h2>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Level">id de reporte</label>
                                <select id="dataEdit" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category">
                                    <option selected value='0' data-i18n="support:selectOption" >Choose an option</option>
                                    <?php
                                        session_start();
                                        $acc_id = $_SESSION['emailAccount'];
                                        
                                        require __DIR__.'/../../../php/conexion.php';
        
                                        $consulta = "SELECT * FROM `wp_reportes` where R_usuario_agente='$acc_id'";		
                                        $resultado = $conexion->query($consulta);	
                                            
                                        if ($resultado->num_rows > 0) {
                                            while ($value = $resultado->fetch_assoc()) {
                                                $id=$value['R_id'];
                                                $name=$value['R_nombre'];
                                                if (isset($_GET["edit"])) {
                                                    $edit = $_GET["edit"];
                                                    
                                                    if ($edit == $id){
                                                        echo "<option selected style='color: #000 !important;' value='$id'>(ID: $id) $name</option>";
                                                    }
                                                    else{ echo "<option style='color: #000 !important;' value='$id'>(ID: $id) $name</option>";
                                                        
                                                    }
                                                }
                                                else {
                                                    echo "<option style='color: #000 !important;' value='$id'>(ID: $id) $name</option>";
                                                }   
                                            }
                                        }
                                    ?>
                                </select>
                            </div>
                        <div class="row tm-edit-product-row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <form method="post" class="tm-edit-product-form">
                                    <div class="form-group mb-3">
                                        <label for="name" data-i18n="support:labelName" >Name</label>
                                        <input style="color: white !important;"
                                            id="Anombre"
                                            name="name"
                                            type="text"
                                            class="form-control validate"
                                            disabled
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row tm-edit-product-row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <form method="post" class="tm-edit-product-form">
                                    <div class="form-group mb-5">
                                        <label for="Email" data-i18n="support:labelEmail" >Email</label>
                                        <input style="color: white !important;"
                                            id="Ausuario"
                                            name="Rusuario"
                                            type="text"
                                            class="form-control validate"
                                            disabled
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
        
                        <div class="row tm-edit-product-row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <form method="post" class="tm-edit-product-form">
                                    <div class="form-group mb-5">
                                        <label for="Email" data-i18n="support:labelCompany" >company</label>
                                        <input style="color: white !important;"
                                            id="Acompany"
                                            name="Rusuario"
                                            type="text"
                                            class="form-control validate"
                                            disabled
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Type_US" data-i18n="support:typeUser" >type user</label>
                            <input style="color: white !important;"
                                id="ATipo_US"
                                name="Rusuario"
                                type="text"
                                class="form-control validate"
                                disabled
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="category" data-i18n="support:category" >Category</label>
                            <input style="color: white !important;"
                                id="Acategory"
                                name="Rusuario"
                                type="text"
                                class="form-control validate"
                                disabled
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="product" data-i18n="support:product" >Product</label>
                            <input style="color: white !important;"
                                id="Aproducto"
                                name="Rusuario"
                                type="text"
                                class="form-control validate"
                                disabled
                            />
                            <div class="row tm-edit-product-row">
                                <div class="form-group mb-3">
                                    <label for="description" data-i18n="support:description" >Description</label>
                                    <textarea 
                                        id="Adescription"                   
                                        class="form-control validate"
                                        rows="5"
                                        disabled>
                                    </textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="Level" data-i18n="support:level">Level</label>
                                    <input style="color: white !important;"
                                        id="Anivel"
                                        name="Anivel"
                                        type="text"
                                        class="form-control validate"
                                        disabled
                                    />
                                </div>
        
                                <div class="row tm-edit-product-row">
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <form method="post" class="tm-edit-product-form">
                                            <div class="form-group mb-3">
                                                <label for="name" data-i18n="support:agenteSoporte" >agente de soporte</label>
                                                <input style="color: white !important;"
                                                    id="agente"
                                                    name="name"
                                                    type="text"
                                                    class="form-control validate"
                                                    disabled
                                                />
                                            </div>
                                        </form>
                                    </div>
                                </div>
        
                                <div class="row tm-edit-product-row">
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <form method="post" class="tm-edit-product-form">
                                            <div class="form-group mb-3">
                                                <label for="name" data-i18n="support:companySupport" >company support</label>
                                                <input style="color: white !important;"
                                                    id="Acompanysupport"
                                                    name="name"
                                                    type="text"
                                                    class="form-control validate"
                                                    disabled
                                                />
                                            </div>
                                        </form>
                                    </div>
                                </div>
        
                                <div class="row tm-edit-product-row">
                                    <div class="col-xl-6 col-lg-6 col-12">
                                        <form method="post" class="tm-edit-product-form">
                                            <div class="form-group mb-5">
                                                <label for="Email" data-i18n="support:emailSoporte" >
                                                    Email Support
                                                </label>
                                                <input style="color: white !important;"
                                                    id="Acorreo"
                                                    name="Rusuario"
                                                    type="text"
                                                    class="form-control validate"
                                                    disabled
                                                />
                                            </div>
                                        </form>
                                    </div>
                                </div>
        
                                <input style='color: white !important;'
                                    id='RAid'
                                    name='name'
                                    type='hidden'
                                    value='$id'
                                    class='form-control validate'
                                    required
                                />
        
                                <div class="row tm-edit-product-row">
                                    <div class="form-group mb-3">
                                        <label for="observacion" data-i18n="support:labelObservacion">Observacion</label>
                                        <textarea 
                                            id="observacion"                   
                                            class="form-control validate"
                                            required>
                                        </textarea>
                                    </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="Generador_Cotizacion">
                                    <label class="form-check-label" for="flexCheckChecked" data-i18n="support:labelGenerarCotizacion" >Generar cotizacion</label>
                                </div>
                                <div id="datos_cotizacion" style='display: none;'>  
                                    <div class='form-group mb-3'>
                                        <label for='Type_US'>tipo de moneda</label>
                                        <select id='Amoneda' class='custom-select tm-select-accounts' style='color: #fff !important;' name='moneda'>
                                            <option selected value='0' style='color: #000 !important;' data-i18n="support:selectOption" >Choose an option</option>
                                            <option value='USD' style='color: #000 !important;'>USD</option>
                                            <option value='EUR' style='color: #000 !important;'>EUR</option>
                                        </select>
                                    </div>
                                    <div class='row tm-edit-product-row'>
                                        <div class='col-xl-6 col-lg-6 col-12'>
                                            <form method='post' class='tm-edit-product-form'>
                                                <div class='form-group mb-3'>
                                                    <label for='agente' data-i18n="support:labelPrice" >price</label>
                                                    <input style='color: white !important;'
                                                        id='Aprice'
                                                        name='name'
                                                        type='number'
                                                        class='form-control validate'
                                                        required
                                                        step='0.01'
                                                    />
                                                </div>
                                            </form>
                                        </div>
                                    </div>
        
                                </div>
                                <div class="col-12">
                                    <center><button type="button" id="actualizar" name="send" class="btn btn-primary btn-block text-uppercase" data-i18n="support:answerTicket" >Responder ticket</button></center>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>
