const lngs = {
    en: { nativeName: 'English' },
    es: { nativeName: 'Spanish' },
    de: { nativeName: 'Deustsh' }
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
            ns: ['common', 'login'], // Especifica los namespaces que deseas cargar
            defaultNS: 'login',
            resources: {
              en: {
                translation: {

                }
              },
              es: {
                translation: {

                }
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