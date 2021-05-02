<?php 

	//start session
	session_start();

	// condition
	if(isset($_SESSION['authenticated']) && isset($_SESSION['username'])){} // proceed to index html (log-in success)
	else{header('Location: accounts/login.php');} // back to login page (log-in failed)
	// end
	
?>