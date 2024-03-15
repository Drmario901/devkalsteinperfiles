<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

require __DIR__ . '../db/conexion.php';

require_once __DIR__.'/translations.php';
//translateText();

$dataNotFound = $translations[$lang]['client:dataNotFound'];

// require __DIR__ . '/translateText.php';
// translateText();

$cate = $conexion->real_escape_string($_POST['category']);
$q = $conexion->real_escape_string($_POST['inputSearch']);

$perPage = 12;
$page = isset($_POST['o']) ? intval($_POST['o']) : 1;

$offset = ($page - 1) * $perPage;
$limit = $perPage;

$whereClauses = array(); 

if (!empty($cate)) {
    $whereClauses[] = "catalog_category = '$cate'";
}

if (!empty($q)) {
    $whereClauses[] = "catalog_name LIKE '%$q%'";
}

$whereClause = implode(" AND ", $whereClauses);

$consulta = "SELECT catalog_name, catalog_pdf, catalog_image FROM wp_catalogs";

if (!empty($whereClause)) {
    $consulta .= " WHERE " . $whereClause;
}

$consulta .= " LIMIT $offset, $limit";

$resultado = $conexion->query($consulta);

$html = '<div class="container">';
$html .= '<div class="row justify-content-center" id="catalogPag">';
$html .= '<div class="col-12 mx-auto">';
$html .= '<div class="row row-cols-1 row-cols-md-4 g-3">';

if ($resultado->num_rows > 0) {
    while ($value = $resultado->fetch_assoc()) {
        $id = $value['id'];
        $nombre = $value['catalog_name'];
        $imagen = $value['catalog_image'];
        $pdf = $value['catalog_pdf'];

        $html .= "
            <div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-3'>
                <div class='card h-100 mx-2'>
                    <img src='https://plateforme.kalstein.fr/wp-content/plugins/kalsteinPerfiles/src/catalogs/thumbnails/$imagen' class='catalog-img card-img border' alt='...'>
                    <div class='card-body d-flex flex-column justify-content-between'>
                        <center><h5 class='card-title' style='font-size: 16px;'>$nombre</h5></center>
                        <center><button class='_df_button' id='book1' source='https://plateforme.kalstein.fr/wp-content/plugins/kalsteinPerfiles/src/catalogs/upload/$pdf'>Regarder</button></center>
                    </div>
                </div>
            </div>
        ";
    }
} else {
    $html .= "
        <div class='contentNoDataQuote'>
            <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
            <center><p style='color: #000;'>  $dataNotFound </p></center>
        </div>
    ";
}

$html .= '</div>';
$html .= '</div>';
$html .= '</div>';
$prevPage = max(1, $page - 1);
$nextPage = $page + 1;
$html .= "
<div class='pagination'>
    <div id='currentPageIndicatorCatalog'>Page: $page</div>
    <form id='form-previous-catalog' action='' method='get' style='margin-right: 8px'>
        <input id='previous' type='hidden' name='o' value='$prevPage'>
        <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo;'>
    </form>
    <form id='form-next-catalog' action='' method='get'>
        <input id='next' class='next' type='hidden' name='o' value='$nextPage'>
        <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&raquo;'>
    </form>
</div>
<input id='hiddenPage' type='hidden' value='$page'>";
$html .= '</div>';

$consulta2 = "SELECT COUNT(*) FROM wp_catalogs";

if (!empty($whereClause)) {
    $consulta2 .= " WHERE " . $whereClause;
}

$value2 = $conexion->query($consulta2)->fetch_array()[0];

$response = array(
    'html' => $html,
    'total' => $value2
);

echo json_encode($response);
$conexion->close();
?>
