<header class="header" data-header>
    <?php
        include 'navbar.php';
    ?>
    <script>
        let page = "stock";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<br>
<br>
<nav class="nav nav-borders">
    <a class="nav-link active" href="https://testing.kalstein.digital/index.php/rentalsale/stock" data-i18n="rentalsale:aProductsStock">Products stock</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/stock/add" data-i18n="rentalsale:aAddRentalService"> Add rental service</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/stock/add/used" data-i18n="rentalsale:addUsedProduct">Add used product</a>
</nav>
<br>        
<div class="table-responsive">
    <table class='table custom-table'>
        <thead class='headTableForQuote'>
            <tr>
            <td class='fw-bold' style='background-color: #213280; color: white;'>ID</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:placeholderName">Name</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:elementType">Type</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:placeholderBrand">Brand</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:placeholderModel">Model</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:labelDescription">Description</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:spanImage">Image</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:labelCategory">Category</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:spanStock">Stock</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:elementMeasures">Measures</td>
            <td class='fw-bold' style='background-color: #213280; color: white; min-width: 76px;' data-i18n="rentalsale:elementPrice">Price ($)</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:elementDate">Date</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:elementStatus">Status</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i18n="rentalsale:elementActions">Actions</td>
            </tr>
        </thead>
        <tbody id="product-table-body" class='bodyTableForQuote'>
            <?php

                session_start();
            
                require __DIR__.'/../../../php/conexion.php';

                $acc_id = $_SESSION['emailAccount'];

                $perPage = 5;
                $page = isset($_GET['i']) ? $_GET['i'] : 1;

                $page = intval($page);

                $offset = ($page - 1) * $perPage;
                $limit = $perPage;
                
                for ($i = $page; $i > 0; $i--){
                    $query = "SELECT * FROM wp_k_products WHERE product_maker = '$acc_id' ORDER BY product_create_at DESC LIMIT $offset, $limit";
                    $resultado = $conexion->query($query);

                    if ($resultado->num_rows == 0) {
                        if($page == 1){
                            break;
                        }
                        $page--;

                        $offset = ($page - 1) * $perPage;
                        $limit = $perPage;
                    }
                    else{
                        
                        break;
                    }
                }

                if ($resultado->num_rows > 0) {
                    while ($value = $resultado->fetch_assoc()) {
                        $id = $value['product_aid'];
                        $name = $value['product_name_en'];
                        $type = $value['product_type'];
                        $brand = $value['product_brand'];
                        $model = $value['product_model'];
                        $description = $value['product_description'];
                        $category = $value['product_category'];
                        $weight = $value['product_peso_neto'];
                        $stock = $value['product_stock_units'];
                        $width = $value['product_ancho'];
                        $height = $value['product_alto'];
                        $length = $value['product_largo'];
                        $status = $value['product_stock_status'];
                        $priceUSD = $value['product_priceUSD'];
                        $priceEUR = $value['product_priceEUR'];
                        $currency = $value['wp_product_currency'];
                        $image = $value['product_image'];
                        $date = $value['product_create_at'];
                        $val_status = $value['product_validate_status'];

                        if ($currency == 'EUR') {
                            $price = $priceEUR;
                        }
                        else if ($currency == 'USD') {
                            $price = $priceUSD;
                        }

                        if (strlen($description) > 200) {
                            $description = substr($description, 0, 200) . '...';
                        }

                        if ($val_status == 'pending'){
                            $classes = 'background-color: #efefc0';
                            $st = '<i class="fa-regular fa-clock"></i><p>Pending</p>';
                        }
                        else if ($val_status == 'validated'){
                            $classes = '';
                            $st = '<i class="fa-regular fa-circle-check"></i><p>Validated</p>';
                        }
                        else if ($val_status == 'denied'){
                            $classes = 'background-color: #ee9';
                            $st = '<i class="fa-regular fa-x"></i><p>Solving</p>';
                        }

                        $date = date('Y/m/d', strtotime($date));
                
                        echo ("
                        <tr style='$classes' id='product-$id'>
                            <td>$id</td>
                            <td style='max-width: 120px;'><h6>$name</h6></td>
                            <td style='max-width: 120px;'><h6>$type</h6></td>
                            <td style='max-width: 120px;'><h6>$brand</h6></td>
                            <td style='max-width: 120px;'><h6>$model</h6></td>
                            <td style='max-width: 180px; text-align: justify'>$description</td>
                            <td>
                                <img src='$image' width=100>
                            </td>
                            <td>$category</td>
                            <td style='min-width: 89px'>$stock <br>($status)</td>
                            <td>
                                <ul class='list-unstyled text-start' style='min-width: 125px'>
                                   <li><b data-i18n='rentalsale:elementWidth'>width</b>: $width cm</li>
                                   <li><b data-i18n='rentalsale:elementHeight'>height</b>: $height cm</li>
                                   <li><b data-i18n='rentalsale:elementLength'>length</b>: $length cm</li>
                                   <br>
                                   <li><b data-i18n='rentalsale:elementWeigth'>weigth</b>: $weight kg</li>
                                </ul>
                            </td>
                            <td>$price $currency</td>
                            <td>$date</td>
                            <td>$st</td>
                            <td>
                                <button class='material-symbols-rounded'  id='btnDeleteProduct' value='$id' data-i18n='rentalsale:btnDelete'>
                                    delete
                                </button>
                                <br>
                                <button class='material-symbols-rounded'  id='btnEditProduct' value='$id' data-i18n='rentalsale:btnEdit'>
                                    edit
                                </button>

                                <br>
                                <a href='https://testing.kalstein.digital/index.php/manufacturer/stock/preview/?id=$id'><i class='fa-solid fa-eye btn-details' style='color: #000 !important; font-size: 16px;'></i></a>
                            </td>
                        </tr>
                        ");
                    }
                    echo "
                        </tbody>
                    </table>
                    ";
                } else {
                    echo ("
                            </tbody>
                        </table>
                        <div class='contentNoDataQuote'>
                            <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
                            <center><p style='color: #000;' data-i18n='rentalsale:noDataFound'>No data found</p></center>
                        </div>
                    ");
                }

                $prevPage = $page > 1? $page - 1 : 1;
                $nextPage = $page + 1;
                
                echo "
                <span> Page $page </span>
                <div class='pagination'>
                    <form action='' method='get' style='margin-right: 8px'>
                        <input type='hidden' name='i' value=".($prevPage).">
                        <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Previous'>
                    </form>
                    <form action='' method='get'>
                        <input type='hidden' name='i' value=".($nextPage).">
                        <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Next &raquo;'>
                    </form>
                </div>
                <input id='hiddenPage' type='hidden' value='$page'>";
            ?>
</div>
