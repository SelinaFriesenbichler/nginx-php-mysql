<!DOCTYPE html>
<html>
    <head>
        <title>Nginx-PHP-MySQL</title>
		<link rel="stylesheet" href="style.css">
    </head>
    <body>
	<h1>Nginx-PHP-MySQL</h1>
	<br>
        <?php echo '<p>PHP is working</p>'; ?>
	<br>
	<p><a href="phpinfo.php" target="_blank">» PHPInfo</a></p>
	<p><h2>TinyMCE</h2></p>
	<p><a href="tinymce.php" target="_blank">» TinyMCE</a></p>
	<p><a href="tinymce_all_free_features.php" target="_blank">» TinyMCE with all Free Open Source Features</a></p>
	<p><a href="test-tinymce-all-free-features-save-and-retrive-from-minio.html" target="_blank">» TinyMCE with all Free Open Source Features | <strong>Save Content to Minio</strong> | <strong>Retrieve Content from Minio</strong></a></p>
	<br>
	<p><h2>TinyMCE + OpenSearch</h2></p>
	<p><a href="tinymce-add-content-to-opensearch-with-guzzle.php" target="_blank">» TinyMCE | Add Content to Opensearch with <strong>Guzzle http client</strong></a></p>
	<p><a href="tinymce_all_free_features-add-content-to-opensearch-with-guzzle.php" target="_blank">» TinyMCE with all Free Open Source Features | Add Content to Opensearch with <strong>Guzzle http client</strong></a></p>
	<br>
	<p><h2>CKEditor</h2></p>
	<p><a href="ckeditor.php" target="_blank">» CKEditor5</a></p>
	<br>
	<p><h2>MySQL</h2></p>
	<p><a href="mysql.php" target="_blank">» MySQL Connection Check</a></p>
	<p><a href="getdbcontent.php" target="_blank">» Get DB Content TinyMCE</a></p>
	<p><a href="getdbcontent-ckeditor.php" target="_blank">» Get DB Content CKEditor5</a></p>
	<br>
	<p><h2>PHPMyAdmin</h2></p>
	<p><a href="http://localhost:8085" target="_blank">» phpMyAdmin</a></p>
	<br>
	<p><h2>OpenSearch</h2></p>
	<p><a href="get-documents-from-opensearch-index-with-guzzle.php" target="_blank">» Get All Items from OpenSearch Index: index_tinymce_1 | with <strong>Guzzle http client</strong></a></p>	
	<br>
	<p>Today's Date and Time is: <span id='date-time'></span><p>			
        <script>
             var dateAndTime = new Date();
             document.getElementById('date-time').innerHTML=dateAndTime.toLocaleString();
        </script>
    </body>
</html>