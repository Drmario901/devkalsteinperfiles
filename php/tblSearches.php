<?php
session_start();
if (isset($_SESSION["emailAccount"])) {
    $email = $_SESSION["emailAccount"];
}

$perPage = 10;
$page = isset($_GET['o']) ? intval($_GET['o']) : 1;

$offset = ($page - 1) * $perPage;
$limit = $perPage;

require_once __DIR__ . '/../db/conexion.php';

$consulta = "SELECT * FROM wp_register_searches WHERE account_id = '$email' ORDER BY aid_searches DESC LIMIT $offset, $limit";
$resultado = $conexion->query($consulta);

$i = ($page - 1) * $perPage;

include 'translateText.php';
translateText();

$html = "
    <table class='table custom-table'>
        <thead class='headTableForQuote'>
            <tr>
                <td scope='col' data-i17n='client:itemTabla'>Item</td>
                <td scope='col' data-i17n='client:fechaTable'>Fecha</td>
                <td scope='col' data-i17n='client:horaTable'>Hora</td>
                <td scope='col' data-i17n='client:buscador'>Buscador</td>
                <td scope='col' data-i17n='client:seeTable'>Ver</td>
            </tr>
        </thead>
";

if ($resultado->num_rows > 0) {
    $html .= "<tbody id='tblSearchPag' class='bodyTableForQuote'>";

    while ($value = $resultado->fetch_assoc()) {
        $i++;
        $date = $value['searches_date'];
        $description = $value['searches_description'];
        $categorie = $value['searches_categorie'];
        $date = new DateTime($date);
        $fecha = date_format($date, 'Y-m-d');
        $hour = date_format($date, 'H:i A');

        if ($description == ''){
            $description2 = 'Todas';
        }else{
            $description2 = $description;
        }

        $html .= "                                    
            <tr>
                <td class='fw-bold'>$i</td>
                <td>$fecha</td>
                <td>$hour</td>
                <td>$description2</td>
                <td><Button value='$i' id='btnViewSearch' style='margin: 0 auto; color: green;'><i class='fa-solid fa-up-right-from-square'></i></Button><button style='display: none;' id='btnDescriptionViewSearch-$i' value='$description'></button><button style='display: none;' id='btnCategorieViewSearch-$i' value='$categorie'></button></td>
            </tr>
        ";
    }
    
    $msjNoData = "";
} else {
    $msjNoData = "
        <div class='contentNoDataQuote'>
            <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
            <p data-i17n='client:dataNotFound'>No se encontraron datos</p>
        </div>
    ";
}

$html .= "$msjNoData";
$html .= "</tbody>";

$prevPage = max(1, $page - 1);
$nextPage = $page + 1;

$html .= "
    </table>
    <div class='pagination'>
        <div id='currentPageIndicatorSearch'>Page: $page</div>
        <form id='form-previous-search' action='' method='get' style='margin-right: 8px'>
            <input id='previous' type='hidden' name='o' value='$prevPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value=''
            data-i17n='client:previo'>
        </form>
        <form id='form-next-search' action='' method='get'>
            <input id='next' class='next' type='hidden' name='o' value='$nextPage'>
            <input type='submit' style='color: black !important; border: 1px solid #555 !important' value='' data-i17n='client:next'>
        </form>
    </div>
    <input id='hiddenPage' type='hidden' value='$page'>
";

echo $html;
$conexion->close();
?>
