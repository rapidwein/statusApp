<?php
	include_once("config.lib.php");
		
	$emailId = mysql_real_escape_string($_POST['emailId']);
	$password = mysql_real_escape_string($_POST['password']);
	
	if(!($emailId&&$password)){
		echo "Enter email and password!";
		exit;
	}
	
	$query = "SELECT * FROM Users WHERE emailId = '".$emailId."'";
	$result = mysql_query($query);
	
	if($info = mysql_fetch_array($result)){
		if($info['password'] != md5($password))
			echo "Email and Password do not match!";
		else{
			$_SESSION['emailId'] = $emailId;
			$_SESSION['views'] = 1;
		}		
	}
	else
		echo "EmailId does not exist!";
?>
