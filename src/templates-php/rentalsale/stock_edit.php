<?php 
    session_start(); 
    if (isset($_SESSION['emailAccount'])){
        $acc_id = $_SESSION['account_id'];
    }
?>
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

<br>
<br>
<br>
<br>
<br>

<nav class="nav nav-borders">
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/stock">Products stock</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/stock/add"> Add rental service</a>
    <a class="nav-link" href="https://testing.kalstein.digital/index.php/rentalsale/stock/add/used">Add used product</a>
    <a class="nav-link active" href="https://testing.kalstein.digital/index.php/rentalsale/stock/edit">Edit product</a>
</nav>

<hr class="mt-0 mb-4">

<div class="container tm-mt-big tm-mb-big">
    <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
            <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
                <div class="row mb-4">
                    <div class="col-12">
                    </div>
                    <select class="custom-select tm-select-accounts" style="color: #000 !important;" id="dataEdit" name="consulta">
                        <option selected value='0'>Please, choose an option</option>
                        <?php
                            
                            require __DIR__.'/../../../php/conexion.php';
    
                            $consulta = "SELECT * FROM wp_k_products WHERE product_maker = '$acc_id'";
    
                            $resultado = $conexion->query($consulta);

                            echo $consulta;
                            if ($resultado->num_rows > 0) {
                                while ($value = $resultado->fetch_assoc()) {
                                    $p_id = $value["product_aid"];
                                    $p_name = $value["product_name_en"];
                                    
                                    if (isset($_GET["edit"])) {

                                        $edit = $_GET["edit"];
                                        
                                        if ($edit == $p_id){
                                            echo "<option selected style='color: #000 !important;' value='$p_id'>(ID: $p_id) $p_name</option>";
                                        }
                                    }
                                    else {
                                        echo "<option style='color: #000 !important;' value='$p_id'>(ID: $p_id) $p_name</option>";
                                    }   
                                }
                            }
    
                        ?>
                    </select>
                </div>
                <!-- OCULTO POR DEFECTO -->
                <div id="formElements" class="row tm-edit-product-row" hidden>
                    <?php
                        $edit=true;
                        include __DIR__.'/productFormEdit.php';
                    ?>
                </div>
                <div id="formElementsbutton" class="col-12" hidden>
                    <center><button type="button" id="btnUpdateData" class="btn btn-primary btn-block text-uppercase" id="btnUpdateData">Edit Product Now</button></center>
                </div>
            </div>
        </div>
    </div>
</div>