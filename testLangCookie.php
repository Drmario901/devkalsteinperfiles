<?php

//COOKIE IDIOMA
if (isset($_GET['lang'])) {
    $language = $_GET['lang'];

    setcookie('language', $language, time() + (86400 * 30), "/");

    echo "Language: " . $_COOKIE['language'];
} else {
    echo "No country.";
}

//COOKIE PAÍS
if (isset($_GET['country'])) {
    $language = $_GET['country'];

    setcookie('country', $language, time() + (86400 * 30), "/");

    echo "Country: " . $_COOKIE['country'];
} else {
    echo "No country.";
}

?>
