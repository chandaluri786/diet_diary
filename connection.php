<?php
session_start();
?>



<?php
$mysql_host = 'cms.appspot.co.in';
//$mysql_host = 'localhost';
$mysql_username = 'jahnavi';
$mysql_password = 'incredible';
$conn = new PDO("mysql:host=$mysql_host;dbname=DietDiary", $mysql_username, $mysql_password);


?>
