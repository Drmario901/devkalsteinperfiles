Query(document).ready(function() {
    cargarDatos();

    function cargarDatos(pagina = 1) {
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/quotesMonetico.php', // Asegúrate de que la ruta es correcta
            type: 'GET',
            data: { pagina: pagina },
            success: function(response) {
                $('#datos-tabla').html(generarTabla(response.datos));
                $('#paginacion').html(generarPaginacion(response.paginaActual, response.totalPaginas));
            },
            error: function() {
                $('#datos-tabla').html('<p>Hubo un error al cargar los datos.</p>');
                $('#paginacion').html('');
            }
        });
    }

    function generarTabla(datos) {
        let tablaHtml = '<table class="table"><thead><tr><th>ID</th><th>ID Cotización</th><th>Monto Total</th><th>Divisa</th><th>ID Remitente</th><th>Estado del Pago</th></tr></thead><tbody>';
        datos.forEach(function(fila) {
            tablaHtml += `<tr><td>${fila.id}</td><td>${fila.id_cotizacion}</td><td>${fila.monto_total}</td><td>${fila.cotizacion_divisa}</td><td>${fila.cotizacion_id_remitente}</td><td>${fila.status_payment}</td></tr>`;
        });
        tablaHtml += '</tbody></table>';
        return tablaHtml;
    }

    function generarPaginacion(paginaActual, totalPaginas) {
        let paginacionHtml = '<nav><ul class="pagination">';
        for(let i = 1; i <= totalPaginas; i++) {
            paginacionHtml += `<li class="page-item ${paginaActual === i ? 'active' : ''}"><a class="page-link" href="#" onclick="cargarDatos(${i});return false;">${i}</a></li>`;
        }
        paginacionHtml += '</ul></nav>';
        return paginacionHtml;
    }

    $('#boton-verify').click(function() {
        alert('¡Botón clickeado!');
    });
});

$(document).ready(function() {
    $(document).on('click', '#boton-verify', function() {
        alert('¡Botón clickeado!');
    });
});