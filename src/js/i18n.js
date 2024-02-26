const lngs = {
    en: { nativeName: 'English' },
    es: { nativeName: 'Spanish' }
  };
  

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
            fallbackLng: 'es',
            resources: {
                en: {
                    translation: {
                        login: {
                            labelCorreo: 'Email',
                            tittleButton: 'Continue',
                            noAccount: 'Don\'t have an account?',
                            forgotPassword: 'Forgot your password?',
                            spanAccount: 'Sign up'
                        }
                    }
                },
                es: {
                    translation: {
                        translation: {
                            login: {
                                labelCorreo: 'Correo Electronico',
                                tittleButton: 'Continuar',
                                noAccount: '¿No tienes una cuenta?',
                                forgotPassword: '¿Olvidaste tu contraseña?',
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