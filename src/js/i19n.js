import { alertsTranslations } from './traducciones.js';

const showTranslatedAlert = (type, language) => {
    const translation = alertsTranslations[language][type];
    
    iziToast[type]({
      message: translation
    });
  };

 export { showTranslatedAlert }; 