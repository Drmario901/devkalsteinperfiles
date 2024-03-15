<?php
        require __DIR__.'/../conexion.php';

        $perPage = 5;
        $page = isset($_GET['i']) ? $_GET['i'] : 1;

        $page = intval($page);

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
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i17n='client:metodoEnvio'>Sending method</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i17n='client:total'>Total (USD)</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i17n='client:fechaTable'>Date</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i17n='client:estatus'>Estatus</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i17n='client:detalles'>Details</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i17n='client:actions'>Actions</th>
                </tr>
            </thead>
            <tbody class='bodyTableForQuote'>
        ";

        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status = 'Process' LIMIT $offset, $limit";

        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {

            while ($row = $resultado->fetch_assoc()) {
                $quoteId = $row['cotizacion_id'];
                $quoteClient = $row['cotizacion_atencion'];
                $quoteEnvio = $row['cotizacion_metodo_envio'];
                $quoteTotal = $row['cotizacion_total'];
                $quoteDate = $row['cotizacion_create_at'];
                $quoteStatus = $row['cotizacion_status'];

                $html .= "
                    <tr id='client-id'>
                        <td id='quote-$quoteId'>$quoteId</td>
                        <td class='customer-name'>$quoteClient</td>
                        <td>$quoteEnvio</td>
                        <td>$quoteTotal</td>
                        <td>$quoteDate</td>
                        <td>$quoteStatus</td>
                        <td>
                            <center>
                                <button type='button' class='fa-solid fa-eye btn-details' style='color: #000 !important; font-size: 12px;' value='$quoteId'></button>
                                </center>
                        </td>
                        <td>
                        <select name='cotizacion_status' class='status-select' style='color: #000 !important;'>
                        <option value='' data-i17n='client:procesado'>Processed</option>
                        <option value='' data-i17n='client:cancelado'>Cancelled</option>
                    </select>
                    <br>
                    <button type='button' class='btn-update' style='color: #000 !important; font-size: 12px; margin: auto;' value='$quoteId'>Change status</button>
                        </td>
                    </tr>";
            }

            $msjNoData = "";
        } else {
            $msjNoData = "
                <tr>
                    <td colspan='9'>
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

        $prevPage = $page > 1? $page - 1 : 1;
        $nextPage = $page + 1;

        $html .= "
            <div class='pagination'>
                <form action='' method='get' style='margin-right: 8px'>
                    <input type='hidden' name='i' value=".($prevPage).">
                    <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:previo'>
                </form>
                <form action='' method='get'>
                    <input type='hidden' name='i' value=".($nextPage).">
                    <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:siguiente'>
                </form>
            </div>
            <input id='hiddenPage' type='hidden' value='$page'>
        ";
            
        echo $html;
    ?>