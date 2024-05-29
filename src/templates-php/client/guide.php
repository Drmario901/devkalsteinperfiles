<div id='c-panel20'>
    <?php
			// Incluir el archivo de traducciones
			include __DIR__.'/../../../php/translations.php';
			
			$banner_img = 'Header-usuario-IMG.png';

			// Obtener el idioma del cookie
			$language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

			// Obtener el texto del banner según el idioma
			$banner_text_key = 'banner_text_guides'; // Clave para el texto de los catálogos (por defecto)
			if (isset($translations[$language]['banner_text_guides'])) {
				$banner_text_key = 'banner_text_guides';
			}

			// Obtener el texto del banner
			$banner_text = isset($translations[$language][$banner_text_key]) ? $translations[$language][$banner_text_key] : 'Guias informativas';

			include 'banner.php';
		?>

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

    <div id="seccion_blog">
        <div class="contenedor_patron_css">
            <main class="contenedor_principal">
                <div class="contenedor_guiasInf"
                    style="display: grid; gap: 2em; margin: auto; max-width: 1140px; margin-top: 20px;">
                    <div class="columna_principal_guias" id="container_guides">
                        
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>