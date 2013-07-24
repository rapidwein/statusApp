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
		$query1 = "SELECT DISTINCT emailId FROM userStatus";
		$res1 = mysql_query($query1);
		
		while($info1 = mysql_fetch_array($res1)){
			
			$query2 = "SELECT * FROM Users WHERE emailId ='".$info1['emailId']."' AND department = '".$info['department']."'";
			$res2 = mysql_query($query2);
						
			while($info2 = mysql_fetch_array($res2)){
				
				$divId = preg_replace('/[@.]/s', '',$info1['emailId']);
				$data.="<div id = '".$divId."' align='center'><a href='javascript:void' id='".$divId."link' onclick =\"listStatuses('".$info2['emailId']."')\">".$info2['emailId']."</a><div id='".$divId."Statuses' align='center'></div>";		
			}	
		}	
	}
	else
		$data ="minor";
	}
echo $data;
exit;
?>
