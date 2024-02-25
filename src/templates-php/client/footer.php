<footer class="footer-kalstein" style="background-image: linear-gradient(rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0.15)), url('https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/banner-footer/<?php echo $footer_img ?>');">
    <div class="container">
        <div>
            <img class='kalstein-logo-footer' src="https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/images/LOGO-KALSTEIN-02-WHITE.png" alt="kalstein_plus">
            <p><span>Déjanos saber lo que necesitas y nosotros nos encargaremos del resto</span></p>
        </div>
        <div>
            <h5>Acceso rápido</h5>
            <ul>
                <li class="footer-item">
                    <a href='#' id='btnQuotePr01'>Mis cotizaciones</a>
                </li>
                
                <li class="footer-item">
                    <a href='#' id='btnRecentActivityPr01'>Actividad</a>
                </li>
                
                <li class="footer-item">
                    <a href='#' id='btnCatalogs'>Catálogos</a>
                </li>
                
                <!--li class="footer-item">
                    <a href='#' id='btnReportPr01'>Support Services</a>
                </li-->
            </ul>
        </div>
        <div>
            <h5>Servicio al Consumidor</h5>
            <ul>
                <li class="footer-item">
                    <a href="#" id='sendEmail'>Chat en línea</a>
                </li>
    
                <li class="footer-item">
                    <a href="#" id='chatOnline'>Enviar un correo electrónico</a>
                </li>
                <li class="footer-item">
                <a href="#" id="btnMail">Inbox</a>
                </li>
            </ul>
        </div>
        <div>
            <h5>Síguenos</h5>
            <ul>
                <li class="footer-icon">
                    <a class="d-inline" href='https://www.instagram.com/kalsteinlab/?hl=es' target="__blank"><i class="fa-brands fa-instagram"></i> Instagram</a>
                </li>
                <li class="footer-icon">
                    <a class="d-inline" href='https://www.facebook.com/KalsteinEn/?ref=bookmarks' target="__blank"><i class="fa-brands fa-square-facebook"></i> Facebook</a>
                </li>
                <li class="footer-icon">
                    <a class="d-inline" href='https://www.youtube.com/channel/UCwWi7T-6oii6lHrkGzKbevw' target="__blank"><i class="fa-brands fa-youtube"></i> YouTube</a>
                </li>
                <li class="footer-icon">
                    <a class="d-inline" href='https://www.linkedin.com/in/kalstein-france-24217b146?trk=author_mini-profile_title' target="__blank"><i class="fa-brands fa-linkedin"></i> LinkedIn</a>
                </li>
            </ul>
        </div>
        <div class="order-first order-md-last">
            <h5>Ser visto</h5>
            <div class="footer-main-button-quo" id='btnGenQuote' style='cursor: pointer'>GENERA TU COTIZACIÓN</div>
        </div>
    </div>
    <div class='text-white my-3 text-center'>© <?php echo date('Y') ?> Kalstein. Todos los derechos reservados.</div>
</footer>

<script>
document.getElementById("sendEmail").addEventListener("click", function(event) {
    event.preventDefault(); 
});

document.getElementById("chatOnline").addEventListener("click", function(event) {
    event.preventDefault(); 
});
</script>