<?php
include_once "config.lib.php";
$emailId = $_SESSION['emailId'];
$status = urldecode($_POST['status']);
$query = "SELECT * FROM userStatus WHERE emailId = '".$emailId."'";
$res = mysql_query($query);
$info = mysql_fetch_array($res);
if(gettype($info['emailId'])!='NULL'){
	if($info['prevStatuses']!='')
		$query1="UPDATE userStatus SET prevStatuses = '".$info['prevStatuses'].$info['curStatus']."#".$info['timeStamp'].";"."' , curStatus = '".$status."' WHERE emailId = '".$emailId."'";
	else
		$query1="UPDATE userStatus SET prevStatuses = '".$info['curStatus']."#".$info['timeStamp'].";"."' , curStatus = '".$status."' WHERE emailId = '".$emailId."'";

	}	
else
$query1 = "INSERT INTO userStatus (emailId,curStatus,prevStatuses) VALUES('".$emailId."','".$status."','')";
$res = mysql_query($query1);
echo "Successfully Updated!";
exit;
?>
