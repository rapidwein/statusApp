<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php 

	include("pages/config.lib.php");
		global $loggedIn;
	if(isset($_SESSION['emailId']))
		$loggedIn = 1;	
?>
<html>
<title>Status App</title>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="./css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="./css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="./scripts/jquery.js"></script>
<script type="text/javascript" src="./scripts/jquery-2.0.0.min.js"></script>
<script src="./scripts/bootstrap.min.js"></script>

<script type='text/javascript'>
       var statusArray = new Array();
	var timeArray = new Array();
 function statusHide(emailId){
	
                var divId = emailId.replace(/[@.]/g,"");
		$('#'+divId+"Statuses").empty();
                document.getElementById(divId+"link").onclick = function(){listStatuses(emailId);};                
	}
 function listStatuses(emailId){
		var divId = emailId.replace(/[@.]/g,"");
			$.ajax({
				url :'pages/listUserStatus.php',
				type : 'post',
				data : {'emailId' : emailId} ,
				success:function(data){
					statusArray = data.split(';');
					 $('#'+divId+"Statuses").append("<br/><table align = 'center' id='"+divId+"Table'></table>");
					$('#'+divId+"Table").append("<tr><td align='center'><pre>Status</pre></td><td align='center'><pre>Time</pre></td></tr>");
                                	for(var i=0;i<statusArray.length;i++){
							timeArray = statusArray[i].split("#");
							$('#'+divId+"Table").append("<tr><td align='center'><pre>"+timeArray[0]+"</pre></td><td align='center'><pre>"+timeArray[1]+"</pre></td></tr>");
						}		
				
					$('#'+divId+"Statuses").append("<div align='center'><input name='giveTask' type='text' placeholder = 'Assign Task'/><button id='assign'>Assign</button></div><div id='taskMessage'></div><br/><br/>");
				  document.getElementById(divId+"link").onclick = function(){statusHide(emailId);} 
	                	  document.getElementById("assign").onclick = function(){assignTask(emailId);}
  
				
			}	
		});

}
 function seniority(){
		$.ajax({
			url :'pages/checkSeniority.php',
			type : 'get',
			success : function(data){
					console.log(data);
					if(data!=""){
						if(data=="minor")
							minorYear();
						else{
							$('#userDataList').append("<h4>List of Active 2nd Years</h4>");
							$('#userDataList').append(data);
						
							
				}
			}
		}
	});
}
 function assignTask(emailId){
	//	var divId = emailId.replace(/[@.]/g,"");
		$.ajax({
			url : 'pages/assignTask.php',
			type : 'post',
			data : {'task' : encodeURI($('input[name=giveTask]').val()) , 'emailId' : emailId},
			success : function(){
					$('#taskMessage').append("Successfully Assigned");
		}
	});
}
function minorYear(){
	$('#statusDiv').append("<br/><br/><div>What's your curent status ? <input id = 'curStatus' type ='text' /><button id='submit' onclick = 'uploadStatus()'>Submit</button></div><br/><div id ='message'></div>");
	listCurrentStatus();
}
 function listCurrentStatus(){
		$.ajax({
                url : 'pages/listCurrentStatus.php',
                type : 'get',
                success : function(data){
                                if(data!=''){
					$('#userDataList').empty();
                                        $('#userDataList').append("<br/><h4>My Current Status</h4><br/><table align='center'><tr><td style='text-align:left'><pre>Status</pre></td><td style='text-align:left'><pre>Time</pre></td>");
                                        var timeArray = data.split('#');
                                        $('#userDataList').append("<tr><td style='text-align:left'><pre>"+timeArray[0]+"</pre></td><td style='text-align:left'><pre>"+timeArray[1]+"</pre></td></tr></table>");
                        }
                }
        });

	}
 function uploadStatus(){
	console.log($('#curStatus').val());
var statusValue = encodeURI($('#curStatus').val());
			$.ajax({
			url : 'pages/uploadStatus.php',
			type : 'post',
			data : { 'status' : statusValue},
			success : function(data){
				$('#message').empty();
				$('#message').append(data);
				listCurrentStatus();
			}

		});
};



	function registration(){
		console.log($('#year').val());
		$.ajax({
			url: './pages/registration.php',
			type: 'post',
			data: {'firstName': $('input[name=firstName]').val(), 'lastName': $('input[name=lastName]').val(),'emailId':$('input[name=emailId]').val(), 'regPassword':$('input[name=regPassword]').val(), 'confPassword':$('input[name=confPassword]').val(), 'year': $('#year').val()},
			success: function(data){
				if(data=='Success!'){
					window.location = "./";
					  $('#registrationForm').empty();
					}
				else{	
					$('#errorMessage').empty();
					$('#errorMessage').append(data);	
				}
			}		
		});
	
	}
	
	function login(){
		$.ajax({
			url: './pages/login.php',
			type: 'post',
			data: {'emailId':$('input[name=username]').val(), 'password':$('input[name=password]').val()},
			success: function(data){
				if(data){
					$('#loginErrorMessage').empty();
					$('#loginErrorMessage').append(data);	
				}
				else{ 
				
					window.location = "./";
					$('#loginForm').empty();	
				}
			}
		});
		
	}
		function logout(){
				$.ajax({
					url : 'pages/logout.php'	
			});
			$('#logged').empty();
			$('#statusDiv').empty();
			$('#userDataList').empty();
			$('#logged').append("<div id=''><a href='#myModalRegister' role='button' class='btn btn-primary' data-toggle='modal'> REGISTER </a> <a href='#myModalLogin' role='button' class='btn btn-primary' data-toggle='modal'> LOGIN </a></div>");
		}
