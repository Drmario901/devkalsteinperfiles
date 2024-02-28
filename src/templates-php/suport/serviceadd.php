<div class="container">
    <?php

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
            $banner_text = "Bienido(a), $acc_name $acc_lname";
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="https://plataforma.kalstein.net/index.php/support/services/" data-i18n="support:servicios" >Servicios</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/index.php/support/services/add" data-i18n="support:addServices" >Añadir Servicio</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/index.php/support/services/edit" data-i18n="support:modifyService" >Modificar Servicio</a>
            <hr class="mt-0 mb-4">
        </nav>
        
        <br>
        <br>
        
        <?php
            session_start();
        
            $acc_id = $_SESSION['emailAccount'];
        
            $query = "SELECT wp_account.account_nombre, wp_account.account_apellido, wp_account.account_url_image_perfil,wp_account.account_correo, wp_company.company_nombre,wp_company.company_pais,wp_company.company_ciudad, wp_company.company_direccion FROM wp_account INNER JOIN wp_company ON wp_account.account_correo = wp_company.company_account_correo WHERE account_correo = '$acc_id'";
            $row = $conexion->query($query)->fetch_assoc();
        
            $acc_name = $row['account_nombre'];
            $acc_lname = $row['account_apellido'];
            $acc_correo = $row['account_correo'];
            $acc_company= $row['company_nombre'];
            $acc_pais= $row['company_pais'];
            $acc_ciudad= $row['company_ciudad'];
            $acc_direccion= $row['company_direccion'];
        
        ?>
        <div class="container tm-mt-big tm-mb-big">
            <div class="row">
                <div class="col-12 mx-auto">
                    <?php
                        session_start();
                        $add = true;
                        require 'services_form.php';
                    ?>
        
                    <div class="col-12">
                        <center>
                            <button type="button" id="Register_service" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none' data-i18n="support:addService" >AÑADIR SERVICIO</button>
                        </center>
                    </div>
                    <form>
                </div>
            </div>
        </div>             
    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">

<script>
    jQuery(document).ready(function($){
        $('#Register_service').on('click', function(){
            let form = $("#addservices_form").serialize();
            /* alert(form); */
            $.ajax({
                url: "https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/php/suport/service_insert.php",
                method: "POST",
                data: form
            })
            .done(function(response){
                /* let data = JSON.parse(response); */
                iziToast.success({
                    title: 'Éxito',
                    message: 'Operación realizada con éxito.',
                    position: 'bottomLeft'
                });

                $("#addservices_form")[0].reset()
                /* alert(data.id);
                console.log(data.id); */

            });
        }); 
    });
</script>