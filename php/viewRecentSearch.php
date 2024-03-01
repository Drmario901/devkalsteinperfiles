<?php
    session_start();
    $tags = $_POST['consulta'];
    $categorie = $_POST['consulta2'];

    $_SESSION['searchTags'] = $tags;
    $_SESSION['searchCategorie'] = $categorie;

    echo $tags;
    echo $categorie;