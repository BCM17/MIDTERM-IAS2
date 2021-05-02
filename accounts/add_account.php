<?php

	// IMPORTS
	require_once '../includes/mysql_connection.php';
	// START SESSION
	session_start();

	//CHECK IF USERNAME EXIST
	function check_user($con,$user){
		$query = 'SELECT * FROM `account` WHERE `account_user` ="'.$user.'"';
		$result = mysqli_query($con,$query);
		return mysqli_num_rows($result);
	}// END 

	//CHECK IF EMAIL EXIST
	function check_email($con,$email){
		$query = 'SELECT * FROM `account` WHERE `account_email` ="'.$email.'"';
		$result = mysqli_query($con,$query);
		return mysqli_num_rows($result);
	}// END 

	// ADD ACCOUNT (SEND TO DATABASE)
	function add_account($con,$user,$pass,$email){
		$query = "INSERT INTO `account`(`account_user`, `account_pass`,`account_email`) VALUES ('".$user."','".$pass."', '".$email."' );";
		return mysqli_query($con,$query);
	}//END ADD ACCOUNT

	// ISSET SUBMIT REGISTER
	if (isset($_POST['submit_register'])) {
		if ($_POST['submit_register'] == 'true') {
			//INITIALIZATION
			$con = mysql_connect();
			$user = $_POST['user'];
			$pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
			$email = $_POST['email'];
			//set session variables
			$_SESSION['display_user_register'] = $user; 
			$_SESSION['display_pass_register'] = $_POST['pass'];
			$_SESSION['display_cpass_register'] = $_POST['cpass'];
			$_SESSION['display_email_register'] = $email;

			if(check_user($con,$user) == 0){
				if(check_email($con,$email) == 0){
					if (add_account($con,$user,$pass,$email)){
						$_SESSION['hide'] = 'true';
						$_SESSION['success'] = 'true';
						header('location: register.php');
					}
					else{
						$_SESSION['error'] = 'true';
						$_SESSION['hide_msg'] = 'true';
						header('location: register.php');
					}
				}
				else{
					$_SESSION['email_exist'] = 'true'; // email exist
					$_SESSION['hide_msg'] = 'true';
					header('location: register.php');
				}
			}
			else{
				$_SESSION['user_exist'] = 'true'; // username exist
				$_SESSION['hide_msg'] = 'true';
				header('location: register.php');
			}
			
			close_connection($con); // close connection
		}
		else{
			header('location: register.php'); // Default Header
		}
		
	}

	// ISSET SUBMIT (OK) - MESSAGE DIAGLOG
	if(isset($_POST['ok'])){
		if (isset($_SESSION['hide']) && $_SESSION['hide'] == 'true'){
			session_destroy(); // DESTROY SESSION (CLEAR VARIABLES)
			header('location: ../index.php'); // (Resgistered Redirect to Login)
		}
		else if (isset($_SESSION['hide_msg']) && $_SESSION['hide_msg'] == 'true'){
			header('location: register.php'); // (Problem occured Redirect to Reg)
		}
	}// END ISSET SUBMIT (OK) - MESSAGE DIAGLOG





?>