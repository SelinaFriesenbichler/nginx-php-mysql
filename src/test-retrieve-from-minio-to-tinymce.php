<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

$s3Client = new S3Client([
    'version' => 'latest',
    'region'  => 'at-kages',
    'endpoint' => 'https://rh-os-storage.qs-kagesintern.at',
    'use_path_style_endpoint' => true,
    'credentials' => [
        'key'    => 'NZH2qTTfoQqrai6w54h0',
        'secret' => 'VIOMtc5po8OU7lQ5I3ey0RGhQ8jb5t07QXxU19fn',
    ],
    'http' => [
        'verify' => false
    ]
]);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['key'])) {
    $key = $_GET['key'] . '.json'; // The key of the JSON blob

    try {
        $result = $s3Client->getObject([
            'Bucket' => 'tinymce',
            'Key'    => 'content/' . $key,
        ]);

        $jsonBlob = $result['Body'];
        $data = json_decode($jsonBlob, true);

        header('Content-Type: application/json');
        echo json_encode($data);
    } catch (AwsException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>