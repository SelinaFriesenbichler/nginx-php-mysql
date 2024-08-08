<!doctype html>
<html>
 <body style="backgroud-color:rgb(49, 214, 220);"><center>
    <head>
     <title>Test TinyMCE</title>
	 <script src="js/tinymce/tinymce.min.js"></script>
	   <script type="text/javascript">
tinymce.init({
  selector: "#mytextarea",
  plugins: [
    "save",
    "advlist autolink lists link image charmap print preview anchor",
    "searchreplace visualblocks code fullscreen",
    "insertdatetime media table paste",
  ],
  toolbar:
    "save | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
  save_onsavecallback: () => {
    console.log('Saved');
  },
  save_oncancelcallback: () => {
	console.log('Save canceled');
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