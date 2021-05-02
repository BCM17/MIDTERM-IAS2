	
	//HIDE MODAL IF CLICK IN WINDOW
	window.onclick = function(event) {
	  if (event.target == modal) {
	    modal.style.display = "none";
	  }
	  if (event.target == modal_message) {
	    modal_message.style.display = "none";
	    window.location.replace("../index.php");
	  }
	  if (event.target == modal_message_forgot) {
	    modal_message_forgot.style.display = "none";
	    document.getElementById("submit_forgot").value = "true";
	    window.location.replace("../index.php");
	  }
	}// END

	// HIDE CUSTOM VALIDITY MESSAGE WHILE TYPING
	document.addEventListener("DOMContentLoaded",function(){
		var elements = document.getElementsByTagName('input');
		for (var i = 0; i < elements.length; i++){
			elements[i].oninput = function(e){
				e.target.setCustomValidity('');
			}
		}
	}); //END

	// FILTER ACTIVITY LOG BY SEARCH
	function filter_search(){
		var input = document.getElementById('search');
		var filter = input.value.toUpperCase();
		var table = document.getElementById('log_table');
		var table_row = document.getElementsByTagName('tr');

		for (var i = 0; i < table_row.length; i++) {
			var table_data = table_row[i].getElementsByTagName('td')[0];
			if (table_data) {
				var data_value = table_data.textContent || table_data.innerText;
					if (data_value.toUpperCase().indexOf(filter) > -1) {
						table_row[i].style.display = "";
					}
					else{
						table_row[i].style.display = "none";
					}
			}
		}
	}//END

	// DISPLAY EXISTING INPUT (LOGIN)
	function display_input_login(user,pass){
		document.getElementById('user').value = user;
		document.getElementById('pass').value = pass;
	}// END

	// DISPLAY EXISTING INPUT (REGISTER)
	function display_input_register(user,pass,cpass,email){
		document.getElementById('user').value = user;
		document.getElementById('pass').value = pass;
		document.getElementById('cpass').value = cpass;
		document.getElementById('email').value = email;
	}// END

	//FUNCTION VALIDATE NEW PASSWORD
	function validate_pass(){
		//get button value
		var submit_value = document.getElementById("submit_forgot").value;
		//validations
		var special_characters = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
		var upper = new RegExp("[A-Z]");
		var lower = new RegExp("[a-z]");
		if (submit_value == 'false') {
			var pass = document.getElementById('Password_forgot');
			var cpass = document.getElementById('Confirm Password_forgot');
			// password validations
			if (pass.value.length < 8 && pass.value != '') {
			pass.setCustomValidity("Password must be 8 Characters");
			}		
			else if ((!(pass.value.match(special_characters)) | !(pass.value.match(/\d/)) | !(pass.value.match(upper)) | !(pass.value.match(lower)))  &&  pass.value != '') {
			pass.setCustomValidity("Password must contain atleast one special characters, number, upper, and lower case");
			}
			else if (pass.value != cpass.value) {
			cpass.setCustomValidity("Password and Confirm Password does not match");
			}
		}
	}//END

	//function validate input
	function validate_input(){

		// initialization
		var user = document.getElementById('user');
		var pass = document.getElementById('pass');
		var cpass = document.getElementById('cpass');
		var email = document.getElementById('email');
		//validations
		var special_characters = /[ `!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
		var upper = new RegExp("[A-Z]");
		var lower = new RegExp("[a-z]");
		var mail_format = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;

		// Validate Inputs (Condition)
		if (user.value.match(special_characters)) {
			user.setCustomValidity("Special Characters is not allowed"); 
		}
		else if (pass.value.length < 8 && pass.value != '') {
			pass.setCustomValidity("Password must be 8 Characters");
		}
		else if ((!(pass.value.match(special_characters)) | !(pass.value.match(/\d/)) | !(pass.value.match(upper)) | !(pass.value.match(lower)))  &&  pass.value != '') {
			pass.setCustomValidity("Password must contain atleast one special characters, number, upper, and lower case");
		}
		else if (pass.value != cpass.value) {
			cpass.setCustomValidity("Password and Confirm Password does not match");
		}
		else if (!(email.value.match(mail_format)) && email.value != ''){
			email.setCustomValidity("Invalid Email Format");
		}
	}//end


	//SHOW  ACTIVITY LOGS USING TABLE
	function show_log(user,action,time){
		//create elements
		var table = document.getElementById('log_table');
		var table_row = document.createElement('tr');
		var data_user = document.createElement('td');
		var data_action = document.createElement('td');
		var data_time = document.createElement('td');
		//set attribs
		data_user.innerHTML = user;
		data_action.innerHTML = action;
		data_time.innerHTML = time;
		table_row.appendChild(data_user);
		table_row.appendChild(data_action);
		table_row.appendChild(data_time);
		table.appendChild(table_row);
	}//END

	//function show modal authentication
	function show_modal(status){
		// set display status
		document.getElementById("modal").style = "display:"+status+";";
	}//end

	//function show modal message
	function show_message(msg,status){
		// set display status
		document.getElementById("modal_message").style = "display:"+status+";";
		document.getElementById("msg").innerHTML = msg;
	}//end

	//function show modal forgot
	function show_forgot(input_1,input_2){
		var type = 'text'; var submit =document.getElementById('submit_forgot');
		if (input_1 == 'Password') {type = 'password'; submit.value = 'true';}
		document.getElementById("modal_message_forgot").style = "display:block";
		document.getElementById("forgot_dialog_content").innerHTML = "<label class='forgot_pointer' for='"+input_1+"_forgot'>"+input_1+"</label><br><input type='"+type+"' name='"+input_1+"_forgot' id='"+input_1+"_forgot' placeholder='Enter your "+input_1+"' required><br><label class='forgot_pointer' for='"+input_2+"_forgot'>"+input_2+"</label><br><input type='"+type+"' name='"+input_2+"_forgot' id='"+input_2+"_forgot' placeholder='Enter your "+input_2+"' required>";
	}//end

	function submit_forgot_function(status){
		document.getElementById("submit_forgot").value = status;
	}

	// JQUERY
	$(document).ready(function(){

		$('.close').click(function(e){
			e.preventDefault();// do not refresh browser
			show_modal('none'); // display modal none
			document.getElementById("modal_message_forgot").style = "display:none";
		});

		$('#forgot').click(function(e){
			show_forgot('Username','Email');
		});

		$('#close').click(function(e){
			e.preventDefault();// do not refresh browser
			document.getElementById("modal_message_forgot").style = "display:none";
		});

	});
