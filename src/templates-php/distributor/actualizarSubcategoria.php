<?php
// Verificar si se recibió una solicitud AJAX y si se envió la categoría
if(isset($_POST['category'])) {
    // Obtener la categoría seleccionada desde la solicitud AJAX
    $selected_category = $_POST['category'];

    // Establecer la conexión a la base de datos
    require __DIR__.'/../../../php/conexion.php';

    // Preparar la consulta SQL para obtener las subcategorías correspondientes a la categoría seleccionada
    $consulta = "SELECT subcategory_description_es FROM wp_categories WHERE categoria_description_es = '$selected_category'";

    // Ejecutar la consulta SQL
    $resultado = $conexion->query($consulta);

    // Verificar si se obtuvieron resultados
    if ($resultado->num_rows > 0) {
        // Crear un array para almacenar las subcategorías
        $subcategories = array();

        // Iterar sobre los resultados y agregar las subcategorías al array
        while ($fila = $resultado->fetch_assoc()) {
            $subcategories[] = $fila['subcategory_description_es'];
        }

        // Devolver las subcategorías como respuesta a la solicitud AJAX
        echo json_encode($subcategories);
    } else {
        // Si no se encontraron subcategorías, devolver un mensaje indicando que no hay resultados
        echo json_encode(array('message' => 'No se encontraron subcategorías'));
    }

    // Cerrar la conexión a la base de datos
    $conexion->close();

    exit; // Terminar la ejecución del script PHP
}
?>
