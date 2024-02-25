<?php
require_once('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $templateHtml = $_POST['template_html'];
    $emailAcc = $_POST['template_mail']; 
    $template_variables = $_POST['template_variables'];
    $cName = $_POST['template_user'];

    // Prepara la consulta para insertar los datos
    $stmt = $conexion->prepare("INSERT INTO wp_customize_template (template_html, template_mail, template_variables, template_user) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $templateHtml, $emailAcc, $template_variables, $cName);

    // Ejecuta la consulta
    if ($stmt->execute() === TRUE) {
        echo "Datos insertados correctamente";
    } else {
        echo "Error al insertar datos: " . $conexion->error;
    }

    // Cierra la conexión y la sentencia
    $stmt->close();
    $conexion->close();
}
?>