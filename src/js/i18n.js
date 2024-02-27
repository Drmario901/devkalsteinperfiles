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

$(function () {
  i18next
      // detect user language
      .use(i18nextBrowserLanguageDetector)
      // init i18next
      .init({
          debug: true,
          fallbackLng: 'en',
          ns: ['login', 'prueba'],
          defaultNS: 'login', // Establecer el namespace predeterminado
          resources: {
              en: {
              },
              es: {
              }
          }
      }, (err, t) => {
        if (err) return console.error(err);

        // Cargar los archivos JSON para cada idioma y namespace
        Promise.all(Object.keys(lngs).map(lng =>
            Promise.all(i18next.options.ns.map(ns =>
                fetch(`locales/${lng}/${ns}.json`).then(response => response.json())
                    .then(translation =>
                        i18next.addResourceBundle(lng, ns, translation)
                    )
            ))
        )).then(() => {
            // Inicializar jquery-i18next
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
