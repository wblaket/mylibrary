<!-- Blake Tharp Last Updated 12.30.20
  This page will pull data from the insert_book.php and insert the book into the
  MySQL database using the form data.
-->
<?php
  session_start(); // Include session information.
  include ('includes/header.html'); // Include the page header.

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    require ('includes/mysqli_connect.php'); // Create database connection

    // Pull the information from the fields
    $title = $_REQUEST['title'];
    $author_fn = $_REQUEST['author_fn'];
    $author_ln = $_REQUEST['author_ln'];
    $genre = $_REQUEST['genre'];

    // Create error array
    $errors = array();

    // Ensure that the fields are filled out. The fields are required, so this code is redundent.
    if (empty($_POST['title'])) {
      $errors[] = 'You forgot to enter the title of the book.';
    } else {
      $title = trim($_POST['title']);
    }

    if (empty($_POST['author_fn'])) {
      $errors[] = 'You forgot to enter the first name for the author of the book.';
    } else {
      $author_fn = trim($_POST['author_fn']);
    }

    if (empty($_POST['author_ln'])) {
      $errors[] = 'You forgot to enter the last name for the author of the book.';
    } else {
      $author_ln = trim($_POST['author_ln']);
    }

    if (empty($_POST['genre'])) {
      $errors[] = 'You forgot to enter the genre of the book.';
    } else {
      $genre = trim($_POST['genre']);
    }

    if (strlen($title) > 50) {
      $errors[] = 'The character limit for book title is 50 characters. Please condense the title if possible.';
    }

    if (strlen($author_fn) > 30) {
      $errors[] = 'The character limit for authors first name is 30 characters. Please condense the name if possible.';
    }
    if (strlen($author_ln) > 30) {
      $errors[] = 'The character limit for authors last name is 30 characters. Please condense the title if possible.';
    }

    if (isset($_FILES['upload']) && !empty($_FILES['upload']['tmp_name'])) {
      // Only allow GIFS, JPGS, and PNG images
      $allowed = array ('image/jpeg', 'image/JPG', 'image/PNG', 'image/png', 'image', 'image/GIF', 'image/gif');
      // If selected file was in the list of allowed file types
      if (in_array($_FILES['upload']['type'], $allowed)) {
        // Move the image to the directory "covers" which will contain all of the book covers uploaded to MyLibrary.
        if (move_uploaded_file ($_FILES['upload']['tmp_name'], "includes/covers/{$_FILES['upload']['name']}")) {
        ;
          // Create the file path that will be included into the SQL INSERT statement.
          $imageFilePath = "includes/covers/{$_FILES['upload']['name']}";
        } else {
          $errors [] = 'Unable to upload file to the directory.';
        }
      } else {
        // If selected file is not an approved file type.
        $errors[] = '<p class="error">Please upload a JPEG, GIF, or PNG image.</p>';
      }
    } else {
      // If a file was not selected, set the file path to the placeholder image:
      $imageFilePath = "includes/covers/placeholder.png";

    }

    // If no errors are found, proceed with uploading the book data into the database.
    if (empty($errors)) {
      $user_id = $_SESSION['user_id'];
      // Create insert database.
      $q = "INSERT INTO books (title, author_fn, author_ln, genre, imageFilePath, user_id) VALUES ('$title', '$author_fn', '$author_ln', '$genre', '$imageFilePath', '$user_id')";
      // Run the query.
      $r = @mysqli_query ($dbc, $q);
      // If the insert statement was successful.
      if ($r) {
        echo'<h1>Thank you! You have succesfully added your book to the shelf!</h1>';
        header("Refresh:3; url=home.php");
      } else {
        // Print sql error messages if the book could not be added.
        echo '<p>Your book could not be added to your shelf.</p>';
        echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q. '</p>';
      }

      mysqli_close($dbc); // close database connection.

    } else {
      //print error messages
      echo '<h1>An error has occured</h1>';
      foreach ($errors as $msg) {
          echo "Error - $msg<br />\n";
        }
    }
  }

 ?>
