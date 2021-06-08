<!-- Blake Tharp Last Updated 12.30.20
  This page is used to destroy the login session and redirect user to home page.
-->

<?php
  session_start(); // Include sesison information
  include ('includes/header.html'); // Include page header

  // If there's no active session, redirect user to login page:
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user();
  } else {
    // Destroy session information:
    $_SESSION = array();
    session_destroy();
    setcookie ('PDPSESSID', '', time()-3600, '/', '', 0, 0);
  }
  //  Inform user that they are logged out and will be redirected:
  echo "<h1>Logged out</h1><h2>You are now logged out!</h1>";
  echo "<h2>You will automatically be redirected in a few momments.</h2>";
  header("Refresh:5; url=login.php");

?>
<html><head><title>My Library | Logged Out</title></head></html>
