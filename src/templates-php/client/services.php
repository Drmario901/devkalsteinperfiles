<div id='c-panel05' style='display: none;'>

    <?php
        $banner_img = 'Header-usuario-IMG.png';
        $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

                // Incluir el archivo de traducciones
                require __DIR__. '/../../../php/translations.php';

                // Determinar el texto del banner según el idioma
                $banner_text_translation = isset($translations[$language]['banner_text_find_support_agent']) ? $translations[$language]['banner_text_find_support_agent'] : $translations['en']['banner_text_find_support_agent'];

                // Incluir el banner.php pasando el texto traducido
                $banner_text = $banner_text_translation;
        include 'banner.php';
    ?>

    <nav class='nav nav-borders'>
        <a class='nav-link active ms-0' href='#' id='btnHistorySupportPR01' data-i18n="client:historia">Historia</a>
        <a class='nav-link' href='#' id='btnOrderSupportPR01' data-i18n="client:ordenServicio">Orden de Servicio</a>
    </nav>
    
    <hr>

    <div id='c-historySupportPR01' style='display: none;'>
        <div class='row'>
            <div class='col-12 input-wrapper-p'>
                <i class='fa-solid fa-magnifying-glass second-glass second-glass-2'></i>
                <input type='text' id='inputSearchServiceSupport' class="border border-2 rounded ps-4" placeholder='Buscar el servicio de su requerimiento' data-placeholder='buscarServicio'>
            </div>
            <div id='c-listSupportReports' class='col-12 table-responsive'>
        
            </div>
        </div>
    </div>
    <div id='c-orderSupportPR01' style='display: none;'>
        <div class='row'>
            <div class='col-12 input-wrapper-p'>
                <i class='fa-solid fa-magnifying-glass second-glass second-glass-2'></i>
                <input type='text' id='inputSearchServiceSupport' class="border border-2 rounded ps-4" placeholder='Buscar un agente de soporte' data-placeholder='buscarAgente'>
            </div>
            <div id='c-listSupportServices' class='col-12'>
            </div>
        </div>
    </div>
    <div id='c-rental-equipments' style='display: none;'>
        <?php
            require __DIR__.'/quotes/rental.php';
        ?>
    </div>
</div>

<!-- Modal -->
<div class='modal fade' id='exampleModal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-body'>
                <div class='row'>
                    <div class='col-12'>
                        <span class='titleRequestServices' id='tltNameAgent'></span>
                        <span class='titleRequestServices' id='tltServiceAgent'></span>
                        <span class='titleRequestServices' id='tltCategorieService'></span>
                    </div>
                </div>
                <hr>
                <div class='form-group mb-3'>
                    <label for='product' data-i18n="client:modeloProducto">Modelo del Producto:</label>
                    <select id='Rproduct' class='custom-select tm-select-accounts' name='category'>
                        
                    </select>
                    <input type="text" id='otherModel' style='display: none; margin-top: 1rem;' placeholder='Modelo de Equipo' data-placeholder='modeloEquipo'>                 
                    <br>
                    <div class='row tm-edit-product-row'>
                        <div class='form-group mb-3'>
                            <label for='description' data-i18n="client:escribeAplicacion">Escribe la aplicación:</label>
                            <textarea id='RDescription' class='form-control validate' required></textarea>
                        </div>   
                        <div class='form-group mb-3'>                                               
                            <label for='Level' data-i18n="client:nivelExigencia">Nivel de Exigencia:</label>
                            <select id='Rnivel' class='custom-select tm-select-accounts' name='category'>
                                <option selected value='0' data-i18n="client:eligeOpcion">Elige una opción</option>
                                <option value='Bajo' data-i18n="client:bajo">Bajo</option>
                                <option value='Media' data-i18n="client:media">Media</option>
                                <option value='Alto' data-i18n="client:alto">Alto</option>
                            </select>
                        </div> 
                    </div>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' id='btnClosedModalTicket' data-i18n="client:historia">Cerrar</button>
                <button type='button' class='btn btn-primary' id='savedTicket' data-i18n="client:historia">Generar Ticket</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal View -->
<div class='modal fade' id='modelViewReport' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-body'>
                <div class='form-group mb-3' id='c-reportSelect'>
                </div>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal' id='btnClosedModalTicket'>Cerrar</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/css/iziToast.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js"></script>