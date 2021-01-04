<!--- Blake Tharp Last Updated 12.30.20
  This page takes the data collected from book_search.php
  and queries the database using the search type and search term.
-->

<?php
  session_start();
  include ('includes/header.html');
  $searchtype = $_REQUEST['searchtype']; // Get the search type from the HTML form
  $searchterm = $_REQUEST['searchterm']; // Get the search term from the HTML form
  $errors = array(); // Create error array.

  // Make sure a search term has been entered:
  if (empty($_POST['searchterm'])) {
    $errors[] = 'Your forgot to enter a search term';
  } else {
    $searchterm = trim($_POST['searchterm']);
  }

  // If there are no errors found:
  if (empty($errors)) {
    // Establish connection to database:
    require ('includes/mysqli_connect.php');
    $user_id = $_SESSION['user_id'];
    // Pull all rows from the database that meet the search criteria.
    $q = "SELECT * FROM books WHERE $searchtype = '$searchterm' AND user_id = '$user_id'"; // Create the query
    $r = @mysqli_query ($dbc, $q); // Run the query

    // If the query ran succesfully:
    if ($r) {
      // If there's no search results found, display the error:
      if (mysqli_num_rows($r) == 0 ){
        echo '<h1>Sorry, we could not find your book(s) on the shelf...</h1>';
        echo '<h2>Please refine your query and try again.</h2>';
      } else {
      // If a result was found, create a grid of search results:
      // Create the header of the grid:
      echo '<div class="book_results_container">
      <div class="book_results_title">Cover</div>
      <div class="book_results_title">Title</div>
      <div class="book_results_title">Author</div>
      <div class="book_results_title">Genre</div>
      <div class="book_results_empty_title"></div>';

      // Create a new row in the grid and insert the data from the query:
        while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){

         echo '<div class="book_results_cell"><img src="' . $row['imageFilePath']. '"></div>
          <div class="book_results_cell">' . $row['title'] . '</div>
          <div class="book_results_cell">' . $row['author_fn'] . ' ' . $row['author_ln'] . '</div>
          <div class="book_results_cell">' . $row['genre'] . '</div>
          <div class="book_results_cell"><span class="button"><a href="delete_book.inc.php?book_id=' . $row['book_id'] . '">Delete</a></span></div>
          </div>';
          mysqli_free_result ($r);
        }
      }
    } else {
          // Print the error messages:
          echo "An error has occured.";
          echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
      }
      mysqli_close($dbc); // Close database.
  //Print out error messages:
  } else foreach($errors as $msg) {
      echo "<p>$msg</p>";
  }
?>
