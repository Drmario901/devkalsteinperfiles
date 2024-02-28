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
            $banner_text = "Edit an existing product";
            include 'banner.php';
        ?>

        <nav class="nav nav-borders">
            <a class="nav-link" href="https://platform.kalstein.us/index.php/manufacturer/stock" data-i18n="manofacturer:productoStock">Products stock</a>
            <a class="nav-link" href="https://platform.kalstein.us/index.php/manufacturer/stock/add" data-i18n="manofacturer:agregarProducto"> Add product</a>
            <a class="nav-link" href="https://platform.kalstein.us/index.php/manufacturer/stock/add/accessories" data-i18n="manofacturer:agregarAccesorio2"> Add accessory</a>
            <a class="nav-link" href="https://platform.kalstein.us/index.php/manufacturer/stock/shipping" data-i18n="manofacturer:costoEnvio"> Shipping Costs</a>
        </nav>
        
        <hr class="mt-0 mb-4">
        
        <div class="container tm-mt-big tm-mb-big">
            <div class="row">
                <div class="col-12 mx-auto">
                    <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                        <div class="row mb-4">
                            <select class="custom-select tm-select-accounts" style='border-radius: 5.6px' id="dataEdit" name="consulta">
                                <option selected value='0' data-i18n="manofacturer:elegirOpcion">Please, choose an option</option>
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
                            <center><button type="button" id="btnUpdateData" class="btn btn-primary btn-block text-uppercase" id="btnUpdateData" style='color: white; background-color: #de3a46 !important; border: none' data-i18n="manofacturer:editarAccesorio">Edit Accessory</button></center>
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