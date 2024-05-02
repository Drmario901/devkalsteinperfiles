<?php
// ERROR DETECTION LINES.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// COMPOSER DEPENDENCIES.
require '/path/to/vendor/autoload.php';

use DansMaCulotte\Monetico\Monetico;
use DansMaCulotte\Monetico\Requests\CancelRequest;
use GuzzleHttp\Client;

// Initialize the Monetico client with your actual credentials
$monetico = new Monetico(
    '7593339',
    '255D023E7A0BDE9EEAC7516959CD93A9854F3991',
    'kalsteinfr'
);

// Prepare the cancellation request
$cancel = new CancelRequest([
    'dateTime' => new DateTime(),
    'orderDate' => new DateTime(),
    'reference' => 'ABC123',
    'language' => 'FR',
    'currency' => 'EUR',
    // Ensure that the amount matches what was initially authorized
    'amount' => 100,
    'amountRecovered' => 0, // This field might be specific to your implementation
]);

// Prepare the fields for the HTTP request
$fields = [
    'form_params' => $monetico->getFields($cancel)
];

// GuzzleHttp client to send the request
$client = new Client();

// Sending the POST request to the Monetico cancel URL
try {
    $response = $client->request('POST', $monetico->getCancelUrl(), $fields);
    $responseBody = $response->getBody()->getContents();

    // Assuming the response needs to be parsed as JSON
    $responseData = json_decode($responseBody, true);

    // Log or handle the response data as needed
    echo '<pre>' . print_r($responseData, true) . '</pre>';
} catch (Exception $e) {
    // Handle errors (e.g., network issues, invalid response)
    echo "Error during the cancellation request: " . $e->getMessage();
}
