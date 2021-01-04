# MyLibrary

MyLibrary is a PHP and MySQL based web application for tracking your bookshelf.

## Installation




##  Database Requirements

  This project requires two database tables named 'books' and 'users' under a database named 'mylibrary'.
S
  To quickly create the database and the tables. Use the following code:

  ### Create database
  CREATE DATABASE mylibrary;

  ### Create tables
  CREATE TABLE books (book_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, title VARCHAR(50) NOT NULL, author_fn VARCHAR(20) NOT NULL,
  author_ln VARCHAR(20) NOT NULL, genre VARCHAR(20) NOT NULL, user_id VARCHAR(20), FOREIGN KEY (user_id) REFERENCES users(user_id)  );

  CREATE TABLE users (user_id VARCHAR(20) PRIMARY KEY NOT NULL, user_fn VARCHAR(20) NOT NULL, user_ln VARCHAR(20) NOT NULL, password VARCHAR(20));

## Support

You can contact me at wblaketharp@gmail.com for any suggestions, feedback, or support for this application.

#Authors and acknowledgement

This program was created and written by William Blake Tharp.
Thank you Larry Ullman's PHP and MySQL for Dynamic Web Sites Fourth Edition.
