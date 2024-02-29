
<div class="container">
	<header class="header" data-header>
        <?php
            session_start(); 
            if (isset($_SESSION['emailAccount'])){
                $email = $_SESSION['emailAccount'];
        
            }
            include 'navbar.php';
        ?>
        <script>
            let page = "catalogs";
            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

	<article class="container article">
		<?php
			$banner_img = 'Header-distribuidor-IMG.jpg';
			// Obtener el idioma del cookie
			$language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

            // Incluir el archivo de traducciones
            require __DIR__. '/../../../php/translations.php';

            // Determinar el texto del banner según el idioma
            $banner_text_translation = isset($translations[$language]['banner_text_catalogs']) ? $translations[$language]['banner_text_catalogs'] : $translations['en']['banner_text_catalogs'];
            
            // Incluir el banner.php pasando el texto traducido y el nombre del usuario
            $banner_text = $banner_text_translation;

			include __DIR__.'/../manufacturer/banner.php';
		?>
	
		<style>
			#category {
				padding: 12px 20px;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

			#searchreport {
				padding: 12px 20px;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box; 
			}

			#catalogo {
				display: grid;
				grid-gap: 20px;
				place-items: center;
			}
	
			.g-4, .gy-4 {
				--bs-gutter-y: 2rem;
				--bs-gutter-x: -4.5rem;
			}
		</style>
	
		<div class="row mx-4 mb-4">
			<div class="category-select col-12 col-md-6 d-flex align-items-center px-0">
				<i class="fa-solid fa-filter mx-3"></i>
				<select id="category" style="padding-left: 10px;"></select>
			</div>

			<div class="search col-12 col-md-6 d-flex align-items-center px-0">
				<i class="fas fa-search mx-3"></i>
				<input type="text" data-placeholder="distribuidor:placeholderBuscarCatalogo" placeholder="Buscar un catálogo" id="searchreport" style="padding-left: 10px; height: 100%" class='mb-0'>
			</div>
		</div>
	
		<div id="catalogo"></div>
	</article>

	<?php
        $footer_img = 'Footer-distribuidor-IMG.png';
        include 'footer.php';
    ?> 
</div>