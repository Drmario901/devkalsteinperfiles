<?php
require '../db/conexion.php';

if(isset($_POST['valor'])) {
    $discountCode = $_POST['valor'];

    $sql = "SELECT * FROM wp_discount_codes WHERE dc_serial = '$discountCode' AND dc_use = 0";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
        $updateSql = "UPDATE wp_discount_codes SET dc_use = 1 WHERE dc_serial = '$discountCode'";
        $conexion->query($updateSql);

        echo json_encode(array("status" => 'validado'));
    } else {
        echo json_encode(array("status" => 'error'));
    }
}
?>
