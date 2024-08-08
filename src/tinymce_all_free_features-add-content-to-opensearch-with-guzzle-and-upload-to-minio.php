<!doctype html>
<html>
 <body style="backgroud-color:rgb(49, 214, 220);"><center>
    <head>
     <title>Test TinyMCE</title>
	 <script src="js/tinymce/tinymce.min.js"></script>
	   <script type="text/javascript">
	   const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
tinymce.init({
  selector: 'textarea',
  plugins: 'image code',
  toolbar: 'undo redo | link image | code',
  images_upload_url: 'upload-to-minio-from-tinymce.php',
  automatic_uploads: true,
  file_picker_types: 'image',
  images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;
        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'upload-to-minio-from-tinymce.php');

        xhr.onload = function() {
            var json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());

        xhr.send(formData);
    }
});
  </script>
<? include_once "posttomysql.php"; ?>
<? include_once "posttoopensearchwithguzzle.php"; ?>
    </head>
    <body>
     <p>Test mit TinyMCE offline on prem<p><br><br>
	 <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
	    <label name="post-title" for="post-title">BeitragsID</label>
        <input type="text" name="post-title" id="post-title"><br>
		<input type="submit" name="submit" value="SPEICHERN in DB"><br><br><br>
		<textarea id="mytextarea" name="mytextarea"></textarea><br><br>
	
	</form><br><br>
        <p>Today's Date and Time is: <span id='date-time'></span><p>
        <script>
             var dateAndTime = new Date();
             document.getElementById('date-time').innerHTML=dateAndTime.toLocaleString();
        </script>
		</body>
</html>