<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require __DIR__ . '/../conexion.php';

    include 'translateText.php';
    translateText();


    $cate = $conexion->real_escape_string($_POST['category']);
    $q = $conexion->real_escape_string($_POST['inputSearch']);

    $whereClause = ""; 

    if (!empty($cate)) {
    $whereClause .= "M_category='$cate'";
    }

    if (!empty($q)) {
    if (!empty($whereClause)) {
        $whereClause .= " AND ";
    }
    $whereClause .= "M_model LIKE '%$q%' OR M_nombre_product LIKE '%$q%'";
    }

    $consulta = "SELECT wp_manuales.M_id, wp_manuales.M_nombre_product, wp_manuales.M_pdf, wp_k_products.product_image 
                FROM wp_manuales 
                INNER JOIN wp_k_products ON wp_manuales.m_model = wp_k_products.product_model";

    if (!empty($whereClause)) {
    $consulta .= " WHERE ".$whereClause;
    }

    $consulta .= " ORDER BY wp_manuales.M_nombre_product ASC";

    $resultado = $conexion->query($consulta);

    $html = '
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 mx-auto">
                <div class="row row-cols-1 row-cols-md-4 g-3">';

    if ($resultado->num_rows > 0) {
    while ($value = $resultado->fetch_assoc()) {
        $id = $value['M_id'];
        $nombre = $value['M_nombre_product'];
        $imagen = $value['product_image'];
        $pdf = $value['M_pdf'];

        $html .= "
        <div class='col-12 col-sm-6 col-md-4 col-lg-3 mb-3'>
            <div class='card h-100 mx-2'>
            <img src='$imagen' class='card-img-top' alt='...'>
            <div class='card-body'>
                <center><h5 class='card-title' style='font-size: 16px;'>$nombre</h5></center>
                <center><button class='_df_button' id='book1' source='https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/src/manuals/upload/$pdf'>Vista</button></center>
            </div>
            </div>
        </div>
        ";
    }
    } else {
    $html .= "
        <div class='contentNoDataQuote'>
            <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
            <center><p style='color: #000;' data-i17n='client:dataNotFound' >No data found</p></center>
        </div>
    ";
    }

    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';
    $html .= '</div>';

    echo $html;
    $conexion->close();
?>
