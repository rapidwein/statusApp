<?php
	include_once("config.lib.php");
	/*	
	if(!isset($_SESSION['emailId']))
		header('Location: ../');*/
		
	$firstName = mysql_real_escape_string($_POST["firstName"]);
	$lastName = mysql_real_escape_string($_POST["lastName"]);
	$emailId = mysql_real_escape_string($_POST["emailId"]);
	$password = mysql_real_escape_string($_POST["regPassword"]);
	$confPassword = mysql_real_escape_string($_POST["confPassword"]);
	$year = mysql_real_escape_string($_POST["year"]);
	
	if(!($firstName&&$lastName&&$emailId&&$password&&$confPassword&&$year)){
		echo "All fields need to filled!";
		exit;
	}
	
	if(preg_match("/^[0-9]+[.-]/",$fullName) == 1){
		echo "Invalid Name";
		exit;
	}
	
	if(preg_match("/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/",$emailId)==1){
		echo "Invalid Email-Id";
		exit;
	}
		
	$query = "SELECT * FROM Users";
	$result = mysql_query($query);
	
	while($info = mysql_fetch_array($result)){
		if($info['emailId'] == $emailId){
			echo "Email Id already exists!";
			exit;
		}
	}
		
	if(strcmp($confPassword,$password)!=0){
		echo "Passwords don't match!";
		exit;
	}
	else{
		$password = md5($password);
		$query = "INSERT INTO Users (emailId, firstName, lastName , password, year) VALUES ('".$emailId."', '".$firstName."','".$lastName."','".$password."','".$year."')";
		mysql_query($query);
		if($year==2){
			$query1="INSERT INTO userStatus (emailId,curStatus,prevStatuses,task) VALUES('".$emailId."','','','')";
			$res1=mysql_query($query1);
		}
		$_SESSION['emailId'] = $emailId;
		$_SESSION['views'] = 1;
		echo "Success!";
		exit;
	}	
?>
