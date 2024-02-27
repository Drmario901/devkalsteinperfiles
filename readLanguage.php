<?php

if(isset($_COOKIE['language'])) {
    $language = $_COOKIE['language'];

    switch ($language) {
        case 'es':
            echo "The selected language is Spanish.";
            break;
        case 'en':
            echo "The selected language is English.";
            break;
        default:
            echo "Language is not recognized.";
    }
} else {
    echo "No language cookie was set.";
}
?>
