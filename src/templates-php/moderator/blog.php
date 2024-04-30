<header class="header" data-header>

    <?php

        include 'navbar.php';
    
    ?>
    <script>
    let page = "blog";

    document.querySelector('#link-' + page).classList.add("active");
    document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<main>
    <article class="container article">

        <div class="row">
            <div class='col-lg-6'>
                <div class='card row m-2'>
                    <div class='col-12'>
                        <div class='row'>
                            <div class='col-6'>
                                <img class='mx-1' src='https://pbs.twimg.com/media/F9QcGzgXEAAPqLo.jpg' width=150>
                            </div>
                            <div class='col-6'>
                                <h6>Titulo del Artículo</h6>
                                <p class='mb-2'>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean elit
                                    risus, placerat et condimentum eget, sodales sed elit. Sed nec.</p>
                            </div>
                        </div>
                    </div>
                    <p><i class='fa-solid fa-user'></i><b>Published by: user@mail.com</b></p>
                    <div class='col-12'>
                        <a href='https://dev.kalstein.plus/plataforma/index.php/moderator/view-blog?accid=$aid'>
                            <button type='button' id='btnUpdate' class='btn btn-info btn-block p-2 px-4'>Check</button>
                        </a>
                    </div>
                    <div class='mt-2'>
                        <div class='fw-bold card'
                            style='border: solid 1px #27aa3f; border-radius: 5px; background-color: #86e397; padding: 10px 20px;'>
                            <p class='m-0 p-0'><i class='fa-regular fa-circle-check'></i> Verifying by: mod@mail.com</p>
                        </div>
                        <div class='col-12 mt-2'>
                            <i class='fas fa-clock'></i>
                            Hace 6 minutos
                        </div>
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