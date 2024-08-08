<?php
// Checking or there is a post request, and checking or the "mytextarea" field is set
if(!empty($_POST['mytextarea']))
{
    // Creating the database connection
    $dsn = 'mysql:dbname=testdb;host=mysql';
    $user = 'sqluser';
    $password = 'kld!x.klkwe';

    try {
        $dbh = new PDO($dsn, $user, $password);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }

    // Getting the variables from the form
    $title = $_POST['post-title'];
    $content = $_POST['mytextarea'];

    // Executing the query
    $query = $dbh->prepare('INSERT INTO tabelle3 (item_title, item_content) VALUES (:item_title, :item_content)');
    $query->execute([':item_title' => $title, ':item_content' => $content]);
	
	echo '<p style="color: green; font-size: 16px; text-align: center">Success</p>';
	
}
?>