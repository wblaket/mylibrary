<!-- Blake Tharp Last Updated 12.30.30
  This page establishes the database connection.
-->

<?php

  DEFINE ('DB_USER', '');
  DEFINE ('DB_PASSWORD', '');
  DEFINE ('DB_HOST', '');
  DEFINE ('DB_NAME', '');

  $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

  mysqli_set_charset($dbc, "utf8");
