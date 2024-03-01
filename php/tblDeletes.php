<?php
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require __DIR__ . '/conexion.php';
    $perPage = 10;
    $page = isset($_GET['a']) ? intval($_GET['a']) : 1;

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    $consulta = "SELECT * FROM wp_register_deletes WHERE account_id = '$email' ORDER BY aid_deletes DESC LIMIT $offset, $limit";
    $resultado = $conexion->query($consulta);

    $i = 0;

    include 'translateText.php';
    translateText();

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td scope='col' data-i17n='client:fechaTable'>Fecha</td>
                    <td scope='col' data-i17n='client:horaTable'>Hora</td>
                    <td scope='col' data-i17n='client:actions'>Acciones</td>
                </tr>
            </thead>
            <tbody id='tblDeletesPag' class='bodyTableForQuote'>
    ";

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 01;
            $date = $value['deletes_date'];
            $description = $value['deletes_description'];
            $date = new DateTime($date);
            $fecha = date_format($date, 'Y-m-d');
            $hour = date_format($date, 'H:i A');

            $description = str_replace('has been deleted', 'ha sido eliminado', $description);

            $html.= "                                    
                <tr>
                    <td>$fecha</td>
                    <td>$hour</td>
                    <td>$description</td>
                </tr>
            ";
		}

        $msjNoData = "";
    }else{
        $msjNoData = "
            <div class='contentNoDataQuote'>
                <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
                <p data-i17n='client:dataNotFound'>No se encontraron datos</p>
            </div>
        ";
    }

    $html.= "
            </tbody>
        </table>
        $msjNoData
    ";

    $prevPage = max(1, $page - 1);
    $nextPage = $page + 1;

    $html .= "
        </table>
        <div class='pagination'>
            <div id='currentPageIndicatorDeletes'>Página: $page</div>
            <form id='form-previous-deletes' action='' method='get' style='margin-right: 8px'>
                <input id='previous' type='hidden' name='a' value='$prevPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value=''data-i17n='client:previo'>
            </form>
            <form id='form-next-deletes' action='' method='get'>
                <input id='next' class='next' type='hidden' name='a' value='$nextPage'>
                <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:next'>
            </form>
        </div>
        <input id='hiddenPage' type='hidden' value='$page'>
    ";

    echo $html;
    $conexion->close();