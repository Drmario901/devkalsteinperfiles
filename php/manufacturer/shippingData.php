<?php

    require __DIR__ . '/../conexion.php';
    
    $id = /*$_SESSION['id']*/ 1;
    $c_id = $_POST["consulta"];

    $query = "SELECT * FROM wp_shipping_costs WHERE account_id = '$id' AND country_id = '$c_id'";

    $result = $conexion->query($query);

    $response = array();

    if ($result->num_rows > 0){

        $res = $result->fetch_assoc();

        $caw = $res['aerial_weigth'];
        $cap = $res['aerial_price'];
        $cmp = $res['maritimal'];

        $response = array(
            'caw' => $res['aerial_weigth'],
            'cap' => $res['aerial_price'],
            'cmp' => $res['maritimal']
        );
    }
    
    echo json_encode($response);
?>
