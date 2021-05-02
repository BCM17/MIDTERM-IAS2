<!DOCTYPE html>
<html>
<head>

	<!--Title-->
	<title>Home Page | Steady Stripes</title>
	<!--CSS Source-->
	<link rel="stylesheet" type="text/css" href="styles/acc_style.css">
	<!--JQuery Library-->
	<script src="js/jquery.js"></script>
	<!--JS Source-->
	<script src="js/account.js"></script>
	<!--PHP Require (Authentication)-->
	<?php require 'accounts/authentication.php'; ?>

</head>
<body style="background-color: white;">
	<br><br><br><br><br><br><br>
	<div class="main_wrapper">
		<div class="center_wrapper">
			<fieldset class="wrapper">
				<legend><img src="images/SS2.jpg" style="width: 130px; height: 130px; border-radius: 100px;"></legend>
				<div class="body_wrapper">
					<h1>Welcome,</h1>
					<h1><?php echo $_SESSION['username'];?>!</h1>
					<p align="center"></p>
					<form action="accounts/account.php" method="post">
						<button name="change">CHANGE PASSWORD</button>
						<button name="activity_log">ACTIVITY LOG</button>
						<button name="logout">LOGOUT</button>
					</form>
				</div>
			</fieldset>
		</div>
	</div>

	<!-----------Modal Message Change Password / Update Password-------------->
	<div id="modal_message_forgot" class="modal_message">
		<div class="modal_message_content" id="modal_message_content_forgot">
		  	<div class="modal_message_header">
		  		<span id="close">&times;</span>
		    	<h2>Change Password</h2>
		  	</div>
		  	<!-----------Form-------------->
		  	<form action="accounts/account.php" method="post">
				<div class="modal-body-forgot" id="forgot_dialog_content">
					<!-----------Dynamic Content-------------->		
				</div>
				<div class="modal_message_footer">
				    <center><button class="csub" id="submit_forgot" name="submit_change" onclick="validate_pass()" style="width: 150px;">SUBMIT</button><center>
		 	 	</div>
		 	</form>
			<!-----------End of Form-------------->
		</div>
	</div>
	<!-----------End of Modal Change Password -------------->

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
				<form action="accounts/account.php" method="post">
			  	<center><button class="ok" id="ok" name="ok_login">OK</button></center>
			  	</form>
		 	 </div>
		</div>
	</div>
	<!-----------End of Modal Message-------------->

	<!-----------Modal Message LOG-------------->
	<div id="modal_message_log" class="modal_message">
		<div class="modal_message_content_logs">
		  	<div class="modal_message_header">
		    	<h2>Activity Logs</h2>
		  	</div>
		  	<div id="header">
			 	<table  id="table_header"  cellpadding="5">
			  		<tr>
			  			<th style="width:31%;">USER</th>
			  			<th style="width:31%;">ACTIVITY</th>
			  			<th>DATE AND TIME</th>
			  		</tr>
			  	</table>
			</div>
			<div class="modal_message_body_log">
			  	<div id="table_data" >
			  		<table id="log_table" border = "2" cellpadding="5">
			  		</table>
			  	</div>
			</div>
			<div id="search_area">
				<div id="search_wrapper">
					<input type="search" id="search" onkeyup="filter_search()" onchange="filter_search()" placeholder="Search User">
				</div>
			</div>
			<div class="modal_message_footer">
				<form action="accounts/account.php" method="post">
			  	<center><button class="ok_log" id="ok" name="ok_login">BACK</button></center>
			  	</form>
		 	 </div>
		</div>
	</div>
	<!-----------End of Modal Message LOG-------------->

<?php

// IF CHANGE PASS IS CLICKED (SHOW MODAL UPDATE PASS)
if (isset($_SESSION['show_modal_change_pass']) && $_SESSION['show_modal_change_pass'] == 'true') {
	echo '<script>show_forgot("Password","Confirm Password");</script>';
	echo '<script>submit_forgot_function("false")</script>';
	$_SESSION['show_modal_change_pass'] = 'false';
}
// IF SUCESS PASSWORD CHANGE
else if (isset($_SESSION['success']) && $_SESSION['success'] == 'true') {
	echo '<script>show_message("Update Success","block");</script>';
	$_SESSION['success'] ='false';
}
// SHOW ACTIVITY LOGS
else if (isset($_SESSION['show_log']) && $_SESSION['show_log'] == 'true') {
	if (isset($_SESSION['search']) && $_SESSION['search'] =='true') {
		echo "<script>document.getElementById('search_area').style = 'display:block';</script>";
		$_SESSION['search'] ='false';
	}
	echo '<script>document.getElementById("modal_message_log").style = "display:block";</script>';
	for ($i=sizeof($_SESSION['user_array'])-1 ; $i >= 0  ; $i-- ) { 
			echo '<script>show_log("'.$_SESSION['user_array'][$i].'","'.$_SESSION['action_array'][$i].'","'.$_SESSION['time_array'][$i].'")</script>';
	}
	$_SESSION['show_log'] = 'false';
}


?>


</body>
</html>