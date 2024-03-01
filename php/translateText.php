<?php 

function translateText($translationsFile = 'translations.php') {
    // Include the translations file
    include $translationsFile;

    // Get the language from the cookie, default to 'en' if not set
    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

    // Initialize the HTML string
    $html = "<script>";

    // Iterate through translations and create JavaScript to update DOM elements
    foreach ($translations[$lang] as $key => $value) {
        // Update innerText of elements with data-i17n attribute
        $html .= "document.querySelector('[data-i17n=\"$key\"]').innerText = '$value';";
        // Update value of elements with data-i17n attribute (assuming they are input elements)
        $html .= "document.querySelector('[data-i17n=\"$key\"]').value = '$value';";
    }

    // Close the <script> tag
    $html .= "</script>";

    // Output the HTML
    echo $html;
}