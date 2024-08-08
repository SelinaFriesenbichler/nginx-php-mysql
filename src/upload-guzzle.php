<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // MinIO server configuration
$minioEndpoint = 'https://rh-os-storage.qs-kagesintern.at'; // Replace with your MinIO endpoint
$minioKey = 'NZH2qTTfoQqrai6w54h0'; // Replace with your MinIO access key
$minioSecret = 'VIOMtc5po8OU7lQ5I3ey0RGhQ8jb5t07QXxU19fn'; // Replace with your MinIO secret key
$bucket = 'tinymce'; // Replace with your bucket name

    // Create a Guzzle HTTP client
    $client = new Client([
        'verify' => false, // Disable SSL verification for development
    ]);

    try {
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];

            // Build the upload URL
            $uploadUrl = "$minioEndpoint/$bucket/$fileName";
            echo "Uploading to: $uploadUrl\n"; // Debugging output

            // Upload the file to MinIO
            $response = $client->put($uploadUrl, [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode("$minioKey:$minioSecret"),
                    'Content-Type' => mime_content_type($fileTmpPath),
                ],
                'body' => fopen($fileTmpPath, 'r'), // Open the file for reading
            ]);

            // Return the URL of the uploaded object
            $location = "$uploadUrl";
            echo json_encode(['location' => $location]);
        } else {
            throw new Exception('File upload error: ' . $_FILES['file']['error']);
        }
    } catch (Exception $e) {
        // Output error message if fails
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
