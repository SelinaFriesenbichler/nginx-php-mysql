<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php 
$username = "sqluser"; 
$password = "kld!x.klkwe"; 
$database = "testdb"; 
$mysqli = new mysqli("mysql", $username, $password, $database); 
$query = "SELECT * FROM ckeditor";


echo '<table border="0" cellspacing="2" cellpadding="2"> 
      <tr> 
          <td> <font face="Arial">id</font> </td> 
          <td> <font face="Arial">item_title</font> </td> 
          <td> <font face="Arial">item_content</font> </td> 
      </tr>';

if ($result = $mysqli->query($query)) {
    while ($row = $result->fetch_assoc()) {
        $field1name = $row["id"];
        $field2name = $row["item_title"];
        $field3name = $row["item_content"];

        echo '<tr> 
                  <td>'.$field1name.'</td> 
                  <td>'.$field2name.'</td> 
                  <td>'.$field3name.'</td> 
              </tr>';
    }
    $result->free();
} 
?>
</body>
</html>