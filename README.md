# Login And Registration System in PHP

#### For every Website or System User authentication is must needed facility.It is a security mechanism that is used to restrict unauthorized access to the system.The Registration facility is used to give access to ther user to use system or to access resources.


## Features

##### 1. Login And Logout
##### 2. Registration


## Version

##### PHP Version - 5.6.31, MySQLi - 5.7+ , Bootstrap 4, HTML5/CSS3

## Installation

##### Download the code from repository. Exctract the zip file.
##### Open browser. Type localhost/phpmyadmin in URL.
##### Create a database with name "login" and import the file "login.sql" in that database.
##### Copy the remaining code into your root directory:
##### for example,
##### WAMP : c:/wamp/www/login_register_php
##### OR
##### XAMPP : c:/xampp/htdocs/login_register_php
##### Open browser. type localhost/login_register_php and press enter:
##### The login screen will appear.

##### To login, use the email and password given below.
#### Email - admin@admin.com

#### Password - password

## Important Note

##### If you foud any error or warning like below

'Warning: mysqli_connect(): (HY000/1045): Access denied for user 'root'@'localhost' (using password: NO) in D:\XAMPP\htdocs\login_register_php\db.php on line 4
Not connected.'

##### Then it may be the reason that your phpMyAdmin database is password protected, you have to give password for root user in the [db.php](login_register_php/db.php) file. For that you have to add password in the 'your password here' field like below.
```
$conn = mysqli_connect('localhost','root','your password here','login') or die("Not connected.");
```
##### Now you're good to go. 
