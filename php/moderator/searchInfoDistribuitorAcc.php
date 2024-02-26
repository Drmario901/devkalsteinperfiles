<?php
    require __DIR__ . '/../conexion.php';

    $consulta2 = "SELECT * FROM wp_account WHERE account_rol_aid = '2' ORDER BY account_aid DESC";   
    $resultado2 = $conexion->query($consulta2);

    $html = "
        <table class='table custom-table'>
            <thead class='headTableForQuote'>
                <tr>
                    <td scope='col'>Correo</td>
                    <td>Nombre</td>
                    <td>Apellido</td>
                    <td>País</td>
                    <td>Teléfono</td>
                    <td>Tipo de cliente</td>
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

            $consulta4 = "SELECT * FROM wp_cotizacion WHERE cotizacion_id_user = '$email'";
            $result2 = $conexion->query($consulta4);
            $count3 = mysqli_num_rows($result2);
            $row3 = mysqli_fetch_array($result2);
            $statusQuote = $row3['cotizacion_status'];

            if ($count3 > 0){
                if ($statusQuote == 0 || $statusQuote == 1){
                    $html.= "                                    
                        <tr>
                            <td>$email</td>
                            <td>$name</td>
                            <td>$lastname</td>
                            <td>$pais</td>
                            <td>$phone</td>
                            <td>R3A</td>
                        </tr>
                    ";
                }else{
                    $html.= "                                    
                        <tr>
                            <td>$email</td>
                            <td>$name</td>
                            <td>$lastname</td>
                            <td>$pais</td>
                            <td>$phone</td>
                            <td>R3A</td>
                        </tr>
                    ";
                }
            }else{
                $html.= "                                    
                    <tr>
                        <td>$email</td>
                        <td>$name</td>
                        <td>$lastname</td>
                        <td>$pais</td>
                        <td>$phone</td>
                        <td>R2</td>
                    </tr>
                ";   
            }
        }
    }else {
        $msjNoData = "
            <div class='contentNoDataQuote'>
                <i class='fa-regular fa-face-frown' style='font-size: 2em;'></i>
                <p>No se encontraron datos</p>
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