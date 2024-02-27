<div id='c-panel03' style='display: none;'>

    <?php
        $banner_img = 'Header-usuario-IMG.png';
        $banner_text = "Registro";
        include 'banner.php';
    ?>

    <div class='container-xl px-4 mt-4'>
        <nav class='nav nav-borders'>
            <a class='nav-link active ms-0' href='#' id='btnSearches'><small data-i18n="client:busquedas">Búsquedas</small></a>
            <a class='nav-link ms-1' href='#' id='btnAccess'><small  data-i18n="client:accesos">Accesos</small></a>
            <a class='nav-link ms-1' href='#' id='btnUpdates'><small data-i18n="client:actualizaciones" >Actualizaciones</small></a>
            <a class='nav-link ms-1' href='#' id='btnDeletes'><small data-i18n="client:eliminaciones">Eliminaciones</small></a>
        </nav>
        <hr class='mt-0 mb-4'>
        <div id='c-searches'>
            <div class='row'>
                <div class='col-xl-12'>
                    <div id='tblSearches' class='table-responsive'>
                    </div>
                </div>
            </div>
        </div>
        <div id='c-access' style='display: none;'>
            <div id='tblAccess' class='table-responsive'>
            
            </div>
        </div>
        <div id='c-updates' style='display: none;'>
            <div id='tblUpdates' class='table-responsive'>
            
            </div>
        </div>
        <div id='c-deletes' style='display: none;'>
            <div id='tblDeletes' class='table-responsive'>
            
            </div>
        </div>
        <div id='c-notifications' style='display: none;'>
            <div id='' class='table-responsive'>
            
            </div>
        </div>
    </div>
</div>