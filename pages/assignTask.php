<?php
include_once "config.lib.php";
$task = urldecode($_POST['task']);
$emailId=mysql_real_escape_string($_POST['emailId']);
$query="INSERT INTO userStatus VALUES('".$emailId."','','','','".$task."')";
$res = mysql_query($query);
exit;
?>
