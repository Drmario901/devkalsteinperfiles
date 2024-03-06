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
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcomeThree';
            $banner_text = translateTextBanner($banner) .' '. $acc_name .' '. $acc_lname;
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="https://dev.kalstein.plus/plataforma/index.php/support/services/" data-i18n="support:servicios" >Servicios</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/add" data-i18n="support:addServices" >Añadir Servicio</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/support/services/edit" data-i18n="support:modifyService" >Modificar Servicio</a>
            <hr class="mt-0 mb-4">
        </nav>
        
        <br>
        <br>
        
        <?php
    session_start();

    if ($conexion->connect_error) {
        die("Connection failed: " . $conexion->connect_error);
    }

    $acc_id = $_SESSION['emailAccount'];
    
    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT wp_account.account_nombre, wp_account.account_apellido, wp_account.account_url_image_perfil,wp_account.account_correo, wp_company.company_nombre,wp_company.company_pais,wp_company.company_ciudad, wp_company.company_direccion FROM wp_account INNER JOIN wp_company ON wp_account.account_correo = wp_company.company_account_correo WHERE account_correo = ?");
    $stmt->bind_param("s", $acc_id); // "s" indica el tipo de dato (string)
    
    // Ejecutar la consulta
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Obtener los datos si la consulta fue exitosa
        $row = $result->fetch_assoc();

        $acc_name = $row['account_nombre'];
        $acc_lname = $row['account_apellido'];
        $acc_correo = $row['account_correo'];
        $acc_company= $row['company_nombre'];
        $acc_pais= $row['company_pais'];
        $acc_ciudad= $row['company_ciudad'];
        $acc_direccion= $row['company_direccion'];
    } else {
        echo "0 results";
    }

    $stmt->close();
    $conexion->close();
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
                url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/service_insert.php",
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