<?php
    require_once '../../db/conexion.php';


    if (isset($_POST['delete_aid'])) {
        $deleteAid = $_POST['delete_aid'];
        $deleteQuery = "DELETE FROM wp_k_products_add WHERE p_aid = '$deleteAid'";
        $deleteResult = $conexion->query($deleteQuery);
        if ($deleteResult) {
            echo "<script>
                    iziToast.success({
                        title: 'Success',
                        message: 'Record with ID $deleteAid deleted successfully.',
                        position: 'topRight'
                    });
                </script>";
        } else {
            echo "<script>
                    iziToast.error({
                        title: 'Error',
                        message: 'Failed to delete record with ID $deleteAid: ".$conexion->error."',
                        position: 'topRight'
                    });
                </script>";
        }
    }

    $consulta = "SELECT * FROM wp_k_products_add";
    $resultado = $conexion->query($consulta);

    $i = 0;

    include 'translateText.php';
        translateText();

    $html = "
        <table class='table custom-table'>
        <thead class='headTableForQuote'>
            <tr>
            <td class='fw-bold' style='background-color: #213280; color: white;' >ID</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:nombre'>Name</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:descripcion'>Description</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:categoria'>Category</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:peso'>Weight</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:inventario'>Stock</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:largo'>Length</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:ancho'>Width</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:alto'>Height</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:estatus'>Status</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:precio'>Price ($)</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:image'>Image</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:fechaTable'>Date</td>
            <td class='fw-bold' style='background-color: #213280; color: white;' data-i17n='client:eliminar'>Delete</td>
            </tr>
        </thead>
        <tbody class='bodyTableForQuote'>
        ";

    if ($resultado->num_rows > 0) {
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 1;
            $id = $value['p_aid'];
            $name = $value['product_name'];
            $description = $value['product_description'];
            $category = $value['category'];
            $weight = $value['product_weight'];
            $stock = $value['stock'];
            $length = $value['product_length'];
            $width = $value['product_width'];
            $height = $value['product_height'];
            $status = $value['product_status'];
            $price = $value['product_price'];
            $image = $value['product_image'];
            $date = $value['product_date'];


            $html .= "
                    <tr>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$description</td>
                        <td>$category</td>
                        <td class='fw-bold'>$weight</td>
                        <td>$stock</td>
                        <td>$length</td>
                        <td>$width</td>
                        <td>$height</td>
                        <td>$status</td>
                        <td>$price $</td>
                        <td><button class='material-symbols-rounded'  id='btnView' value='$image'>preview</button><brdata-i17n='client:see'>View</br></td>
                        <td>$date</td>
                        <td><button class='material-symbols-rounded'  id='btnDeleteProduct' value='$id' data-i17n='client:eliminar'>delete</button></td>
                    </tr>
                ";
        }

        $msjNoData = "";
    } else {
        $msjNoData = "
                <div class='contentNoDataQuote'>
                <center><span class='material-symbols-rounded  icon'>sentiment_dissatisfied</span></center>
                    <center><p style='color: #000;' data-i17n='client:dataNotFound'>No data found</p></center>
                </div>
            ";
    }

    $html .= "
                </tbody>
            </table>
            $msjNoData
        ";

    echo $html;
    $conexion->close();
?>