
const lngs = {
    en: { nativeName: 'English' },
    es: { nativeName: 'Spanish' }
  };
  

  const rerender = () => {
    // Traduce cada elemento individualmente
    $('[data-i18n]').each(function() {
        const key = $(this).attr('data-i18n');
        $(this).text(i18next.t(key));
    });
}



  jQuery(document).ready(function($){
    $(function () {
        // use plugins and options as needed, for options, detail see
        i18next
          // detect user language
          .use(i18nextBrowserLanguageDetector)
          // init i18next
          .init({
            debug: true,
            fallbackLng: 'en',
            defaultNS: 'login',
            ns: ['login'], // Especifica los namespaces que deseas cargar
            resources: {
              en: {
              },
              es: {
              }
          }
          }, (err, t) => {
            if (err) return console.error(err);
            jqueryI18next.init(i18next, $, { useOptionsAttr: true });
      
            // fill language switcher
            Object.keys(lngs).map((lng) => {
              const opt = new Option(lngs[lng].nativeName, lng);
              if (lng === i18next.resolvedLanguage) {
                opt.setAttribute("selected", "selected");
              }
              $('#languageSwitcher').append(opt);
            });

            Promise.all(Object.keys(lngs).map(lng =>
              Promise.all(i18next.options.ns.map(ns =>
                  fetch(`https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/${ns}.json`)
                      .then(response => response.json())
                      .then(translation => {
                          const resources = {};
                          console.log(translation);
                          console.log(ns);
                          resources[ns] = translation;
                          i18next.addResourceBundle(lng, ns, resources);
                      })
              ))
          )).then(() => {
              // Una vez cargados todos los recursos, se llama a rerender
              rerender();
          });

            $('#languageSwitcher').change((a, b, c) => {
              const chosenLng = $(this).find("option:selected").attr('value');
              i18next.changeLanguage(chosenLng, () => {
                rerender();
              });
            });
      
            rerender();
          });
      });
  });