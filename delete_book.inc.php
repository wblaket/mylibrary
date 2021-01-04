<!-- Blake Tharp Last Updated 12.30.20
This file is used to delete book entries when the delete button is clicked in either
all_books.php or search_books.php.

It accepts the variable $book_id provided when the button is clicked and runs the
delete query.
-->

<?php
  require ('includes\mysqli_connect.php'); // Include database connection
  $book_id = $_GET['book_id']; // Get the book id from the URL
  $deleteQuery = @mysqli_query ($dbc, "DELETE FROM books WHERE book_id = '$book_id' ");

  // If the query succesfully ran:
  if ($deleteQuery) {
    mysqli_close($dbc);
    echo '<p>Data deleted from database.</p>';
    header("location:all_books.php");
    exit;
  } else { 
    echo "Error deleting record.";
  }
?>
