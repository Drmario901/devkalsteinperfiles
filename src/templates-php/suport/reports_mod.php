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
            $banner_text = "Welcome, $acc_name $acc_lname";
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://plataforma.kalstein.net/index.php/support/reports/" target="__blank">List Reports
            </a>
            <a class="nav-link active" href="https://plataforma.kalstein.net/index.php/support/reports/management" target="__blank">Report Management</a>
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
                                    <option selected value='0'>Choose an option</option>
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
                                        <label for="name">Name</label>
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
                                        <label for="Email">Email</label>
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
                                        <label for="Email">company</label>
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
                            <label for="Type_US">type user</label>
                            <input style="color: white !important;"
                                id="ATipo_US"
                                name="Rusuario"
                                type="text"
                                class="form-control validate"
                                disabled
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="category">Category</label>
                            <input style="color: white !important;"
                                id="Acategory"
                                name="Rusuario"
                                type="text"
                                class="form-control validate"
                                disabled
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="product">Product</label>
                            <input style="color: white !important;"
                                id="Aproducto"
                                name="Rusuario"
                                type="text"
                                class="form-control validate"
                                disabled
                            />
                            <div class="row tm-edit-product-row">
                                <div class="form-group mb-3">
                                    <label for="description">Description</label>
                                    <textarea 
                                        id="Adescription"                   
                                        class="form-control validate"
                                        rows="5"
                                        disabled>
                                    </textarea>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="Level">Level</label>
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
                                                <label for="name">agente de soporte</label>
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
                                                <label for="name">company support</label>
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
                                                <label for="Email">
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
                                        <label for="observacion">observacion</label>
                                        <textarea 
                                            id="observacion"                   
                                            class="form-control validate"
                                            required>
                                        </textarea>
                                    </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="Generador_Cotizacion">
                                    <label class="form-check-label" for="flexCheckChecked">generar cotizacion</label>
                                </div>
                                <div id="datos_cotizacion" style='display: none;'>  
                                    <div class='form-group mb-3'>
                                        <label for='Type_US'>tipo de moneda</label>
                                        <select id='Amoneda' class='custom-select tm-select-accounts' style='color: #fff !important;' name='moneda'>
                                            <option selected value='0' style='color: #000 !important;' >Choose an option</option>
                                            <option value='USD' style='color: #000 !important;'>USD</option>
                                            <option value='EUR' style='color: #000 !important;'>EUR</option>
                                        </select>
                                    </div>
                                    <div class='row tm-edit-product-row'>
                                        <div class='col-xl-6 col-lg-6 col-12'>
                                            <form method='post' class='tm-edit-product-form'>
                                                <div class='form-group mb-3'>
                                                    <label for='agente'>price</label>
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
                                    <center><button type="button" id="actualizar" name="send" class="btn btn-primary btn-block text-uppercase">Responder ticket</button></center>
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
