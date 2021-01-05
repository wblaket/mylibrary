# MyLibrary - book cataloging app
Website built with PHP and MySQL to catalogue your book library.

## Table of Contents
* General Info
* Technologies 
* Setup


## General Information
This web application allows you to create an account and log in to track the books in your home library.
You can log books and include the title, author, and genre. You can optionally include an image file of the
book cover.

You can afterwards view your entire library or search for specific books. The home page will display some 
of the covers of the books you've logged, as well as tell you facts about your library such as the author
you've logged the most books for.

## Technologies
Project is created with:
* PHP version: 7.2.4 
* MariaDB 10.1.31
* Apache 2.4.33


## Installation
Download the repository and place the entire folder on your web server. For this project I used XAAMP's Apache
HTTP Server for hosting. You can download XAAMP here: https://www.apachefriends.org/download.html

You will also need to open "\includes\mysqli.connect.php" file and define the variables below with the database
information on lines 7-10 between the second set of quotes on each line:

```
  DEFINE ('DB_USER', '');
  DEFINE ('DB_PASSWORD', '');
  DEFINE ('DB_HOST', '');
  DEFINE ('DB_NAME', '');
```

This project will require a MYSQL database named "mylibrary" and two tables: "books" which will store
the data for the book entries, and "users" to store the data for the user accounts. You can quickly set this up
using the following database queries:

```
CREATE DATABASE mylibrary;
```

Create two tables:
```
CREATE TABLE books (book_id INTEGER NOT NULL PRIMARY KEY AUTO_INCREMENT, title VARCHAR(50) NOT NULL, 
author_fn VARCHAR(20) NOT NULL, author_ln VARCHAR(20) NOT NULL, genre VARCHAR(20) NOT NULL, user_id VARCHAR(20), 
FOREIGN KEY (user_id) REFERENCES users(user_id)  );
```

```
CREATE TABLE users (user_id VARCHAR(20) PRIMARY KEY NOT NULL, user_fn VARCHAR(20) NOT NULL, 
user_ln VARCHAR(20) NOT NULL, password VARCHAR(20));
```


## Sources
This project was partially adapated from the tutorial project from
PHP and MySQL for Dynamic Web Sites (4th edt.) by Larry Ullman
