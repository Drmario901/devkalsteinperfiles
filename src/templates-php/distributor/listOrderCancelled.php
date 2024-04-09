<div class="container">
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if (isset($_SESSION['emailAccount'])) {
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

    <article class="container article">

        <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);
        $banner_img = 'Header-distribuidor-IMG.jpg';
        $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

        // Incluir el archivo de traducciones
        require __DIR__ . '/../../../php/translations.php';

        // Determinar el texto del banner según el idioma
        $banner_text_translation = isset($translations[$language]['banner_text_cancelled_orders']) ? $translations[$language]['banner_text_cancelled_orders'] : $translations['en']['banner_text_cancelled_orders'];

        // Incluir el banner.php pasando el texto traducido y el nombre del usuario
        $banner_text = $banner_text_translation;
        include __DIR__ . '/../manufacturer/banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/ordenes"
                data-i18n="distribuidor:parrafoOrdenesPend">Órdenes pendientes</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/ordenes/procesadas"
                data-i18n="distribuidor:parrafoOrdenesProcess">Órdenes procesadas</a>
            <a class="nav-link active"
                href="https://dev.kalstein.plus/plataforma/index.php/distribuidor/ordenes/canceladas"
                data-i18n="distribuidor:parrafoOrdenesCancel">Órdenes canceladas</a>
        </nav>

        <br>

        <div id="listOrderTable" class="table-responsive">
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            session_start();
            require __DIR__ . '/../../../php/conexion.php';

            $acc_id = $_SESSION['emailAccount'];

            $perPage = 5;
            $page = isset($_GET['i']) ? $_GET['i'] : 1;

            $page = max(intval($page), 1);

            $queryTotal = "SELECT COUNT(*) FROM wp_cotizacion WHERE (cotizacion_status = 'Cancelled' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id'";
            $All = $conexion->query($queryTotal)->fetch_array()[0];

            if ($All <= ($page - 1) * $perPage) {
                $page = intdiv($All, $perPage) + ($All % $perPage > 0 ? 1 : 0);
            }

            $offset = ($page - 1) * $perPage;
            $limit = $perPage;

            $consulta = "SELECT * FROM wp_cotizacion WHERE (cotizacion_status = 'Cancelled' OR cotizacion_status = '4') AND cotizacion_id_remitente = '$acc_id' ORDER BY cotizacion_create_at DESC LIMIT $offset, $limit";
            $resultado = $conexion->query($consulta);

            $html = "
                <table class='table custom-table'>
                    <thead class='headTableForQuote'>
                        <tr>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 50px;'>ID</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='distribuidor:elementoCliente'>Cliente</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='distribuidor:elementoMetodoEnvio'>Método en envío</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 150px;' data-i18n='distribuidor:elementoTotalUSD'>Total en (USD)</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='distribuidor:elementoFecha'>Fecha</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='distribuidor:elementoEstatus'>Estatus</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='distribuidor:elementoDetalles'>Detalles</th>
                            <th class='fw-bold' style='background-color: #213280; color: white; width: 120px;' data-i18n='distribuidor:elementoVer'>Ver</th>
                        </tr>
                    </thead>
                    <tbody class='bodyTableForQuote'>
                ";

            if ($resultado->num_rows > 0) {

                while ($row = $resultado->fetch_assoc()) {
                    $quoteId = $row['cotizacion_id'];
                    $quoteClient = $row['cotizacion_atencion'];
                    $quoteEnvio = $row['cotizacion_metodo_envio'];
                    $quoteEnvio = str_replace('Aerial', 'Aereo', $quoteEnvio);
                    $quoteEnvio = str_replace('Maritime', 'Maritimo', $quoteEnvio);
                    $quoteTotal = $row['cotizacion_total'];
                    $quoteDate = $row['cotizacion_create_at'];
                    $quoteStatus = $row['cotizacion_status'];
                    $quoteStatus = str_replace('4', 'Cancelado', $quoteStatus);
                    $quoteClientEmail = $row['cotizacion_id_user'];

                    $html .= "
                            <tr>
                                <td>$quoteId</td>
                                <td class='customer-name'>$quoteClient <br> $quoteClientEmail</td>
                                <td>$quoteEnvio</td>
                                <td>$quoteTotal</td>
                                <td>$quoteDate</td>
                                <td>$quoteStatus</td>
                                <td>
                                <button onclick=\"window.open('https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/createPDF.php?idCotizacion=$quoteId', '_blank');\" style='margin: 0 auto; color: green;'><i class='fa-solid fa-up-right-from-square'></i></button>
                                </td>
                                <td>
                                    <center>
                                        <button type='button' class='fa-solid fa-eye btn-details' style='color: #444 !important; font-size: 16px;' value='$quoteId'></button>
                                    </center>
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
                                    <center><p style='color: #000;' data-i18n='distribuidor:parrafoDontHaveData'>No hay datos encontrados</p></center>
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

            $prevPage = $page > 1 ? $page - 1 : 1;
            $nextPage = $page + 1;

            $hiddenPrev = $page == 1 ? 'hidden' : '';
            $hiddenNext = $page * $perPage >= $All ? 'hidden' : '';

            $html .= "
                    <span data-i18n='distribuidor:spanPagina'> Página $page </span>
                    <div class='pagination'>
                        <form action='' method='get' style='margin-right: 8px' $hiddenPrev>
                            <input type='hidden' name='i' value=" . ($prevPage) . ">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='&laquo; Previo'>
                        </form>
                        <form action='' method='get' $hiddenNext>
                            <input type='hidden' name='i' value=" . ($nextPage) . ">
                            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='Próximo &raquo;'>
                        </form>
                    </div>
                    <input id='hiddenPage' type='hidden' value='$page'>
                ";

            echo $html;
            ?>
        </div>
    </article>

    <?php
    $footer_img = 'Footer-distribuidor-IMG.png';
    include 'footer.php';
    ?>
</div>