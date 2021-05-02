<?php
	
	//IMPORTS
	include '../includes/mysql_connection.php'; 
	include '../accounts/forgot_pass.php';

	// ISSET LOGOUT BUTTON
	if (isset($_POST['logout'])) {
		record_event(mysql_connect(),$_SESSION['username'],'Log-out');
		session_destroy(); //END SESSION (CLEAR VARIABLES)
		header('location: ../index.php'); // RELOAD INDEX PHP
	}//END

	// ISSET CHANGE PASS
	if(isset($_POST['change'])){
		$_SESSION['show_modal_change_pass'] = 'true';
		header('location: ../index.php'); // RELOAD INDEX PHP
	}

	// ISSET SUBMIT PASS
	if(isset($_POST['submit_change'])){
		$con = mysql_connect(); // call mysql connection
		$pass = password_hash($_POST['Password_forgot'],PASSWORD_DEFAULT);
		if (update_password($con,$_SESSION['username'],$pass)) {
			$_SESSION['success'] = 'true';
			record_event(mysql_connect(),$_SESSION['username'],'Password Changed');
		}
		close_connection($con); // close connection
		header('location: ../index.php'); // RELOAD INDEX PHP
	}

	// ISSET SUBMIT (OK) - MESSAGE DIALOG
	if(isset($_POST['ok_login'])){
		header('location: ../index.php'); // SET DEFAULT LOCATION INDEX PHP
	}// END ISSET SUBMIT (OK) - MESSAGE DIAGLOG

	function show_activity_log($con,$user){
		// CHECK IF USER IS ADMIN
		$_SESSION['user_array'] = array(); 
		$_SESSION['action_array'] = array();
		$_SESSION['time_array'] = array();
		if ($user == 'ADMIN') {
			$query = 'SELECT * FROM `event_log`'; 
			$_SESSION['search'] ='true';
		}
		else{$query = 'SELECT * FROM `event_log` WHERE `account_user` = "'.$_SESSION['username'].'" ';
		}
		$result = mysqli_query($con,$query);
		$count = mysqli_num_rows($result);
		if($count > 0){
			while ($row = mysqli_fetch_assoc($result)) {
				array_push($_SESSION['user_array'], $row['account_user']);
				array_push($_SESSION['action_array'], $row['event_action']);
				array_push($_SESSION['time_array'], $row['event_time']);
			}
			return true;
		}
		else{
			return false;
		}	
	}

	if (isset($_POST['activity_log'])) {
		$con = mysql_connect();

		if (show_activity_log($con,$_SESSION['username']) == true) {
			$_SESSION['show_log'] = 'true';
		}
		close_connection($con);
		header('location: ../index.php'); // SET DEFAULT LOCATION INDEX PHP
	}

?>