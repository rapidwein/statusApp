<?php
include_once "config.lib.php";
$task = urldecode(mysql_real_escape_string($_POST['task']));
$emailId=mysql_real_escape_string($_POST['emailId']);
$query="UPDATE userStatus SET task ='".$task."' WHERE emailId = '".$emailId."'";
$res = mysql_query($query);
exit;
?>
