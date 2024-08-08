<?php
require 'vendor/autoload.php';

use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Common\Exceptions\Missing404Exception;

// Initialize the Elasticsearch client
$client = ClientBuilder::create()
    ->setHosts(['https://opensearch-kages-qs-fit4-webtest.apps.ocp.qs-kagesintern.at']) // Replace with your OpenSearch endpoint
	->setBasicAuthentication('tinymce', 'paAmvQcW1FpD2qatXc2M') // Replace with your username and password
    ->setSSLVerification(false)
	->build();

// Example usage: Fetching all documents from an index
$indexName = 'index_tinymce_1'; // Replace with your index name

$params = [
    'index' => $indexName,
    'body'  => [
        'query' => [
            'match_all' => (object)[] // Fetches all documents
        ]
    ],
    'headers' => [
        'Content-Type' => 'application/json' // Set content type to application/json
    ]
];

// Add the content-type header manually
$headers = [
    'Content-Type' => 'application/json' // Set the Content-Type header
];

try {
    $response = $client->search($params);
    $documents = $response['hits']['hits'];

    foreach ($documents as $document) {
        echo "ID: " . $document['_id'] . "\n";
        echo "Source: " . json_encode($document['_source']) . "\n\n";
    }
} catch (Exception $e) {
    echo "Error searching documents: " . $e->getMessage() . "\n";
}

?>

