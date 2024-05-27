<?php
// Incluir el archivo de traducciones


function translateTextBanner($banner)
{
    require 'translations.php';
    // Include the translations file
    $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'it';
    // Determinar el texto del banner según el idioma
    $banner_text_translation = isset($translations[$language][$banner]) ? $translations[$language][$banner] : $translations['it'][$banner];
    // Incluir el banner.php pasando el texto traducido y el nombre del usuario
    $banner_text = $banner_text_translation;
    return $banner_text;
}