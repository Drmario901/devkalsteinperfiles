<?php

    require __DIR__ . '../../db/conexion.php';

    $t = $_POST["consulta"];
    $consulta = "SELECT * FROM wp_k_products WHERE product_aid = '$t'";
    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $count = mysqli_num_rows($resultado);
    
     $pBrand = $row["product_brand"];

     if ($count > 0){
        $pName = $row["product_name_es"];
        $pModel = $row["product_model"];
        $pDescription = $row["product_description_es"];
        $pCategory = $row["product_category_es"];
        $pStock = $row["product_stock_units"];
        $pStatus = $row["product_stock_status"];
        $pWe = $row["product_peso_neto"];
        $pWi = $row["product_ancho"];
        $pHe = $row["product_alto"];
        $pLe = $row["product_largo"];
        $pWePa = $row["product_peso_bruto"];
        $pWiPa = $row["product_ancho_paquete"];
        $pHePa = $row["product_alto_paquete"];
        $pLePa = $row["product_largo_paquete"];
        $pPType = $row["wp_product_package_type"];
        $pCurrency = $row["wp_product_currency"];
        $pPrice = $pCurrency == 'USD' ? $row["product_priceUSD"] : $row["product_priceEUR"];
        $discount_1 = $row["wp_product_discount_1"];
        $discount_1_amount = $row["wp_product_discount_1_amount"];
        $discount_2 = $row["wp_product_discount_2"];
        $discount_2_amount = $row["wp_product_discount_2_amount"];
        $image = $row["product_image"];
        $pdf = $row["product_manual"];
        $catalog = $row["product_catalog"];
        $namecatalog = $row["product_catalog_name"];
        $plDescription = $row['product_technical_description_es'];
        $plDescriptionCSV = $row['product_technical_description_csv'];

        $querypdf = "SELECT M_nombre_product FROM wp_manuales WHERE M_pdf = '$pdf'";
        $resultpdf = $conexion->query($querypdf);
        
        $querycatalog = "SELECT catalog_name FROM wp_catalogs WHERE catalog_pdf = '$catalog'";
        $resultcatalog = $conexion->query($querycatalog);

        $resultpdf->num_rows > 0? $namepdf = $resultpdf->fetch_array()[0] : '';
        $resultcatalog->num_rows > 0? $namecatalog = $resultcatalog->fetch_array()[0] : '';
    }else{
        $pName = '';
        $pModel = '';
        $pBrand = '';
        $pDescription = '';
        $pCategory = '';
        $pStock = '';
        $pStatus = '';
        $pWe = '';
        $pWi = '';
        $pHe = '';
        $pLe = '';
        $pWePa = '';
        $pWiPa = '';
        $pHePa = '';
        $pLePa = '';
        $pPType = '';
        $pPrice = '';
        $pCurrency = '';
        $discount_1 = '';
        $discount_1_amount = '';
        $discount_2 = '';
        $discount_2_amount = '';
        $image = '';
        $pdf = '';
        $namepdf = '';
        $catalog = '';
        $namecatalog = '';
        $plDescription = '';
        $plDescriptionCSV = '';
    }
    

    $datos = array(
        'name' => $pName,
        'model' => $pModel,
        'brand' => $pBrand,
        'description' => $pDescription,
        'category' => $pCategory,
        'stock' => $pStock,
        'status' => $pStatus,
        'weight' => $pWe,
        'width' => $pWi,
        'height' => $pHe,
        'length' => $pLe,
        'weight_pa' => $pWePa,
        'width_pa' => $pWiPa,
        'height_pa' => $pHePa,
        'length_pa' => $pLePa,
        'package' => $pPType,
        'price' => $pPrice,
        'currency' => $pCurrency,
        'd1' => $discount_1,
        'd1a' => $discount_1_amount,
        'd2' => $discount_2,
        'd2a' => $discount_2_amount,
        'image' => $image,
        'pdf' => $pdf,
        'namepdf' => $namepdf,
        'catalog' => $catalog,
        'namecatalog' => $namecatalog,
        'lDescr' => $plDescription,
        'lDescrCSV' => $plDescriptionCSV
    ); 

    echo json_encode($datos, JSON_FORCE_OBJECT);
    $conexion->close();

?>
