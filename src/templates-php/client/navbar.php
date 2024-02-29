<header class='header' data-header>
    <div class='container'>
        <h1 class='mt-auto pb-3'>
            <a id='btn-logo' href='https://dev.kalstein.plus/plataforma/'><img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/LOGO-KALSTEIIN-PLUS-2.png' alt='Kalstein' width='200' height='40'></a>
        </h1>                
        <button class='menu-toggle-btn icon-box' data-menu-toggle-btn aria-label='Toggle Menu'>
            <span class='material-symbols-rounded  icon' style='color: #213280'>menu</span>
        </button>                
        <nav class='navbar'>
            <div class='container'>
                <ul class='navbar-list'>
                    <div class="d-flex flex-row">
                        <li>
                            <a href='#' id='btnMail' class='navbar-link icon-box'>
                                <span class='material-symbols-rounded icon position-relative'>
                                    mail
                                    <span id='messagesBaloon' class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style='font-family: sans-serif; font-size: 10px' hidden>
                                        <div id='messagesCant' class="unread-messages"></div>
                                    </span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href='#' id='btnEditProfilePr01' class='navbar-link icon-box'>
                                <span class='material-symbols-rounded  icon' >settings</span>
                            </a>
                        </li>
                        <li>
                            <a href='#' id='btn-logout' class='navbar-link icon-box'>
                                <span class='material-symbols-rounded  icon'>logout</span>
                            </a>
                        </li>                        
                    </div>                        
                    <li>
                        <a href='#' class='header-profile'>
                            <figure class='profile-avatar' style='margin-top: 0.5rem;'>
                                <img src='https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/images/<?php echo $urlImagePerfil?>' alt='Profile 1' style='width: 50px; height: 50px'>
                            </figure>                            
                            <div>
                                <p class='profile-title' style='color: #000;'><?php echo $name." ".$lastname?></p>
                                <p class='profile-subtitle'><?php echo $userTag = $row['user_tag'];?></p> 
                            </div>                            
                        </a>                         
                    </li>                        
                </ul>             
                <ul class='navbar-list'>
                    <li>
                        <a href='#' id='btnDashboardPr01' class='navbar-link active icon-box'>          
                            <span data-i18n="client:dashboard">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href='#' id='btnQuotePr01' class='navbar-link icon-box'>           
                            <span data-i18n="client:misCotizaciones">Mis cotizaciones</span>
                        </a>
                    </li>
                    <li>
                        <a href='#' id='btnRecentActivityPr01' class='navbar-link icon-box'>           
                            <span data-i18n="client:actividad">Actividad</span>
                        </a>
                    </li>
                    <li>
                        <a href='#' id='btnCatalogs' class='navbar-link icon-box'>
                            <span data-i18n="client:catalogos">Catálogos</span>
                        </a>
                    </li>                        
                    <li>
                        <a href='#' id='btnReportPr01' class='navbar-link icon-box'>
                            <span data-i18n="client:soporteTecnico">Soporte técnico</span>
                        </a>
                    </li>
                    <!--li>
                        <a href="#" id="diagnosis-app" class='navbar-link icon-box'>
                            <span>Diagnóstico</span>
                        </a>
                    </li-->
                    <li class='generate-quote'>
                        <a href='#' id='btnGenQuote' class='navbar-link icon-box' style='color: white !important;'>
                            <span data-i18n="client:generarCotizacion">GENERA TU COTIZACIÓN</span>
                        </a>
                    </li>                       
                </ul>                        
            </div>
        </nav>                
    </div>
    <div class="container flex-column">
        <div class="hr mb-2"></div>
        <?php
            echo navbar();
        ?>
    </div>
</header>

<!-- HREF DIAGNOSIS APP-->
<script>
    var link = document.getElementById('diagnosis-app');

        link.onclick = function() {
            window.location.href = 'https://dev.kalstein.plus/plataforma/diagnosis/diagsys.php';
        };
    </script>

    <!-- SECRET -->
