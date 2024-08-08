<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

// Initialize Guzzle client with SSL verification disabled and Basic Authentication
$username = 'tinymce'; // Replace with your OpenSearch username
$password = 'paAmvQcW1FpD2qatXc2M'; // Replace with your OpenSearch password

$client = new Client([
    'verify' => false, // Disable SSL certificate verification
]);

$index = 'index_tinymce_2'; // Name of your OpenSearch index
$id = '1'; // Document ID (you can choose a different ID or let OpenSearch generate one)
$filePath = 'test.pdf'; // Path to your PDF file

// Check if the file exists
if (!file_exists($filePath)) {
    die("File not found: $filePath");
}

// Read the PDF file and encode it in base64
$pdfData = base64_encode(file_get_contents($filePath));
$filename = basename($filePath); // Get just the filename

try {
    // Prepare the request with Basic Authentication
    $response = $client->request('PUT', "https://opensearch-kages-qs-fit4-webtest.apps.ocp.qs-kagesintern.at/$index/_doc/$id", [
        'headers' => [
            'Content-Type' => 'application/json',
        ],
        'auth' => [$username, $password], // Add authentication credentials
        'json' => [
            'file' => $pdfData, // Base64 encoded content
            'filename' => $filename, // Original filename
        ],
    ]);

    // Output the response
    echo "Document uploaded successfully. Response:\n";
    echo $response->getBody();
} catch (RequestException $e) {
    echo "Error uploading document:\n";
    if ($e->hasResponse()) {
        echo $e->getResponse()->getBody();
    } else {
        echo $e->getMessage();
    }
}
?>