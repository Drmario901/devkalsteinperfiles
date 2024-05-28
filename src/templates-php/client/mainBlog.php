<div id='c-panel20'>
    <style>
        .txt-author{
            font-weight: bold;
        }
        .columna_articulo{
            min-height: 970px;
        }
        .page-link{
            color: #213280 !important;
        }
        .active>.page-link{
            background-color: #213280 !important;
            border-color: #213280 !important;
            color: #fff !important;
        }
        .buton-paginate{
            color: #213280;
            border-color: #213280;
        }
        .buton-paginate:hover{
            background-color: #213280 !important;
            color: #fff;
        }
        #blog_articulos{
            background-color: #213280 !important;
            color: #fff !important;
            padding: 2px 10px;
        }
        #blog_articulos:hover{
            background-color: #2e4f9b !important;
        }
        @media (max-width: 768px) {
            .contenedor_guiasInf {
                grid-template-columns: 100% !important;
                margin: auto !important;
                justify-content: center !important;
                align-items: center !important;
            }

            .contenedor_vistaprevia_guia {
                grid-template-columns: 90% !important;
                margin: auto !important;
                justify-content: center !important;
                align-items: center !important;
            }

            .contenedor-destacadas {
                flex-direction: row !important;
                justify-content: space-evenly !important;
            }
            .contenedor-destacadas h5 {
                font-size: 1.25em;
            }
        }

        @media (max-width: 576px) {
            .footer-guia {
                flex-direction: column;
                align-items: flex-start !important;
            }

            .footer-guia .boton_ver_mas {
                margin-bottom: 10px !important;
            }

            .contenido_articulo .guia_extracto_principal img {
                width: 300px !important;
            }
        }

        @media (max-width: 1200px) {
            .articulos_recientes .contenedor_vistaprevia_guia {
                grid-template-columns: 100% !important;
            }

            .parrafo_extracto_principal {
                font-size: 16px !important;
            }
        }

        @media (max-width: 992px) {

            .contenedor_articulos_tienda {
                grid-template-columns: 100% !important;
            }

            .articulos_recientes {
                display: flex;
                flex-wrap: wrap;
            }

            .articulos_recientes .contenedor_vistaprevia_guia {
                grid-template-columns: auto auto !important;
            }

            .contenedor_artPrin {
                height: 400px !important;
            }

            .contenedor-guiasRecientes .contenedor-guiasRecientes {
                gap: 0 !important;
            }

            .guia_extracto_principal {
                grid-template-columns: 100% !important;
                margin: auto !important;
                justify-content: center !important;
                align-items: center !important;
            }
        }
    </style>

    <?php
        require_once __DIR__ . '/../db/conexion.php';

        $sql = "SELECT * FROM wp_art_blog ORDER BY art_views DESC LIMIT 3";
        $resultado = $conexion->query($sql);
    ?>

    <div id="seccion_blog" display="none">
        <div class="contenedor_patron_css">
            <main class="contenedor_principal">
                <div class="contenedor_guiasInf"
                    style="display: grid; grid-template-columns: 2fr 1fr; gap: 2em; margin: auto; max-width: 1140px; margin-top: 20px;">
                    <div class="columna_principal_guias">
                        <div class='columna_articulo' id='container_blogs'>

                        </div>
                        <div class='container-paginado'>
                            <div style="display: flex; justify-content:center; gap:1rem;">
                                <button id="boton-prev" class="btn btn-outline-primary buton-paginate" aria-label="Previous" >
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </button>
                                <ul id="paginado" class="pagination" >
                            
                                </ul>                
                                <button id="boton-next" class="btn btn-outline-primary buton-paginate" aria-label="Next" >
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </button>
                            </div>
                        </div>                        
                    </div>
                    <div class="columna_secundaria_guias">
                        <h4 class="titulo_destacados" style="font-family: Montserrat; font-weight: 600;">Artículos destacados
                        </h4>
                        <div class="contenedor-destacadas" style="display: flex; flex-direction: column; gap: 20px; margin: 10px 0">
                        <?php
                            if ($resultado->num_rows > 0){
                                while($fila = $resultado->fetch_assoc()) {
                                    $id = $fila['art_id_user'];
                                    $sql = "SELECT * FROM wp_account WHERE account_aid = '$id'";
                                    $resultado = $conexion->query($sql);
                                    $row = mysqli_fetch_array($resultado);
                                    $correo = $row['account_correo'];

                                    $sql2 = "SELECT * FROM tienda_virtual WHERE ID_user = '$correo'";
                                    $resultado2 = $conexion->query($sql2);
                                    $row2 = mysqli_fetch_array($resultado2);
                                    $store = $row2[2] ?? 'No tiene tienda';

                                    echo '
                                        <div class="contenedor_vistaprevia_destacados btn_ver_articulo"
                                        style="padding: 10px; border-bottom: solid 1px #c9c9c9; cursor: pointer">
                                            <div class="thumbnail_guia">
                                                <img src="'.$fila['art_img'].'"
                                                    alt="guia" width="150" />
                                            </div>
                                            <div class="contenido_guia" style="margin-top: 1em">
                                                <h5 class="titulo_guia" style="font-family: Montserrat;">'.$fila['art_title'].'</h5>
                                                <p style="font-family: Roboto; margin: 0">
                                                    <svg style="display: inline; width:15px; height:15px;"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                                        <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path
                                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                                    </svg>
                                                    Publicado por <span class="txt-author">'.$store.'<span>
                                                </p>
                                            </div>
                                        </div>
                                    ';
                                }
                            }
                        ?>
                            <div class="contenedor_vistaprevia_destacados btn_ver_articulo"
                                style="padding: 10px; border-bottom: solid 1px #c9c9c9; cursor: pointer">
                                <div class="thumbnail_guia">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzXZEbAw2rTlg6VfF0t7bVOTESl1YMUmp2QvwDtar4SQ&s"
                                        alt="guia" width='150' />
                                </div>
                                <div class="contenido_guia" style="margin-top: 1em">
                                    <h5 class="titulo_guia" style="font-family: Montserrat;">Titulo del articulo
                                    </h5>
                                    <p style="font-family: Roboto; margin: 0">
                                        <svg style="display: inline; width:15px; height:15px;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                        </svg>
                                        Publicado por <b>Autor</b>
                                    </p>
                                </div>
                            </div>
                            <div class="contenedor_vistaprevia_destacados btn_ver_articulo"
                                style="padding: 10px; border-bottom: solid 1px #c9c9c9; cursor: pointer">
                                <div class="thumbnail_guia">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzXZEbAw2rTlg6VfF0t7bVOTESl1YMUmp2QvwDtar4SQ&s"
                                        alt="guia" width='150' />
                                </div>
                                <div class="contenido_guia" style="margin-top: 1em">
                                    <h5 class="titulo_guia" style="font-family: Montserrat;">Titulo del articulo
                                    </h5>
                                    <p style="font-family: Roboto; margin: 0">
                                        <svg style="display: inline; width:15px; height:15px;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                        </svg>
                                        Publicado por <b>Autor</b>
                                    </p>
                                </div>
                            </div>
                            <div class="contenedor_vistaprevia_destacados btn_ver_articulo"
                                style="padding: 10px; border-bottom: solid 1px #c9c9c9; cursor: pointer">
                                <div class="thumbnail_guia">
                                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzXZEbAw2rTlg6VfF0t7bVOTESl1YMUmp2QvwDtar4SQ&s"
                                        alt="guia" width='150' />
                                </div>
                                <div class="contenido_guia" style="margin-top: 1em">
                                    <h5 class="titulo_guia" style="font-family: Montserrat;">Titulo del articulo
                                    </h5>
                                    <p style="font-family: Roboto; margin: 0">
                                        <svg style="display: inline; width:15px; height:15px;"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path
                                                d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                        </svg>
                                        Publicado por <b>Autor</b>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>