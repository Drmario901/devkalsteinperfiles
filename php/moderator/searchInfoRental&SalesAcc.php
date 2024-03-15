<?php
    require __DIR__ . '../../db/conexion.php';

    $consulta2 = "SELECT * FROM wp_account WHERE account_rol_aid = '5' ORDER BY account_aid DESC";   
    $resultado2 = $conexion->query($consulta2);

    include 'translateText.php';
    translateText();

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td scope='col' data-i17n='client:correo'>Correo</td>
                    <td data-i17n='client:nombre'>Nombre</td>
                    <td data-i17n='client:apellido'>Apellido</td>
                    <td data-i17n='client:pais'>País</td>
                    <td data-i17n='client:telefono'>Teléfono</td>
                </tr>
            </thead>
            <tbody class='bodyTableForQuote'>
    ";
    
    if ($resultado2->num_rows > 0){
        while ($value = $resultado2->fetch_assoc()) {
            $email = $value['account_correo'];
            $name = $value['account_nombre'];
            $lastname = $value['account_apellido'];
            $phone = $value['account_telefono'];
            $country = $value['account_pais'];

            $consulta3 = "SELECT * FROM wp_paises WHERE iso = '$country'";
            $result = $conexion->query($consulta3);
            $row2 = mysqli_fetch_array($result);
            $pais = $row2['es'];

            $html.= "                                    
                    <tr>
                        <td>$email</td>
                        <td>$name</td>
                        <td>$lastname</td>
                        <td>$pais</td>
                        <td>$phone</td>
                    </tr>
                ";
        }
    }else {
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

    echo $html;
    $conexion->close();