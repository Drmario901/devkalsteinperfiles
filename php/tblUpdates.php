<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start();
    if(isset($_SESSION["emailAccount"])){
        $email = $_SESSION["emailAccount"];
    }

    require __DIR__ . '/conexion.php';

    $perPage = 5;
    $page = isset($_GET['e']) ? intval($_GET['e']) : 1;

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    $consulta = "SELECT * FROM wp_register_updates WHERE account_id = '$email' ORDER BY aid_updates DESC LIMIT $offset, $limit";
    $resultado = $conexion->query($consulta);

    $i = 0;

    include 'translateText.php';
    require_once 'translations.php';
    translateText();
    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

    $statusOf = $translations[$lang]['statusFor'];
    $wasChanged = $translations[$lang]['wasChanged'];
    $accountData = $translations[$lang]['dataAccountUpdated'];
    $passwordUpdated = $translations[$lang]['passwordUpdated'];
    $hasBeenDeleted = $translations[$lang]['hasBeenDeleted'];

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td scope='col' data-i17n='client:fechaTable'>Fecha</td>
                    <td scope='col' data-i17n='client:horaTable'>Hora</td>
                    <td scope='col' data-i17n='client:actions'>Acciones</td>
                </tr>
            </thead>
            <tbody id='tblUpdatesPag'class='bodyTableForQuote'>
    ";

    if ($resultado->num_rows > 0){
        $i = 0;
        while ($value = $resultado->fetch_assoc()) {
            $i = $i + 01;
            $date = $value['updates_date'];
            $description = $value['update_description'];
            $date = new DateTime($date);
            $fecha = date_format($date, 'Y-m-d');
            $hour = date_format($date, 'H:i A');

            $description = str_replace('The status of', $statusOf, $description);
            $description = str_replace('was changed', $wasChanged, $description);
            $description = str_replace('Account data has been updated', $accountData, $description);
            $description = str_replace('Password has been updated', $passwordUpdated, $description);
            $description = str_replace('has been deleted', $hasBeenDeleted, $description);

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
        <div id='currentPageIndicatorUpdates'>Page: $page</div>
        <form id='form-previous-updates' action='' method='get' style='margin-right: 8px'>
            <input id='previous' type='hidden' name='e' value='$prevPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:previo'>
        </form>
        <form id='form-next-updates' action='' method='get'>
            <input id='next' class='next' type='hidden' name='e' value='$nextPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:next'>
        </form>
    </div>
    <input id='hiddenPage' type='hidden' value='$page'>
";

    echo $html;
    $conexion->close();