// jQuery(document).ready(function() {
//     cargarDatos();

//     let todos = [];


    
//     function cargarDatos(pagina = 1) {
//         $.ajax({
//             url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/quotesMonetico.php', // Asegúrate de que la ruta es correcta
//             type: 'GET',
//             data: { pagina: pagina },
//             success: function(response) {

//                 let respuesta = JSON.parse(response)
//                 console.log('respuestaaa', JSON.parse(response));
//                 todos = response.datos;

//                 console.log('datoss', todos);
                
                
//                 $('#datos-tabla').html(generarTabla(respuesta.datos));
//                 // $('#paginacion').html(generarPaginacion(respuesta.paginaActual, respuesta.totalPaginas));
//             },
//             error: function() {
//                 $('#datos-tabla').html('<p>Hubo un error al cargar los datos.</p>');
//                 $('#paginacion').html('');
//             }
//         });
//     }

//     function generarTabla(datos) {
//         console.log('datosss', datos);

//         let currentPage = 1; 
//         let itemPerPage = 10; 
//         const indexOfLastItems = currentPage * itemPerPage;
//         const indexOfFirtsItems = indexOfLastItems - itemPerPage;
//         const currentItems = datos.slice(indexOfFirtsItems, indexOfLastItems);
//         const indexMax = Math.ceil(datos.length / itemPerPage);
//         console.log('itemsCurrent', currentItems);
//         console.log('indexItems', indexMax);

//         $(document).on("click", "#boton-prev", function(){
//             if(currentPage > indexMax) {
//                 currentPage - 1;
//             }
//         });

//         $(document).on("click", "#boton-next", function(){
//             if(currentPage < indexMax) {
//                 currentPage + 1;
//             }
//         });
        
        
        
//         let tablaHtml = '<table class="table"><thead><tr><th>ID</th><th>ID Cotización</th><th>Monto Total</th><th>Divisa</th><th>ID Remitente</th><th>Estado del Pago</th></tr></thead><tbody>';
//         currentItems.forEach((fila) =>  {
//             tablaHtml += `<tr><td>${fila.id}</td><td>${fila.id_cotizacion}</td><td>${fila.monto_total}</td><td>${fila.cotizacion_divisa}</td><td>${fila.cotizacion_id_remitente}</td><td>${fila.status_payment}</td></tr>`;
//         });
//         tablaHtml += '</tbody></table> ';
//         return tablaHtml;
//     }

//     $('#boton-verify').click(function() {
//         alert('¡Botón clickeado!');
//     });
// });


jQuery(document).ready(function() {
    let todos = [];
    let paginaActual = 1;
    let itemsPorPagina = 10; // Define cuántos items quieres por página
    let paginas = 0;

    // Simulamos la carga inicial de datos
    cargarDatos();

    // Ajusta la paginación cada vez que se hace clic en los botones
    $(document).on("click", "#boton-prev", function() {
        if (paginaActual > 1) {
            paginaActual--;
            actualizarVista();
        }
    });

    $(document).on("click", "#boton-next", function() {
        let totalPaginas = Math.ceil(todos.length / itemsPorPagina);
        if (paginaActual < totalPaginas) {
            paginaActual++;
            actualizarVista();
        }
    });

    $(document).on("click", "select-page", function() {

    })

    function cargarDatos() {
        // Asumiendo que todos se llena aquí con datos iniciales
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/quotesMonetico.php',
            success: function(response) {
                // Simulamos una respuesta con datos
                todos = JSON.parse(response).datos; // Asegúrate de que esto coincida con el formato de tu respuesta
                paginas = Math.ceil(todos.length / itemsPorPagina);
                actualizarVista();
                generarPaginado(paginas);
                console.log('paginasss', paginas);
                
            },
            error: function() {
                console.error('Error al cargar los datos');
            }
        });
    }

    function actualizarVista() {
        let datosPagina = paginar(todos, paginaActual, itemsPorPagina);
        $('#datos-tabla').html(generarTabla(datosPagina));
    }

    function paginar(items, paginaActual, itemsPorPagina) {
        console.log('pagina actual', paginaActual);
        
        let inicio = (paginaActual - 1) * itemsPorPagina;
        let fin = inicio + itemsPorPagina;
        return items.slice(inicio, fin);
    }

    function generarTabla(datos) {
        let tablaHtml = '<table class="table"><thead><tr><th>ID</th><th>ID Cotización</th><th>Monto Total</th><th>Divisa</th><th>ID Remitente</th><th>Estado del Pago</th></tr></thead><tbody>';
        datos.forEach(fila => {
            tablaHtml += `<tr><td>${fila.id}</td><td>${fila.id_cotizacion}</td><td>${fila.monto_total}</td><td>${fila.cotizacion_divisa}</td><td>${fila.cotizacion_id_remitente}</td><td>${fila.status_payment}</td></tr>`;
        });
        tablaHtml += '</tbody></table>';
        return tablaHtml;
    }

    function generarPaginado(paginas){
        for (let i = 1; i <= paginas; i++) {
            console.log('paginas impresas', i);
            
            $("#paginado").html(generarBoton(i))
        }
    }

    function generarBoton(pagina) {
       let btnPagina = `<button>${pagina}}</button>`
       return btnPagina
    }
});