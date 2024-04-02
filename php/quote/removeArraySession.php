<?php
    session_start();
    $aProduct = $_SESSION['productsToQuote'];
    $numItem = $_POST['numItem'];

    $numItem = $numItem - 1;
    unset($aProduct[$numItem]);
    $array = [];
    $Uarray = array_merge((array)$array, (array)$aProduct);

    $_SESSION['productsToQuote'] = $Uarray;

    echo json_encode($Uarray);
   