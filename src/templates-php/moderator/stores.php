<header class="header" data-header>

    <?php

        include 'navbar.php';
    
    ?>
    <style>
    .btnVerTienda:hover {
        color: white !important;
    }
    </style>
    <script>
    let page = "stores";

    document.querySelector('#link-' + page).classList.add("active");
    document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<main>
    <article class="container article">

        <div class="row">
            <h4 class='mt-2'><span style='font-weight: 600; display: inline;'>Tiendas</span> a moderar</h4>
            <div class='col-lg-6'>
                <div class='card row m-2'>
                    <div class='col-12'>
                        <div class='row mb-2'>
                            <div class='col-4'>
                                <img class='mx-1'
                                    src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/EBay_logo.svg/2560px-EBay_logo.svg.png'
                                    width=150>
                            </div>
                            <div class='col-8'>
                                <h6 style='font-weight: 600;'>Jorgito Store</h6>
                                <p class='mb-2'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean elit
                                    risus, placerat et condimentum eget, sodales sed elit. Sed nec...</p>
                            </div>
                        </div>
                    </div>
                    <div class='col-12' style="display: flex; justify-content: flex-start">
                        <a href='https://dev.kalstein.plus/plataforma/index.php/moderator/view-blog?accid=$aid'>
                            <button type='button' id='btnUpdate' class='btn btn-info btn-block p-2 px-4'>Add a
                                post</button>
                        </a>
                        <a href='https://dev.kalstein.plus/plataforma/tienda-de-prueba/'>
                            <button type='button' id='btnUpdate'
                                class='btnVerTienda btn btn-outline-secondary btn-block p-2 px-4 ms-3'
                                style='color: #333 !important'>View
                                Store</button>
                        </a>
                    </div>

                </div>
                <div class='mt-2'>
                    <!-- <div class='fw-bold card'
                            style='border: solid 1px #27aa3f; border-radius: 5px; background-color: #86e397; padding: 10px 20px;'>
                            <p class='m-0 p-0' style=><i class='fa-regular fa-circle-check'></i> Verifying by: mod@mail.com</p>
                        </div> -->
                </div>
            </div>
        </div>
        <!-- <?php

                // require __DIR__.'/../../../php/conexion.php';

                function time_elapsed_string($datetime, $full = false) {
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
                
                    if (!$full) $string = array_slice($string, 0, 1);
                    return $string ? implode(', ', $string) . ' ago' : 'just now';
                }
                
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        
                        $elapsed = time_elapsed_string($row['account_created_at']);

                        $aid = $row['account_aid'];

                        $rol = $dict[$row['account_rol_aid']];
                        $correo = $row['account_correo'];

                        $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'account' AND action_id = '$aid'";
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
                        
                        ";
                    }
                }else{
                    echo 'No pending tasks';
                }
            ?> -->
        </div>
    </article>
</main>