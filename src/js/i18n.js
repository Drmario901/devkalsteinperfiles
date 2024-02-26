const lngs = {
    en: { nativeName: 'English' },
    es: { nativeName: 'Spanish' }
  };
  
  const rerender = () => {

    $('body').localize();
  }
  
  $(function () {
    i18next
      // detect user language
      .use(i18nextBrowserLanguageDetector)
      // init i18next
      .init({
        debug: true,
        fallbackLng: 'en',
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
      }, (err, t) => {
        if (err) return console.error(err);
  
        // for options see
        // https://github.com/i18next/jquery-i18next#initialize-the-plugin
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