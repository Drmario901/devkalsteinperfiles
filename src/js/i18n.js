const lngs = {
  en: { nativeName: 'English' },
  es: { nativeName: 'Spanish' },
  it: { nativeName: 'Italian' },
  pt: { nativeName: 'Portuguese' },
  de: { nativeName: 'German' },
  se: { nativeName: 'Swedish' },
  ee: { nativeName: 'Estonian' },
  pl: { nativeName: 'Polish' },
  nl: { nativeName: 'Dutch' },
  fr: { nativeName: 'French' }
};

// Obtener language from cookie
const getLanguage = () => {
  const cookie = document.cookie.split('; ').find(row => row.startsWith('language='));
  return cookie ? cookie.split('=')[1] : 'en';
};

const rerender = () => {
  // Traduce cada elemento individualmente
  jQuery(document).ready(function($){
    $('[data-i18n], [data-placeholder]').each(function() {
        const key = $(this).attr('data-i18n');
        const placeholderKey = $(this).attr('data-placeholder');
        // Actualiza el texto del elemento si existe el atributo data-i18n
        if (key) {
            $(this).text(i18next.t(key));
        }
        // Actualiza el placeholder del elemento si existe el atributo data-placeholder
        if (placeholderKey) {
            $(this).attr('placeholder', i18next.t(placeholderKey));
        }
    });
  });
}


// Inicializar i18next y jquery-i18next
jQuery(document).ready(function($){
  $(function () {
  i18next
    // detect user language
    // init i18next
    .init({
      debug: true,
      lng: getLanguage(),
      fallbackLng: 'en',

      ns: ['account', 'client', 'support', 'moderator', 'distribuidor','manofacturer', 'alert'],
      
      defaultNS: 'account', // Establecer el namespace predeterminado
      resources: {}
    }, (err, t) => {
      if (err) return console.error(err);

      // Cargar los archivos JSON para cada idioma y namespace
      Promise.all(Object.keys(lngs).map(lng =>
        Promise.all(i18next.options.ns.map(ns =>
          fetch(`https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/${ns}.json`).then(response => response.json())
            .then(translation =>
              i18next.addResourceBundle(lng, ns, translation)
            )
        ))
      )).then(() => {
        // Inicializar jquery-i18next

        jqueryI18next.init(i18next, $, { useOptionsAttr: true });

        // fill language switcher
        /* Object.keys(lngs).map((lng) => {
          const opt = new Option(lngs[lng].nativeName, lng);
          if (lng === i18next.resolvedLanguage) {
            opt.setAttribute("selected", "selected");
          }
          $('#languageSwitcher').append(opt);
        });
        $('#languageSwitcher').change((a, b, c) => {
          const chosenLng = $(this).find("option:selected").attr('value');
          i18next.changeLanguage(chosenLng, () => {
            rerender();
          });
        }); */

        rerender();
      });
    });
  });
});