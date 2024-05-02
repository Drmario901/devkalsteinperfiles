<?php 

echo "<script>
const url = 'https://p.monetico-services.com/test/capture_paiement.cgi';

// Datos que serán enviados
const data = {
  version: '3.0',
  TPE: '7593339',
  date: '02/05/2024:20:24:09',
  date_commande: '02/05/2024',
  montant: '10.00USD',
  montant_a_capturer: '0USD',
  montant_deja_capture: '0USD',
  montant_restant: '0USD',
  stoprecurrence: 'OUI',
  reference: '22222222',
  lgue: 'ES',
  societe: 'kalsteinfr',
  MAC: 'd12304b9d550b6c6e9f5c4025f61d424e21fdfa6'
};

// Convertir los datos a formato URL-encoded
const formData = new URLSearchParams(data);

// Configuración de la solicitud fetch
fetch(url, {
  method: 'POST',
  headers: {
    'Pragma': 'no-cache',
    'Connection': 'close',
    'User-Agent': 'AuthClient',
    'Host': 'p.monetico-services.com',
    'Accept': '*/*',
    'Content-Type': 'application/x-www-form-urlencoded'
  },
  body: formData
})
.then(response => response.text())  // convertir la respuesta a texto
.then(text => console.log(text))    // mostrar la respuesta en la consola
.catch(error => console.error('Error:', error));  // mostrar errores en la consola
</script>";