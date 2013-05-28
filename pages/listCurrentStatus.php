<?php
include_once "config.lib.php";
$data='';
$emailId=$_SESSION['emailId'];
$query = "SELECT * from userStatus WHERE emailId = '".$emailId."'";
$res = mysql_query($query);
$info = mysql_fetch_array($res);
if(gettype($info['emailId'])!='NULL'){
	$data = $info['curStatus']."#".$info['timeStamp'];
	}
echo $data;
exit;
?>
