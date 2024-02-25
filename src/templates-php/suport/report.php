<div class="contanier">
    <?php
    
        include 'navdar.php';
    
    ?>
    
    <script>
        let page = "reports";
    
        document.querySelector('#' + page).classList.add("active");
        document.querySelector('#' + page).removeAttribute("style");
    </script>
    
    <article class="container article">

        <?php
            $banner_img = 'Header-servicio-tecnico-IMG.jpg';
            $banner_text = "Bienvenido(a), $acc_name $acc_lname";
            include __DIR__.'/../manufacturer/banner.php';
        ?>
    
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="https://plataforma.kalstein.net/index.php/support/reports/" target="__blank">Lista de  Reportes</a>
            <hr class="mt-0 mb-4">
        </nav>
        
        <br>

        <div class="row mb-3">
            <div class="col-2">
                <input class="form-control" type="date" id="dateFrom">
            </div>
            <div class="col-2">
                <input class="form-control" type="date" id="dateTo">
            </div>
            <div class="col-2">
                <select class="form-control" id="estatus">
                    <option value="0" style="text-align: center;">-- Seleccionar Estatus --</option>
                    <option value="Pending">Pendiente</option>
                    <option value="Process">Procesado</option>
                </select>
            </div>
        </div>
      
        <div id="report-fails" class="table-responsive" width="100" ></div>
        
        <!-- Modal -->
        <div class="modal fade" id="modalReportSupport" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body c-reportRequest"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btnClosedModalReportSupport">Cerrado</button>
                        <button type="button" class="btn btn-primary" style='color: #fff;' id='btn-savedGeneratedQuo'>Generado</button>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <?php
        $footer_img = 'Footer-servicio-tecnico-IMG.jpg';
        include 'footer.php';
    ?>
</div>