<?php
// establishing the connection with the database & consecutive checking.
$connection = mysql_connect(SERVER, USERNAME, SERVER_PASSWORD);
if(!$connection){
	die ("Database connection failed: " . mysql_error());
}
$db_select = mysql_select_db(DATABASE,$connection);
if(!$db_select){
	die ("Database connection failed: " . mysql_error());
}
session_start();	
?>
