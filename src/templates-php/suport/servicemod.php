<div class="container">
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        include 'navdar.php';
    
    ?>
    <script>
        let page = "services";
    
        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>
    
    <article class="container article">
    
        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcomeThree';
            $banner_text = translateTextBanner($banner) .' '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>
    
        <nav class="nav nav-borders">
            <a class="nav-link ms-0" href="https://dev.kalstein.plus/plataforma/index.php/support/services/" data-i18n="support:servicios" >Servicios</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/add" data-i18n="support:addServices" >Añadir Servicio</a>
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/index.php/support/services/edit" data-i18n="support:modifyService" >Modificar Servicio</a>
        </nav>
        
        <br>
        <hr class="mt-0 mb-4">
        <br>
        
        <div class="container tm-mt-big tm-mb-big">
            <div class="row">
                <div class="col-12 mx-auto">
        
                <!-- <input type="text" id='actualizar_id' vaue=''> -->
        
                    <label for="Level">id del servicio</label>
                    <select id="dataEdit" class="custom-select tm-select-accounts rounded mb-3" name="category" style="border-color: #999">
                        <option selected value='0' data-i18n="support:selectOption" >Elige una opción</option>
        
                        <?php
                            require __DIR__.'/../../../php/conexion.php';
        
                            session_start();
                            $acc_id = $_SESSION['emailAccount'];
        
                            $consulta = "SELECT * FROM `wp_servicios` where SE_correo='$acc_id'";		
                                
                            $resultado = $conexion->query($consulta);	
                                
                            if ($resultado->num_rows > 0) {
                                while ($value = $resultado->fetch_assoc()) {
                                    $id=$value['SE_id'];
                                    $name=$value['SE_servicio'];
                                    
                                    $_SESSION['se_agente_soporte'] = $value["SE_agente_soporte"];
                                    $_SESSION['se_company'] = $value["SE_company"];
                                    $_SESSION['se_correo'] = $value["SE_correo"];

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
        
                    <?php
                        $add = false;
                        require 'services_form.php';
                        ?>
                        <input type="hidden" id='actualizar_id' value='' name="actualizar_id">
        
                    <div class="col-12">
                        <center><button type="button" id="actualizar_btn" name="send" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none' data-i18n="support:updateService" >ACTUALIZAR SERVICIO</button></center>
                    </div>
                        </form>
                </div>
            </div>
        </div>
    </article>

    
    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
        ?>
</div>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
    
    <!-- <script>
        jQuery(document).ready(function($){
            $('#actualizar_btn').on('click', function(){
                /* let hiden = $('#actualizar_id').val(); */
                let form = $("#addservices_form").serialize();
                /* alert(form); */
                $.ajax({
                    url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/service-update.php",
                    method: "POST",
                    data: form
                })
                .done(function(response){

                    if(response.status === 'Correcto'){
                        /* alert("actualizacion realizada con exito") */
                        iziToast.success({
                            title: 'Éxito',
                            message: 'Operación actualizada con éxito.',
                            position: 'bottomLeft'
                    });
                        $("#addservices_form")[0].reset()
                        window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/support/services/'
                    }

                    /* alert(response.id + ", " + response.service + ", " + response.company) */
                    /* let data = JSON.parse(response); */
                    /* iziToast.success({
                        title: 'Éxito',
                        message: 'Operación actualizada con éxito.',
                        position: 'bottomLeft'
                    }); */
    
                    /* $("#addservices_form")[0].reset() */
                    /* alert(data.id);
                    console.log(data.id); */
    
                });
            }); 
        });
    </script> -->
