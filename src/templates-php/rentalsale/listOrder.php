<?php 
    session_start(); 
    if (isset($_SESSION['emailAccount'])){
        $email = $_SESSION['emailAccount'];
    }
?>
<header class="header" data-header>
   <?php
        include 'navbar.php';
    ?>
    <script>
        let page = "list-order";
        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>
<br>
<br>
<h2 class="h2 article-title" data-i18n="rentalsale:listOrder">List Order</h2>
<nav class="nav nav-borders">
    <a class="nav-link active" href="https://testing.kalstein.digital/index.php/rentalsale/list-order">All orders</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/list-order/processed">Processed orders</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/list-order/cancelled">Cancelled orders</a>
</nav>

<br>


<div id="listOrderTable" class="table-responsive">
    <?php
        require __DIR__.'/../../../php/conexion.php';

        $perPage = 5;
        $page = isset($_GET['i']) ? $_GET['i'] : 1;

        $page = intval($page);

        $offset = ($page - 1) * $perPage;
        $limit = $perPage;

        $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 50px;'>ID</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;'>Client</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;'>Sending method</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;'>Total (USD)</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Date</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Status</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Details</th>
                    <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;'>Actions</th>
                </tr>
            </thead>
            <tbody class='bodyTableForQuote'>
        ";

        $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_status = 'Process' AND cotizacion_id_remitente = '$email' LIMIT $offset, $limit";


        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {

            while ($row = $resultado->fetch_assoc()) {
                $quoteId = $row['cotizacion_id'];
                $quoteClient = $row['cotizacion_atencion'];
                $quoteClientEmail = $row['cotizacion_id_user'];
                $quoteEnvio = $row['cotizacion_metodo_envio'];
                $quoteTotal = $row['cotizacion_total'];
                $quoteDate = $row['cotizacion_create_at'];
                $quoteStatus = $row['cotizacion_status'];

                $html .= "
                    <tr>
                        <td>$quoteId</td>
                        <td class='customer-name'>$quoteClient $quoteClientEmail</td>
                        <td>$quoteEnvio</td>
                        <td>$quoteTotal</td>
                        <td>$quoteDate</td>
                        <td>$quoteStatus</td>
                        <td>
                            <center>
                                <button type='button' class='fa-solid fa-eye btn-details' style='color: #444 !important; font-size: 16px;' value='$quoteId'></button>
                            </center>
                        </td>
                        <td>
                        <select name='cotizacion_status' class='status-select' style='color: #000 !important;'>
                        <option value=''></option>
                        <option value='Processed'>Processed</option>
                        <option value='Cancelled'>Cancelled</option>
                    </select>
                    <br>
                    <button type='button' class='btn-update' style='color: #000 !important; font-size: 12px; margin: auto;' value='$quoteId'>Change status</button>
                        </td>
                    </tr>
                ";
            }

            $msjNoData = "";
        } else {
            $msjNoData = "
                <tr>
                    <td colspan='9'>
                        <div class='contentNoDataQuote'>
                            <center><span class='material-symbols-rounded icon'>sentiment_dissatisfied</span></center>
                            <center><p style='color: #000;'>No data found</p></center>
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
                    <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Previous'>
                </form>
                <form action='' method='get'>
                    <input type='hidden' name='i' value=".($nextPage).">
                    <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Next &raquo;'>
                </form>
            </div>
            <input id='hiddenPage' type='hidden' value='$page'>
        ";
            
        echo $html;
    ?>
</div>
