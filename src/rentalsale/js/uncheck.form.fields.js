const cookieLng = document.cookie
.split("; ")
.find((row) => row.startsWith("language="))
.split("=")[1];
let alertsTranslations = {};

// cargar json de traducciones
const loadTranslations = (lng) => {
    return fetch(
    `https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`
    )
    .then((response) => response.json())
    .then((translation) => {
        // save in a global variable
        alertsTranslations = translation;
    });
};

loadTranslations(cookieLng);


jQuery(document).ready(function($) {
    elements = [
        {
            option: '#country-select',
            container: '#country-container',
            targets: [$('#country-aerial-per-weigth'), $('#country-aerial-per-volume'), $('#country-maritimal')]
        }
    ];

    // event listener
    elements.forEach(elem => {
        $(elem.option).on('change', e => {
            let val = e.target.value;

            container = $(elem.container);

            per_w = elem.targets[0];
            per_v = elem.targets[1];
            mar = elem.targets[2];

            if (val){

                container.removeAttr('hidden');
                
                per_w.removeAttr('disabled');
                
                per_v.removeAttr('disabled');
                
                mar.removeAttr('disabled');
            }
            else {
                container.attr('hidden', '');

                per_w.attr('disabled', '');
                per_w.val('');

                per_v.attr('disabled', '');
                per_v.val('');

                mar.attr('disabled', '');
                mar.val('');
            }
        });
    });
});
