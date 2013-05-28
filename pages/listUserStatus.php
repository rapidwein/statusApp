<?php
include_once "config.lib.php";
$data='';
$emailId=mysql_real_escape_string($_POST['emailId']);
/*
$query = "SELECT * from userStatus";
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
		if(preg_replace('/[@.]/s],'',$info['emailId'])==$emailId){
			$emailId = $info['emailId'];
			break;
		}
	}
*/
$query1 = mysql_query("SELECT * from userStatus WHERE emailId = '".$emailId."'");
while($info1 = mysql_fetch_array($query1)){
		if($info1['curStatus']!='')
        	$data.=$info1['task']."&".$info1['prevStatuses'].$info1['curStatus']."#".$info1['timeStamp']."%";
}
echo $data;
exit;
?>
