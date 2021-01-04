<!-- Blake Tharp Last Updated 12.30.20
  This page informs the user they are logged in and redircts them to the home page.
-->

<?php
  session_start(); // Include the session information
  include ('includes/header.html'); // Include the page header

  // If there is no login session, redirect the user to the login page:
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user();
  } else {
    header("Refresh:5; url=home.php");
  }
  echo "<h1>Welcome back to your shelf!</h1>
  <h2>You will be automatically redirected to our home page in 5 seconds.</h2>";
?>
<html>
<head>
  <title>My Library | Logged In </title>
</head>
</html>
