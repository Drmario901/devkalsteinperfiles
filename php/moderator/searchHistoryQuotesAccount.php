<?php
    require __DIR__.'../../db/conexion.php';

    $foreignId = $_POST['email'];

    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$foreignId' ORDER BY cotizacion_id DESC";

    $resultado = $conexion->query($consulta);
    $html = '';

    include 'translateText.php';
    translateText();
                    
    if ($resultado->num_rows > 0) {
        $html.='
                <table style="width: 100%;">
                    <thead class="headTableForQuote">
                        <tr>
                            <td scope="col" data-i17n="client:itemTabla">QUO</td>
                            <td data-i17n="client:productQty">Product Qty</td>
                            <td data-i17n="client:fecha">Date</td>
                        </tr>
                    </thead>
                    <tbody class="bodyTableForQuote">';

        while ($row = $resultado->fetch_assoc()) {
            $idQuo = $row['cotizacion_id'];
            $date = $row['cotizacion_create_at'];

            $consulta2 = "SELECT * FROM wp_cotizacion_detalle WHERE cotizacion_detalle_aid = $idQuo";
            $resultado2 = $conexion->query($consulta2);
            $count = mysqli_num_rows($resultado2);

            $html.= '
                    <tr>
                        <td>'.$idQuo.'</td>
                        <td>'.$count.'</td>
                        <td>'.$date.'</td>
                    </tr>';
        }
        $html.=' </tbody>
        </table>';
    }else{
        $html.= '<p data-i17n="client:noCotizaciones">This user has no Quotes</p>';
    }

    echo $html;
?>