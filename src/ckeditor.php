<!doctype html>
<html>
 <body style="backgroud-color:rgb(49, 214, 220);"><center>
    <head>
     <title>Test CKEditor5</title>
	 		<link rel="stylesheet" href="ckeditor5/ckeditor5.css">
        <style>
            .main-container {
                width: 795px;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
<? include_once "posttomysql-ckeditor.php"; ?>
    </head>
    <body>
     <p>Test mit CKEditor5<p><br><br>
	 <form method="post" action="<?=$_SERVER['PHP_SELF'];?>">
	    <label name="post-title" for="post-title">BeitragsID</label>
        <input type="text" name="post-title" id="post-title"><br>
		<input type="submit" name="submit" value="SPEICHERN in DB"><br><br><br>
		<textarea id="editor" class="main-container" name="editor"></textarea><br><br>
	
	</form>

	<br><br>
	
	
<!--       <div class="main-container">
            <div id="editor">
                <p>Hello from CKEditor 5!</p>
            </div>
		</div> -->
		<script type="importmap">
			{
				"imports": {
					"ckeditor5": "./ckeditor5/ckeditor5.js",
					"ckeditor5/": "./ckeditor5/"
				}
			}
		</script>
        <script type="module">
            import {
                ClassicEditor,
                Essentials,
                Paragraph,
                Bold,
                Italic,
                Font
            } from 'ckeditor5';

            ClassicEditor
                .create( document.querySelector( '#editor' ), {
                    plugins: [ Essentials, Paragraph, Bold, Italic, Font ],
                    toolbar: [
						'undo', 'redo', '|', 'bold', 'italic', '|',
						'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor'
					]
                } )
                .then( editor => {
                    window.editor = editor;
                } )
                .catch( error => {
                    console.error( error );
                } );
        </script>	
	
        <p>Today's Date and Time is: <span id='date-time'></span><p>
        <script>
             var dateAndTime = new Date();
             document.getElementById('date-time').innerHTML=dateAndTime.toLocaleString();
        </script>
		</body>
</html>