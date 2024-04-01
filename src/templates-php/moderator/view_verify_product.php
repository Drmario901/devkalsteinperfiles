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

<br>
<br>
<br>
<br>

<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border-radius: 12px;
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
                        <input class='d-inline' type='checkbox' id='catalog'><br><br>
                    ";
                }
                else{
                    $divpdfcat = "
                        <p><b class='d-inline'>Catalog</b>:
                        none</p>
                        <div hidden>
                            <input class='d-inline' type='checkbox' id='catalog' checked hidden>
                        </div><br><br>
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
                        </div>
                        <input class='d-inline' type='checkbox' id='accessories' checked hidden>
                    ";
                }
            }
        
            echo "
            <input type='hidden' id='p-id' value='$p_id'>
            <div class='card'>
                <div class='card-header row'>
                    <div class='col-md-4 text-sm-start text-md-center'>
                        <h4>
                            $name
                            <input class='d-inline' type='checkbox' id='name'>
                        </h4>
                        <p>
                            <b>Model</b>: $model
                            <input class='d-inline' type='checkbox' id='model'>
                        </p>
                        <a TARGET='_blank' href='$image'>
                            <img style='margin: auto; border: 1px solid #999' width=200 src='$image'>
                        </a>
                        
                        <!-- Enlaces o promociones -->
                        <label for=''>links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-i'><br>

                        <label for=''>image quality</label>
                        <input class='d-inline' type='checkbox' id='quality-i'><br>

                        <label for=''>professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-i'><br><br>
                        
                        <p class='mb-0'>
                            <b>Category</b>: $category <input class='d-inline' type='checkbox' id='category'>
                        </p>
                        <p>
                            <b>Manufacturer</b>: $brand <input class='d-inline' type='checkbox' id='brand'>
                        </p>
                    </div>
                    <div class='col-md-8'>
                        <h5>Description</h5>
                        <p style='text-align: justify'>$description</p>
                        <table class='table table-responsive'>$table</table>
                        <br>
                        
                        <label for=''>links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-d'><br>
                        
                        <label for=''>professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-d'><br><br>

                        $div_acc
                    </div>

                    
                </div>
                <div class='card-body row'>
                    <div class='col-md-6 mb-2'>
                        <h5>Measures <i class='fas fa-microscope'></i></h5>
        
                        <ul class='list-unstyled text-start' style='min-width: 125px'>
                            <li><b>weigth</b>: $we kg</li>
                            <li><b>width</b>: $wi cm</li> 
                            <li><b>height</b>: $he cm</li> 
                            <li><b>length</b>: $le cm</li>
                        </ul>
                        <input class='d-inline' type='checkbox' id='measures'>
                    </div>
                    <div class='col-md-6'>
                        <h5>Measures Packaged <i class='fas fa-box'></i></h5>
        
                        <ul class='list-unstyled text-start' style='min-width: 125px'>
                            <li><b>weigth</b>: $wePa kg</li> 
                            <li><b>width</b>: $wiPa cm</li> 
                            <li><b>height</b>: $hePa cm</li> 
                            <li><b>length</b>: $lePa cm</li>
                        </ul>
                        <input class='d-inline' type='checkbox' id='measures-p'>
                    </div>
                    <hr class='mt-3'>
                    <h5>Files</h5>
                    <p>
                        $divpdfcat
                        $divpdf
                    </p>
                    <hr class='mt-3'>
                    <div class='row'>
                        <h5>Pricing</h5>
                        <div class='col-sm-6'>
                            <div class='btn btn-success btn-block text-white flex-column' style='align-items: start !important'>
                                
                                <h2 class='text-white mb-0 pb-0'>$price $currency</h2>
                                <p>Price per unit</p>

                            </div>

                            <label for='' style='margin-top: 12px;'>Descuento Gilson</label>
                            <input class='d-inline' type='number' id='discountGilson'>
                            <button class='btn btn-primary' style='color: white;' id='btnDiscountGilson'>Apply discount</button>

                            <div class='btn btn-success btn-block text-white flex-column' style='align-items: start !important; margin-top: 12px;'>
                                
                                <h2 class='text-white mb-0 pb-0'>$priceGilson $currency</h2>
                                <p>Price Gilson</p>

                            </div>

                        </div>
                        <div class='col-sm-6'>
                            <p><b>Last update <i class='fas fa-clock'></i></b>: $date</p>
                        </div>
                    </div>
                    <hr class='mt-3'>
                    <h5>wholesale discounts <input class='d-inline' type='checkbox' id='wholesale'></h5>

                    $discounts
        
                </div>

                <textarea class='mx-auto mb-2' style='width: 300px; height: 150px' placeholder='Specify' id='message'></textarea>
                <div class='mx-auto' id='strikeContainer'>
                    <label>Strike</label>
                    <input class='d-inline' type='checkbox' id='strike'>
                </div>

                <div id='btnValidate' class='mx-auto'>
                    <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                        <h4 class='text-white pb-0'>Denegate</h4>
                    </button>
                </div>
                <div class='card mt-3'>
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

            echo "</div></div>";
        ?>
    </article>
</main>