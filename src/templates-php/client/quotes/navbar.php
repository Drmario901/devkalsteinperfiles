<?php
    require __DIR__ . '/../../../php/quote/templates-php/translateText.php';
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

    echo $html;