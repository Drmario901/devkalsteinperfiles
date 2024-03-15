<?php
    require __DIR__.'/../conexion.php';

    $reports = array(); 

    if (isset($_POST['service_id'])) {
        $foreignId = $_POST['service_id'];

        $consulta = "SELECT SE_description FROM wp_servicios WHERE SE_id = ?";
        
        $stmt = $conexion->prepare($consulta);
        $stmt->bind_param("i", $foreignId);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $description = $row['SE_description'];

                $report = array(
                    "SE_descripcion" => $description
                );

                array_push($reports, $report);
            }
        }
    }
    

    echo json_encode($reports);

    $stmt->close();
    $conexion->close();
?>
