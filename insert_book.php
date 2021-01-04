<!-- Blake Tharp 12.30.20
  This file provides the form to enter book details to databse and
  will use insert_book.inc.php to run the query.
-->

<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
    require ('includes/login_functions.inc.php');
    redirect_user();
  }
  include ('includes/header.html');
 ?>

<HTML>
  <head>
    <title>My Library | Add Book</title>
  </head>
  <body style="color:black">
  <form id="insert_book_form" class="center" action="insert_book.inc.php" method="post" enctype="multipart/form-data">
    <div id="book_upload_area">
          <label for="title">Title:</label>
          <input type="text" name="title" placeholder="The Shining" required>

          <label for="author_fn">Author First Name:</label>
          <input type="text" name="author_fn" placeholder="Stephen" required>

          <label for="author_ln">Author Last Name:</label>
          <input type="text" name="author_ln" placeholder="King" required>

          <label for="genre">Genre:</label>
          <select name="genre" id="genre">
            <option value="Biography">Autobiography</option>
            <option value="Biography">Biography</option>
            <option value="Cooking">Cooking</option>
            <option value="Classic">Classic</option>
            <option value="Economics">Economics</option>
            <option value="Fantasy">Fantasy</option>
            <option value="History">Histroy</option>
            <option value="Horror">Horror</option>
            <option value="Mystery">Mystery</option>
            <option value="Non-fiction">Non-Fiction</option>
            <option value="Politics">Politics</option>
            <option value="Romance">Romance</option>
            <option value="Sci-fi">Sci-Fi</option>
            <option value="Science">Science</option>
            <option value="True Crime">True Crime</option>
          </select>

          <label for="upload">Upload Book Cover (optional):</label>
          <input type="file" name="upload" />
          <br />
          <br />
        </div>
          <input id="submit_button" type="submit" name ="submit" value="Add to Shelf" class="button"/>
    </form>
  </body>
</HTML>
