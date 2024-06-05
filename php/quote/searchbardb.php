<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../classes/conexion.php';
require __DIR__ . '/../classes/templates-php/translations.php';

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
$salida = '
	<div class="contenedor-busqueda pt-2 px-2 bg-white">
		<div class="row w-100">
';
$department = $_POST['consulta1'];

$todas = $translations[$lang]['all'];
$todasCat = $translations[$lang]['allCategories'];

$lang = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';
$tagDescriptionField = $lang == 'en' ? 'tags_description' : 'tags_description_' . $lang;
$categoriesField = $lang == 'en' ? 'tags_categorie' : 'tags_categorie_' . $lang;
$productCategoryField = $lang == 'en' ? 'product_category' : 'product_category_' . $lang;

if ($department == $todas || $department == $todasCat) {
	if (isset($_POST['consulta'])) {
		$q = $conexion->real_escape_string($_POST['consulta']);
		$consulta = "SELECT $tagDescriptionField FROM wp_tags WHERE $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
		$consulta2 = "SELECT product_model FROM wp_k_products WHERE product_model LIKE '%" . $q . "%' AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell', 'used') LIMIT 0, 11";
		$consulta3 = "SELECT * FROM wp_tags WHERE $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
	}

	$resultado = $conexion->query($consulta);

	if ($resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
			$salida .= '
				<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
				<div class="col-6 border-end">
					<!-- CATEGORIAS: Se muestran solo 2 -->
					<div class="busqueda-categoria p-2">
						<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
						<div class="pt-2">
						<!-- 1ERA CATEGORIA -->
						<div id="catg1" class="categoria">
							<p class="categoria-title">Categoria #1.1.1</p>
							<span
							class="categoria-subtitle"
							style="color: dimgrey; font-size: 12px"
							>
							En Categoria #1 > Categoria #1.1
							</span>
						</div>
						<!-- 2DA CATEGORIA -->
						<div id="catg2" class="categoria mt-2">
							<p class="categoria-title">Categoria #1.1.2</p>
							<span
							class="categoria-subtitle"
							style="color: dimgrey; font-size: 12px"
							>
							En Categoria #1 > Categoria #1.1
							</span>
						</div>
						</div>
					</div>
			
					<!-- ARTICULOS: Se muestran solo 2 -->
					<div class="busqueda-articulos pt-3 p-2">
						<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
						<div class="pt-2">
						<!-- 1era Entrada -->
						<div id="art1" class="articulo">
							<p class="articulo-title">Esta es una entrada #1</p>
						</div>
						<!-- 2da Entrada -->
						<div id="art2" class="articulo mt-2">
							<p class="articulo-title">Esta es una entrada #2</p>
						</div>
						</div>
					</div>
			
					<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
					<div class="busqueda-productos pt-3 p-2">
						<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
						<div class="py-2">
						<!-- 1er Producto -->
						<div id="prod1" class="producto row">
							<div class="producto-thumbnail col-1">
							<img
								class="producto-thumbnail-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="col-11">
							<p class="producto-title">
								Producto Moises Modelo Manioso #1
							</p>
							<span
								class="producto-subtitle"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							</div>
						</div>
						<!-- 2do Producto -->
						<div id="prod2" class="producto row mt-2">
							<div class="producto-thumbnail col-1">
							<img
								class="producto-thumbnail-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="col-11">
							<p class="producto-title">
								Producto Moises Modelo Manioso #2
							</p>
							<span
								class="producto-subtitle"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							</div>
						</div>
						<!-- 3er Producto -->
						<div id="prod3" class="producto row mt-2">
							<div class="producto-thumbnail col-1">
							<img
								class="producto-thumbnail-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="col-11">
							<p class="producto-title">
								Producto Moises Modelo Manioso #3
							</p>
							<span
								class="producto-subtitle"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							</div>
						</div>
						</div>
						<!-- Boton de Ver Mas Productos -->
						<div class="ver-mas-productos w-100 border-top">
						VER TODOS LOS PRODUCTOS (999)
						</div>
					</div>
				</div>
				<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
				<div class="col-6 p-2">
					<!-- VISTA PREVIA CATEGORIAS -->
			
					<!-- 1era Categoria -->
					<div
						id="catg1-show"
						class="elemento-vista-previa"
						style="display: none"
					>
						<h6 class="mb-3" style="font-size: 16px">
						<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
						</h6>
						<div class="categoria-lista">
						<div class="row categoria-lista-producto mb-2">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						<div class="row categoria-lista-producto mb-2">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						<div class="row categoria-lista-producto mb-2">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						<div class="row categoria-lista-producto">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						</div>
					</div>
					<!-- 2da Categoria -->
					<div
						id="catg2-show"
						class="elemento-vista-previa"
						style="display: none"
					>
						<h6 class="mb-3" style="font-size: 16px">
						<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
						</h6>
						<div class="categoria-lista">
						<div class="row categoria-lista-producto mb-2">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						<div class="row categoria-lista-producto mb-2">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						<div class="row categoria-lista-producto mb-2">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						<div class="row categoria-lista-producto">
							<div class="col-2">
							<img
								class="categoria-lista-producto-img"
								src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
								alt="img-producto"
							/>
							</div>
							<div class="col-10">
							<h6>Producto Jorgito Modelo Manioso</h6>
							</div>
						</div>
						</div>
					</div>
			
					<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
			
					<!-- 1era Entrada -->
					<div
						id="art1-show"
						class="elemento-vista-previa"
						style="display: none"
					>
						<div class="articulo-thumbnail pb-2 border-bottom">
						<img
							class="articulo-thumbnail-img"
							src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
							alt=""
						/>
						</div>
						<div class="articulo-contenido p-2">
						<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
						<p class="articulo-contenido-extracto">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
							facilisis vitae nulla vel suscipit. Donec fringilla augue eget
							augue sodales, in aliquet velit sodales. Vivamus facilisis ante
							vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
							sit amet, fringilla et risus. Sed risus urna, elementum vel
							aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
							auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
							eget ligula.
						</p>
						<div class="d-flex justify-content-end pt-3 mt-2 border-top">
							<button class="articulo-contenido-boton btn btn-primary">
							Seguir leyendo
							</button>
						</div>
						</div>
					</div>
					<!-- 2da Entrada -->
					<div
						id="art2-show"
						class="elemento-vista-previa"
						style="display: none"
					>
						<div class="articulo-thumbnail pb-2 border-bottom">
						<img
							class="articulo-thumbnail-img"
							src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
							alt=""
						/>
						</div>
						<div class="articulo-contenido p-2">
						<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
						<p class="articulo-contenido-extracto">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
							facilisis vitae nulla vel suscipit. Donec fringilla augue eget
							augue sodales, in aliquet velit sodales. Vivamus facilisis ante
							vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
							sit amet, fringilla et risus. Sed risus urna, elementum vel
							aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
							auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
							eget ligula.
						</p>
						<div class="d-flex justify-content-end pt-3 mt-2 border-top">
							<button class="articulo-contenido-boton btn btn-primary">
							Seguir leyendo
							</button>
						</div>
						</div>
					</div>
			
					<!-- VISTA PREVIA PRODUCTOS -->
			
					<!-- 1er Producto -->
					<div
						id="prod1-show"
						class="elemento-vista-previa"
						style="display: none"
					>
						<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
						<img
							class="producto-thumbnail-vista-previa-img"
							src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
							alt=""
						/>
						</div>
						<div class="producto-contenido p-2">
						<h6 class="producto-contenido-title">
							Producto Moises Modelo Manioso #1
						</h6>
						<span
							class="producto-contenido-fabricante"
							style="color: dimgrey; font-size: 12px"
						>
							Fabricante: Jorgito
						</span>
						<div
							class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
						>
							<div class="col-auto">
							<input
								type="number"
								class="form-control"
								id="numProdQuo"
								value="1"
							/>
							</div>
							<div class="col-auto">
							<button class="producto-contenido-boton btn btn-primary">
								Solicitar más información
							</button>
							</div>
						</div>
						</div>
					</div>
					<!-- 2do Producto -->
					<div
						id="prod2-show"
						class="elemento-vista-previa"
						style="display: none"
					>
						<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
						<img
							class="producto-thumbnail-vista-previa-img"
							src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
							alt=""
						/>
						</div>
						<div class="producto-contenido p-2">
						<h6 class="producto-contenido-title">
							Producto Moises Modelo Manioso #2
						</h6>
						<span
							class="producto-contenido-fabricante"
							style="color: dimgrey; font-size: 12px"
						>
							Fabricante: Jorgito
						</span>
						<div
							class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
						>
							<div class="col-auto">
							<input
								type="number"
								class="form-control"
								id="numProdQuo"
								value="1"
							/>
							</div>
							<div class="col-auto">
							<button class="producto-contenido-boton btn btn-primary">
								Solicitar más información
							</button>
							</div>
						</div>
						</div>
					</div>
					<!-- 3er Producto -->
					<div
						id="prod3-show"
						class="elemento-vista-previa"
						style="display: none"
					>
						<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
						<img
							class="producto-thumbnail-vista-previa-img"
							src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
							alt=""
						/>
						</div>
						<div class="producto-contenido p-2">
						<h6 class="producto-contenido-title">
							Producto Moises Modelo Manioso #3
						</h6>
						<span
							class="producto-contenido-fabricante"
							style="color: dimgrey; font-size: 12px"
						>
							Fabricante: Jorgito
						</span>
						<div
							class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
						>
							<div class="col-auto">
							<input
								type="number"
								class="form-control"
								id="numProdQuo"
								value="1"
							/>
							</div>
							<div class="col-auto">
							<button class="producto-contenido-boton btn btn-primary">
								Solicitar más información
							</button>
							</div>
						</div>
						</div>
					</div>
				</div>
			';
			// $salida .= "
			// 			<li><a class='dropdown-item li-sug' href='#'>" . $fila[$tagDescriptionField] . "</a></li>
			// 	";
		}
	} else {
		$resultado = $conexion->query($consulta2);

		if ($resultado->num_rows > 0) {
			while ($fila = $resultado->fetch_assoc()) {
				$salida .= '
					<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
					<div class="col-6 border-end">
						<!-- CATEGORIAS: Se muestran solo 2 -->
						<div class="busqueda-categoria p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
							<div class="pt-2">
							<!-- 1ERA CATEGORIA -->
							<div id="catg1" class="categoria">
								<p class="categoria-title">Categoria #1.1.1</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							<!-- 2DA CATEGORIA -->
							<div id="catg2" class="categoria mt-2">
								<p class="categoria-title">Categoria #1.1.2</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							</div>
						</div>
				
						<!-- ARTICULOS: Se muestran solo 2 -->
						<div class="busqueda-articulos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
							<div class="pt-2">
							<!-- 1era Entrada -->
							<div id="art1" class="articulo">
								<p class="articulo-title">Esta es una entrada #1</p>
							</div>
							<!-- 2da Entrada -->
							<div id="art2" class="articulo mt-2">
								<p class="articulo-title">Esta es una entrada #2</p>
							</div>
							</div>
						</div>
				
						<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
						<div class="busqueda-productos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
							<div class="py-2">
							<!-- 1er Producto -->
							<div id="prod1" class="producto row">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #1
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 2do Producto -->
							<div id="prod2" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #2
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 3er Producto -->
							<div id="prod3" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #3
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							</div>
							<!-- Boton de Ver Mas Productos -->
							<div class="ver-mas-productos w-100 border-top">
							VER TODOS LOS PRODUCTOS (999)
							</div>
						</div>
					</div>
					<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
					<div class="col-6 p-2">
						<!-- VISTA PREVIA CATEGORIAS -->
				
						<!-- 1era Categoria -->
						<div
							id="catg1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
						<!-- 2da Categoria -->
						<div
							id="catg2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
				
						<!-- 1era Entrada -->
						<div
							id="art1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
						<!-- 2da Entrada -->
						<div
							id="art2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA PRODUCTOS -->
				
						<!-- 1er Producto -->
						<div
							id="prod1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #1
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 2do Producto -->
						<div
							id="prod2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #2
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 3er Producto -->
						<div
							id="prod3-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #3
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
					</div>
				';
				// $salida .= "
				// 			<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
				// 	";
			}
		} else {
			$resultado = $conexion->query($consulta3);

			if ($resultado->num_rows > 0) {
				while ($fila = $resultado->fetch_assoc()) {
					$salida .= '
						<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
						<div class="col-6 border-end">
							<!-- CATEGORIAS: Se muestran solo 2 -->
							<div class="busqueda-categoria p-2">
								<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
								<div class="pt-2">
								<!-- 1ERA CATEGORIA -->
								<div id="catg1" class="categoria">
									<p class="categoria-title">Categoria #1.1.1</p>
									<span
									class="categoria-subtitle"
									style="color: dimgrey; font-size: 12px"
									>
									En Categoria #1 > Categoria #1.1
									</span>
								</div>
								<!-- 2DA CATEGORIA -->
								<div id="catg2" class="categoria mt-2">
									<p class="categoria-title">Categoria #1.1.2</p>
									<span
									class="categoria-subtitle"
									style="color: dimgrey; font-size: 12px"
									>
									En Categoria #1 > Categoria #1.1
									</span>
								</div>
								</div>
							</div>
					
							<!-- ARTICULOS: Se muestran solo 2 -->
							<div class="busqueda-articulos pt-3 p-2">
								<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
								<div class="pt-2">
								<!-- 1era Entrada -->
								<div id="art1" class="articulo">
									<p class="articulo-title">Esta es una entrada #1</p>
								</div>
								<!-- 2da Entrada -->
								<div id="art2" class="articulo mt-2">
									<p class="articulo-title">Esta es una entrada #2</p>
								</div>
								</div>
							</div>
					
							<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
							<div class="busqueda-productos pt-3 p-2">
								<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
								<div class="py-2">
								<!-- 1er Producto -->
								<div id="prod1" class="producto row">
									<div class="producto-thumbnail col-1">
									<img
										class="producto-thumbnail-img"
										src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
										alt=""
									/>
									</div>
									<div class="col-11">
									<p class="producto-title">
										Producto Moises Modelo Manioso #1
									</p>
									<span
										class="producto-subtitle"
										style="color: dimgrey; font-size: 12px"
									>
										Fabricante: Jorgito
									</span>
									</div>
								</div>
								<!-- 2do Producto -->
								<div id="prod2" class="producto row mt-2">
									<div class="producto-thumbnail col-1">
									<img
										class="producto-thumbnail-img"
										src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
										alt=""
									/>
									</div>
									<div class="col-11">
									<p class="producto-title">
										Producto Moises Modelo Manioso #2
									</p>
									<span
										class="producto-subtitle"
										style="color: dimgrey; font-size: 12px"
									>
										Fabricante: Jorgito
									</span>
									</div>
								</div>
								<!-- 3er Producto -->
								<div id="prod3" class="producto row mt-2">
									<div class="producto-thumbnail col-1">
									<img
										class="producto-thumbnail-img"
										src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
										alt=""
									/>
									</div>
									<div class="col-11">
									<p class="producto-title">
										Producto Moises Modelo Manioso #3
									</p>
									<span
										class="producto-subtitle"
										style="color: dimgrey; font-size: 12px"
									>
										Fabricante: Jorgito
									</span>
									</div>
								</div>
								</div>
								<!-- Boton de Ver Mas Productos -->
								<div class="ver-mas-productos w-100 border-top">
								VER TODOS LOS PRODUCTOS (999)
								</div>
							</div>
						</div>
						<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
						<div class="col-6 p-2">
							<!-- VISTA PREVIA CATEGORIAS -->
					
							<!-- 1era Categoria -->
							<div
								id="catg1-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<h6 class="mb-3" style="font-size: 16px">
								<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
								</h6>
								<div class="categoria-lista">
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								</div>
							</div>
							<!-- 2da Categoria -->
							<div
								id="catg2-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<h6 class="mb-3" style="font-size: 16px">
								<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
								</h6>
								<div class="categoria-lista">
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								</div>
							</div>
					
							<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
					
							<!-- 1era Entrada -->
							<div
								id="art1-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="articulo-thumbnail pb-2 border-bottom">
								<img
									class="articulo-thumbnail-img"
									src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
									alt=""
								/>
								</div>
								<div class="articulo-contenido p-2">
								<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
								<p class="articulo-contenido-extracto">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
									facilisis vitae nulla vel suscipit. Donec fringilla augue eget
									augue sodales, in aliquet velit sodales. Vivamus facilisis ante
									vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
									sit amet, fringilla et risus. Sed risus urna, elementum vel
									aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
									auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
									eget ligula.
								</p>
								<div class="d-flex justify-content-end pt-3 mt-2 border-top">
									<button class="articulo-contenido-boton btn btn-primary">
									Seguir leyendo
									</button>
								</div>
								</div>
							</div>
							<!-- 2da Entrada -->
							<div
								id="art2-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="articulo-thumbnail pb-2 border-bottom">
								<img
									class="articulo-thumbnail-img"
									src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
									alt=""
								/>
								</div>
								<div class="articulo-contenido p-2">
								<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
								<p class="articulo-contenido-extracto">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
									facilisis vitae nulla vel suscipit. Donec fringilla augue eget
									augue sodales, in aliquet velit sodales. Vivamus facilisis ante
									vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
									sit amet, fringilla et risus. Sed risus urna, elementum vel
									aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
									auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
									eget ligula.
								</p>
								<div class="d-flex justify-content-end pt-3 mt-2 border-top">
									<button class="articulo-contenido-boton btn btn-primary">
									Seguir leyendo
									</button>
								</div>
								</div>
							</div>
					
							<!-- VISTA PREVIA PRODUCTOS -->
					
							<!-- 1er Producto -->
							<div
								id="prod1-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
								<img
									class="producto-thumbnail-vista-previa-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="producto-contenido p-2">
								<h6 class="producto-contenido-title">
									Producto Moises Modelo Manioso #1
								</h6>
								<span
									class="producto-contenido-fabricante"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								<div
									class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
								>
									<div class="col-auto">
									<input
										type="number"
										class="form-control"
										id="numProdQuo"
										value="1"
									/>
									</div>
									<div class="col-auto">
									<button class="producto-contenido-boton btn btn-primary">
										Solicitar más información
									</button>
									</div>
								</div>
								</div>
							</div>
							<!-- 2do Producto -->
							<div
								id="prod2-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
								<img
									class="producto-thumbnail-vista-previa-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="producto-contenido p-2">
								<h6 class="producto-contenido-title">
									Producto Moises Modelo Manioso #2
								</h6>
								<span
									class="producto-contenido-fabricante"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								<div
									class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
								>
									<div class="col-auto">
									<input
										type="number"
										class="form-control"
										id="numProdQuo"
										value="1"
									/>
									</div>
									<div class="col-auto">
									<button class="producto-contenido-boton btn btn-primary">
										Solicitar más información
									</button>
									</div>
								</div>
								</div>
							</div>
							<!-- 3er Producto -->
							<div
								id="prod3-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
								<img
									class="producto-thumbnail-vista-previa-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="producto-contenido p-2">
								<h6 class="producto-contenido-title">
									Producto Moises Modelo Manioso #3
								</h6>
								<span
									class="producto-contenido-fabricante"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								<div
									class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
								>
									<div class="col-auto">
									<input
										type="number"
										class="form-control"
										id="numProdQuo"
										value="1"
									/>
									</div>
									<div class="col-auto">
									<button class="producto-contenido-boton btn btn-primary">
										Solicitar más información
									</button>
									</div>
								</div>
								</div>
							</div>
						</div>
					';
					// $salida .= "
					// 			<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
					// 	";
				}
			} else {
				$salida .= '
					<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
					<div class="col-6 border-end">
						<!-- CATEGORIAS: Se muestran solo 2 -->
						<div class="busqueda-categoria p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
							<div class="pt-2">
							<!-- 1ERA CATEGORIA -->
							<div id="catg1" class="categoria">
								<p class="categoria-title">Categoria #1.1.1</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							<!-- 2DA CATEGORIA -->
							<div id="catg2" class="categoria mt-2">
								<p class="categoria-title">Categoria #1.1.2</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							</div>
						</div>
				
						<!-- ARTICULOS: Se muestran solo 2 -->
						<div class="busqueda-articulos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
							<div class="pt-2">
							<!-- 1era Entrada -->
							<div id="art1" class="articulo">
								<p class="articulo-title">Esta es una entrada #1</p>
							</div>
							<!-- 2da Entrada -->
							<div id="art2" class="articulo mt-2">
								<p class="articulo-title">Esta es una entrada #2</p>
							</div>
							</div>
						</div>
				
						<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
						<div class="busqueda-productos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
							<div class="py-2">
							<!-- 1er Producto -->
							<div id="prod1" class="producto row">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #1
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 2do Producto -->
							<div id="prod2" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #2
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 3er Producto -->
							<div id="prod3" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #3
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							</div>
							<!-- Boton de Ver Mas Productos -->
							<div class="ver-mas-productos w-100 border-top">
							VER TODOS LOS PRODUCTOS (999)
							</div>
						</div>
					</div>
					<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
					<div class="col-6 p-2">
						<!-- VISTA PREVIA CATEGORIAS -->
				
						<!-- 1era Categoria -->
						<div
							id="catg1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
						<!-- 2da Categoria -->
						<div
							id="catg2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
				
						<!-- 1era Entrada -->
						<div
							id="art1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
						<!-- 2da Entrada -->
						<div
							id="art2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA PRODUCTOS -->
				
						<!-- 1er Producto -->
						<div
							id="prod1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #1
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 2do Producto -->
						<div
							id="prod2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #2
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 3er Producto -->
						<div
							id="prod3-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #3
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
					</div>
				';
				// $salida .= "<div class='nodatos'><p style='font-weight: bold; font-size: 1.1rem; margin-top: 0.5rem; margin-left: 0.3rem;'>No se encontraron datos para tu búsqueda</p></div>";
			}
		}
	}
} else {
	if (isset($_POST['consulta'])) {
		$q = $conexion->real_escape_string($_POST['consulta']);
		$consulta = "SELECT $tagDescriptionField FROM wp_tags WHERE $categoriesField = '$department' AND $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
		$consulta2 = "SELECT product_model FROM wp_k_products WHERE $productCategoryField = '$department' AND product_model LIKE '%" . $q . "%' AND product_stock_status = 'in stock' AND product_validate_status = 'validated' AND product_type IN ('sell', 'used') LIMIT 0, 11";
		$consulta3 = "SELECT * FROM wp_tags WHERE $categoriesField = '$department' AND $tagDescriptionField LIKE '%" . $q . "%' LIMIT 0, 11";
	}


	$resultado = $conexion->query($consulta);

	if ($resultado->num_rows > 0) {
		while ($fila = $resultado->fetch_assoc()) {
				$salida .= '
					<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
					<div class="col-6 border-end">
						<!-- CATEGORIAS: Se muestran solo 2 -->
						<div class="busqueda-categoria p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
							<div class="pt-2">
							<!-- 1ERA CATEGORIA -->
							<div id="catg1" class="categoria">
								<p class="categoria-title">Categoria #1.1.1</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							<!-- 2DA CATEGORIA -->
							<div id="catg2" class="categoria mt-2">
								<p class="categoria-title">Categoria #1.1.2</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							</div>
						</div>
				
						<!-- ARTICULOS: Se muestran solo 2 -->
						<div class="busqueda-articulos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
							<div class="pt-2">
							<!-- 1era Entrada -->
							<div id="art1" class="articulo">
								<p class="articulo-title">Esta es una entrada #1</p>
							</div>
							<!-- 2da Entrada -->
							<div id="art2" class="articulo mt-2">
								<p class="articulo-title">Esta es una entrada #2</p>
							</div>
							</div>
						</div>
				
						<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
						<div class="busqueda-productos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
							<div class="py-2">
							<!-- 1er Producto -->
							<div id="prod1" class="producto row">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #1
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 2do Producto -->
							<div id="prod2" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #2
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 3er Producto -->
							<div id="prod3" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #3
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							</div>
							<!-- Boton de Ver Mas Productos -->
							<div class="ver-mas-productos w-100 border-top">
							VER TODOS LOS PRODUCTOS (999)
							</div>
						</div>
					</div>
					<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
					<div class="col-6 p-2">
						<!-- VISTA PREVIA CATEGORIAS -->
				
						<!-- 1era Categoria -->
						<div
							id="catg1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
						<!-- 2da Categoria -->
						<div
							id="catg2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
				
						<!-- 1era Entrada -->
						<div
							id="art1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
						<!-- 2da Entrada -->
						<div
							id="art2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA PRODUCTOS -->
				
						<!-- 1er Producto -->
						<div
							id="prod1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #1
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 2do Producto -->
						<div
							id="prod2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #2
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 3er Producto -->
						<div
							id="prod3-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #3
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
					</div>
				';
			// $salida .= "
			// 			<li><a class='dropdown-item' href='#'>" . $fila[$tagDescriptionField] . "</a></li>
			// 	";
		}
	} else {
		$resultado = $conexion->query($consulta2);

		if ($resultado->num_rows > 0) {
			while ($fila = $resultado->fetch_assoc()) {
				$salida .= '
					<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
					<div class="col-6 border-end">
						<!-- CATEGORIAS: Se muestran solo 2 -->
						<div class="busqueda-categoria p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
							<div class="pt-2">
							<!-- 1ERA CATEGORIA -->
							<div id="catg1" class="categoria">
								<p class="categoria-title">Categoria #1.1.1</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							<!-- 2DA CATEGORIA -->
							<div id="catg2" class="categoria mt-2">
								<p class="categoria-title">Categoria #1.1.2</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							</div>
						</div>
				
						<!-- ARTICULOS: Se muestran solo 2 -->
						<div class="busqueda-articulos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
							<div class="pt-2">
							<!-- 1era Entrada -->
							<div id="art1" class="articulo">
								<p class="articulo-title">Esta es una entrada #1</p>
							</div>
							<!-- 2da Entrada -->
							<div id="art2" class="articulo mt-2">
								<p class="articulo-title">Esta es una entrada #2</p>
							</div>
							</div>
						</div>
				
						<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
						<div class="busqueda-productos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
							<div class="py-2">
							<!-- 1er Producto -->
							<div id="prod1" class="producto row">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #1
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 2do Producto -->
							<div id="prod2" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #2
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 3er Producto -->
							<div id="prod3" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #3
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							</div>
							<!-- Boton de Ver Mas Productos -->
							<div class="ver-mas-productos w-100 border-top">
							VER TODOS LOS PRODUCTOS (999)
							</div>
						</div>
					</div>
					<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
					<div class="col-6 p-2">
						<!-- VISTA PREVIA CATEGORIAS -->
				
						<!-- 1era Categoria -->
						<div
							id="catg1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
						<!-- 2da Categoria -->
						<div
							id="catg2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
				
						<!-- 1era Entrada -->
						<div
							id="art1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
						<!-- 2da Entrada -->
						<div
							id="art2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA PRODUCTOS -->
				
						<!-- 1er Producto -->
						<div
							id="prod1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #1
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 2do Producto -->
						<div
							id="prod2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #2
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 3er Producto -->
						<div
							id="prod3-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #3
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
					</div>
				';
				// $salida .= "
				// 			<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
				// 	";
			}
		} else {
			$resultado = $conexion->query($consulta3);
			var_dump($resultado->num_rows);

			if ($resultado->num_rows > 0) {
				while ($fila = $resultado->fetch_assoc()) {
					$salida .= '
						<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
						<div class="col-6 border-end">
							<!-- CATEGORIAS: Se muestran solo 2 -->
							<div class="busqueda-categoria p-2">
								<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
								<div class="pt-2">
								<!-- 1ERA CATEGORIA -->
								<div id="catg1" class="categoria">
									<p class="categoria-title">Categoria #1.1.1</p>
									<span
									class="categoria-subtitle"
									style="color: dimgrey; font-size: 12px"
									>
									En Categoria #1 > Categoria #1.1
									</span>
								</div>
								<!-- 2DA CATEGORIA -->
								<div id="catg2" class="categoria mt-2">
									<p class="categoria-title">Categoria #1.1.2</p>
									<span
									class="categoria-subtitle"
									style="color: dimgrey; font-size: 12px"
									>
									En Categoria #1 > Categoria #1.1
									</span>
								</div>
								</div>
							</div>
					
							<!-- ARTICULOS: Se muestran solo 2 -->
							<div class="busqueda-articulos pt-3 p-2">
								<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
								<div class="pt-2">
								<!-- 1era Entrada -->
								<div id="art1" class="articulo">
									<p class="articulo-title">Esta es una entrada #1</p>
								</div>
								<!-- 2da Entrada -->
								<div id="art2" class="articulo mt-2">
									<p class="articulo-title">Esta es una entrada #2</p>
								</div>
								</div>
							</div>
					
							<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
							<div class="busqueda-productos pt-3 p-2">
								<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
								<div class="py-2">
								<!-- 1er Producto -->
								<div id="prod1" class="producto row">
									<div class="producto-thumbnail col-1">
									<img
										class="producto-thumbnail-img"
										src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
										alt=""
									/>
									</div>
									<div class="col-11">
									<p class="producto-title">
										Producto Moises Modelo Manioso #1
									</p>
									<span
										class="producto-subtitle"
										style="color: dimgrey; font-size: 12px"
									>
										Fabricante: Jorgito
									</span>
									</div>
								</div>
								<!-- 2do Producto -->
								<div id="prod2" class="producto row mt-2">
									<div class="producto-thumbnail col-1">
									<img
										class="producto-thumbnail-img"
										src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
										alt=""
									/>
									</div>
									<div class="col-11">
									<p class="producto-title">
										Producto Moises Modelo Manioso #2
									</p>
									<span
										class="producto-subtitle"
										style="color: dimgrey; font-size: 12px"
									>
										Fabricante: Jorgito
									</span>
									</div>
								</div>
								<!-- 3er Producto -->
								<div id="prod3" class="producto row mt-2">
									<div class="producto-thumbnail col-1">
									<img
										class="producto-thumbnail-img"
										src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
										alt=""
									/>
									</div>
									<div class="col-11">
									<p class="producto-title">
										Producto Moises Modelo Manioso #3
									</p>
									<span
										class="producto-subtitle"
										style="color: dimgrey; font-size: 12px"
									>
										Fabricante: Jorgito
									</span>
									</div>
								</div>
								</div>
								<!-- Boton de Ver Mas Productos -->
								<div class="ver-mas-productos w-100 border-top">
								VER TODOS LOS PRODUCTOS (999)
								</div>
							</div>
						</div>
						<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
						<div class="col-6 p-2">
							<!-- VISTA PREVIA CATEGORIAS -->
					
							<!-- 1era Categoria -->
							<div
								id="catg1-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<h6 class="mb-3" style="font-size: 16px">
								<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
								</h6>
								<div class="categoria-lista">
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								</div>
							</div>
							<!-- 2da Categoria -->
							<div
								id="catg2-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<h6 class="mb-3" style="font-size: 16px">
								<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
								</h6>
								<div class="categoria-lista">
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto mb-2">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								<div class="row categoria-lista-producto">
									<div class="col-2">
									<img
										class="categoria-lista-producto-img"
										src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
										alt="img-producto"
									/>
									</div>
									<div class="col-10">
									<h6>Producto Jorgito Modelo Manioso</h6>
									</div>
								</div>
								</div>
							</div>
					
							<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
					
							<!-- 1era Entrada -->
							<div
								id="art1-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="articulo-thumbnail pb-2 border-bottom">
								<img
									class="articulo-thumbnail-img"
									src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
									alt=""
								/>
								</div>
								<div class="articulo-contenido p-2">
								<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
								<p class="articulo-contenido-extracto">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
									facilisis vitae nulla vel suscipit. Donec fringilla augue eget
									augue sodales, in aliquet velit sodales. Vivamus facilisis ante
									vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
									sit amet, fringilla et risus. Sed risus urna, elementum vel
									aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
									auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
									eget ligula.
								</p>
								<div class="d-flex justify-content-end pt-3 mt-2 border-top">
									<button class="articulo-contenido-boton btn btn-primary">
									Seguir leyendo
									</button>
								</div>
								</div>
							</div>
							<!-- 2da Entrada -->
							<div
								id="art2-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="articulo-thumbnail pb-2 border-bottom">
								<img
									class="articulo-thumbnail-img"
									src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
									alt=""
								/>
								</div>
								<div class="articulo-contenido p-2">
								<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
								<p class="articulo-contenido-extracto">
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
									facilisis vitae nulla vel suscipit. Donec fringilla augue eget
									augue sodales, in aliquet velit sodales. Vivamus facilisis ante
									vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
									sit amet, fringilla et risus. Sed risus urna, elementum vel
									aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
									auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
									eget ligula.
								</p>
								<div class="d-flex justify-content-end pt-3 mt-2 border-top">
									<button class="articulo-contenido-boton btn btn-primary">
									Seguir leyendo
									</button>
								</div>
								</div>
							</div>
					
							<!-- VISTA PREVIA PRODUCTOS -->
					
							<!-- 1er Producto -->
							<div
								id="prod1-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
								<img
									class="producto-thumbnail-vista-previa-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="producto-contenido p-2">
								<h6 class="producto-contenido-title">
									Producto Moises Modelo Manioso #1
								</h6>
								<span
									class="producto-contenido-fabricante"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								<div
									class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
								>
									<div class="col-auto">
									<input
										type="number"
										class="form-control"
										id="numProdQuo"
										value="1"
									/>
									</div>
									<div class="col-auto">
									<button class="producto-contenido-boton btn btn-primary">
										Solicitar más información
									</button>
									</div>
								</div>
								</div>
							</div>
							<!-- 2do Producto -->
							<div
								id="prod2-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
								<img
									class="producto-thumbnail-vista-previa-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="producto-contenido p-2">
								<h6 class="producto-contenido-title">
									Producto Moises Modelo Manioso #2
								</h6>
								<span
									class="producto-contenido-fabricante"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								<div
									class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
								>
									<div class="col-auto">
									<input
										type="number"
										class="form-control"
										id="numProdQuo"
										value="1"
									/>
									</div>
									<div class="col-auto">
									<button class="producto-contenido-boton btn btn-primary">
										Solicitar más información
									</button>
									</div>
								</div>
								</div>
							</div>
							<!-- 3er Producto -->
							<div
								id="prod3-show"
								class="elemento-vista-previa"
								style="display: none"
							>
								<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
								<img
									class="producto-thumbnail-vista-previa-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="producto-contenido p-2">
								<h6 class="producto-contenido-title">
									Producto Moises Modelo Manioso #3
								</h6>
								<span
									class="producto-contenido-fabricante"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								<div
									class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
								>
									<div class="col-auto">
									<input
										type="number"
										class="form-control"
										id="numProdQuo"
										value="1"
									/>
									</div>
									<div class="col-auto">
									<button class="producto-contenido-boton btn btn-primary">
										Solicitar más información
									</button>
									</div>
								</div>
								</div>
							</div>
						</div>
					';
					// $salida .= "
					// 			<li><a class='dropdown-item li-sug' href='#'>" . $fila['product_model'] . "</a></li>
					// 	";
				}
			} else {
				$salida .= '
					<!-- COLUMNA DE BUSQUEDA: CATEGORIAS, ARTICULOS Y PRODUCTOS -->
					<div class="col-6 border-end">
						<!-- CATEGORIAS: Se muestran solo 2 -->
						<div class="busqueda-categoria p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Categorias</h6>
							<div class="pt-2">
							<!-- 1ERA CATEGORIA -->
							<div id="catg1" class="categoria">
								<p class="categoria-title">Categoria #1.1.1</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							<!-- 2DA CATEGORIA -->
							<div id="catg2" class="categoria mt-2">
								<p class="categoria-title">Categoria #1.1.2</p>
								<span
								class="categoria-subtitle"
								style="color: dimgrey; font-size: 12px"
								>
								En Categoria #1 > Categoria #1.1
								</span>
							</div>
							</div>
						</div>
				
						<!-- ARTICULOS: Se muestran solo 2 -->
						<div class="busqueda-articulos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Entradas</h6>
							<div class="pt-2">
							<!-- 1era Entrada -->
							<div id="art1" class="articulo">
								<p class="articulo-title">Esta es una entrada #1</p>
							</div>
							<!-- 2da Entrada -->
							<div id="art2" class="articulo mt-2">
								<p class="articulo-title">Esta es una entrada #2</p>
							</div>
							</div>
						</div>
				
						<!-- PRODUCTOS: Se muestran 3 productos y un boton de ver mas -->
						<div class="busqueda-productos pt-3 p-2">
							<h6 class="busqueda-titulo pb-2 border-bottom">Productos</h6>
							<div class="py-2">
							<!-- 1er Producto -->
							<div id="prod1" class="producto row">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #1
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 2do Producto -->
							<div id="prod2" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #2
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							<!-- 3er Producto -->
							<div id="prod3" class="producto row mt-2">
								<div class="producto-thumbnail col-1">
								<img
									class="producto-thumbnail-img"
									src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
									alt=""
								/>
								</div>
								<div class="col-11">
								<p class="producto-title">
									Producto Moises Modelo Manioso #3
								</p>
								<span
									class="producto-subtitle"
									style="color: dimgrey; font-size: 12px"
								>
									Fabricante: Jorgito
								</span>
								</div>
							</div>
							</div>
							<!-- Boton de Ver Mas Productos -->
							<div class="ver-mas-productos w-100 border-top">
							VER TODOS LOS PRODUCTOS (999)
							</div>
						</div>
					</div>
					<!-- COLUMNA DE VISTA PREVIA SEGUN LO QUE SE SELECCIONE -->
					<div class="col-6 p-2">
						<!-- VISTA PREVIA CATEGORIAS -->
				
						<!-- 1era Categoria -->
						<div
							id="catg1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.1
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/Sa4e444a2049f4fa8acd861f71a113e2fR/Sanrio-mu-eco-de-peluche-de-Hello-Kitty-juguete-de-peluche-de-dibujos-animados-Kuromi-Cinnamoroll.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
						<!-- 2da Categoria -->
						<div
							id="catg2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<h6 class="mb-3" style="font-size: 16px">
							<span class="busqueda-titulo">Categoria:</span> Categoria #1.1.2
							</h6>
							<div class="categoria-lista">
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto mb-2">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							<div class="row categoria-lista-producto">
								<div class="col-2">
								<img
									class="categoria-lista-producto-img"
									src="https://ae01.alicdn.com/kf/S8ca3ed97a3b9400daf2e5734be5d1963f/2022-New-Sanrio-Cinnamoroll-Cosplay-Little-Tiger-Kawaii-Cartoon-Plushie-24Cm-Sitting-Position-Plush-Doll-Toys.jpg"
									alt="img-producto"
								/>
								</div>
								<div class="col-10">
								<h6>Producto Jorgito Modelo Manioso</h6>
								</div>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA ARTICULOS / ENTRADAS -->
				
						<!-- 1era Entrada -->
						<div
							id="art1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://cdn.lazyshop.com/files/51c1bb60-9635-448a-8d6f-922c802d1835/product/edf949f70eceafc06684ea194633dfd4.jpeg?x-oss-process=style%2Fthumb"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #1</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
						<!-- 2da Entrada -->
						<div
							id="art2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="articulo-thumbnail pb-2 border-bottom">
							<img
								class="articulo-thumbnail-img"
								src="https://ivybycrafts.com/cdn/shop/files/04748AB7-345D-4E9C-8E8A-102E50BD3464_1024x1024.jpg?v=1689745535"
								alt=""
							/>
							</div>
							<div class="articulo-contenido p-2">
							<h6 class="articulo-contenido-title">Esta es una entrada #2</h6>
							<p class="articulo-contenido-extracto">
								Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam
								facilisis vitae nulla vel suscipit. Donec fringilla augue eget
								augue sodales, in aliquet velit sodales. Vivamus facilisis ante
								vel tincidunt maximus. Fusce metus urna, euismod eget eleifend
								sit amet, fringilla et risus. Sed risus urna, elementum vel
								aliquet eu, varius eget erat. Maecenas fermentum, nulla vitae
								auctor rhoncus, tellus ex ultrices arcu, ut viverra odio mauris
								eget ligula.
							</p>
							<div class="d-flex justify-content-end pt-3 mt-2 border-top">
								<button class="articulo-contenido-boton btn btn-primary">
								Seguir leyendo
								</button>
							</div>
							</div>
						</div>
				
						<!-- VISTA PREVIA PRODUCTOS -->
				
						<!-- 1er Producto -->
						<div
							id="prod1-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #1
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 2do Producto -->
						<div
							id="prod2-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #2
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
						<!-- 3er Producto -->
						<div
							id="prod3-show"
							class="elemento-vista-previa"
							style="display: none"
						>
							<div class="producto-thumbnail-vista-previa pb-2 border-bottom">
							<img
								class="producto-thumbnail-vista-previa-img"
								src="https://m.media-amazon.com/images/I/61QLD7+dSjL._AC_UF894,1000_QL80_.jpg"
								alt=""
							/>
							</div>
							<div class="producto-contenido p-2">
							<h6 class="producto-contenido-title">
								Producto Moises Modelo Manioso #3
							</h6>
							<span
								class="producto-contenido-fabricante"
								style="color: dimgrey; font-size: 12px"
							>
								Fabricante: Jorgito
							</span>
							<div
								class="producto-cotizar row justify-content-end pt-3 mt-2 border-top"
							>
								<div class="col-auto">
								<input
									type="number"
									class="form-control"
									id="numProdQuo"
									value="1"
								/>
								</div>
								<div class="col-auto">
								<button class="producto-contenido-boton btn btn-primary">
									Solicitar más información
								</button>
								</div>
							</div>
							</div>
						</div>
					</div>
				';
				// $salida .= "<div class='nodatos'><p style='font-weight: bold; font-size: 1.1rem; margin-top: 0.5rem; margin-left: 1rem;'>No se encontraron datos para tu búsqueda</p></div>";
			}
		}
	}
}

$salida .= '
		</div>
	</div>
';

echo $salida;
$conexion->close();
?>