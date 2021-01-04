<!-- Blake Tharp Last Updated 12.30.20
  This page is used to create the login session.
-->

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require ('includes/login_functions.inc.php');
  require ('includes/mysqli_connect.php');
  list ($check, $data) = check_login($dbc, $_POST['user_id'], $_POST['password']);

  if ($check) {
    session_start();
    $_SESSION['user_id'] = $data['user_id'];
    $_SESSION['first_name'] = $data['first_name'];
    redirect_user('mylibrary/loggedin.php');
  } else {
    $errors = $data;
  }
  mysqli_close($dbc);
}
include ('includes/login_page.inc.php');
?>
