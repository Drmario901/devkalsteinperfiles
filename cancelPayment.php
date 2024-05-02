<?php

$url = 'https://p.monetico-services.com/test/capture_paiement.cgi';

// Datos que serán enviados, con las fechas correctamente formateadas
$data = array(
  'version' => '3.0',
  'TPE' => '7593339',
  'date' => (new DateTime())->format('d/m/Y:H:i:s'),
  'date_commande' => (new DateTime())->format('d/m/Y:H:i:s'),
  'montant' => '10.00USD',
  'montant_a_capturer' => '0USD',
  'montant_deja_capture' => '0USD',
  'montant_restant' => '0USD',
  'stoprecurrence' => 'OUI',
  'reference' => '22222222',
  'lgue' => 'ES',
  'societe' => 'kalsteinfr',
  'MAC' => "D12304B9D550B6C6E9F5C4025F61D424E21FDFA6"
);

$postData = http_build_query($data);

$ch = curl_init();
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

$response = curl_exec($ch);

if (curl_errno($ch)) {
  echo 'Error en la solicitud cURL: ' . curl_error($ch);
} else {
  $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  if ($httpcode == 200) {
    echo "Respuesta recibida: " . $response;
  } else {
    echo "Error HTTP $httpcode: " . $response;
  }
}

curl_close($ch);
