<!-- Blake Tharp last Updated 12.30.20
  This pages collects the search details from the end-user and will use
  search_books.inc.php to perform the search.
-->

<?php
  session_start(); // Start the login session
  // If there's no login session found, redirect user to login page.
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user();
  }
  // Insert the page header.
  include ('includes/header.html');
?>

<html>
  <head>
    <title>My Library | Search Shelf</title>
    <link rel="stylesheet" href="includes\styles.css">
  </head>

  <body>
    <!-----------------------SEARCH FORM ----------------------------->
    <form class="center" action="search_books.inc.php" method="post">
      <div id="book_search_area">
        <label for="searchtype">Choose Search Type:</label>
        <select name="searchtype" required>
          <option value="title">Title</option>
          <option value="author_fn">Author's First Name</option>
          <option value="author_ln">Author's Last Name</option>
          <option value="genre">Genre</option>
        </select>

        <label for="seachterm">Enter Search Term:</label>
        <input name="searchterm" type="text" size="40">
        <input id="search_button" type="submit" name="submit" value="Search" class="button">
      </div>
    </form>
  </body>
</html>
