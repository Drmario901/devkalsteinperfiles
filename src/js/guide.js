jQuery(document).ready(function($) {
    let todos = [];
    let paginaActual = 1;
    let itemsPorPagina = 6; // Define cuántos items quieres por página
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
            url: plugin_dir + '/php/guide.php',
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
        $('#container_guides').html(html);
        truncateText('.p-description-guide', 400);
        generarPaginado(paginas);
    }

    function paginar(items, paginaActual, itemsPorPagina) {
        
        let inicio = (paginaActual - 1) * itemsPorPagina;
        let fin = inicio + itemsPorPagina;
        return items.slice(inicio, fin);
    }

    async function generarTabla(datos) {
        let contenedorHTML = '';
        
        for (const fila of datos) {
            let response = await searchNameStore(fila.guide_user_id);
            let response2 = await searchGuidesDetails(fila.guide_id);
            let author = JSON.parse(response).store
            let slug = JSON.parse(response).slug
            let image = JSON.parse(response2).image
            let description = JSON.parse(response2).description
            let categorie = JSON.parse(response2).categorie

            contenedorHTML += `
                    <div class="contenedor_vistaprevia_guia"
                    style="padding: 10px 10px 15px 10px; border-bottom: solid 1px #c9c9c9; display: grid; grid-template-columns: 1fr 2fr; gap: 1em; margin-bottom: 20px; justify-items: center; align-content: center; align-items: center;">
                        <div class="thumbnail_guia">
                            <img src="${image}"
                                alt="guia" width='200' />
                        </div>
                        <div class="contenido_guia"
                            style="display: flex; flex-direction: column; justify-content: space-between;">
                            <h5 class="titulo_guia" style="font-family: Montserrat; padding: 0">${categorie}</h5>
                            <hr
                                style="height:3px; width:75px; border:none; color:#213280; background-color:#213280; opacity: 1; margin: 10px 0;">
                            <p class="p-description-guide" style="font-family: Roboto; line-height: 1.5em; margin-bottom: 10px">${description}.</p>
                            <div class="footer-guia"
                                style="display: flex; align-items: center; justify-content: space-between">
                                <button class="btn_guias_informativas ._df_button" id="guias_informativas" source="#" value="${fila.id_guide_slug}">Ver mas</button>
                                <p style="font-family: Roboto; margin: 0; display: flex;">
                                    <svg style="display: inline; width:15px; height:15px; margin-top: 5px;"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path
                                            d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                    </svg>
                                    &nbsp;Publicado por&nbsp;<span class='txt-author author-store' meta-href="${slug}">${author}<span>
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

    function searchGuidesDetails(idAccount) {
        return $.ajax({
            url: plugin_dir + '/php/guidesDetails.php',
            type: "POST",
            data: { idAccount },
        });
    }

    function truncateText(selector, maxLength) {
        $(selector).each(function() {
            var text = $(this).text();
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

    $(document).on('click', '.author-store', function(){
        let url = $(this).attr('meta-href')
        window.location.href = url
    })

    $(document).on('click', '#guias_informativas', function(){
        let url = $(this).val()
        window.location.href = url
    })
});