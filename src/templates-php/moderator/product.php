<header class="header" data-header>

    <?php

        include 'navbar.php';
    
    ?>
    <script>
        let page = "product";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<main>   
    <article class="container article">

        <div class="row">
        <h4 class='mt-2'>Productos pendientes por verificar</h4>

            <!-- PRODUCTOS -->

            <?php

                require __DIR__.'/../../../php/conexion.php';

                function time_elapsed_string($datetime) {
                    date_default_timezone_set('ETC');
                
                    $now = new DateTime('now', new DateTimeZone('UTC'));
                    $ago = new DateTime($datetime, new DateTimeZone('UTC'));
                    $ago->setTimezone(new DateTimeZone('UTC'));
                
                    $diff = $now->diff($ago);
                
                    if ($diff->y > 0) {
                        return 'Hace ' . $diff->y . ' año' . ($diff->y > 1 ? 's' : '');
                    }
                
                    if ($diff->m > 0) {
                        return 'Hace ' . $diff->m . ' mes' . ($diff->m > 1 ? 'es' : '');
                    }
                
                    if ($diff->d > 0) {
                        return 'Hace ' . $diff->d . ' día' . ($diff->d > 1 ? 's' : '');
                    }
                
                    if ($diff->h > 0) {
                        return 'Hace ' . $diff->h . ' hora' . ($diff->h > 1 ? 's' : '');
                    }
                
                    if ($diff->i > 0) {
                        return 'Hace ' . $diff->i . ' minuto' . ($diff->i > 1 ? 's' : '');
                    }
                
                    if ($diff->s > 0) {
                        return 'Hace ' . $diff->s . ' segundo' . ($diff->s > 1 ? 's' : '');
                    }
                
                    return 'Hace unos momentos';
                }
                
                
                $query = "SELECT * FROM wp_k_products WHERE product_validate_status = 'pending' AND product_group = '0' ORDER BY product_create_at ASC";
                $result = $conexion->query($query);

                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){

                        $name = $row["product_name_es"];
                        $model = $row["product_model"];
                        $brand = $row["product_brand"];
                        $image = $row["product_image"];
                        $maker = $row["product_maker"];

                        $elapsed = time_elapsed_string($row["product_create_at"]);

                        $id = $row["product_aid"];

                        $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'product' AND action_id = '$id'";
                        $resultAction = $conexion->query($queryAction);

                        if ($resultAction->num_rows > 0){
                            $mod = $resultAction->fetch_array()[1];

                            $verifying_by = "
                            <div class='fw-bold card' style='border: solid 1px #27aa3f; border-radius: 5px; background-color: #86e397; padding: 10px 20px;'>
                            <p class='m-0 p-0'><i class='fa-regular fa-circle-check'></i> Verifying by: $mod</p>
                            </div>
                            ";
                        }
                        else {
                            $verifying_by = "";
                        }

                        echo "
                        <div class='col-lg-6'>
                            <div class='card row m-2'>
                                <div class='col-12'>
                                    <div class='d-flex justify-content-between'>
                                        <h6>Product Verification:</h6>
                                    </div>
                                </div>
                                <div class='col-12 my-2'>
                                    <div class='d-flex justify-content-between align-items-center'>
                                        <img class='mx-1' src='$image' width=150>
                                        <div>
                                        <b>Solicitado por:</b>
                                        <div>$maker</div>
                                        <b>Producto solicitado:</b>
                                        <div> $name | $brand | $model</div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class='col-12'>
                                    <a href='https://dev.kalstein.plus/plataforma/moderator/view-product?pid=$id'>
                                        <button type='button' id='btnUpdate' class='btn btn-info btn-block p-2 px-4'>Check</button>
                                    </a>
                                </div>
                                <div class='mt-2'>
                                $verifying_by
                                <div class='col-12 mt-2'>
                                    <i class='fas fa-clock'></i>
                                    $elapsed
                                </div>
                                </div>
                            </div>
                        </div>
                        ";
                    }
                }else{
                    echo 'No pending tasks';
                }
            ?>
        </div>
    </article>
</main>