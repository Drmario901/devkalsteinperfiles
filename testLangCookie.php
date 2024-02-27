<?php

if (isset($_GET['lang']) && isset($_GET['country'])) {
    $language = $_GET['lang'];
    $country = $_GET['country'];

    setcookie('language', $language, time() + (86400 * 30), "/");
    setcookie('country', $country, time() + (86400 * 30), "/");

    echo "Language set to: " . $language;
    echo "<br/>";
    echo "Country set to: " . $country;
} else {
    echo isset($_COOKIE['language']) ? "Language: " . $_COOKIE['language'] : "No language set.";
    echo "<br/>";
    echo isset($_COOKIE['country']) ? "Country: " . $_COOKIE['country'] : "No country set.";
}

?>
