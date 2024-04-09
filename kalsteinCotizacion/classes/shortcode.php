<?php
session_start();

class shortcode
{

    function navbar()
    {

        require __DIR__ . '/templates-php/translateText.php';
        translateText();
        $html = "
            <script src='https://kit.fontawesome.com/3cff919dc3.js' crossorigin='anonymous'></script>
            <div class='product-search-bar'>
                <div class='container p-0'>
                    <ul class='me-auto mb-2 mb-lg-0' style='height: 48px !important'>    
                        <form class='d-flex ms-2 border border-1 rounded' role='search' id='search-form' style='width: 100%; margin: 0; margin-left: 0 !important'>
                            <li class='nav-item dropdown' style='margin-left: -1.5mm; width: 100%'>
                                <input style='border: none; border-radius: 0; outline: none; width: 100%; height: 100%;' class='form-control rounded-start' id='i-search' type='search' data-placeholderp='search' placeholder='' aria-label='Search'>
                                <ul class='dropdown-menu sc'>

                                </ul>
                            </li>
                            <li class='nav-item dropdown bg-light px-2' style='width: auto;'>
                                <a class='nav-link dropdown-toggle txt-blue mt-2' id='filterSearchCategorie' href='#' role='button' data-bs-toggle='dropdown' aria-expanded='false' data-i17n='all'></a>
                                <ul class='dropdown-menu cd'>

                                </ul>
                            </li>
                            <button style='border: none; border-radius: 0;' class='btn btn-blue rounded-end' type='submit' id='btnSearch'><i class='fa-solid fa-magnifying-glass'></i></button>
                        </form>
                    </ul>
                </div>
            </div>
            ";

        return $html;
    }

    function body()
    {
        include __DIR__ . '/templates-php/modalCotizacion.php';
    }

    function resultPage()
    {
        require __DIR__ . '/conexion.php';
        if (isset($_SESSION['searchTags'])) {
            $searchTags = $_SESSION['searchTags'];
        } else {
            $searchTags = "";
        }

        if (isset($_SESSION['searchCategorie'])) {
            $searchCategorie = $_SESSION['searchCategorie'];
        } else {
            $searchCategorie = "";
        }

        if ($searchCategorie == 'All' || $searchCategorie == 'All categories') {
            $sql = "SELECT * FROM wp_k_products WHERE product_tags LIKE '%" . $searchTags . "%' OR product_model LIKE '%" . $searchTags . "%' ORDER BY product_priceUSD ASC";
            $rs = $conexion->query($sql);
            $count = mysqli_num_rows($rs);

            $sql1 = "SELECT * FROM wp_k_products WHERE product_tags LIKE '%" . $searchTags . "%' OR product_model LIKE '%" . $searchTags . "%'";
            $rs1 = $conexion->query($sql1);
            $row = mysqli_fetch_array($rs1);
            $category = $row[21];
        } else {
            $sql = "SELECT * FROM wp_k_products WHERE product_tags LIKE '%" . $searchTags . "%' AND product_category = '" . $searchCategorie . "' OR product_model LIKE '%" . $searchTags . "%' AND product_category = '" . $searchCategorie . "' ORDER BY product_priceUSD ASC";
            $rs = $conexion->query($sql);
            $count = mysqli_num_rows($rs);

            $sql1 = "SELECT * FROM wp_k_products WHERE product_tags LIKE '%" . $searchTags . "%' AND product_category = '" . $searchCategorie . "' OR product_model LIKE '%" . $searchTags . "%' AND product_category = '" . $searchCategorie . "'";
            $rs1 = $conexion->query($sql1);
            $row = mysqli_fetch_array($rs1);
            $category = $row[21];
        }

        if ($searchTags == "") {
            $html = "
                        <div class='mainResultSearch'>
                            <div class='RS'>
                                <span>Showing results 0 to 0 of 0 results for <span class='searchTags'>$searchTags</span></span>
                            </div>
                            <div class='asideCategory'>
                                <span class='tltAsideCategory'><b>Perform your product search</b></span>
                                <div class='cCategory'>
                                    <span class='typeCategory'></span>
                                    <div class='cSubCategory'>
                ";

            $html .= "        </div>                   
                            </div>
                        </div>
                        <div class='showResults'>
                        <button class='showQUO'>QUO <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger nPC'>0<span class='visually-hidden'>unread messages</span></span></button>
                ";

            $html .= "";
        } else {
            $html = "
                        <div class='mainResultSearch'>
                            <div class='RS'>
                                <span>Showing results 1 to $count of $count results for <span class='searchTags'>$searchTags</span></span>
                            </div>
                            <div class='asideCategory'>
                                <span class='tltAsideCategory'><b>Categorie</b></span>
                                <div class='cCategory'>
                                    <span class='typeCategory'>$category</span>
                                    <div class='cSubCategory'>
                ";

            $sql2 = "SELECT * FROM wp_categories WHERE categorie_description LIKE '%" . $category . "%'";
            $rs2 = $conexion->query($sql2);

            if ($rs2->num_rows > 0) {
                while ($value = $rs2->fetch_assoc()) {
                    $subcategory = $value['categorie_sub'];

                    $html .= " 
                                <li class='list-subcategory'>$subcategory</li>                               
                        ";
                }


            } else {
                $html .= "<div class='nodatos'><h5>No data found in your search</h5></div>";
            }

            $html .= "        </div>                   
                            </div><hr style='width: 90%;'>
                            <div>

                            </div>
                        </div>
                        <div class='showResults'>
                        <button class='showQUO'>QUO <span class='position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger nPC'>0<span class='visually-hidden'>unread messages</span></span></button>
                ";

            if ($rs->num_rows > 0) {
                while ($value = $rs->fetch_assoc()) {
                    $name = $value['product_name_en'];
                    $model = $value['product_model'];
                    $image = $value['product_image'];
                    $priceUSD = $value['product_priceUSD'];
                    $multi = $priceUSD * 0.18;
                    $disc = round($priceUSD - $multi, 2);

                    $html .= "
                                    <div class='card mb-3' style='max-width: 99%; height: 60mm;'>
                                        <div class='row g-0'>
                                            <div class='col-md-4' style='height: 60mm;'>
                                                <img src='$image' style='height: 95%;' class='img-fluid rounded-start' alt='...'>
                                            </div>
                                            <div class='col-md-8' style='height: 60mm;'>
                                                <div class='card-body'>
                                                    <h6 class='card-title' style='font-size: 1em; margin-bottom: 0;'>$name</h6>
                                                    <span>USD$</span><span class='prices'>$priceUSD</span>
                                                    <p class='card-text'><small class='text-muted'>$disc -18% discount with preorder</small></p>
                                                    <span class='quantity' style='float: left;'>Quantity:</span> <input type='number' class='i-cant' id='i-cant-$model' value='1'/ style='width: 20mm; margin-left: 2mm; margin-top: -2mm; float: left;'><br>
                                                    <div class='btnActions'>
                                                        <button value='$model' class='btnQuo'>To quote</button>
                                                        <button class='activeModal' data-bs-toggle='modal' data-bs-target='#cotModal' style='display: none;'></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            ";
                }


            } else {
                $html .= "<div class='nodatos'><h5>No data found in your search</h5></div>";
            }
        }

        $html .= "    </div>
                    </div>
            ";

        return $html;
    }
}