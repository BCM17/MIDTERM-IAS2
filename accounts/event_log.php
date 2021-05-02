
<?php
	
	//RECORD EVENT
	function record_event($con,$user,$action){
		$query = "INSERT INTO `event_log`(`account_user`, `event_action`) VALUES ('".$user."','".$action."');";
		return mysqli_query($con,$query);
		close_connection($con); //close connection
	}//END RECORD EVENT FUNCTION

?>