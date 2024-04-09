<?php
    header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    session_start();
    if (isset($_SESSION['productsToQuote'])){
        $aProduct = $_SESSION['productsToQuote'];
    }else{
        $aProduct = [];
    }

    echo json_encode($aProduct, JSON_FORCE_OBJECT);