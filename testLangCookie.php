<?php

if (isset($_GET['lang'])) {
    $language = $_GET['lang'];

    setcookie('language', $language, time() + (86400 * 30), "/");

    header('Location: readLanguage.php');
} else {
    echo "No language.";
}

?>
