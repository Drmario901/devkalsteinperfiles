jQuery(document).ready(function() {
    cargarDatos();

    let todos = [];


    
    function cargarDatos(pagina = 1) {
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/quotesMonetico.php', // Asegúrate de que la ruta es correcta
            type: 'GET',
            data: { pagina: pagina },
            success: function(response) {

                let respuesta = JSON.parse(response)
                console.log('respuestaaa', JSON.parse(response));
                todos = response.datos;

                console.log('datoss', todos);
                
                
                $('#datos-tabla').html(generarTabla(respuesta.datos));
                // $('#paginacion').html(generarPaginacion(respuesta.paginaActual, respuesta.totalPaginas));
            },
            error: function() {
                $('#datos-tabla').html('<p>Hubo un error al cargar los datos.</p>');
                $('#paginacion').html('');
            }
        });
    }

    function generarTabla(datos) {
        console.log('datosss', datos);

        let currentPage = 1; 
        let itemPerPage = 10; 
        const indexOfLastItems = currentPage * itemPerPage;
        const indexOfFirtsItems = indexOfLastItems - itemPerPage;
        const currentItems = datos.slice(indexOfFirtsItems, indexOfLastItems);
        const indexMax = Math.ceil(datos.length / itemPerPage);
        console.log('itemsCurrent', currentItems);
        console.log('indexItems', indexMax);

        $(document).on("click", "#boton-prev", function(){
            if(currentPage > indexMax) {
                currentPage - 1;
            }
        });

        $(document).on("click", "#boton-next", function(){
            if(currentPage < indexMax) {
                currentPage + 1;
            }
        });
        
        
        
        let tablaHtml = '<table class="table"><thead><tr><th>ID</th><th>ID Cotización</th><th>Monto Total</th><th>Divisa</th><th>ID Remitente</th><th>Estado del Pago</th></tr></thead><tbody>';
        currentItems.forEach((fila) =>  {
            tablaHtml += `<tr><td>${fila.id}</td><td>${fila.id_cotizacion}</td><td>${fila.monto_total}</td><td>${fila.cotizacion_divisa}</td><td>${fila.cotizacion_id_remitente}</td><td>${fila.status_payment}</td></tr>`;
        });
        tablaHtml += '</tbody></table> ';
        return tablaHtml;
    }

    $('#boton-verify').click(function() {
        alert('¡Botón clickeado!');
    });
});