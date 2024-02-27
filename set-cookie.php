<?php

//AJAX IS MANDATORY
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['lang']) && isset($_POST['country'])) {
        $language = $_POST['lang'];
        $country = $_POST['country'];

        setcookie('language', $language, time() + (86400 * 30), "/");
        setcookie('country', $country, time() + (86400 * 30), "/");

        echo "Language set to: " . $language . "\n";
        echo "Country set to: " . $country . "\n";
    } else {

        echo "Both language and country need to be provided.\n";
    }
} else {

    echo "No POST data received.\n";
}

?>
