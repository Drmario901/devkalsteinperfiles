const rerender = () => {
    // start localizing, details:
    // https://github.com/i18next/jquery-i18next#usage-of-selector-function
    $('body').localize();
  }

  jQuery(document).ready(function($){
    $(function () {
    i18next
        .use(i18nextBrowserLanguageDetector)
        .init({
            debug: true,
            fallbackLng: 'en',
            resources: {
                en: {
                    translation: {
                        login: {
                            labelCorreo: 'Email',
                            titleButton: 'Continue',
                            noAccount: 'Don\'t have an account?',
                            spanAccount: 'Sign up'
                        }
                    }
                },
                es: {
                    translation: {
                        translation: {
                            login: {
                                labelCorreo: 'Correo Electronico',
                                titleButton: 'Continuar',
                                noAccount: '¿No tienes una cuenta?',
                                spanAccount: 'Registrate'
                            }
                        }
                    }
                }
                // Añade más idiomas según sea necesario
            }
        }, function (err, t) {
            if (err) return console.error(err);
            // Inicialización de jquery-i18next
            jqueryI18next.init(i18next, $, { useOptionsAttr: true });

            // Localización de elementos HTML
            $('body').localize();

            // Cambiar idioma al seleccionar una opción en el select
            $('#language-select').on('change', function () {
                var lang = $(this).val();
                i18next.changeLanguage(lang, function (err, t) {
                    if (err) return console.error(err);
                    // Localización de elementos HTML al cambiar de idioma
                    $('body').localize();
                });
            });
        });
});
  });