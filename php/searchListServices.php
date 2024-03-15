<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require __DIR__ . '../db/conexion.php';
    include_once './translations.php';
    try {
        //code...
        $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
        $consulta = $_POST['consulta'];
        $q = $conexion->real_escape_string($_POST['consulta']);

        $perPage = 8;
        $page = isset($_POST['nextPage']) ? intval($_POST['nextPage']) : 1;

        $offset = ($page - 1) * $perPage;
        $limit = $perPage;

        if (isset($_POST['consulta'])) {
            $sql = "SELECT * FROM wp_servicios WHERE SE_servicio LIKE '%$q%' OR SE_description LIKE '%$q%' LIMIT $offset, $limit";
        } else {
            $sql = "SELECT * FROM wp_servicios LIMIT $offset, $limit";
        }
        
        $resultado = $conexion->query($sql);
        $i = 0;

        $html = '<div class="row">';

        $agente = $translations[$lang]['client:agente'];
        $categoria = $translations[$lang]['client:categoria'];
        $requireService = $translations[$lang]['requireService'];

        if ($resultado->num_rows > 0){
            $i = 0;
            while ($value = $resultado->fetch_assoc()) {
                $i = $i + 1;
                $id = $value['SE_id'];
                $service = $value['SE_servicio'];
                $usuario = $value['SE_agente_soporte'];
                $correo=$value['SE_correo'];
                $precio = $value['SE_precio'];
                $category = $value['SE_category'];
                $description = $value['SE_description'];
                $description = strlen($description) >= 150 ? substr($description, 0, 147).'...' : $description;
                $image = $value['account_url_image_perfil'];
                $sql2 = "SELECT * FROM `wp_servicios` WHERE SE_correo LIKE ?";
                $stmt = $conexion->prepare($sql2);
                $stmt->bind_param("s", $correo);
                $stmt->execute();
                $resultado2 = $stmt->get_result();
                $row = mysqli_fetch_array($resultado2);            
                $name = $row[3];
                $lastname = $row[4];
                $imgPerfil = $row[12];            
                $firstLyricsName = strtoupper($name[0]);   
                $firstLyricsLastname = strtoupper($lastname[0]);
        
                $firstLyricsName = strtoupper($usuario[0]);
                if ($image == ''){
                    $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/Iconos/'.$firstLyricsName.'/'.$firstLyricsName.'.png';
                }else{
                    $urlImagePerfil = 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/upload/'.$image;
                }
                $html.= "                                    
                    <div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-3' id='servicesPagination'>                         
                        <div class='card mx-2 p-3 h-100'>
                            <img src='$urlImagePerfil' class='card-img-top' alt='...'>
                            <div class='d-flex flex-column justify-content-between h-100'>
                                <div class='mt-2 mb-2 mx-2' style='min-height: 8rem;'>
                                    <h5 class='card-title'>$service</h5>
                                    <p class='card-text'>$description</p>
                                </div>
                                <ul class='list-group list-group-flush'>
                                    <li class='list-group-item'><span>$agente</span>: $usuario</li>
                                    <li class='list-group-item'><span>$categoria</span>: $category</li>
                                </ul>
                                <button type='button' class='btnQuoClone mx-auto my-3 text-center' id='add_report' value='$id' data-bs-toggle='modal' data-bs-target='#exampleModal' style='width: 160px'>$requireService</button>
                            </div>
                        </div>
                    </div>
                    
                    ";
            }
            
            $html.="</div>";
            $msjNoData = "";
        }else{
            $msjNoData = "
                <div class='contentNoDataQuote'>
                <center><span class='material-symbols-rounded  icon'>sentiment_dissatisfied</span></center>
                    <center><p style='color: #000;'>No data found</p></center>
                </div>
            ";
        }
        
        $html.= "
            </div>
            $msjNoData
        ";

        $prevPage = max(1, $page - 1);
        $nextPage = $page + 1;

        $html .= "
        <div class='pagination'>
            <div id='currentPageIndicatorServices'>Page: $page</div>
            <form id='form-previous-services' action='' method='post' style='margin-right: 8px'>
                <input id='previous' type='hidden' name='b' value='$prevPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' data-i17n='client:previo' value=''>
            </form>
            <form id='form-next-services' action='' method='post'>
                <input id='next' class='next' type='hidden' name='b' value='$nextPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' data-i17n='client:next' value=''>
            </form>
        </div>
        <input id='hiddenPage' type='hidden' value='$page'>";
        
        echo $html;
    } catch (mysqli_sql_exception $e) {
        //throw $th;
        echo "Error: " .$e->getMessage();
    }
    
    $conexion->close();