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

jQuery(document).ready(function($) {
  // Función para obtener el idioma de la cookie
  const getLanguage = () => {
    const cookie = document.cookie.split('; ').find(row => row.startsWith('language='));
    return cookie ? cookie.split('=')[1] : 'en';
  };

  // Función para rerenderizar las traducciones
  const rerender = () => {
    $('[data-i18n]').each(function() {
      const key = $(this).data('i18n');
      $(this).text(i18next.t(key));
    });
  };

  // Inicializar i18next y jquery-i18next
  i18next.init({
    debug: true,
    lng: getLanguage(),
    fallbackLng: 'en',
    ns: ['account', 'prueba', 'client', 'support', 'moderator', 'distribuidor'],
    defaultNS: 'account', // Establecer el namespace predeterminado
    resources: {}
  }, (err, t) => {
    if (err) return console.error(err);

    // Cargar los archivos JSON para cada idioma y namespace
    Promise.all(Object.keys(lngs).map(lng =>
      Promise.all(i18next.options.ns.map(ns =>
        fetch(`https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/${ns}.json`)
        .then(response => response.json())
        .then(translation => i18next.addResourceBundle(lng, ns, translation))
      ))
    )).then(() => {
      // Después de cargar todas las traducciones, cambiar el idioma y rerenderizar
      const currentLanguage = getLanguage();
      if (i18next.resolvedLanguage !== currentLanguage) {
        i18next.changeLanguage(currentLanguage, () => {
          rerender();
        });
      } else {
        rerender();
      }
    });
  });
});
