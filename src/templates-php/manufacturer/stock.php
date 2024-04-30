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
        $banner_img = 'Header-fabricante-IMG.png';

        require __DIR__ . '/../../../php/translateTextBanner.php';
        $banner = 'banner_text_ProductManagement';
        $banner_text = translateTextBanner($banner);
        include 'banner.php';
        require __DIR__ . '/../../../php/conexion.php';
        require __DIR__ . '/../../../php/getMembresia.php';

        $acc_id = $_SESSION['emailAccount'];  // Asumiendo que este es el ID del usuario
        $membresia = $_SESSION['tipo_membresia'];  // Tipo de membresía obtenida de alguna parte
        
        $sqlCount = "SELECT COUNT(*) AS total FROM wp_k_products WHERE product_maker = '$acc_id'";
        $result = $conexion->query($sqlCount);

        $total = 0; // Inicializa la variable total
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total = $row['total'];
        }

        $maxProductos = 0;

        if ($membresia == 0) {
            $maxProductos = 5;
        } elseif ($membresia == 1) {
            $maxProductos = 10;
        }
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link active" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/productos"
                data-i18n='manofacturer:existenciaProductos'>Existencias de productos</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/productos/agregar"
                data-i18n='manofacturer:agregarProducto'>Agregar productos</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/fabricante/productos/calculadora"
                data-i18n='manofacturer:costoEnvio'>Costos de envíos</a>
        </nav>
        <br>
        <div>
            <?php
            if ($membresia == 0 || $membresia == 1) {
                echo "<p> Total <b>$total</b>/<b>$maxProductos</b> productos en tu inventario
                        <span class='info-icon' data-tooltip='Membresía 1 = Máximo 5 Productos &#10;Membresía 2 = Máximo 10 Productos &#10;Membresía 3 = Productos ilimitados'>
                            <i class='fas fa-info-circle'></i>
                        </span>
                    </p>";

                if ($total >= $maxProductos) {
                    echo "<div class='container-danger'>
                    <p class='text-danger'>
                        <i class='fas fa-exclamation-circle'></i> ¡Has alcanzado el límite de productos permitidos en tu inventario!
                        <a href='https://dev.kalstein.plus/plataforma/fabricante/subscripcion/' class='alert-link'>Para añadir más, mejora tu plan.</a>
                    </p>
                </div>
                    ";
                }
            } elseif ($membresia == 2) {
                echo "<p class='text-muted'> Total <b>$total</b> productos en tu inventario.";
            }
            ?>
        </div>
        <div class="table-responsive">
            <table class='table custom-table'>
                <thead class='headTableForQuote'>
                    <tr>
                        <td class='fw-bold' style='background-color: #213280; color: white;'>ID</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'
                            data-i18n='manofacturer:nombre'>Nombre</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'
                            data-i18n='manofacturer:estatus'>Estatus</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'
                            data-i18n='manofacturer:imagenProducto'>Imagen</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'
                            data-i18n='manofacturer:categoria'>Categoría</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'
                            data-i18n='manofacturer:existencias'>Existencia</td>
                        <td class='fw-bold' style='background-color: #213280; color: white; min-width: 76px;'
                            data-i18n='manofacturer:precios'>Precio</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'
                            data-i18n='manofacturer:fecha'>Fecha</td>
                        <td class='fw-bold' style='background-color: #213280; color: white;'
                            data-i18n='manofacturer:acciones'>Acciones</td>
                    </tr>
                </thead>
                <tbody id="product-table-body" class='bodyTableForQuote'>
                    <?php

                    session_start();

                    require __DIR__ . '/../../../php/conexion.php';

                    $acc_id = $_SESSION['emailAccount'];

                    $perPage = 5;
                    $page = isset($_GET['i']) ? $_GET['i'] : 1;

                    $queryTotal = "SELECT COUNT(*) FROM wp_k_products WHERE product_maker = '$acc_id'";
                    $All = $conexion->query($queryTotal)->fetch_array()[0];

                    if ($All <= ($page - 1) * $perPage) {
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
                            $priceUSD = $value['product_priceUSD'];
                            $priceEUR = $value['product_priceEUR'];
                            $currency = $value['wp_product_currency'];
                            $image = $value['product_image'];
                            $date = $value['product_create_at'];
                            $val_status = $value['product_validate_status'];

                            if ($status == 'in stock') {
                                $status = 'En existencias';
                            } else if ($status == 'out of stock') {
                                $status = 'Agotado';
                            }

                            if ($currency == 'EUR') {
                                $currency = '€';
                                $price = number_format($priceEUR, 2);
                            } else if ($currency == 'USD') {
                                $currency = '$';
                                $price = number_format($priceUSD, 2);
                            }

                            if ($val_status == 'pending') {
                                $st = '<i class="fa-regular fa-clock h3" style="color: #ffba1f"></i><p class="mb-0"><b data-i18n="manofacturer:pendientes">Pendiente</b></p>';
                            } else if ($val_status == 'validated') {
                                $st = '<i class="fa-regular fa-circle-check h3" style="color: #4cd17a"></i><p class="mb-0"><b data-i18n="manofacturer:validado">Validado</b></p>';
                            } else if ($val_status == 'denied') {
                                $st = '<i class="fa-solid fa-triangle-exclamation h3 style="color: #d13a33"></i><p class="mb-0"><b data-i18n="manofacturer:denegado">Denegado</b></p>';
                            }

                            $date = date('d/m/Y', strtotime($date));

                            echo ("
                                <tr id='product-$id'>
                                    <td>$id</td>
                                    <td style='max-width: 120px;'><h6>$name<br><small style='color: #000'>(por $brand)</small></h6></td>
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
                                        <a href='https://dev.kalstein.plus/plataforma/index.php/fabricante/productos/prevista/?id=$id'><i class='fa-solid fa-eye btn-details' style='color: #000 !important; font-size: 16px;'></i></a>
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
                                    <center><p style='color: #000;' data-i18n='manofacturer:noDatosEncontrados'>No se encontraron datos</p></center>
                                </div>
                            ");
                    }

                    $prevPage = $page > 1 ? $page - 1 : 1;
                    $nextPage = $page + 1;

                    $hiddenPrev = $page == 1 ? 'hidden' : '';
                    $hiddenNext = $page * $perPage >= $All ? 'hidden' : '';

                    echo "
                        <span> Página $page </span>
                        <div class='pagination'>
                            <form action='' method='get' style='margin-right: 8px' $hiddenPrev>
                                <input type='hidden' name='i' value=" . ($prevPage) . ">
                                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Previous'>
                            </form>
                            <form action='' method='get' $hiddenNext>
                                <input type='hidden' name='i' value=" . ($nextPage) . ">
                                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Next &raquo;'>
                            </form>
                        </div>
                        <input id='hiddenPage' type='hidden' value='$page'>";
                    ?>

        </div>
    </article>

    <?php
    $footer_img = 'Footer-fabricante-IMG.png';
    include 'footer.php';
    ?>
</div>