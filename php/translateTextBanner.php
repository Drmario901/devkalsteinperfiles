<?php 
// Incluir el archivo de traducciones
require __DIR__. '/../../../php/translations.php';

function translateTextBanner($banner) {
    // Include the translations file
    $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
    // Determinar el texto del banner según el idioma
    $banner_text_translation = isset($translations[$language][$banner]) ? $translations[$language][$banner] : $translations['en'][$banner];
    // Incluir el banner.php pasando el texto traducido y el nombre del usuario
    $banner_text = $banner_text_translation;
    return $banner_text;
}