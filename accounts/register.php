<!DOCTYPE html>
<html>

<head>
	
  <!--Title-->
  <title>Sign up for Steady Stripes</title>
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

  <!-----------Register Box-------------->
  <div class="register_container">
  <fieldset class="register_box">
      <!-----------Form-------------->
          <form action="add_account.php" method="post">
              <div id="register_input">

                <label class="createanaccount">Create an account</label>

                <br>
                <!--<label class="label_pointer" for="user">Username</label>-->
                <input type="text" name ="user" id="user"  placeholder="Username" required>

                <!--<label class="label_pointer" for="pass">Password</label>-->

                 <input type="text" name ="email" id="email" placeholder="Email" required>

                <input type="password" name="pass" id="pass" placeholder="Password" required>

               

                <!--<label class="label_pointer" for="cpass">Confirm Password</label>-->

                <input type="password" name="cpass" id="cpass" placeholder="Confirm password" required>
                <!--<label class="label_pointer" for="email">Email</label>-->
                
                <button name="submit_register" id="submit_register" value="true" onclick="validate_input()">SIGN IN</button>
                <p id="register">Have an account? <a href="login.php" style="color: blue;">Login Here.</a></p>
          </form>
          <!-----------End of Form-------------->   
  </fieldset>
  </div>
  <!-----------End of Register Box-------------->


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
        <form action="add_account.php" method="post">
          <center><button class="ok" id="ok" name="ok">OK</button></center>
          </form>
       </div>
    </div>
  </div>
  <!-----------End of Modal Authentication Code-------------->

  <!----------------------------PHP CODES STARTS HERE--------------------------->
  <?php
  // DISPLAY SUCCESS MSG
  if (isset($_SESSION['success']) && $_SESSION['success'] == 'true') {
    echo '<script>show_message("Account created successfully","block");</script>'; 
    $_SESSION['success'] = 'false';
  }
  // DISPLAY ERROR MSG
  else if (isset($_SESSION['error']) && $_SESSION['error'] == 'true') {
    echo '<script>show_message("Server Error  !!!","block");</script>'; 
    $_SESSION['error'] = 'false';
  }
  else if (isset($_SESSION['user_exist']) && $_SESSION['user_exist'] == 'true') {
    echo '<script>show_message("Username is already taken","block");</script>'; 
    $_SESSION['user_exist'] = 'false';
  }
  else if (isset($_SESSION['email_exist']) && $_SESSION['email_exist'] == 'true') {
    echo '<script>show_message("Email is already taken","block");</script>'; 
    $_SESSION['email_exist'] = 'false';
  }
  else if (isset($_SESSION['display_user_register']) && isset($_SESSION['display_pass_register']) && isset($_SESSION['display_cpass_register']) && isset($_SESSION['display_email_register'])) {
    echo '<script>display_input_register("'.$_SESSION['display_user_register'].'","'.$_SESSION['display_pass_register'].'","'.$_SESSION['display_cpass_register'].'","'.$_SESSION['display_email_register'].'");</script>';
    session_destroy();
  }
  // ELSE PROCEED TO REGISTER

  ?>
  <!----------------------------PHP CODES ENDS HERE--------------------------->

</body>  
</html>

