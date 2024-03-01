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
            <a class="nav-link active ms-0" href="localhost/wp-local//list_report" target="__blank" data-i18n="support:listReports" >List reports</a>
            <a class="nav-link" href="localhost/wp-local/modreport" target="__blank" data-i18n="support:gestionReportes" >Gestion de reportes</a>
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
                                <h2 class="tm-block-title d-inline-block" style="color: white !important;" data-i18n="support:addReport" >Add Report</h2>
                            </div>
                        </div>
                        <div class="row tm-edit-product-row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <form method="post" class="tm-edit-product-form">
                                    <div class="form-group mb-3">
                                        <label for="name" data-i18n="support:labelName" >Name</label>
                                        <input style="color: white !important;"
                                            id="Rnombre"
                                            name="name"
                                            type="text"
                                            class="form-control validate"
                                            required
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
                                            id="Rusuario"
                                            name="email"
                                            type="text"
                                            class="form-control validate"
                                            required
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row tm-edit-product-row">
                            <div class="col-xl-6 col-lg-6 col-12">
                                <form method="post" class="tm-edit-product-form">
                                    <div class="form-group mb-5">
                                        <label for="company" data-i18n="support:labelCompany" >company</label>
                                        <input style="color: white !important;"
                                            id="Rcompany"
                                            name="email"
                                            type="text"
                                            class="form-control validate"
                                            required
                                        />
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="Type_US" data-i18n="support:typeUser" >type user</label>
                            <select id="RTipo_US" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category">
                                <option selected value='0' style="color: #000 !important;" data-i18n="support:selectOption" >Choose an option</option>
                                <option value="Cliente" style="color: #000 !important;" data-i18n="support:client" >Cliente</option>
                                <option value="Distribuidor" style="color: #000 !important;" data-i18n="support:distribuidor">Distribuidor</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="category" data-i18n="support:category">Category</label>
                            <select id="Rcategory" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category">
                                <option selected value='0' data-i18n="support:selectOption">Choose an option</option>
                            </select>
                        </div>
                        <div class="form-group mb-3">
                            <label for="product" data-i18n="support:product">Product</label>
                            <select id="Rproduct" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category">
                                <option selected value='0' data-i18n="support:selectOption">Choose an option</option>
                            </select>
        
                            <div class="row tm-edit-product-row">
                                <div class="form-group mb-3">
                                    <label for="description" data-i18n="support:description">Description</label>
                                    <textarea 
                                        id="RDescription"                   
                                        class="form-control validate"
                                        style="color: #fff !important;"
                                        rows="5"
                                        required>
                                    </textarea>
                                    <?php
                                    
                                        require __DIR__.'/../../../php/conexion.php';
        
                            
                                        if (isset($_GET["edit"])) {
                                            $edit = $_GET["edit"];
                                        
        
                                        $consulta = "SELECT * FROM `wp_servicios` where SE_id='$edit'";		
                                            
                                        $resultado = $conexion->query($consulta);	
                                            
                                        if ($resultado->num_rows > 0) {
                                            while ($value = $resultado->fetch_assoc()) {
                                                $id=$value['SE_id'];
                                                $name=$value['SE_agente_soporte'];
                                                $correo=$value['SE_correo'];
                                                $company=$value['SE_company'];
                                                    
                                                    if ($edit == $id){
        
                                                        echo "  
                                        <input style='color: white !important;'
                                            id='Rid'
                                            name='name'
                                            type='hidden'
                                            value='$id'
                                            class='form-control validate'
                                            required
                                        />
                                        <div class='row tm-edit-product-row'>
                                            <div class='col-xl-6 col-lg-6 col-12'>
                                                <form method='post' class='tm-edit-product-form'>
                                                    <div class='form-group mb-3'>
                                                        <label for='agente' data-i18n='support:supportCompany' >sopport company</label>
                                                        <input style='color: white !important;'
                                                            id='Rcompanysoporte'
                                                            name='name'
                                                            type='text'
                                                            value='$company'
                                                            class='form-control validate'
                                                            required
                                                        />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class='row tm-edit-product-row'>
                                            <div class='col-xl-6 col-lg-6 col-12'>
                                                <form method='post' class='tm-edit-product-form'>
                                                    <div class='form-group mb-3'>
                                                        <label for='agente' data-i18n='support:agente'>agente</label>
                                                        <input style='color: white !important;'
                                                            id='Ragente'
                                                            name='name'
                                                            type='text'
                                                            value='$name'
                                                            class='form-control validate'
                                                            required
                                                        />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class='row tm-edit-product-row'>
                                            <div class='col-xl-6 col-lg-6 col-12'>
                                                <form method='post' class='tm-edit-product-form'>
                                                    <div class='form-group mb-3'>
                                                        <label for='agente' data-i18n='support:correoAgente'>correo del agente</label>
                                                        <input style='color: white !important;'
                                                            id='Rcorreo'
                                                            name='name'
                                                            type='text'
                                                            value='$correo'
                                                            class='form-control validate'
                                                            required
                                                        />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>";
        
                                                    }
                                                    else{  echo "  
                                        <div class='row tm-edit-product-row'>
                                            <div class='col-xl-6 col-lg-6 col-12'>
                                                <form method='post' class='tm-edit-product-form'>
                                                    <div class='form-group mb-3'>
                                                        <label for='agente' data-i18n='support:agente'>agente</label>
                                                        <input style='color: white !important;'
                                                            id='Ragente'
                                                            name='name'
                                                            type='text'
                                                            value=''
                                                            class='form-control validate'
                                                            required
                                                        />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div class='row tm-edit-product-row'>
                                            <div class='col-xl-6 col-lg-6 col-12'>
                                                <form method='post' class='tm-edit-product-form'>
                                                    <div class='form-group mb-3'>
                                                        <label for='agente' data-i18n='support:correoAgente'>correo del agente</label>
                                                        <input style='color: white !important;'
                                                            id='Rcorreo'
                                                            name='name'
                                                            type='text'
                                                            value=''
                                                            class='form-control validate'
                                                            required
                                                        />
                                                    </div>
                                                </form>
                                            </div>
                                        </div>";
                                                    }
                                                }
                                            }
                                        }
                                    ?> 
                                </div>
                                <div class="form-group mb-3">
                                    <label for="Level">Level</label>
                                    <select id="Rnivel" class="custom-select tm-select-accounts" style="color: #fff !important;" name="category">
                                        <option selected value='0' data-i18n="support:selectOption">Choose an option</option>
                                        <option value="Bajo" style="color: #000 !important;" data-i18n="support:low" >Low</option>
                                        <option value="Medio" style="color: #000 !important;" data-i18n="support:mid">Mid</option>
                                        <option value="Alto" style="color: #000 !important;" data-i18n="support:high">High</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <center><button type="button" id="registrar" name="send" class="btn btn-primary btn-block text-uppercase" data-i18n="support:addTicket">Add Ticket</button></center>
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