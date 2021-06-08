<!-- Blake Tharp Last Updated 12.30.30
  This page establishes the database connection.
-->

<?php

  DEFINE ('DB_USER', 'root');
  DEFINE ('DB_PASSWORD', 'Mchs2014!');
  DEFINE ('DB_HOST', 'localhost');
  DEFINE ('DB_NAME', 'mylibrary');

  $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die('Could not connect to MySQL: ' . mysqli_connect_error() );

  mysqli_set_charset($dbc, "utf8");
