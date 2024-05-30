<header class="header" data-header>

    <?php

    include 'navbar.php';
    require __DIR__ . '/../../../php/conexion.php';
    if (isset($_GET['guideId'])) {
        $guideId = $_GET['guideId'];
    } else {
        $guideId = '';
    }
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
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

    h5,
    p,
    h6 {
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

    .text-small {
        font-size: 1em;
        text-wrap: wrap;
        overflow-wrap: anywhere;
    }
</style>

<main>
    <article class="container article">
        <h4>Validar guía informativa</h4>
        <p>Por favor, revisa la información de la guía y marca con un check los datos que sean válidos.</p>
        <div class='card mb-3'>
            <div class='row'>

                <?php

                $sql = "SELECT 
                    wp_guides.*,
                    wp_guides_details.*,
                    wp_k_products.product_subcategory_es,
                    wp_k_products.product_category_es
                FROM 
                    wp_guides
                INNER JOIN 
                    wp_guides_details ON wp_guides.guide_id = wp_guides_details.guide_id
                INNER JOIN 
                    wp_k_products ON wp_guides_details.guide_product_id = wp_k_products.product_aid
                WHERE 
                    wp_guides.guide_id = '$guideId'";


                $result = $conexion->query($sql);



                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $guideDetailNumber = $row['guide_detail_number'];

                        // Guardar en variables con el sufijo correspondiente
                        ${"productName_" . $guideDetailNumber} = $row['product_category_es'];
                        ${"productSubcategory_" . $guideDetailNumber} = $row['product_subcategory_es'];
                        ${"productCategory_" . $guideDetailNumber} = $row['product_category_es'];
                        ${"guideDescription_" . $guideDetailNumber} = $row['guide_description'];
                        ${"guideImg_" . $guideDetailNumber} = $row['guide_img_url'];
                    }

                    // Mostrar el contenido para el producto 1 (obligatorio)
                    echo "<div class='col-md-4 text-sm-start text-md-center'>
                            <h5>
                            <i class='fas fa-pen'></i>
                            Producto principal
                            <input class='d-inline' type='checkbox' id='name'>
                        </h5>
                        <h6 class='text-start'>" . $productName_1 . "</h6>
                        <a TARGET='_blank' href='$guideImg_1'>
                            <img class='my-3 d-flex justify-content-start' style='margin: auto; border: 1px solid #999'
                                width=200
                                src='" . $guideImg_1 . "'>
                        </a>
                
                        <!-- Enlaces o promociones -->
                        <p><label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-i'>
                        </p>
                
                        <p><label for=''>Image quality</label>
                            <input class='d-inline' type='checkbox' id='quality-i'>
                        </p>
                
                        <p><label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-i'>
                        </p>
                        </div>
                        <div class='col-md-8'>
                        <h5>
                            <i class='fas fa-circle-info'></i>
                            Description
                        </h5>
                        <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                            <p style='text-align: justify;'>" . $guideDescription_1 . "</p>
                        </div>
                        <p>
                            <label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-d'><br>
                        </p>
                        <p>
                            <label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-d'>
                        </p>
                    </div>
                    </div>
                </div>";

                    // Revisar si hay producto 2 o 3 para agregar el HTML inicial básico
                    if (isset($productName_2) || isset($productName_3)) {
                        echo "<div class='card mb-3'>
                        <h5>
                            <i class='fa-solid fa-shapes'></i>
                            Clasificación del producto
                        </h5>
                        <div class='row mt-2'>";
                    }

                    if (isset($productName_2)) {
                        echo "
                        <div class='col-md-6 text-sm-start text-md-center'>
                        <h6 class='text-start' style='font-weight: 600;'>
                            <i class='fas fa-pen'></i>
                            Tipo de producto #1
                            <input class='d-inline' type='checkbox' id='name'>
                        </h6>
                        <h6 class='text-start' style='font-size: 1.15em;'>
                            " . $productName_2 . "
                        </h6>
                        <a TARGET='_blank' href='$guideImg_2'>
                            <img class='my-3 d-flex justify-content-start' style='margin: auto; border: 1px solid #999'
                                width=200
                                src='" . $guideImg_2 . "'>
                        </a>
                
                        <!-- Enlaces o promociones -->
                        <p><label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-i'>
                        </p>
                
                        <p><label for=''>Image quality</label>
                            <input class='d-inline' type='checkbox' id='quality-i'>
                        </p>
                
                        <p><label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-i'>
                        </p>
                
                        <h6 class='text-start' style='font-weight: 600;'>
                            <i class='fas fa-circle-info'></i>
                            Description
                        </h6>
                        <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                            <p style='text-align: justify;'>
                            " . $guideDescription_2 . "
                            </p>
                        </div>
                        <p>
                            <label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-d'><br>
                        </p>
                        <p>
                            <label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-d'>
                        </p>
                    </div>";
                    }

                    if (isset($productName_3)) {
                        echo "
                        <div class='col-md-6 text-sm-start text-md-center'>
                        <h6 class='text-start' style='font-weight: 600;'>
                            <i class='fas fa-pen'></i>
                            Tipo de producto #2
                            <input class='d-inline' type='checkbox' id='name'>
                        </h6>
                        <h6 class='text-start' style='font-size: 1.15em;'>
                            " . $productName_3 . "
                        </h6>
                        <a TARGET='_blank' href='$guideImg_3'>
                            <img class='my-3 d-flex justify-content-start' style='margin: auto; border: 1px solid #999'
                                width=200
                                src='" . $guideImg_3 . "'>
                        </a>
                
                        <!-- Enlaces o promociones -->
                        <p><label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-i'>
                        </p>
                
                        <p><label for=''>Image quality</label>
                            <input class='d-inline' type='checkbox' id='quality-i'>
                        </p>
                
                        <p><label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-i'>
                        </p>
                
                        <h6 class='text-start' style='font-weight: 600;'>
                            <i class='fas fa-circle-info'></i>
                            Description
                        </h6>
                        <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                            <p style='text-align: justify;'>
                            " . $guideDescription_3 . "
                            </p>
                        </div>
                        <p>
                            <label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-d'><br>
                        </p>
                        <p>
                            <label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-d'>
                        </p>
                    </div>";
                    }

                    // Cerrar el HTML inicial básico
                    echo "</div></div>";
                }
                ?>

                <?php
                $sqlDestacados = "SELECT wp_guides.*, wp_guides_products.* FROM wp_guides INNER JOIN wp_guides_products ON wp_guides.guide_id = wp_guides_products.guide_id WHERE wp_guides.guide_id = '$guideId'";

                $resultDestacados = $conexion->query($sqlDestacados);

                $rowDestacados = $resultDestacados->fetch_assoc();

                $idProduct1 = $rowDestacados['id_product_ideal_1'];
                $idProduct2 = $rowDestacados['id_product_ideal_2'];
                $idProduct3 = $rowDestacados['id_product_ideal_3'];
                $idProduct4 = $rowDestacados['id_product_ideal_4'];
                $idBestSeller = $rowDestacados['id_product_best_seller'];

                $sqlProductos = "SELECT * FROM wp_k_products 
                     WHERE product_aid IN ('$idProduct1', '$idProduct2', '$idProduct3', '$idProduct4', '$idBestSeller')";

                $resultProductos = $conexion->query($sqlProductos);

                while ($productRow = mysqli_fetch_assoc($resultProductos)) {
                    // Asigna los valores a las variables correspondientes
                    if ($productRow['product_aid'] == $idProduct1) {
                        $product1_name = $productRow['product_name_es'];
                        $product1_model = $productRow['product_model'];
                        $product1_img = $productRow['product_image'];
                    } elseif ($productRow['product_aid'] == $idProduct2) {
                        $product2_name = $productRow['product_name_es'];
                        $product2_model = $productRow['product_model'];
                        $product2_img = $productRow['product_image'];
                    } elseif ($productRow['product_aid'] == $idProduct3) {
                        $product3_name = $productRow['product_name_es'];
                        $product3_model = $productRow['product_model'];
                        $product3_img = $productRow['product_image'];
                    } elseif ($productRow['product_aid'] == $idProduct4) {
                        $product4_name = $productRow['product_name_es'];
                        $product4_model = $productRow['product_model'];
                        $product4_img = $productRow['product_image'];
                    } elseif ($productRow['product_aid'] == $idBestSeller) {
                        $bestSeller_name = $productRow['product_name_es'];
                        $bestSeller_model = $productRow['product_model'];
                        $bestSeller_img = $productRow['product_image'];
                    }
                }

                if (isset($product1_name)) {
                    echo "<div class='card mb-3'>
                    <div class='row text-sm-start text-md-center'>
                        <h5>
                            <i class='fa-regular fa-lightbulb'></i>
                            Productos ideales
                        </h5>
                    </div>
                    <div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>";

                    echo "<div class='col-md-3 align-items-center'>
                    <div>
                        <a TARGET='_blank' href='$product1_img'>
                            <img class='my-3 d-flex justify-content-start'
                                style='margin: auto; border: 1px solid #999' width=200
                                src='$product1_img'>
                        </a>
                    </div>
                    <div>
                        <h6 class='text-start'>$product1_name<input class='d-inline' type='checkbox' id='name'>
                        </h6>
                        <p><b>Model:</b> $product1_model <input class='d-inline' type='checkbox' id='name'></p>
                    </div>
                </div>";

                    if (isset($product2_name)) {
                        echo "<div class='col-md-3 align-items-center'>
                    <div>
                        <a TARGET='_blank' href='$product2_img'>
                            <img class='my-3 d-flex justify-content-start'
                                style='margin: auto; border: 1px solid #999' width=200
                                src='$product2_img'>
                        </a>
                    </div>
                    <div>
                        <h6 class='text-start'>$product2_name<input class='d-inline' type='checkbox' id='name'>
                        </h6>
                        <p><b>Model:</b> $product2_model <input class='d-inline' type='checkbox' id='name'></p>
                    </div>
                </div>";
                    }
                    if (isset($product3_name)) {
                        echo "<div class='col-md-3 align-items-center'>
                    <div>
                        <a TARGET='_blank' href='$product3_img'>
                            <img class='my-3 d-flex justify-content-start'
                                style='margin: auto; border: 1px solid #999' width=200
                                src='$product3_img'>
                        </a>
                    </div>
                    <div>
                        <h6 class='text-start'>$product3_name<input class='d-inline' type='checkbox' id='name'>
                        </h6>
                        <p><b>Model:</b> $product3_model <input class='d-inline' type='checkbox' id='name'></p>
                    </div>
                </div>";
                    }

                    if (isset($product4_name)) {
                        echo "<div class='col-md-3 align-items-center'>
                    <div>
                        <a TARGET='_blank' href='$product4_img'>
                            <img class='my-3 d-flex justify-content-start'
                                style='margin: auto; border: 1px solid #999' width=200
                                src='$product4_img'>
                        </a>
                    </div>
                    <div>
                        <h6 class='text-start'>$product4_name<input class='d-inline' type='checkbox' id='name'>
                        </h6>
                        <p><b>Model:</b> $product4_model <input class='d-inline' type='checkbox' id='name'></p>
                    </div>
                </div>";
                    }

                    echo "</div></div>";
                }

                if (isset($bestSeller_name)) {
                    echo "
                    <div class='card mb-3'>
                <div class='row text-sm-start text-md-center'>
                    <h5>
                        <i class='fa-solid fa-money-bills'></i>
                        Producto mas vendido
                    </h5>
                </div>
                <div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>
                    <div class='row align-items-center'>
                        <div class='col-md-4'>
                            <a TARGET='_blank' href='$bestSeller_img'>
                                <img class='my-3 d-flex justify-content-start'
                                    style='margin: auto; border: 1px solid #999' width=200
                                    src='$bestSeller_img'>
                            </a>
                        </div>
                        <div class='col-md-8'>
                            <h6 class='text-start'>$bestSeller_name<input class='d-inline' type='checkbox' id='name'>
                            </h6>
                            <p><b>Model:</b> $bestSeller_model <input class='d-inline' type='checkbox' id='name'></p>
                        </div>
                    </div>

                </div>
            </div>
                    ";
                }

                ?>

                <?php
                // Realiza la primera consulta
                $sqlArticles = "SELECT wp_guides.*, wp_guides_articles.* 
                FROM wp_guides 
                INNER JOIN wp_guides_articles 
                ON wp_guides.guide_id = wp_guides_articles.guide_id 
                WHERE wp_guides.guide_id = '$guideId'";

                $resultArticle = $conexion->query($sqlArticles);

                // Verificar si la consulta falló
                if (!$resultArticle) {
                    die("Error en la consulta SQL: " . $conexion->error);
                }

                $rowArticle = $resultArticle->fetch_assoc();

                // Almacenar los IDs de los artículos en un array
                $idArticles = [];
                $idFeaturedArt = [];
                for ($i = 1; $i <= 4; $i++) {
                    if (!empty($rowArticle["id_article_$i"])) {
                        $idArticles[] = $rowArticle["id_article_$i"];
                    }
                    if (!empty($rowArticle["id_article_featured_$i"])) {
                        $idFeaturedArt[] = $rowArticle["id_article_featured_$i"];
                    }
                }

                // Prepara la consulta para obtener los datos de los artículos
                $sqlArticless = "SELECT wp_art_blog.*, wp_categories.categorie_description_es 
                 FROM wp_art_blog 
                 INNER JOIN wp_categories ON wp_categories.categorie_id = wp_art_blog.art_id_category 
                 WHERE art_id IN ('" . implode("','", $idArticles) . "')";
                $resultArticless = $conexion->query($sqlArticless);

                // Verificar si la consulta falló
                if (!$resultArticless) {
                    die("Error en la consulta SQL: " . $conexion->error);
                }

                // Variables para guardar los datos de los artículos
                $articles = [];

                while ($articleRow = mysqli_fetch_assoc($resultArticless)) {
                    $articleId = $articleRow['art_id'];
                    $articles[$articleId] = [
                        'title' => $articleRow['art_title'],
                        'description' => $articleRow['categorie_description_es'],
                        'image' => $articleRow['art_img']
                    ];
                }

                if (!empty($articles)) {
                    echo "<div class='card mb-3'>
            <div class='row text-sm-start text-md-center'>
                <h5>
                    <i class='fa-regular fa-newspaper'></i>
                    Articulos destacados
                </h5>
            </div>
            <div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>";

                    foreach ($idArticles as $index => $articleId) {
                        if (isset($articles[$articleId])) {
                            $article = $articles[$articleId];
                            echo "<div class='col-md-3 align-items-center'>
                    <div>
                        <a TARGET='_blank' href='{$article['image']}'>
                            <img class='my-3 d-flex justify-content-start'
                                style='margin: auto; border: 1px solid #999' width=200
                                src='{$article['image']}'>
                        </a>
                    </div>
                    <div>
                        <h6 class='text-start'>{$article['title']}<input class='d-inline' type='checkbox' id='article$index'></h6>
                        <p><b>Category:</b> {$article['description']} <input class='d-inline' type='checkbox' id='articleCategory$index'></p>
                    </div>
                  </div>";
                        }
                    }

                    echo "</div></div>";
                }
                ?>


                <?php
                // Realiza la primera consulta
                $sqlCatalogs = "SELECT wp_guides.*, wp_guides_catalogs.* 
                FROM wp_guides 
                INNER JOIN wp_guides_catalogs 
                ON wp_guides.guide_id = wp_guides_catalogs.guide_id 
                WHERE wp_guides.guide_id = '$guideId'";

                $resultCatalogs = $conexion->query($sqlCatalogs);

                // Verificar si la consulta falló
                if (!$resultCatalogs) {
                    die("Error en la consulta SQL: " . $conexion->error);
                }

                $rowCatalogs = $resultCatalogs->fetch_assoc();

                // Almacenar los IDs de los catálogos en un array
                $idCatalogs = [];
                for ($i = 1; $i <= 8; $i++) {
                    if (!empty($rowCatalogs["id_catalog_$i"])) {
                        $idCatalogs[] = $rowCatalogs["id_catalog_$i"];
                    }
                }

                // Prepara la consulta para obtener los datos de los catálogos
                $sqlCatalogData = "SELECT * FROM wp_catalogs_es WHERE id IN ('" . implode("','", $idCatalogs) . "')";
                //echo $sqlCatalogData;
                $resultCatalogData = $conexion->query($sqlCatalogData);

                // Verificar si la consulta falló
                if (!$resultCatalogData) {
                    die("Error en la consulta SQL: " . $conexion->error);
                }

                // Variables para guardar los datos de los catálogos
                $catalogs = [];

                while ($catalogRow = mysqli_fetch_assoc($resultCatalogData)) {
                    $catalogId = $catalogRow['id'];
                    $catalogs[$catalogId] = [
                        'name' => $catalogRow['catalog_name_es'],
                        'image' => $catalogRow['catalog_image'],
                        'category' => $catalogRow['catalog_category_es']
                    ];
                }

                if (!empty($catalogs)) {
                    echo "<div class='card mb-3'>
            <div class='row text-sm-start text-md-center'>
                <h5>
                    <i class='fa-solid fa-shop'></i>
                    Catálogo de producto
                </h5>
            </div>
            <div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>";

                    foreach ($catalogs as $index => $catalog) {
                        echo "<div class='col-md-3 align-items-center'>
                            <div>
                                <a TARGET='_blank' href='#'>
                                    <img class='my-3 d-flex justify-content-start'
                                        style='margin: auto; border: 1px solid #999' width=200
                                        src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/catalogs/thumbnails/{$catalog['image']}'>
                                </a>
                            </div>
                            <div>
                                <p class='text-start text-small'>{$catalog['name']}<input class='d-inline' type='checkbox' id='catalog$index'>
                                </p>
                                <p><b>Category:</b> {$catalog['category']}  <input class='d-inline' type='checkbox' id='catalogCategory$index'></p>
                            </div>
                        </div>";
                    }

                    echo "</div></div>";
                }
                ?>

                <?php
                $sqlArticles = "SELECT wp_guides.*, wp_guides_articles.* 
                FROM wp_guides 
                INNER JOIN wp_guides_articles 
                ON wp_guides.guide_id = wp_guides_articles.guide_id 
                WHERE wp_guides.guide_id = '$guideId'";

                $resultArticle = $conexion->query($sqlArticles);

                // Verificar si la consulta falló
                if (!$resultArticle) {
                    die("Error en la consulta SQL: " . $conexion->error);
                }

                $rowArticle = $resultArticle->fetch_assoc();

                // Almacenar los IDs de los artículos en un array
                $idArticles = [];
                for ($i = 1; $i <= 4; $i++) {
                    if (!empty($rowArticle["id_featured_article_$i"])) {
                        $idArticles[] = $rowArticle["id_featured_article_$i"];
                    }
                }

                // Prepara la consulta para obtener los datos de los artículos
                $sqlArticless = "SELECT wp_art_blog.*, wp_categories.categorie_description_es 
                 FROM wp_art_blog 
                 INNER JOIN wp_categories ON wp_categories.categorie_id = wp_art_blog.art_id_category 
                 WHERE art_id IN ('" . implode("','", $idArticles) . "')";
                $resultArticless = $conexion->query($sqlArticless);

                // Verificar si la consulta falló
                if (!$resultArticless) {
                    die("Error en la consulta SQL: " . $conexion->error);
                }

                // Variables para guardar los datos de los artículos
                $articlesFt = [];

                while ($articleRow = mysqli_fetch_assoc($resultArticless)) {
                    $articleId = $articleRow['art_id'];
                    $articlesFt[$articleId] = [
                        'title' => $articleRow['art_title'],
                        'description' => $articleRow['categorie_description_es'],
                        'image' => $articleRow['art_img']
                    ];
                }

                if (!empty($articlesFt)) {
                    echo "<div class='card mb-3'>
            <div class='row text-sm-start text-md-center'>
                <h5>
                    <i class='fa-solid fa-book-open'></i>
                    Manuales
                </h5>
            </div>
            <div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>";

                    echo "<div class='row'>";

                    // for en los primeros 3 artículos
                    $count = 0;
                    foreach ($articlesFt as $articleId => $article) {
                        if ($count < 3) {
                            echo "<div class='col-md-4 align-items-center'>
                    <div>
                        <h6 class='text-start' style='font-weight: 600;'>
                            <i class='fas fa-pen'></i>
                            Manual #" . ($count + 1) . "
                            <input class='d-inline' type='checkbox' id='name'>
                        </h6>
                        <h6 class='text-start' style='font-size: 1.15em;'>{$article['title']}</h6>
                        <a TARGET='_blank' href='{$article['image']}'>
                            <img class='my-3 d-flex justify-content-start'
                                style='margin: auto; border: 1px solid #999' width=200
                                src='{$article['image']}'>
                        </a>
                        <p><label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-i'>
                        </p>
                        <p><label for=''>Image quality</label>
                            <input class='d-inline' type='checkbox' id='quality-i'>
                        </p>
                        <p><label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-i'>
                        </p>
                    </div>
                    <div>
                        <h6 class='text-start' style='font-weight: 600;'>
                            <i class='fas fa-circle-info'></i>
                            Description
                        </h6>
                        <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                            <p style='text-align: justify;'>{$article['description']}</p>
                        </div>
                        <p><label for=''>Links or self-promotion</label>
                            <input class='d-inline' type='checkbox' id='promotions-d'><br>
                        </p>
                        <p><label for=''>Professionalism</label>
                            <input class='d-inline' type='checkbox' id='professionalism-d'>
                        </p>
                        <p class='mt-2'><b>Link: </b><a href=''>link</a><input class='d-inline' type='checkbox' id='promotions-d'></p>
                    </div>
                  </div>";
                            $count++;
                        }
                    }

                    echo "</div>";

                    // Si hay un cuarto artículo, mostrarlo con un formato diferente
                    if (count($articlesFt) > 3) {
                        $articleId = array_keys($articlesFt)[3];
                        $article = $articlesFt[$articleId];
                        echo "<div class='row mt-3 align-items-center'>
                <div class='col-md-4'>
                    <h6 class='text-start' style='font-weight: 600;'>
                        <i class='fas fa-pen'></i>
                        Manual destacado
                        <input class='d-inline' type='checkbox' id='name'>
                    </h6>
                    <h6 class='text-start' style='font-size: 1.15em;'>{$article['title']}</h6>
                    <a TARGET='_blank' href='{$article['image']}'>
                        <img class='my-3 d-flex justify-content-start' style='margin: auto; border: 1px solid #999'
                            width=200 src='{$article['image']}'>
                    </a>
                    <p><label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-i'>
                    </p>
                    <p><label for=''>Image quality</label>
                        <input class='d-inline' type='checkbox' id='quality-i'>
                    </p>
                    <p><label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-i'>
                    </p>
                </div>
                <div class='col-md-8'>
                    <h6 class='text-start' style='font-weight: 600;'>
                        <i class='fas fa-circle-info'></i>
                        Description
                    </h6>
                    <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                        <p style='text-align: justify;'>{$article['description']}</p>
                    </div>
                    <p><label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-d'><br>
                    </p>
                    <p><label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-d'>
                    </p>
                    <p class='mt-2'><b>Link: </b><a href=''>link</a><input class='d-inline' type='checkbox' id='promotions-d'></p>
                </div>
              </div>";
                    }

                    echo "</div></div>";
                }
                ?>

                <div class='card mb-3'>
                    <div class='row text-sm-start text-md-center'>
                        <h5>
                            <i class='fa-solid fa-star'></i>
                            Extras
                        </h5>
                    </div>
                    <?php

                    $sqlExtra = "SELECT * FROM wp_guides_videos WHERE guide_id = '$guideId'";

                    $resultExtra = $conexion->query($sqlExtra);

                    $rowExtra = $resultExtra->fetch_assoc();

                    $videoUrl = $rowExtra['guide_video_url'];
                    $videoDescription = $rowExtra['guide_video_description'];

                    if ($videoUrl) {
                        echo "<div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>
                        <div class='row'>
                            <h6 class='text-start' style='font-weight: 600;'><i class='fa-regular fa-file-video'></i>
                                Video
                            </h6>
                            <p style='font-weight: 600'>
                                <i class='fa-solid fa-paperclip'></i>
                                Link <input class='d-inline' type='checkbox' id='name'>
                            </p>
                            <div class='mb-3 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                                <p style='text-align: justify;'>$videoUrl</p>
                            </div>
                            <p style='font-weight: 600'>
                                <i class='fas fa-circle-info'></i>
                                Description
                            </p>
                            <div class='row p-0'>
                                <div class='col-9'>
                                    <div class='mb-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                                        <p style='text-align: justify;'>$videoDescription</p>
                                    </div>
                                </div>
                                <div class='col-3'>
                                    <p><label for=''>Links or self-promotion</label>
                                        <input class='d-inline' type='checkbox' id='promotions-i'>
                                    </p>

                                    <p><label for=''>Professionalism</label>
                                        <input class='d-inline' type='checkbox' id='professionalism-i'>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>";
                    }

                    ?>


                    <?php
                    // Consulta para obtener las preguntas y respuestas de la tabla wp_guides_faq
                    $sqlFAQ = "SELECT guide_faq_1, guide_faq_aswer_1, guide_faq_2, guide_faq_aswer_2, guide_faq_3, guide_faq_aswer_3, guide_faq_4, guide_faq_aswer_4, guide_faq_5, guide_faq_aswer_5 
                    FROM wp_guides_faq 
                    WHERE guide_id = '$guideId'";

                                $resultFAQ = $conexion->query($sqlFAQ);

                                // Verificar si la consulta falló
                                if (!$resultFAQ) {
                                    die("Error en la consulta SQL: " . $conexion->error);
                                }

                                $rowFAQ = $resultFAQ->fetch_assoc();

                                // Array para almacenar preguntas y respuestas
                                $faqs = [];
                                for ($i = 1; $i <= 5; $i++) {
                                    if (!empty($rowFAQ["guide_faq_$i"]) && !empty($rowFAQ["guide_faq_aswer_$i"])) {
                                        $faqs[] = [
                                            'question' => $rowFAQ["guide_faq_$i"],
                                            'answer' => $rowFAQ["guide_faq_answer_$i"]
                                        ];
                                    }
                                }

                                if (!empty($faqs)) {
                                    echo "<div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>
                        <div class='row'>
                            <h6 class='text-start' style='font-weight: 600;'><i class='fa-regular fa-circle-question'></i> FAQ</h6>";

                                    foreach ($faqs as $index => $faq) {
                                        echo "<div class='row'>
                            <div class='col-6'>
                                <p style='font-weight: 600'>Pregunta N°" . ($index + 1) . "</p>
                                <div class='mb-2 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px'>
                                    <p style='text-align: justify;'>{$faq['question']}</p>
                                </div>
                            </div>
                            <div class='col-6'>
                                <p style='font-weight: 600'>Respuesta N°" . ($index + 1) . "</p>
                                <div class='mb-2 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px'>
                                    <p style='text-align: justify;'>{$faq['answer']}</p>
                                </div>
                            </div>
                        </div>";
                                    }

                                    echo "</div></div>";
                                }
                    ?>


                    <div class='row mt-3 p-2' style='border: solid 1px #c9c9c9; border-radius: 10px;'>
                        <div class='row'>
                            <h6 class='text-start' style='font-weight: 600;'><i class='fa-solid fa-hashtag'></i>
                                Etiquetas
                            </h6>
                            <div class='d-flex my-2'>
                                <div class='d-flex justify-content-between me-2 p-2 bg-secondary text-white rounded'>
                                    <p class="m-0 p-0" style='font-weight: 600'><i class='fa-solid fa-hashtag'></i>
                                        etiqueta</p>
                                </div>
                                <div class='d-flex justify-content-between me-2 p-2 bg-secondary text-white rounded'>
                                    <p class="m-0 p-0" style='font-weight: 600'><i class='fa-solid fa-hashtag'></i>
                                        etiqueta</p>
                                </div>
                                <div class='d-flex justify-content-between me-2 p-2 bg-secondary text-white rounded'>
                                    <p class="m-0 p-0" style='font-weight: 600'><i class='fa-solid fa-hashtag'></i>
                                        etiqueta</p>
                                </div>
                                <div class='d-flex justify-content-between me-2 p-2 bg-secondary text-white rounded'>
                                    <p class="m-0 p-0" style='font-weight: 600'><i class='fa-solid fa-hashtag'></i>
                                        etiqueta</p>
                                </div>
                                <div class='d-flex justify-content-between me-2 p-2 bg-secondary text-white rounded'>
                                    <p class="m-0 p-0" style='font-weight: 600'><i class='fa-solid fa-hashtag'></i>
                                        etiqueta</p>
                                </div>
                            </div>
                            <p><label for=''>Professionalism</label>
                                <input class='d-inline' type='checkbox' id='professionalism-i'>
                            </p>
                            <p><label for=''>Coherence</label>
                                <input class='d-inline' type='checkbox' id='professionalism-i'>
                            </p>
                        </div>
                    </div>
                </div>


                <textarea class='mx-auto my-2' style='width: 100%; height: 150px;'
                    placeholder='Especifica porqué se está denegando la información' id='message'></textarea>
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
                    <h5>Past warnings</h5>
    </article>
</main>