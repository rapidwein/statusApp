<?php
include_once "config.lib.php";
$emailId = $_SESSION['emailId'];
$data ='';
$query = "SELECT * FROM userStatus WHERE emailId = '".$emailId."' AND completed=0";
$res = mysql_query($query);
while($info = mysql_fetch_array($res)){
	if(gettype($info['task'])!='NULL')
		$data.=$info['task'].";";
}
echo $data;
exit;
?>
