// Importa i18next y el detector de idioma del navegador
import i18next from 'i18next';
import i18nextBrowserLanguageDetector from 'i18next-browser-languagedetector';

// Configura i18next
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
    }, (err, t) => {
        if (err) return console.error(err);

        // Función para cambiar el idioma
        function changeLanguage(event) {
            const chosenLng = event.target.value;
            i18next.changeLanguage(chosenLng);

            console.log(chosenLng)
        }

        // Rellena el selector de idioma
        const languageSwitcher = document.getElementById('languageSwitcher');
        languageSwitcher.addEventListener('change', changeLanguage);

        // Función para renderizar el contenido
        function renderContent() {
            // Obtiene todos los elementos que necesitan traducción
            const elements = document.querySelectorAll('[data-i18n]');
            // Para cada elemento, actualiza su texto con la traducción correspondiente
            elements.forEach(element => {
                const key = element.getAttribute('data-i18n');
                element.textContent = i18next.t(key);
            });
        }

        // Renderiza el contenido inicial
        renderContent();

        // Vuelve a renderizar el contenido cuando cambia el idioma
        i18next.on('languageChanged', renderContent);
    });
