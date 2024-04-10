<?php
require __DIR__ . '/../conexion.php';
// Define the target directory for uploaded images
$targetDirectory = "/home/kalsteinplus/public_html/dev.kalstein.plus/plataforma/template-editor/assets/img/3d_models/";

/* ini_set('display_errors', 1);
error_reporting(E_ALL); */

// Check if the directory exists, if not try to create it
if (!file_exists($targetDirectory) && !is_dir($targetDirectory)) {
  if (!mkdir($targetDirectory, 0755, true)) {
    die("Failed to create directories...");
  }
}

// Check if the form has been submitted and the file upload doesn't have errors
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["uploadedFile"]) && $_FILES["uploadedFile"]["error"] == 0) {
  $uploadedFile = $_FILES["uploadedFile"];
  $userId = $_POST["userId"];

  // You can add additional validation here (e.g., file size, file type)

  // Create a unique name for the file before saving it to prevent overwriting existing files
  $filename = time() . '_' . basename($uploadedFile["name"]);
  $targetFilePath = $targetDirectory . $filename;

  $pathWeb = 'https://www.dev.kalstein.plus/plataforma/template-editor/assets/img/3d_models/' . $filename;

  // Sql to update table with the image and the status to Listo render_product where the user id match
  $sql = "UPDATE render_product SET resultado_renderP = '$pathWeb', estado = 'Renderizado' WHERE ID_render_P = '$userId'";

  if ($conexion->query($sql) === TRUE) {
    echo "The file has been updated successfully.";
  } else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
  }

  // Attempt to move the uploaded file to your target directory
  if (move_uploaded_file($uploadedFile["tmp_name"], $targetFilePath)) {
    echo "The file has been uploaded successfully.";
  } else {
    echo "There was an error uploading your file.";
  }
} else {
  // Handle error or absence of file upload
  echo "No file uploaded or there was an upload error.";
}

?>