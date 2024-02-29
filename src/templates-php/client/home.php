<?php
    session_start();

    if(isset($_SESSION['user_tag'])) {
        $userTag = $_SESSION['user_tag'];
    }

?>

   <div id='c-panel01' class='col-sm-12' style='height: auto;<?php echo isset($_GET['search']) || isset($_GET['userToConsultPriceShipping'])? 'display: none' : '' ?>'>
        <?php
            $banner_img = 'Header-usuario-IMG.png';
            // Obtener el idioma del cookie
           // $language = isset($_COOKIE['language']) ? $_COOKIE['language'] : 'en';

            // Incluir el archivo de traducciones
            // require __DIR__. '/../../../php/translations.php';

            // Determinar el texto del banner según el idioma
           // $banner_text_translation = isset($translations[$language]['banner_text_welcome']) ? $translations[$language]['banner_text_welcome'] : $translations['en']['banner_text_welcome'];

           // $name = isset($name) ? $name : '';
          //  $lastname = isset($lastname) ? $lastname : '';
            
            // Incluir el banner.php pasando el texto traducido y el nombre del usuario
           // $banner_text = sprintf($banner_text_translation, $name, $lastname);
            
            require __DIR__. '/../../../php/translateTextBanner.php';
            $banner = 'banner_text_welcome';
            translateTextBanner($banner);
            include 'banner.php';
        ?>
        <div class='row'>
            <div class='col-12 col-md-4'>
                <div class='c-cantQuote rounded d-flex flex-row justify-content-between'>
                    <div style='text-align: center; font-size: 4.5em; float: left;' class='ms-4'>
                        <i class='fa-solid fa-file-circle-check' style='color: #0eab13'></i>
                    </div>
                    <div>
                        <p style='margin: 0px; padding: 0px; margin-top: 0.5rem; font-weight: bold; font-size: 2.5em; text-align: right; margin-right: 1.5rem;'><?php echo $cantQuoteProcessFull ?></p>
                        <p style='margin: 0px; padding: 0px; font-size: 1.2em; font-weigth: bold; text-align: right; margin-right: 1.5rem;'><b data-i18n="client:cotizacionProcesada">Cotizaciones procesadas</b></p>
                    </div>
                </div>
            </div>
            <div class='col-12 col-md-4'>
                <div class='c-cantQuote rounded d-flex flex-row justify-content-between'>
                    <div style='text-align: center; font-size: 4.5em; float: left;' class='ms-4'>
                        <i class='fa-solid fa-file-circle-exclamation' style='color: #ff9d00'></i>
                    </div>
                    <div>
                        <p style='margin: 0px; padding: 0px; margin-top: 0.5rem; font-weight: bold; font-size: 2.5em; text-align: right; margin-right: 1.5rem;'><?php echo $cantQuotePending ?></p>
                        <p style='margin: 0px; padding: 0px; font-size: 1.2em; font-weigth: bold; text-align: right; margin-right: 1.5rem;' data-i18n="client:cotizacionPendiente"><b>Cotizaciones pendientes</b></p>
                    </div>
                </div>
            </div>
            <div class='col-12 col-md-4'>
                <div class='c-cantQuote rounded d-flex flex-row justify-content-between'>
                    <div style='text-align: center; font-size: 4.5em; float: left;' class='ms-4'>
                        <i class='fa-solid fa-file'  style='color: #213280;'></i>
                    </div>
                    <div>
                        <p style='margin: 0px; padding: 0px; margin-top: 0.5rem; font-weight: bold; font-size: 2.5em; text-align: right; margin-right: 1.5rem;'><?php echo $cantQuote ?></p>
                        <p style='margin: 0px; padding: 0px; font-size: 1.2em; font-weigth: bold; text-align: right; margin-right: 1.5rem;' data-i18n="client:cotizacionTotal"><b>Cotizaciones totales</b></p>
                    </div>
                </div>
            </div>
        </div>                                    
        <div class='row' style='margin-top: 1rem;'>
            <div class='col'>
                <div class='containerD01'>
                    <div class='subcD01'>
                        <i class='fa-solid fa-user-gear' style='color: #213280;'></i>
                        <h3 style='margin-top: 1rem; color: #213280;' data-i18n="client:completaPerfilUs">Completa perfil de usuario</h3>
                    </div>
                    <div class='subcD02'>
                        <div class='contentChart'>
                            <canvas id='myChart'></canvas>
                        </div>                                                
                        <div class='contentButtons'>                                              
                            <button class='btn-complete-profile' id='btnBirthdayCPR'
                                <?php if ($birthdayAcc != '0000-00-00'){
                                    $displayBirthday = 'none';
                                }else{
                                    $displayBirthday = 'inline';
                                }
                            echo "style='display : $displayBirthday'  data-i18n='client:agregrarCumple'>Añadir cumpleaños</button>
                            <button class='btn-complete-profile' id='btnNameCompanyCPR'";
                                if ($companyName != ''){
                                    $displayCompany = 'none';
                                }else{
                                    $displayCompany = 'inline';
                                }
                            echo "style='display : $displayCompany' data-i18n='client:agregarNombre'>Añadir nombre de compañía</button>
                            <button class='btn-complete-profile' id='btnImgDocumentCPR'";
                                if ($imageDocument != ''){
                                    $displayCompany = 'none';
                                }else{
                                    $displayCompany = 'inline';
                                }
                            echo "style='display : $displayCompany' data-i18n='client:agregarFotoIden' >Añadir foto de documento de identidad</button>
                            <button class='btn-complete-profile' id='btnIdDocCPR'";
                                if ($iDocument != ''){
                                    $displayCompany = 'none';
                                }else{
                                    $displayCompany = 'inline';
                                }
                            echo "style='display : $displayCompany' data-i18n='client:agregarNumDoc' >Añadir número de documento</button>
                            <button class='btn-complete-profile' id='btnImgDocBussinessCPR'";
                                if ($company_image_rif != ''){
                                    $displayCompany = 'none';
                                }else{
                                    $displayCompany = 'inline';
                                }
                            echo "style='display : $displayCompany' data-i18n='client:agregarFotoLegal' >Foto del documento legal de compañía</button>
                            <button class='btn-complete-profile' id='btnRifBussinessCPR'";
                                if ($companyRif != ''){
                                    $displayCompany = 'none';
                                }else{
                                    $displayCompany = 'inline';
                                }
                            echo "style='display : $displayCompany' data-i18n='client:agregarDocumento' >Añadir documento legal de compañía</button>
                            <button class='btn-complete-profile' id='btnRoleCompanyCPR'";
                                if ($companyRole != ''){
                                    if ($companyRole != 0){
                                        $displayRole = 'none';
                                    }else{
                                        $displayRole = 'inline';
                                    }
                                }else{
                                    $displayRole = 'inline';
                                }
                            echo "style='display : $displayRole' data-i18n='client:agregarRoll' >Añadir rol de compañía</button>
                            <button class='btn-complete-profile' id='btnAddressCompanyCPR'";
                                if ($companyAddress != ''){
                                    $displayAddress = 'none';
                                }else{
                                    $displayAddress = 'inline';
                                }
                            echo "style='display : $displayAddress' data-i18n='client:agregarDireccion' >Añadir dirección de compañía</button>
                            <button class='btn-complete-profile' id='btnCountryCompanyCPR'";
                                if ($companyCountry != ''){
                                    $displayCountry = 'none';
                                }else{
                                    $displayCountry = 'inline';
                                }
                            echo "style='display : $displayCountry' data-i18n='client:agregarPais' >Añadir país de companía</button>
                            <button class='btn-complete-profile' id='btnCompanyStateCPR'";
                                if ($companyState != ''){
                                    $displayState = 'none';
                                }else{
                                    $displayState = 'inline';
                                }
                            echo "style='display : $displayState' data-i18n='client:agregarCiudad' >Añadir ciudad de compañía</button>
                            <button class='btn-complete-profile' id='btnZipcodeCompanyCPR'";
                                if ($companyZipcode != ''){
                                    $displayZipcode = 'none';
                                }else{
                                    $displayZipcode = 'inline';
                                }
                            echo "style='display : $displayZipcode' data-i18n='client:agregarPostal' >Añadir código postal de compañía</button>
                            <button class='btn-complete-profile' id='btnPhoneCompanyCPR'";
                                if ($companyPhone != ''){
                                    $displayPhone = 'none';
                                }else{
                                    $displayPhone = 'inline';
                                }
                            echo "style='display : $displayPhone' data-i18n='client:agregarTlf' >Añadir teléfono de compañía</button>
                            <button class='btn-complete-profile' id='btnWebsiteCompanyCPR'";
                                if ($companyWebsite != ''){
                                    $displayWebsite = 'none';
                                }else{
                                    $displayWebsite = 'inline';
                                }
                            echo "style='display : $displayWebsite' data-i18n='client:agregarWeb' >Añadir sitio web de compañía</button>
                            <button class='btn-complete-profile' id='btnProfileImageCPR'";
                                if ($imgPerfil != ''){
                                    $displayImgProfile = 'none';
                                }else{
                                    $displayImgProfile = 'inline';
                                }
                            echo "style='display : $displayBirthday' data-i18n='client:agregarImg' >Añadir imagen de perfíl</button></div>";
                        ?>
                        <div class='contentProfileComplete' style='display: none; text-align: center; margin-top: 1rem;'>
                            <p style='font-weight: bold; font-size: 1.5em;' data-i18n="client:felicidadesCompleto">¡Felicidades, tu perfil está completo!</p>
                        </div>
                    </div>
                </div>
                <div id="containerD04" style='display: none;'>
                    <h3 style='text-align: center; color: #213280;' data-i18n="client:resumenCotizacion">Resumen de cotizaciones</h3>
                    <canvas id='widgetQuotes'></canvas>
                </div>
                <div class='containerD02' hidden>
                    <div class='subcD0201'>                                       
                        <div>
                            <p style='font-size: 1.1em; width: 90%; margin-top: 7rem;' data-i18n="client:kalsteinDerechos">Establecer por defecto las opciones a seleccionar en las cotizaciones acelera un poco más el proceso de generación de cotizaciones.</p>
                            <button id='btnToConfigQuote' style='background-color: #212380; outline: none; color: #fff; padding: 0.2rem 0.5rem; border: none; border-radius: 8px;' data-i18n="client:kalsteinDerechos">Configura aquí!</button>
                        </div>
                    </div>
                    <div class='subcD0202'>                                            
                        <i class='fa-solid fa-gears'  style='color: #213280;'></i>
                        <h3 style='margin-top: 3rem; color: #213280;' data-i18n="client:metodosDeCotizacion">Configura tus metodos de cotización</h3>
                    </div> 
                </div>
                <div class='containerD03'>
                    <h5 style='float: left; width: 100%; background-color: #213280; color: #fff; padding-left: 1rem; padding-top: 0.5rem;' data-i18n='client:actividad' >Actividad</h5>  
                    <div class='subcD03'>
                        <h3 style='margin-top: 0.5rem; margin-left: 1rem;' data-i18n="client:cotizacionReciente" >Cotizaciones recientes</h3>
                        <div class='c-recentQuotes' id='c-recentQuotes' style='width: 100%; text-align: center;'>
                            
                        </div>
                        <div class='c-buttonViewMore'>
                            <p style='font-size: 1.1em;' data-i18n="client:masRecientes">Solo las 10 más recientes</p>
                            <button id='btnViewMoreRecentQuotes' style='background-color: #212380; outline: none; color: #fff; padding: 0.1rem 0.3rem; border: none; margin-bottom: 1rem;' data-i18n='client:verMas' >
                                Ver más
                            </button>
                        </div>
                    </div>    
                    <div class='subcD04'>
                        <h3 style='margin-top: 0.5rem; margin-left: 1rem;' data-i18n="client:busquedasRecientes" >Búsquedas recientes</h3>
                        <div class='c-recentSearch' id='c-recentSearch' style='width: 100%; text-align: center;'>
                        
                        </div>
                        <div class='c-buttonViewMore'>                                            
                            <p style='font-size: 1.1em;' data-i18n="client:masRecientes">Solo las 10 más recientes.</p>
                            <button id='btnViewMoreRecentSearches' style='background-color: #212380; outline: none; color: #fff; padding: 0.1rem 0.3rem; border: none; margin-bottom: 1rem;' data-i18n="client:verMas">
                                Ver más
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 