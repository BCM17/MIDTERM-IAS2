<?php
	
	// IMPORTS
	require_once '../includes/mysql_connection.php';
	include 'event_log.php';
	//START SESSION
	session_start();

	// VERIFY (USERNAME-EMAIL)
	function verify_user_email($con,$user,$email){
		$query = 'SELECT * FROM `account` WHERE `account_user` = "'.$user.'" AND `account_email` = "'.$email.'" ; ';
		$result = mysqli_query($con,$query);
		return mysqli_num_rows($result);
	}//END

	// UPDATE PASSWORD
	function update_password($con,$user,$pass){
		$query = 'UPDATE `account` SET `account_pass`= "'.$pass.'" WHERE `account_user` = "'.$user.'";';
		return mysqli_query($con,$query);
	}//END

	if (isset($_POST['submit_forgot'])) {
		$con = mysql_connect();
		if($_POST['submit_forgot'] == 'true'){
			//get values
			$user = $_POST['Username_forgot'];
			$email = $_POST['Email_forgot'];
			if (verify_user_email($con,$user,$email) == 1) {
				$_SESSION['update_modal'] = 'true'; //show update pass modal
				$_SESSION['update_pass'] = 'true'; // update submit (password)
				$_SESSION['forgot_user'] = $user; // user input (forgot pass)
				record_event($con,$_SESSION['forgot_user'],'Forgot Password');
			}
			else{
				$_SESSION['forgot_failed'] = 'true';
			}
		}
		else if (isset($_SESSION['update_pass']) && $_SESSION['update_pass'] == 'true' && $_POST['submit_forgot'] == 'false') {
			//get values
			$forgot_pass = password_hash($_POST['Password_forgot'],PASSWORD_DEFAULT);
			if(update_password($con,$_SESSION['forgot_user'],$forgot_pass)){
				$_SESSION['update_success'] = 'true';
				record_event($con,$_SESSION['forgot_user'],'Password Changed');
			}
			$_SESSION['update_pass'] == 'false';
		}
		close_connection($con); //close connection
		header('location: login.php'); //redirect to login page
	}



?>