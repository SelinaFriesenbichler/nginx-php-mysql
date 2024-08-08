<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Create an S3 client
$s3Client = new S3Client([
    'region' => 'us-east-1', // Change to your desired region
    'version' => 'latest',
    'credentials' => [
        'key' => 'YOUR_AWS_ACCESS_KEY', // Your AWS Access Key
        'secret' => 'YOUR_AWS_SECRET_KEY', // Your AWS Secret Key
    ],
]);

// Bucket name and file to upload
$bucket = 'your-bucket-name';
$filePath = 'path/to/your/file.txt'; // Local file path
$key = basename($filePath); // The key (filename) in S3

try {
    // Upload data to S3
    $result = $s3Client->putObject([
        'Bucket' => $bucket,
        'Key'    => $key,
        'SourceFile' => $filePath, // Path to the local file
        'ACL'    => 'public-read', // Set ACL (optional)
    ]);

    // Print the URL to the object
    echo "File uploaded successfully. File URL: " . $result['ObjectURL'] . "\n";
} catch (AwsException $e) {
    // Output error message if fails
    echo "Error uploading file: " . $e->getMessage() . "\n";
}
