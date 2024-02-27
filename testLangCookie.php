<?php

//COOKIE IDIOMA
/*if (isset($_GET['lang'])) {
    $language = $_GET['lang'];
    setcookie('language', $language, time() + (86400 * 30), "/");
    
    echo "Language set to: " . $language;
} else {
    
    echo isset($_COOKIE['language']) ? "Language: " . $_COOKIE['language'] : "No language set.";
}

echo "<br/>"; */

//COOKIE PAÍS
if (isset($_GET['country'])) {
    $country = $_GET['country'];
    setcookie('country', $country, time() + (86400 * 30), "/");

    echo "Country set to: " . $country;
} else {
    
    echo isset($_COOKIE['country']) ? "Country: " . $_COOKIE['country'] : "No country set.";
}

?>
