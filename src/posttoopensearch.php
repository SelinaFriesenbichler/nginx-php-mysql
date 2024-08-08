<?php
require 'vendor/autoload.php'; // Load the AWS SDK for PHP

use Aws\OpenSearchService\OpenSearchServiceClient;
use Aws\Exception\AwsException;

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $title = $_POST['post-title'];
    $content = $_POST['mytextarea'];

    // Initialize the OpenSearch client
    $client = new OpenSearchServiceClient([
        'version' => 'latest',
        'region' => 'us-east-1', // Change this to your desired region
		'credentials' => [
			'key' => 'tinymce',
			'secret' => 'paAmvQcW1FpD2qatXc2M',
		],
		'endpoint' => 'https://opensearch-kages-qs-fit4-webtest.apps.ocp.qs-kagesintern.at', // Define your API URL here
		'http' => [
			'verify' => false // Ignore SSL certificate verification
		]
    ]);

    $index = 'index_tinymce_1'; // The index where you want to store the document

    // Document data
    $data = [
        'title' => $title,
        'content' => $content,
    ];

    // Attempt to index the document
    try {
        $result = $client->index([
            'Index' => $index,
            'Document' => $data,
            'Id' => null, // Automatically generate an ID; set to a specific ID if needed
        ]);
        echo "Document indexed successfully. Document ID: " . $result['_id'] . "\n";
    } catch (AwsException $e) {
        // Output error message if fails
        echo "Error indexing document: " . $e->getMessage() . "\n";
    }
} else {
    echo "Invalid request.";
}
?>
