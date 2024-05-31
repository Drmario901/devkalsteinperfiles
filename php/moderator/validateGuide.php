<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../conexion.php';

$guideId = $_POST['guideId'] ?? null; // Verificar si existe guideId en POST

if ($guideId === null) {
  die(json_encode(['status' => 'error', 'message' => 'guideId not provided']));
}

$sqlGuideId = "SELECT guide_user_id, id_guide_slug, user_tag, account_correo FROM wp_guides INNER JOIN wp_account ON wp_guides.guide_user_id = wp_account.account_aid WHERE wp_guides.guide_id = ?";

// Preparar la consulta para evitar inyecciones SQL
$stmtGuideId = $conexion->prepare($sqlGuideId);
$stmtGuideId->bind_param("s", $guideId);
$stmtGuideId->execute();
$resultGuideId = $stmtGuideId->get_result();

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

$response = []; // Array para almacenar los datos de depuración

if ($resultGuideId->num_rows > 0) {
  $row = $resultGuideId->fetch_assoc();
  $guideUserId = $row['guide_user_id'];
  $guideSlug = $row['id_guide_slug'];
  $userTag = $row['user_tag'];
  $correo = $row['account_correo'];

  // Agregar datos de depuración
  $response['guideUserId'] = $guideUserId;
  $response['guideSlug'] = $guideSlug;
  $response['userTag'] = $userTag;
  $response['correo'] = $correo;

  // Preparar la consulta para evitar inyecciones SQL
  $sql_idSlug = $conexion->prepare("SELECT ID_slug FROM tienda_virtual WHERE ID_user = ?");
  $sql_idSlug->bind_param("s", $correo);
  $sql_idSlug->execute();
  $result_idSlug = $sql_idSlug->get_result();

  if ($result_idSlug->num_rows > 0) {
    $rowIdSlug = $result_idSlug->fetch_assoc();
    $idSlug = $rowIdSlug['ID_slug'];

    // Agregar datos de depuración
    $response['idSlug'] = $idSlug;

    // Extraer el último segmento de la URL después del último Slash (/)
    $lastSegmentSlug = basename($idSlug);

    // Eliminar los slashes finales
    $parent_slug = rtrim($lastSegmentSlug, '/');

    // Agregar datos de depuración
    $response['parent_slug'] = $parent_slug;

    // Preparar la segunda consulta
    $sql_postId = $conexion2->prepare("SELECT ID FROM 8x7MM_posts WHERE post_title = ?");
    $sql_postId->bind_param("s", $parent_slug);
    $sql_postId->execute();
    $result_postId = $sql_postId->get_result();

    if ($result_postId->num_rows > 0) {
      $rowPostId = $result_postId->fetch_assoc();
      $parent_post_id = $rowPostId['ID'];

      // Agregar datos de depuración
      $response['parent_post_id'] = $parent_post_id;

      // Preparar la tercera consulta para traer el post con un title igual al slug del guide y el parent_id igual al post_id del parent
      $sql_guidePost = $conexion2->prepare("SELECT * FROM 8x7MM_posts WHERE post_title = ? AND post_parent = ?");
      $sql_guidePost->bind_param("si", $guideSlug, $parent_post_id); // Cambié el tipo del segundo parámetro a "i"
      $sql_guidePost->execute();
      $result_guidePost = $sql_guidePost->get_result();

      if ($result_guidePost->num_rows > 0) {
        $rowGuidePost = $result_guidePost->fetch_assoc();
        $guidePostId = $rowGuidePost['ID'];

        // Agregar datos de depuración
        $response['guidePostId'] = $guidePostId;

        // Preparar la cuarta consulta para actualizar el post con el id del post del guide
        $sql_updateGuidePost = $conexion2->prepare("UPDATE 8x7MM_posts SET post_status = 'publish' WHERE ID = ?");
        $sql_updateGuidePost->bind_param("i", $guidePostId);
        $sql_updateGuidePost->execute();

        $response['status'] = 'correcto';
      } else {
        $response['status'] = 'error';
        $response['message'] = 'No guide post found';
      }
    } else {
      $response['status'] = 'error';
      $response['message'] = 'No parent post found';
    }
  } else {
    $response['status'] = 'error';
    $response['message'] = 'No ID slug found';
  }
} else {
  $response['status'] = 'error';
  $response['message'] = 'No guide found';
}

echo json_encode($response);
?>