</script>
</head>
<body>
 <?php

    if($loggedIn==1 && $_SESSION['views']==1){
		echo "<div id='logged'>Hello!".$_SESSION['emailId']." <a href='javascript:void' onclick = 'logout()'>Logout</a></div>";
		$_SESSION['views']++;
		}
	else if($loggedIn==1 && $_SESSION['views']!=1){
		echo "<div id='logged'>".$_SESSION['emailId']." <a href='javascript:void' onclick = 'logout()'>Logout</a></div>";
		$_SESSION['views']++;
			}	

	  if($loggedIn==1){
            	echo"<script type='text/javascript'>seniority()</script>";
        }
	
if($loggedIn!=1)
	echo "<!-- Registration Modal --><div style='float:left' id='registrationStyle' align='center'><h2>Registration</h2><div class='logReg' id='regForm'><table id='regFormDetails'><tr> <td class='inputFields'> First Name </td> <td class='inputValues'><input name='firstName' type='text' /> </td> </tr><tr> <td class='inputFields'> Last Name </td> <td class='inputValues'><input name='lastName' type='text' /> </td> </tr><tr> <td class='inputFields'> Email Id </td> <td class='inputValues'><input name='emailId' type='email' /> </td> </tr><tr><td class='inputFields'>Choose Password</td><td class='inputValues'><input name='regPassword' type='password' /></td></tr><tr><td class='inputFields'>Confirm Password</td><td class='inputValues'><input name='confPassword' type='password' /></td></tr><tr><td class='inputFields'>Year</td><td class='inputValues'><select id='year'><option value=''></option><option value='2'>2</option><option value='3'>3</option><option value='4'>4</option></select></td></tr></table><button onclick='registration()'>Register</button></div><div id='errorMessage'></div></div><!-- Login Modal --><div align='center' style='float:right' id='loginStyle'><h2>Login</h2><div class='logReg' id='loginForm'><div><input name='username' type='text' placeholder='Username' /><br/><input name='password' type='password' placeholder='Password' /></div><button onclick='login()'>Login</button><div id='loginErrorMessage'></div></div>";
?>
<div id = 'statusDiv'></div>
<div id='userDataList'></div>
</body>
</html>
