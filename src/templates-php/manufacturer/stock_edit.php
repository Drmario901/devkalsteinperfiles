<div class="container">
    <header class="header" data-header>
        <?php
            
            include 'navbar.php';

        ?>
        <script>
            let page = "stock";

            document.querySelector('#link-' + page).classList.add("active");
            document.querySelector('#link-' + page).removeAttribute("style");
        </script>
    </header>

    <article class="container article">

        <?php
            $banner_img = 'Header-fabricante-IMG.png';

            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_EditAnExistingProduct';
            $banner_text = translateTextBanner($banner);
            include 'banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/manufacturer/stock"><i class="fa-solid fa-share" data-i18n='manofacturer:volver'></i> Volver</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/manufacturer/stock/add" data-i18n='manofacturer:agregarProducto'>Añadir producto</a>
            <a class="nav-link" href="https://dev.kalstein.plus/plataforma/index.php/manufacturer/stock/shipping" data-i18n='manofacturer:costosEnvios'>Costos de envíos</a>
        </nav>
        
        <hr class="mt-0 mb-4">
        
        <div class="container tm-mt-big tm-mb-big">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <div class="row mb-4">
                            <select class="custom-select tm-select-accounts" style='border-radius: 5.6px' id="dataEdit" name="consulta">
                                <option selected value='0' data-i18n='manofacturer:elegirUnaOpcion'>Por favor, elija una opción</option>
                                <?php
                                    
                                    require __DIR__.'/../../../php/conexion.php';
        
                                    $acc_id = $_SESSION['emailAccount'];
            
                                    $consulta = "SELECT * FROM wp_k_products WHERE product_maker = '$acc_id' ORDER BY product_aid DESC";
            
                                    $resultado = $conexion->query($consulta);
                                        
                                    if ($resultado->num_rows > 0) {
                                        while ($value = $resultado->fetch_assoc()) {
                                            $p_id = $value["product_aid"];
                                            $p_name = $value["product_name_en"];
                                            
                                            if (isset($_GET["edit"])) {
        
                                                $edit = $_GET["edit"];
                                                
                                                if ($edit == $p_id){
                                                    echo "<option selected value='$p_id'>(ID: $p_id) $p_name</option>";
                                                }
                                                else {
                                                    echo "<option value='$p_id'>(ID: $p_id) $p_name</option>";
                                                }  
                                            }
                                            else {
                                                echo "<option value='$p_id'>(ID: $p_id) $p_name</option>";
                                            } 
                                        }
                                    }
            
                                ?>
                            </select>
                        </div>
                        <!-- OCULTO POR DEFECTO -->
                        <div id="formElements" class="row tm-edit-product-row" hidden>
                            <?php
                                $add = false;
                                include __DIR__.'/productForm.php';
                            ?>
                        </div>
                        <div id="formElementsbutton" class="col-12" hidden>
                            <center><button type="button" id="btnUpdateData" class="btn btn-primary btn-block text-uppercase" id="btnUpdateData" style='color: white; background-color: #de3a46 !important; border: none' data-i18n='manofacturer:agregarProductoAhora'>Editar producto ahora</button></center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <?php
        $footer_img = 'Footer-fabricante-IMG.png';
        include 'footer.php';
    ?>
</div>