<!-- Blake Tharp Last Updated 12.30.20
  File that includes the registration and login forms included in the login.php file
-->

<?php
  include ('includes/header.html');
  // Print any error messages:
  if (isset($errors) && !empty($errors)) {
    echo '<h1>Error!</h1>
    <h1 class="error">The following error(s) occured:<br />';
    foreach ($errors as $msg) {
      echo " - $msg<br />";
    }
    echo '</h1><h1>Please try again.</h1>';
  }
?>

  <head><title>My Library | Log In</title></head>
  <h1 class="login">Your home library at your fingertips. </h1>

<div id="login_reg_area">
  <div id="reg_label"> <h2 class="login">Sign up and start tracking your book collections.</h2> </div>
  <div id="login_label"> <h2 class="login">Already have an account? Login here:</h2> </div>

  <!--------------------- USER REGISTRATION FORM -------------->
  <div id="signupform">
    <form action="register_user.php" method="post">

      <label for="new_user_fn">First Name:</label>
      <input type="text" name="new_user_fn" required>

      <label for="new_user_ln">Last Name:</label>
      <input type="text" name="new_user_ln" required>

      <label for="new_user_id">Username:</label>
      <input type="text" name="new_user_id" required>

      <label for="new_password">Password:</label>
      <input type="password" name="new_password" required>

      <p><input type="submit" name="submit" value="Register" class="button"/></p>
    </form>
  </div>

  <!--------------------- USER LOGIN FORM ------------------>
  <div id="loginform">
    <form action="login.php" method="post">

      <label for="user_id">Username:</label>
      <input type="text" name="user_id" required>

      <label for="password">Password:</label>
      <input type="password" name="password" required>
      <p><input type="submit" name="submit" value="Login" class="button" /></p>
    </form>
  </div>
</div>
