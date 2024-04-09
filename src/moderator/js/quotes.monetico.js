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

    function cargarDatos() {
        // Asumiendo que todos se llena aquí con datos iniciales
        $.ajax({
            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/moderator/quotesMonetico.php',
            success: function(response) {
                // Simulamos una respuesta con datos
                todos = JSON.parse(response).datos; // Asegúrate de que esto coincida con el formato de tu respuesta
                actualizarVista();
            },
            error: function() {
                console.error('Error al cargar los datos');
            }
        });
    }

    function actualizarVista() {
        let datosPagina = paginar(todos, paginaActual, itemsPorPagina);
        $('#datos-tabla').html(generarTabla(datosPagina));
        actualizarPaginacion();
    }
    
    function actualizarPaginacion() {
        let totalPaginas = Math.ceil(todos.length / itemsPorPagina);
        let paginacionHtml = '<nav aria-label="Page navigation example"><ul class="pagination">';
    
        // Botón "Anterior"
        if (paginaActual > 1) {
            paginacionHtml += `<li class="page-item"><a class="page-link" href="#" id="page-prev">Anterior</a></li>`;
        } else {
            paginacionHtml += `<li class="page-item disabled"><span class="page-link">Anterior</span></li>`;
        }
    
        // Números de página
        for (let i = 1; i <= totalPaginas; i++) {
            if (i === paginaActual) {
                paginacionHtml += `<li class="page-item active"><span class="page-link">${i}</span></li>`;
            } else {
                paginacionHtml += `<li class="page-item"><a class="page-link" href="#" id="page-${i}">${i}</a></li>`;
            }
        }
    
        // Botón "Siguiente"
        if (paginaActual < totalPaginas) {
            paginacionHtml += `<li class="page-item"><a class="page-link" href="#" id="page-next">Siguiente</a></li>`;
        } else {
            paginacionHtml += `<li class="page-item disabled"><span class="page-link">Siguiente</span></li>`;
        }
    
        paginacionHtml += '</ul></nav>';
        $('#paginacion').html(paginacionHtml);
    
        // Agregar evento a los números de página
        $('.page-link').click(function(e) {
            e.preventDefault(); // Prevenir el comportamiento por defecto de los enlaces
            let id = $(this).attr('id');
            
            if (id === "page-prev") {
                paginaActual = Math.max(1, paginaActual - 1);
            } else if (id === "page-next") {
                paginaActual = Math.min(totalPaginas, paginaActual + 1);
            } else {
                paginaActual = parseInt(id.replace("page-", ""));
            }
            
            actualizarVista();
        });
    }
});