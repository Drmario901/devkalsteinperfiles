<?php
    require __DIR__.'/../conexion.php';

    if (isset($_POST['report_id'])){


        $foreignId = $_POST['report_id'];

        $consulta = "SELECT * FROM wp_reportes WHERE R_id = $foreignId";

        $resultado = $conexion->query($consulta);

        if ($resultado->num_rows > 0) {

            $reports = array();

            while ($row = $resultado->fetch_assoc()) {
                $category = $row['R_category'];
                $model = $row['R_product'];
                $description= $row['R_Description'];
                $agente = $row['R_agente_soporte'];
                $solucion = $row['R_observacion'];

                $report = array(
                    "R_category" => $category,
                    "R_product" => $model,
                    "R_description"=>$description,
                    "R_agente" => $agente,
                    "R_solucion" => $solucion
                );

                array_push($reports, $report);
            }
        }
    }
    
    echo json_encode($reports);
?>
