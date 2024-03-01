<?php

function validate($name ,$model  ,$brand ,$condition ,$description, $category, $fileInput, $stock, $status, $weight, $length, $width, $height, $weight_pa, $length_pa, $width_pa, $height_pa, $pa_type, $price, $currency, $dontimage){
    $err_msg = "";

    // Verificaciones de campos vacíos
    $required_fields = [
        'name' => 'Name',
        'model' => 'Model',
        'brand' => 'Brand',
        'condition' => 'Condition',
        'description' => 'Description',
        'category' => 'Category',
        'stock' => 'Stock',
        'weight' => 'Weight',
        'length' => 'Length',
        'width' => 'Width',
        'height' => 'Height',
        'weight_pa' => 'Packing weight',
        'length_pa' => 'Packing length',
        'width_pa' => 'Packing width',
        'height_pa' => 'Packing height',
        'pa_type' => 'Packing type',
        'status' => 'Status',
        'price' => 'Unit price',
        'currency' => 'Currency'
    ];

    foreach ($required_fields as $field => $label) {
        if (empty($$field)) {
            $err_msg = "$label is empty";
            break;
        }
    }

    // Verificaciones de valores negativos
    $numeric_fields = [
        'stock' => 'Stock',
        'price' => 'Unit price',
        'weight' => 'Weight',
        'length' => 'Length',
        'width' => 'Width',
        'height' => 'Height',
        'weight_pa' => 'Packing weight',
        'length_pa' => 'Packing length',
        'width_pa' => 'Packing width',
        'height_pa' => 'Packing height'
    ];

    foreach ($numeric_fields as $field => $label) {
        if (floatval($$field) < 0) {
            $err_msg = "$label cannot be less than 0";
            break;
        }
    }

    // Validación de longitud de nombre
    if (strlen($name) >= 50) {
        $err_msg = 'Name cannot be greater than 50 characters';
    } elseif (!$dontimage) {
        // Validación de imagen solo si no se elige no actualizarla
        $maxSize = 10 * 1024 * 1024; // 10 MB
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = strtolower(pathinfo($fileInput['name'], PATHINFO_EXTENSION));

        if ($fileInput['size'] > $maxSize) {
            $err_msg = 'The file size exceeds the limit of 10 MB.';
        } elseif (!in_array($fileExtension, $allowedExtensions)) {
            $err_msg = 'Only JPG, PNG, and JPEG files are allowed.';
        }
    }

    return $err_msg ?: true;
}

if (isset($_FILES['fileName'])) {
    $file = $_FILES['fileName'];

    $fileName = $_FILES['fileName']['name'];
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);
    $newName = uniqid() . "." . $extension;
    $path = __DIR__ . '/../../../../uploads/kalsteinQuote/';
    $uploadFile = $path . basename($newName);

    $uploadName = 'https://testing.kalstein.digital/wp-content/uploads/kalsteinQuote/' . $newName;
} else {
    $file = '';
}

$dontimage = isset($_POST['dontUpdateImg']);

$datos = array();

$pName = $_POST['name'];
$pModel = $_POST['model'];
$pBrand = $_POST['brand'];
$pCondition = $_POST['condition'];
$pDescription = $_POST['description'];
$pCategory = $_POST['category'];
$pStock = $_POST['stock'];
$pStatus = $_POST['status'];

$pDescription = nl2br($pDescription);

$pWe = $_POST['we'];
$pWi = $_POST['wi'];
$pHe = $_POST['he'];
$pLe = $_POST['le'];

$pWePa = $_POST['we_pa'];
$pWiPa = $_POST['wi_pa'];
$pHePa = $_POST['he_pa'];
$pLePa = $_POST['le_pa'];
$pPType = $_POST['pa_type'];

$pPrice = $_POST['price'];
$pCurrency = $_POST['currency'];

if ($_FILES['manual'] != '') {
    $manual = $_FILES['manual'];

    $manualName = $_FILES['manual']['name'];
    $manualExtension = pathinfo($manualName, PATHINFO_EXTENSION);
    $newManualName = uniqid() . "." . $manualExtension;
    $manualPath = __DIR__ . '/../../src/manuals/upload/';
    $uploadManualFile = $manualPath . basename($newManualName);

    $wp_manual_name = pathinfo($manualName, PATHINFO_FILENAME);
} else {
    $manual = '';
    $newManualName = '';
}

if ($_FILES['catalog'] != '') {
    $catalog = $_FILES['catalog'];

    $catalogName = $_FILES['catalog']['name'];
    $catalogExtension = pathinfo($catalogName, PATHINFO_EXTENSION);
    $newCatalogName = uniqid() . "." . $catalogExtension;
    $catalogPath = __DIR__ . '/../../src/manuals/upload/';
    $uploadCatalogFile = $catalogPath . basename($newCatalogName);

    $wp_catalog_name = pathinfo($catalogName, PATHINFO_FILENAME);
} else {
    $catalog = '';
    $newCatalogName = '';
    $wp_catalog_name = '';
}

$val = validate($pName, $pModel, $pBrand, $pCondition, $pDescription, $pCategory, $file, $pStock, $pStatus,
    $pWe, $pLe, $pWi, $pHe,
    $pWePa, $pLePa, $pWiPa, $pHePa, $pPType,
    $pPrice, $pCurrency, $dontimage);

if ($val !== true) {
    echo "Validation Error: $val";
} else {
 
}
?>
