<?php

    //TABLE
    session_start();
    require __DIR__.'/../conexion.php';


    // POSTS

    $response = array();

    $page = isset($_POST['page']) ? $_POST['page'] : 2;
    $page = intval($page);
    $perPage = $_POST['per_page'];
    $type = $_POST['type'];
    $search_term = $_POST['search_term'];

    // TOTAL COUNT

    $queryAll = "SELECT COUNT(*) count FROM wp_mod_log WHERE 1 ";

    if ($type != 'all' && $type != ''){
        $queryAll .= "AND type = '$type'";
    }
    if ($search_term != ''){
        $queryAll .= "AND (moder LIKE '%$search_term%' OR meta LIKE '%$search_term%' OR extra LIKE '%$search_term%')";
    }

    $resultAll = $conexion->query($queryAll);
    
    if(($All = $resultAll->fetch_assoc()['count']) != null){
        if ($All <= ($page - 1) * $perPage){
            $page = intdiv($All, $perPage) + ($All % $perPage > 0 ? 1 : 0);
        }
        $page = max(intval($page), 1);
    }

    // PAGINATION LIMITS 

    $offset = ($page - 1) * $perPage;
    $limit = $perPage;

    // FILTERS

    $query = "SELECT * FROM wp_mod_log WHERE 1 ";

    if ($type != 'all' && $type != ''){
        $query .= "AND type = '$type'";
    }
    if ($search_term != ''){
        $query .= "AND (moder LIKE '%$search_term%' OR receptor LIKE '%$search_term%' OR meta LIKE '%$search_term%' OR extra LIKE '%$search_term%')";
    }
    
    $query .= "ORDER BY date DESC";
    // $response['query'] = $query;
    $result = $conexion->query($query);

    include '../translateText.php';
    translateText();

    // TABLE PRINT

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td data-i17n='client:itemTabla'>Item</td>
                    <td data-i17n='client:cliente'>Log ID</td>
                    <td data-i17n='client:moderador'>Moderator</td>
                    <td data-i17n='client:account'>Account</td>
                    <td data-i17n='client:tipo'>Type</td>
                    <td data-i17n='client:info'>Info</td>
                    <td data-i17n='client:extraInfo'>Extra. info</td>
                    <td data-i17n='client:fechaTable'>Date</td>
                </tr>
            </thead>
            <tbody id='tblQuoteClientBody' class='bodyTableForQuote'>
    ";

    if ($result->num_rows > 0){

        $i = ($page - 1) * $perPage;
        
        while ($value = $result->fetch_assoc()) {
            $i = $i + 1;
            $id = $value["ID"];
            $mod = $value["moder"];
            $rec = $value["receptor"];
            $type = $value["type"];
            $meta = $value["meta"];
            $extra = $value["extra"];
            $date = $value["date"];

            $date = new DateTime($date);
            $d = date_format($date, 'M/d/Y');
            $h = date_format($date, 'H:i a');

            $html.= "                                    
                <tr>
                    <td>$i</td>
                    <td>$id</td>
                    <td>$mod</td>
                    <td>$rec</td>
                    <td>$type</td>
                    <td>$meta</td>
                    <td>$extra</td>
                    <td>$d<br>$h</td>
                </tr>
            ";
        }

        $msjNoData = "";
    } else {
        $msjNoData = "
            <div class='contentNoDataQuote'>
                <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
                <p data-i17n='client:noDataFound'>No data found</p>
            </div>
        ";
    }

    $html.= "
            </tbody>
        </table>
        $msjNoData
    ";

    $response['rows'] = $resultsArray;
    $response['html'] = $html;
    $response['page'] = $page;
    $response['hide_prev'] = $page == 1;
    $response['hide_next'] = $page * $perPage >= $All;

    echo json_encode($response);
    $conexion->close();
?>