<script>
document.addEventListener("DOMContentLoaded",function(){let e="";document.addEventListener("keydown",function(t){let i=String.fromCharCode(t.which).toLowerCase();(e+=i).includes("doom")&&(function e(){var t=document.getElementById("gameModalOverlay");if(!t){(t=document.createElement("div")).id="gameModalOverlay",t.style.cssText="position: fixed; z-index: 1050; left: 0; top: 0; width: 100%; height: 100%; display: none; align-items: center; justify-content: center; background-color: rgba(0, 0, 0, 0.75);",document.body.appendChild(t);var i=document.createElement("div");i.id="gameModal",i.style.cssText="position: relative; background-color: white; padding: 0; border-radius: 8px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5); width: 95%; max-width: 95%; height: 95%; max-height: 95%; display: flex; align-items: center; justify-content: center;";var n=document.createElement("iframe");n.style.cssText="width: 100%; height: 100%; border: none;",n.src="https://js-dos.com/games/doom.exe.html",i.appendChild(n);var o=document.createElement("button");o.innerHTML="&times;",o.style.cssText="position: absolute; top: 10px; right: 10px; background: white; border: 1px solid black; border-radius: 50%; font-size: 24px; font-weight: bold; cursor: pointer; width: 30px; height: 30px; line-height: 28px; text-align: center;",o.onclick=function(){t.style.display="none"},i.appendChild(o),t.appendChild(i)}t.style.display="flex"}(),e=""),e.length>4&&(e=e.substr(-4))})});

document.addEventListener("DOMContentLoaded",function(){let e="";document.addEventListener("keydown",function(t){let i=String.fromCharCode(t.which).toLowerCase();(e+=i).includes("contr")&&(function e(){var t=document.getElementById("gameModalOverlay");if(!t){(t=document.createElement("div")).id="gameModalOverlay",t.style.cssText="position: fixed; z-index: 1050; left: 0; top: 0; width: 100%; height: 100%; display: none; align-items: center; justify-content: center; background-color: rgba(0, 0, 0, 0.75);",document.body.appendChild(t);var i=document.createElement("div");i.id="gameModal",i.style.cssText="position: relative; background-color: white; padding: 0; border-radius: 8px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5); width: 95%; max-width: 95%; height: 95%; max-height: 95%; display: flex; align-items: center; justify-content: center;";var n=document.createElement("iframe");n.style.cssText="width: 100%; height: 100%; border: none;",n.src="https://www.retrogames.cz/play_022-NES.php",i.appendChild(n);var o=document.createElement("button");o.innerHTML="&times;",o.style.cssText="position: absolute; top: 10px; right: 10px; background: white; border: 1px solid black; border-radius: 50%; font-size: 24px; font-weight: bold; cursor: pointer; width: 30px; height: 30px; line-height: 28px; text-align: center;",o.onclick=function(){t.style.display="none"},i.appendChild(o),t.appendChild(i)}t.style.display="flex"}(),e=""),e.length>4&&(e=e.substr(-4))})});

    document.addEventListener("DOMContentLoaded",function(){let e="";document.addEventListener("keydown",function(t){let i=String.fromCharCode(t.which).toLowerCase();(e+=i).includes("mcr")&&(function e(){var t=document.getElementById("gameModalOverlay");if(!t){(t=document.createElement("div")).id="gameModalOverlay",t.style.cssText="position: fixed; z-index: 1050; left: 0; top: 0; width: 100%; height: 100%; display: none; align-items: center; justify-content: center; background-color: rgba(0, 0, 0, 0.75);",document.body.appendChild(t);var i=document.createElement("div");i.id="gameModal",i.style.cssText="position: relative; background-color: white; padding: 0; border-radius: 8px; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5); width: 95%; max-width: 95%; height: 95%; max-height: 95%; display: flex; align-items: center; justify-content: center;";var n=document.createElement("iframe");n.style.cssText="width: 100%; height: 100%; border: none;",n.src="http://www.google.com/custom?q=&btnG=Search",i.appendChild(n);var o=document.createElement("button");o.innerHTML="&times;",o.style.cssText="position: absolute; top: 10px; right: 10px; background: white; border: 1px solid black; border-radius: 50%; font-size: 24px; font-weight: bold; cursor: pointer; width: 30px; height: 30px; line-height: 28px; text-align: center;",o.onclick=function(){t.style.display="none"},i.appendChild(o),t.appendChild(i)}t.style.display="flex"}(),e=""),e.length>4&&(e=e.substr(-4))})});
</script>
