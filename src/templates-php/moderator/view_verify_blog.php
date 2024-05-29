<header class="header" data-header>

    <?php
    require __DIR__ . '/../../../php/conexion.php';
    include 'navbar.php';
    if (isset($_GET['artid'])) {
        $artId = $_GET['artid'];
    } else {
        $artId = '';
    }
    ?>
    <script>
        let page = "home";

        document.querySelector('#link-' + page).classList.add("active");
        document.querySelector('#link-' + page).removeAttribute("style");
    </script>
</header>

<style>
    input[type="checkbox"] {
        width: 20px;
        height: 20px;
        border-radius: 12px;
        margin: 0;
    }

    h5,
    p {
        display: flex;
        align-items: center;
        gap: 10px;
        text-align: start;
    }

    h5 {
        font-weight: 700;
    }

    .card-header {
        background-color: white;
    }
</style>

<main>
    <article class="container article">
        <?php

        $sql = "SELECT wp_art_blog.*, wp_art_details.* FROM wp_art_blog INNER JOIN wp_art_details on wp_art_blog.art_id = wp_art_details.art_id WHERE wp_art_blog.art_id = '$artId'";

        $result = $conexion->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $artTitle = $row['art_title'];
            $artDescription = $row['art_principal_description'];
            $artImg = $row['art_img'];
            $artSubtitulo1 = $row['art_subtitle'];
            $artSubtitulo2 = $row['art_subtitle_2'];
            $artSubtitulo3 = $row['art_subtitle_3'];
            $artDescription = $row['art_description'];
            $artDescription2 = $row['art_description_2'];
            $artDescription3 = $row['art_description_3'];

        }

        echo "<h4>Validar artículo</h4>
        <p>Por favor, revisa la información del artículo y marca con un check los datos que sean válidos.</p>
        <div class='card mb-3'>
            <div class='row'>
                <div class='col-md-4 text-sm-start text-md-center'>
                    <h5>
                        <i class='fas fa-pen'></i>
                        Titulo Principal
                        <input class='d-inline' type='checkbox' id='name'>
                    </h5>
                    <h6 class='text-start'>$artTitle</h6>
                    <a TARGET='_blank' href='#'>
                        <img class='my-3 d-flex justify-content-start' style='margin: auto; border: 1px solid #999'
                            width=200 src='$artImg'>
                    </a>

                    <!-- Enlaces o promociones -->
                    <p><label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-a'>
                    </p>

                    <p><label for=''>Image quality</label>
                        <input class='d-inline' type='checkbox' id='quality-a'>
                    </p>

                    <p><label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-a'>
                    </p>

                </div>
                <div class='col-md-8'>
                    <h5>
                        <i class='fas fa-circle-info'></i>
                        Description
                    </h5>
                    <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                        <p style='text-align: justify;'>
                            $artDescription</p>
                    </div>
                    <p>
                        <label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-b'><br>
                    </p>
                    <p>
                        <label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-b'>
                    </p>

                </div>

            </div>
        </div>";

        if (!empty($artSubtitulo1) && !empty($artDescription)) {
            echo "<div class='card mb-3'>
                <div class='row text-sm-start text-md-center'>
                    <h5>
                        <i class='fas fa-pen'></i>
                        Título de extracto #1
                        <input class='d-inline' type='checkbox' id='name-a'>
                    </h5>
                    <h6 class='text-start'>$artSubtitulo1</h6>
                </div>
                <div class='row mt-3'>
                    <h5>
                        <i class='fas fa-circle-info'></i>
                        Description
                    </h5>
                    <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                        <p style='text-align: justify;'>
                        $artDescription.</p>
                    </div>
                    <p>
                        <label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-c'><br>
                    </p>
                    <p>
                        <label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-c'>
                    </p>
                </div>
            </div>";
        }

        if (!empty($artSubtitulo2) && !empty($artDescription2)) {
            echo "<div class='card mb-3'>
                <div class='row text-sm-start text-md-center'>
                    <h5>
                        <i class='fas fa-pen'></i>
                        Título de extracto #2
                        <input class='d-inline' type='checkbox' id='name-b'>
                    </h5>
                    <h6 class='text-start'>$artSubtitulo2</h6>
                </div>
                <div class='row mt-3'>
                    <h5>
                        <i class='fas fa-circle-info'></i>
                        Description
                    </h5>
                    <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                        <p style='text-align: justify;'>
                        $artDescription2.</p>
                    </div>
                    <p>
                        <label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-d'><br>
                    </p>
                    <p>
                        <label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-d'>
                    </p>
                </div>
            </div>";
        }

        if (!empty($artSubtitulo3) && !empty($artDescription3)) {
            echo "<div class='card mb-3'>
                <div class='row text-sm-start text-md-center'>
                    <h5>
                        <i class='fas fa-pen'></i>
                        Título de extracto #3
                        <input class='d-inline' type='checkbox' id='name-c'>
                    </h5>
                    <h6 class='text-start'>$artSubtitulo3</h6>
                </div>
                <div class='row mt-3'>
                    <h5>
                        <i class='fas fa-circle-info'></i>
                        Description
                    </h5>
                    <div class='my-2 p-2' style='border: solid 1px #c9c9c9; borde-radius: 10px'>
                        <p style='text-align: justify;'>
                        $artDescription3.</p>
                    </div>
                    <p>
                        <label for=''>Links or self-promotion</label>
                        <input class='d-inline' type='checkbox' id='promotions-e'><br>
                    </p>
                    <p>
                        <label for=''>Professionalism</label>
                        <input class='d-inline' type='checkbox' id='professionalism-e'>
                    </p>
                </div>
            </div>";
        }

        echo "<textarea class='mx-auto my-2' style='width: 100%; height: 150px;' placeholder='Especifica porqué se está denegando la información' id='message'></textarea>
        <p class='d-flex justify-content-start' id='strikeContainer'>
            <label>Strike</label>
            <input class='d-inline' type='checkbox' id='strike'>
        </p>

        <div id='btnValidate' class='mx-auto'>
            <button type='button' class='btn btn-danger btn-block p-2 px-4 mx-auto'>
                <h4 class='text-white pb-0'>Denegate</h4>
            </button>
        </div>
        <div class='card my-3'>
            <h5>Past warnings</h5>";
        ?>
    </article>
</main>