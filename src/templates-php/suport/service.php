<div class="container">
    <?php
    
        include 'navdar.php';
        require "conexion.php";

       /*  $sql = "SELECT DISTINCT categorie_line FROM wp_categories";
        $res = $conexion->query($sql); */
        
        /* while($result = $res->fetch_array()){ */
            /* echo $result["categorie_line"]; */
       /*  } */
        
    ?>
    <script>
        let page = "services";
    
        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>
    
    <article class="container article">
    
        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            $banner_text = "Servicios";
            include __DIR__.'/../manufacturer/banner.php';
        ?>
    
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="https://plataforma.kalstein.net/index.php/support/services/">Servicios</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/index.php/support/services/add">Añadir Servicio</a>
            <a class="nav-link" href="https://plataforma.kalstein.net/index.php/support/services/edit">Modificar Servicio</a>
            <hr class="mt-0 mb-4">
        </nav>
        <br>
        <div class="category-select d-flex mb-3">
            <i class="fa-solid fa-search h5 me-2 mt-2"></i>
            <select class="form-control mb-2" type="date" id="category">
                <option value="0">Seleccione Categoria</option>
                
            </select>
        </div>
        <div class="category-select d-flex mb-3">
            <i class="fa-solid fa-play h5 me-2 mt-2"></i>
            <select class="form-control" id="estatus">
                <option value='' selected>Selecciona un estatus</option>
                <option value="Activated">Activated</option>
                <option value="Disabled">Disabled</option>
            </select>
        </div>
        <div id="report-fails" class="table-responsive" width="100">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Categoria Linea</th>
                        <th scope="col">Categoria Descripción</th>
                        <th scope="col">Sub Categoria</th>
                    </tr>
                </thead>
                <tbody>
                   <!--  <tr>
                        <th scope="row">1</th>
                        <td>Categoria Linea 1</td>
                        <td>Categoria Descripción 1</td>
                        <td>Sub Categoria 1</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Categoria Linea 2</td>
                        <td>Categoria Descripción 2</td>
                        <td>Sub Categoria 2</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
        
        <style>
            #category {
                padding: 12px 20px;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            
            #estatus {
                width: 200px;
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
    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>    
<script></script>
