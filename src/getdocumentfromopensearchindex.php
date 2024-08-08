<?php
require 'vendor/autoload.php';

use Aws\OpenSearchService\OpenSearchServiceClient;

$client = new OpenSearchServiceClient([
    'version' => 'latest',
    'region' => 'us-east-1', // Your AWS region
    'credentials' => [
        'key' => 'tinymce',
        'secret' => 'paAmvQcW1FpD2qatXc2M',
    ],
    'endpoint' => 'https://opensearch-kages-qs-fit4-webtest.apps.ocp.qs-kagesintern.at', // Define your API URL here
	'http' => [
        'verify' => false // Ignore SSL certificate verification
    ]
]);

$index = 'index_tinymce_1';

try {
    // Execute the search query
    $result = $client->search([
        'Index' => $index,
        'Body' => [
            'query' => [
                'match_all' => (object)[],
            ],
        ],
    ]);
    
    // Print the results
    foreach ($result['hits']['hits'] as $hit) {
        echo "Document ID: " . $hit['_id'] . "\n";
        echo "Document Source: " . json_encode($hit['_source']) . "\n";
    }
} catch (Exception $e) {
    echo "Error searching documents: " . $e->getMessage() . "\n";
}
?>

