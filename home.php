<!-- Blake Tharp - Last Updated: 12.30.20
  This file servces at the home page for MyLibrary and welcomes the user to the website.
  If the user isn't logged in, it will redirect them to the login/sign up page.
  It will also display the number of books stored and the most popular genres and authors.
  Finally, it will display some of the books found on the shelf on the bottom of the page.
-->

<?php
  // If there isn't an active login session, redirect user to login page.
  session_start();
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user();
  }

  include ('includes/header.html'); // Insert the page header.

  require ('includes/mysqli_connect.php'); // Add the database connection
  $user_id = $_SESSION['user_id']; // Grab the username from the login session

  $firstNameCheck = @mysqli_query($dbc, "SELECT user_fn FROM users WHERE user_id = '$user_id'");
  while ($row = mysqli_fetch_array($firstNameCheck, MYSQLI_ASSOC)) {
    $firstName = $row['user_fn'];
  }

  echo '<div id="information"><h1>Welcome back ' . $firstName . '!</h1>';
  echo '<h2>Your shelf at a glance:</h2>';

  // Select all of the user's books and arrange by genre.
  $q = "SELECT * FROM books WHERE user_id = '$user_id' ORDER BY genre ";
  $r = @mysqli_query ($dbc, $q);

  // If there's at least one book in the user's library:
  if (mysqli_num_rows($r) != 0) {
    // Tell the user how many books currently listed in their library:
    echo '<h2>- You currently have ' . mysqli_num_rows($r) . ' books saved to your library.</h2>';

    /* Here we're going to report the most popular genre to the user.
    Since we've sorted by genre it'll make it easier. */
    $topGenre = ''; // Variable to store the most popular genre.
    $currentGenre = ''; // Variable to store the current genre we're sorting.
    $max = 0; // Variable to store the highest number of books in the most popular genre.

    // Loop through all of the results:
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
      //  If we're now counting books in a new genre:
      if ($currentGenre != $row['genre']) {
        $currentGenre = $row['genre'];
        $count = 0; // Reset the counter.
      }
      $count++;
      // If the current number of books in a genre exceeds the highest recorded:
      if ($count > $max) {
        $topGenre = $currentGenre;
        $max = $count;
      }
    }
  // Report the most popular genre to the end-user:
  echo '<h2>- Your most popular genre is ' . $topGenre . '.</h2>';

  $currentAuthor = ''; // Variable to store the current author we're sorting through.
  $mostPopularAuthor = ''; // Variable to store the most popular author.
  $max = 0; // Variable to store the highest number of books from the most popular author.

  // Select all of the user's books and arrange by author's first name:
  $authorQuery = "SELECT * FROM books WHERE user_id = '$user_id' ORDER BY author_fn ";
  $authorResults = @mysqli_query ($dbc, $authorQuery);

  // Loop through all of the results:
  while ($row = mysqli_fetch_array($authorResults, MYSQLI_ASSOC)){
    //  If we're now counting the number of books for a new author:
    $authorFullName = $row['author_fn'] . ' ' . $row['author_ln']; // Combine the first and last name
    if ($currentAuthor != $authorFullName) {
      $currentAuthor = $authorFullName;
      $count = 0; // reset the counter.
    }
    $count++;
    // If the current number of books by an author exceeds the highest recorded.
    if ($count > $max) {
      $mostPopularAuthor = $currentAuthor;
      $max = $count;
    }
  }
  // Report the most popular author to the end-user:
  echo '<h2>- Currently, you have more books by ' . $mostPopularAuthor . ' then any other author!</h2></div>';

  echo '<div id =imageDisplay>';
  // Here we're going to display some of book covers stored to the users library.
  // We're not going to include any books that just have the placeholder as a cover.
  $imageQuery = "SELECT * FROM books WHERE imageFilePath != 'includes/covers/placeholder.png' AND user_id = '$user_id' LIMIT 5";
  $imageResults = @mysqli_query($dbc, $imageQuery); // Run the query
  while ($row = mysqli_fetch_array($imageResults, MYSQLI_ASSOC)){
    echo '<image src= "' . $row['imageFilePath'] . '" width="300" height="450" style="margin:50px" alt="Cover of the book ' . $row['title'] . '"/>';
  }
  echo '</div>';

  // If there are no books in the library:
  } else {
    echo '<h2>Your library is looking pretty empty. Start adding to your shelf now!</h2>';
}

?>

<HTML>
  <head>
    <title>My Library | Home </title>
  </head>
</html>
