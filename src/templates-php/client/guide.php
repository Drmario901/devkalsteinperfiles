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
        .author-store:hover{
            cursor: pointer;
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
        #guias_informativas{
            background-color: #213280 !important;
            color: #fff !important;
            padding: 2px 10px;
        }
        #guias_informativas:hover{
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

    <div id="seccion_blog">
        <div class="contenedor_patron_css">
            <main class="contenedor_principal">
                <div class="contenedor_guiasInf"
                    style="display: grid; gap: 2em; margin: auto; max-width: 1140px; margin-top: 20px;">
                    <div class="columna_principal_guias" id="container_guides">
                        
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
            </main>
        </div>
    </div>
</div>