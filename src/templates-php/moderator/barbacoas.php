<header class="header" data-header>

    <?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require __DIR__ . '/../../../php/conexion.php';

    include 'navbar.php';

    ?>
    <script>
        let page = "guides";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<main>
    <article class="container article">

        <div class="row">
            <h4 class='mt-2'><span style='font-weight: 600; display: inline;'>Guias</span> pendientes por verificar</h4>

            <?php
            // Verificar la conexión a la base de datos
            if (!$conexion) {
                die("Conexión fallida: " . mysqli_connect_error());
            }

            // Consulta SQL
            $query = "
                SELECT g.*, gd.*, p.*
                FROM wp_guides AS g
                INNER JOIN wp_guides_details AS gd ON g.guide_id = gd.guide_id
                INNER JOIN wp_k_products AS p ON gd.guide_product_id = p.product_aid
                WHERE gd.guide_detail_number = 1;
            ";

            $result = $conexion->query($query);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Procesa los resultados
                    $guideId = $row['guide_id'];
                    $guideDescription = $row['guide_description'];
                    $guideMaker = $row['product_maker'];
                    $productName = $row['product_name_es'];
                    $guideImg = $row['guide_img_url'];
                    

                    echo "
                            <div class='col-lg-6'>
                                <div class='card row m-2'>
                                    <div class='col-12'>
                                        <div class='row mb-2'>
                                            <div class='col-4'>
                                                <img class='mx-1' src='$guideImg' width=150>
                                            </div>
                                            <div class='col-8'>
                                                <h6 style='font-weight: 600;'>$productName</h6>
                                                <p class='mb-2'>$guideDescription</p>
                                            </div>
                                        </div>
                                    </div>
                                    <p class='mt-2 mb-1' style='font-size: 1.15em'><i class='fa-solid fa-user'></i> <b>Published by:</b> user@mail.com</p>
                                    <div class='col-12'>
                                        <a href='https://dev.kalstein.plus/plataforma/index.php/moderator/view-guide?accid=$guideId'>
                                            <button type='button' id='btnUpdate' class='btn btn-info btn-block p-2 px-4'>Check</button>
                                        </a>
                                    </div>
                                    <div class='mt-2'>
                                    $verifying_by
                                        <div class='col-12 mt-2'>
                                            <i class='fas fa-clock'></i>
                                            Hace 6 minutos
                                        </div>
                                    </div>
                                </div>
                            </div>
                        ";
                }
            } else {
                echo "No se encontraron registros.";
            }
            function time_elapsed_string($datetime, $full = false)
            {
                $now = new DateTime;
                $ago = new DateTime($datetime);
                $diff = $now->diff($ago);

                $diff->w = floor($diff->d / 7);
                $diff->d -= $diff->w * 7;

                $string = array(
                    'y' => 'year',
                    'm' => 'month',
                    'w' => 'week',
                    'd' => 'day',
                    'h' => 'hour',
                    'i' => 'minute',
                    's' => 'second',
                );
                foreach ($string as $k => &$v) {
                    if ($diff->$k) {
                        $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
                    } else {
                        unset($string[$k]);
                    }
                }

                if (!$full)
                    $string = array_slice($string, 0, 1);
                return $string ? implode(', ', $string) . ' ago' : 'just now';
            }

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    $elapsed = time_elapsed_string($row['account_created_at']);

                    $aid = $row['account_aid'];

                    $rol = $dict[$row['account_rol_aid']];
                    $correo = $row['account_correo'];

                    $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'account' AND action_id = '$aid'";
                    $resultAction = $conexion->query($queryAction);

                    if ($resultAction->num_rows > 0) {
                        $mod = $resultAction->fetch_array()[1];

                        $verifying_by = "
                            <div class='fw-bold card' style='border: solid 1px #27aa3f; border-radius: 5px; background-color: #86e397; padding: 10px 20px;'>
                            <p class='m-0 p-0'><i class='fa-regular fa-circle-check'></i> Verifying by: $mod</p>
                            </div>
                            ";
                    } else {
                        $verifying_by = "";
                    }

                    echo "
                        
                        ";
                }
            } else {
                echo 'No pending tasks';
            }
            ?>
        </div>
    </article>
</main>