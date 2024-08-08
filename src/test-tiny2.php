<!DOCTYPE html>
<html>
<head>
    <title>TinyMCE with MinIO Upload</title>
	<script src="js/tinymce/tinymce.min.js"></script>
	<? include_once "upload.php"; ?>
</head>
<body>

<textarea id="editor"></textarea>

<script>
tinymce.init({
    selector: '#editor',
    plugins: 'image code',
    toolbar: 'undo redo | link image | code',
    automatic_uploads: true,
    images_upload_url: 'test-tiny2.php',
    file_picker_types: 'image',
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'test-tiny2.php');

        xhr.onload = function() {
            var json;

            if (xhr.status != 200) {
                return failure('HTTP Error: ' + xhr.status);
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                return failure('Invalid JSON: ' + xhr.responseText);
            }

            success(json.location);
        };

        xhr.onerror = function() {
            failure('Network Error');
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    }
});
</script>

</body>
</html>
