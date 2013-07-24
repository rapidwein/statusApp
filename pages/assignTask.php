<?php
include_once "config.lib.php";
$userLogged = $_SESSION['emailId'];
$task = urldecode(mysql_real_escape_string($_POST['task']));
$emailId=mysql_real_escape_string($_POST['emailId']);
	
		$query="UPDATE userStatus SET task ='".$task."', assignee = '".$userLogged."' WHERE emailId = '".$emailId."' AND assignee = ''";
		$res = mysql_query($query);
		$query1="INSERT INTO userStatus (emailId,curStatus,prevStatuses,task,assignee) VALUES('".$emailId."','','','','')";
		$res1=mysql_query($query1);
		
	

exit;
?>
