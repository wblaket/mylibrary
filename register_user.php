<!-- Blake Tharp Last Updated 12.30.20
  This page collects the field data from login_page.inc.php and
  inserts user information into database.
-->
<?php

  include ('includes/header.html'); // Include page header

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require ('includes/mysqli_connect.php'); // create database connection
    if (!$dbc) {
      echo '<p>Something went wrong!</p>';
    }
    // Pull the information from the fields
    $user_id = $_REQUEST['new_user_id'];
    $user_fn = $_REQUEST['new_user_fn'];
    $user_ln = $_REQUEST['new_user_ln'];
    $password = $_REQUEST['new_password'];

    // Create error array
    $errors = array();

    // Ensure that the fields are filled out
    if (empty($user_id) || empty($password) || empty($user_fn) || empty($user_ln)) {
      $errors[] = 'One or more fields are missing information.';
    }  else {
        $u = mysqli_real_escape_string($dbc, trim($user_id));
        $p = mysqli_real_escape_string($dbc, trim($password));
        $fn = mysqli_real_escape_string($dbc, trim($user_fn));
        $ln = mysqli_real_escape_string($dbc, trim($user_ln));
    }

    // Ensure that the fields are filled out
    if (empty($_POST['new_user_id'])) {
      $errors[] = 'You forgot to enter the username';
    }

    if (empty($_POST['new_user_fn'])) {
      $errors[] = 'You forgot to enter your first name.';
    }

    if (empty($_POST['new_user_ln'])) {
      $errors[] = 'You forgot to enter your last name,';
    }

    if (empty($_POST['new_password'])) {
      $errors[] = 'You forgot to enter your password.';
    }

    if (strlen($u) > 20) {
      $errors[] = 'The character limit for the username is 20 characters. Please enter a shorter username.';
    }

    if (strlen($p) > 20) {
      $errors[] = 'The character limit for the password is 20 characters. Please enter a shorter password.';
    }

    if (strlen($fn) > 30) {
      $errors[] = 'The character limit for first name is 30 characters.';
    }

    if (strlen($ln) > 30) {
      $errors[] = 'The character limit for the password is 30 characters.';
    }
    // Check and see if the username is already in use:
    $usernameCheck = @mysqli_query($dbc, "SELECT * FROM users WHERE user_id = '$u'");
    if (mysqli_num_rows($usernameCheck) > 0) {
      $errors[] = '<p>You have selected a username that is already in use.</p>';
    }

    // If no errors are found, proceed with registering the user into the database.
    if (empty($errors)) {
      $u = strtolower($u);
      $q = "INSERT into users (user_id, user_fn, user_ln, password) VALUES ('$u', '$fn', '$ln', '$p')";
      $r = @mysqli_query($dbc, $q);

      // If the insert statement was successful:
      if ($r) {
        echo'<h1>Thank you! You are now registered.</h1>';
        echo '<h1>You will be redirected back to the home page in 5 seconds</h1>';
        header("Refresh:5; url=home.php");
      } else {
        // Print sql error messages if the book could not be added.
        echo '<p>Sorry, we were not able to register you at this time.</p>';
        echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q. '</p>';
      }

      mysqli_close($dbc); // Close database connection.

    } else {
      //print error messages
      echo '<h1 class="error">The following error(s) have occured:<br />';
      foreach ($errors as $msg) {
          echo "Error: $msg<br />\n";
        }
        echo 'Click <a href="login.php">here</a> to return to the registration page.</h1>';  }
  }

 ?>
