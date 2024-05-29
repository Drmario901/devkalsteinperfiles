jQuery(document).ready(function($) {
    let todos = [];
    let paginaActual = 1;
    let itemsPorPagina = 8; // Define cuántos items quieres por página
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
        truncateText('.txt-author', 30); 
        truncateText('.txt-author2', 20); 
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
                            <button class="btn_guias_informativas" id="blog_articulos" source="#" value="${fila.art_id}">Ver más <i class="fa-solid fa-arrow-right"></i></button>
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

    async function printArticulo(datos, datosDetails) {        
        const html = await renderArticulo(datos, datosDetails);
        $('.contenido_articulo').html(html);
    }

    async function renderArticulo(datos, datosDetails) {
        let contenedorHTML = '';
        
        for (const fila of datos) {
            let response = await searchNameStore(fila.art_id_user);
            let author = JSON.parse(response).store;

            contenedorHTML += `
                <div>
                    <h2 style="font-family: Montserrat; margin-bottom: 10px; padding: 0; font-weight: 600; font-size: 2.5em">Titulo del
                        articulo</h2>
                    <hr
                        style="height:3px; width:100px; border:none; color:var(--color-primario); background-color:#213280;opacity:1">
                </div>
                <img src="https://i.pinimg.com/736x/2a/9e/75/2a9e75e2ea1d6a8e87b80c83b560f774.jpg"
                    width="400">
                <p style="font-family: Roboto; color: #777">
                    <svg style="display: inline; width:15px; height:15px;"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                        <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                        <path fill="#777"
                            d="M256 0a256 256 0 1 1 0 512A256 256 0 1 1 256 0zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z" />
                    </svg>
                    8 de mayo de 2024
                </p>
                <p class="" style="font-family: Roboto;">Lorem ipsum dolor sit amet,
                    consectetur
                    adipiscing elit. In luctus sapien nec ornare aliquet. Phasellus convallis, mi a
                    tempor
                    tincidunt, nulla libero vehicula urna, nec porta tellus ipsum sollicitudin nisi. Sed
                    eu feugiat
                    arcu. Pellentesque vel purus vitae odio viverra scelerisque. Morbi faucibus, augue
                    vel facilisis
                    faucibus, orci ante consequat libero, vitae feugiat lectus libero in purus. Duis
                    pretium
                    eleifend ultrices. Phasellus suscipit eros augue. Sed feugiat, mi vel posuere
                    dapibus, velit
                    diam pulvinar eros, ut consequat ante neque sit amet sapien. Sed facilisis ac nisi
                    non viverra.
                    Fusce id molestie mi.
                    <br><br>
                    Phasellus suscipit, lacus sit amet sollicitudin lacinia, ipsum lorem eleifend
                    ligula, at
                    hendrerit risus sem luctus arcu. Donec aliquam turpis libero, nec auctor ex congue
                    ac. Integer
                    sodales ex non volutpat tincidunt. Donec erat orci, euismod non tincidunt ut, auctor
                    sed neque.
                    Nullam rutrum posuere nulla, vitae lobortis urna maximus ac. Nullam iaculis mi quam,
                    luctus
                    sodales nulla ullamcorper ac. Maecenas tempor pulvinar elit quis lobortis. Ut mollis
                    risus a
                    diam ultricies bibendum. Cras sodales, tortor eu venenatis varius, nisi odio
                    sagittis lorem, sed
                    congue purus elit at diam. Curabitur interdum tellus ut nisi viverra, ut maximus
                    augue
                    ullamcorper. Nam vitae tincidunt risus. Etiam sollicitudin suscipit nisl sed
                    viverra. Nulla
                    facilisi.
                </p>
                <div class="articulo_extracto">
                    <h3 style="font-family: Montserrat; margin-bottom: 10px; font-size: 2em; padding: 0">Subtitulo del
                        articulo</h3>
                    <p class="" style="font-family: Roboto;">Lorem ipsum dolor sit amet,
                        consectetur
                        adipiscing elit. In luctus sapien nec ornare aliquet. Phasellus convallis, mi a
                        tempor
                        tincidunt, nulla libero vehicula urna, nec porta tellus ipsum sollicitudin nisi.
                        Sed eu
                        feugiat
                        arcu. Pellentesque vel purus vitae odio viverra scelerisque. Morbi faucibus,
                        augue vel
                        facilisis
                        faucibus, orci ante consequat libero, vitae feugiat lectus libero in purus. Duis
                        pretium
                        eleifend ultrices. Phasellus suscipit eros augue. Sed feugiat, mi vel posuere
                        dapibus, velit
                        diam pulvinar eros, ut consequat ante neque sit amet sapien. Sed facilisis ac
                        nisi non
                        viverra.
                        Fusce id molestie mi.
                        <br><br>
                        Phasellus suscipit, lacus sit amet sollicitudin lacinia, ipsum lorem eleifend
                        ligula, at
                        hendrerit risus sem luctus arcu. Donec aliquam turpis libero, nec auctor ex
                        congue ac.
                        Integer
                        sodales ex non volutpat tincidunt. Donec erat orci, euismod non tincidunt ut,
                        auctor sed
                        neque.
                        Nullam rutrum posuere nulla, vitae lobortis urna maximus ac. Nullam iaculis mi
                        quam, luctus
                        sodales nulla ullamcorper ac. Maecenas tempor pulvinar elit quis lobortis. Ut
                        mollis risus a
                        diam ultricies bibendum. Cras sodales, tortor eu venenatis varius, nisi odio
                        sagittis lorem,
                        sed
                        congue purus elit at diam. Curabitur interdum tellus ut nisi viverra, ut maximus
                        augue
                        ullamcorper. Nam vitae tincidunt risus. Etiam sollicitudin suscipit nisl sed
                        viverra. Nulla
                        facilisi.
                    </p>
                </div>
                <div class="articulo_extracto">
                    <h3 style="font-family: Montserrat; margin-bottom: 10px; font-size: 2em; padding: 0">Subtitulo del
                        articulo</h3>
                    <p class="" style="font-family: Roboto;">Lorem ipsum dolor sit amet,
                        consectetur
                        adipiscing elit. In luctus sapien nec ornare aliquet. Phasellus convallis, mi a
                        tempor
                        tincidunt, nulla libero vehicula urna, nec porta tellus ipsum sollicitudin nisi.
                        Sed eu
                        feugiat
                        arcu. Pellentesque vel purus vitae odio viverra scelerisque. Morbi faucibus,
                        augue vel
                        facilisis
                        faucibus, orci ante consequat libero, vitae feugiat lectus libero in purus. Duis
                        pretium
                        eleifend ultrices. Phasellus suscipit eros augue. Sed feugiat, mi vel posuere
                        dapibus, velit
                        diam pulvinar eros, ut consequat ante neque sit amet sapien. Sed facilisis ac
                        nisi non
                        viverra.
                        Fusce id molestie mi.
                        <br><br>
                        Phasellus suscipit, lacus sit amet sollicitudin lacinia, ipsum lorem eleifend
                        ligula, at
                        hendrerit risus sem luctus arcu. Donec aliquam turpis libero, nec auctor ex
                        congue ac.
                        Integer
                        sodales ex non volutpat tincidunt. Donec erat orci, euismod non tincidunt ut,
                        auctor sed
                        neque.
                        Nullam rutrum posuere nulla, vitae lobortis urna maximus ac. Nullam iaculis mi
                        quam, luctus
                        sodales nulla ullamcorper ac. Maecenas tempor pulvinar elit quis lobortis. Ut
                        mollis risus a
                        diam ultricies bibendum. Cras sodales, tortor eu venenatis varius, nisi odio
                        sagittis lorem,
                        sed
                        congue purus elit at diam. Curabitur interdum tellus ut nisi viverra, ut maximus
                        augue
                        ullamcorper. Nam vitae tincidunt risus. Etiam sollicitudin suscipit nisl sed
                        viverra. Nulla
                        facilisi.
                    </p>
                </div>
                <div class="footer_lectura_articulo" style="display: grid; gap: 10px">
                    <div class="contenido_footer_lectura_articulo"
                        style="display: flex; justify-content: space-between;">
                        <h5 style="font-family: Montserrat; font-weight: 700;">Comparte este
                            articulo
                        </h5>
                        <div class="iconos_redes"
                            style="display: grid; grid-template-columns: auto auto auto; gap: 10px;">
                            <a href="#">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 448 512">
                                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#000000"
                                        d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z" />
                                </svg>
                            </a>
                            <a href="#">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#000000"
                                        d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z" />
                                </svg>
                            </a>
                            <a href="#">
                                <svg width="20" height="20" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 512 512">
                                    <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                    <path fill="#000000"
                                        d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                    <hr style="height:2px; border:none; color:black; background-color:black; margin: 0" />
                    <h5
                        style="font-family: Roboto; display: flex; align-items: center;">
                        <svg style="display: inline; width:30px; height:30px; margin-right: 1em"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path
                                d="M399 384.2C376.9 345.8 335.4 320 288 320H224c-47.4 0-88.9 25.8-111 64.2c35.2 39.2 86.2 63.8 143 63.8s107.8-24.7 143-63.8zM0 256a256 256 0 1 1 512 0A256 256 0 1 1 0 256zm256 16a72 72 0 1 0 0-144 72 72 0 1 0 0 144z" />
                        </svg>
                        Autor
                    </h5>
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

    $(document).on('click', '#blog_articulos', function(){
        $.ajax({
            url: plugin_dir + '/php/blog_individual.php',
            success: function(response) {
                // Simulamos una respuesta con datos
                main_articulo = JSON.parse(response).datos // Asegúrate de que esto coincida con el formato de tu respuesta
                articulo_details = JSON.parse(response).datosDetails
                
                printArticulo(main_articulo, articulo_details)
                
            },
            error: function() {
                console.error('Error al cargar los datos');
            }
        });
    })

    $(document).on('click', '#btn_view_art_destacado', function(){
        alert('Click destacado!!!')
    })
});