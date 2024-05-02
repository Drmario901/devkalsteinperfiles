<?php

$url = 'https://p.monetico-services.com/test/capture_paiement.cgi';

// Datos que serán enviados
$data = array(
  'version' => '3.0',
  'TPE' => '7593339',
  'date' => '02/05/2024:19:10:30',
  'date_commande' => '02/05/2024',
  'montant' => '10.00USD',
  'montant_a_capturer' => '0USD',
  'montant_deja_capture' => '0USD',
  'montant_restant' => '0USD',
  'stoprecurrence' => 'OUI',
  'reference' => '11111',
  'lgue' => 'ES',
  'societe' => 'kalsteinfr',
  //'MAC' => 'B9C0CC41312FDD02DB9C922125C6BAF56AB61C92'
);

// Formato URL-encoded para el cuerpo de la solicitud
$postData = http_build_query($data);

// Crear un manejador de cURL
$ch = curl_init();

// Opciones para la solicitud cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt(
  $ch,
  CURLOPT_HTTPHEADER,
  array(
    'Pragma: no-cache',
    'Connection: close',
    'User-Agent: AuthClient',
    'Host: p.monetico-services.com',
    'Accept: */*',
    'Content-Type: application/x-www-form-urlencoded',
    'Content-Length: ' . strlen($postData)
  )
);

// Ejecutar la solicitud
$response = curl_exec($ch);

// Verificar si hubo algún error durante la ejecución
if (curl_errno($ch)) {
  echo 'Error en la solicitud cURL: ' . curl_error($ch);
}

// Cerrar el manejador de cURL
curl_close($ch);

// Imprimir la respuesta
echo $response;

?>