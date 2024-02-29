const createAlert = (type, message) => {
    const message = i18next.t(alerts[message], { ns: 'alerts' });
    
    iziToast[type]({
      message: message
    });
  };
  
export { createAlert };