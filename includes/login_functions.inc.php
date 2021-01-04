<!-- Blake Tharp Last Updated 12.30.20
  This page includes all of the login functions to be used by multiple
  web pages.
-->

<?php

  // Function that redirects the user back to the login page:
  function redirect_user ($page = 'mylibrary/login.php') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER)['PHP_SELF'];
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    header("Location: $url");
    exit();
  }

  /* Function that will accept the username and password
     and return true if a match is made:
  */
  function check_login($dbc, $user_id = '', $password = '') {

    $errors = array();
    if (empty($user_id)) {
      $errors[] = 'You forgot to enter your username.';
    } else {
      $u = mysqli_real_escape_string($dbc, trim($user_id));
    }

    if (empty($password)) {
      $errors[] = 'You forgot to enter your password.';
    } else {
      $p = mysqli_real_escape_string($dbc, trim($password));
    }

    // If there are no errors, run a query on the "users" table in the database:
    if (empty($errors)) {
      $userQuery = "SELECT user_id, user_fn FROM users WHERE user_id ='$u' AND password='$p'";
      $userCheck = @mysqli_query($dbc, $userQuery);

      if (mysqli_num_rows($userCheck) == 1) {
        $row = mysqli_fetch_array ($userCheck, MYSQLI_ASSOC);
        return array(true, $row);
      } else {
        $errors[] = 'The user and/or password entered do not match those on file.';
      }
    }
    return array(false, $errors);
  }
?>
