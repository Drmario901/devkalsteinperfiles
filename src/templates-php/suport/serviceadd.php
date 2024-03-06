<div class="container">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    // Evitar iniciar sesión más de una vez
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    include 'navdar.php'; // Asegúrate de que el nombre del archivo esté correctamente escrito
    ?>

    <script>
        let page = "services";
        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>

    <article class="container article">
        <?php
        $banner_img = 'Header-servicio-tecnico-IMG.jpg';

        require __DIR__ . '/../../../php/translateTextBanner.php';
        $banner = 'banner_text_welcomeThree';
        $banner_text = translateTextBanner($banner) . ' ' . $acc_name . ' ' . $acc_lname;
        include __DIR__ . '/../manufacturer/banner.php';

        // Verifica si la conexión a la base de datos fue exitosa antes de proceder
        if ($conexion->connect_error) {
            die("Connection failed: " . $conexion->connect_error);
        }

        $acc_id = $_SESSION['emailAccount'];

        // Preparar la consulta para evitar inyecciones SQL
        $stmt = $conexion->prepare("SELECT wp_account.account_nombre, wp_account.account_apellido, wp_account.account_url_image_perfil, wp_account.account_correo, wp_company.company_nombre, wp_company.company_pais, wp_company.company_ciudad, wp_company.company_direccion FROM wp_account INNER JOIN wp_company ON wp_account.account_correo = wp_company.company_account_correo WHERE account_correo = ?");
        
        if ($stmt === false) {
            die("Error preparing statement: " . $conexion->error);
        }

        $stmt->bind_param("s", $acc_id); // "s" indica el tipo de dato (string)
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $acc_name = $row['account_nombre'];
            $acc_lname = $row['account_apellido'];
            $acc_correo = $row['account_correo'];
            $acc_company = $row['company_nombre'];
            $acc_pais = $row['company_pais'];
            $acc_ciudad = $row['company_ciudad'];
            $acc_direccion = $row['company_direccion'];
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
                    // Asegúrate de que no estás iniciando sesión nuevamente aquí
                    $add = true;
                    require 'services_form.php';
                    ?>

                    <div class="col-12">
                        <center>
                            <button type="button" id="Register_service" class="btn btn-primary btn-block text-uppercase" style='color: white; background-color: #de3a46 !important; border: none' data-i18n="support:addService">AÑADIR SERVICIO</button>
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
    jQuery(document).ready(function($) {
        $('#Register_service').on('click', function() {
            let form = $("#addservices_form").serialize();
            $.ajax({
                url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/suport/service_insert.php",
                method: "POST",
                data: form
            })
            .done(function(response) {
                iziToast.success({
                    title: 'Éxito',
                    message: 'Operación realizada con éxito.',
                    position: 'bottomLeft'
                });
                $("#addservices_form")[0].reset()
            });
        });
    });
</script>