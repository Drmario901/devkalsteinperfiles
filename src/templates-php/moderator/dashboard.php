<header class="header" data-header>

    <?php

        include 'navbar.php';
    
    ?>
    <script>
        let page = "accounts";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
        </script>
</header>
<main>   
    <article class="container article">
        
        <div class="row">
            <?php

                require __DIR__.'/../../../php/conexion.php';

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

                $query = "SELECT account_aid, account_rol_aid, account_status, account_correo, account_created_at FROM wp_account WHERE account_status = 'filled'
                AND (account_rol_aid = '2'
                OR account_rol_aid = '3'
                OR account_rol_aid = '4'
                OR account_rol_aid = '5')
                ORDER BY account_created_at ASC";
                $result = $conexion->query($query);

                
                $dict = array(
                    '2' => 'Distributor',
                    '3' => 'Manufacturer',
                    '4' => 'Support Agent'
                );
                
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
                            <b class='mt-2'>Verifying by: $mod</b>
                            ";
                        }
                        else {
                            $verifying_by = "";
                        }
    
                        echo "
                        <div class='col-lg-6'>
                            <div class='card row m-2'>
                                <div class='col-12'>
                                    <div>
                                        <h6><b>$rol</b> Account Verification:</h6>
                                        <div class='mb-2'>$correo</div>
                                    </div>
                                </div>
                                <div class='col-12'>
                                    <a href='https://dev.kalstein.plus/plataforma/index.php/moderator/view-account?accid=$aid'>
                                        <button type='button' id='btnUpdate' class='btn btn-info btn-block p-2 px-4'>Check</button>
                                    </a>
                                </div>
                                $verifying_by
                                <div class='col-12'>
                                    <i class='fas fa-clock'></i>
                                    $elapsed
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