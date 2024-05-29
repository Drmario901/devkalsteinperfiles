<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../conexion.php';

$artId = $_POST['artId'];

function slug_sanitize($title)
{
  // Convertir caracteres acentuados a sus equivalentes sin acento
  $unwanted_array = array(
    'á' => 'a',
    'é' => 'e',
    'í' => 'i',
    'ó' => 'o',
    'ú' => 'u',
    'Á' => 'a',
    'É' => 'e',
    'Í' => 'i',
    'Ó' => 'o',
    'Ú' => 'u',
    'ñ' => 'n',
    'Ñ' => 'n'
  );
  $title = strtr($title, $unwanted_array);

  // Convertir a minúsculas
  $title = strtolower($title);

  // Eliminar caracteres no permitidos
  $title = preg_replace('/[^a-z0-9\s-]/', '', $title);

  // Reemplazar espacios y guiones múltiples con un solo guión
  $title = preg_replace('/[\s-]+/', '-', $title);

  // Eliminar guiones al principio y al final
  $title = trim($title, '-');

  return $title;
}

$query = "SELECT * FROM wp_art_blog WHERE art_id = '$artId'";
$result = $conexion->query($query);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $artTitle = $row['art_title'];
}

$slugTitle = slug_sanitize($artTitle);

$queryToValidate = "UPDATE 8x7MM_posts SET post_status = 'publish' WHERE post_name = '$slugTitle'";
$resultToValidate = $conexion2->query($queryToValidate);

if ($resultToValidate) {
  $response = array(
    'status' => 'correcto',
  );
} else {
  $response = array(
    'status' => 'error',
  );
}

echo json_encode($response);
$conexion->close();