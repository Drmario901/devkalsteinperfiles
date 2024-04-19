<header class="header" data-header>

    <?php

        include 'navbar.php';
    
    ?>
    <script>
        let page = "home";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>

<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border-radius: 12px;
        margin: 0;
    }
    h5, p {
    display: flex;
    align-items: center;
    gap: 10px;
    text-align: start;
    }
    h5 {
        font-weight: 700;
    }
    .card-header {
        background-color: white;
    }
</style>

<main>   
    <article class="container article">
        <?php

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

            if(isset($_GET['pid'])){
                $p_id = $_GET['pid'];
            }
            else {
                $p_id = '';
            }

            $queryAction = "SELECT type, action_mod FROM wp_mod_moves WHERE type = 'product' AND action_id = '$p_id'";
            $resultAction = $conexion->query($queryAction);

            if ($resultAction->num_rows > 0){
                if ($acc_id != $resultAction->fetch_assoc()['action_mod']){
                    echo "
                    <script>
                        alert('another user is in this task');
                        window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/moderator/products';
                    </script>
                    ";
                }
            }
            else{
                $queryModMove = "INSERT INTO wp_mod_moves (type, action_mod, action_id) VALUES ('product', '$acc_id', '$p_id')";
                $resultModMove = $conexion->query($queryModMove);
            }


            $consulta = "SELECT * FROM wp_k_products WHERE product_aid = '$p_id'";
            $resultado = $conexion->query($consulta);

            
            $row = mysqli_fetch_array($resultado);
            $count = mysqli_num_rows($resultado);

            if ($count > 0){
                $id = $row["product_aid"];
                $name = $row["product_name_es"];
                $model = $row["product_model"];
                $brand = $row["product_brand"];
                $description = $row["product_description_es"];
                $category = $row["product_category_es"];
                $pStock = $row["product_stock_units"];
                $pStatus = $row["product_stock_status"];
                $we = $row["product_peso_neto"];
                $wi = $row["product_ancho"];
                $he = $row["product_alto"];
                $le = $row["product_largo"];
                $wePa = $row["product_peso_bruto"];
                $wiPa = $row["product_ancho_paquete"];
                $hePa = $row["product_alto_paquete"];
                $lePa = $row["product_largo_paquete"];
                $pPType = $row["wp_product_package_type"];
                $currency = $row["wp_product_currency"];
                $price = $currency == 'USD' ? $row["product_priceUSD"] : $row["product_priceEUR"];
                $priceGilson = $row["product_price_gibson"] === null ? 0 : $row["product_price_gibson"];
                $discountGilson = $row["descuento_gibson"] === null ? 0: $row["descuento_gibson"];
                $discount_1 = $row["wp_product_discount_1"];
                $discount_1_amount = $row["wp_product_discount_1_amount"];
                $discount_2 = $row["wp_product_discount_2"];
                $discount_2_amount = $row["wp_product_discount_2_amount"];
                $image = $row["product_image"];
                $date = $row["product_create_at"];

                $table = $row["product_technical_description_es"];

                $maker = $row['product_maker'];

                
                if(($pdf = $row["product_manual"]) != ''){
                    $querypdf = "SELECT M_nombre_product FROM wp_manuales WHERE M_pdf = '$pdf'";
                    $namepdf = $conexion->query($querypdf)->fetch_array()[0];

                    $divpdf = "
                        <b class='d-inline'>Manual</b>:
                        <a target='_blank' style='display: inline; text-decoration: underline' href='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/manuals/upload/$pdf'>
                        <i class='fa-solid fa-file-pdf'></i>$namepdf.pdf</a>
                        <input class='d-inline' type='checkbox' id='manual'>
                    ";
                }
                else{
                    $divpdf = "
                        <p><b class='d-inline'>Manual</b>:
                        none</p>
                        <div hidden>
                            <input class='d-inline' type='checkbox' id='manual' checked hidden>
                        </div>
                    ";
                }

                if(($catalog = $row["product_catalog"]) != ''){
                    $pdf = $row["product_catalog"];
                    $namepdf = $row["product_catalog_name"];

                    $divpdfcat = "
                        <b class='d-inline'>Catalog</b>:
                        <a target='_blank' style='display: inline; text-decoration: underline' href='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload/$pdf'>
                        <i class='fa-solid fa-file-pdf'></i>$namepdf.pdf</a>
                        <input class='d-inline' type='checkbox' id='catalog'>
                    ";
                }
                else{
                    $divpdfcat = "
                        <p><b class='d-inline'>Catalog</b>:
                        none</p>
                        <div hidden>
                            <input class='d-inline' type='checkbox' id='catalog' checked hidden>
                        </div>
                    ";
                }
                
                $discounts = '';
                
                if($discount_1 != 0){
                    $discounts .= "<p>$discount_1% discount when reaching $discount_1_amount units</p>";

                    if ($discount_2 != 0){
                        $discounts .= "<p>$discount_2% discount when reaching $discount_2_amount units</p>";
                    }
                }
                else {
                    $discounts = "no applied";
                }

                $a = "asdasdasdasihkjkk";


                $accessories = $conexion->query("SELECT * FROM wp_k_products WHERE (product_model LIKE '%$model%' OR product_parent = '$p_id') AND product_group = '1'");

                // ACCESORIOS

                if ($accessories->num_rows > 0) {
                    $div_acc = "
                        <div class='accordion accordion-flush mt-3 border' id='accordionFlushExample'>
                            <div class='accordion-item'>
                                <input type='hidden' id='ih-accesories-add' value='0'>
                                <h6 class='accordion-header'>
                                    <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapseOne' aria-expanded='false' aria-controls='flush-collapseOne'>
                                        Accesorios adicionales
                                    </button>
                                </h6>
                                <div id='flush-collapseOne' class='accordion-collapse' data-bs-parent='#accordionFlushExample'>
                                    <div class='accordion-body'>
                                        <div class='row'>
                    ";

                    while ($value = $accessories->fetch_assoc()) {
                        
                        $idAccesorie = $value['product_aid'];

                        $modelAccesorie = $value['product_model'];
                        $nameAccesorie = $value['product_name_es'];
                        $priceAccesorie = $value['product_priceUSD'];

                        $descrAccesorie = $value['product_description'];
                        $imageAccesorie = $value['product_image'];
                
                        $div_acc .= "
                                            <div class='col-sm-12 mb-3'>
                                                <div class='form-check'>
                                                    <label class='form-check-label' for='chk-$modelAccesorie' style='margin-left: 0.5em; font-size: 0.8em; white-space: nowrap;'>
                                                        $nameAccesorie USD$ $priceAccesorie
                                                    </label>
                                                    <i class='fa-solid fa-circle-exclamation btn-view-accessory' style='color: #aaa' data-id='$idAccesorie'></i>
                                                </div>
                                            </div>
                        ";
                    }

                    $div_acc .= "                
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <label for='' class='mt-2'>Accessories</label>
                        <input class='d-inline' type='checkbox' id='accessories'>
                        ";
                }
                else {
                    $div_acc = "
                        <div class='mt-3'>
                            Accessories not found
                            <input class='d-inline' type='checkbox' id='accessories' checked hidden>
                        </div>
                        
                    ";
                }
            }
        
            echo "
            <input type='hidden' id='p-id' value='$p_id'>

                <div class='card mb-3'>
                <div class='row'>
                    <div class='col-md-4 text-sm-start text-md-center'>
                        <h5>
                            Product Name
                            <input class='d-inline' type='checkbox' id='name'>
                        </h5>
                        <h6 class='text-start'>$name</h6>
                        <p class='mt-2'>
                            <b>Model:</b> $model
                            <input class='d-inline' type='checkbox' id='model'>
                        </p>
                        <a TARGET='_blank' href='$image'>
                            <img class='my-3' style='margin: auto; border: 1px solid #999' width=200 src='$image'>
                        </a>
                        
                        <!-- Enlaces o promociones -->
                        <p><label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-i'></p>

                        <p><label for=''>Image quality</label>
                        <input class='d-inline' type='checkbox' id='quality-i'></p>

                        <p><label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-i'></p>
                        
                        <p class='mb-0 d-flex align-items-start pt-3' style='border-top: solid 1px #c9c9c9'>
                            <b>Category: </b>$category
                            <input class='d-inline' type='checkbox' id='category'>
                        </p>
        
                        <p>
                            <b>Manufacturer:</b> $brand <input class='d-inline' type='checkbox' id='brand'>
                        </p>
                    </div>
                    <div class='col-md-8'>
                        <h5>Description</h5>
                        <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                        <p style='text-align: justify;'>$description</p>
                        <table class='table table-responsive'>$table</table>
                        </div>
                        <p>
                        <label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-d'><br>
                        </p>
                        <p>
                        <label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-d'>
                        </p>

                        $div_acc
                    </div>

                    </div> 
                </div>
                <div class='card mb-3'>
                <div class='row'>
                    <div class='col-md-6 mb-2'>
                        <h5><i class='fas fa-microscope'></i>Measures <input class='d-inline' type='checkbox' id='measures'></h5>
        
                        <ul class='list-unstyled text-start' style='min-width: 125px'>
                            <li><b>Weigth</b>: $we kg</li>
                            <li><b>Width</b>: $wi cm</li> 
                            <li><b>Height</b>: $he cm</li> 
                            <li><b>Length</b>: $le cm</li>
                        </ul>
                    </div>
                    <div class='col-md-6'>
                        <h5><i class='fas fa-box'></i>Measures Packaged <input class='d-inline' type='checkbox' id='measures-p'></h5>
        
                        <ul class='list-unstyled text-start' style='min-width: 125px'>
                            <li><b>Weigth</b>: $wePa kg</li> 
                            <li><b>Width</b>: $wiPa cm</li> 
                            <li><b>Height</b>: $hePa cm</li> 
                            <li><b>Length</b>: $lePa cm</li>
                        </ul>
                    </div>
                    </div>
                    <hr class='mt-3'>
                    <h5>Files</h5>
                    <p>
                        $divpdfcat
                        $divpdf
                    </p>
                    </div>
                    <div class='card'>
                        <h5>Pricing</h5>
                        <div class='row'>
                        <div class='col-sm-6'>
                            <div class='btn btn-success btn-block text-white flex-column my-2' style='align-items: start !important'>
                                
                                <h2 class='text-white mb-0 pb-0'>$price $currency</h2>
                                <p>Price per unit</p>

                            </div>

                        </div>
                        <div class='col-sm-6'>
                            <p><b>Last update <i class='fas fa-clock'></i></b>: $date</p>
                        </div>
                        </div>
                    
                    <h5>Wholesale discounts <input class='d-inline' type='checkbox' id='wholesale'></h5>

                    $discounts
        
                </div></div>
                <textarea class='mx-auto my-2' style='width: 100%; height: 150px;' placeholder='Especifica porqué se está denegando la información' id='message'></textarea>
                <p class='d-flex justify-content-start' id='strikeContainer'>
                    <label>Strike</label>
                    <input class='d-inline' type='checkbox' id='strike'>
                </p>

                <div id='btnValidate' class='mx-auto'>
                    <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                        <h4 class='text-white pb-0'>Denegate</h4>
                    </button>
                </div>
                <div class='card my-3'>
                    <h5>Past warnings</h5>";

                        $query = "SELECT moderator_id, description, strike, create_at FROM wp_atention_calls WHERE to_user = '$maker' AND type = 'product'";

                        $result = $conexion->query($query);

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                $moderator = $row['moderator_id'];
                                $description = $row['description'];
                                $strike = $row['strike'];

                                $strikestyle = $strike == '1'? 'bg-danger text-white' : '';

                                $elapsed = time_elapsed_string($row['create_at']);

                                echo "
                                <div class='card $strikestyle p-1 mb-2'>
                                    <div class='card-header p-1'>
                                        From $moderator
                                    </div>
                                    <div class='card-body p-1'>
                                        $description
                                    </div>
                                    <div class='card-footer p-1'>
                                        $elapsed
                                    </div>
                                </div>
                                ";
                            }
                        }
                        else{
                            echo "clean";
                        }

            echo "</div>";
        ?>
    </article>
</main>