<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once __DIR__ . '/../conexion.php';

$artId = $_POST['artId'] ?? null;

if ($artId === null) {
  die(json_encode(['status' => 'error', 'message' => 'artId not provided']));
}

function slug_sanitize($title)
{
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
  $title = strtolower($title);
  $title = preg_replace('/[^a-z0-9\s-]/', '', $title);
  $title = preg_replace('/[\s-]+/', '-', $title);
  $title = trim($title, '-');
  return $title;
}

// Preparar la consulta para obtener el título del artículo
$query = "SELECT * FROM wp_art_blog INNER JOIN wp_account ON wp_art_blog.art_id_user = wp_account.account_aid WHERE art_id = ?";
$stmt = $conexion->prepare($query);
$stmt->bind_param("s", $artId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $artTitle = $row['art_title'];
  $correo = $row['account_correo'];

  $artTitleSlug = slug_sanitize($artTitle);

  // Obtener el ID_slug
  $sql_idSlug = $conexion->prepare("SELECT ID_slug FROM tienda_virtual WHERE ID_user = ?");
  $sql_idSlug->bind_param("s", $correo);
  $sql_idSlug->execute();
  $result_idSlug = $sql_idSlug->get_result();

  if ($result_idSlug->num_rows > 0) {
    $rowIdSlug = $result_idSlug->fetch_assoc();
    $idSlug = $rowIdSlug['ID_slug'];
    $parent_slug = basename(rtrim($idSlug, '/'));

    // Obtener el ID del post padre
    $sql_postId = $conexion2->prepare("SELECT ID FROM 8x7MM_posts WHERE post_title = ?");
    $sql_postId->bind_param("s", $parent_slug);
    $sql_postId->execute();
    $result_postId = $sql_postId->get_result();

    if ($result_postId->num_rows > 0) {
      $rowPostId = $result_postId->fetch_assoc();
      $parent_post_id = $rowPostId['ID'];

      // Obtener el post del blog
      $sql_blogPost = $conexion2->prepare("SELECT * FROM 8x7MM_posts WHERE post_title = ? AND post_parent = ?");
      $sql_blogPost->bind_param("si", $artTitleSlug, $parent_post_id);
      $sql_blogPost->execute();
      $result_blogPost = $sql_blogPost->get_result();

      if ($result_blogPost->num_rows > 0) {
        $rowBlogPost = $result_blogPost->fetch_assoc();
        $post_id = $rowBlogPost['ID'];

        // Actualizar el estado de la publicación
        $sql_blog = $conexion2->prepare("UPDATE 8x7MM_posts SET post_status = 'publish' WHERE ID = ? AND post_parent = ?");
        $sql_blog->bind_param("ii", $post_id, $parent_post_id);
        $sql_blog->execute();

        // Actualizar el estado del artículo a 1
        $updateQuery = "UPDATE wp_art_blog SET id_status = 1 WHERE art_id = ?";
        $updateStmt = $conexion->prepare($updateQuery);
        $updateStmt->bind_param("s", $artId);
        $updateStmt->execute();

        $response = array(
          'status' => 'correcto',
        );
      } else {
        $response = array(
          'status' => 'error',
          'message' => 'No blog post found'
        );
      }
    } else {
      $response = array(
        'status' => 'error',
        'message' => 'No parent post found'
      );
    }
  } else {
    $response = array(
      'status' => 'error',
      'message' => 'No ID slug found'
    );
  }
} else {
  $response = array(
    'status' => 'error',
    'message' => 'No article found'
  );
}

echo json_encode($response);
$conexion->close();
$conexion2->close();
?>