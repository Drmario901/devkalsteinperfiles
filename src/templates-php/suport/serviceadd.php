<div class="container">
    <?php
        session_start();
        require __DIR__ .'/../../../php/conexion.php';
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
            $banner_text = "Ajouter un service";
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://dev.kalstein.plus/index.php/support/services/" data-i18n="support:servicios">Services</a>
            <a class="nav-link active ms-0" href="https://dev.kalstein.plus/index.php/support/services/add"data-i18n="support:addServices">Ajouter un service</a>
            <a class="nav-link" href="https://dev.kalstein.plus/index.php/support/services/edit" data-i18n="support:modifyService">Modifier le service</a>
            <hr class="mt-0 mb-4">
        </nav>
        
        <br>
        <br>
        
        <?php        
            $acc_id = $_SESSION['emailAccount'];
        
            $query = "SELECT * FROM wp_account WHERE account_correo = '$acc_id'";
            $row = $conexion->query($query)->fetch_assoc();

            $query2 = "SELECT * FROM wp_company WHERE company_account_correo = '$acc_id'";
            $row2 = $conexion->query($query2)->fetch_assoc();
        
            $acc_name = $row['account_nombre'];
            $acc_lname = $row['account_apellido'];
            $acc_correo = $row['account_correo'];
            $acc_company= $row2['company_nombre'];
            $acc_pais= $row2['company_pais'];
            $acc_ciudad= $row2['company_ciudad'];
            $acc_direccion= $row2['company_direccion'];
            $acc_name = $acc_name .' '. $acc_lname;
        
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
                            <button type="button" id="Register_service" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none' data-i18n="support:servicios" data-i18n="support:addService">AJOUTER UN SERVICE</button>
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