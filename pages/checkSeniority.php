<?php
include_once "config.lib.php";
$emailId=mysql_real_escape_string($_SESSION['emailId']);
$data = "";
$query = "SELECT * FROM Users WHERE emailId ='".$emailId."'";
$res = mysql_query($query);
$info = mysql_fetch_array($res);
if(gettype($info['emailId'])!='NULL'){
	
	$year = (int)$info['year'];
	if($year>2){
		$query1 = mysql_query("SELECT DISTINCT emailId FROM userStatus");
		while($info1 = mysql_fetch_array($query1)){
			$divId = preg_replace('/[@.]/s', '',$info1['emailId']);
			$data.="<div id = '".$divId."' align='center'><a href='javascript:void' id='".$divId."link' onclick =\"listStatuses('".$info1['emailId']."')\">".$info1['emailId']."</a><div id='".$divId."Statuses' align='center'></div>";		
	}
	
		}
	else
		$data ="minor";
	}
echo $data;
exit;
?>
