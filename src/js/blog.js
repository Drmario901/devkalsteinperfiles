jQuery(document).ready(function($) {
    let todos = [];
    let paginaActual = 1;
    let itemsPorPagina = 4; // Define cuántos items quieres por página
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

    $(document).on("click", "#paginado .page-link", function() {
        let paginaSeleccionada = parseInt($(this).attr('data-pagina')); // Asegúrate de convertir a número
        paginaActual = paginaSeleccionada;
        actualizarVista(); // Esto regenerará los botones y aplicará correctamente la clase `active`
    });

    function cargarDatos() {
        // Asumiendo que todos se llena aquí con datos iniciales
        $.ajax({
            url: plugin_dir + '/php/blog.php',
            success: function(response) {
                // Simulamos una respuesta con datos
                todos = JSON.parse(response).datos; // Asegúrate de que esto coincida con el formato de tu respuesta
                paginas = Math.ceil(todos.length / itemsPorPagina);
                actualizarVista();
                generarPaginado(paginas);
                //console.log('paginasss', paginas);
                
            },
            error: function() {
                console.error('Error al cargar los datos');
            }
        });
    }

    async function actualizarVista() {        
        let datosPagina = paginar(todos, paginaActual, itemsPorPagina);
        const html = await generarTabla(datosPagina);
        $('#container_blogs').html(html);
        truncateText('.p-description-blog', 320); 
        truncateText('.txt-author', 40); 
        generarPaginado(paginas);
    }

    function paginar(items, paginaActual, itemsPorPagina) {
        console.log('pagina actual', paginaActual);
        
        let inicio = (paginaActual - 1) * itemsPorPagina;
        let fin = inicio + itemsPorPagina;
        return items.slice(inicio, fin);
    }

    // function generarTabla(datos) {
    //     let contenedorHTML = '';
    //     datos.forEach(fila => {
    //         contenedorHTML += `<div class="contenedor_vistaprevia_guia"
    //                     style="padding: 10px 10px 15px 10px; border-bottom: solid 1px #c9c9c9; display: grid; grid-template-columns: 1fr 2fr; gap: 1em; margin-bottom: 20px; justify-items: center; align-content: center; align-items: center;">
    //                     <div class="thumbnail_guia">
    //                         <img src="${fila.art_img}"
    //                             alt="guia" width='200' />
    //                     </div>
    //                     <div class="contenido_guia"
    //                         style="display: flex; flex-direction: column; justify-content: space-between;">
    //                         <h5 class="titulo_guia" style="font-family: Montserrat; padding: 0">${fila.art_title}
    //                         </h5>
    //                         <hr
    //                             style="height:3px; width:75px; border:none; color:#213280; background-color:#213280; opacity: 1; margin: 10px 0;">
    //                         <p class="p-description-blog" style="font-family: Roboto; line-height: 1.5em; margin-bottom: 10px; min-height: 113px; min-width: 470px;">${fila.art_principal_description}.</p>
    //                         <div class="footer-guia"
    //                             style="display: flex; align-items: center; justify-content: space-between">
    //                             <button class="btn_guias_informativas" id="blog_articulos" source="#">Ver mas</button>
    //                             <p style="font-family: Roboto; margin: 0">
    //                                 <svg style="display: inline; width:15px; height:15px;"
    //                                     xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
    //                                     <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
    //                                     <path
    //                                         d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
    //                                 </svg>
    //                                 Publicado por <b>${searchNameStore(fila.art_id_user).then(author => {
    //                                     author
    //                                 })}</b>
    //                             </p>
    //                         </div>
    //                     </div>
    //                 </div>`
    //     });

    //     return contenedorHTML;
    // }

    async function generarTabla(datos) {
        let contenedorHTML = '';
        
        for (const fila of datos) {
            let response = await searchNameStore(fila.art_id_user);
            let author = JSON.parse(response).store;

            contenedorHTML += `
                <div class="contenedor_vistaprevia_guia"
                    style="padding: 10px 10px 15px 10px; border-bottom: solid 1px #c9c9c9; display: grid; grid-template-columns: 1fr 2fr; gap: 1em; margin-bottom: 20px; justify-items: center; align-content: center; align-items: center;">
                    <div class="thumbnail_guia">
                        <img src="${fila.art_img}" alt="guia" width='200' />
                    </div>
                    <div class="contenido_guia" style="display: flex; flex-direction: column; justify-content: space-between;">
                        <h5 class="titulo_guia" style="font-family: Montserrat; padding: 0">${fila.art_title}</h5>
                        <hr style="height:3px; width:75px; border:none; color:#213280; background-color:#213280; opacity: 1; margin: 10px 0;">
                        <p class="p-description-blog" style="font-family: Roboto; line-height: 1.5em; margin-bottom: 10px; min-height: 113px; min-width: 470px;">${fila.art_principal_description}.</p>
                        <div class="footer-guia" style="display: flex; align-items: center; justify-content: space-between">
                            <button class="btn_guias_informativas" id="blog_articulos" source="#">Ver más <i class="fa-solid fa-arrow-right"></i></button>
                            <p style="font-family: Roboto; margin: 0; display: flex;">
                                <svg style="display: inline; width:15px; height:15px; margin-top: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                    <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z"/>
                                </svg>
                                &nbsp;Publicado por&nbsp;<span class='txt-author'>${author}<span>
                            </p>
                        </div>
                    </div>
                </div>`;
        }

        return contenedorHTML;
    }

    function searchNameStore(idAccount) {
        return $.ajax({
            url: plugin_dir + '/php/consultAuthor.php',
            type: "POST",
            data: { idAccount },
        });
    }

    function truncateText(selector, maxLength) {
        $(selector).each(function() {
            var text = $(this).text();
            console.log(text.length)
            if (text.length > maxLength) {
                $(this).text(text.slice(0, maxLength) + '...');
            }
        });
    }

    function generarPaginado(paginas) {
        let botonesPagina = '';
        for (let i = 1; i <= paginas; i++) {
            let claseActiva = i === paginaActual ? 'active' : '';
            botonesPagina += `<li class="page-item ${claseActiva}"><button class="page-link" data-pagina="${i}">${i}</button></li>`;
        }
        $("#paginado").html(botonesPagina);
    }

});