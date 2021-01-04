<!-- Blake Tharp Last Updated 12.30.20
  This page will display all of the books uploaded by the end-user in a grid.

-->

<?php
  session_start(); // Include login session
  // If no session is found, redirect user to login page:
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user();
  }
  include ('includes/header.html'); // Include page header
  // Establish connection to database.
  require ('includes/mysqli_connect.php');

  $user_id = $_SESSION['user_id'];
  // Pull all rows from database that match user ID from the session:
  $r = @mysqli_query ($dbc, "SELECT * FROM books WHERE user_id ='$user_id' ");

  if ($r) {       // If the query ran succesfully.
    if (mysqli_num_rows($r) == 0) {
    echo  '<h1>Your shelf is looking a little bare...</h1>';
    echo '<h2>Start adding books now!</h2>';
    } else {
    //Create a table of results.
    echo '<div class="book_results_container">
    <div class="book_results_title">Cover</div>
    <div class="book_results_title">Title</div>
    <div class="book_results_title">Author</div>
    <div class="book_results_title">Genre</div>
    <div class="book_results_empty_title"></div>';
  }
  //Create a new table row and insert the data from the querty
  while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){

    if ($row['imageFilePath'] == null) {
      $imageFilePath = "includes\covers\placeholder.png";
    } else {
      $imageFilePath = $row['imageFilePath'];
    }
?>
  <!--- Create a new row in the grid and insert book information -->
  <div class="book_results_cell"><img src="<?php echo $imageFilePath ?>" /></div>
  <div class="book_results_cell"><?php echo $row['title'] ?></div>
  <div class="book_results_cell"><?php echo $row['author_fn'] . ' ' . $row['author_ln'] ?></div>
  <div class="book_results_cell"><?php echo $row['genre'] ?></div>
  <div class="book_results_cell"><span class="button"><a href="delete_book.inc.php?book_id=<?php echo $row['book_id']; ?>">Delete</a></span></div>

  <?php
    // Close the grid.
      }
      echo '</div>';
      mysqli_free_result ($r);
    // If the query failed, display error messages:  
    } else {
      echo "An error has occured.";
      echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
    }
    mysqli_close($dbc); // Close database.
  ?>

  <html>
  <head>
    <title>My Library | View Shelf</title>
  </head>
  </html>
