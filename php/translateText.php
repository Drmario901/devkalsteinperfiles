<?php 

function translateText($translationsFile = 'translations.php') {
    // Include the translations file
    include $translationsFile;

    // Get the language from the cookie, default to 'en' if not set
    $lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

    // Check if the translations for the selected language exist
    if (!isset($translations[$lang])) {
        // If translations do not exist for the selected language, stop the function
        return;
    }

    // Initialize the HTML string
    $html = "<script>";

    // Iterate through translations and create JavaScript to selectively update DOM elements
    foreach ($translations[$lang] as $key => $value) {
        // Safely add the translation value, escaping single quotes
        $safeValue = str_replace("'", "\\'", $value);
    
        // Update elements with data-i17n attribute
        $html .= "var elements = document.querySelectorAll('[data-i17n=\"$key\"]');";
        $html .= "elements.forEach(function(element) {";
        $html .= "if (element.tagName === 'INPUT' || element.tagName === 'SELECT' || element.tagName === 'TEXTAREA') {";
        $html .= "element.value = '$safeValue';";
        $html .= "} else if (element.hasAttribute('placeholder')) {"; // Check for placeholder attribute
        $html .= "element.setAttribute('placeholder', '$safeValue');"; // Set placeholder value
        $html .= "} else {";
        $html .= "element.innerText = '$safeValue';";
        $html .= "}";
        $html .= "});";
    }

    // Close the <script> tag
    $html .= "</script>";

    // Output the HTML
    echo $html;
}