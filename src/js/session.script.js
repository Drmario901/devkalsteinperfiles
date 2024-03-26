jQuery(document).ready(function($) {

    let plugin_dir =
    "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/";
    var alreadyRedirected = false;

    function paramExists(paramName) {
        var urlParams = new URLSearchParams(window.location.search);
        return urlParams.has(paramName);
    }

    $.ajax({
        url: plugin_dir + '/php/getSessionWoo.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            if (data.status === 'Modelo:' && !alreadyRedirected && !paramExists('search')) {
                console.log('Model session:', data.last_model);

                var model = data.last_model;
                var newURL = window.location.href.split('?')[0] + '?search=' + model;
                window.location.replace(newURL);
                alreadyRedirected = true;
            } else {
                console.log('No model in session or already redirected');
            }
        },
        error: function(error) {
            console.error('Error with script:', error);
        }
    });
});
