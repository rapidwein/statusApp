<?php
include_once "config.lib.php";
$emailId = $_SESSION['emailId'];
$status = urldecode($_POST['status']);
$task = urldecode($_POST['task']);
$query = "SELECT * FROM userStatus WHERE emailId = '".$emailId."' AND task = '".$task."'";
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
	if($info['curStatus']!='')
		$query1="UPDATE userStatus SET prevStatuses = '".$info['prevStatuses'].$info['curStatus']."#".$info['timeStamp'].";"."' , curStatus = '".$status."' , timeStamp = now() WHERE emailId = '".$emailId."' AND task='".$task."'";
	else
		$query1="UPDATE userStatus SET curStatus = '".$status."' , timeStamp = now() WHERE emailId = '".$emailId."' AND task='".$task."'";

	}	

$res = mysql_query($query1);
if($status!='')
echo "Successfully Updated!";
else
echo "";
exit;
?>
