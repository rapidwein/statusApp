<?php
include_once "config.lib.php";
$data='';
$emailId=mysql_real_escape_string($_POST['emailId']);

$query1 = mysql_query("SELECT * from userStatus WHERE emailId = '".$emailId."' AND task!=''");
while($info1 = mysql_fetch_array($query1)){
		
        	$data.=$info1['task']."&".$info1['prevStatuses'].$info1['curStatus']."#".$info1['timeStamp']."%";
}
echo $data;
exit;
?>
