<!DOCTYPE html>
<html>
<head>

	<!--Title-->
	<title>Login on Steady Stripes</title>
	<!--CSS Source-->
	<link rel="stylesheet" type="text/css" href="../styles/acc_style.css">
	<!--JQuery Library-->
	<script src="../js/jquery.js"></script>
	<!--JS Source-->
	<script src="../js/account.js"></script>
	<!--Start PHP Session-->

	<?php session_start(); ?>
	
</head>
<body>

	<!-----------Login Box-------------->
	<div class="login_container">
	<fieldset class="loginBox">
		<!--<legend id="login_label" >SyraTech</legend>-->
			<!-----------Form-------------->
	        <form action="../accounts/verify.php" method="post" required name="myForm">
			        <div id="login_input">
			        	
			        	<label class="LoginSteadyStripes">Login in to Steady Stripes</label><br>
			        	<!--<label class="label_pointer" for="user">Username</label>-->
			        	<input type="text" name ="user" id="user" placeholder="Username" required>
			        	<br>
			        	<!--<label class="label_pointer" for="pass">Password</label>-->
				    	<input type="password" name="pass" id="pass" placeholder="Password" required>
			        </div>
				    <p id="forgot">Forgot Password?</p>
				    <button id="submit_login" name="submit_login" value="true">LOGIN</button>
				    <p id="login">Not a member? <a name="ha" href="register.php" style="color: blue;"> Sign up for Steady Stripes</a></p>
	        </form>
	        <!-----------End of Form-------------->   
	</fieldset>
	</div>
	<!-----------End of Login Box-------------->

	<!-----------Modal Authentication Code-------------->
	<div id="modal" class="modal">
		<div class="modal-content">
		  <div class="modal-header">
		    <span class="close">&times;</span>
		    <h2>Authentication</h2>
		  </div>
		  <form action="verify.php" method="post">
			  <div class="modal-body">
			  	<table>
			  		<tr>
			  			<td><label for = "ver" style="color: black; font-size: 15px; margin-left: 0px; padding-right: 10px; font-weight: bold;">Code: </label></td>
			  			<td><input type="text" name="ver" id="ver" placeholder="Enter Authentication Code"></td>
			  		</tr>
			  	</table>
			  </div>
			  <div class="modal-footer" style="background: white;">
			    <button class="csub" name="submit_otp" style="width: 150px; margin-left: 20px; ">SUBMIT</button>
			    <button class="resend" name="resend" style="width: 150px; margin-left: 25px; background-color: gray;">RESEND CODE</button>
		 	  </div>
		  </form>
		</div>
	</div>
	<!-----------End of Modal Authentication Code-------------->

	<!-----------Modal Message-------------->
	<div id="modal_message" class="modal_message">
		<div class="modal_message_content">
		  	<div class="modal_message_header">
		    	<h2>Notification</h2>
		  	</div>
			 <div class="modal_message_body">
			  	<center><label id="msg"></label></center>
			 </div>
			<div class="modal_message_footer">
				<form action="verify.php" method="post">
			  	<center><button class="ok" id="ok" name="ok_login">OK</button></center>
			  	</form>
		 	 </div>
		</div>
	</div>
	<!-----------End of Modal Message-------------->

	<!-----------Modal Message Forgot Password / Update Password-------------->
	<div id="modal_message_forgot" class="modal_message">
		<div class="modal_message_content" id="modal_message_content_forgot">
		  	<div class="modal_message_header">
		  		<span class="close">&times;</span>
		    	<h2>Forgot Password</h2>
		  	</div>
		  	<!-----------Form-------------->
		  	<form action="forgot_pass.php" method="post">
				<div class="modal-body-forgot" id="forgot_dialog_content">
					<!-----------Dynamic Content-------------->		
				</div>
				<div class="modal_message_footer">
				    <center><button class="csub" id="submit_forgot" name="submit_forgot" value="true" onclick="validate_pass()" style="width: 150px;">SUBMIT</button><center>
		 	 	</div>
		 	</form>
			<!-----------End of Form-------------->
		</div>
	</div>
	<!-----------End of Modal Forgot Password -------------->

	


<!----------------------------PHP CODES STARTS HERE------------------------------>
<?php 
// IF AUTHENTICATED (LOGIN - AUTHENTICATION SUCCESS) - SHOW SUCCESS
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == 'true') {
	echo '<script>show_message("Successfully Login!","block");</script>'; 
	$_SESSION['authenticated'] = 'false';
}
// IF FAILED (LOGIN-SUCCESS BUT AUTHENTICATION-FAILED) - SHOW FAILED
else if(isset($_SESSION['authentication_failed']) && $_SESSION['authentication_failed'] == 'true' ){
	echo '<script>show_message("Invalid authentication code","block");</script>'; 
	$_SESSION['authentication_failed'] = 'false';
}
// IF LOG-IN FAILED - SHOW USER DOES NOT EXIST
else if (isset($_SESSION['failed']) && $_SESSION['failed'] == 'true') {
	echo '<script>show_message("Invalid username and password","block")</script>';
	$_SESSION['failed'] = 'false';
}
// IF LOG-IN SUCCESS (SHOW AUTHENTICATION CODE)
else if ((isset($_SESSION['code']) && isset($_SESSION['modal_msg'])) && $_SESSION['modal_msg'] == 'true'){
	echo '<script>show_message("Code : '.$_SESSION['code'].'","block");</script>';
	$_SESSION['modal_msg'] = 'false';
} 
// IF AUTHENTICATION CODE SHOWN (SHOW MODAL AUTHENTICATION INPUT NEXT)
else if (isset($_SESSION['modal']) && $_SESSION['modal'] == 'true' ){ 
	echo '<script>show_modal("block");</script>'; 
	$_SESSION['modal'] = 'false';
}
// IF VALID USER & EMAIL (SHOW UPDATE PASSWORD MODAL)
else if (isset($_SESSION['update_modal']) && $_SESSION['update_modal'] == 'true'){
	echo '<script>show_forgot("Password","Confirm Password");</script>'; 
	echo '<script>submit_forgot_function("false")</script>';
	$_SESSION['update_modal'] = 'false';
}
// IF INVALID USER & EMAIL (SHOW FAILED  MODAL)
else if (isset($_SESSION['forgot_failed']) && $_SESSION['forgot_failed'] == 'true'){
	echo '<script>show_message("User does not exist","block");</script>'; 
	$_SESSION['forgot_failed'] = 'false';
}
// IF UPDATE PASS SUCCESS (SHOW SUCCESS)
else if (isset($_SESSION['update_success']) && $_SESSION['update_success'] == 'true'){
	echo '<script>show_message("Update Success","block");</script>'; 
	echo '<script>submit_forgot_function("true")</script>';
	$_SESSION['update_success'] = 'false';
}
// STATIC DISPLAY USER & PASS
else if(isset($_SESSION['display_user']) && isset($_SESSION['display_pass'])){
	echo '<script>display_input_login("'.$_SESSION['display_user'].'","'.$_SESSION['display_pass'].'")</script>';
	session_destroy();
}
//ELSE PROCEED TO LOGIN PAGE HTML
?>
<!----------------------------PHP CODES ENDS HERE------------------------------>


</body>  
</html>

