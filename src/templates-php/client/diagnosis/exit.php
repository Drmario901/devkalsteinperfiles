<?php
session_destroy();
unset($_SESSION["user_tag"]);
echo '<script>window.location = "index.php"</script>';
?>