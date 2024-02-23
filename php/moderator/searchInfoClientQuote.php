<?php
    require __DIR__ . '/../conexion.php';

    $aid = $_POST['aid'];

    $consulta = "SELECT * FROM wp_cotizacion WHERE cotizacion_id = '$aid'";
    $resultado = $conexion->query($consulta);
    $row = mysqli_fetch_array($resultado);
    $email = $row['cotizacion_id_user'];

    $consulta2 = "SELECT * FROM wp_account WHERE account_correo = '$email'";   
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
                </tr>
            </thead>
            <tbody class='bodyTableForQuote'>
    ";
    
    if ($resultado2->num_rows > 0){
        while ($value = $resultado2->fetch_assoc()) {
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