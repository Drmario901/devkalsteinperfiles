<?php

//AJAX IS MANDATORY.

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['lang'])) {
        $language = $_POST['lang'];
        setcookie('language', $language, time() + (86400 * 30), "/");
        echo "Language set to: " . $language . "\n";
    }

    if (isset($_POST['country'])) {
        $country = $_POST['country'];
        setcookie('country', $country, time() + (86400 * 30), "/");
        echo "Country set to: " . $country . "\n";
    }
} else {
    echo "No data received.";
}

?>