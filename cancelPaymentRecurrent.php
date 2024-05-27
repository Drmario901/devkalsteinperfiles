<?php

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\CancelRequest;
use DansMaCulotte\Monetico\Responses\CancelResponse;

$monetico = new Monetico(
  '7593339',
  '255D023E7A0BDE9EEAC7516959CD93A9854F3991',
  'kalsteinfr'
);

$cancel = new CancelRequest([
  'dateTime' => new DateTime(),
  'orderDate' => new DateTime(),
  'reference' => '1234567',
  'language' => 'FR',
  'currency' => 'EUR',
  'amount' => 20,
  'amountRecovered' => 0,
]);

$url = CancelRequest::getUrl();
$fields = $monetico->getFields($cancel);

$client = new GuzzleHttp\Client();
$data = $client->request('POST', $url, $fields);

// $data = json_decode($data, true);

$response = new CancelResponse($data);