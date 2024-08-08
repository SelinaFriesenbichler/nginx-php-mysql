<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

$client = new Client([
    'base_uri' => 'https://opensearch-kages-qs-fit4-webtest.apps.ocp.qs-kagesintern.at', // Replace with your OpenSearch endpoint
    'verify' => false, // Disable SSL verification (not recommended for production)
]);

$indexName = 'index_tinymce_1'; // Replace with your index name

try {
    $response = $client->request('GET', "$indexName/_search", [
        'auth' => ['tinymce', 'paAmvQcW1FpD2qatXc2M'], // Replace with your username and password
        'headers' => [
            'Content-Type' => 'application/json', // Set the Content-Type header
        ],
        'json' => [ // Use the json key to send a JSON payload
            'query' => [
                'match_all' => (object)[], // Fetches all documents
            ],
        ],
    ]);

    // Output the raw response
    echo "Response Code: " . $response->getStatusCode() . "\n";
    echo "Response Headers: " . json_encode($response->getHeaders()) . "\n";
	echo "<br><br>";
	
    // Try to decode the response body
    $body = json_decode($response->getBody(), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        // If decoding fails, output the raw body
        echo "Response Body (not JSON): " . $response->getBody() . "\n";
    } else {
        $documents = $body['hits']['hits'];

        // Output the documents
        foreach ($documents as $document) {
            echo "ID: " . $document['_id'] . "\n";
            echo "Source: " . json_encode($document['_source']) . "\n\n";
        }
    }
} catch (RequestException $e) {
    // Handle exceptions
    echo "Error searching documents: " . $e->getMessage() . "\n";
    if ($e->hasResponse()) {
        echo "Response: " . $e->getResponse()->getBody() . "\n";
    }
}
?>