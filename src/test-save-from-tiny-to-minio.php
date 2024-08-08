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

$response = ['status' => 'error', 'message' => 'Unknown error'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valueName = $_POST['value_name'];
    $content = $_POST['content']; // Content from TinyMCE
    $data = [
        'content' => $content,
        'files' => []
    ];

    // Handle file uploads
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $fileName = basename($_FILES['file']['name']);
        $filePath = $_FILES['file']['tmp_name'];

        try {
            $result = $s3Client->putObject([
                'Bucket' => 'tinymce',
                'Key'    => 'uploads/' . $fileName,
                'SourceFile' => $filePath,
            ]);

            $data['files'][] = [
                'name' => $fileName,
                'url'  => $result['ObjectURL'],
            ];
        } catch (AwsException $e) {
            $response['message'] = $e->getMessage();
            echo json_encode($response);
            exit;
        }
    }

    // Save the JSON blob
    $jsonBlob = json_encode($data);
    try {
        $result = $s3Client->putObject([
            'Bucket' => 'tinymce',
            'Key'    => 'content/' . $valueName . '.json',
            'Body'   => $jsonBlob,
        ]);

        $response['status'] = 'success';
        $response['message'] = 'Content saved successfully: ' . $result['ObjectURL'];
    } catch (AwsException $e) {
        $response['message'] = $e->getMessage();
    }
}

header('Content-Type: application/json');
echo json_encode($response);
?>
