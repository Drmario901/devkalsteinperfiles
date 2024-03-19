<?php
    require_once __DIR__ . '/../../db/conexion.php';

    $perPage = 5;
    $page = isset($_POST['page']) ? $_POST['page'] : 1;

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    include 'translateText.php';
    translateText();

    $html = "
    <table class='table custom-table'>
        <thead class='headTableForQuote'>
            <tr>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 50px;'>ID</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i17n='client:cliente'>Client</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i17n='client:metodoEnvio'>Send method</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i17n='client:model'>Product name</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 100px;' data-i17n='client:model'>Model</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 80px;'  data-i17n='client:cantidad'>Quantity</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 100px;' data-i17n='client:estatus'>Status</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 100px;' data-i17n='client:imagen'>Image</th>
                <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i17n='client:fecha'>Date</th>
            </tr>
        </thead>
        <tbody class='bodyTableForQuote'>
    ";


    $consulta = "SELECT c.*, cd.*
                FROM wp_cotizacion c
                INNER JOIN wp_cotizacion_detalle cd ON c.cotizacion_id = cd.cotizacion_detalle_id
                WHERE c.cotizacion_status = 'Processed'
                LIMIT $offset, $limit";

    $resultado = $conexion->query($consulta);

    if ($resultado->num_rows > 0) {
        $quotes = array();

        while ($row = $resultado->fetch_assoc()) {
            $quoteId = $row['cotizacion_id'];
            $quoteClient = $row['cotizacion_atencion'];
            $quoteStatus = $row['cotizacion_status'];
            $quoteDate = $row['cotizacion_create_at'];

            if (!isset($quotes[$quoteId])) {
                $quote = array(
                    'id' => $quoteId,
                    'client' => $quoteClient,
                    'status' => $quoteStatus,
                    'date' => $quoteDate,
                    'products' => array()
                );
                $quotes[$quoteId] = $quote;
            }
            
            $quoteSendMethod = $row['cotizacion_metodo_envio'];
            $quoteProductName = $row['cotizacion_detalle_name'];
            $quoteProductModel = $row['cotizacion_detalle_model'];
            $quoteProductQuantity = $row['cotizacion_detalle_cant'];
            $quoteProductImage = $row['cotizacion_detalle_image'];

            $quoteProduct = array(
                'sendMethod' => $quoteSendMethod,
                'name' => $quoteProductName,
                'model' => $quoteProductModel,
                'quantity' => $quoteProductQuantity,
                'image' => $quoteProductImage
            );

            $quotes[$quoteId]['products'][] = $quoteProduct;
        }

        foreach ($quotes as $quoteId => $quote) {
            $quoteClient = $quote['client'];
            $quoteStatus = $quote['status'];
            $quoteDate = $quote['date'];
            $quoteProducts = $quote['products'];

            $html .= "
                <tr>
                    <td rowspan='" . count($quoteProducts) . "'>$quoteId</td>
                    <td rowspan='" . count($quoteProducts) . "' id='customerName'>$quoteClient</td>";

            $firstProduct = true;
            foreach ($quoteProducts as $index => $product) {
                $quoteSendMethod = $product['sendMethod'];
                $quoteProductName = $product['name'];
                $quoteProductModel = $product['model'];
                $quoteProductQuantity = $product['quantity'];
                $quoteProductImage = $product['image'];

                if (!$firstProduct) {
                    $html .= "<tr>";
                }

                $html .= "
                            <td>$quoteSendMethod</td>
                            <td>$quoteProductName</td>
                            <td>$quoteProductModel</td>
                            <td>$quoteProductQuantity</td>
                            <td>$quoteStatus</td>
                            <td>
                                <img src='$quoteProductImage' alt='Product Image' style='max-width: 100px;'>
                            </td>
                            <td>$quoteDate</td>
                        ";

                $html .= "
                        </tr>
                    ";

                $firstProduct = false;
            }
        }

        $msjNoData = "";
    } else {
        $msjNoData = "
            <tr>
                <td colspan='8'>
                    <div class='contentNoDataQuote'>
                        <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
                        <center><p style='color: #000;' data-i17n='client:dataNotFound'>No data found</p></center>
                    </div>
                </td>
            </tr>
        ";
    }

    $html .= "
        </tbody>
    </table>
    $msjNoData
    ";

    $prevPage = $page - 1;
    $nextPage = $page + 1;

    $html .= "
    <div class='pagination'>
    <a id='prevPage' class='page-link' data-i17n='client:previo'>&laquo; Previous </a>
    <a id='nextPage' class='page-link' data-i17n='client:next'>Next &raquo; </a>
    </div>
    ";

    echo $html;
    $conexion->close();
?>
