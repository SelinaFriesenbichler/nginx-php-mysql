<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// MinIO server configuration
$minioEndpoint = 'https://rh-os-storage.qs-kagesintern.at'; // Replace with your MinIO endpoint
$minioKey = 'NZH2qTTfoQqrai6w54h0'; // Replace with your MinIO access key
$minioSecret = 'VIOMtc5po8OU7lQ5I3ey0RGhQ8jb5t07QXxU19fn'; // Replace with your MinIO secret key
$bucket = 'tinycme'; // Replace with your bucket name

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
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['file']['tmp_name'];
        $fileName = $_FILES['file']['name'];

        // Upload the file to MinIO
        $result = $s3Client->putObject([
            'Bucket' => $bucket,
            'Key' => $fileName,
            'SourceFile' => $fileTmpPath,
            'ContentType' => mime_content_type($fileTmpPath),
        ]);

        // Return the URL of the uploaded object
        echo json_encode(['location' => $result['ObjectURL']]);
    } else {
        throw new Exception('File upload error: ' . $_FILES['file']['error']);
    }
} catch (AwsException $e) {
    // Output error message if fails
    echo json_encode(['error' => $e->getMessage()]);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}

?>
