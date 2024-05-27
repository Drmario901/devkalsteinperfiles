<div id='c-panel20'>
    <style>
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

    <div id="seccion_blog" display="none">
        <div class="contenedor_patron_css">
            <main class="contenedor_principal">
                <div class="contenedor_guiasInf"
                    style="display: grid; grid-template-columns: 2fr 1fr; gap: 2em; margin: auto; max-width: 1140px; margin-top: 20px;">
                    <div class="columna_principal_guias">
                        <div class="contenedor_vistaprevia_guia"
                            style="padding: 10px 10px 15px 10px; border-bottom: solid 1px #c9c9c9; display: grid; grid-template-columns: 1fr 2fr; gap: 1em; margin-bottom: 20px; justify-items: center; align-content: center; align-items: center;">
                            <div class="thumbnail_guia">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzXZEbAw2rTlg6VfF0t7bVOTESl1YMUmp2QvwDtar4SQ&s"
                                    alt="guia" width='200' />
                            </div>
                            <div class="contenido_guia"
                                style="display: flex; flex-direction: column; justify-content: space-between;">
                                <h5 class="titulo_guia" style="font-family: Montserrat; padding: 0">Titulo del articulo
                                </h5>
                                <hr
                                    style="height:3px; width:75px; border:none; color:#213280; background-color:#213280; opacity: 1; margin: 10px 0;">
                                <p style="font-family: Roboto; line-height: 1.5em; margin-bottom: 10px">Lorem ipsum
                                    dolor sit
                                    amet, consectetur
                                    adipiscing elit. Cras in mauris vitae justo vehicula viverra in in nulla. Vivamus at
                                    pretium velit. Suspendisse mollis eros sit amet ultrices gravida. Cras libero ipsum,
                                    ultricies vel est quis, condimentum ultrices ante. Ut maximus velit quis neque
                                    auctor, quis auctor neque tristique.</p>
                                <div class="footer-guia"
                                    style="display: flex; align-items: center; justify-content: space-between">
                                    <button class="btn_guias_informativas" id="guias_informativas" source="#">Ver mas</button>
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
                        <div class="contenedor_vistaprevia_guia"
                            style="padding: 10px 10px 15px 10px; border-bottom: solid 1px #c9c9c9; display: grid; grid-template-columns: 1fr 2fr; gap: 1em; margin-bottom: 20px; justify-items: center; align-content: center; align-items: center;">
                            <div class="thumbnail_guia">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzXZEbAw2rTlg6VfF0t7bVOTESl1YMUmp2QvwDtar4SQ&s"
                                    alt="guia" width='200' />
                            </div>
                            <div class="contenido_guia"
                                style="display: flex; flex-direction: column; justify-content: space-between;">
                                <h5 class="titulo_guia" style="font-family: Montserrat; padding: 0">Titulo del articulo
                                </h5>
                                <hr
                                    style="height:3px; width:75px; border:none; color:#213280; background-color:#213280; opacity: 1; margin: 10px 0;">
                                <p style="font-family: Roboto; line-height: 1.5em; margin-bottom: 10px">Lorem ipsum
                                    dolor sit
                                    amet, consectetur
                                    adipiscing elit. Cras in mauris vitae justo vehicula viverra in in nulla. Vivamus at
                                    pretium velit. Suspendisse mollis eros sit amet ultrices gravida. Cras libero ipsum,
                                    ultricies vel est quis, condimentum ultrices ante. Ut maximus velit quis neque
                                    auctor, quis auctor neque tristique.</p>
                                <div class="footer-guia"
                                    style="display: flex; align-items: center; justify-content: space-between">
                                    <button class="btn_guias_informativas ._df_button" id="guias_informativas" source="#">Ver mas</button>
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
                        <div class="contenedor_vistaprevia_guia"
                            style="padding: 10px 10px 15px 10px; border-bottom: solid 1px #c9c9c9; display: grid; grid-template-columns: 1fr 2fr; gap: 1em; margin-bottom: 20px; justify-items: center; align-content: center; align-items: center;">
                            <div class="thumbnail_guia">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzXZEbAw2rTlg6VfF0t7bVOTESl1YMUmp2QvwDtar4SQ&s"
                                    alt="guia" width='200' />
                            </div>
                            <div class="contenido_guia"
                                style="display: flex; flex-direction: column; justify-content: space-between;">
                                <h5 class="titulo_guia" style="font-family: Montserrat; padding: 0">Titulo del articulo
                                </h5>
                                <hr
                                    style="height:3px; width:75px; border:none; color:#213280; background-color:#213280; opacity: 1; margin: 10px 0;">
                                <p style="font-family: Roboto; line-height: 1.5em; margin-bottom: 10px">Lorem ipsum
                                    dolor sit
                                    amet, consectetur
                                    adipiscing elit. Cras in mauris vitae justo vehicula viverra in in nulla. Vivamus at
                                    pretium velit. Suspendisse mollis eros sit amet ultrices gravida. Cras libero ipsum,
                                    ultricies vel est quis, condimentum ultrices ante. Ut maximus velit quis neque
                                    auctor, quis auctor neque tristique.</p>
                                <div class="footer-guia"
                                    style="display: flex; align-items: center; justify-content: space-between">
                                    <button class="btn_guias_informativas ._df_button" id="guias_informativas" source="#">Ver mas</button>
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
                        <div class="contenedor_vistaprevia_guia"
                            style="padding: 10px 10px 15px 10px; border-bottom: solid 1px #c9c9c9; display: grid; grid-template-columns: 1fr 2fr; gap: 1em; margin-bottom: 20px; justify-items: center; align-content: center; align-items: center;">
                            <div class="thumbnail_guia">
                                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQzXZEbAw2rTlg6VfF0t7bVOTESl1YMUmp2QvwDtar4SQ&s"
                                    alt="guia" width='200' />
                            </div>
                            <div class="contenido_guia"
                                style="display: flex; flex-direction: column; justify-content: space-between;">
                                <h5 class="titulo_guia" style="font-family: Montserrat; padding: 0">Titulo del articulo
                                </h5>
                                <hr
                                    style="height:3px; width:75px; border:none; color:#213280; background-color:#213280; opacity: 1; margin: 10px 0;">
                                <p style="font-family: Roboto; line-height: 1.5em; margin-bottom: 10px">Lorem ipsum
                                    dolor sit
                                    amet, consectetur
                                    adipiscing elit. Cras in mauris vitae justo vehicula viverra in in nulla. Vivamus at
                                    pretium velit. Suspendisse mollis eros sit amet ultrices gravida. Cras libero ipsum,
                                    ultricies vel est quis, condimentum ultrices ante. Ut maximus velit quis neque
                                    auctor, quis auctor neque tristique.</p>
                                <div class="footer-guia"
                                    style="display: flex; align-items: center; justify-content: space-between">
                                    <button class="btn_guias_informativas ._df_button" id="guias_informativas" source="#">Ver mas</button>
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
                    <div class="columna_secundaria_guias">
                        <h4 class="titulo_destacados" style="font-family: Montserrat; font-weight: 600;">Artículos destacados
                        </h4>
                        <div class="contenedor-destacadas"
                            style="display: flex; flex-direction: column; gap: 20px; margin: 10px 0">
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