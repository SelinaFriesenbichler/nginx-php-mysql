<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Initialize the Guzzle client
$client = new Client([
    'base_uri' => 'https://opensearch-kages-qs-fit4-webtest.apps.ocp.qs-kagesintern.at', // Replace with your OpenSearch endpoint
    'verify' => false, // Disable SSL verification (not recommended for production)
]);

$indexName = 'index_tinymce_1'; // Replace with your index name

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $title = $_POST['post-title'];
    $content = $_POST['mytextarea'];

    // Prepare the document data
    $document = [
        'title' => $title,
        'content' => $content,
        'timestamp' => date('Y-m-d H:i:s'),
    ];

    // Generate a unique document ID (or you can use your own ID)
    $documentId = uniqid();

    try {
        // Send a PUT request to add the document to the index
        $response = $client->put("$indexName/_doc/$documentId", [
            'auth' => ['tinymce', 'paAmvQcW1FpD2qatXc2M'], // Replace with your username and password
            'headers' => [
                'Content-Type' => 'application/json', // Set the Content-Type header
            ],
            'json' => $document, // Send the document as JSON
        ]);

        // Output the response
        echo "Document successfully indexed. Response:\n";
        echo "Response Code: " . $response->getStatusCode() . "\n";
        echo "Response Body: " . $response->getBody() . "\n";
    } catch (RequestException $e) {
        // Handle exceptions
        echo "Error indexing document: " . $e->getMessage() . "\n";
        if ($e->hasResponse()) {
            echo "Response: " . $e->getResponse()->getBody() . "\n";
        }
    }
} else {
    echo "Invalid request method.";
}
?>
