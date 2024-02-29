<div class="container">
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

    <article class="container article">

        <?php
            $banner_img = 'Header-distribuidor-IMG.jpg';
            $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

            // Incluir el archivo de traducciones
            require __DIR__. '/../../../php/translations.php';

            // Determinar el texto del banner según el idioma
            $banner_text_translation = isset($translations[$language]['banner_text_manage_product']) ? $translations[$language]['banner_text_manage_product'] : $translations['en']['banner_text_manage_products'];
            
            // Incluir el banner.php pasando el texto traducido y el nombre del usuario
            $banner_text = $banner_text_translation;
            $banner_text = "Gestión de productos";
            include __DIR__.'/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://plataforma.kalstein.net/distribuidor/productos" data-i18n="distribuidor:productsExist" >Existencias de productos</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/distribuidor/productos/agregar" data-i18n="distribuidor:addProduct">Agregar un producto</a>
            <a class="nav-link active" href="https://plataforma.kalstein.net/distribuidor/productos/calculadora" data-i18n="distribuidor:linkSendsCalculator">Calculadora de envíos</a>
        </nav>
        <br>        
        <div class="table-responsive">
            <table class='table custom-table'>
                <thead class='headTableForQuote'>
                    <tr>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>ID</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>Nombre</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>Estatus</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>Imágen</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>Categoría</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>Existencias</td>
                        <td class='fw-bold' style='background-color: #213280; color: white; min-width: 76px;'>Precio en (USD)</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>Fecha</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>Acciones</td>
                    </tr>
                </thead>
                <tbody id="product-table-body" class='bodyTableForQuote'>
                <?php
        
        session_start();
                    
        require __DIR__.'/../../../php/conexion.php';

        $acc_id = $_SESSION['emailAccount'];

        $perPage = 5;
        $page = isset($_GET['i']) ? $_GET['i'] : 1;

        $queryTotal = "SELECT COUNT(*) FROM wp_k_products WHERE product_maker = '$acc_id'";
        $All = $conexion->query($queryTotal)->fetch_array()[0];
        
        if ($All <= ($page - 1) * $perPage){
            $page = intdiv($All, $perPage) + ($All % $perPage > 0 ? 1 : 0);
        }
        $page = max(intval($page), 1);
        
        $offset = ($page - 1) * $perPage;
        $limit = $perPage;

        $query = "SELECT * FROM wp_k_products WHERE product_maker = '$acc_id' AND product_group = 0 ORDER BY product_create_at DESC LIMIT $offset, $limit";
        $resultado = $conexion->query($query);

        if ($resultado->num_rows > 0) {
            while ($value = $resultado->fetch_assoc()) {
                $id = $value['product_aid'];
                $name = $value['product_name_es'];
                $brand = $value['product_brand'];
                $category = $value['product_category_es'];
                $weight = $value['product_peso_neto'];
                $stock = $value['product_stock_units'];
                $stock = number_format($stock);
                $width = $value['product_ancho'];
                $height = $value['product_alto'];
                $length = $value['product_largo'];
                $status = $value['product_stock_status'];
                $status = str_replace('In stock', 'En existencias', $status);
                $priceUSD = $value['product_priceUSD'];
                $priceEUR = $value['product_priceEUR'];
                $currency = $value['wp_product_currency'];
                $image = $value['product_image'];
                $date = $value['product_create_at'];
                $val_status = $value['product_validate_status'];

                if ($status == 'in stock'){
                    $status = 'En existencias';
                }
                else if ($status == 'out of stock'){
                    $status = 'Agotado';
                }

                if ($currency == 'EUR') {
                    $currency = '€';
                    $price = number_format($priceEUR, 2);
                }
                else if ($currency == 'USD') {
                    $currency = '$';
                    $price = number_format($priceUSD, 2);
                }

                if ($val_status == 'pending'){
                    $st = '<i class="fa-regular fa-clock h3" style="color: #ffba1f"></i><p class="mb-0"><b>Pendiente</b></p>';
                }
                else if ($val_status == 'validated'){
                    $st = '<i class="fa-regular fa-circle-check h3" style="color: #4cd17a"></i><p class="mb-0"><b>Validado</b></p>';
                }
                else if ($val_status == 'denied'){
                    $st = '<i class="fa-solid fa-triangle-exclamation h3 style="color: #d13a33"></i><p class="mb-0"><b>Denegado</b></p>';
                }

                $date = date('d/m/Y', strtotime($date));
        
                echo ("
                <tr id='product-$id'>
                    <td>$id</td>
                    <td style='max-width: 120px;'><h6>$name<br><small style='color: #000'>(Por $brand)</small></h6></td>
                    <td>$st</td>
                    <td>
                        <img src='$image' width=100>
                    </td>
                    <td>$category</td>
                    <td style='min-width: 89px'>$stock <br>($status)</td>
                    <td style=''>$currency $price</td>
                    <td>$date</td>
                    <td>
                        <button class='material-symbols-rounded'  id='btnDeleteProduct' value='$id'>delete</button>
                        <br>
                        <button class='material-symbols-rounded'  id='btnEditProduct' value='$id'>edit</button>
                        <br>
                        <a href='https://plataforma.kalstein.net/index.php/distribuidor/productos/prevista/?id=$id'><i class='fa-solid fa-eye btn-details' style='color: #000 !important; font-size: 16px;'></i></a>
                    </td>
                </tr>
                ");
            }
            echo "
                </tbody>
            </table>
            ";
        }
        else {
            echo ("
                    </tbody>
                </table>
                <div class='contentNoDataQuote'>
                    <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
                    <center><p style='color: #000;'>No data found</p></center>
                </div>
            ");
        }

        $prevPage = $page > 1? $page - 1 : 1;
        $nextPage = $page + 1;

        $hiddenPrev = $page == 1 ? 'hidden' : '';
        $hiddenNext = $page * $perPage >= $All ? 'hidden' : '';
        
        echo "
        <span> Página $page </span>
        <div class='pagination'>
            <form action='' method='get' style='margin-right: 8px' $hiddenPrev>
                <input type='hidden' name='i' value=".($prevPage).">
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Anterior'>
            </form>
            <form action='' method='get' $hiddenNext>
                <input type='hidden' name='i' value=".($nextPage).">
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Próximo &raquo;'>
            </form>
        </div>
        <input id='hiddenPage' type='hidden' value='$page'>";
    ?>
            </div>
    </article>

    <?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?> 
</div>
