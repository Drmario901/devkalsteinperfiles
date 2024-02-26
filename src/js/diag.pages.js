jQuery(document).ready(function($) {
    var currentPage = 'diagsys'; 
    var pageParameters = {
        'diagsys': 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/templates-php/client/diagnosis/diagsys.php',
        'register': 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/templates-php/client/diagnosis/register.php',
        'exit': 'https://plataforma.kalstein.net/wp-content/plugins/kalsteinPerfiles/src/templates-php/client/diagnosis/exit.php'
    };

    function addLinkClickListeners() {
        let links = ['diagsys', 'register', 'exit'];

        for (let link of links) {
            $('#'+link).click(function() {
                changePage(link);
            });
        }
    }

    function changePage(page) {
        // Ocultar todos los paneles
        $('div[id^="panel-"]').attr('hidden', '');

        // Mostrar el panel correspondiente
        let panelId = '#panel-' + page;
        $(panelId).removeAttr('hidden');

        // Cargar contenido en el panel
        $.ajax({
            url: pageParameters[page],
            type: 'GET'
        })
        .done(function (response) {
            $(panelId).html(response);
            currentPage = page;
        })
        .fail(function () {
            console.log('Error al cargar la página');
        })
    }

    addLinkClickListeners();
    changePage(currentPage);
});
