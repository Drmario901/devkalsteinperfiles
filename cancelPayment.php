<?php

$url = 'https://p.monetico-services.com/test/capture_paiement.cgi';
$mac = md5("B552FD6DB65EC37C5B5C95F0E02A00841634AD86");
echo $mac;
$binary = hex2bin($mac);
// Datos que serán enviados
$data = array(
  'version' => '3.0',
  'TPE' => '7593339',
  'date' => '02/05/2024:20:24:09',
  'date_commande' => '02/05/2024',
  'montant' => '10.00USD',
  'montant_a_capturer' => '0USD',
  'montant_deja_capture' => '0USD',
  'montant_restant' => '0USD',
  'stoprecurrence' => 'OUI',
  'reference' => '22222222',
  'lgue' => 'ES',
  'societe' => 'kalsteinfr',
  'MAC' => "d12304b9d550b6c6e9f5c4025f61d424e21fdfa6"
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
var_dump($data);
?>