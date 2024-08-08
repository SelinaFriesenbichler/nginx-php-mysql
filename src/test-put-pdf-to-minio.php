<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// MinIO server configuration
$minioEndpoint = 'https://rh-os-storage.qs-kagesintern.at'; // Replace with your MinIO endpoint
$minioKey = 'NZH2qTTfoQqrai6w54h0'; // Replace with your MinIO access key
$minioSecret = 'VIOMtc5po8OU7lQ5I3ey0RGhQ8jb5t07QXxU19fn'; // Replace with your MinIO secret key
$bucket = 'tinymce'; // Replace with your bucket name
$key = 'test.pdf'; // The key (name) of the file in the bucket
$filePath = 'test.pdf'; // Path to the file you want to upload

// Instantiate the S3 client with MinIO configuration and SSL verification disabled
$s3Client = new S3Client([
    'version' => 'latest',
    'region' => 'at-kages', // You can use any region, MinIO doesn't require a specific one
    'endpoint' => $minioEndpoint,
    'use_path_style_endpoint' => true,
    'credentials' => [
        'key' => $minioKey,
        'secret' => $minioSecret,
    ],
    'http' => [
        'verify' => false, // Disable SSL verification
    ],
]);

try {
    // Upload a file to the specified bucket
    $result = $s3Client->putObject([
        'Bucket' => $bucket,
        'Key' => $key,
        'SourceFile' => $filePath,
        'ContentType' => 'application/pdf', // You can specify the content type
    ]);

    // Print the URL of the uploaded object
    echo "File uploaded successfully. Object URL: " . $result['ObjectURL'] . PHP_EOL;
} catch (AwsException $e) {
    // Output error message if fails
    echo "Error uploading file: " . $e->getMessage() . PHP_EOL;
}
?>