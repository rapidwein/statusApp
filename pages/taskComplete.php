<?php
include_once "config.lib.php";
$emailId = mysql_real_escape_string($_SESSION['emailId']);
$task = urldecode(mysql_real_escape_string($_POST['task']));
$query = "UPDATE userStatus SET completed = 1 WHERE emailId='".$emailId."' AND task = '".$task."'";
$res=mysql_query($query);
exit;
?>
